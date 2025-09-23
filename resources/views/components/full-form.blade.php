<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-xl font-bold mb-6">LAPORAN KEGIATAN ANGGOTA SATUAN PENGAMANAN</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Waktu, Area, Nama --}}
        <div class="mb-4">
            <label class="block text-md font-medium text-gray-700">1. Waktu Jaga Shift</label>
            <input type="datetime-local" name="waktu" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">2. Area kerja</label>
            <input type="text" name="area" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">3. Nama Petugas Jaga</label>
            <input type="text" name="nama" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
        </div>

        {{-- Field dinamis --}}
        @php
            $fields = [
                ['Ketentuan Seragam', 'ketentuan_seragam', 'textarea'],
                ['Foto Serah Terima', 'foto_serahterima', 'file'],
                ['Pengamanan', 'pengamanan', 'textarea'],
                ['Foto Patroli', 'foto_patroli', 'file'],
                ['Kronologi Kriminal', 'kronologi_kriminal', 'textarea'],
                ['Fungsi Khusus', 'fungsi_khusus', 'textarea'],
                ['Foto Lembur', 'foto_lembur', 'file'],
                ['Kronologi Gangguan', 'kronologi_gangguan', 'textarea'],
                ['Memantau', 'memantau', 'textarea'],
                ['Foto Tamu', 'foto_tamu', 'file'],
                ['Pelayanan', 'pelayanan', 'textarea'],
                ['Foto Panduan', 'foto_panduan', 'file'],
                ['Fungsi Force', 'fungsi_force', 'textarea'],
                ['Foto Force', 'foto_force', 'file'],
                ['Penertiban', 'penertiban', 'textarea'],
                ['Foto Penertiban', 'foto_penertiban', 'file'],
                ['Simulasi', 'simulasi', 'textarea'],
                ['Foto Simulasi', 'foto_simulasi', 'file'],
                ['Penyegaran', 'penyegaran', 'textarea'],
                ['Foto Penyegaran', 'foto_penyegaran', 'file'],
                ['Telepon', 'telepon', 'textarea'],
                ['Foto Telepon', 'foto_telepon', 'file'],
                ['Rutin', 'rutin', 'textarea'],
                ['Titik', 'titik', 'text'],
                ['Foto Rutin', 'foto_rutin', 'file'],
                ['Pengecekan', 'pengecekan', 'textarea'],
                ['Foto Pengecekan', 'foto_pengecekan', 'file'],
                ['CCTV', 'cctv', 'textarea'],
                ['Foto CCTV', 'foto_cctv', 'file'],
                ['Kronologi CCTV', 'kronologi_cctv', 'textarea'],
            ];
        @endphp

        @foreach($fields as [$label, $name, $type])
            <div class="mb-4">
                <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>

                @if($type === 'textarea')
                    <textarea name="{{ $name }}" id="{{ $name }}" rows="3"
                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old($name) }}</textarea>
                @elseif($type === 'file')
                    <input type="file" name="{{ $name }}" id="{{ $name }}"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                               file:rounded-md file:border-0 file:text-sm file:font-semibold
                               file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                @else
                    <input type="text" name="{{ $name }}" id="{{ $name }}"
                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm" value="{{ old($name) }}">
                @endif

                @error($name)
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        @endforeach

        <button type="submit" 
            class="mt-6 w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
            Simpan
        </button>
    </form>
</div>
