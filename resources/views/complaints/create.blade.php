<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('complaints.index') }}" class="inline-flex items-center px-4 py-2 mb-4 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
            &larr; Kembali
        </a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('complaints.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                            <input id="nis" name="nis" type="text" value="{{ old('nis') }}" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" placeholder="Masukkan NIS" required>
                            @error('nis')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori Sarana</label>
                            <select id="category" name="category" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Kategori</option>
                                <option value="kelas" {{ old('category') == 'kelas' ? 'selected' : '' }}>Kelas</option>
                                <option value="toilet" {{ old('category') == 'toilet' ? 'selected' : '' }}>Toilet</option>
                                <option value="kantin" {{ old('category') == 'kantin' ? 'selected' : '' }}>Kantin</option>
                                <option value="lapangan" {{ old('category') == 'lapangan' ? 'selected' : '' }}>Lapangan Olahraga</option>
                                <option value="laboratorium" {{ old('category') == 'laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                                <option value="perpustakaan" {{ old('category') == 'perpustakaan' ? 'selected' : '' }}>Perpustakaan</option>
                                <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Pengaduan</label>
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" placeholder="Jelaskan masalah sarana sekolah..." required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                            <input id="location" name="location" type="text" value="{{ old('location') }}" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" placeholder="Contoh: Gedung A, Ruang Kelas 3" required>
                        </div>

                        <div class="mb-4">
                            <label for="incident_date" class="block text-sm font-medium text-gray-700">Tanggal Kejadian</label>
                            <input id="incident_date" name="incident_date" type="date" value="{{ old('incident_date') }}" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" required>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Kirim Pengaduan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>