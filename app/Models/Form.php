<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'waktu', 'area', 'nama',
        'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu',
        'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi',
        'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan',
        'foto_cctv', 'ketentuan_seragam', 'pengamanan', 'kronologi_kriminal',
        'fungsi_khusus', 'kronologi_gangguan', 'memantau', 'pelayanan',
        'fungsi_force', 'penertiban', 'simulasi', 'penyegaran', 'telepon',
        'titik', 'rutin', 'pengecekan', 'cctv', 'kronologi_cctv'
    ];

    protected $casts = [
        'nama' => 'array',
        'foto_serahterima' => 'array',
        'foto_patroli' => 'array',
        'foto_lembur' => 'array',
        'foto_tamu' => 'array',
        'foto_panduan' => 'array',
        'foto_force' => 'array',
        'foto_penertiban' => 'array',
        'foto_simulasi' => 'array',
        'foto_penyegaran' => 'array',
        'foto_telepon' => 'array',
        'foto_rutin' => 'array',
        'foto_pengecekan' => 'array',
        'foto_cctv' => 'array',
    ];
}