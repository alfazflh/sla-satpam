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
        $colors = ['#4A90E2', '#E94B3C', '#F5A623'];
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
        
        $areaColorMap = [
            'Pos Jaga Bersama UP3 SBS' => '#4A90E2',
            'UP2W VI' => '#E94B3C'
        ];

        $areaLabelMap = [
            'Pos Jaga Bersama UP3 SBS' => 'Pos Jaga Bersama UP3 SBS',
            'UP2W VI' => 'UP2W VI'
        ];

        foreach ($areaCounts as $area) {
            $percentage = $totalJawaban > 0 ? ($area->total / $totalJawaban) * 100 : 0;
            
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
        $allNames = DB::table('laporan_pengamanan')
            ->whereNotNull('nama')
            ->where('nama', '!=', '')
            ->pluck('nama');

        $nameCount = [];
        
        foreach ($allNames as $nameString) {
            $names = array_map('trim', explode(',', $nameString));
            
            foreach ($names as $name) {
                if (!empty($name)) {
                    $nameUpper = strtoupper(preg_replace('/\s+/', ' ', $name));
                    
                    if (isset($nameCount[$nameUpper])) {
                        $nameCount[$nameUpper]++;
                    } else {
                        $nameCount[$nameUpper] = 1;
                    }
                }
            }
        }

        arsort($nameCount);

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
        
        $seragamColorMap = [
            'Sesuai 100%' => '#4A90E2',
            'Tidak Sesuai' => '#E94B3C'
        ];

        $seragamLabelMap = [
            'Sesuai 100%' => 'Sesuai 100%',
            'Tidak Sesuai' => 'Tidak Sesuai'
        ];

        foreach ($seragamCounts as $seragam) {
            $percentage = $totalJawaban > 0 ? ($seragam->total / $totalJawaban) * 100 : 0;
            
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
            ->select('id', 'foto_serahterima', 'created_at')
            ->whereNotNull('foto_serahterima')
            ->where('foto_serahterima', '!=', '')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalFoto = $fotoSerahterima->count();

        // 6. Data Kegiatan Pengamanan (dari kolom 'pengamanan')
        $pengamananCounts = DB::table('laporan_pengamanan')
            ->select('pengamanan', DB::raw('count(*) as total'))
            ->whereNotNull('pengamanan')
            ->groupBy('pengamanan')
            ->get();

        $pengamananData = [];
        
        $pengamananColorMap = [
            'Nol (0) tindak kriminal' => '#4A90E2',
            'Tidak Dilaksanakan' => '#E94B3C',
            'Terjadi Tindak Kriminal, Ancaman dan Gangguan Keamanan' => '#F5A623'
        ];

        $pengamananLabelMap = [
            'Nol (0) tindak kriminal' => 'Nol (0) tindak kriminal',
            'Tidak Dilaksanakan' => 'Tidak Dilaksanakan',
            'Terjadi Tindak Kriminal, Ancaman dan Gangguan Keamanan' => 'Terjadi Tindak Kriminal, Ancaman dan Gangguan Keamanan'
        ];

        foreach ($pengamananCounts as $pengamanan) {
            $percentage = $totalJawaban > 0 ? ($pengamanan->total / $totalJawaban) * 100 : 0;
            
            $label = $pengamananLabelMap[$pengamanan->pengamanan] ?? $pengamanan->pengamanan;
            $color = $pengamananColorMap[$pengamanan->pengamanan] ?? '#cccccc';
            
            $pengamananData[] = [
                'label' => $label,
                'count' => $pengamanan->total,
                'percentage' => round($percentage, 1),
                'color' => $color
            ];
        }


        // 7. Ambil foto-foto dari kolom foto_patroli
        $fotoPatroli = DB::table('laporan_pengamanan')
        ->select('id', 'foto_patroli', 'created_at')
        ->whereNotNull('foto_patroli')
        ->where('foto_patroli', '!=', '')
        ->orderBy('created_at', 'desc')
        ->get();

        $totalFotoPatroli = $fotoPatroli->count();

        // 8. Ambil data kronologi dari kolom kronologi_kriminal
        $kronologiData = DB::table('laporan_pengamanan')
        ->select('id', 'kronologi_kriminal', 'created_at')
        ->whereNotNull('kronologi_kriminal')
        ->where('kronologi_kriminal', '!=', '')
        ->orderBy('created_at', 'desc')
        ->get();

        $totalKronologi = $kronologiData->count();

        // 9. Data Fungsi Pengamanan Khusus (dari kolom 'fungsi_khusus')
$fungsiKhususCounts = DB::table('laporan_pengamanan')
->select('fungsi_khusus', DB::raw('count(*) as total'))
->whereNotNull('fungsi_khusus')
->groupBy('fungsi_khusus')
->get();

$fungsiKhususData = [];

$fungsiKhususColorMap = [
'Nol (0) tindak kriminal' => '#4A90E2',
'Terjadi tindak kriminal' => '#E94B3C',
'Nihil Kegiatan' => '#F5A623'
];

$fungsiKhususLabelMap = [
'Nol (0) tindak kriminal' => 'Nol (0) tindak kriminal',
'Terjadi tindak kriminal' => 'Terjadi tindak kriminal',
'Nihil Kegiatan' => 'Nihil Kegiatan'
];

foreach ($fungsiKhususCounts as $fungsi) {
$percentage = $totalJawaban > 0 ? ($fungsi->total / $totalJawaban) * 100 : 0;

$label = $fungsiKhususLabelMap[$fungsi->fungsi_khusus] ?? $fungsi->fungsi_khusus;
$color = $fungsiKhususColorMap[$fungsi->fungsi_khusus] ?? '#cccccc';

$fungsiKhususData[] = [
    'label' => $label,
    'count' => $fungsi->total,
    'percentage' => round($percentage, 1),
    'color' => $color
];
}

// 10. Ambil foto-foto dari kolom foto_lembur
$fotoLembur = DB::table('laporan_pengamanan')
->select('id', 'foto_lembur', 'created_at')
->whereNotNull('foto_lembur')
->where('foto_lembur', '!=', '')
->orderBy('created_at', 'desc')
->get();

$totalFotoLembur = $fotoLembur->count();

// 11. Ambil data kronologi dari kolom kronologi_gangguan
$kronologiGangguan = DB::table('laporan_pengamanan')
->select('id', 'kronologi_gangguan', 'created_at')
->whereNotNull('kronologi_gangguan')
->where('kronologi_gangguan', '!=', '')
->orderBy('created_at', 'desc')
->get();

$totalKronologiGangguan = $kronologiGangguan->count();

// 12. Data Memantau dan Mencatat (dari kolom 'memantau')
$memantauCounts = DB::table('laporan_pengamanan')
    ->select('memantau', DB::raw('count(*) as total'))
    ->whereNotNull('memantau')
    ->groupBy('memantau')
    ->get();

$memantauData = [];

$memantauColorMap = [
    'Tercatat, Tertib dan Aman' => '#4A90E2',
    'Tidak Tercatat' => '#E94B3C'
];

$memantauLabelMap = [
    'Tercatat, Tertib dan Aman' => 'Tercatat, Tertib dan Aman',
    'Tidak Tercatat' => 'Tidak Tercatat'
];

foreach ($memantauCounts as $memantau) {
    $percentage = $totalJawaban > 0 ? ($memantau->total / $totalJawaban) * 100 : 0;
    
    $label = $memantauLabelMap[$memantau->memantau] ?? $memantau->memantau;
    $color = $memantauColorMap[$memantau->memantau] ?? '#cccccc';
    
    $memantauData[] = [
        'label' => $label,
        'count' => $memantau->total,
        'percentage' => round($percentage, 1),
        'color' => $color
    ];
}

// 13. Ambil foto-foto dari kolom foto_tamu
$fotoTamu = DB::table('laporan_pengamanan')
    ->select('id', 'foto_tamu', 'created_at')
    ->whereNotNull('foto_tamu')
    ->where('foto_tamu', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalFotoTamu = $fotoTamu->count();

        // 14. Data Memberikan Pelayanan Informasi (dari kolom 'pelayanan')
        $layananCounts = DB::table('laporan_pengamanan')
            ->select('pelayanan', DB::raw('count(*) as total'))
            ->whereNotNull('pelayanan')
            ->groupBy('pelayanan')
            ->get();

        $layananData = [];

        $layananColorMap = [
            '100% Terpenuhi' => '#4A90E2',
            'Nihil Tamu' => '#E94B3C'
        ];

        $layananLabelMap = [
            '100% Terpenuhi' => '100% Terpenuhi',
            'Nihil Tamu' => 'Nihil Tamu'
        ];

        foreach ($layananCounts as $layanan) {
            $percentage = $totalJawaban > 0 ? ($layanan->total / $totalJawaban) * 100 : 0;
            
            $label = $layananLabelMap[$layanan->pelayanan] ?? $layanan->pelayanan;
            $color = $layananColorMap[$layanan->pelayanan] ?? '#cccccc';
            
            $layananData[] = [
                'label' => $label,
                'count' => $layanan->total,
                'percentage' => round($percentage, 1),
                'color' => $color
            ];
        }

// 15. Ambil foto-foto dari kolom foto_panduan
$fotoPanduan = DB::table('laporan_pengamanan')
    ->select('id', 'foto_panduan', 'created_at')
    ->whereNotNull('foto_panduan')
    ->where('foto_panduan', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalFotoPanduan = $fotoPanduan->count();

// 16. Data Fungsi Force Majure (dari kolom 'fungsi_force')
$fungsiForceCounts = DB::table('laporan_pengamanan')
    ->select('fungsi_force', DB::raw('count(*) as total'))
    ->whereNotNull('fungsi_force')
    ->groupBy('fungsi_force')
    ->get();

$fungsiForceData = [];

$fungsiForceColorMap = [
    'Dilaksanakan' => '#4A90E2',
    'Tidak Terjadi' => '#E94B3C'
];

$fungsiForceLabelMap = [
    'Dilaksanakan' => 'Dilaksanakan',
    'Tidak Terjadi' => 'Tidak Terjadi'
];

foreach ($fungsiForceCounts as $force) {
    $percentage = $totalJawaban > 0 ? ($force->total / $totalJawaban) * 100 : 0;
    
    $label = $fungsiForceLabelMap[$force->fungsi_force] ?? $force->fungsi_force;
    $color = $fungsiForceColorMap[$force->fungsi_force] ?? '#cccccc';
    
    $fungsiForceData[] = [
        'label' => $label,
        'count' => $force->total,
        'percentage' => round($percentage, 1),
        'color' => $color
    ];
}

// 17. Ambil foto-foto dari kolom foto_force
$fotoForce = DB::table('laporan_pengamanan')
    ->select('id', 'foto_force', 'created_at')
    ->whereNotNull('foto_force')
    ->where('foto_force', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalFotoForce = $fotoForce->count();

// 18. Data Penertiban Area Perpakiran (dari kolom 'penertiban')
$penertibanCounts = DB::table('laporan_pengamanan')
    ->select('penertiban', DB::raw('count(*) as total'))
    ->whereNotNull('penertiban')
    ->groupBy('penertiban')
    ->get();

$penertibanData = [];

$penertibanColorMap = [
    'Tertib' => '#4A90E2',
    'Tidak Tertib' => '#E94B3C'
];

$penertibanLabelMap = [
    'Tertib' => 'Tertib',
    'Tidak Tertib' => 'Tidak Tertib'
];

foreach ($penertibanCounts as $penertiban) {
    $percentage = $totalJawaban > 0 ? ($penertiban->total / $totalJawaban) * 100 : 0;
    
    $label = $penertibanLabelMap[$penertiban->penertiban] ?? $penertiban->penertiban;
    $color = $penertibanColorMap[$penertiban->penertiban] ?? '#cccccc';
    
    $penertibanData[] = [
        'label' => $label,
        'count' => $penertiban->total,
        'percentage' => round($percentage, 1),
        'color' => $color
    ];
}

// 19. Ambil foto-foto dari kolom foto_penertiban
$fotoPenertiban = DB::table('laporan_pengamanan')
    ->select('id', 'foto_penertiban', 'created_at')
    ->whereNotNull('foto_penertiban')
    ->where('foto_penertiban', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalFotoPenertiban = $fotoPenertiban->count();

// 20. Data Simulasi Tanggap Darurat (dari kolom 'simulasi')
$simulasiCounts = DB::table('laporan_pengamanan')
    ->select('simulasi', DB::raw('count(*) as total'))
    ->whereNotNull('simulasi')
    ->groupBy('simulasi')
    ->get();

$simulasiData = [];

$simulasiColorMap = [
    '100% Berpartisipasi' => '#4A90E2',
    'Tidak Berpartisipasi (Nihil Kegiatan)' => '#E94B3C'
];

$simulasiLabelMap = [
    '100% Berpartisipasi' => '100% Berpartisipasi',
    'Tidak Berpartisipasi (Nihil Kegiatan)' => 'Tidak Berpartisipasi (Nihil Kegiatan)'
];

foreach ($simulasiCounts as $simulasi) {
    $percentage = $totalJawaban > 0 ? ($simulasi->total / $totalJawaban) * 100 : 0;
    
    $label = $simulasiLabelMap[$simulasi->simulasi] ?? $simulasi->simulasi;
    $color = $simulasiColorMap[$simulasi->simulasi] ?? '#cccccc';
    
    $simulasiData[] = [
        'label' => $label,
        'count' => $simulasi->total,
        'percentage' => round($percentage, 1),
        'color' => $color
    ];
}

// 21. Ambil foto-foto dari kolom foto_simulasi
$fotoSimulasi = DB::table('laporan_pengamanan')
    ->select('id', 'foto_simulasi', 'created_at')
    ->whereNotNull('foto_simulasi')
    ->where('foto_simulasi', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalFotoSimulasi = $fotoSimulasi->count();

// 22. Data Penyegaran dan Kebugaran Fisik (dari kolom 'penyegaran')
$penyegaranCounts = DB::table('laporan_pengamanan')
    ->select('penyegaran', DB::raw('count(*) as total'))
    ->whereNotNull('penyegaran')
    ->groupBy('penyegaran')
    ->get();

$penyegaranData = [];

$penyegaranColorMap = [
    'Dilaksanakan' => '#4A90E2',
    'Tidak Ada Kegiatan' => '#E94B3C'
];

$penyegaranLabelMap = [
    'Dilaksanakan' => 'Dilaksanakan',
    'Tidak Ada Kegiatan' => 'Tidak Ada Kegiatan'
];

foreach ($penyegaranCounts as $penyegaran) {
    $percentage = $totalJawaban > 0 ? ($penyegaran->total / $totalJawaban) * 100 : 0;
    
    $label = $penyegaranLabelMap[$penyegaran->penyegaran] ?? $penyegaran->penyegaran;
    $color = $penyegaranColorMap[$penyegaran->penyegaran] ?? '#cccccc';
    
    $penyegaranData[] = [
        'label' => $label,
        'count' => $penyegaran->total,
        'percentage' => round($percentage, 1),
        'color' => $color
    ];
}

// 23. Ambil foto-foto dari kolom foto_penyegaran
$fotoPenyegaran = DB::table('laporan_pengamanan')
    ->select('id', 'foto_penyegaran', 'created_at')
    ->whereNotNull('foto_penyegaran')
    ->where('foto_penyegaran', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalFotoPenyegaran = $fotoPenyegaran->count();

// 24. Data Menerima dan Mendata Telepon (dari kolom 'telepon')
$teleponCounts = DB::table('laporan_pengamanan')
    ->select('telepon', DB::raw('count(*) as total'))
    ->whereNotNull('telepon')
    ->groupBy('telepon')
    ->get();

$teleponData = [];

$teleponColorMap = [
    'Ada pendataan' => '#4A90E2',
    'Tidak Ada' => '#E94B3C'
];

$teleponLabelMap = [
    'Ada pendataan' => 'Ada pendataan',
    'Tidak Ada' => 'Tidak Ada'
];

foreach ($teleponCounts as $telepon) {
    $percentage = $totalJawaban > 0 ? ($telepon->total / $totalJawaban) * 100 : 0;
    
    $label = $teleponLabelMap[$telepon->telepon] ?? $telepon->telepon;
    $color = $teleponColorMap[$telepon->telepon] ?? '#cccccc';
    
    $teleponData[] = [
        'label' => $label,
        'count' => $telepon->total,
        'percentage' => round($percentage, 1),
        'color' => $color
    ];
}

// 25. Ambil foto-foto dari kolom foto_telepon
$fotoTelepon = DB::table('laporan_pengamanan')
    ->select('id', 'foto_telepon', 'created_at')
    ->whereNotNull('foto_telepon')
    ->where('foto_telepon', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalFotoTelepon = $fotoTelepon->count();

// 26. Data Patroli Rutin (dari kolom 'rutin')
$rutinCounts = DB::table('laporan_pengamanan')
    ->select('rutin', DB::raw('count(*) as total'))
    ->whereNotNull('rutin')
    ->groupBy('rutin')
    ->get();

$rutinData = [];

// Default colors jika hanya ada 2 opsi
$defaultColors = ['#4A90E2', '#E94B3C', '#F5A623', '#50C878'];

foreach ($rutinCounts as $index => $rutin) {
    $percentage = $totalJawaban > 0 ? ($rutin->total / $totalJawaban) * 100 : 0;
    
    // Tentukan warna berdasarkan konten
    $color = '#cccccc'; // default
    
    // Cek jika mengandung kata kunci tertentu
    if (stripos($rutin->rutin, '100%') !== false || 
        stripos($rutin->rutin, 'Dilaksanakan') !== false || 
        stripos($rutin->rutin, 'Sesuai') !== false) {
        $color = '#4A90E2'; // Biru untuk positif
    } elseif (stripos($rutin->rutin, 'Tidak') !== false) {
        $color = '#E94B3C'; // Merah untuk negatif
    } else {
        $color = $defaultColors[$index % count($defaultColors)];
    }
    
    $rutinData[] = [
        'label' => $rutin->rutin, // Langsung pakai dari database
        'count' => $rutin->total,
        'percentage' => round($percentage, 1),
        'color' => $color
    ];
}

// 27. Ambil data titik patroli dari kolom titik
$titikData = DB::table('laporan_pengamanan')
    ->select('id', 'titik', 'created_at')
    ->whereNotNull('titik')
    ->where('titik', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalTitik = $titikData->count();

// 28. Ambil foto-foto dari kolom foto_rutin
$fotoRutin = DB::table('laporan_pengamanan')
    ->select('id', 'foto_rutin', 'created_at')
    ->whereNotNull('foto_rutin')
    ->where('foto_rutin', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalFotoRutin = $fotoRutin->count();

// 29. Data Pengecekan Sekitar Objek Pengamanan (dari kolom 'pengecekan')
$pengecekanCounts = DB::table('laporan_pengamanan')
    ->select('pengecekan', DB::raw('count(*) as total'))
    ->whereNotNull('pengecekan')
    ->groupBy('pengecekan')
    ->get();

$pengecekanData = [];

$pengecekanColorMap = [
    'Dilaksanakan' => '#4A90E2',
    'Tidak Dilaksanakan' => '#E94B3C'
];

$pengecekanLabelMap = [
    'Dilaksanakan' => 'Dilaksanakan',
    'Tidak Dilaksanakan' => 'Tidak Dilaksanakan'
];

foreach ($pengecekanCounts as $pengecekan) {
    $percentage = $totalJawaban > 0 ? ($pengecekan->total / $totalJawaban) * 100 : 0;
    
    $label = $pengecekanLabelMap[$pengecekan->pengecekan] ?? $pengecekan->pengecekan;
    $color = $pengecekanColorMap[$pengecekan->pengecekan] ?? '#cccccc';
    
    $pengecekanData[] = [
        'label' => $label,
        'count' => $pengecekan->total,
        'percentage' => round($percentage, 1),
        'color' => $color
    ];
}

// 30. Ambil foto-foto dari kolom foto_pengecekan
$fotoPengecekan = DB::table('laporan_pengamanan')
    ->select('id', 'foto_pengecekan', 'created_at')
    ->whereNotNull('foto_pengecekan')
    ->where('foto_pengecekan', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalFotoPengecekan = $fotoPengecekan->count();

// 31. Data Pengawasan Area Melalui CCTV (dari kolom 'cctv')
$cctvCounts = DB::table('laporan_pengamanan')
    ->select('cctv', DB::raw('count(*) as total'))
    ->whereNotNull('cctv')
    ->groupBy('cctv')
    ->get();

$cctvData = [];

$cctvColorMap = [
    '100% CCTV aman dan Tidak Ada Kejadian' => '#4A90E2',
    'CCTV Rusak / Ada Kejadian' => '#E94B3C'
];

$cctvLabelMap = [
    '100% CCTV aman dan Tidak Ada Kejadian' => '100% CCTV aman dan Tidak Ada Kejadian',
    'CCTV Rusak / Ada Kejadian' => 'CCTV Rusak / Ada Kejadian'
];

foreach ($cctvCounts as $cctv) {
    $percentage = $totalJawaban > 0 ? ($cctv->total / $totalJawaban) * 100 : 0;
    
    $label = $cctvLabelMap[$cctv->cctv] ?? $cctv->cctv;
    $color = $cctvColorMap[$cctv->cctv] ?? '#cccccc';
    
    $cctvData[] = [
        'label' => $label,
        'count' => $cctv->total,
        'percentage' => round($percentage, 1),
        'color' => $color
    ];
}

// 32. Ambil foto-foto dari kolom foto_cctv
$fotoCctv = DB::table('laporan_pengamanan')
    ->select('id', 'foto_cctv', 'created_at')
    ->whereNotNull('foto_cctv')
    ->where('foto_cctv', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalFotoCctv = $fotoCctv->count();

// 33. Ambil data kronologi dari kolom kronologi_cctv
$kronologiCctv = DB::table('laporan_pengamanan')
    ->select('id', 'kronologi_cctv', 'created_at')
    ->whereNotNull('kronologi_cctv')
    ->where('kronologi_cctv', '!=', '')
    ->orderBy('created_at', 'desc')
    ->get();

$totalKronologiCctv = $kronologiCctv->count();


return view('admin.dashboard', compact(
    'totalJawaban',
    'shiftData',
    'areaData',
    'petugasData',
    'seragamData',
    'fotoSerahterima',
    'totalFoto',
    'pengamananData',
    'fotoPatroli',
    'totalFotoPatroli',
    'kronologiData',
    'totalKronologi',
    'fungsiKhususData',
    'fotoLembur',
    'totalFotoLembur',
    'kronologiGangguan',
    'totalKronologiGangguan',
    'memantauData',
    'fotoTamu',
    'totalFotoTamu',
    'layananData',
    'fotoPanduan',
    'totalFotoPanduan',
    'fungsiForceData',
    'fotoForce',
    'totalFotoForce',
    'penertibanData',
    'fotoPenertiban',
    'totalFotoPenertiban',
    'simulasiData',
    'fotoSimulasi',
    'totalFotoSimulasi',
    'penyegaranData',
    'fotoPenyegaran',
    'totalFotoPenyegaran',
    'teleponData',  
    'fotoTelepon',       
    'totalFotoTelepon',
    'rutinData',          
    'titikData',          
    'totalTitik',       
    'fotoRutin',       
    'totalFotoRutin',
    'pengecekanData',     
    'fotoPengecekan',      
    'totalFotoPengecekan',
    'cctvData',      
    'fotoCctv',         
    'totalFotoCctv',    
    'kronologiCctv',      // BARU
    'totalKronologiCctv'  // BARU
));
        }
        }