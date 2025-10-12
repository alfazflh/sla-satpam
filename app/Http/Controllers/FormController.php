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
        // Validasi input
        $validated = $request->validate([
            'waktu' => 'required|date',
            'area' => 'required|string|max:255',
            'nama' => 'required|string|max:255',

            // Validasi untuk multiple upload (tiap field bisa banyak foto)
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

        // Simpan data teks ke DB
        $form = new Form();
        $form->fill($request->except([
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 'foto_panduan',
            'foto_force', 'foto_penertiban', 'foto_simulasi', 'foto_penyegaran',
            'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
        ]));

        // Daftar field foto
        $fotoFields = [
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 'foto_panduan',
            'foto_force', 'foto_penertiban', 'foto_simulasi', 'foto_penyegaran',
            'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
        ];

        // Upload semua foto dan simpan path-nya
        foreach ($fotoFields as $field) {
            $paths = [];
            if ($request->hasFile($field)) {
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('uploads', 'public');
                }
            }
            // Simpan array path sebagai JSON
            $form->$field = json_encode($paths);
        }

        $form->save();

        return redirect()->back()->with('success', 'Form berhasil disimpan!');
    }
}
