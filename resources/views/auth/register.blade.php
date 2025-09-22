<x-guest-layout>
    <div class="rounded-2xl shadow-sm sm:shadow-xl
        mx-auto w-full max-w-[95%] sm:max-w-lg lg:max-w-2xl
        px-4 sm:px-6 lg:px-10 py-6 sm:py-8 lg:py-10
        border-0 sm:border sm:border-gray-200
        bg-white">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" alt="Logo PLN" class="h-20 w-auto">
        </div>

        <!-- Title -->
        <h2 class="text-1xl sm:text-2xl font-bold text-gray-800 text-center mb-8">Daftar Akun Baru</h2>

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Username -->
            <div>
                <x-input-label for="name" :value="__('Username')" class="mb-1 text-gray-700" />
                <x-text-input id="name" class="block w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#196275] focus:border-[#196275]" 
                              type="text" name="name" :value="old('name')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="mb-1 text-gray-700" />
                <x-text-input id="email" class="block w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#196275] focus:border-[#196275]" 
                              type="email" name="email" :value="old('email')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="mb-1 text-gray-700" />
                <x-text-input id="password" class="block w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#196275] focus:border-[#196275]" 
                              type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="mb-1 text-gray-700" />
                <x-text-input id="password_confirmation" class="block w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#196275] focus:border-[#196275]" 
                              type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Submit -->
            <div>
                <x-primary-button class="w-full bg-[#196275] hover:bg-[#104855] text-white font-semibold py-3 rounded-xl shadow-md transition duration-300 flex items-center justify-center">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Back / Already Registered -->
        <div class="mt-6 text-center space-y-3">
            <a href="{{ route('login') }}" class="block text-sm text-gray-600 hover:text-[#196275] transition">
                Sudah punya akun? Login
            </a>
            <a href="{{ route('welcome') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-full transition duration-300">
                ← Kembal
            </a>
        </div>
    </div>
</x-guest-layout>
