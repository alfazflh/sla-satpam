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
        Log::info('Files:', array_keys($request->allFiles()));

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

            // Validasi manual untuk files
            $this->validateFiles($request);

            Log::info('✅ Validasi berhasil');

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
            Log::info('✅ FORM SAVED', ['id' => $form->id]);

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
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Validasi manual untuk files
     */
    private function validateFiles(Request $request)
    {
        $fotoFields = [
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu',
            'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi',
            'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
        ];

        $errors = [];
        $allowedMimes = ['jpg', 'jpeg', 'png', 'gif'];
        $maxSize = 51200; // 50MB dalam KB

        foreach ($fotoFields as $field) {
            if ($request->hasFile($field)) {
                $files = $request->file($field);
                
                // Pastikan files adalah array
                if (!is_array($files)) {
                    $files = [$files];
                }

                foreach ($files as $index => $file) {
                    // Validasi apakah valid file
                    if (!$file->isValid()) {
                        $errors[$field][] = "File ke-" . ($index + 1) . " tidak valid";
                        continue;
                    }

                    // Validasi mime type
                    $extension = strtolower($file->getClientOriginalExtension());
                    if (!in_array($extension, $allowedMimes)) {
                        $errors[$field][] = "File ke-" . ($index + 1) . " harus berupa gambar (jpg, jpeg, png, gif)";
                    }

                    // Validasi ukuran (dalam bytes)
                    if ($file->getSize() > ($maxSize * 1024)) {
                        $errors[$field][] = "File ke-" . ($index + 1) . " terlalu besar (max 50MB)";
                    }
                }
            }
        }

        if (!empty($errors)) {
            throw \Illuminate\Validation\ValidationException::withMessages($errors);
        }
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
            
            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    try {
                        $path = $file->store("uploads/$field", 'public');
                        $paths[] = $path;
                        Log::info("✅ File uploaded", [
                            'field' => $field,
                            'original_name' => $file->getClientOriginalName(),
                            'path' => $path,
                            'size' => $file->getSize()
                        ]);
                    } catch (\Exception $e) {
                        Log::error("❌ File upload failed", [
                            'field' => $field,
                            'file' => $file->getClientOriginalName(),
                            'error' => $e->getMessage()
                        ]);
                    }
                }
            }
        }
        
        return $paths ? json_encode($paths) : null;
    }
}