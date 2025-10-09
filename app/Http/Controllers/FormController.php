<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form; // model dari migrasi kemarin

class FormController extends Controller
{
    public function create()
    {
        return view('welcome'); // atau user.dashboard
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'waktu' => 'required|date',
            'area' => 'required|string|max:255',
            'nama' => 'required|string|max:255',

            // semua foto opsional, bisa nullable
            'foto_serahterima' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_patroli' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_lembur' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_tamu' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_panduan' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_force' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_penertiban' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_simulasi' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_penyegaran' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_telepon' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_rutin' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_pengecekan' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_cctv' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // simpan data ke DB
        $form = new Form();
        $form->fill($request->except([
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 'foto_panduan',
            'foto_force', 'foto_penertiban', 'foto_simulasi', 'foto_penyegaran',
            'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
        ]));

        // handle upload foto
        foreach ([
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 'foto_panduan',
            'foto_force', 'foto_penertiban', 'foto_simulasi', 'foto_penyegaran',
            'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
        ] as $field) {
            if ($request->hasFile($field)) {
                $form->$field = $request->file($field)->store('uploads', 'public');
            }
        }

        $form->save();

        return redirect()->back()->with('success', 'Form berhasil disimpan!');
        
    }
}
