<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
                        $path = $file->store('uploads', 'public');
                        $paths[] = $path;
                        Log::info("  [{$index}] Uploaded: {$path}");
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