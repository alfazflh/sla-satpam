<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kegiatan Anggota Satuan Pengamana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .step-indicator {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .step-active {
            background-color: #2563eb;
            color: white;
        }
        .step-completed {
            background-color: #10b981;
            color: white;
        }
        .step-inactive {
            background-color: #d1d5db;
            color: #6b7280;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white shadow-lg min-h-screen">
        <!-- Progress Bar -->
        <div class="bg-white p-4 border-b sticky top-0 z-10">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold">LAPORAN KEGIATAN ANGGOTA SATUAN PENGAMANAN</h1>
                <div class="text-sm text-gray-600">
                    <span id="current-step">Bagian 1</span> dari <span id="total-steps">30</span>
                </div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="progress-bar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 3.33%"></div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="p-6">
            <form id="mainForm">
                <!-- Step 1: Waktu Jaga Shift -->
                <div class="step-section active" id="step-1">
                    <div class="mb-4">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-2 py-1 bg-yellow-200 text-yellow-800 text-sm font-medium rounded">Bagian 1 dari 30</span>
                        </div>
                        <h2 class="text-lg font-semibold mb-4">1. Waktu Jaga Shift</h2>
                        <p class="text-sm text-gray-600 mb-4">Pilih waktu shift yang sesuai</p>
                        
                        <div class="space-y-3">
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="waktu_shift" value="Shift 1 : 07.00 - 15.00" class="mr-3">
                                <span>Shift 1 : 07.00 SD 15.00</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="waktu_shift" value="Shift 2 : 15.00 - 23.00" class="mr-3">
                                <span>Shift 2 : 15.00 SD 23.00</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="waktu_shift" value="Shift 3 : 23.00 - 07.00" class="mr-3">
                                <span>Shift 3 : 23.00 SD 07.00</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-6">
                        <div></div>
                        <button type="button" class="next-btn bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700" disabled>
                            Lanjutkan ke bagian berikut
                        </button>
                    </div>
                </div>

                <!-- Step 2: Area Kerja -->
                <div class="step-section" id="step-2">
                    <div class="mb-4">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-2 py-1 bg-yellow-200 text-yellow-800 text-sm font-medium rounded">Bagian 2 dari 30</span>
                        </div>
                        <h2 class="text-lg font-semibold mb-4">2. Area Kerja</h2>
                        <p class="text-sm text-gray-600 mb-4">Pilih area kerja yang sesuai</p>
                        
                        <div class="space-y-3">
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="area" value="Pos Jaga Bersama UP3 SBS" class="mr-3">
                                <span>Pos Jaga Bersama UP3 SBS</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="area" value="UP2W VI" class="mr-3">
                                <span>UP2W VI</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-6">
                        <button type="button" class="prev-btn bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                            Setelah bagian 1
                        </button>
                        <button type="button" class="next-btn bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700" disabled>
                            Lanjutkan ke bagian berikut
                        </button>
                    </div>
                </div>

                <!-- Step 3: Nama Petugas -->
                <div class="step-section" id="step-3">
                    <div class="mb-4">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-2 py-1 bg-yellow-200 text-yellow-800 text-sm font-medium rounded">Bagian 3 dari 30</span>
                        </div>
                        <h2 class="text-lg font-semibold mb-4">3. Nama Petugas Jaga</h2>
                        <p class="text-sm text-gray-600 mb-4">Pilih nama petugas yang bertugas</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="MARJOKO" class="mr-3">
                                <span>MARJOKO</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="KARNO" class="mr-3">
                                <span>KARNO</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="SOBACHUS SURUR" class="mr-3">
                                <span>SOBACHUS SURUR</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="IPUNG ASWIANTO" class="mr-3">
                                <span>IPUNG ASWIANTO</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="EKO ARIS IKHWANUDIN" class="mr-3">
                                <span>EKO ARIS IKHWANUDIN</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="BOBY PURWANTO" class="mr-3">
                                <span>BOBY PURWANTO</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="HARYONO" class="mr-3">
                                <span>HARYONO</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="KINDLY CHOIRUL HAQIQI" class="mr-3">
                                <span>KINDLY CHOIRUL HAQIQI</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="AMBAR SONIG" class="mr-3">
                                <span>AMBAR SONIG</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="REZA TRI PUTRA" class="mr-3">
                                <span>REZA TRI PUTRA</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="EGI AGUS KARYANTO" class="mr-3">
                                <span>EGI AGUS KARYANTO</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="nama_petugas[]" value="ABDU ISMAIL" class="mr-3">
                                <span>ABDU ISMAIL</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-6">
                        <button type="button" class="prev-btn bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                            Setelah bagian 2
                        </button>
                        <button type="button" class="next-btn bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700" disabled>
                            Lanjutkan ke bagian berikut
                        </button>
                    </div>
                </div>

                <!-- Step 4: Penggunaan Seragam -->
                <div class="step-section" id="step-4">
                    <div class="mb-4">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-2 py-1 bg-blue-200 text-blue-800 text-sm font-medium rounded">Bagian 4 dari 30</span>
                        </div>
                        <h2 class="text-lg font-semibold mb-4">1. Penggunaan Seragam dan Kelengkapan Atribut sesuai Ketentuan</h2>
                        <p class="text-sm text-gray-600 mb-4">Wajib 100% kelengkapan seragam dan kelengkapan atribut sesuai ketentuan</p>
                        
                        <div class="space-y-3">
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="seragam_status" value="Sesuai 100%" class="mr-3">
                                <span>Sesuai 100%</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="seragam_status" value="Tidak Sesuai" class="mr-3">
                                <span>Tidak Sesuai</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-6">
                        <button type="button" class="prev-btn bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                            Setelah bagian 3
                        </button>
                        <button type="button" class="next-btn bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700" disabled>
                            Lanjutkan ke bagian berikut
                        </button>
                    </div>
                </div>

                <!-- Step 5: Dokumentasi Seragam -->
                <div class="step-section conditional-step" id="step-5" data-show-when="seragam_status" data-show-values="Sesuai 100%,Tidak Sesuai">
                    <div class="mb-4">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-2 py-1 bg-blue-200 text-blue-800 text-sm font-medium rounded">Bagian 5 dari 30</span>
                        </div>
                        <h2 class="text-lg font-semibold mb-4">Dokumentasi Penggunaan Seragam dan Kelengkapan Atribut sesuai Ketentuan</h2>
                        <p class="text-sm text-gray-600 mb-4">Deskripsi (opsional)</p>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Lampirkan Foto Saat Apel Serah Terima Antar Shift <span class="text-red-500">*</span>
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                <input type="file" name="foto_seragam" accept="image/*" class="hidden" id="file-seragam">
                                <label for="file-seragam" class="cursor-pointer">
                                    <div class="text-gray-500">
                                        <span class="inline-block w-12 h-12 mb-2">📁</span>
                                        <p>Tambahkan file</p>
                                        <p class="text-xs mt-1">atau seret file ke sini</p>
                                    </div>
                                </label>
                                <button type="button" class="text-blue-600 hover:text-blue-700 text-sm mt-2">Lihat folder</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-6">
                        <button type="button" class="prev-btn bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                            Setelah bagian 4
                        </button>
                        <button type="button" class="next-btn bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                            Lanjutkan ke bagian berikut
                        </button>
                    </div>
                </div>

                <!-- Continue with more steps following the same pattern... -->
                <!-- For brevity, I'll add a few more key steps -->

                <!-- Step 6: Kegiatan Pengamanan -->
                <div class="step-section" id="step-6">
                    <div class="mb-4">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-2 py-1 bg-green-200 text-green-800 text-sm font-medium rounded">Bagian 6 dari 30</span>
                        </div>
                        <h2 class="text-lg font-semibold mb-4">2. Melaksanakan kegiatan pengamanan di sekitar objek pengamanan</h2>
                        <p class="text-sm text-gray-600 mb-4">Nol (0) tindak kriminal di sekitar objek pengamanan (misal: sekitar lingkungan kantor, rumah jabatan dan instalasinya) antara lain memastikan orang dan peralatan yang ada dalam objek pengamanan bebas dari tindakan kriminal sesuai standar Sistem Manajemen Pengamanan</p>
                        
                        <div class="space-y-3">
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="pengamanan_status" value="Nol (0) tindak kriminal" class="mr-3">
                                <span>Nol (0) tindak kriminal</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="pengamanan_status" value="Tidak Dilaksanakan" class="mr-3">
                                <span>Tidak Dilaksanakan</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="pengamanan_status" value="Terjadi Tindak Kriminal" class="mr-3">
                                <span>Terjadi Tindak Kriminal</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-6">
                        <button type="button" class="prev-btn bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                            Setelah bagian 5
                        </button>
                        <button type="button" class="next-btn bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700" disabled>
                            Lanjutkan ke bagian berikut
                        </button>
                    </div>
                </div>

                <!-- Final Step: Submit -->
                <div class="step-section" id="step-30">
                    <div class="mb-4">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-2 py-1 bg-green-200 text-green-800 text-sm font-medium rounded">Bagian 30 dari 30</span>
                        </div>
                        <h2 class="text-lg font-semibold mb-4">Review dan Submit</h2>
                        <p class="text-sm text-gray-600 mb-4">Silakan review semua data yang telah diisi sebelum mengirim laporan.</p>
                        
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <h3 class="font-medium text-green-800 mb-2">Data berhasil diisi:</h3>
                            <ul class="text-sm text-green-700 space-y-1" id="summary-list">
                                <!-- Summary will be populated by JavaScript -->
                            </ul>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-6">
                        <button type="button" class="prev-btn bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                            Kembali
                        </button>
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 font-medium">
                            Simpan Laporan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 30;
        const formData = {};

        function updateProgressBar() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progress-bar').style.width = progress + '%';
            document.getElementById('current-step').textContent = `Bagian ${currentStep}`;
        }

        function showStep(stepNumber) {
            // Hide all steps
            document.querySelectorAll('.step-section').forEach(section => {
                section.classList.remove('active');
                section.style.display = 'none';
            });
            
            // Show current step
            const currentStepElement = document.getElementById(`step-${stepNumber}`);
            if (currentStepElement) {
                currentStepElement.style.display = 'block';
                currentStepElement.classList.add('active');
            }
            
            updateProgressBar();
        }

        function validateCurrentStep() {
            const currentStepElement = document.getElementById(`step-${currentStep}`);
            const requiredInputs = currentStepElement.querySelectorAll('input[required], input[type="radio"]:not([name*="conditional"]), input[type="checkbox"]');
            
            let isValid = true;
            const stepType = currentStep;
            
            // Validation logic based on step
            if (stepType <= 3) {
                // Steps 1-3: Radio buttons (required)
                const radioName = currentStepElement.querySelector('input[type="radio"]')?.name;
                if (radioName && !currentStepElement.querySelector(`input[name="${radioName}"]:checked`)) {
                    isValid = false;
                }
            } else if (stepType === 3) {
                // Step 3: Checkboxes (at least one required)
                const checkboxes = currentStepElement.querySelectorAll('input[type="checkbox"]:checked');
                if (checkboxes.length === 0) {
                    isValid = false;
                }
            } else {
                // Other steps: Radio buttons
                const radioName = currentStepElement.querySelector('input[type="radio"]')?.name;
                if (radioName && !currentStepElement.querySelector(`input[name="${radioName}"]:checked`)) {
                    isValid = false;
                }
            }
            
            return isValid;
        }

        function updateNextButton() {
            const currentStepElement = document.getElementById(`step-${currentStep}`);
            const nextBtn = currentStepElement?.querySelector('.next-btn');
            
            if (nextBtn) {
                if (validateCurrentStep()) {
                    nextBtn.disabled = false;
                    nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    nextBtn.disabled = true;
                    nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            }
        }

        function nextStep() {
            if (!validateCurrentStep()) {
                alert('Mohon lengkapi semua field yang diperlukan sebelum melanjutkan.');
                return;
            }
            
            // Save current step data
            saveCurrentStepData();
            
            // Check if we need to show conditional steps
            const nextStepToShow = determineNextStep();
            
            if (nextStepToShow <= totalSteps) {
                currentStep = nextStepToShow;
                showStep(currentStep);
                updateNextButton();
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep = determinePrevStep();
                showStep(currentStep);
                updateNextButton();
            }
        }

        function determineNextStep() {
            // Logic to determine next step based on current answers
            if (currentStep === 4) {
                // After seragam question, always go to documentation
                return 5;
            } else if (currentStep === 5) {
                return 6;
            } else if (currentStep < totalSteps) {
                return currentStep + 1;
            }
            return currentStep;
        }

        function determinePrevStep() {
            return currentStep - 1;
        }

        function saveCurrentStepData() {
            const currentStepElement = document.getElementById(`step-${currentStep}`);
            const inputs = currentStepElement.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                if (input.type === 'radio' && input.checked) {
                    formData[input.name] = input.value;
                } else if (input.type === 'checkbox' && input.checked) {
                    if (!formData[input.name]) formData[input.name] = [];
                    formData[input.name].push(input.value);
                } else if (input.type !== 'radio' && input.type !== 'checkbox') {
                    formData[input.name] = input.value;
                }
            });
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            showStep(1);
            updateNextButton();
            
            // Add event listeners to all form inputs
            document.addEventListener('change', updateNextButton);
            document.addEventListener('input', updateNextButton);
            
            // Next button listeners
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('next-btn')) {
                    e.preventDefault();
                    nextStep();
                }
                
                if (e.target.classList.contains('prev-btn')) {
                    e.preventDefault();
                    prevStep();
                }
            });
            
            // Form submission
            document.getElementById('mainForm').addEventListener('submit', function(e) {
                e.preventDefault();
                saveCurrentStepData();
                
                // Create summary
                const summaryList = document.getElementById('summary-list');
                summaryList.innerHTML = '';
                
                Object.keys(formData).forEach(key => {
                    if (formData[key] && formData[key] !== '') {
                        const li = document.createElement('li');
                        li.textContent = `${key}: ${Array.isArray(formData[key]) ? formData[key].join(', ') : formData[key]}`;
                        summaryList.appendChild(li);
                    }
                });
                
                alert('Laporan berhasil disimpan! Data telah dikirim untuk diproses.');
                console.log('Form Data:', formData);
            });
        });

        // Initialize
        showStep(1);
    </script>
</body>
</html>