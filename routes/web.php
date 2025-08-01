<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadController;

// Route ke halaman utama
Route::get('/', function () {
    return redirect('/tasks');
});

// Auth routes (login, register, dll)
Auth::routes();

// Group yang membutuhkan login
Route::middleware(['auth'])->group(function () {
    // Halaman daftar tugas
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

    // Form tambah tugas
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

    // Simpan tugas baru
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Edit tugas
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

    // Update tugas
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    // Hapus tugas
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Check box jika sudah selesai tugas nya
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus'])->name('tasks.toggle');
    Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus'])->name('tasks.toggleStatus');

    // Upload file atau gambar
    Route::get('/upload', [UploadController::class, 'create'])->name('upload.create');
    Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
});

// Redirect /home ke /tasks supaya tidak ambigu
Route::get('/home', function () {
    return redirect()->route('tasks.index');
})->name('home');
