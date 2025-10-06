<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Pastikan user adalah admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Total jawaban dari tabel laporan_pengamanan
        $totalJawaban = DB::table('laporan_pengamanan')->count();

        // 1. Data Waktu Jaga Shift
        $shiftCounts = DB::table('laporan_pengamanan')
            ->select('waktu', DB::raw('count(*) as total'))
            ->whereNotNull('waktu')
            ->groupBy('waktu')
            ->orderBy('waktu')
            ->get();

        $shiftData = [];
        $colors = ['#4A90E2', '#E94B3C', '#F5A623']; // Biru, Merah, Orange
        $shiftLabels = [
            'Shift 1 : 07.00 SD 15.00',
            'Shift 2 : 15.00 SD 23.00',
            'Shift 3 : 23.00 SD 07.00'
        ];

        foreach ($shiftCounts as $index => $shift) {
            $percentage = $totalJawaban > 0 ? ($shift->total / $totalJawaban) * 100 : 0;
            $shiftData[] = [
                'label' => $shiftLabels[$index] ?? "Shift " . ($index + 1),
                'count' => $shift->total,
                'percentage' => round($percentage, 1),
                'color' => $colors[$index] ?? '#cccccc'
            ];
        }

        // 2. Data Area Kerja
        $areaCounts = DB::table('laporan_pengamanan')
            ->select('area', DB::raw('count(*) as total'))
            ->whereNotNull('area')
            ->groupBy('area')
            ->orderBy('total', 'desc')
            ->get();

        $areaData = [];
        
        // Mapping warna dan label berdasarkan nilai area aktual
        $areaColorMap = [
            'Pos Jaga Bersama UP3 SBS' => '#4A90E2',  // Biru
            'UP2W VI' => '#E94B3C'                     // Merah
        ];

        $areaLabelMap = [
            'Pos Jaga Bersama UP3 SBS' => 'Pos Jaga Bersama UP3 SBS',
            'UP2W VI' => 'UP2W VI'
        ];

        foreach ($areaCounts as $area) {
            $percentage = $totalJawaban > 0 ? ($area->total / $totalJawaban) * 100 : 0;
            
            // Ambil label dan warna berdasarkan nilai area dari database
            $label = $areaLabelMap[$area->area] ?? $area->area;
            $color = $areaColorMap[$area->area] ?? '#cccccc';
            
            $areaData[] = [
                'label' => $label,
                'count' => $area->total,
                'percentage' => round($percentage, 0),
                'color' => $color
            ];
        }

        // 3. Data Nama Petugas Jaga
        // Ambil semua data nama
        $allNames = DB::table('laporan_pengamanan')
            ->whereNotNull('nama')
            ->where('nama', '!=', '')
            ->pluck('nama');

        // Pisahkan nama yang dipisah koma dan hitung
        $nameCount = [];
        
        foreach ($allNames as $nameString) {
            // Split berdasarkan koma dan bersihkan spasi
            $names = array_map('trim', explode(',', $nameString));
            
            foreach ($names as $name) {
                if (!empty($name)) {
                    // Normalisasi nama (uppercase dan hapus extra spaces)
                    $nameUpper = strtoupper(preg_replace('/\s+/', ' ', $name));
                    
                    if (isset($nameCount[$nameUpper])) {
                        $nameCount[$nameUpper]++;
                    } else {
                        $nameCount[$nameUpper] = 1;
                    }
                }
            }
        }

        // Sort by count descending
        arsort($nameCount);

        // Total nama individual (bukan total row)
        $totalNamaIndividual = array_sum($nameCount);

        $petugasData = [];
        foreach ($nameCount as $nama => $count) {
            $percentage = $totalNamaIndividual > 0 ? ($count / $totalNamaIndividual) * 100 : 0;
            $petugasData[] = [
                'nama' => $nama,
                'count' => $count,
                'percentage' => round($percentage, 1)
            ];
        }

        // 4. Data Penggunaan Seragam dan Kelengkapan Atribut
        $seragamCounts = DB::table('laporan_pengamanan')
            ->select('ketentuan_seragam', DB::raw('count(*) as total'))
            ->whereNotNull('ketentuan_seragam')
            ->groupBy('ketentuan_seragam')
            ->get();

        $seragamData = [];
        
        // Mapping warna dan label berdasarkan nilai ketentuan_seragam
        $seragamColorMap = [
            'Sesuai 100%' => '#4A90E2',     // Biru
            'Tidak Sesuai' => '#E94B3C'     // Merah
        ];

        $seragamLabelMap = [
            'Sesuai 100%' => 'Sesuai 100%',
            'Tidak Sesuai' => 'Tidak Sesuai'
        ];

        foreach ($seragamCounts as $seragam) {
            $percentage = $totalJawaban > 0 ? ($seragam->total / $totalJawaban) * 100 : 0;
            
            // Ambil label dan warna berdasarkan nilai ketentuan_seragam dari database
            $label = $seragamLabelMap[$seragam->ketentuan_seragam] ?? $seragam->ketentuan_seragam;
            $color = $seragamColorMap[$seragam->ketentuan_seragam] ?? '#cccccc';
            
            $seragamData[] = [
                'label' => $label,
                'count' => $seragam->total,
                'percentage' => round($percentage, 1),
                'color' => $color
            ];
        }

        // 5. Ambil foto-foto dari kolom foto_serahterima
        $fotoSerahterima = DB::table('laporan_pengamanan')
            ->select('id', 'foto_serahterima', 'tanggal', 'waktu')
            ->whereNotNull('foto_serahterima')
            ->where('foto_serahterima', '!=', '')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalFoto = $fotoSerahterima->count();

        return view('admin.dashboard', compact(
            'totalJawaban',
            'shiftData',
            'areaData',
            'petugasData',
            'seragamData',
            'fotoSerahterima',
            'totalFoto'
        ));
    }
}