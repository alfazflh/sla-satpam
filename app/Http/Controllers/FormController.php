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
        Log::info('Form Data Received:', $request->all());
        Log::info('Files Received:', $request->allFiles());

        try {
            // STEP 1: VALIDASI FIELD TEKS SAJA (semua boleh kosong, kecuali minimal waktu & area)
            $validated = $request->validate([
                'waktu' => 'nullable|string|max:255',
                'area' => 'nullable|string|max:255',
                'nama' => 'nullable|array',
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

            Log::info('✅ Text validation passed');

            // STEP 2: FIELD FOTO
            $fotoFields = [
                'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu',
                'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi',
                'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan',
                'foto_cctv'
            ];

            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg'];
            $maxFileSize = 50 * 1024 * 1024; // 50 MB

            foreach ($fotoFields as $field) {
                if ($request->hasFile($field)) {
                    $files = $request->file($field);
                    if (!is_array($files)) $files = [$files];

                    foreach ($files as $file) {
                        if (!$file) continue;

                        if (!$file->isValid()) {
                            Log::error("❌ Invalid file: $field", ['error' => $file->getErrorMessage()]);
                            throw new \Exception("$field: File tidak valid atau rusak");
                        }

                        $mimeType = $file->getMimeType();
                        if (!in_array($mimeType, $allowedMimes)) {
                            Log::error("❌ Invalid MIME type for $field", ['mime' => $mimeType]);
                            throw new \Exception("$field: Hanya JPEG/PNG yang diperbolehkan");
                        }

                        if ($file->getSize() > $maxFileSize) {
                            Log::error("❌ File terlalu besar: $field", ['size' => $file->getSize()]);
                            throw new \Exception("$field: Maksimum 50MB per file");
                        }
                    }
                }
            }

            Log::info('✅ File validation passed');

            // STEP 3: SIMPAN DATA KE DATABASE
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

            // STEP 4: SIMPAN SEMUA FOTO KE STORAGE
            foreach ($fotoFields as $field) {
                $paths = [];

                if ($request->hasFile($field)) {
                    $files = $request->file($field);
                    if (!is_array($files)) $files = [$files];

                    foreach ($files as $file) {
                        if ($file && $file->isValid()) {
                            $path = $file->store('uploads', 'public');
                            $paths[] = $path;

                            Log::info("✅ File uploaded: $field", [
                                'path' => $path,
                                'name' => $file->getClientOriginalName(),
                                'size' => $file->getSize(),
                                'mime' => $file->getMimeType(),
                            ]);
                        }
                    }
                }

                $form->$field = !empty($paths) ? json_encode($paths) : null;
            }

            $form->save();

            Log::info('=== FORM SUCCESSFULLY SAVED ===', ['id' => $form->id]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $form->id
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ VALIDATION EXCEPTION:', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('❌ GENERAL EXCEPTION:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
