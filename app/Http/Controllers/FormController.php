<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'waktu' => 'required',
            'area' => 'required|string|max:255',
            'nama' => 'required|array',
            
            // Multiple photos validation
            'foto_serahterima.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_patroli.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_lembur.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_tamu.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_panduan.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_force.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_penertiban.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_simulasi.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_penyegaran.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_telepon.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_rutin.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_pengecekan.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
            'foto_cctv.*' => 'nullable|image|mimes:jpg,png,jpeg|max:51200',
        ]);

        // Simpan data non-foto dulu
        $data = $request->except([
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 
            'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi', 
            'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 
            'foto_cctv'
        ]);

        // Convert nama array ke JSON string
        $data['nama'] = json_encode($request->nama);

        // Array field foto
        $fotoFields = [
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 
            'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi', 
            'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 
            'foto_cctv'
        ];

        // Upload multiple photos untuk setiap field
        foreach ($fotoFields as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                
                foreach ($request->file($field) as $file) {
                    // Simpan file dan ambil path-nya
                    $path = $file->store('uploads', 'public');
                    $paths[] = $path;
                }
                
                // Simpan array paths sebagai JSON string
                $data[$field] = json_encode($paths);
            }
        }

        // Simpan ke database
        Form::create($data);

        return response()->json(['success' => true]);
    }
}