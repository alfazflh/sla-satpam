<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="rounded-2xl shadow-sm sm:shadow-xl
            mx-auto w-full max-w-[95%] sm:max-w-lg lg:max-w-2xl
            px-4 sm:px-6 lg:px-10 py-6 sm:py-8 lg:py-10
            border-0 sm:border sm:border-gray-200
            bg-white">

            <div class="flex justify-center mb-6">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png" alt="Logo PLN" class="h-20 w-auto">
            </div>

            <!-- Title -->
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 text-center mb-8">Masuk ke Akun Admin</h2>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Username -->
                <div>
                    <x-input-label for="name" :value="__('Username')" class="mb-1 text-gray-700" />
                    <x-text-input id="name" class="block w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#196275] focus:border-[#196275]" type="text" name="name" :value="old('name')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="mb-1 text-gray-700" />
                    <x-text-input id="password" class="block w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#196275] focus:border-[#196275]" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#196275] shadow-sm focus:ring-[#196275]" name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-700">{{ __('Remember me') }}</label>
                </div>

                <!-- Submit -->
                <div>
                    <x-primary-button class="w-full bg-[#196275] hover:bg-[#104855] text-white font-semibold py-3 rounded-xl shadow-md transition duration-300 flex items-center justify-center">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>                              
            </form>

            <!-- Back Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('welcome') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-full transition duration-300">
                    ← Kembali
                </a>
            </div>
        </div>

</x-guest-layout>
