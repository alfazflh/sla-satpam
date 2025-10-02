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
                                    <h3 class="text-xl font-bold text-gray-900">1. Waktu Jaga Shift</h3>
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
                                    <h3 class="text-xl font-bold text-gray-900">2. Area Kerja</h3>
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
                                    <h3 class="text-xl font-bold text-gray-900">3. Nama Petugas Jaga</h3>
                                    <p class="text-sm text-gray-500">{{ $totalJawaban }} jawaban</p>
                                </div>
                            </div>
                            <div class="w-full overflow-auto">
                                <div style="height: {{ max(300, count($petugasData) * 40) }}px; min-height: 300px;">
                                    <canvas id="petugasChart"></canvas>
                                </div>
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

        console.log('Shift Data:', shiftData);
        console.log('Area Data:', areaData);
        console.log('Petugas Data:', petugasData);

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
                    barThickness: 25
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        right: 80
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
                            size: 11,
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
                            precision: 0
                        }
                    },
                    y: {
                        grid: { 
                            display: false 
                        },
                        ticks: {
                            autoSkip: false,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
    @endif
</x-app-layout>