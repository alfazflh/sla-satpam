<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kegiatan Anggota Satuan Pengamanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-[#1f7389] text-white p-6">
                <h1 class="text-2xl font-bold">LAPORAN KEGIATAN ANGGOTA SATUAN PENGAMANAN</h1>
                <p class="text-white mt-2">Silakan isi form dengan lengkap</p>
            </div>

            <!-- Progress Bar -->
            <div class="bg-gray-200 h-2">
                <div id="progressBar" class="bg-[#1f7389] h-2 transition-all duration-300" style="width: 0%"></div>
            </div>

            <form id="mainForm" action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                
                <!-- BAGIAN 1: Data Dasar -->
                <div class="form-section" data-section="1">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Informasi Dasar</h2>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            1. Waktu Jaga Shift <span class="text-red-500">*</span>
                        </label>
                        <div class="space-y-2">
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="waktu" value="Shift 1 : 07.00 SD 15.00" class="mr-3" required>
                                <span>Shift 1 : 07.00 SD 15.00</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="waktu" value="Shift 2 : 15.00 SD 23.00" class="mr-3">
                                <span>Shift 2 : 15.00 SD 23.00</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="waktu" value="Shift 3 : 23.00 SD 07.00" class="mr-3">
                                <span>Shift 3 : 23.00 SD 07.00</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            2. Area Kerja <span class="text-red-500">*</span>
                        </label>
                        <div class="space-y-2">
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="area" value="Pos Jaga Bersama UP3 SBS" class="mr-3" required>
                                <span>Pos Jaga Bersama UP3 SBS</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="area" value="UP2W VI" class="mr-3">
                                <span>UP2W VI</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            3. Nama Petugas Jaga <span class="text-red-500">*</span>
                            <span class="text-xs text-gray-500">(Pilih satu atau lebih)</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="MARJOKO" class="mr-2">
                                <span class="text-sm">MARJOKO</span>
                            </label>
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="KARNO" class="mr-2">
                                <span class="text-sm">KARNO</span>
                            </label>
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="SOBACHUS SURUR" class="mr-2">
                                <span class="text-sm">SOBACHUS SURUR</span>
                            </label>
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="IPUNG ASWIANTO" class="mr-2">
                                <span class="text-sm">IPUNG ASWIANTO</span>
                            </label>
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="EKO ARIS IKHWANUDIN" class="mr-2">
                                <span class="text-sm">EKO ARIS IKHWANUDIN</span>
                            </label>
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="BOBY PURWANTO" class="mr-2">
                                <span class="text-sm">BOBY PURWANTO</span>
                            </label>
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="HARYONO" class="mr-2">
                                <span class="text-sm">HARYONO</span>
                            </label>
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="KINDLY CHOIRUL HAQIQI" class="mr-2">
                                <span class="text-sm">KINDLY CHOIRUL HAQIQI</span>
                            </label>
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="AMBAR SONIG" class="mr-2">
                                <span class="text-sm">AMBAR SONIG</span>
                            </label>
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="REZA TRI PUTRA" class="mr-2">
                                <span class="text-sm">REZA TRI PUTRA</span>
                            </label>
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="EGI AGUS KARYANTO" class="mr-2">
                                <span class="text-sm">EGI AGUS KARYANTO</span>
                            </label>
                            <label class="flex items-center p-2 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama[]" value="ABDU ISMAIL" class="mr-2">
                                <span class="text-sm">ABDU ISMAIL</span>
                            </label>
                        </div>
                    </div>

                    <button type="button" onclick="nextSection(2)" class="w-full bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                        Berikutnya
                    </button>
                </div>

                <!-- BAGIAN 2: Seragam -->
                <div class="form-section hidden" data-section="2">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">1. Penggunaan Seragam dan Kelengkapan Atribut</h2>
                    <p class="text-sm text-gray-600 mb-4">Wajib 100% kelengkapan seragam dan kelengkapan atribut sesuai ketentuan. Menggunakan seragam sesuai ketentuan yang berlaku (foto apel serah terima) <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="ketentuan_seragam" value="Sesuai 100%" class="mr-3" required onchange="handleSeragam(this)">
                            <span>Sesuai 100%</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="ketentuan_seragam" value="Tidak Sesuai" class="mr-3" onchange="handleSeragam(this)">
                            <span>Tidak Sesuai</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(1)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handleSeragamNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 3: Upload Foto Seragam -->
                <div class="form-section hidden" data-section="3">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Penggunaan Seragam</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan Foto Saat Apel Serah Terima Antar Shift <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                            hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_serahterima" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_serahterima" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(2)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(4)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 4: Pengamanan -->
                <div class="form-section hidden" data-section="4">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">2. Melaksanakan Kegiatan Pengamanan di Sekitar Objek</h2>
                    <p class="text-sm text-gray-600 mb-4">Nol (0) tindak kriminal di sekitar objek pengamanan (foto patroli luar area kantor dan rumdin) <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="pengamanan" value="Nol (0) tindak kriminal" class="mr-3" required onchange="handlePengamanan(this)">
                            <span>Nol (0) tindak kriminal</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="pengamanan" value="Tidak Dilaksanakan" class="mr-3" onchange="handlePengamanan(this)">
                            <span>Tidak Dilaksanakan</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="pengamanan" value="Terjadi Tindak Kriminal, Ancaman dan Gangguan Keamanan" class="mr-3" onchange="handlePengamanan(this)">
                            <span>Terjadi Tindak Kriminal, Ancaman dan Gangguan Keamanan</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromPengamanan()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handlePengamananNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 5: Upload Foto Patroli -->
                <div class="form-section hidden" data-section="5">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Nol (0) Tindakan Kriminal</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan Foto Patroli Kegiatan <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                    focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_patroli" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_patroli" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(4)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(7)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 6: Kronologi Kriminal -->
                <div class="form-section hidden" data-section="6">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Laporan Terjadi Tindakan Kriminal</h2>
                    <p class="text-sm text-gray-600 mb-4">Tuliskan Kronologi Kejadian. Deskripsikan kejadian beserta waktu kejadian <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <textarea name="kronologi_kriminal" rows="5" required
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Tuliskan kronologi kejadian secara detail..."></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(4)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(7)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 7: Fungsi Khusus -->
                <div class="form-section hidden" data-section="7">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">3. Melaksanakan Fungsi Pengamanan dalam Kegiatan/Peristiwa Khusus</h2>
                    <p class="text-sm text-gray-600 mb-4">Nol (0) tindak kriminal dan 100% pelaksanaan kegiatan secara tertib dan kondusif <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="fungsi_khusus" value="Nol (0) tindak kriminal" class="mr-3" required onchange="handleFungsiKhusus(this)">
                            <span>Nol (0) tindak kriminal</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="fungsi_khusus" value="Terjadi tindak kriminal" class="mr-3" onchange="handleFungsiKhusus(this)">
                            <span>Terjadi tindak kriminal</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="fungsi_khusus" value="Nihil Kegiatan" class="mr-3" onchange="handleFungsiKhusus(this)">
                            <span>Nihil Kegiatan</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromFungsiKhusus()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handleFungsiKhususNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 8: Upload Foto Lembur -->
                <div class="form-section hidden" data-section="8">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Fungsi Pengamanan Khusus</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan Foto Giat Lembur Kegiatan <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                    focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_lembur" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_lembur" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(7)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(10)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 9: Kronologi Gangguan -->
                <div class="form-section hidden" data-section="9">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Laporan Gangguan Fungsi Pengamanan Khusus</h2>
                    <p class="text-sm text-gray-600 mb-4">Tuliskan Kronologi Kejadian <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <textarea name="kronologi_gangguan" rows="5" required
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Tuliskan kronologi kejadian secara detail..."></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(7)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(10)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 10: Memantau -->
                <div class="form-section hidden" data-section="10">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">4. Memantau dan Mencatat Lalu Lintas Orang dan Kendaraan</h2>
                    <p class="text-sm text-gray-600 mb-4">100% kelengkapan dan akurasi pencatatan (Foto jurnal, kendaraan dinas) <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="memantau" value="Tercatat, Tertib dan Aman" class="mr-3" required onchange="handleMemantau(this)">
                            <span>Tercatat, Tertib dan Aman</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="memantau" value="Tidak Tercatat" class="mr-3" onchange="handleMemantau(this)">
                            <span>Tidak Tercatat</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromMemantau()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handleMemantauNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 11: Upload Foto Tamu -->
                <div class="form-section hidden" data-section="11">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Lalu Lintas Orang dan Kendaraan</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan Foto Jurnal Satpam dan pencatatan tamu/kendaraan <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                    focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_tamu" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_tamu" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(10)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(12)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 12: Pelayanan -->
                <div class="form-section hidden" data-section="12">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">5. Memberikan Pelayanan Informasi</h2>
                    <p class="text-sm text-gray-600 mb-4">100% permintaan pelayanan informasi terselesaikan <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="pelayanan" value="100% Terpenuhi" class="mr-3" required onchange="handlePelayanan(this)">
                            <span>100% Terpenuhi</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="pelayanan" value="Nihil Tamu" class="mr-3" onchange="handlePelayanan(this)">
                            <span>Nihil Tamu</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromPelayanan()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handlePelayananNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 13: Upload Foto Panduan -->
                <div class="form-section hidden" data-section="13">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Panduan Keselamatan Kerja</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan Dokumentasi panduan keselamatan kerja ke mitra atau tamu <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                    focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_panduan" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_panduan" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(12)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(14)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 14: Fungsi Force Majeure -->
                <div class="form-section hidden" data-section="14">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">6. Melaksanakan Fungsi Pengamanan dalam Kejadian Force Majeure</h2>
                    <p class="text-sm text-gray-600 mb-4">100% pelaksanaan penanganan force majeure (foto pengamanan jika ada bencana alam, kerusuhan) <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="fungsi_force" value="Dilaksanakan" class="mr-3" required onchange="handleForceMajeure(this)">
                            <span>Dilaksanakan</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="fungsi_force" value="Tidak Terjadi" class="mr-3" onchange="handleForceMajeure(this)">
                            <span>Tidak Terjadi</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromForceMajeure()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handleForceMajeureNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 15: Upload Foto Force -->
                <div class="form-section hidden" data-section="15">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Pelaksanaan Fungsi Pengamanan Force Majeure</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan Foto Pelaksanaan fungsi pengamanan dalam kejadian force majeure <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                    focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_force" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_force" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(14)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(16)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 16: Penertiban Parkir -->
                <div class="form-section hidden" data-section="16">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">7. Melakukan Penertiban Area Perparkiran</h2>
                    <p class="text-sm text-gray-600 mb-4">100% kendaraan terparkir secara tertib (Foto parkir kendaraan roda 2 dan roda 4) <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="penertiban" value="Tertib" class="mr-3" required onchange="handlePenertiban(this)">
                            <span>Tertib</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="penertiban" value="Tidak Tertib" class="mr-3" onchange="handlePenertiban(this)">
                            <span>Tidak Tertib</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromPenertiban()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handlePenertibanNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 17: Upload Foto Penertiban -->
                <div class="form-section hidden" data-section="17">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Penertiban Area Perparkiran</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan Foto penertiban area perparkiran <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                    focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_penertiban" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_penertiban" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(16)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(18)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 18: Simulasi -->
                <div class="form-section hidden" data-section="18">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">8. Mengikuti dan Memahami Kegiatan Simulasi Tanggap Darurat</h2>
                    <p class="text-sm text-gray-600 mb-4">100% partisipasi simulasi tanggap darurat <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="simulasi" value="100% Berpartisipasi" class="mr-3" required onchange="handleSimulasi(this)">
                            <span>100% Berpartisipasi</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="simulasi" value="Tidak Berpartisipasi (Nihil Kegiatan)" class="mr-3" onchange="handleSimulasi(this)">
                            <span>Tidak Berpartisipasi (Nihil Kegiatan)</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromSimulasi()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handleSimulasiNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 19: Upload Foto Simulasi -->
                <div class="form-section hidden" data-section="19">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Kegiatan Simulasi Tanggap Darurat</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan foto <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                    focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_simulasi" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_simulasi" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(18)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(20)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 20: Penyegaran -->
                <div class="form-section hidden" data-section="20">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">9. Melaksanakan Penyegaran dan Kebugaran Fisik</h2>
                    <p class="text-sm text-gray-600 mb-4">100% penyelesaian program penyegaran dan kebugaran fisik <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="penyegaran" value="Dilaksanakan" class="mr-3" required onchange="handlePenyegaran(this)">
                            <span>Dilaksanakan</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="penyegaran" value="Tidak Ada Kegiatan" class="mr-3" onchange="handlePenyegaran(this)">
                            <span>Tidak Ada Kegiatan</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromPenyegaran()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handlePenyegaranNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 21: Upload Foto Penyegaran -->
                <div class="form-section hidden" data-section="21">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Penyegaran dan Kebugaran Fisik</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan Foto penyegaran dan kebugaran fisik <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                    focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_penyegaran" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_penyegaran" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(20)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(22)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 22: Telepon -->
                <div class="form-section hidden" data-section="22">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">10. Menerima dan Mendata Telepon</h2>
                    <p class="text-sm text-gray-600 mb-4">100% penyelesaian dan pendataan telepon yang masuk di luar jam kerja/hari libur <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="telepon" value="Ada pendataan" class="mr-3" required onchange="handleTelepon(this)">
                            <span>Ada pendataan</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="telepon" value="Tidak Ada" class="mr-3" onchange="handleTelepon(this)">
                            <span>Tidak Ada</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromTelepon()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handleTeleponNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 23: Upload Foto Telepon -->
                <div class="form-section hidden" data-section="23">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Menerima dan Mendata Telepon</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan Foto Jurnal <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                    focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_telepon" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_telepon" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(22)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(24)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 24: Patroli Rutin -->
                <div class="form-section hidden" data-section="24">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">11. Melakukan Patroli Rutin di Sekitar Objek Pengamanan</h2>
                    <p class="text-sm text-gray-600 mb-4">100% ketepatan waktu pelaksanaan checkpoint patroli (foto patroli di dalam dan luar ruangan) <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="rutin" value="100% Dilaksanakan Sesuai Jadwal dan Titik Patrol Termonitor" class="mr-3" required onchange="handleRutin(this)">
                            <span>100% Dilaksanakan Sesuai Jadwal dan Titik Patrol Termonitor</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="rutin" value="Tidak Dilakukan Patroli" class="mr-3" onchange="handleRutin(this)">
                            <span>Tidak Dilakukan Patroli</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromRutin()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handleRutinNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 25: Upload Foto Rutin & Titik -->
                <div class="form-section hidden" data-section="25">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Patroli Rutin</h2>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jumlah Titik Patroli <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="titik" min="1" required
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Masukkan jumlah titik patroli">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Lampirkan Foto patroli rutin <span class="text-red-500">*</span>
                        </label>
                            <!-- Tombol custom -->
                            <button type="button" onclick="chooseSource()"
                                class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                    hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                        focus:ring-offset-1 cursor-pointer transition">
                                📷 Upload Foto
                            </button>
                            <input type="file" id="camera" name="foto_rutin" accept="image/*" capture="environment" style="display:none" required>
                            <input type="file" id="gallery" name="foto_rutin" accept="image/*" style="display:none" required>
                            <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(24)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(26)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 26: Pengecekan -->
                <div class="form-section hidden" data-section="26">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">12. Melakukan Pengecekan Setelah Jam Pulang Kantor</h2>
                    <p class="text-sm text-gray-600 mb-4">100% pintu ruangan terkunci dan barang elektronik mati <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="pengecekan" value="Dilaksanakan" class="mr-3" required onchange="handlePengecekan(this)">
                            <span>Dilaksanakan</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="pengecekan" value="Tidak Dilaksanakan" class="mr-3" onchange="handlePengecekan(this)">
                            <span>Tidak Dilaksanakan</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromPengecekan()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handlePengecekanNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 27: Upload Foto Pengecekan -->
                <div class="form-section hidden" data-section="27">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Pengecekan Setelah Jam Pulang</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan Foto pengecekan <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                    focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_pengecekan" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_pengecekan" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(26)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="nextSection(28)" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 28: CCTV -->
                <div class="form-section hidden" data-section="28">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">14. Melakukan Pengawasan Area melalui CCTV</h2>
                    <p class="text-sm text-gray-600 mb-4">100% pengawasan area pengamanan melalui CCTV <span class="text-red-500">*</span></p>
                    
                    <div class="space-y-2 mb-6">
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="cctv" value="100% CCTV aman dan Tidak Ada Kejadian" class="mr-3" required onchange="handleCCTV(this)">
                            <span>100% CCTV aman dan Tidak Ada Kejadian</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="cctv" value="CCTV Rusak / Ada Kejadian" class="mr-3" onchange="handleCCTV(this)">
                            <span>CCTV Rusak / Ada Kejadian</span>
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="backFromCCTV()" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="button" onclick="handleCCTVNext()" class="flex-1 bg-[#1f7389] text-white py-3 px-4 rounded-lg hover:bg-indigo-700 font-medium">
                            Berikutnya
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 29: Upload Foto CCTV -->
                <div class="form-section hidden" data-section="29">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">Dokumentasi Pengawasan Area melalui CCTV</h2>
                    <p class="text-sm text-gray-600 mb-4">Lampirkan Foto pengawasan area melalui CCTV (Foto Layar Monitor CCTV) <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <!-- Tombol custom -->
                        <button type="button" onclick="chooseSource()"
                            class="w-full px-4 py-3 rounded-lg font-semibold text-indigo-700 bg-indigo-50 
                                hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                    focus:ring-offset-1 cursor-pointer transition">
                            📷 Upload Foto
                        </button>
                        <input type="file" id="camera" name="foto_cctv" accept="image/*" capture="environment" style="display:none" required>
                        <input type="file" id="gallery" name="foto_cctv" accept="image/*" style="display:none" required>
                        <span id="fileName" class="block mt-2 text-sm text-gray-600 italic"></span>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(28)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="submit" class="flex-1 bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 font-medium">
                            Kirim Laporan
                        </button>
                    </div>
                </div>

                <!-- BAGIAN 30: Kronologi CCTV -->
                <div class="form-section hidden" data-section="30">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800">CCTV Rusak / Ada Kejadian</h2>
                    <p class="text-sm text-gray-600 mb-4">Kronologi CCTV Rusak / Ada kejadian Potensi Ancaman Gangguan <span class="text-red-500">*</span></p>
                    
                    <div class="mb-6">
                        <textarea name="kronologi_cctv" rows="5" required
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Tuliskan kronologi kejadian secara detail..."></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="prevSection(28)" class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 font-medium">
                            Kembali
                        </button>
                        <button type="submit" class="flex-1 bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 font-medium">
                            Kirim Laporan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        let currentSection = 1;
        const totalSections = 30;
        let choices = {};
    
        // FUNGSI UTAMA: Update required fields berdasarkan visibility
        function updateRequiredFields() {
            document.querySelectorAll('.form-section').forEach(section => {
                const isVisible = !section.classList.contains('hidden');
                const fields = section.querySelectorAll('input, textarea, select');
                
                fields.forEach(field => {
                    if (isVisible) {
                        if (field.hasAttribute('data-required')) {
                            field.setAttribute('required', 'required');
                        }
                    } else {
                        if (field.hasAttribute('required')) {
                            field.setAttribute('data-required', 'true');
                            field.removeAttribute('required');
                        }
                    }
                });
            });
        }
    
        // Validasi section sebelum next
        function validateCurrentSection() {
            const currentSectionElement = document.querySelector(`[data-section="${currentSection}"]`);
            const requiredFields = currentSectionElement.querySelectorAll('[required]');
            
            let isValid = true;
            let firstInvalidField = null;
            let errorMessage = '';
            
            requiredFields.forEach(field => {
                if (field.type === 'radio') {
                    const radioGroup = currentSectionElement.querySelectorAll(`[name="${field.name}"]`);
                    const isChecked = Array.from(radioGroup).some(radio => radio.checked);
                    if (!isChecked && !firstInvalidField) {
                        isValid = false;
                        firstInvalidField = field;
                        errorMessage = 'Silakan pilih salah satu jawaban';
                    }
                }
                else if (field.type === 'checkbox') {
                    const checkboxGroup = currentSectionElement.querySelectorAll(`[name="${field.name}"]`);
                    const isChecked = Array.from(checkboxGroup).some(cb => cb.checked);
                    if (!isChecked && !firstInvalidField) {
                        isValid = false;
                        firstInvalidField = field;
                        errorMessage = 'Silakan pilih minimal satu jawaban';
                    }
                }
                else if (field.type === 'file') {
                    if (!field.files.length && !firstInvalidField) {
                        isValid = false;
                        firstInvalidField = field;
                        errorMessage = 'Silakan upload file yang diperlukan';
                    }
                }
                else if (!field.value.trim() && !firstInvalidField) {
                    isValid = false;
                    firstInvalidField = field;
                    errorMessage = 'Harap lengkapi field yang wajib diisi';
                }
            });
            
            if (!isValid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: errorMessage,
                    confirmButtonColor: '#1f7389',
                    confirmButtonText: 'OK'
                });
                if (firstInvalidField) {
                    firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    setTimeout(() => firstInvalidField.focus(), 300);
                }
            }
            
            return isValid;
        }
    
        function updateProgress() {
            const progress = (currentSection / totalSections) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
        }
    
        function showSection(sectionNumber) {
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.add('hidden');
            });
    
            const targetSection = document.querySelector(`[data-section="${sectionNumber}"]`);
            if (targetSection) {
                targetSection.classList.remove('hidden');
                currentSection = sectionNumber;
                updateProgress();
                updateRequiredFields();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    
        function nextSection(sectionNumber) {
            if (validateCurrentSection()) {
                showSection(sectionNumber);
            }
        }
    
        function prevSection(sectionNumber) {
            showSection(sectionNumber);
        }
    
        // BAGIAN 2: Seragam handlers
        function handleSeragam(radio) {
            choices.seragam = radio.value;
        }
    
        function handleSeragamNext() {
            if (!choices.seragam) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.seragam === 'Sesuai 100%') {
                    nextSection(3);
                } else {
                    nextSection(4);
                }
            }
        }
    
        // BAGIAN 4: Pengamanan handlers
        function handlePengamanan(radio) {
            choices.pengamanan = radio.value;
        }
    
        function backFromPengamanan() {
            if (choices.seragam === 'Sesuai 100%') {
                prevSection(3);
            } else {
                prevSection(2);
            }
        }
    
        function handlePengamananNext() {
            if (!choices.pengamanan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.pengamanan === 'Nol (0) tindak kriminal') {
                    nextSection(5);
                } else if (choices.pengamanan === 'Terjadi Tindak Kriminal, Ancaman dan Gangguan Keamanan') {
                    nextSection(6);
                } else {
                    nextSection(7);
                }
            }
        }
    
        // BAGIAN 7: Fungsi Khusus handlers
        function handleFungsiKhusus(radio) {
            choices.fungsiKhusus = radio.value;
        }
    
        function backFromFungsiKhusus() {
            if (choices.pengamanan === 'Nol (0) tindak kriminal') {
                prevSection(5);
            } else if (choices.pengamanan === 'Terjadi Tindak Kriminal, Ancaman dan Gangguan Keamanan') {
                prevSection(6);
            } else {
                prevSection(4);
            }
        }
    
        function handleFungsiKhususNext() {
            if (!choices.fungsiKhusus) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.fungsiKhusus === 'Nol (0) tindak kriminal') {
                    nextSection(8);
                } else if (choices.fungsiKhusus === 'Terjadi tindak kriminal') {
                    nextSection(9);
                } else {
                    nextSection(10);
                }
            }
        }
    
        // BAGIAN 10: Memantau handlers
        function handleMemantau(radio) {
            choices.memantau = radio.value;
        }
    
        function backFromMemantau() {
            if (choices.fungsiKhusus === 'Nol (0) tindak kriminal') {
                prevSection(8);
            } else if (choices.fungsiKhusus === 'Terjadi tindak kriminal') {
                prevSection(9);
            } else {
                prevSection(7);
            }
        }
    
        function handleMemantauNext() {
            if (!choices.memantau) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.memantau === 'Tercatat, Tertib dan Aman') {
                    nextSection(11);
                } else {
                    nextSection(12);
                }
            }
        }
    
        // BAGIAN 12: Pelayanan handlers
        function handlePelayanan(radio) {
            choices.pelayanan = radio.value;
        }
    
        function backFromPelayanan() {
            if (choices.memantau === 'Tercatat, Tertib dan Aman') {
                prevSection(11);
            } else {
                prevSection(10);
            }
        }
    
        function handlePelayananNext() {
            if (!choices.pelayanan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.pelayanan === '100% Terpenuhi') {
                    nextSection(13);
                } else {
                    nextSection(14);
                }
            }
        }
    
        // BAGIAN 14: Force Majeure handlers
        function handleForceMajeure(radio) {
            choices.forceMajeure = radio.value;
        }
    
        function backFromForceMajeure() {
            if (choices.pelayanan === '100% Terpenuhi') {
                prevSection(13);
            } else {
                prevSection(12);
            }
        }
    
        function handleForceMajeureNext() {
            if (!choices.forceMajeure) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.forceMajeure === 'Dilaksanakan') {
                    nextSection(15);
                } else {
                    nextSection(16);
                }
            }
        }
    
        // BAGIAN 16: Penertiban handlers
        function handlePenertiban(radio) {
            choices.penertiban = radio.value;
        }
    
        function backFromPenertiban() {
            if (choices.forceMajeure === 'Dilaksanakan') {
                prevSection(15);
            } else {
                prevSection(14);
            }
        }
    
        function handlePenertibanNext() {
            if (!choices.penertiban) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.penertiban === 'Tertib') {
                    nextSection(17);
                } else {
                    nextSection(18);
                }
            }
        }
    
        // BAGIAN 18: Simulasi handlers
        function handleSimulasi(radio) {
            choices.simulasi = radio.value;
        }
    
        function backFromSimulasi() {
            if (choices.penertiban === 'Tertib') {
                prevSection(17);
            } else {
                prevSection(16);
            }
        }
    
        function handleSimulasiNext() {
            if (!choices.simulasi) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.simulasi === '100% Berpartisipasi') {
                    nextSection(19);
                } else {
                    nextSection(20);
                }
            }
        }
    
        // BAGIAN 20: Penyegaran handlers
        function handlePenyegaran(radio) {
            choices.penyegaran = radio.value;
        }
    
        function backFromPenyegaran() {
            if (choices.simulasi === '100% Berpartisipasi') {
                prevSection(19);
            } else {
                prevSection(18);
            }
        }
    
        function handlePenyegaranNext() {
            if (!choices.penyegaran) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.penyegaran === 'Dilaksanakan') {
                    nextSection(21);
                } else {
                    nextSection(22);
                }
            }
        }
    
        // BAGIAN 22: Telepon handlers
        function handleTelepon(radio) {
            choices.telepon = radio.value;
        }
    
        function backFromTelepon() {
            if (choices.penyegaran === 'Dilaksanakan') {
                prevSection(21);
            } else {
                prevSection(20);
            }
        }
    
        function handleTeleponNext() {
            if (!choices.telepon) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.telepon === 'Ada pendataan') {
                    nextSection(23);
                } else {
                    nextSection(24);
                }
            }
        }
    
        // BAGIAN 24: Rutin handlers
        function handleRutin(radio) {
            choices.rutin = radio.value;
        }
    
        function backFromRutin() {
            if (choices.telepon === 'Ada pendataan') {
                prevSection(23);
            } else {
                prevSection(22);
            }
        }
    
        function handleRutinNext() {
            if (!choices.rutin) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.rutin === '100% Dilaksanakan Sesuai Jadwal dan Titik Patrol Termonitor') {
                    nextSection(25);
                } else {
                    nextSection(26);
                }
            }
        }
    
        // BAGIAN 26: Pengecekan handlers
        function handlePengecekan(radio) {
            choices.pengecekan = radio.value;
        }
    
        function backFromPengecekan() {
            if (choices.rutin === '100% Dilaksanakan Sesuai Jadwal dan Titik Patrol Termonitor') {
                prevSection(25);
            } else {
                prevSection(24);
            }
        }
    
        function handlePengecekanNext() {
            if (!choices.pengecekan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.pengecekan === 'Dilaksanakan') {
                    nextSection(27);
                } else {
                    nextSection(28);
                }
            }
        }
    
        // BAGIAN 28: CCTV handlers
        function handleCCTV(radio) {
            choices.cctv = radio.value;
        }
    
        function backFromCCTV() {
            if (choices.pengecekan === 'Dilaksanakan') {
                prevSection(27);
            } else {
                prevSection(26);
            }
        }
    
        function handleCCTVNext() {
            if (!choices.cctv) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih salah satu jawaban',
                    confirmButtonColor: '#1f7389'
                });
                return;
            }
            if (validateCurrentSection()) {
                if (choices.cctv === '100% CCTV aman dan Tidak Ada Kejadian') {
                    nextSection(29);
                } else {
                    nextSection(30);
                }
            }
        }
    
        // Initialize form
        document.addEventListener('DOMContentLoaded', function() {
            showSection(1);
            updateRequiredFields();
        });
    
        // Form submission dengan SweetAlert loading
        document.getElementById('mainForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateCurrentSection()) {
                return;
            }
    
            // Tampilkan loading
            Swal.fire({
                title: 'Mengirim Laporan...',
                html: 'Mohon tunggu, data sedang diproses',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
    
            // Submit form
            this.submit();
        });
    
        // Auto-refresh CSRF token (mencegah 419 error)
        setInterval(function() {
            fetch('/refresh-csrf')
                .then(response => response.json())
                .then(data => {
                    const csrfInput = document.querySelector('input[name="_token"]');
                    if (csrfInput) {
                        csrfInput.value = data.token;
                    }
                })
                .catch(err => console.log('CSRF refresh failed'));
        }, 600000); // Refresh setiap 10 menit
    </script>
    <script>
        function chooseSource() {
        Swal.fire({
            title: 'Pilih Sumber Foto',
            text: 'Ambil foto langsung atau pilih dari galeri?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '📷 Kamera',
            cancelButtonText: '🖼️ Galeri',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
            document.getElementById("camera").click();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
            document.getElementById("gallery").click();
            }
        });
        }
    
        // Update nama file setelah dipilih
        document.getElementById("camera").addEventListener("change", updateFileName);
        document.getElementById("gallery").addEventListener("change", updateFileName);
    
        function updateFileName(event) {
        const file = event.target.files[0];
        if (file) {
            document.getElementById("fileName").textContent = "📄 " + file.name;
    
            // opsional: ubah warna tombol kalau sudah ada file
            const btn = document.querySelector("button[onclick='chooseSource()']");
            btn.classList.remove("bg-indigo-50", "text-indigo-700");
            btn.classList.add("bg-green-100", "text-green-700");
        }
        }
    </script>  
</body>
</html>