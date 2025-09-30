<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanSatpam;
use Illuminate\Support\Facades\Storage;

class SatpamController extends Controller
{
    public function index()
    {
        return view('satpam.form');
    }

    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'waktu' => 'required',
            'area' => 'required',
            'nama' => 'required|array',
            'ketentuan_seragam' => 'nullable|string',
            'foto_serahterima' => 'nullable|image|max:5120',
            'pengamanan' => 'nullable|string',
            'foto_patroli' => 'nullable|image|max:5120',
            'kronologi_kriminal' => 'nullable|string',
            'fungsi_khusus' => 'nullable|string',
            'foto_lembur' => 'nullable|image|max:5120',
            'kronologi_gangguan' => 'nullable|string',
            'memantau' => 'nullable|string',
            'foto_tamu' => 'nullable|image|max:5120',
            'pelayanan' => 'nullable|string',
            'foto_panduan' => 'nullable|image|max:5120',
            'fungsi_force' => 'nullable|string',
            'foto_force' => 'nullable|image|max:5120',
            'penertiban' => 'nullable|string',
            'foto_penertiban' => 'nullable|image|max:5120',
            'simulasi' => 'nullable|string',
            'foto_simulasi' => 'nullable|image|max:5120',
            'penyegaran' => 'nullable|string',
            'foto_penyegaran' => 'nullable|image|max:5120',
            'telepon' => 'nullable|string',
            'foto_telepon' => 'nullable|image|max:5120',
            'rutin' => 'nullable|string',
            'titik' => 'nullable|integer',
            'foto_rutin' => 'nullable|image|max:5120',
            'pengecekan' => 'nullable|string',
            'foto_pengecekan' => 'nullable|image|max:5120',
            'cctv' => 'nullable|string',
            'foto_cctv' => 'nullable|image|max:5120',
            'kronologi_cctv' => 'nullable|string',
        ]);

        // Proses data
        $data = [
            'waktu' => $request->waktu,
            'area' => $request->area,
            'nama' => implode(', ', $request->nama),
            'ketentuan_seragam' => $request->ketentuan_seragam,
            'pengamanan' => $request->pengamanan,
            'kronologi_kriminal' => $request->kronologi_kriminal,
            'fungsi_khusus' => $request->fungsi_khusus,
            'kronologi_gangguan' => $request->kronologi_gangguan,
            'memantau' => $request->memantau,
            'pelayanan' => $request->pelayanan,
            'fungsi_force' => $request->fungsi_force,
            'penertiban' => $request->penertiban,
            'simulasi' => $request->simulasi,
            'penyegaran' => $request->penyegaran,
            'telepon' => $request->telepon,
            'rutin' => $request->rutin,
            'titik' => $request->titik,
            'pengecekan' => $request->pengecekan,
            'cctv' => $request->cctv,
            'kronologi_cctv' => $request->kronologi_cctv,
        ];

        // Upload files
        $fileFields = [
            'foto_serahterima',
            'foto_patroli',
            'foto_lembur',
            'foto_tamu',
            'foto_panduan',
            'foto_force',
            'foto_penertiban',
            'foto_simulasi',
            'foto_penyegaran',
            'foto_telepon',
            'foto_rutin',
            'foto_pengecekan',
            'foto_cctv'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('satpam', $filename, 'public');
                $data[$field] = $path;
            } else {
                $data[$field] = null;
            }
        }

        // Simpan ke database
        LaporanSatpam::create($data);

        return redirect()->route('satpam.index')->with('success', 'Laporan berhasil disimpan!');
    }

    public function list()
    {
        $laporan = LaporanSatpam::orderBy('created_at', 'desc')->paginate(20);
        return view('satpam.list', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = LaporanSatpam::findOrFail($id);
        return view('satpam.show', compact('laporan'));
    }
}