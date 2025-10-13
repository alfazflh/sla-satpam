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
        Log::info('=== FORM SUBMISSION START ===');
        Log::info('Form Data:', $request->except(['foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi', 'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv']));
        
        // Log detail files yang masuk
        $allFiles = $request->allFiles();
        Log::info('Total file fields received: ' . count($allFiles));
        
        foreach ($allFiles as $fieldName => $files) {
            if (is_array($files)) {
                Log::info("📂 Field: {$fieldName} - Total files: " . count($files));
                foreach ($files as $idx => $file) {
                    Log::info("  📄 File #{$idx}: {$file->getClientOriginalName()} ({$file->getSize()} bytes, mime: {$file->getMimeType()}, ext: {$file->getClientOriginalExtension()})");
                }
            } else {
                Log::info("📂 Field: {$fieldName} - Single file: {$files->getClientOriginalName()} ({$files->getSize()} bytes, mime: {$files->getMimeType()})");
            }
        }

        try {
            // Validasi HANYA untuk non-file fields
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

            Log::info('✅ Non-file validation passed');

            // Validasi manual untuk files
            $this->validateFiles($request);

            Log::info('✅ File validation passed');

            // Simpan data utama
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

            // Simpan semua foto
            $fotoFields = [
                'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu',
                'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi',
                'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
            ];

            foreach ($fotoFields as $field) {
                $form->$field = $this->handleFileUpload($request, $field);
            }

            $form->save();
            Log::info('✅ FORM SAVED SUCCESSFULLY', ['id' => $form->id]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $form->id
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ VALIDATION ERROR', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('❌ GENERAL ERROR', [
                'msg' => $e->getMessage(),
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

    /**
     * Validasi manual untuk files dengan pengecekan ketat
     */
    private function validateFiles(Request $request)
    {
        $fotoFields = [
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu',
            'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi',
            'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
        ];

        $errors = [];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 51200; // 50MB dalam KB

        foreach ($fotoFields as $field) {
            if ($request->hasFile($field)) {
                $files = $request->file($field);
                
                // Pastikan files adalah array
                if (!is_array($files)) {
                    $files = [$files];
                }

                Log::info("Validating field: {$field}, total files: " . count($files));

                foreach ($files as $index => $file) {
                    $fileName = $file->getClientOriginalName();
                    $fileSize = $file->getSize();
                    $mimeType = $file->getMimeType();
                    $extension = strtolower($file->getClientOriginalExtension());

                    Log::info("  Checking file #{$index}: {$fileName}", [
                        'size' => $fileSize,
                        'mime' => $mimeType,
                        'ext' => $extension
                    ]);

                    // Validasi 1: Apakah file valid
                    if (!$file->isValid()) {
                        $errors[$field][] = "File ke-" . ($index + 1) . " ({$fileName}) tidak valid atau corrupt";
                        Log::warning("  ❌ File not valid");
                        continue;
                    }

                    // Validasi 2: Cek extension
                    if (!in_array($extension, $allowedExtensions)) {
                        $errors[$field][] = "File ke-" . ($index + 1) . " ({$fileName}) memiliki ekstensi tidak valid. Hanya diperbolehkan: " . implode(', ', $allowedExtensions);
                        Log::warning("  ❌ Invalid extension: {$extension}");
                    }

                    // Validasi 3: Cek mime type
                    if (!in_array($mimeType, $allowedMimeTypes)) {
                        $errors[$field][] = "File ke-" . ($index + 1) . " ({$fileName}) bukan file gambar yang valid. Detected mime type: {$mimeType}";
                        Log::warning("  ❌ Invalid mime type: {$mimeType}");
                    }

                    // Validasi 4: Cek ukuran file
                    if ($fileSize > ($maxSize * 1024)) {
                        $sizeInMB = round($fileSize / 1024 / 1024, 2);
                        $errors[$field][] = "File ke-" . ($index + 1) . " ({$fileName}) terlalu besar ({$sizeInMB}MB). Maksimal 50MB";
                        Log::warning("  ❌ File too large: {$sizeInMB}MB");
                    }

                    // Validasi 5: Cek apakah file benar-benar gambar (optional, tapi bagus untuk keamanan)
                    try {
                        $imageInfo = @getimagesize($file->getRealPath());
                        if ($imageInfo === false) {
                            $errors[$field][] = "File ke-" . ($index + 1) . " ({$fileName}) bukan file gambar yang valid";
                            Log::warning("  ❌ Not a valid image (getimagesize failed)");
                        } else {
                            Log::info("  ✅ Valid image: {$imageInfo[0]}x{$imageInfo[1]}px");
                        }
                    } catch (\Exception $e) {
                        $errors[$field][] = "File ke-" . ($index + 1) . " ({$fileName}) gagal divalidasi sebagai gambar";
                        Log::warning("  ❌ Image validation exception: " . $e->getMessage());
                    }
                }
            }
        }

        if (!empty($errors)) {
            Log::error('File validation failed', $errors);
            throw \Illuminate\Validation\ValidationException::withMessages($errors);
        }

        Log::info('✅ All files validated successfully');
    }

    /**
     * Handle upload file dan return JSON path array
     */
    private function handleFileUpload(Request $request, string $field)
    {
        $paths = [];
        
        if ($request->hasFile($field)) {
            $files = $request->file($field);
            
            // Pastikan files adalah array
            if (!is_array($files)) {
                $files = [$files];
            }
            
            Log::info("📤 Uploading files for field: {$field}, total: " . count($files));
            
            foreach ($files as $index => $file) {
                if ($file && $file->isValid()) {
                    try {
                        // Generate unique filename
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $filename = pathinfo($originalName, PATHINFO_FILENAME);
                        $safeFilename = preg_replace('/[^A-Za-z0-9\-_]/', '_', $filename);
                        $uniqueFilename = $safeFilename . '_' . time() . '_' . uniqid() . '.' . $extension;
                        
                        // Store file
                        $path = $file->storeAs("uploads/{$field}", $uniqueFilename, 'public');
                        $paths[] = $path;
                        
                        Log::info("  ✅ File #{$index} uploaded successfully", [
                            'field' => $field,
                            'original_name' => $originalName,
                            'stored_name' => $uniqueFilename,
                            'path' => $path,
                            'size' => $file->getSize()
                        ]);
                    } catch (\Exception $e) {
                        Log::error("  ❌ File #{$index} upload failed", [
                            'field' => $field,
                            'file' => $file->getClientOriginalName(),
                            'error' => $e->getMessage()
                        ]);
                    }
                } else {
                    Log::warning("  ⚠️ File #{$index} is invalid or empty");
                }
            }
            
            Log::info("✅ Total files uploaded for {$field}: " . count($paths));
        }
        
        return $paths ? json_encode($paths) : null;
    }
}