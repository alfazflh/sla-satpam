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
        Log::info('Form Data Received:', $request->all());
        Log::info('Files Received:', $request->allFiles());

        try {
            // VALIDASI BASIC FIELDS DULU (TANPA FILE)
            $validated = $request->validate([
                'waktu' => 'required|string|max:255',
                'area' => 'required|string|max:255',
                'nama' => 'required|array|min:1',
                'nama.*' => 'string|max:255',
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

            // ===== VALIDASI FILE MANUAL - BYPASS LARAVEL VALIDATOR =====
            $fotoFields = [
                'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 
                'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi', 
                'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 
                'foto_cctv'
            ];

            // Whitelist MIME types yang diijinkan
            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg'];
            $maxFileSize = 51200; // 50KB

            // Validasi setiap file secara manual
            foreach ($fotoFields as $field) {
                if ($request->hasFile($field)) {
                    $files = $request->file($field);
                    
                    // Handle single file atau multiple files
                    if (!is_array($files)) {
                        $files = [$files];
                    }

                    foreach ($files as $file) {
                        // Skip jika file tidak ada
                        if (!$file) continue;

                        // Validasi: file harus valid
                        if (!$file->isValid()) {
                            throw new \Exception("$field: File tidak valid atau corrupted");
                        }

                        // Validasi: check MIME type
                        $mimeType = $file->getMimeType();
                        if (!in_array($mimeType, $allowedMimes)) {
                            Log::warning("Invalid MIME type for $field", [
                                'mime' => $mimeType,
                                'name' => $file->getClientOriginalName()
                            ]);
                            throw new \Exception("$field: Hanya file gambar (JPEG/PNG) yang diijinkan. MIME: $mimeType");
                        }

                        // Validasi: ukuran file
                        if ($file->getSize() > $maxFileSize) {
                            throw new \Exception("$field: File terlalu besar (max 50KB, file Anda: " . round($file->getSize() / 1024, 2) . "KB)");
                        }
                    }
                }
            }

            // ===== JIKA SEMUA VALIDASI LOLOS, LANJUT SIMPAN DATA =====
            $form = new Form();
            
            $form->waktu = $request->waktu;
            $form->area = $request->area;
            $form->nama = json_encode($request->nama);
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

            // Proses upload semua foto
            foreach ($fotoFields as $field) {
                $paths = [];
                
                if ($request->hasFile($field)) {
                    $files = $request->file($field);
                    
                    if (!is_array($files)) {
                        $files = [$files];
                    }
                    
                    foreach ($files as $file) {
                        if ($file && $file->isValid()) {
                            $path = $file->store('uploads', 'public');
                            $paths[] = $path;
                            
                            Log::info("✅ Uploaded $field:", [
                                'path' => $path,
                                'original_name' => $file->getClientOriginalName(),
                                'size' => $file->getSize(),
                                'mime_type' => $file->getMimeType(),
                            ]);
                        }
                    }
                }
                
                $form->$field = !empty($paths) ? json_encode($paths) : null;
            }

            $form->save();

            Log::info('✅ Form saved successfully', ['id' => $form->id]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $form->id
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation Error:', [
                'errors' => $e->errors(),
                'files_received' => $request->allFiles(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('❌ Form Submission Error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() // Return pesan error yang spesifik
            ], 400);
        }
    }
}