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
        
        try {
            // Validasi - Ganti 'image' dengan 'file' dan explicit mimes
            $validated = $request->validate([
                // Non-file fields
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
                
                // File fields - Pake 'file' bukan 'image'
                'foto_serahterima' => 'nullable|array',
                'foto_serahterima.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_patroli' => 'nullable|array',
                'foto_patroli.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_lembur' => 'nullable|array',
                'foto_lembur.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_tamu' => 'nullable|array',
                'foto_tamu.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_panduan' => 'nullable|array',
                'foto_panduan.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_force' => 'nullable|array',
                'foto_force.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_penertiban' => 'nullable|array',
                'foto_penertiban.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_simulasi' => 'nullable|array',
                'foto_simulasi.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_penyegaran' => 'nullable|array',
                'foto_penyegaran.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_telepon' => 'nullable|array',
                'foto_telepon.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_rutin' => 'nullable|array',
                'foto_rutin.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_pengecekan' => 'nullable|array',
                'foto_pengecekan.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
                
                'foto_cctv' => 'nullable|array',
                'foto_cctv.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,bmp|max:51200',
            ]);

            Log::info('✅ Validation passed');

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
            Log::info('✅ Form saved successfully', ['id' => $form->id]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $form->id
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error', [
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
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $filename = pathinfo($originalName, PATHINFO_FILENAME);
                        $safeFilename = preg_replace('/[^A-Za-z0-9\-_]/', '_', $filename);
                        $uniqueFilename = $safeFilename . '_' . time() . '_' . uniqid() . '.' . $extension;
                        
                        // Store file
                        $path = $file->storeAs("uploads/{$field}", $uniqueFilename, 'public');
                        $paths[] = $path;
                        
                        Log::info("File uploaded: {$field}/{$uniqueFilename}");
                    } catch (\Exception $e) {
                        Log::error("File upload failed", [
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