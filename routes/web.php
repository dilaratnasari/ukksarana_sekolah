<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return view('dashboard_admin');
    } elseif ($user->role === 'siswa') {
        return view('dashboard_siswa');
    } else {
        return view('dashboard_siswa');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes (harus sebelum resource)
    Route::get('/complaints/admin', [ComplaintController::class, 'adminIndex'])
        ->name('complaints.admin')
        ->middleware('role:admin');

    Route::patch('/complaints/{complaint}/status', [ComplaintController::class, 'updateStatus'])
        ->name('complaints.updateStatus')
        ->middleware('role:admin');

    // Complaints (Siswa)
    Route::resource('complaints', ComplaintController::class)->except(['edit', 'destroy']);

});

require __DIR__.'/auth.php';