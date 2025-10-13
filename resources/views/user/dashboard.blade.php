<x-app-layout>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Test Upload Foto</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold mb-6">Test Upload Multiple Files</h1>
                
                <form id="testForm" action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block mb-2">Waktu Shift:</label>
                        <select name="waktu" class="border p-2 w-full" required>
                            <option value="Shift 1 : 07.00 SD 15.00">Shift 1 : 07.00 SD 15.00</option>
                            <option value="Shift 2 : 15.00 SD 23.00">Shift 2 : 15.00 SD 23.00</option>
                            <option value="Shift 3 : 23.00 SD 07.00">Shift 3 : 23.00 SD 07.00</option>
                        </select>
                    </div>
    
                    <div class="mb-6">
                        <label class="block mb-2">Area:</label>
                        <select name="area" class="border p-2 w-full" required>
                            <option value="Pos Jaga Bersama UP3 SBS">Pos Jaga Bersama UP3 SBS</option>
                            <option value="UP2W VI">UP2W VI</option>
                        </select>
                    </div>
    
                    <div class="mb-6">
                        <label class="block mb-2">Nama (minimal 1):</label>
                        <label class="flex items-center mb-2">
                            <input type="checkbox" name="nama[]" value="REZA TRI PUTRA" class="mr-2">
                            REZA TRI PUTRA
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="nama[]" value="ABDU ISMAIL" class="mr-2">
                            ABDU ISMAIL
                        </label>
                    </div>
    
                    <div class="mb-6">
                        <label class="block mb-2">Seragam:</label>
                        <select name="ketentuan_seragam" class="border p-2 w-full">
                            <option value="Sesuai 100%">Sesuai 100%</option>
                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                        </select>
                    </div>
    
                    <div class="mb-6 border-2 border-dashed p-4">
                        <label class="block mb-2 font-bold">📷 Foto Serah Terima (Multiple):</label>
                        <input type="file" name="foto_serahterima[]" multiple accept="image/*" 
                               class="border p-2 w-full" id="foto1">
                        <p class="text-sm text-gray-600 mt-2" id="preview1"></p>
                    </div>
    
                    <div class="mb-6 border-2 border-dashed p-4">
                        <label class="block mb-2 font-bold">📷 Foto Patroli (Multiple):</label>
                        <input type="file" name="foto_patroli[]" multiple accept="image/*" 
                               class="border p-2 w-full" id="foto2">
                        <p class="text-sm text-gray-600 mt-2" id="preview2"></p>
                    </div>
    
                    <div class="mb-6">
                        <label class="block mb-2">Pengamanan:</label>
                        <select name="pengamanan" class="border p-2 w-full">
                            <option value="Nol (0) tindak kriminal">Nol (0) tindak kriminal</option>
                            <option value="Tidak Dilaksanakan">Tidak Dilaksanakan</option>
                        </select>
                    </div>
    
                    <div class="mb-6">
                        <label class="block mb-2">Kronologi CCTV:</label>
                        <textarea name="kronologi_cctv" class="border p-2 w-full" rows="3"></textarea>
                    </div>
    
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg w-full">
                        KIRIM TEST
                    </button>
                </form>
            </div>
        </div>
    
        <script>
            // Preview file yang dipilih
            document.getElementById('foto1').addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                document.getElementById('preview1').textContent = 
                    `${files.length} file dipilih: ${files.map(f => f.name).join(', ')}`;
            });
    
            document.getElementById('foto2').addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                document.getElementById('preview2').textContent = 
                    `${files.length} file dipilih: ${files.map(f => f.name).join(', ')}`;
            });
    
            document.getElementById('testForm').addEventListener('submit', function(e) {
                e.preventDefault();
    
                const formData = new FormData(this);
    
                console.log('=== FORM DATA ===');
                for (let [key, value] of formData.entries()) {
                    if (value instanceof File) {
                        console.log(`${key}: [FILE] ${value.name} (${value.size} bytes)`);
                    } else {
                        console.log(`${key}: ${value}`);
                    }
                }
    
                Swal.fire({
                    title: 'Mengirim...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
    
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(async response => {
                    const data = await response.json();
                    console.log('Response:', data);
    
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil disimpan dengan ID: ' + data.data
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            html: `<pre>${JSON.stringify(data, null, 2)}</pre>`
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.message
                    });
                });
            });
        </script>
    </body>
    </html>
</x-app-layout>
