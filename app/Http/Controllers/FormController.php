<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        Log::info('=== INCOMING REQUEST DEBUG ===');
        Log::info('All keys:', array_keys($request->all()));
        
        // Debug semua file yang masuk
        foreach ($request->allFiles() as $key => $files) {
            if (is_array($files)) {
                Log::info("Files array for {$key}: " . count($files) . " files");
            } else {
                Log::info("Single file for {$key}: " . $files->getClientOriginalName());
            }
        }

        try {
            // ✅ VALIDASI TANPA FILE (validasi file manual di handleFileUpload)
            $validated = $request->validate([
                'waktu' => 'nullable|string|max:255',
                'area' => 'nullable|string|max:255',
                'nama' => 'nullable|array',
                'nama.*' => 'nullable|string|max:255',
                'ketentuan_seragam' => 'nullable|string|max:255',
                'pengamanan' => 'nullable|string|max:255',
                'kronologi_kriminal' => 'nullable|string|max:5000',
                'fungsi_khusus' => 'nullable|string|max:255',
                'kronologi_gangguan' => 'nullable|string|max:5000',
                'memantau' => 'nullable|string|max:255',
                'pelayanan' => 'nullable|string|max:255',
                'fungsi_force' => 'nullable|string|max:255',
                'penertiban' => 'nullable|string|max:255',
                'simulasi' => 'nullable|string|max:255',
                'penyegaran' => 'nullable|string|max:255',
                'telepon' => 'nullable|string|max:255',
                'rutin' => 'nullable|string|max:255',
                'titik' => 'nullable|integer|min:1',
                'pengecekan' => 'nullable|string|max:255',
                'cctv' => 'nullable|string|max:255',
                'kronologi_cctv' => 'nullable|string|max:5000',
            ]);

            Log::info('✅ Validation PASSED');

            // Simpan data
            $form = new Form();
            $form->waktu = $request->waktu;
            $form->area = $request->area;
            $form->nama = $request->nama ? json_encode($request->nama) : null;
            $form->ketentuan_seragam = $request->ketentuan_seragam;
            $form->pengamanan = $request->pengamanan;
            $form->kronologi_kriminal = $request->kronologi_kriminal;
            $form->fungsi_khusus = $request->fungsi_khusus;
            $form->kronologi_gangguan = $request->kronologi_gangguan;
            $form->memantau = $request->memantau;
            $form->pelayanan = $request->pelayanan;
            $form->fungsi_force = $request->fungsi_force;
            $form->penertiban = $request->penertiban;
            $form->simulasi = $request->simulasi;
            $form->penyegaran = $request->penyegaran;
            $form->telepon = $request->telepon;
            $form->rutin = $request->rutin;
            $form->titik = $request->titik;
            $form->pengecekan = $request->pengecekan;
            $form->cctv = $request->cctv;
            $form->kronologi_cctv = $request->kronologi_cctv;

            // ✅ Handle file uploads dengan deteksi otomatis
            $fotoFields = [
                'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu',
                'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi',
                'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
            ];

            foreach ($fotoFields as $field) {
                $form->$field = $this->handleFileUpload($request, $field);
            }

            $form->save();
            Log::info('✅ Form saved successfully', ['id' => $form->id]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $form->id
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation FAILED', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('❌ Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function handleFileUpload(Request $request, string $field)
    {
        $paths = [];
        $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp', 'image/heic'];
        $maxSize = 51200 * 1024; // 50MB in bytes
        
        Log::info("📁 Processing field: {$field}");
        
        // Method 1: Cek sebagai array langsung
        if ($request->hasFile($field)) {
            $files = $request->file($field);
            
            if (!is_array($files)) {
                $files = [$files];
            }
            
            Log::info("  ✅ Found {$field} as array: " . count($files) . " files");
            
            foreach ($files as $index => $file) {
                if ($file && $file->isValid()) {
                    // Validasi MIME type
                    if (!in_array($file->getMimeType(), $allowedMimes)) {
                        Log::warning("  ⚠️ Invalid MIME [{$index}]: " . $file->getMimeType());
                        continue;
                    }
                    
                    // Validasi size
                    if ($file->getSize() > $maxSize) {
                        Log::warning("  ⚠️ File too large [{$index}]: " . $file->getSize() . " bytes");
                        continue;
                    }
                    
                    try {
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $filename = pathinfo($originalName, PATHINFO_FILENAME);
                        $safeFilename = preg_replace('/[^A-Za-z0-9\-_]/', '_', $filename);
                        $uniqueFilename = $safeFilename . '_' . time() . '_' . uniqid() . '.' . $extension;
                        
                        $path = $file->storeAs("uploads/{$field}", $uniqueFilename, 'public');
                        $paths[] = $path;
                        
                        Log::info("  ✅ Uploaded [{$index}]: {$uniqueFilename}");
                    } catch (\Exception $e) {
                        Log::error("  ❌ Upload failed [{$index}]: " . $e->getMessage());
                    }
                } else {
                    Log::warning("  ⚠️ Invalid file at [{$index}]");
                }
            }
        }
        
        // Method 2: Cek dengan pattern field[0], field[1], dll
        if (empty($paths)) {
            Log::info("  🔍 Trying indexed pattern for {$field}...");
            
            $index = 0;
            while (true) {
                $indexedField = "{$field}[{$index}]";
                
                if ($request->hasFile($indexedField)) {
                    $file = $request->file($indexedField);
                    
                    if ($file && $file->isValid()) {
                        // Validasi MIME type
                        if (!in_array($file->getMimeType(), $allowedMimes)) {
                            Log::warning("  ⚠️ Invalid MIME [{$indexedField}]: " . $file->getMimeType());
                            $index++;
                            continue;
                        }
                        
                        // Validasi size
                        if ($file->getSize() > $maxSize) {
                            Log::warning("  ⚠️ File too large [{$indexedField}]: " . $file->getSize() . " bytes");
                            $index++;
                            continue;
                        }
                        
                        try {
                            $originalName = $file->getClientOriginalName();
                            $extension = $file->getClientOriginalExtension();
                            $filename = pathinfo($originalName, PATHINFO_FILENAME);
                            $safeFilename = preg_replace('/[^A-Za-z0-9\-_]/', '_', $filename);
                            $uniqueFilename = $safeFilename . '_' . time() . '_' . uniqid() . '.' . $extension;
                            
                            $path = $file->storeAs("uploads/{$field}", $uniqueFilename, 'public');
                            $paths[] = $path;
                            
                            Log::info("  ✅ Uploaded from [{$indexedField}]: {$uniqueFilename}");
                        } catch (\Exception $e) {
                            Log::error("  ❌ Upload failed [{$indexedField}]: " . $e->getMessage());
                        }
                    }
                    $index++;
                } else {
                    break;
                }
            }
            
            if (!empty($paths)) {
                Log::info("  ✅ Found {$field} as indexed: " . count($paths) . " files");
            }
        }
        
        if (empty($paths)) {
            Log::info("  ℹ️ No files found for {$field}");
        }
        
        return $paths ? json_encode($paths) : null;
    }
}