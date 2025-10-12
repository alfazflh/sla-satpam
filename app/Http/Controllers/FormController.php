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
        $validated = $request->validate([
            'waktu' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'nama' => 'required|array|min:1',
            'nama.*' => 'string|max:255',
            'ketentuan_seragam' => 'required|string|max:255',
            'pengamanan' => 'required|string|max:255',
            'kronologi_kriminal' => 'nullable|string|max:5000',
            'fungsi_khusus' => 'required|string|max:255',
            'kronologi_gangguan' => 'nullable|string|max:5000',
            'memantau' => 'required|string|max:255',
            'pelayanan' => 'required|string|max:255',
            'fungsi_force' => 'required|string|max:255',
            'penertiban' => 'required|string|max:255',
            'simulasi' => 'required|string|max:255',
            'penyegaran' => 'required|string|max:255',
            'telepon' => 'required|string|max:255',
            'rutin' => 'required|string|max:255',
            'titik' => 'nullable|integer|min:1',
            'pengecekan' => 'required|string|max:255',
            'cctv' => 'required|string|max:255',
            'kronologi_cctv' => 'nullable|string|max:5000',

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
            'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 'foto_panduan',
            'foto_force', 'foto_penertiban', 'foto_simulasi', 'foto_penyegaran',
            'foto_telepon', 'foto_rutin', 'foto_pengecekan', 'foto_cctv'
        ];

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

        return response()->json(['success' => true]);
    }
}