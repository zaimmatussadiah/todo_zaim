@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="mb-4 text-success"><i class="bi bi-plus-circle-dotted me-2"></i>Tambah Tugas Baru</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Ada beberapa kesalahan:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>⚠️ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">📌 Judul Tugas</label>
                        <input type="text" name="title" class="form-control shadow-sm"
                            placeholder="Contoh: Belajar Laravel" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">📝 Deskripsi</label>
                        <textarea name="description" class="form-control shadow-sm" rows="4" placeholder="Tambahkan detail tugas..."
                            required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="priority" class="form-label fw-semibold">🎯 Prioritas</label>
                        <select class="form-select shadow-sm" id="priority" name="priority" required>
                            <option value="">-- Pilih Prioritas --</option>
                            <option value="Low">Low 🟢</option>
                            <option value="Medium">Medium 🟡</option>
                            <option value="High">High 🔴</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label fw-semibold">📅 Tanggal Tenggat</label>
                        <input type="date" name="due_date" class="form-control shadow-sm" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">📷 Upload Gambar</label>
                        <input type="file" name="gambar" class="form-control shadow-sm">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">📁 Upload File (PDF/DOC/DLL)</label>
                        <input type="file" name="file" class="form-control shadow-sm"
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.txt,.png,.jpg,.jpeg">
                    </div>



                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save2 me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
