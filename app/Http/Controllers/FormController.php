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
            // PERBAIKAN: Gunakan 'image' validator yang lebih fleksibel
            // dan tambahkan nullable untuk array container
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

                // PERBAIKAN: Gunakan 'image' validator TANPA 'mimes' yang strict
                // ini lebih reliable dan sesuai dengan validasi image
                'foto_serahterima' => 'nullable|array',
                'foto_serahterima.*' => 'nullable|image|max:51200',
                
                'foto_patroli' => 'nullable|array',
                'foto_patroli.*' => 'nullable|image|max:51200',
                
                'foto_lembur' => 'nullable|array',
                'foto_lembur.*' => 'nullable|image|max:51200',
                
                'foto_tamu' => 'nullable|array',
                'foto_tamu.*' => 'nullable|image|max:51200',
                
                'foto_panduan' => 'nullable|array',
                'foto_panduan.*' => 'nullable|image|max:51200',
                
                'foto_force' => 'nullable|array',
                'foto_force.*' => 'nullable|image|max:51200',
                
                'foto_penertiban' => 'nullable|array',
                'foto_penertiban.*' => 'nullable|image|max:51200',
                
                'foto_simulasi' => 'nullable|array',
                'foto_simulasi.*' => 'nullable|image|max:51200',
                
                'foto_penyegaran' => 'nullable|array',
                'foto_penyegaran.*' => 'nullable|image|max:51200',
                
                'foto_telepon' => 'nullable|array',
                'foto_telepon.*' => 'nullable|image|max:51200',
                
                'foto_rutin' => 'nullable|array',
                'foto_rutin.*' => 'nullable|image|max:51200',
                
                'foto_pengecekan' => 'nullable|array',
                'foto_pengecekan.*' => 'nullable|image|max:51200',
                
                'foto_cctv' => 'nullable|array',
                'foto_cctv.*' => 'nullable|image|max:51200',
            ]);

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

            $fotoFields = [
                'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 
                'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi', 
                'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 
                'foto_cctv'
            ];

            foreach ($fotoFields as $field) {
                $paths = [];
                
                if ($request->hasFile($field)) {
                    $files = $request->file($field);
                    
                    if (!is_array($files)) {
                        $files = [$files];
                    }
                    
                    foreach ($files as $file) {
                        if ($file && $file->isValid()) {
                            // PERBAIKAN: Gunakan 'public' disk dengan custom path yang jelas
                            $path = $file->store('uploads', 'public');
                            $paths[] = $path;
                            
                            Log::info("✅ Uploaded $field:", [
                                'path' => $path,
                                'original_name' => $file->getClientOriginalName(),
                                'size' => $file->getSize(),
                                'mime_type' => $file->getMimeType(),
                            ]);
                        } else {
                            Log::warning("❌ Invalid file for $field:", [
                                'error' => $file ? $file->getErrorMessage() : 'null file',
                                'mime' => $file ? $file->getMimeType() : 'unknown'
                            ]);
                        }
                    }
                }
                
                $form->$field = !empty($paths) ? json_encode($paths) : null;
                
                Log::info("Field $field stored:", [
                    'count' => count($paths),
                    'value' => $form->$field
                ]);
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
                'input' => $request->except(['_token'])
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
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}