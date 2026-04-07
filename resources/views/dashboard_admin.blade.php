<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin - Pengaduan Sarana Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p>Anda login sebagai Admin Sistem Pengaduan Sarana Sekolah.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
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

                <!-- Card 3: Pengaduan Selesai -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-600">Pengaduan Selesai</p>
                        <p class="text-2xl font-bold text-green-600">{{ \App\Models\Complaint::where('status', 'selesai')->count() }}</p>
                    </div>
                </div>

                <!-- Card 4: Kelola Pengaduan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <a href="{{ route('complaints.admin') }}" class="block text-center">
                            <p class="text-sm font-medium text-gray-600">Kelola Pengaduan</p>
                            <p class="text-2xl font-bold text-blue-600">→</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Complaints -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Pengaduan Terbaru</h3>
                    @if(\App\Models\Complaint::latest()->take(5)->get()->isNotEmpty())
                        <ul class="space-y-2">
                            @foreach(\App\Models\Complaint::with('user')->latest()->take(5)->get() as $complaint)
                                <li class="flex justify-between items-center border-b pb-2">
                                    <div>
                                        <p class="font-medium">{{ ucfirst($complaint->category) }}</p>
                                        <p class="text-sm text-gray-600">{{ Str::limit($complaint->description, 50) }}</p>
                                        <p class="text-xs text-gray-500">Oleh: {{ $complaint->user->name }} - {{ $complaint->created_at->format('d M Y') }}</p>
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
                    @else
                        <p class="text-gray-500">Belum ada pengaduan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>