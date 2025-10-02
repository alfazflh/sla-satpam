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

        // Total jawaban
        $totalJawaban = DB::table('waktu')->count(); // Sesuaikan nama tabel

        // 1. Data Waktu Jaga Shift
        $shiftCounts = DB::table('waktu')
            ->select('waktu_shift', DB::raw('count(*) as total'))
            ->groupBy('waktu_shift')
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
        $areaCounts = DB::table('area')
            ->select('area_kerja', DB::raw('count(*) as total'))
            ->groupBy('area_kerja')
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
        $petugasCounts = DB::table('nama')
            ->select('nama_petugas', DB::raw('count(*) as total'))
            ->groupBy('nama_petugas')
            ->orderBy('total', 'desc')
            ->get();

        $petugasData = [];
        foreach ($petugasCounts as $petugas) {
            $percentage = ($petugas->total / $totalJawaban) * 100;
            $petugasData[] = [
                'nama' => strtoupper($petugas->nama_petugas),
                'count' => $petugas->total,
                'percentage' => round($percentage, 1)
            ];
        }

        return view('admin.dashboard', compact(
            'totalJawaban',
            'shiftData',
            'areaData',
            'petugasData'
        ));
    }
}