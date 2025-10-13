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
            // Validasi untuk SEMUA field (non-file DAN file)
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
                
                // File fields - KUNCI UTAMA: Validasi array dengan .*
                'foto_serahterima' => 'nullable|array',
                'foto_serahterima.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_patroli' => 'nullable|array',
                'foto_patroli.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_lembur' => 'nullable|array',
                'foto_lembur.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_tamu' => 'nullable|array',
                'foto_tamu.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_panduan' => 'nullable|array',
                'foto_panduan.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_force' => 'nullable|array',
                'foto_force.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_penertiban' => 'nullable|array',
                'foto_penertiban.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_simulasi' => 'nullable|array',
                'foto_simulasi.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_penyegaran' => 'nullable|array',
                'foto_penyegaran.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_telepon' => 'nullable|array',
                'foto_telepon.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_rutin' => 'nullable|array',
                'foto_rutin.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_pengecekan' => 'nullable|array',
                'foto_pengecekan.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
                
                'foto_cctv' => 'nullable|array',
                'foto_cctv.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200',
            ]);

            Log::info('✅ Validation passed (including files)');

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