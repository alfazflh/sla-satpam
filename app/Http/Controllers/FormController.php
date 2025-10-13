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
        try {
            // ✅ Validasi input tanpa file (file dihandle manual)
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

            Log::info('✅ Basic validation PASSED');

            // Simpan data utama ke tabel
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

            // ✅ Handle semua upload foto (pakai format array: name="foto_xxx[]")
            $fotoFields = [
                'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu',
                'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi',
                'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
            ];

            foreach ($fotoFields as $field) {
                $form->$field = $this->handleFileUploadArray($request, $field);
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
                'line' => $e->getLine()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * ✅ Upload handler untuk field array: name="foto_xxx[]"
     */
    private function handleFileUploadArray(Request $request, string $field)
    {
        $paths = [];
        $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp', 'image/heic'];
        $maxSize = 51200 * 1024; // 50 MB

        if ($request->hasFile($field)) {
            $files = $request->file($field);
            if (!is_array($files)) $files = [$files];

            Log::info("📁 Processing {$field} - total " . count($files) . " files");

            foreach ($files as $index => $file) {
                if (!$file || !$file->isValid()) {
                    Log::warning("⚠️ Invalid file at {$field}[{$index}]");
                    continue;
                }

                // Validasi MIME
                if (!in_array($file->getMimeType(), $allowedMimes)) {
                    Log::warning("⚠️ Invalid MIME at {$field}[{$index}]: " . $file->getMimeType());
                    continue;
                }

                // Validasi ukuran
                if ($file->getSize() > $maxSize) {
                    Log::warning("⚠️ File terlalu besar at {$field}[{$index}]");
                    continue;
                }

                try {
                    $original = $file->getClientOriginalName();
                    $ext = $file->getClientOriginalExtension();
                    $nameOnly = pathinfo($original, PATHINFO_FILENAME);
                    $safeName = preg_replace('/[^A-Za-z0-9\-_]/', '_', $nameOnly);
                    $uniqueName = "{$safeName}_" . time() . '_' . uniqid() . ".{$ext}";

                    $path = $file->storeAs("uploads/{$field}", $uniqueName, 'public');
                    $paths[] = $path;

                    Log::info("✅ Uploaded {$field}[{$index}]: {$uniqueName}");
                } catch (\Exception $e) {
                    Log::error("❌ Upload failed at {$field}[{$index}]: " . $e->getMessage());
                }
            }
        }

        return $paths ? json_encode($paths) : null;
    }
}
