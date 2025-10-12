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
            // =========================
            // 1️⃣ VALIDASI DATA TEKS
            // =========================
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

                // ✅ VALIDASI FILE MULTIPLE (PERBAIKAN INTI)
                'foto_serahterima' => 'nullable|array',
                'foto_serahterima.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_patroli' => 'nullable|array',
                'foto_patroli.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_lembur' => 'nullable|array',
                'foto_lembur.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_tamu' => 'nullable|array',
                'foto_tamu.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_panduan' => 'nullable|array',
                'foto_panduan.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_force' => 'nullable|array',
                'foto_force.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_penertiban' => 'nullable|array',
                'foto_penertiban.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_simulasi' => 'nullable|array',
                'foto_simulasi.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_penyegaran' => 'nullable|array',
                'foto_penyegaran.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_telepon' => 'nullable|array',
                'foto_telepon.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_rutin' => 'nullable|array',
                'foto_rutin.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_pengecekan' => 'nullable|array',
                'foto_pengecekan.*' => 'image|mimes:jpg,jpeg,png|max:51200',

                'foto_cctv' => 'nullable|array',
                'foto_cctv.*' => 'image|mimes:jpg,jpeg,png|max:51200',
            ]);

            Log::info('✅ Semua validasi lulus.');

            // =========================
            // 2️⃣ SIMPAN DATA UTAMA
            // =========================
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

            // =========================
            // 3️⃣ UPLOAD SEMUA FOTO
            // =========================
            $fotoFields = [
                'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu',
                'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi',
                'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
            ];

            foreach ($fotoFields as $field) {
                $paths = [];

                if ($request->hasFile($field)) {
                    foreach ($request->file($field) as $file) {
                        if ($file && $file->isValid()) {
                            $paths[] = $file->store("uploads/$field", 'public');
                        }
                    }
                }

                $form->$field = !empty($paths) ? json_encode($paths) : null;
            }

            $form->save();

            Log::info('✅ FORM BERHASIL DISIMPAN', ['id' => $form->id]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $form->id
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ VALIDATION ERROR:', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('❌ GENERAL ERROR:', [
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
