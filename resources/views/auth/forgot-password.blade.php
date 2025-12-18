<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Pilih metode untuk mereset password Anda.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="space-y-4">
        <!-- Security Question Method -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h3 class="text-lg font-medium text-blue-900 mb-2">Reset via Pertanyaan Keamanan</h3>
            <p class="text-sm text-blue-700 mb-3">Jawab pertanyaan keamanan yang Anda set saat registrasi</p>
            <a href="{{ route('security_question') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                Gunakan Pertanyaan Keamanan
            </a>
        </div>

        <!-- Email Method (Disabled for demo) -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 opacity-50">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Reset via Email</h3>
            <p class="text-sm text-gray-700 mb-3">Kirim link reset ke email Anda (tidak tersedia untuk demo)</p>
            <button disabled class="bg-gray-400 text-white px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                Email Tidak Tersedia
            </button>
        </div>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">← Kembali ke Login</a>
    </div>
</x-guest-layout>
