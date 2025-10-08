<x-app-layout>
    <div class="pt-10">
        <div class="py-12">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                @if(auth()->user()->role === 'admin')
                    
                    <!-- Card Welcome -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-gray-900">
                            <h2 class="text-2xl font-bold">Ringkasan</h2>
                            <p class="text-gray-600 mt-1">Form Pelaporan Satpam Pusharlis UP2W VI</p>
                        </div>
                    </div>
    
                    <!-- 1. Waktu Jaga Shift -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-m font-bold text-gray-900">1. Waktu Jaga Shift</h3>
                                    <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row items-center gap-6">
                                <div class="w-full md:w-1/4">
                                    <canvas id="shiftChart" width="300" height="300"></canvas>
                                </div>
                                <div class="w-full md:w-2/4 md:pl-8">
                                    <div class="space-y-3">
                                        @foreach($shiftData as $shift)
                                        <div class="flex items-center">
                                            <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $shift['color'] }}"></span>
                                            <span class="text-gray-700">{{ $shift['label'] }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- 2. Area Kerja -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-m font-bold text-gray-900">2. Area Kerja</h3>
                                    <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row items-center">
                                <div class="w-full md:w-1/4">
                                    <canvas id="areaChart" width="300" height="300"></canvas>
                                </div>
                                <div class="w-full md:w-2/4 md:pl-8 mt-4 md:mt-0">
                                    <div class="space-y-3">
                                        @foreach($areaData as $area)
                                        <div class="flex items-center">
                                            <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $area['color'] }}"></span>
                                            <span class="text-gray-700">{{ $area['label'] }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- 3. Nama Petugas Jaga -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-m font-bold text-gray-900">3. Nama Petugas Jaga</h3>
                                    <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                </div>
                            </div>
                            <div class="w-full overflow-auto">
                                <div style="height: {{ max(400, count($petugasData) * 30) }}px; min-height: 400px;">
                                    <canvas id="petugasChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Penggunaan Seragam dan Kelengkapan Atribut -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                1. Penggunaan Seragam dan Kelengkapan Atribut sesuai Ketentuan</h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Menggunakan seragam sesuai ketentuan yang berlaku</p>
                                <p class="text-gray-500 text-sm">( foto apel serah terima )</p>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                </div>
                            </div>
                        
                            <div class="flex flex-col md:flex-row items-center gap-6">
                                <div class="w-full md:w-1/4">
                                    <canvas id="seragamChart" width="300" height="300"></canvas>
                                </div>
                                <div class="w-full md:w-2/4 md:pl-8">
                                    <div class="space-y-3">
                                        @foreach($seragamData as $seragam)
                                        <div class="flex items-center">
                                            <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $seragam['color'] }}"></span>
                                            <span class="text-gray-700">{{ $seragam['label'] }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Dokumentasi Foto Serah Terima -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                Dokumentasi Penggunaan Seragam dan Kelengkapan Atribut sesuai Ketentuan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Lampirkan Foto Saat Apel Serah Terima Antar Shift</p>
                                <p class="text-sm text-gray-500">{{ $totalFoto }} jawaban</p>
                            </div>
                        </br>

                            <!-- Gallery Container -->
                            <div id="photoGallery" class="space-y-1">
                                <!-- Photos akan ditampilkan di sini via JavaScript -->
                            </div>

                            <!-- Tombol Load More -->
                            <div id="loadMoreContainer" class="mt-2 text-left" style="display: none;">
                                <button id="loadMoreBtn" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                    Muat Foto Lainnya
                                </button>
                                <p id="remainingCount" class="text-xs text-gray-500 mt-1 pl-1"></p>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Kegiatan Pengamanan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                2. Melaksanakan kegiatan pengamanan di sekitar objek pengamanan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Melaksanakan kegiatan pengamanan di sekitar obyek pengamanan.</p>
                                <p class="text-gray-500 text-sm">( foto patroli luar area kantor dan rumdin )</p>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                </div>
                            </div>
                        
                            <div class="flex flex-col md:flex-row items-center gap-6">
                                <div class="w-full md:w-1/4">
                                    <canvas id="pengamananChart" width="300" height="300"></canvas>
                                </div>
                                <div class="w-full md:w-2/4 md:pl-8">
                                    <div class="space-y-3">
                                        @foreach($pengamananData as $pengamanan)
                                        <div class="flex items-center">
                                            <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $pengamanan['color'] }}"></span>
                                            <span class="text-gray-700">{{ $pengamanan['label'] }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Dokumentasi Foto Patroli -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                Dokumentasi Nol (0) Tindakan Kriminal kegiatan pengamanan di sekitar objek pengamanan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Lampirkan Foto Patroli Kegiatan</p>
                                <p class="text-sm text-gray-500">{{ $totalFotoPatroli }} jawaban</p>
                            </div>
                        </br>

                            <!-- Gallery Container -->
                            <div id="photoGalleryPatroli" class="space-y-1">
                                <!-- Photos akan ditampilkan di sini via JavaScript -->
                            </div>

                            <!-- Tombol Load More -->
                            <div id="loadMoreContainerPatroli" class="mt-2 text-left" style="display: none;">
                                <button id="loadMoreBtnPatroli" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                    Muat Foto Lainnya
                                </button>
                                <p id="remainingCountPatroli" class="text-xs text-gray-500 mt-1 pl-1"></p>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Kronologi Kejadian -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                Laporan Terjadi Tindakan Kriminal kegiatan pengamanan di sekitar objek pengamanan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Tuliskan Kronologi Kejadian</p>
                                <p class="text-sm text-gray-500">{{ $totalKronologi }} jawaban</p>
                            </div>
                        </br>

                            <!-- Kronologi Container with Scroll -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div id="kronologiContainer" class="max-h-96 overflow-y-auto">
                                    @if($kronologiData->count() > 0)
                                        <div class="divide-y divide-gray-200">
                                            @foreach($kronologiData as $kronologi)
                                            <div class="space-y-2">
                                                    <div class="bg-gray-50 rounded-lg px-4 py-2">
                                                        <p class="text-sm text-gray-800">{{ $kronologi->kronologi_kriminal }}</p>
                                                    </div>
                                            </div>                                                                
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500 text-center py-8">Tidak ada kronologi yang tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 9. Fungsi Pengamanan Khusus -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                3. Melaksanakan fungsi pengamanan dalam kegiatan / peristiwa khusus (pameran, family day, dll) yang diselenggarakan PLN sesuai standar Sistem Manajemen Pengamanan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Melaksanakan fungsi pengamanan khusus</p>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                </div>
                            </div>
                        
                            <div class="flex flex-col md:flex-row items-center gap-6">
                                <div class="w-full md:w-1/4">
                                    <canvas id="fungsiKhususChart" width="300" height="300"></canvas>
                                </div>
                                <div class="w-full md:w-2/4 md:pl-8">
                                    <div class="space-y-3">
                                        @foreach($fungsiKhususData as $fungsi)
                                        <div class="flex items-center">
                                            <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $fungsi['color'] }}"></span>
                                            <span class="text-gray-700">{{ $fungsi['label'] }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 10. Dokumentasi Foto Lembur -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                Dokumentasi Melaksanakan fungsi pengamanan dalam kegiatan / peristiwa khusus (pameran, family day, dll) yang diselenggarakan PLN sesuai standar Sistem Manajemen Pengamanan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Lampirkan Foto Giat Lembur Kegiatan</p>
                                <p class="text-sm text-gray-500">{{ $totalFotoLembur }} jawaban</p>
                            </div>
                        </br>

                            <!-- Gallery Container -->
                            <div id="photoGalleryLembur" class="space-y-1">
                                <!-- Photos akan ditampilkan di sini via JavaScript -->
                            </div>

                            <!-- Tombol Load More -->
                            <div id="loadMoreContainerLembur" class="mt-2 text-left" style="display: none;">
                                <button id="loadMoreBtnLembur" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                    Muat Foto Lainnya
                                </button>
                                <p id="remainingCountLembur" class="text-xs text-gray-500 mt-1 pl-1"></p>
                            </div>
                        </div>
                    </div>

                    <!-- 11. Kronologi Gangguan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                Laporan gangguan Dokumentasi Melaksanakan fungsi pengamanan dalam kegiatan / peristiwa khusus (pameran, family day, dll) yang diselenggarakan PLN sesuai standar Sistem Manajemen Pengamanan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Tuliskan Kronologi Kejadian</p>
                                <p class="text-sm text-gray-500">{{ $totalKronologiGangguan }} jawaban</p>
                            </div>
                        </br>

                            <!-- Kronologi Container with Scroll -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div id="kronologiGangguanContainer" class="max-h-96 overflow-y-auto">
                                    @if($kronologiGangguan->count() > 0)
                                        <div class="divide-y divide-gray-200">
                                            @foreach($kronologiGangguan as $kronologi)
                                            <div class="space-y-2">
                                                <div class="bg-gray-50 rounded-lg px-4 py-2">
                                                    <p class="text-sm text-gray-800">{{ $kronologi->kronologi_gangguan }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500 text-center py-8">Tidak ada kronologi yang tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                            <!-- 12. Memantau dan Mencatat -->
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                <div class="bg-[#d9c99a] p-4">
                                    <h3 class="text-m font-bold text-gray-900">
                                        4. Memantau dan mencatat secara detail lalu lintas orang dan kendaraan yang masuk dan keluar di sekitar objek pengamanan
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <div class="-mt-4 mb-1">
                                        <p class="text-gray-700">Memantau dan mencatat lalu lintas orang dan kendaraan yang keluar dan masuk di obyek pengamanan.</p>
                                        <p class="text-gray-500 text-sm">( Foto jurnal, kendaraan dinas )</p>
                                    </div>
                                    <div class="flex justify-between items-center mb-2">
                                        <div>
                                            <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                        </div>
                                    </div>
                                
                                    <div class="flex flex-col md:flex-row items-center gap-6">
                                        <div class="w-full md:w-1/4">
                                            <canvas id="memantauChart" width="300" height="300"></canvas>
                                        </div>
                                        <div class="w-full md:w-2/4 md:pl-8">
                                            <div class="space-y-3">
                                                @foreach($memantauData as $memantau)
                                                <div class="flex items-center">
                                                    <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $memantau['color'] }}"></span>
                                                    <span class="text-gray-700">{{ $memantau['label'] }}</span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <!-- 13. Dokumentasi Foto Tamu -->
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                <div class="bg-[#d9c99a] p-4">
                                    <h3 class="text-m font-bold text-gray-900">
                                        Dokumentasi lalu lintas orang dan kendaraan yang masuk dan keluar di sekitar objek pengamanan
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <div class="-mt-4 mb-1">
                                        <p class="text-gray-700">Lampirkan Foto Jurnal Satpam dan pencatatan tamu/ kendaraan</p>
                                        <p class="text-sm text-gray-500">{{ $totalFotoTamu }} jawaban</p>
                                    </div>
                                </br>
        
                                    <!-- Gallery Container -->
                                    <div id="photoGalleryTamu" class="space-y-1">
                                        <!-- Photos akan ditampilkan di sini via JavaScript -->
                                    </div>
        
                                    <!-- Tombol Load More -->
                                    <div id="loadMoreContainerTamu" class="mt-2 text-left" style="display: none;">
                                        <button id="loadMoreBtnTamu" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                            Muat Foto Lainnya
                                        </button>
                                        <p id="remainingCountTamu" class="text-xs text-gray-500 mt-1 pl-1"></p>
                                    </div>
                                </div>
                            </div>

                                <!-- 14. Memberikan Pelayanan Informasi -->
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                    <div class="bg-[#d9c99a] p-4">
                                        <h3 class="text-m font-bold text-gray-900">
                                            5. Memberikan pelayanan informasi yang di butuhkan oleh tamu karyawan dan tenan sesuai standar SMP
                                        </h3>
                                    </div>
                                    <div class="p-6">
                                        <div class="-mt-4 mb-1">
                                            <p class="text-gray-700">Memberikan pelayanan informasi yang di butuhkan oleh tamu karyawan dan tenan sesuai standar SMP</p>
                                        </div>
                                        <div class="flex justify-between items-center mb-2">
                                            <div>
                                                <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                            </div>
                                        </div>
                                    
                                        <div class="flex flex-col md:flex-row items-center gap-6">
                                            <div class="w-full md:w-1/4">
                                                <canvas id="layananChart" width="300" height="300"></canvas>
                                            </div>
                                            <div class="w-full md:w-2/4 md:pl-8">
                                                <div class="space-y-3">
                                                    @foreach($layananData as $layanan)
                                                    <div class="flex items-center">
                                                        <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $layanan['color'] }}"></span>
                                                        <span class="text-gray-700">{{ $layanan['label'] }}</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <!-- 15. Dokumentasi Foto Panduan -->
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                    <div class="bg-[#d9c99a] p-4">
                                        <h3 class="text-m font-bold text-gray-900">
                                            Dokumentasi panduan keselamatan kerja ke mitra atau tamu
                                        </h3>
                                    </div>
                                    <div class="p-6">
                                        <div class="-mt-4 mb-1">
                                            <p class="text-gray-700">Lampirkan Dokumentasi panduan keselamatan kerja ke mitra atau tamu</p>
                                            <p class="text-sm text-gray-500">{{ $totalFotoPanduan }} jawaban</p>
                                        </div>
                                    </br>
            
                                        <!-- Gallery Container -->
                                        <div id="photoGalleryPanduan" class="space-y-1">
                                            <!-- Photos akan ditampilkan di sini via JavaScript -->
                                        </div>
            
                                        <!-- Tombol Load More -->
                                        <div id="loadMoreContainerPanduan" class="mt-2 text-left" style="display: none;">
                                            <button id="loadMoreBtnPanduan" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                                Muat Foto Lainnya
                                            </button>
                                            <p id="remainingCountPanduan" class="text-xs text-gray-500 mt-1 pl-1"></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- 16. Fungsi Pengamanan Force Majure -->
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                    <div class="bg-[#d9c99a] p-4">
                                        <h3 class="text-m font-bold text-gray-900">
                                            6. Melaksanakan fungsi pengamanan dalam kejadian force majure sesuai standar SMP
                                        </h3>
                                    </div>
                                    <div class="p-6">
                                        <div class="-mt-4 mb-1">
                                            <p class="text-gray-700">Melaksanakan fungsi pengamanan dalam kejadian force majure sesuai standar SMP</p>
                                            <p class="text-gray-500 text-sm">( foto pengamanan jika ada bencana alam, kerusuhan )</p>
                                        </div>
                                        <div class="flex justify-between items-center mb-2">
                                            <div>
                                                <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                            </div>
                                        </div>
                                    
                                        <div class="flex flex-col md:flex-row items-center gap-6">
                                            <div class="w-full md:w-1/4">
                                                <canvas id="fungsiForceChart" width="300" height="300"></canvas>
                                            </div>
                                            <div class="w-full md:w-2/4 md:pl-8">
                                                <div class="space-y-3">
                                                    @foreach($fungsiForceData as $force)
                                                    <div class="flex items-center">
                                                        <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $force['color'] }}"></span>
                                                        <span class="text-gray-700">{{ $force['label'] }}</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <!-- 17. Dokumentasi Foto Force Majure -->
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                    <div class="bg-[#d9c99a] p-4">
                                        <h3 class="text-m font-bold text-gray-900">
                                            Dokumentasi Pelaksanaan fungsi pengamanan dalam kejadian force majure sesuai standar SMP
                                        </h3>
                                    </div>
                                    <div class="p-6">
                                        <div class="-mt-4 mb-1">
                                            <p class="text-gray-700">Lampirkan Foto Pelaksanaan fungsi pengamanan dalam kejadian force majure sesuai standar SMP</p>
                                            <p class="text-sm text-gray-500">{{ $totalFotoForce }} jawaban</p>
                                        </div>
                                    </br>
            
                                        <!-- Gallery Container -->
                                        <div id="photoGalleryForce" class="space-y-1">
                                            <!-- Photos akan ditampilkan di sini via JavaScript -->
                                        </div>
            
                                        <!-- Tombol Load More -->
                                        <div id="loadMoreContainerForce" class="mt-2 text-left" style="display: none;">
                                            <button id="loadMoreBtnForce" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                                Muat Foto Lainnya
                                            </button>
                                            <p id="remainingCountForce" class="text-xs text-gray-500 mt-1 pl-1"></p>
                                        </div>
                                    </div>
                                </div>

                                    <!-- 18. Penertiban Area Perpakiran -->
                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                        <div class="bg-[#d9c99a] p-4">
                                            <h3 class="text-m font-bold text-gray-900">
                                                7. Melakukan penertiban area perpakiran sesuai standar SMP
                                            </h3>
                                        </div>
                                        <div class="p-6">
                                            <div class="-mt-4 mb-1">
                                                <p class="text-gray-700">Melakukan penertiban area perpakiran sesuai standar SMP</p>
                                                <p class="text-gray-500 text-sm">( Foto parkir kendaraan roda 2 dan roda 4 )</p>
                                            </div>
                                            <div class="flex justify-between items-center mb-2">
                                                <div>
                                                    <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                                </div>
                                            </div>
                                        
                                            <div class="flex flex-col md:flex-row items-center gap-6">
                                                <div class="w-full md:w-1/4">
                                                    <canvas id="penertibanChart" width="300" height="300"></canvas>
                                                </div>
                                                <div class="w-full md:w-2/4 md:pl-8">
                                                    <div class="space-y-3">
                                                        @foreach($penertibanData as $penertiban)
                                                        <div class="flex items-center">
                                                            <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $penertiban['color'] }}"></span>
                                                            <span class="text-gray-700">{{ $penertiban['label'] }}</span>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                                    <!-- 19. Dokumentasi Foto Penertiban -->
                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                        <div class="bg-[#d9c99a] p-4">
                                            <h3 class="text-m font-bold text-gray-900">
                                                Dokumentasi penertiban area perpakiran sesuai standar SMP
                                            </h3>
                                        </div>
                                        <div class="p-6">
                                            <div class="-mt-4 mb-1">
                                                <p class="text-gray-700">Lampirkan Foto penertiban area perpakiran sesuai standar SMP</p>
                                                <p class="text-sm text-gray-500">{{ $totalFotoPenertiban }} jawaban</p>
                                            </div>
                                        </br>
                
                                            <!-- Gallery Container -->
                                            <div id="photoGalleryPenertiban" class="space-y-1">
                                                <!-- Photos akan ditampilkan di sini via JavaScript -->
                                            </div>
                
                                            <!-- Tombol Load More -->
                                            <div id="loadMoreContainerPenertiban" class="mt-2 text-left" style="display: none;">
                                                <button id="loadMoreBtnPenertiban" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                                    Muat Foto Lainnya
                                                </button>
                                                <p id="remainingCountPenertiban" class="text-xs text-gray-500 mt-1 pl-1"></p>
                                            </div>
                                        </div>
                                    </div>

                                <!-- 20. Simulasi Tanggap Darurat -->
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                    <div class="bg-[#d9c99a] p-4">
                                        <h3 class="text-m font-bold text-gray-900">
                                            8. Mengikuti dan memahami kegiatan simulasi tanggap darurat yang di koordinasikan dengan bidang lain
                                        </h3>
                                    </div>
                                    <div class="p-6">
                                        <div class="-mt-4 mb-1">
                                            <p class="text-gray-700">Mengikuti dan memahami kegiatan simulasi tanggap darurat yang di koordinasikan dengan bidang lain.</p>
                                        </div>
                                        <div class="flex justify-between items-center mb-2">
                                            <div>
                                                <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                            </div>
                                        </div>
                                    
                                        <div class="flex flex-col md:flex-row items-center gap-6">
                                            <div class="w-full md:w-1/4">
                                                <canvas id="simulasiChart" width="300" height="300"></canvas>
                                            </div>
                                            <div class="w-full md:w-2/4 md:pl-8">
                                                <div class="space-y-3">
                                                    @foreach($simulasiData as $simulasi)
                                                    <div class="flex items-center">
                                                        <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $simulasi['color'] }}"></span>
                                                        <span class="text-gray-700">{{ $simulasi['label'] }}</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 21. Dokumentasi Foto Simulasi -->
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                    <div class="bg-[#d9c99a] p-4">
                                        <h3 class="text-m font-bold text-gray-900">
                                            Dokumentasi kegiatan simulasi tanggap darurat yang di koordinasikan dengan bidang lain
                                        </h3>
                                    </div>
                                    <div class="p-6">
                                        <div class="-mt-4 mb-1">
                                            <p class="text-gray-700">Lampirkan Foto kegiatan simulasi tanggap darurat yang di koordinasikan dengan bidang lain</p>
                                            <p class="text-sm text-gray-500">{{ $totalFotoSimulasi }} jawaban</p>
                                        </div>
                                    </br>

                                        <!-- Gallery Container -->
                                        <div id="photoGallerySimulasi" class="space-y-1">
                                            <!-- Photos akan ditampilkan di sini via JavaScript -->
                                        </div>

                                        <!-- Tombol Load More -->
                                        <div id="loadMoreContainerSimulasi" class="mt-2 text-left" style="display: none;">
                                            <button id="loadMoreBtnSimulasi" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                                Muat Foto Lainnya
                                            </button>
                                            <p id="remainingCountSimulasi" class="text-xs text-gray-500 mt-1 pl-1"></p>
                                        </div>
                                    </div>
                                </div>

                                            <!-- 22. Penyegaran dan Kebugaran Fisik -->
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                <div class="bg-[#d9c99a] p-4">
                                    <h3 class="text-m font-bold text-gray-900">
                                        9. Melaksanakan penyegaran dan kebugaran fisik sesuai standar SMP
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <div class="-mt-4 mb-1">
                                        <p class="text-gray-700">Melaksanakan penyegaran dan kebugaran fisik sesuai standar SMP</p>
                                    </div>
                                    <div class="flex justify-between items-center mb-2">
                                        <div>
                                            <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                        </div>
                                    </div>
                                
                                    <div class="flex flex-col md:flex-row items-center gap-6">
                                        <div class="w-full md:w-1/4">
                                            <canvas id="penyegaranChart" width="300" height="300"></canvas>
                                        </div>
                                        <div class="w-full md:w-2/4 md:pl-8">
                                            <div class="space-y-3">
                                                @foreach($penyegaranData as $penyegaran)
                                                <div class="flex items-center">
                                                    <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $penyegaran['color'] }}"></span>
                                                    <span class="text-gray-700">{{ $penyegaran['label'] }}</span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 23. Dokumentasi Foto Penyegaran -->
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                <div class="bg-[#d9c99a] p-4">
                                    <h3 class="text-m font-bold text-gray-900">
                                        Dokumentasi penyegaran dan kebugaran fisik sesuai standar SMP
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <div class="-mt-4 mb-1">
                                        <p class="text-gray-700">Lampirkan Foto penyegaran dan kebugaran fisik sesuai standar SMP</p>
                                        <p class="text-sm text-gray-500">{{ $totalFotoPenyegaran }} jawaban</p>
                                    </div>
                                </br>

                                    <!-- Gallery Container -->
                                    <div id="photoGalleryPenyegaran" class="space-y-1">
                                        <!-- Photos akan ditampilkan di sini via JavaScript -->
                                    </div>

                                    <!-- Tombol Load More -->
                                    <div id="loadMoreContainerPenyegaran" class="mt-2 text-left" style="display: none;">
                                        <button id="loadMoreBtnPenyegaran" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                            Muat Foto Lainnya
                                        </button>
                                        <p id="remainingCountPenyegaran" class="text-xs text-gray-500 mt-1 pl-1"></p>
                                    </div>
                                </div>
                            </div>

                    <!-- 24. Menerima dan Mendata Telepon -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                10. Menerima dan mendata telepon yang masuk di luar jam kerja /hari libur untuk dilaporkan ke kordinator
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Menerima dan mendata telepon yang masuk di luar jam kerja / hari libur untuk dilaporkan ke kordinator</p>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                </div>
                            </div>
                        
                            <div class="flex flex-col md:flex-row items-center gap-6">
                                <div class="w-full md:w-1/4">
                                    <canvas id="teleponChart" width="300" height="300"></canvas>
                                </div>
                                <div class="w-full md:w-2/4 md:pl-8">
                                    <div class="space-y-3">
                                        @foreach($teleponData as $telepon)
                                        <div class="flex items-center">
                                            <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $telepon['color'] }}"></span>
                                            <span class="text-gray-700">{{ $telepon['label'] }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 25. Dokumentasi Foto Telepon -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                Dokumentasi Menerima dan mendata telepon yang masuk di luar jam kerja /hari libur untuk dilaporkan ke kordinator
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Lampirkan Foto Jurnal</p>
                                <p class="text-sm text-gray-500">{{ $totalFotoTelepon }} jawaban</p>
                            </div>
                        </br>

                            <!-- Gallery Container -->
                            <div id="photoGalleryTelepon" class="space-y-1">
                                <!-- Photos akan ditampilkan di sini via JavaScript -->
                            </div>

                            <!-- Tombol Load More -->
                            <div id="loadMoreContainerTelepon" class="mt-2 text-left" style="display: none;">
                                <button id="loadMoreBtnTelepon" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                    Muat Foto Lainnya
                                </button>
                                <p id="remainingCountTelepon" class="text-xs text-gray-500 mt-1 pl-1"></p>
                            </div>
                        </div>
                    </div>

                                <!-- 26. Melakukan Patroli Rutin -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                11. Melakukan patroli rutin di sekitar obyek pengamanan sesuai titik patroli
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Melakukan patroli rutin di sekitar obyek pengamanan sesuai titik patroli</p>
                                <p class="text-gray-500 text-sm">( foto patroli di dalam dan luar ruangan )</p>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                </div>
                            </div>
                        
                            <div class="flex flex-col md:flex-row items-center gap-6">
                                <div class="w-full md:w-1/4">
                                    <canvas id="rutinChart" width="300" height="300"></canvas>
                                </div>
                                <div class="w-full md:w-2/4 md:pl-8">
                                    <div class="space-y-3">
                                        @foreach($rutinData as $rutin)
                                        <div class="flex items-center">
                                            <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $rutin['color'] }}"></span>
                                            <span class="text-gray-700">{{ $rutin['label'] }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 27. Jumlah Titik Patroli -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                Dokumentasi patroli rutin di sekitar obyek pengamanan sesuai titik patroli
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Jumlah Titik Patroli</p>
                                <p class="text-sm text-gray-500">{{ $totalTitik }} jawaban</p>
                            </div>
                        </br>

                            <!-- Titik Container with Scroll -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div id="titikContainer" class="max-h-96 overflow-y-auto">
                                    @if($titikData->count() > 0)
                                        <div class="divide-y divide-gray-200">
                                            @foreach($titikData as $titik)
                                            <div class="space-y-2">
                                                <div class="bg-gray-50 rounded-lg px-4 py-2">
                                                    <p class="text-sm text-gray-800">{{ $titik->titik }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500 text-center py-8">Tidak ada data titik patroli yang tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 28. Dokumentasi Foto Patroli Rutin -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                Dokumentasi patroli rutin di sekitar obyek pengamanan sesuai titik patroli
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Lampirkan Foto patroli rutin di sekitar obyek pengamanan sesuai titik patroli</p>
                                <p class="text-sm text-gray-500">{{ $totalFotoRutin }} jawaban</p>
                            </div>
                        </br>

                            <!-- Gallery Container -->
                            <div id="photoGalleryRutin" class="space-y-1">
                                <!-- Photos akan ditampilkan di sini via JavaScript -->
                            </div>

                            <!-- Tombol Load More -->
                            <div id="loadMoreContainerRutin" class="mt-2 text-left" style="display: none;">
                                <button id="loadMoreBtnRutin" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                    Muat Foto Lainnya
                                </button>
                                <p id="remainingCountRutin" class="text-xs text-gray-500 mt-1 pl-1"></p>
                            </div>
                        </div>
                    </div>

                    <!-- 29. Pengecekan Sekitar Objek Pengamanan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                12. Melakukan pengecekan sekitar objek pengamanan setelah jam pulang kantor dan mematikan listrik dan benda elektronik
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Melakukan pengecekan sekitar objek pengamanan setelah jam pulang kantor dan mematikan listrik dan benda elektronik</p>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                </div>
                            </div>
                        
                            <div class="flex flex-col md:flex-row items-center gap-6">
                                <div class="w-full md:w-1/4">
                                    <canvas id="pengecekanChart" width="300" height="300"></canvas>
                                </div>
                                <div class="w-full md:w-2/4 md:pl-8">
                                    <div class="space-y-3">
                                        @foreach($pengecekanData as $pengecekan)
                                        <div class="flex items-center">
                                            <span class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $pengecekan['color'] }}"></span>
                                            <span class="text-gray-700">{{ $pengecekan['label'] }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 30. Dokumentasi Foto Pengecekan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="bg-[#d9c99a] p-4">
                            <h3 class="text-m font-bold text-gray-900">
                                Dokumentasi pengecekan sekitar objek pengamanan setelah jam pulang kantor dan mematikan listrik dan benda elektronik
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="-mt-4 mb-1">
                                <p class="text-gray-700">Lampirkan Foto pengecekan sekitar objek pengamanan setelah jam pulang kantor dan mematikan listrik dan benda elektronik</p>
                                <p class="text-sm text-gray-500">{{ $totalFotoPengecekan }} jawaban</p>
                            </div>
                        </br>

                            <!-- Gallery Container -->
                            <div id="photoGalleryPengecekan" class="space-y-1">
                                <!-- Photos akan ditampilkan di sini via JavaScript -->
                            </div>

                            <!-- Tombol Load More -->
                            <div id="loadMoreContainerPengecekan" class="mt-2 text-left" style="display: none;">
                                <button id="loadMoreBtnPengecekan" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium py-1 px-3 rounded-md transition duration-150">
                                    Muat Foto Lainnya
                                </button>
                                <p id="remainingCountPengecekan" class="text-xs text-gray-500 mt-1 pl-1"></p>
                            </div>
                        </div>
                    </div>


    
                @else
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ __("Anda tidak memiliki akses ke halaman ini.") }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    @if(auth()->user()->role === 'admin')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        const shiftData = @json($shiftData);
        const areaData = @json($areaData);
        const petugasData = @json($petugasData);
        const seragamData = @json($seragamData);
        const fotoData = @json($fotoSerahterima);
        const pengamananData = @json($pengamananData);
        const fotoPatroliData = @json($fotoPatroli);
        const fungsiKhususData = @json($fungsiKhususData);
        const fotoLemburData = @json($fotoLembur);
        const memantauData = @json($memantauData);
        const fotoTamuData = @json($fotoTamu);
        const layananData = @json($layananData);
        const fotoPanduanData = @json($fotoPanduan);
        const fungsiForceData = @json($fungsiForceData);
        const fotoForceData = @json($fotoForce);
        const penertibanData = @json($penertibanData);
        const fotoPenertibanData = @json($fotoPenertiban);
        const simulasiData = @json($simulasiData);
        const fotoSimulasiData = @json($fotoSimulasi);
        const penyegaranData = @json($penyegaranData);
        const fotoPenyegaranData = @json($fotoPenyegaran);
        const teleponData = @json($teleponData);
        const fotoTeleponData = @json($fotoTelepon);
        const rutinData = @json($rutinData);
        const titikDataList = @json($titikData);
        const fotoRutinData = @json($fotoRutin);
        const pengecekanData = @json($pengecekanData);
        const fotoPengecekanData = @json($fotoPengecekan);

        console.log('Shift Data:', shiftData);
        console.log('Area Data:', areaData);
        console.log('Petugas Data:', petugasData);
        console.log('Seragam Data:', seragamData);
        console.log('Foto Data:', fotoData);
        console.log('Pengamanan Data:', pengamananData);
        console.log('Foto Patroli Data:', fotoPatroliData);
        console.log('Fungsi Khusus Data:', fungsiKhususData);
        console.log('Foto Lembur Data:', fotoLemburData);
        console.log('Memantau Data:', memantauData);
        console.log('Foto Tamu Data:', fotoTamuData);
        console.log('Layanan Data:', layananData);
        console.log('Foto Panduan Data:', fotoPanduanData);
        console.log('Fungsi Force Data:', fungsiForceData);
        console.log('Foto Force Data:', fotoForceData);
        console.log('Penertiban Data:', penertibanData);
        console.log('Foto Penertiban Data:', fotoPenertibanData);
        console.log('Simulasi Data:', simulasiData);
        console.log('Foto Simulasi Data:', fotoSimulasiData);
        console.log('Penyegaran Data:', penyegaranData);
        console.log('Foto Penyegaran Data:', fotoPenyegaranData);
        console.log('Telepon Data:', teleponData);
        console.log('Foto Telepon Data:', fotoTeleponData);
        console.log('Rutin Data:', rutinData);
        console.log('Titik Data:', titikDataList);
        console.log('Foto Rutin Data:', fotoRutinData);

        // Chart 1: Waktu Jaga Shift (Pie Chart)
        const shiftCtx = document.getElementById('shiftChart').getContext('2d');
        new Chart(shiftCtx, {
            type: 'pie',
            data: {
                labels: shiftData.map(item => item.label),
                datasets: [{
                    data: shiftData.map(item => item.percentage),
                    backgroundColor: shiftData.map(item => item.color),
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed.toFixed(1) + '%';
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 16
                        },
                        formatter: (value) => {
                            return value.toFixed(1) + '%';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Chart 2: Area Kerja (Pie Chart)
        const areaCtx = document.getElementById('areaChart').getContext('2d');
        new Chart(areaCtx, {
            type: 'pie',
            data: {
                labels: areaData.map(item => item.label),
                datasets: [{
                    data: areaData.map(item => item.percentage),
                    backgroundColor: areaData.map(item => item.color),
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed.toFixed(0) + '%';
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 16
                        },
                        formatter: (value) => {
                            return value.toFixed(0) + '%';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Chart 3: Nama Petugas Jaga (Horizontal Bar Chart)
        const maxValue = Math.max(...petugasData.map(item => item.count));
        let stepSize = 1;
        if (maxValue >= 100) {
            stepSize = 100;
        } else if (maxValue >= 10) {
            stepSize = 10;
        }

        const petugasCtx = document.getElementById('petugasChart').getContext('2d');
        new Chart(petugasCtx, {
            type: 'bar',
            data: {
                labels: petugasData.map(item => item.nama),
                datasets: [{
                    data: petugasData.map(item => item.count),
                    backgroundColor: '#d9c99a',
                    borderWidth: 0,
                    barThickness: 20
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        right: 70
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.x + ' (' + petugasData[context.dataIndex].percentage + '%)';
                            }
                        }
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#374151',
                        font: { size: 10, weight: 'normal' },
                        formatter: (value, context) => {
                            const percentage = petugasData[context.dataIndex].percentage;
                            return value + ' (' + percentage + '%)';
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { display: false },
                        ticks: {
                            stepSize: stepSize,
                            precision: 0,
                            font: { size: 10 }
                        }
                    },
                    y: {
                        grid: { display: false },
                        ticks: {
                            autoSkip: false,
                            font: { size: 11 }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Chart 4: Penggunaan Seragam (Pie Chart)
        const seragamCtx = document.getElementById('seragamChart').getContext('2d');
        new Chart(seragamCtx, {
            type: 'pie',
            data: {
                labels: seragamData.map(item => item.label),
                datasets: [{
                    data: seragamData.map(item => item.percentage),
                    backgroundColor: seragamData.map(item => item.color),
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed.toFixed(1) + '%';
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 16
                        },
                        formatter: (value) => {
                            return value.toFixed(1) + '%';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Photo Gallery Logic
        let currentIndex = 0;
        const photosPerLoad = 5;
        const initialLoad = 6;

        function extractFilename(path) {
            if (!path) return '';
            return path.split('/').pop();
        }

        function renderPhotos(startIndex, count) {
            const gallery = document.getElementById('photoGallery');
            const endIndex = Math.min(startIndex + count, fotoData.length);

            for (let i = startIndex; i < endIndex; i++) {
                const foto = fotoData[i];
                const filename = extractFilename(foto.foto_serahterima);
                
                const photoItem = document.createElement('div');
                photoItem.className = 'flex items-center py-2 px-3 border border-gray-200 rounded hover:bg-gray-50 transition cursor-pointer';
                photoItem.onclick = () => window.open('/storage/' + foto.foto_serahterima, '_blank');
                
                photoItem.innerHTML = `
                    <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-700 text-sm truncate block max-w-full">${filename}</span>
                `;
                
                gallery.appendChild(photoItem);
            }

            currentIndex = endIndex;
            updateLoadMoreButton();
        }

        function updateLoadMoreButton() {
            const container = document.getElementById('loadMoreContainer');
            const btn = document.getElementById('loadMoreBtn');
            const remaining = document.getElementById('remainingCount');
            const remainingPhotos = fotoData.length - currentIndex;

            if (remainingPhotos > 0) {
                container.style.display = 'block';
                remaining.textContent = `${remainingPhotos} file lainnya`;
            } else {
                container.style.display = 'none';
            }
        }

        document.getElementById('loadMoreBtn').addEventListener('click', function() {
            renderPhotos(currentIndex, photosPerLoad);
        });

        // Initial render
        if (fotoData.length > 0) {
            renderPhotos(0, initialLoad);
        } else {
            document.getElementById('photoGallery').innerHTML = '<p class="text-gray-500 text-center py-8">Tidak ada foto yang tersedia</p>';
        }

            // Chart 6: Kegiatan Pengamanan (Pie Chart)
        const pengamananCtx = document.getElementById('pengamananChart').getContext('2d');
        new Chart(pengamananCtx, {
            type: 'pie',
            data: {
                labels: pengamananData.map(item => item.label),
                datasets: [{
                    data: pengamananData.map(item => item.percentage),
                    backgroundColor: pengamananData.map(item => item.color),
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed.toFixed(1) + '%';
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 16
                        },
                        formatter: (value) => {
                            return value.toFixed(1) + '%';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Photo Gallery Logic untuk Foto Patroli
        let currentIndexPatroli = 0;
        const photosPerLoadPatroli = 5;
        const initialLoadPatroli = 6;

        function renderPhotosPatroli(startIndex, count) {
            const gallery = document.getElementById('photoGalleryPatroli');
            const endIndex = Math.min(startIndex + count, fotoPatroliData.length);

            for (let i = startIndex; i < endIndex; i++) {
                const foto = fotoPatroliData[i];
                const filename = extractFilename(foto.foto_patroli);
                
                const photoItem = document.createElement('div');
                photoItem.className = 'flex items-center py-2 px-3 border border-gray-200 rounded hover:bg-gray-50 transition cursor-pointer';
                photoItem.onclick = () => window.open('/storage/' + foto.foto_patroli, '_blank');
                
                photoItem.innerHTML = `
                    <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-700 text-sm truncate block max-w-full">${filename}</span>
                `;
                
                gallery.appendChild(photoItem);
            }

            currentIndexPatroli = endIndex;
            updateLoadMoreButtonPatroli();
        }

        function updateLoadMoreButtonPatroli() {
            const container = document.getElementById('loadMoreContainerPatroli');
            const btn = document.getElementById('loadMoreBtnPatroli');
            const remaining = document.getElementById('remainingCountPatroli');
            const remainingPhotos = fotoPatroliData.length - currentIndexPatroli;

            if (remainingPhotos > 0) {
                container.style.display = 'block';
                remaining.textContent = `${remainingPhotos} file lainnya`;
            } else {
                container.style.display = 'none';
            }
        }

        document.getElementById('loadMoreBtnPatroli').addEventListener('click', function() {
            renderPhotosPatroli(currentIndexPatroli, photosPerLoadPatroli);
        });

        // Initial render untuk foto patroli
        if (fotoPatroliData.length > 0) {
            renderPhotosPatroli(0, initialLoadPatroli);
        } else {
            document.getElementById('photoGalleryPatroli').innerHTML = '<p class="text-gray-500 text-center py-8">Tidak ada foto yang tersedia</p>';
        }

        const fungsiKhususCtx = document.getElementById('fungsiKhususChart').getContext('2d');
        new Chart(fungsiKhususCtx, {
            type: 'pie',
            data: {
                labels: fungsiKhususData.map(item => item.label),
                datasets: [{
                    data: fungsiKhususData.map(item => item.percentage),
                    backgroundColor: fungsiKhususData.map(item => item.color),
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed.toFixed(1) + '%';
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 16
                        },
                        formatter: (value) => {
                            return value.toFixed(1) + '%';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Photo Gallery Logic untuk Foto Lembur
        let currentIndexLembur = 0;
        const photosPerLoadLembur = 5;
        const initialLoadLembur = 6;

        function renderPhotosLembur(startIndex, count) {
            const gallery = document.getElementById('photoGalleryLembur');
            const endIndex = Math.min(startIndex + count, fotoLemburData.length);

            for (let i = startIndex; i < endIndex; i++) {
                const foto = fotoLemburData[i];
                const filename = extractFilename(foto.foto_lembur);
                
                const photoItem = document.createElement('div');
                photoItem.className = 'flex items-center py-2 px-3 border border-gray-200 rounded hover:bg-gray-50 transition cursor-pointer';
                photoItem.onclick = () => window.open('/storage/' + foto.foto_lembur, '_blank');
                
                photoItem.innerHTML = `
                    <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-700 text-sm truncate block max-w-full">${filename}</span>
                `;
                
                gallery.appendChild(photoItem);
            }

            currentIndexLembur = endIndex;
            updateLoadMoreButtonLembur();
        }

        function updateLoadMoreButtonLembur() {
            const container = document.getElementById('loadMoreContainerLembur');
            const remaining = document.getElementById('remainingCountLembur');
            const remainingPhotos = fotoLemburData.length - currentIndexLembur;

            if (remainingPhotos > 0) {
                container.style.display = 'block';
                remaining.textContent = `${remainingPhotos} file lainnya`;
            } else {
                container.style.display = 'none';
            }
        }

        document.getElementById('loadMoreBtnLembur').addEventListener('click', function() {
            renderPhotosLembur(currentIndexLembur, photosPerLoadLembur);
        });

        // Initial render untuk foto lembur
        if (fotoLemburData.length > 0) {
            renderPhotosLembur(0, initialLoadLembur);
        } else {
            document.getElementById('photoGalleryLembur').innerHTML = '<p class="text-gray-500 text-center py-8">Tidak ada foto yang tersedia</p>';
        }

        // Chart 12: Memantau dan Mencatat (Pie Chart)
const memantauCtx = document.getElementById('memantauChart').getContext('2d');
new Chart(memantauCtx, {
    type: 'pie',
    data: {
        labels: memantauData.map(item => item.label),
        datasets: [{
            data: memantauData.map(item => item.percentage),
            backgroundColor: memantauData.map(item => item.color),
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.parsed.toFixed(1) + '%';
                    }
                }
            },
            datalabels: {
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 16
                },
                formatter: (value) => {
                    return value.toFixed(1) + '%';
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});

// Photo Gallery Logic untuk Foto Tamu
let currentIndexTamu = 0;
const photosPerLoadTamu = 5;
const initialLoadTamu = 6;

function renderPhotosTamu(startIndex, count) {
    const gallery = document.getElementById('photoGalleryTamu');
    const endIndex = Math.min(startIndex + count, fotoTamuData.length);

    for (let i = startIndex; i < endIndex; i++) {
        const foto = fotoTamuData[i];
        const filename = extractFilename(foto.foto_tamu);
        
        const photoItem = document.createElement('div');
        photoItem.className = 'flex items-center py-2 px-3 border border-gray-200 rounded hover:bg-gray-50 transition cursor-pointer';
        photoItem.onclick = () => window.open('/storage/' + foto.foto_tamu, '_blank');
        
        photoItem.innerHTML = `
            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-700 text-sm truncate block max-w-full">${filename}</span>
        `;
        
        gallery.appendChild(photoItem);
    }

    currentIndexTamu = endIndex;
    updateLoadMoreButtonTamu();
}

function updateLoadMoreButtonTamu() {
    const container = document.getElementById('loadMoreContainerTamu');
    const remaining = document.getElementById('remainingCountTamu');
    const remainingPhotos = fotoTamuData.length - currentIndexTamu;

    if (remainingPhotos > 0) {
        container.style.display = 'block';
        remaining.textContent = `${remainingPhotos} file lainnya`;
    } else {
        container.style.display = 'none';
    }
}

document.getElementById('loadMoreBtnTamu').addEventListener('click', function() {
    renderPhotosTamu(currentIndexTamu, photosPerLoadTamu);
});

// Initial render untuk foto tamu
if (fotoTamuData.length > 0) {
    renderPhotosTamu(0, initialLoadTamu);
} else {
    document.getElementById('photoGalleryTamu').innerHTML = '<p class="text-gray-500 text-center py-8">Tidak ada foto yang tersedia</p>';
}

        // Chart 14: Memberikan Pelayanan Informasi (Pie Chart)
        const layananCtx = document.getElementById('layananChart').getContext('2d');
        new Chart(layananCtx, {
            type: 'pie',
            data: {
                labels: layananData.map(item => item.label),
                datasets: [{
                    data: layananData.map(item => item.percentage),
                    backgroundColor: layananData.map(item => item.color),
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed.toFixed(1) + '%';
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 16
                        },
                        formatter: (value) => {
                            return value.toFixed(1) + '%';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Photo Gallery Logic untuk Foto Panduan
        let currentIndexPanduan = 0;
        const photosPerLoadPanduan = 5;
        const initialLoadPanduan = 6;

        function renderPhotosPanduan(startIndex, count) {
            const gallery = document.getElementById('photoGalleryPanduan');
            const endIndex = Math.min(startIndex + count, fotoPanduanData.length);

            for (let i = startIndex; i < endIndex; i++) {
                const foto = fotoPanduanData[i];
                const filename = extractFilename(foto.foto_panduan);
                
                const photoItem = document.createElement('div');
                photoItem.className = 'flex items-center py-2 px-3 border border-gray-200 rounded hover:bg-gray-50 transition cursor-pointer';
                photoItem.onclick = () => window.open('/storage/' + foto.foto_panduan, '_blank');
                
                photoItem.innerHTML = `
                    <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-700 text-sm truncate block max-w-full">${filename}</span>
                `;
                
                gallery.appendChild(photoItem);
            }

            currentIndexPanduan = endIndex;
            updateLoadMoreButtonPanduan();
        }

        function updateLoadMoreButtonPanduan() {
            const container = document.getElementById('loadMoreContainerPanduan');
            const remaining = document.getElementById('remainingCountPanduan');
            const remainingPhotos = fotoPanduanData.length - currentIndexPanduan;

            if (remainingPhotos > 0) {
                container.style.display = 'block';
                remaining.textContent = `${remainingPhotos} file lainnya`;
            } else {
                container.style.display = 'none';
            }
        }

        document.getElementById('loadMoreBtnPanduan').addEventListener('click', function() {
            renderPhotosPanduan(currentIndexPanduan, photosPerLoadPanduan);
        });

        // Initial render untuk foto panduan
        if (fotoPanduanData.length > 0) {
            renderPhotosPanduan(0, initialLoadPanduan);
        } else {
            document.getElementById('photoGalleryPanduan').innerHTML = '<p class="text-gray-500 text-center py-8">Tidak ada foto yang tersedia</p>';
        }

        // Chart 16: Fungsi Pengamanan Force Majure (Pie Chart)
// Tambahkan setelah chart dan gallery foto panduan
const fungsiForceCtx = document.getElementById('fungsiForceChart').getContext('2d');
new Chart(fungsiForceCtx, {
    type: 'pie',
    data: {
        labels: fungsiForceData.map(item => item.label),
        datasets: [{
            data: fungsiForceData.map(item => item.percentage),
            backgroundColor: fungsiForceData.map(item => item.color),
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.parsed.toFixed(1) + '%';
                    }
                }
            },
            datalabels: {
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 16
                },
                formatter: (value) => {
                    return value.toFixed(1) + '%';
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});

// Photo Gallery Logic untuk Foto Force Majure
let currentIndexForce = 0;
const photosPerLoadForce = 5;
const initialLoadForce = 6;

function renderPhotosForce(startIndex, count) {
    const gallery = document.getElementById('photoGalleryForce');
    const endIndex = Math.min(startIndex + count, fotoForceData.length);

    for (let i = startIndex; i < endIndex; i++) {
        const foto = fotoForceData[i];
        const filename = extractFilename(foto.foto_force);
        
        const photoItem = document.createElement('div');
        photoItem.className = 'flex items-center py-2 px-3 border border-gray-200 rounded hover:bg-gray-50 transition cursor-pointer';
        photoItem.onclick = () => window.open('/storage/' + foto.foto_force, '_blank');
        
        photoItem.innerHTML = `
            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-700 text-sm truncate block max-w-full">${filename}</span>
        `;
        
        gallery.appendChild(photoItem);
    }

    currentIndexForce = endIndex;
    updateLoadMoreButtonForce();
}

function updateLoadMoreButtonForce() {
    const container = document.getElementById('loadMoreContainerForce');
    const remaining = document.getElementById('remainingCountForce');
    const remainingPhotos = fotoForceData.length - currentIndexForce;

    if (remainingPhotos > 0) {
        container.style.display = 'block';
        remaining.textContent = `${remainingPhotos} file lainnya`;
    } else {
        container.style.display = 'none';
    }
}

document.getElementById('loadMoreBtnForce').addEventListener('click', function() {
    renderPhotosForce(currentIndexForce, photosPerLoadForce);
});

// Initial render untuk foto force
if (fotoForceData.length > 0) {
    renderPhotosForce(0, initialLoadForce);
} else {
    document.getElementById('photoGalleryForce').innerHTML = '<p class="text-gray-500 text-center py-8">Tidak ada foto yang tersedia</p>';
}

// Chart 18: Penertiban Area Perpakiran (Pie Chart)
const penertibanCtx = document.getElementById('penertibanChart').getContext('2d');
new Chart(penertibanCtx, {
    type: 'pie',
    data: {
        labels: penertibanData.map(item => item.label),
        datasets: [{
            data: penertibanData.map(item => item.percentage),
            backgroundColor: penertibanData.map(item => item.color),
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.parsed.toFixed(1) + '%';
                    }
                }
            },
            datalabels: {
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 16
                },
                formatter: (value) => {
                    return value.toFixed(1) + '%';
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});

// Photo Gallery Logic untuk Foto Penertiban
let currentIndexPenertiban = 0;
const photosPerLoadPenertiban = 5;
const initialLoadPenertiban = 6;

function renderPhotosPenertiban(startIndex, count) {
    const gallery = document.getElementById('photoGalleryPenertiban');
    const endIndex = Math.min(startIndex + count, fotoPenertibanData.length);

    for (let i = startIndex; i < endIndex; i++) {
        const foto = fotoPenertibanData[i];
        const filename = extractFilename(foto.foto_penertiban);
        
        const photoItem = document.createElement('div');
        photoItem.className = 'flex items-center py-2 px-3 border border-gray-200 rounded hover:bg-gray-50 transition cursor-pointer';
        photoItem.onclick = () => window.open('/storage/' + foto.foto_penertiban, '_blank');
        
        photoItem.innerHTML = `
            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-700 text-sm truncate block max-w-full">${filename}</span>
        `;
        
        gallery.appendChild(photoItem);
    }

    currentIndexPenertiban = endIndex;
    updateLoadMoreButtonPenertiban();
}

function updateLoadMoreButtonPenertiban() {
    const container = document.getElementById('loadMoreContainerPenertiban');
    const remaining = document.getElementById('remainingCountPenertiban');
    const remainingPhotos = fotoPenertibanData.length - currentIndexPenertiban;

    if (remainingPhotos > 0) {
        container.style.display = 'block';
        remaining.textContent = `${remainingPhotos} file lainnya`;
    } else {
        container.style.display = 'none';
    }
}

document.getElementById('loadMoreBtnPenertiban').addEventListener('click', function() {
    renderPhotosPenertiban(currentIndexPenertiban, photosPerLoadPenertiban);
});

// Initial render untuk foto penertiban
if (fotoPenertibanData.length > 0) {
    renderPhotosPenertiban(0, initialLoadPenertiban);
} else {
    document.getElementById('photoGalleryPenertiban').innerHTML = '<p class="text-gray-500 text-center py-8">Tidak ada foto yang tersedia</p>';
}

// Chart 20: Simulasi Tanggap Darurat (Pie Chart)
const simulasiCtx = document.getElementById('simulasiChart').getContext('2d');
new Chart(simulasiCtx, {
    type: 'pie',
    data: {
        labels: simulasiData.map(item => item.label),
        datasets: [{
            data: simulasiData.map(item => item.percentage),
            backgroundColor: simulasiData.map(item => item.color),
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.parsed.toFixed(1) + '%';
                    }
                }
            },
            datalabels: {
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 16
                },
                formatter: (value) => {
                    return value.toFixed(1) + '%';
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});

// Photo Gallery Logic untuk Foto Simulasi
let currentIndexSimulasi = 0;
const photosPerLoadSimulasi = 5;
const initialLoadSimulasi = 6;

function renderPhotosSimulasi(startIndex, count) {
    const gallery = document.getElementById('photoGallerySimulasi');
    const endIndex = Math.min(startIndex + count, fotoSimulasiData.length);

    for (let i = startIndex; i < endIndex; i++) {
        const foto = fotoSimulasiData[i];
        const filename = extractFilename(foto.foto_simulasi);
        
        const photoItem = document.createElement('div');
        photoItem.className = 'flex items-center py-2 px-3 border border-gray-200 rounded hover:bg-gray-50 transition cursor-pointer';
        photoItem.onclick = () => window.open('/storage/' + foto.foto_simulasi, '_blank');
        
        photoItem.innerHTML = `
            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-700 text-sm truncate block max-w-full">${filename}</span>
        `;
        
        gallery.appendChild(photoItem);
    }

    currentIndexSimulasi = endIndex;
    updateLoadMoreButtonSimulasi();
}

function updateLoadMoreButtonSimulasi() {
    const container = document.getElementById('loadMoreContainerSimulasi');
    const remaining = document.getElementById('remainingCountSimulasi');
    const remainingPhotos = fotoSimulasiData.length - currentIndexSimulasi;

    if (remainingPhotos > 0) {
        container.style.display = 'block';
        remaining.textContent = `${remainingPhotos} file lainnya`;
    } else {
        container.style.display = 'none';
    }
}

document.getElementById('loadMoreBtnSimulasi').addEventListener('click', function() {
    renderPhotosSimulasi(currentIndexSimulasi, photosPerLoadSimulasi);
});

// Initial render untuk foto simulasi
if (fotoSimulasiData.length > 0) {
    renderPhotosSimulasi(0, initialLoadSimulasi);
} else {
    document.getElementById('photoGallerySimulasi').innerHTML = '<p class="text-gray-500 text-center py-8">Tidak ada foto yang tersedia</p>';
}

// Chart 22: Penyegaran dan Kebugaran Fisik (Pie Chart)
const penyegaranCtx = document.getElementById('penyegaranChart').getContext('2d');
new Chart(penyegaranCtx, {
    type: 'pie',
    data: {
        labels: penyegaranData.map(item => item.label),
        datasets: [{
            data: penyegaranData.map(item => item.percentage),
            backgroundColor: penyegaranData.map(item => item.color),
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.parsed.toFixed(1) + '%';
                    }
                }
            },
            datalabels: {
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 16
                },
                formatter: (value) => {
                    return value.toFixed(1) + '%';
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});

// Photo Gallery Logic untuk Foto Penyegaran
let currentIndexPenyegaran = 0;
const photosPerLoadPenyegaran = 5;
const initialLoadPenyegaran = 6;

function renderPhotosPenyegaran(startIndex, count) {
    const gallery = document.getElementById('photoGalleryPenyegaran');
    const endIndex = Math.min(startIndex + count, fotoPenyegaranData.length);

    for (let i = startIndex; i < endIndex; i++) {
        const foto = fotoPenyegaranData[i];
        const filename = extractFilename(foto.foto_penyegaran);
        
        const photoItem = document.createElement('div');
        photoItem.className = 'flex items-center py-2 px-3 border border-gray-200 rounded hover:bg-gray-50 transition cursor-pointer';
        photoItem.onclick = () => window.open('/storage/' + foto.foto_penyegaran, '_blank');
        
        photoItem.innerHTML = `
            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-700 text-sm truncate block max-w-full">${filename}</span>
        `;
        
        gallery.appendChild(photoItem);
    }

    currentIndexPenyegaran = endIndex;
    updateLoadMoreButtonPenyegaran();
}

function updateLoadMoreButtonPenyegaran() {
    const container = document.getElementById('loadMoreContainerPenyegaran');
    const remaining = document.getElementById('remainingCountPenyegaran');
    const remainingPhotos = fotoPenyegaranData.length - currentIndexPenyegaran;

    if (remainingPhotos > 0) {
        container.style.display = 'block';
        remaining.textContent = `${remainingPhotos} file lainnya`;
    } else {
        container.style.display = 'none';
    }
}

document.getElementById('loadMoreBtnPenyegaran').addEventListener('click', function() {
    renderPhotosPenyegaran(currentIndexPenyegaran, photosPerLoadPenyegaran);
});

// Initial render untuk foto penyegaran
if (fotoPenyegaranData.length > 0) {
    renderPhotosPenyegaran(0, initialLoadPenyegaran);
} else {
    document.getElementById('photoGalleryPenyegaran').innerHTML = '<p class="text-gray-500 text-center py-8">Tidak ada foto yang tersedia</p>';
}

// Chart 24: Menerima dan Mendata Telepon (Pie Chart)
const teleponCtx = document.getElementById('teleponChart').getContext('2d');
new Chart(teleponCtx, {
    type: 'pie',
    data: {
        labels: teleponData.map(item => item.label),
        datasets: [{
            data: teleponData.map(item => item.percentage),
            backgroundColor: teleponData.map(item => item.color),
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.parsed.toFixed(1) + '%';
                    }
                }
            },
            datalabels: {
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 16
                },
                formatter: (value) => {
                    return value.toFixed(1) + '%';
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});

// Photo Gallery Logic untuk Foto Telepon
let currentIndexTelepon = 0;
const photosPerLoadTelepon = 5;
const initialLoadTelepon = 6;

function renderPhotosTelepon(startIndex, count) {
    const gallery = document.getElementById('photoGalleryTelepon');
    const endIndex = Math.min(startIndex + count, fotoTeleponData.length);

    for (let i = startIndex; i < endIndex; i++) {
        const foto = fotoTeleponData[i];
        const filename = extractFilename(foto.foto_telepon);
        
        const photoItem = document.createElement('div');
        photoItem.className = 'flex items-center py-2 px-3 border border-gray-200 rounded hover:bg-gray-50 transition cursor-pointer';
        photoItem.onclick = () => window.open('/storage/' + foto.foto_telepon, '_blank');
        
        photoItem.innerHTML = `
            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-700 text-sm truncate block max-w-full">${filename}</span>
        `;
        
        gallery.appendChild(photoItem);
    }

    currentIndexTelepon = endIndex;
    updateLoadMoreButtonTelepon();
}

function updateLoadMoreButtonTelepon() {
    const container = document.getElementById('loadMoreContainerTelepon');
    const remaining = document.getElementById('remainingCountTelepon');
    const remainingPhotos = fotoTeleponData.length - currentIndexTelepon;

    if (remainingPhotos > 0) {
        container.style.display = 'block';
        remaining.textContent = `${remainingPhotos} file lainnya`;
    } else {
        container.style.display = 'none';
    }
}

document.getElementById('loadMoreBtnTelepon').addEventListener('click', function() {
    renderPhotosTelepon(currentIndexTelepon, photosPerLoadTelepon);
});

// Initial render untuk foto telepon
if (fotoTeleponData.length > 0) {
    renderPhotosTelepon(0, initialLoadTelepon);
} else {
    document.getElementById('photoGalleryTelepon').innerHTML = '<p class="text-gray-500 text-center py-8">Tidak ada foto yang tersedia</p>';
}


// Chart 26: Melakukan Patroli Rutin (Pie Chart)
const rutinCtx = document.getElementById('rutinChart').getContext('2d');
new Chart(rutinCtx, {
    type: 'pie',
    data: {
        labels: rutinData.map(item => item.label),
        datasets: [{
            data: rutinData.map(item => item.percentage),
            backgroundColor: rutinData.map(item => item.color),
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.parsed.toFixed(1) + '%';
                    }
                }
            },
            datalabels: {
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 16
                },
                formatter: (value) => {
                    return value.toFixed(1) + '%';
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});

// Photo Gallery Logic untuk Foto Rutin
let currentIndexRutin = 0;
const photosPerLoadRutin = 5;
const initialLoadRutin = 6;

function renderPhotosRutin(startIndex, count) {
    const gallery = document.getElementById('photoGalleryRutin');
    const endIndex = Math.min(startIndex + count, fotoRutinData.length);

    for (let i = startIndex; i < endIndex; i++) {
        const foto = fotoRutinData[i];
        const filename = extractFilename(foto.foto_rutin);
        
        const photoItem = document.createElement('div');
        photoItem.className = 'flex items-center py-2 px-3 border border-gray-200 rounded hover:bg-gray-50 transition cursor-pointer';
        photoItem.onclick = () => window.open('/storage/' + foto.foto_rutin, '_blank');
        
        photoItem.innerHTML = `
            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-700 text-sm truncate block max-w-full">${filename}</span>
        `;
        
        gallery.appendChild(photoItem);
    }

    currentIndexRutin = endIndex;
    updateLoadMoreButtonRutin();
}

function updateLoadMoreButtonRutin() {
    const container = document.getElementById('loadMoreContainerRutin');
    const remaining = document.getElementById('remainingCountRutin');
    const remainingPhotos = fotoRutinData.length - currentIndexRutin;

    if (remainingPhotos > 0) {
        container.style.display = 'block';
        remaining.textContent = `${remainingPhotos} file lainnya`;
    } else {
        container.style.display = 'none';
    }
}

document.getElementById('loadMoreBtnRutin').addEventListener('click', function() {
    renderPhotosRutin(currentIndexRutin, photosPerLoadRutin);
});

// Initial render untuk foto rutin
if (fotoRutinData.length > 0) {
    renderPhotosRutin(0, initialLoadRutin);
} else {
    document.getElementById('photoGalleryRutin').innerHTML = '<p class="text-gray-500 text-center py-8">Tidak ada foto yang tersedia</p>';
}
    </script>
    @endif
</x-app-layout>