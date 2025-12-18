<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Jawab pertanyaan keamanan untuk mereset password Anda.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('security_question_verify') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Security Answer -->
        <div class="mb-4">
            <x-input-label for="security_answer" :value="__('Jawaban Pertanyaan Keamanan')" />
            <x-text-input id="security_answer" class="block mt-1 w-full" type="text" name="security_answer" :value="old('security_answer')" required autocomplete="off" />
            <x-input-error :messages="$errors->get('security_answer')" class="mt-2" />
            <p class="text-xs text-gray-500 mt-1">Masukkan jawaban yang sama persis saat Anda mendaftar</p>
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900">← Kembali ke Pilihan Reset</a>
            <x-primary-button>
                {{ __('Verifikasi & Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
