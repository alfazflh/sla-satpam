<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'laporan_pengamanan';

    protected $fillable = [
        'waktu', 'area', 'nama', 'ketentuan_seragam', 'pengamanan', 
        'kronologi_kriminal', 'fungsi_khusus', 'kronologi_gangguan', 
        'memantau', 'pelayanan', 'fungsi_force', 'penertiban', 
        'simulasi', 'penyegaran', 'telepon', 'rutin', 'titik', 
        'pengecekan', 'cctv', 'kronologi_cctv',
        'foto_serahterima', 'foto_patroli', 'foto_lembur', 'foto_tamu', 
        'foto_panduan', 'foto_force', 'foto_penertiban', 'foto_simulasi', 
        'foto_penyegaran', 'foto_telepon', 'foto_rutin', 'foto_pengecekan', 
        'foto_cctv'
    ];

    // Accessor untuk foto - otomatis convert JSON ke array saat diambil
    protected function getFotoSerahterimarAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoPatroliAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoLemburAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoTamuAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoPanduanAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoForceAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoPenertibanAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoSimulasiAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoPenyegaranAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoTeleponAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoRutinAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoPengecekanAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    protected function getFotoCctvAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
}