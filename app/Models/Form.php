<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'waktu',
        'area',
        'nama',
        'ketentuan_seragam',
        'foto_serahterima',
        'pengamanan',
        'foto_patroli',
        'kronologi_kriminal',
        'fungsi_khusus',
        'foto_lembur',
        'kronologi_gangguan',
        'memantau',
        'foto_tamu',
        'pelayanan',
        'foto_panduan',
        'fungsi_force',
        'foto_force',
        'penertiban',
        'foto_penertiban',
        'simulasi',
        'foto_simulasi',
        'penyegaran',
        'foto_penyegaran',
        'telepon',
        'foto_telepon',
        'rutin',
        'titik',
        'foto_rutin',
        'pengecekan',
        'foto_pengecekan',
        'cctv',
        'foto_cctv',
        'kronologi_cctv',
    ];
}
