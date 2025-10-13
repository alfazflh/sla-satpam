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
        Log::info('All Input:', $request->all());
        Log::info('All Files:', $request->allFiles());
        
        // DEBUG: Lihat raw struktur file
        foreach ($request->allFiles() as $key => $files) {
            Log::info("Field: $key", [
                'is_array' => is_array($files),
                'count' => is_array($files) ? count($files) : 1,
                'type' => gettype($files)
            ]);
        }

        try {
            // TANPA VALIDASI DULU - LANGSUNG SIMPAN
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

            // Simpan foto dengan cara yang PASTI BEKERJA
            $fotoFields = [
                'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu',
                'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi',
                'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
            ];

            foreach ($fotoFields as $field) {
                $paths = [];
                
                // Coba ambil file dengan berbagai cara
                if ($request->hasFile($field)) {
                    $files = $request->file($field);
                    Log::info("Processing field: $field", ['has_file' => true, 'type' => gettype($files)]);
                    
                    // Jika bukan array, jadikan array
                    if (!is_array($files)) {
                        $files = [$files];
                    }
                    
                    foreach ($files as $index => $file) {
                        if ($file && method_exists($file, 'isValid') && $file->isValid()) {
                            $path = $file->store("uploads/$field", 'public');
                            $paths[] = $path;
                            Log::info("File uploaded", ['field' => $field, 'index' => $index, 'path' => $path]);
                        }
                    }
                }
                
                $form->$field = $paths ? json_encode($paths) : null;
            }

            $form->save();
            Log::info('✅ FORM SAVED', ['id' => $form->id]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $form->id
            ], 200);

        } catch (\Exception $e) {
            Log::error('❌ ERROR', [
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
}