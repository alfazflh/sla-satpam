<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Form;

class SatpamController extends Controller
{
    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        Log::info('Request All:', $request->all());
        Log::info('Request Files:', $request->allFiles());

        $data = $request->except([
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu',
            'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi',
            'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan',
            'foto_cctv'
        ]);

        if (isset($request->nama)) {
            $data['nama'] = json_encode($request->nama);
        }

        // Generate nama folder berdasarkan nama pertama atau default
        $namaArray = is_array($request->nama) ? $request->nama : [$request->nama ?? 'unknown'];
        $namaFolder = $this->sanitizeFolderName($namaArray[0] ?? 'unknown');
        $timestamp = date('Ymd_His');
        $folderPath = "uploads/{$namaFolder}_{$timestamp}";

        $photoFields = [
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu',
            'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi',
            'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan',
            'foto_cctv'
        ];

        foreach ($photoFields as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                $files = $request->file($field);
                Log::info("Processing {$field}: " . count($files) . " files");

                if (!is_array($files)) {
                    $files = [$files];
                }

                foreach ($files as $index => $file) {
                    if ($file && $file->isValid()) {
                        // Generate nama file dengan enkripsi ringan
                        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $file->getClientOriginalExtension();
                        $encryptedSuffix = $this->generateLightEncryption();
                        $newFileName = "{$originalName}_{$encryptedSuffix}.{$extension}";
                        
                        // Simpan ke folder terstruktur
                        $path = $file->storeAs($folderPath, $newFileName, 'public');
                        $paths[] = $path;
                        Log::info(" [{$index}] Uploaded: {$path}");
                    }
                }

                if (!empty($paths)) {
                    $data[$field] = json_encode($paths);
                    Log::info("{$field} saved as JSON: " . $data[$field]);
                }
            }
        }

        try {
            $form = Form::create($data);
            Log::info('Form saved with ID: ' . $form->id);
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'id' => $form->id,
                'folder' => $folderPath
            ]);
        } catch (\Exception $e) {
            Log::error('Error saving form: ' . $e->getMessage());
            
            // Hapus folder jika gagal save ke database
            Storage::disk('public')->deleteDirectory($folderPath);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    private function sanitizeFolderName($name)
    {
        $name = Str::slug($name, '_');
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '', $name);
        return $name ?: 'unknown';
    }

    private function generateLightEncryption()
    {
        $words = rand(1, 3);
        $result = [];
        
        for ($i = 0; $i < $words; $i++) {
            $result[] = Str::random(rand(3, 6));
        }
        
        return implode('_', $result);
    }
}