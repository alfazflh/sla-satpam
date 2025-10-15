<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Form; // Pastikan model ini ada

class SatpamController extends Controller
{
    public function create()
    {
        return view('welcome'); // atau view yang kamu pakai
    }

    public function store(Request $request)
    {
        // Log untuk debug
        Log::info('Request All:', $request->all());
        Log::info('Request Files:', $request->allFiles());

        // Simpan data non-foto dulu
        $data = $request->except([
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 
            'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi', 
            'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 
            'foto_cctv'
        ]);

        // Convert nama array ke JSON string
        if (isset($request->nama)) {
            $data['nama'] = json_encode($request->nama);
        }

        // Array field foto
        $photoFields = [
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 
            'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi', 
            'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 
            'foto_cctv'
        ];

        // Upload multiple photos untuk setiap field
        foreach ($photoFields as $field) {
            // Cek apakah ada file dengan name foto_xxx[]
            if ($request->hasFile($field)) {
                $paths = [];
                $files = $request->file($field);
                
                Log::info("Processing {$field}: " . count($files) . " files");
                
                // Handle baik single file maupun array
                if (!is_array($files)) {
                    $files = [$files];
                }
                
                foreach ($files as $index => $file) {
                    if ($file && $file->isValid()) {
                        $path = $file->store('uploads', 'public');
                        $paths[] = $path;
                        Log::info("  [{$index}] Uploaded: {$path}");
                    }
                }
                
                // Simpan array paths sebagai JSON string
                if (!empty($paths)) {
                    $data[$field] = json_encode($paths);
                    Log::info("{$field} saved as JSON: " . $data[$field]);
                }
            }
        }

        // Simpan ke database
        try {
            $form = Form::create($data);
            Log::info('Form saved with ID: ' . $form->id);
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'id' => $form->id
            ]);
        } catch (\Exception $e) {
            Log::error('Error saving form: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }
}