<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        // Validasi dengan rules yang lebih realistic
        $validated = $request->validate([
            'waktu' => 'required|string|in:Shift 1 : 07.00 SD 15.00,Shift 2 : 15.00 SD 23.00,Shift 3 : 23.00 SD 07.00',
            'area' => 'required|string|in:Pos Jaga Bersama UP3 SBS,UP2W VI',
            'nama' => 'required|array|min:1',
            'nama.*' => 'string',
            
            // Field text
            'ketentuan_seragam' => 'required|string',
            'pengamanan' => 'required|string',
            'fungsi_khusus' => 'required|string',
            'memantau' => 'required|string',
            'pelayanan' => 'required|string',
            'fungsi_force' => 'required|string',
            'penertiban' => 'required|string',
            'simulasi' => 'required|string',
            'penyegaran' => 'required|string',
            'telepon' => 'required|string',
            'rutin' => 'required|string',
            'pengecekan' => 'required|string',
            'cctv' => 'required|string',
            
            // Teks panjang (optional)
            'kronologi_kriminal' => 'nullable|string|max:5000',
            'kronologi_gangguan' => 'nullable|string|max:5000',
            'kronologi_cctv' => 'nullable|string|max:5000',
            
            // Numeric fields
            'titik' => 'nullable|integer|min:1|max:100',
            
            // Foto fields - 5MB max per file
            'foto_serahterima' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_patroli' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_lembur' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_tamu' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_panduan' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_force' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_penertiban' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_simulasi' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_penyegaran' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_telepon' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_rutin' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_pengecekan' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'foto_cctv' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
        ], [
            // Custom error messages
            'foto_serahterima.max' => 'Foto serah terima tidak boleh lebih dari 5MB',
            'foto_patroli.max' => 'Foto patroli tidak boleh lebih dari 5MB',
            'foto_lembur.max' => 'Foto lembur tidak boleh lebih dari 5MB',
            'foto_tamu.max' => 'Foto tamu tidak boleh lebih dari 5MB',
            'foto_panduan.max' => 'Foto panduan tidak boleh lebih dari 5MB',
            'foto_force.max' => 'Foto force majeure tidak boleh lebih dari 5MB',
            'foto_penertiban.max' => 'Foto penertiban tidak boleh lebih dari 5MB',
            'foto_simulasi.max' => 'Foto simulasi tidak boleh lebih dari 5MB',
            'foto_penyegaran.max' => 'Foto penyegaran tidak boleh lebih dari 5MB',
            'foto_telepon.max' => 'Foto telepon tidak boleh lebih dari 5MB',
            'foto_rutin.max' => 'Foto rutin tidak boleh lebih dari 5MB',
            'foto_pengecekan.max' => 'Foto pengecekan tidak boleh lebih dari 5MB',
            'foto_cctv.max' => 'Foto CCTV tidak boleh lebih dari 5MB',
        ]);

        try {
            // Buat instance form baru
            $form = new Form();
            
            // Simpan field text
            $form->waktu = $validated['waktu'];
            $form->area = $validated['area'];
            $form->nama = implode(', ', $validated['nama']);
            
            $form->ketentuan_seragam = $validated['ketentuan_seragam'];
            $form->pengamanan = $validated['pengamanan'];
            $form->fungsi_khusus = $validated['fungsi_khusus'];
            $form->memantau = $validated['memantau'];
            $form->pelayanan = $validated['pelayanan'];
            $form->fungsi_force = $validated['fungsi_force'];
            $form->penertiban = $validated['penertiban'];
            $form->simulasi = $validated['simulasi'];
            $form->penyegaran = $validated['penyegaran'];
            $form->telepon = $validated['telepon'];
            $form->rutin = $validated['rutin'];
            $form->pengecekan = $validated['pengecekan'];
            $form->cctv = $validated['cctv'];
            
            // Optional text fields
            $form->kronologi_kriminal = $validated['kronologi_kriminal'] ?? null;
            $form->kronologi_gangguan = $validated['kronologi_gangguan'] ?? null;
            $form->kronologi_cctv = $validated['kronologi_cctv'] ?? null;
            $form->titik = $validated['titik'] ?? null;
            
            // Handle file uploads dengan error handling
            $photoFields = [
                'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 
                'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi', 
                'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 
                'foto_cctv'
            ];
            
            foreach ($photoFields as $field) {
                if ($request->hasFile($field)) {
                    try {
                        $file = $request->file($field);
                        
                        // Double check file size
                        if ($file->getSize() > 5242880) { // 5MB in bytes
                            \Log::warning("File $field terlalu besar: " . $file->getSize() . " bytes");
                            continue;
                        }
                        
                        // Store file dengan custom naming
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('laporan_satpam', $filename, 'public');
                        $form->$field = $path;
                        
                    } catch (\Exception $e) {
                        \Log::error("Error uploading $field: " . $e->getMessage());
                        // Continue tanpa file ini, jangan buat form gagal
                        continue;
                    }
                }
            }
            
            // Simpan ke database
            $form->save();
            
            // Return response
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Laporan berhasil disimpan',
                    'data' => $form
                ], 201);
            }
            
            return redirect()->back()->with('success', 'Laporan kegiatan berhasil disimpan!');
            
        } catch (\Exception $e) {
            \Log::error('Error saving form: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan laporan'
                ], 500);
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan laporan. Silakan coba lagi.');
        }
    }
}