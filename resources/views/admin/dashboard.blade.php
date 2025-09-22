<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->role === 'admin')
                        {{ __("Selamat datang di Dashboard Admin!") }}
                    @else
                        {{ __("Anda tidak memiliki akses ke halaman ini.") }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
