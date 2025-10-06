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
                            <div id="loadMoreContainer" class="mt-6 text-left" style="display: none;">
                                <button id="loadMoreBtn" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-1.5 px-4 rounded-md transition duration-150">
                                    Muat Foto Lainnya
                                </button>
                                <p id="remainingCount" class="text-sm text-gray-500 mt-2"></p>
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
        // Deklarasi data SEKALI di awal
        const shiftData = @json($shiftData);
        const areaData = @json($areaData);
        const petugasData = @json($petugasData);
        const seragamData = @json($seragamData);
        const fotoData = @json($fotoSerahterima);

        console.log('Shift Data:', shiftData);
        console.log('Area Data:', areaData);
        console.log('Petugas Data:', petugasData);
        console.log('Seragam Data:', seragamData);
        console.log('Foto Data:', fotoData);

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
        const petugasCtx = document.getElementById('petugasChart').getContext('2d');
        new Chart(petugasCtx, {
            type: 'bar',
            data: {
                labels: petugasData.map(item => item.nama),
                datasets: [{
                    data: petugasData.map(item => item.count),
                    backgroundColor: '#D4AF77',
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
                    legend: { 
                        display: false 
                    },
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
                        font: { 
                            size: 10,
                            weight: 'normal'
                        },
                        formatter: (value, context) => {
                            const percentage = petugasData[context.dataIndex].percentage;
                            return value + ' (' + percentage + '%)';
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { 
                            display: false 
                        },
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        grid: { 
                            display: false 
                        },
                        ticks: {
                            autoSkip: false,
                            font: {
                                size: 11
                            }
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
        const initialLoad = 10;

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
    </script>
    @endif
</x-app-layout>