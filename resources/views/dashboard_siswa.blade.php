<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Siswa - Pengaduan Sarana Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p>Anda login sebagai Siswa. Gunakan sistem ini untuk melaporkan masalah sarana sekolah.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Total Pengaduan Saya -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-600">Total Pengaduan Saya</p>
                        <p class="text-2xl font-bold text-gray-900">{{ Auth::user()->complaints->count() }}</p>
                    </div>
                </div>

                <!-- Card 2: Pengaduan Menunggu -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-600">Menunggu Proses</p>
                        <p class="text-2xl font-bold text-blue-600">{{ Auth::user()->complaints->where('status', 'proses')->count() }}</p>
                    </div>
                </div>

                <!-- Card 3: Buat Pengaduan Baru -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <a href="{{ route('complaints.create') }}" class="block text-center">
                            <p class="text-sm font-medium text-gray-600">Buat Pengaduan Baru</p>
                            <p class="text-2xl font-bold text-blue-600">+</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- My Recent Complaints -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Pengaduan Saya Terbaru</h3>
                    @if(Auth::user()->complaints->isNotEmpty())
                        <ul class="space-y-2">
                            @foreach(Auth::user()->complaints->sortByDesc('created_at')->take(5) as $complaint)
                                <li class="flex justify-between items-center border-b pb-2">
                                    <div>
                                        <p class="font-medium">{{ ucfirst($complaint->category) }}</p>
                                        <p class="text-sm text-gray-600">{{ Str::limit($complaint->description, 50) }}</p>
                                        <p class="text-xs text-gray-500">{{ $complaint->created_at->format('d M Y') }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        @if($complaint->status == 'menunggu') bg-yellow-100 text-yellow-800
                                        @elseif($complaint->status == 'proses') bg-blue-100 text-blue-800
                                        @elseif($complaint->status == 'selesai') bg-green-100 text-green-800 @endif">
                                        @if($complaint->status == 'menunggu') Menunggu
                                        @elseif($complaint->status == 'proses') Proses
                                        @elseif($complaint->status == 'selesai') Selesai @endif
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-4">
                            <a href="{{ route('complaints.index') }}" class="text-blue-600 hover:text-blue-800">Lihat Semua Pengaduan →</a>
                        </div>
                    @else
                        <p class="text-gray-500">Anda belum membuat pengaduan. <a href="{{ route('complaints.create') }}" class="text-blue-600">Buat pengaduan pertama Anda</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>