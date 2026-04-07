<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Pengaduan
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    &larr; Kembali
                </a>
            </div>

            <div class="bg-white shadow-md rounded-xl overflow-hidden">
                <div class="p-6">

                    {{-- Alert Success --}}
                    @if(session('success'))
                        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Filter Form --}}
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold mb-3">Filter Pengaduan</h3>
                        <form method="GET" action="{{ route('complaints.admin') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                                <input type="date" name="date" value="{{ request('date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bulan</label>
                                <select name="month" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Bulan</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tahun</label>
                                <input type="number" name="year" value="{{ request('year', date('Y')) }}" placeholder="Tahun" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Siswa</label>
                                <input type="text" name="student" value="{{ request('student') }}" placeholder="Nama atau Email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                                <select name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Semua Kategori</option>
                                    <option value="kelas" {{ request('category') == 'kelas' ? 'selected' : '' }}>Kelas</option>
                                    <option value="toilet" {{ request('category') == 'toilet' ? 'selected' : '' }}>Toilet</option>
                                    <option value="kantin" {{ request('category') == 'kantin' ? 'selected' : '' }}>Kantin</option>
                                    <option value="lapangan" {{ request('category') == 'lapangan' ? 'selected' : '' }}>Lapangan</option>
                                    <option value="laboratorium" {{ request('category') == 'laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                                    <option value="perpustakaan" {{ request('category') == 'perpustakaan' ? 'selected' : '' }}>Perpustakaan</option>
                                    <option value="lainnya" {{ request('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="md:col-span-5 flex gap-2">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Filter</button>
                                <a href="{{ route('complaints.admin') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Reset</a>
                            </div>
                        </form>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left border border-gray-200 rounded-lg">
                            
                            {{-- Head --}}
                            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-3">Pengadu</th>
                                    <th class="px-6 py-3">Kategori</th>
                                    <th class="px-6 py-3">Lokasi</th>
                                    <th class="px-6 py-3">Deskripsi</th>
                                    <th class="px-6 py-3">Tanggal Kejadian</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>

                            {{-- Body --}}
                            <tbody class="divide-y">

                                @forelse($complaints as $complaint)
                                    <tr class="hover:bg-gray-50 transition">

                                        {{-- Nama --}}
                                        <td class="px-6 py-4 font-medium text-gray-800">
                                            {{ $complaint->user->name }}
                                        </td>

                                        {{-- Kategori --}}
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-md">
                                                {{ ucfirst($complaint->category) }}
                                            </span>
                                        </td>

                                        {{-- Lokasi --}}
                                        <td class="px-6 py-4 text-gray-900">
                                            {{ $complaint->location }}
                                        </td>

                                        {{-- Deskripsi --}}
                                        <td class="px-6 py-4 text-gray-600">
                                            {{ Str::limit($complaint->description, 60) }}
                                        </td>

                                        {{-- Tanggal Kejadian --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ optional($complaint->incident_date)->format('d M Y') ?? '-' }}
                                        </td>

                                        {{-- Status --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($complaint->status == 'menunggu') bg-yellow-100 text-yellow-800
                                                @elseif($complaint->status == 'proses') bg-blue-100 text-blue-800
                                                @elseif($complaint->status == 'selesai') bg-green-100 text-green-800 @endif">
                                                @if($complaint->status == 'menunggu') Menunggu
                                                @elseif($complaint->status == 'proses') Proses
                                                @elseif($complaint->status == 'selesai') Selesai @endif
                                            </span>
                                        </td>

                                        {{-- Aksi --}}
                                        <td class="px-6 py-4 text-center">
                                            <form method="POST" action="{{ route('complaints.updateStatus', ['complaint' => $complaint->id]) }}" class="space-y-2">
                                                @csrf
                                                @method('PATCH')

                                                <select name="status" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 text-sm">
                                                    <option value="menunggu" {{ $complaint->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                    <option value="proses" {{ $complaint->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                    <option value="selesai" {{ $complaint->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>

                                                <input 
                                                    type="text" 
                                                    name="feedback" 
                                                    value="{{ old('feedback', $complaint->feedback) }}"
                                                    placeholder="Isi feedback..." 
                                                    class="border rounded text-sm w-full mt-1 px-2 py-1"
                                                >

                                                <button type="submit" class="w-full mt-1 bg-blue-500 text-white px-2 py-1 rounded text-xs" type="submit">
                                                    Update
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-6 text-gray-500">
                                            Belum ada data pengaduan
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

