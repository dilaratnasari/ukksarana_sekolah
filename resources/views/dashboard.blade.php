<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard - Pengaduan Sarana Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p>Sistem Pengaduan Sarana Sekolah - Laporkan masalah fasilitas sekolah dengan mudah.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Total Pengaduan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-600">Total Pengaduan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Complaint::count() }}</p>
                    </div>
                </div>

                <!-- Card 2: Pengaduan Menunggu -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-600">Pengaduan Menunggu</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ \App\Models\Complaint::where('status', 'menunggu')->count() }}</p>
                    </div>
                </div>

                <!-- Card 3: Pengaduan Disetujui -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-600">Pengaduan Disetujui</p>
                        <p class="text-2xl font-bold text-green-600">{{ \App\Models\Complaint::where('status', 'selesai')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Tentang Sistem Pengaduan</h3>
                <p class="text-blue-700">
                    Sistem ini memungkinkan siswa melaporkan masalah sarana sekolah seperti kelas, toilet, kantin, dll.
                    Admin akan meninjau dan menyetujui pengaduan untuk perbaikan.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
