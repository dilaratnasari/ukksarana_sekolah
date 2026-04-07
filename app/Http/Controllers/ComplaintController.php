<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    // Untuk Siswa: Lihat pengaduan sendiri
    public function index()
    {
        $complaints = auth()->user()->complaints;
        return view('complaints.index', compact('complaints'));
    }

    // Form buat pengaduan
    public function create()
    {
        return view('complaints.create');
    }

    // Simpan pengaduan
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|in:kelas,toilet,kantin,lapangan,laboratorium,perpustakaan,lainnya',
            'description' => 'required|string|max:1000',
            'nis' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'incident_date' => 'required|date',
        ]);

        $complaint = new Complaint();
        $complaint->fill([
            'category' => $request->category,
            'description' => $request->description,
            'nis' => $request->nis,
            'location' => $request->location,
            'incident_date' => $request->incident_date,
        ]);
        $complaint->user_id = auth()->id();
        $complaint->status = 'menunggu';
        $complaint->save();

        return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil dikirim.');
    }

    // Untuk Admin: Lihat semua pengaduan
    public function adminIndex(Request $request)
    {
        $query = Complaint::with('user');

        // Filter berdasarkan tanggal
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Filter berdasarkan bulan dan tahun
        if ($request->filled('month') && $request->filled('year')) {
            $query->whereMonth('created_at', $request->month)
                  ->whereYear('created_at', $request->year);
        } elseif ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month)
                  ->whereYear('created_at', date('Y'));
        }

        // Filter berdasarkan siswa (nama atau email)
        if ($request->filled('student')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->student . '%')
                  ->orWhere('email', 'like', '%' . $request->student . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $complaints = $query->latest()->get();

        return view('complaints.admin_index', compact('complaints'));
    }

    // ✅ UPDATE STATUS + FEEDBACK (DIPERBAIKI)
    public function updateStatus(Request $request, Complaint $complaint)
    {
        $data = $request->validate([
            'status' => 'required|in:menunggu,proses,selesai',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $complaint->update($data);

        return redirect()->route('complaints.admin')->with('success', 'Status pengaduan diperbarui.');
    }

    // ✅ DETAIL (TAMBAHAN WAJIB)
    public function show(Complaint $complaint)
    {
        return view('complaints.show', compact('complaint'));
    }
}