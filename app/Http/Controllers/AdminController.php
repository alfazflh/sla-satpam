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
            ->get();

        $shiftData = [];
        $colors = ['#4A90E2', '#E94B3C', '#F5A623']; // Biru, Merah, Orange
        $shiftLabels = [
            'Shift 1 : 07.00 SD 15.00',
            'Shift 2 : 15.00 SD 23.00',
            'Shift 3 : 23.00 SD 07.00'
        ];

        foreach ($shiftCounts as $index => $shift) {
            $percentage = ($shift->total / $totalJawaban) * 100;
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
            ->get();

        $areaData = [];
        $areaColors = ['#4A90E2', '#E94B3C']; // Biru, Merah
        $areaLabels = [
            'Pos Jaga Bersama UP3 SBS',
            'UP2W VI'
        ];

        foreach ($areaCounts as $index => $area) {
            $percentage = ($area->total / $totalJawaban) * 100;
            $areaData[] = [
                'label' => $areaLabels[$index] ?? $area->area_kerja,
                'count' => $area->total,
                'percentage' => round($percentage, 0),
                'color' => $areaColors[$index] ?? '#cccccc'
            ];
        }

        // 3. Data Nama Petugas Jaga
        // Ambil semua data nama
        $allNames = DB::table('laporan_pengamanan')
            ->whereNotNull('nama')
            ->pluck('nama');

        // Pisahkan nama yang dipisah koma dan hitung
        $nameCount = [];
        foreach ($allNames as $nameString) {
            // Split berdasarkan koma
            $names = array_map('trim', explode(',', $nameString));
            
            foreach ($names as $name) {
                if (!empty($name)) {
                    $nameUpper = strtoupper($name);
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

        $petugasData = [];
        foreach ($nameCount as $nama => $count) {
            $percentage = ($count / $totalJawaban) * 100;
            $petugasData[] = [
                'nama' => $nama,
                'count' => $count,
                'percentage' => round($percentage, 1)
            ];
        }

        // Debug - hapus setelah berhasil
        // dd($totalJawaban, $shiftData, $areaData, $petugasData);

        return view('admin.dashboard', compact(
            'totalJawaban',
            'shiftData',
            'areaData',
            'petugasData'
        ));
    }
}