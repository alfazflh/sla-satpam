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
        // Log semua data yang diterima untuk debugging
        Log::info('Form Data Received:', $request->all());

        try {
            // Validasi - HANYA waktu, area, nama yang REQUIRED
            // Sisanya NULLABLE sesuai database
            $validated = $request->validate([
                // Data Dasar - HANYA INI YANG REQUIRED
                'waktu' => 'required|string|max:255',
                'area' => 'required|string|max:255',
                'nama' => 'required|array|min:1',
                'nama.*' => 'string|max:255',

                // SEMUA FIELD LAINNYA NULLABLE
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

                // Semua foto NULLABLE
                'foto_serahterima' => 'nullable|array',
                'foto_serahterima.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_patroli' => 'nullable|array',
                'foto_patroli.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_lembur' => 'nullable|array',
                'foto_lembur.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_tamu' => 'nullable|array',
                'foto_tamu.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_panduan' => 'nullable|array',
                'foto_panduan.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_force' => 'nullable|array',
                'foto_force.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_penertiban' => 'nullable|array',
                'foto_penertiban.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_simulasi' => 'nullable|array',
                'foto_simulasi.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_penyegaran' => 'nullable|array',
                'foto_penyegaran.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_telepon' => 'nullable|array',
                'foto_telepon.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_rutin' => 'nullable|array',
                'foto_rutin.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_pengecekan' => 'nullable|array',
                'foto_pengecekan.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',

                'foto_cctv' => 'nullable|array',
                'foto_cctv.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            ]);

            // Buat instance Form baru
            $form = new Form();
            
            // Isi field teks
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

            // Array semua field foto
            $fotoFields = [
                'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 
                'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi', 
                'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 
                'foto_cctv'
            ];

            // Proses upload foto
            foreach ($fotoFields as $field) {
                $paths = [];
                if ($request->hasFile($field)) {
                    foreach ($request->file($field) as $file) {
                        $path = $file->store('uploads', 'public');
                        $paths[] = $path;
                        Log::info("Uploaded $field:", ['path' => $path]);
                    }
                }
                $form->$field = !empty($paths) ? json_encode($paths) : null;
            }

            // Simpan ke database
            $form->save();

            Log::info('Form saved successfully', ['id' => $form->id]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $form->id
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log error validasi
            Log::error('Validation Error:', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            // Log error umum
            Log::error('Form Submission Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}