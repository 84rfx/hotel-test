<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pesan') }}
            </h2>
            <a href="{{ route('admin.messages.index') }}" class="text-gray-600 hover:text-gray-900">← Kembali ke Daftar Pesan</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="border-b pb-4 mb-4">
                        <h3 class="text-lg font-semibold">{{ $message->subject }}</h3>
                        <div class="mt-2 text-sm text-gray-600">
                            <p><strong>Dari:</strong> {{ $message->name }} ({{ $message->email }})</p>
                            <p><strong>Telepon:</strong> {{ $message->phone }}</p>
                            <p><strong>Departemen:</strong> {{ $message->department }}</p>
                            <p><strong>Tanggal:</strong> {{ $message->created_at->format('d M Y H:i') }}</p>
                            <p><strong>Status:</strong>
                                <span class="px-2 py-1 rounded text-xs {{ $message->read ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $message->read ? 'Dibaca' : 'Belum Dibaca' }}
                                </span>
                                @if($message->read)
                                    pada {{ $message->read_at ? $message->read_at->format('d M Y H:i') : 'N/A' }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-medium mb-2">Pesan:</h4>
                        <div class="bg-gray-50 p-4 rounded-lg whitespace-pre-wrap">
                            {{ $message->message }}
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        @if(!$message->read)
                            <form method="POST" action="{{ route('admin.messages.mark-read', $message) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Tandai Sudah Dibaca
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Hapus Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
