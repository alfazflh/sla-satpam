<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kegiatan Anggota Satuan Pengamanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md my-8">
        <h1 class="text-xl font-bold mb-6">LAPORAN KEGIATAN ANGGOTA SATUAN PENGAMANAN</h1>

        <form id="mainForm" action="#" method="POST" enctype="multipart/form-data">
            <!-- BAGIAN 1-3: Informasi Dasar -->
            <div class="mb-8 p-4 bg-yellow-50 rounded-lg">
                <h2 class="text-lg font-semibold mb-4">Informasi Dasar</h2>
                
                <!-- 1. Waktu Jaga Shift -->
                <div class="mb-6">
                    <label class="block text-md font-medium text-gray-700 mb-2">
                        1. Waktu Jaga Shift <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="waktu_shift" value="Shift 1 : 07.00 - 15.00" class="mr-2" required>
                            Shift 1 : 07.00 SD 15.00
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="waktu_shift" value="Shift 2 : 15.00 - 23.00" class="mr-2">
                            Shift 2 : 15.00 SD 23.00
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="waktu_shift" value="Shift 3 : 23.00 - 07.00" class="mr-2">
                            Shift 3 : 23.00 SD 07.00
                        </label>
                    </div>
                </div>

                <!-- 2. Area Kerja -->
                <div class="mb-6">
                    <label class="block text-md font-medium text-gray-700 mb-2">
                        2. Area Kerja <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="area" value="Pos Jaga Bersama UP3 SBS" class="mr-2" required>
                            Pos Jaga Bersama UP3 SBS
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="area" value="UP2W VI" class="mr-2">
                            UP2W VI
                        </label>
                    </div>
                </div>

                <!-- 3. Nama Petugas Jaga -->
                <div class="mb-6">
                    <label class="block text-md font-medium text-gray-700 mb-2">
                        3. Nama Petugas Jaga <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="MARJOKO" class="mr-2">
                            MARJOKO
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="KARNO" class="mr-2">
                            KARNO
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="SOBACHUS SURUR" class="mr-2">
                            SOBACHUS SURUR
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="IPUNG ASWIANTO" class="mr-2">
                            IPUNG ASWIANTO
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="EKO ARIS IKHWANUDIN" class="mr-2">
                            EKO ARIS IKHWANUDIN
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="BOBY PURWANTO" class="mr-2">
                            BOBY PURWANTO
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="HARYONO" class="mr-2">
                            HARYONO
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="KINDLY CHOIRUL HAQIQI" class="mr-2">
                            KINDLY CHOIRUL HAQIQI
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="AMBAR SONIG" class="mr-2">
                            AMBAR SONIG
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="REZA TRI PUTRA" class="mr-2">
                            REZA TRI PUTRA
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="EGI AGUS KARYANTO" class="mr-2">
                            EGI AGUS KARYANTO
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama_petugas[]" value="ABDU ISMAIL" class="mr-2">
                            ABDU ISMAIL
                        </label>
                    </div>
                </div>
            </div>

            <!-- BAGIAN 4: Penggunaan Seragam -->
            <div class="mb-8 p-4 bg-blue-50 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">1. Penggunaan Seragam dan Kelengkapan Atribut sesuai Ketentuan</h3>
                <p class="text-sm text-gray-600 mb-4">Wajib 100% kelengkapan seragam dan kelengkapan atribut sesuai ketentuan</p>
                
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="radio" name="seragam_status" value="Sesuai 100%" class="mr-2" onchange="toggleSection('seragam')">
                        Sesuai 100%
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="seragam_status" value="Tidak Sesuai" class="mr-2" onchange="toggleSection('seragam')">
                        Tidak Sesuai
                    </label>
                </div>

                <!-- Dokumentasi Seragam -->
                <div id="seragam_doc" class="mt-4 hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Lampirkan Foto Saat Apel Serah Terima Antar Shift <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="foto_serahterima" accept="image/*" 
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                                      file:rounded-md file:border-0 file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>
            </div>

            <!-- BAGIAN 5: Kegiatan Pengamanan -->
            <div class="mb-8 p-4 bg-green-50 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">2. Melaksanakan kegiatan pengamanan di sekitar objek pengamanan</h3>
                <p class="text-sm text-gray-600 mb-4">Nol (0) tindak kriminal di sekitar objek pengamanan (misal: sekitar lingkungan kantor, rumah jabatan dan instalasinya)</p>
                
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="radio" name="pengamanan_status" value="Nol (0) tindak kriminal" class="mr-2" onchange="toggleSection('pengamanan')">
                        Nol (0) tindak kriminal
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="pengamanan_status" value="Tidak Dilaksanakan" class="mr-2" onchange="toggleSection('pengamanan')">
                        Tidak Dilaksanakan
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="pengamanan_status" value="Terjadi Tindak Kriminal" class="mr-2" onchange="toggleSection('pengamanan')">
                        Terjadi Tindak Kriminal
                    </label>
                </div>

                <!-- Dokumentasi Pengamanan -->
                <div id="pengamanan_doc" class="mt-4 hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Lampirkan Foto Patroli Kegiatan <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="foto_patroli" accept="image/*" 
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                                      file:rounded-md file:border-0 file:text-sm file:font-semibold
                                      file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    </div>
                </div>

                <!-- Kronologi Kriminal -->
                <div id="pengamanan_kronologi" class="mt-4 hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tuliskan Kronologi Kejadian
                        </label>
                        <textarea name="kronologi_kriminal" rows="4" 
                                  class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                  placeholder="Deskripsikan kejadian beserta waktu kejadian"></textarea>
                    </div>
                </div>
            </div>

            <!-- BAGIAN 6: Fungsi Khusus -->
            <div class="mb-8 p-4 bg-purple-50 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">3. Melaksanakan fungsi pengamanan dalam kegiatan / peristiwa khusus (pameran, family day, dll)</h3>
                <p class="text-sm text-gray-600 mb-4">Nol (0) tindak kriminal dan 100% pelaksanaan kegiatan secara tertib dan kondusif</p>
                
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="radio" name="fungsi_khusus_status" value="Nol (0) tindak kriminal" class="mr-2" onchange="toggleSection('fungsi_khusus')">
                        Nol (0) tindak kriminal
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="fungsi_khusus_status" value="Terjadi tindak kriminal" class="mr-2" onchange="toggleSection('fungsi_khusus')">
                        Terjadi tindak kriminal
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="fungsi_khusus_status" value="Nihil Kegiatan" class="mr-2" onchange="toggleSection('fungsi_khusus')">
                        Nihil Kegiatan
                    </label>
                </div>

                <!-- Dokumentasi Fungsi Khusus -->
                <div id="fungsi_khusus_doc" class="mt-4 hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Lampirkan Foto Giat Lembur Kegiatan
                        </label>
                        <input type="file" name="foto_lembur" accept="image/*" 
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                                      file:rounded-md file:border-0 file:text-sm file:font-semibold
                                      file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                    </div>
                </div>

                <!-- Kronologi Gangguan -->
                <div id="fungsi_khusus_kronologi" class="mt-4 hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tuliskan Kronologi Kejadian
                        </label>
                        <textarea name="kronologi_gangguan" rows="4" 
                                  class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                                  placeholder="Teks jawaban panjang"></textarea>
                    </div>
                </div>
            </div>

            <!-- BAGIAN 7: Memantau dan Mencatat -->
            <div class="mb-8 p-4 bg-yellow-50 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">4. Memantau dan mencatat secara detail lalu lintas orang dan kendaraan yang masuk dan keluar di sekitar objek pengamanan</h3>
                <p class="text-sm text-gray-600 mb-4">100% kelengkapan dan akurasi pencatatan tamu dan kendaraan yang masuk dan keluar</p>
                
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="radio" name="memantau_status" value="Tercatat, Tertib" class="mr-2" onchange="toggleSection('memantau')">
                        Tercatat, Tertib
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="memantau_status" value="Tidak Tercatat" class="mr-2" onchange="toggleSection('memantau')">
                        Tidak Tercatat
                    </label>
                </div>

                <!-- Dokumentasi Memantau -->
                <div id="memantau_doc" class="mt-4 hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Lampirkan Foto Jurnal Satpam dan pencatatan tamu/ kendaraan <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="foto_tamu" accept="image/*" 
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                                      file:rounded-md file:border-0 file:text-sm file:font-semibold
                                      file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
                    </div>
                </div>
            </div>

            <!-- BAGIAN 8: Memberikan Pelayanan -->
            <div class="mb-8 p-4 bg-indigo-50 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">5. Memberikan pelayanan informasi yang di butuhkan oleh tamu karyawan dan tenan sesuai standar SMP</h3>
                <p class="text-sm text-gray-600 mb-4">100% permintaan pelayanan informasi, keluhan keamanan dan petunjuk lokasi bagi tamu, karyawan, dan tenan terselesaikan sesuai standar Sistem Manajemen Pengamanan</p>
                
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="radio" name="pelayanan_status" value="100% Terpenuhi" class="mr-2" onchange="toggleSection('pelayanan')">
                        100% Terpenuhi
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="pelayanan_status" value="Nihil Tamu" class="mr-2" onchange="toggleSection('pelayanan')">
                        Nihil Tamu
                    </label>
                </div>

                <!-- Dokumentasi Pelayanan -->
                <div id="pelayanan_doc" class="mt-4 hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Lampirkan Dokumentasi panduan keselamatan kerja ke mitra atau tamu
                        </label>
                        <input type="file" name="foto_panduan" accept="image/*" 
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                                      file:rounded-md file:border-0 file:text-sm file:font-semibold
                                      file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>
            </div>

            <!-- BAGIAN 9: Force Majeure -->
            <div class="mb-8 p-4 bg-red-50 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">6. Melaksanakan fungsi pengamanan dalam kejadian force majeure sesuai standar SMP</h3>
                <p class="text-sm text-gray-600 mb-4">100% pelaksanaan penanganan force majeure (misal: peringatan dini, komunikasi, evaluasi) berjalan secara tertib dan kondusif</p>
                
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="radio" name="force_status" value="Dilaksanakan" class="mr-2" onchange="toggleSection('force')">
                        Dilaksanakan
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="force_status" value="Tidak Terjadi" class="mr-2" onchange="toggleSection('force')">
                        Tidak Terjadi
                    </label>
                </div>

                <!-- Dokumentasi Force -->
                <div id="force_doc" class="mt-4 hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Lampirkan Foto Pelaksanaan fungsi pengamanan dalam kejadian force majeure sesuai standar SMP
                        </label>
                        <input type="file" name="foto_force" accept="image/*" 
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                                      file:rounded-md file:border-0 file:text-sm file:font-semibold
                                      file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 font-medium">
                    Simpan Laporan
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleSection(sectionName) {
            const radios = document.querySelectorAll(`input[name="${sectionName}_status"]`);
            const docSection = document.getElementById(`${sectionName}_doc`);
            const kronologiSection = document.getElementById(`${sectionName}_kronologi`);
            
            let selectedValue = '';
            radios.forEach(radio => {
                if (radio.checked) {
                    selectedValue = radio.value;
                }
            });

            // Reset semua section
            if (docSection) docSection.classList.add('hidden');
            if (kronologiSection) kronologiSection.classList.add('hidden');

            // Show section berdasarkan pilihan
            if (sectionName === 'seragam' && selectedValue !== 'Sesuai 100%') {
                if (docSection) docSection.classList.remove('hidden');
            }
            else if (sectionName === 'pengamanan') {
                if (selectedValue === 'Nol (0) tindak kriminal' || selectedValue === 'Tidak Dilaksanakan') {
                    if (docSection) docSection.classList.remove('hidden');
                }
                if (selectedValue === 'Terjadi Tindak Kriminal') {
                    if (kronologiSection) kronologiSection.classList.remove('hidden');
                }
            }
            else if (sectionName === 'fungsi_khusus') {
                if (selectedValue === 'Nol (0) tindak kriminal') {
                    if (docSection) docSection.classList.remove('hidden');
                }
                if (selectedValue === 'Terjadi tindak kriminal') {
                    if (kronologiSection) kronologiSection.classList.remove('hidden');
                }
            }
            else if (sectionName === 'memantau' && selectedValue === 'Tercatat, Tertib') {
                if (docSection) docSection.classList.remove('hidden');
            }
            else if (sectionName === 'pelayanan' && selectedValue === '100% Terpenuhi') {
                if (docSection) docSection.classList.remove('hidden');
            }
            else if (sectionName === 'force' && selectedValue === 'Dilaksanakan') {
                if (docSection) docSection.classList.remove('hidden');
            }
        }

        // Form submission
        document.getElementById('mainForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Form berhasil disubmit! (Ini hanya demo)');
        });
    </script>
</body>
</html>