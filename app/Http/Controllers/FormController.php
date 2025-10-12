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
        // Validasi data teks + foto (multiple & optional)
        $validated = $request->validate([
            'waktu' => 'required|date',
            'area' => 'required|string|max:255',
            'nama' => 'required|string|max:255',

            // Semua foto boleh kosong & bisa banyak
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

        // Simpan data teks
        $form = new Form();
        $form->fill($request->except([
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 'foto_panduan',
            'foto_force', 'foto_penertiban', 'foto_simulasi', 'foto_penyegaran',
            'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
        ]));

        // Semua field foto
        $fotoFields = [
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 'foto_panduan',
            'foto_force', 'foto_penertiban', 'foto_simulasi', 'foto_penyegaran',
            'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
        ];

        // Simpan semua foto ke storage
        foreach ($fotoFields as $field) {
            $paths = [];
            if ($request->hasFile($field)) {
                foreach ($request->file($field) as $file) {
                    $paths[] = $file->store('uploads', 'public');
                }
            }
            $form->$field = !empty($paths) ? json_encode($paths) : null;
        }

        $form->save();

        return redirect()->back()->with('success', 'Form berhasil disimpan!');
    }
}
