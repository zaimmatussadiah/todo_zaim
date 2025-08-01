@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="mb-4 text-success fw-bold">
                    <i class="fas fa-edit me-2"></i> Edit Tugas
                </h2>

                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong><i class="fas fa-exclamation-circle"></i> Ada beberapa kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>⚠️ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fas fa-thumbtack me-1"></i> Judul Tugas</label>
                        <input type="text" name="title" class="form-control shadow-sm"
                            value="{{ old('title', $task->title) }}" required>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fas fa-align-left me-1"></i> Deskripsi</label>
                        <textarea name="description" class="form-control shadow-sm" rows="4">{{ old('description', $task->description) }}</textarea>
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fas fa-calendar-alt me-1"></i> Tanggal
                            Tenggat</label>
                        <input type="date" name="due_date" class="form-control shadow-sm"
                            value="{{ old('due_date', \Carbon\Carbon::parse($task->due_date)->format('Y-m-d')) }}">
                    </div>

                    {{-- Prioritas --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fas fa-bullseye me-1"></i> Prioritas</label>
                        <select class="form-select shadow-sm" name="priority">
                            @php
                                $priorities = ['High', 'Medium', 'Low'];
                                $selected = old('priority', $task->priority);
                            @endphp
                            @foreach ($priorities as $priority)
                                <option value="{{ $priority }}" {{ $priority == $selected ? 'selected' : '' }}>
                                    {{ $priority }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Checkbox selesai --}}
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="is_completed" id="is_completed" value="1"
                            {{ old('is_completed', $task->is_completed) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_completed">
                            <i class="fas fa-check-circle me-1 text-success"></i> Tandai sebagai selesai
                        </label>
                    </div>

                    {{-- Upload Gambar --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">📷 Ganti Gambar</label>
                        <input type="file" name="gambar" class="form-control shadow-sm">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">📁 Ganti File</label>
                        <input type="file" name="file" class="form-control shadow-sm"
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.txt,.png,.jpg,.jpeg">
                    </div>

                    @if ($task->file)
                        <div class="mb-3">
                            <p class="fw-semibold mb-1">📎 File Saat Ini:</p>
                            <a href="{{ asset('uploads/' . $task->file) }}" target="_blank">{{ $task->file }}</a>
                        </div>
                    @endif


                    @if ($task->gambar)
                        <div class="mb-3">
                            <p class="fw-semibold mb-1">🖼 Gambar Saat Ini:</p>
                            <img src="{{ asset('uploads/' . $task->gambar) }}" width="150" class="rounded shadow-sm">
                        </div>
                    @endif

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times-circle me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
