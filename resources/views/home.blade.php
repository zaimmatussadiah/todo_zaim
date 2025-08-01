@extends('layouts.app')


@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard Task Akhlish.khai
        </h2>

    </div>

    {{-- Search Bar --}}
    <form action="{{ route('tasks.index') }}" method="GET" class="mb-4">
        <div class="input-group shadow-sm">
            <input type="text" name="search" class="form-control" placeholder="Cari tugas..."
                value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </div>
    </form>

    {{-- Pesan Status --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel Daftar Tugas --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle ">
            <thead style="background-color: #A8D5BA;" class="text-dark">
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Prioritas</th>
                    <th>Tenggat Waktu</th>
                    <th>Status</th>
                    <th>File</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td class="{{ $task->completed ? 'text-decoration-line-through text-muted' : '' }}">
                            {{ $task->title }}
                        </td>

                        <td class="{{ $task->completed ? 'text-decoration-line-through text-muted' : '' }}">
                            {{ $task->description }}

                        <td>
                            @php $priority = strtolower($task->priority); @endphp
                            @if ($priority === 'low')
                                <span class="badge bg-success">Low</span>
                            @elseif ($priority === 'medium')
                                <span class="badge bg-warning text-dark">Medium</span>
                            @elseif ($priority === 'high')
                                <span class="badge bg-danger">High</span>
                            @else
                                <span class="badge bg-secondary">N/A</span>
                            @endif
                        </td>

                        <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</td>

                        <td class="text-center">
                            <form action="{{ route('tasks.toggleStatus', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="checkbox" onchange="this.form.submit()"
                                    {{ $task->completed ? 'checked' : '' }}>
                            </form>
                        </td>
                        <td>
                            @if ($task->file)
                                @php
                                    $ext = pathinfo($task->file, PATHINFO_EXTENSION);
                                    $gambarExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                @endphp

                                @if (in_array(strtolower($ext), $gambarExts))
                                    <img src="{{ asset('uploads/' . $task->file) }}" alt="Gambar Tugas"
                                        style="max-width: 100px; height: auto;">
                                @else
                                    <a href="{{ asset('uploads/' . $task->file) }}"
                                        target="_blank">{{ $task->file }}</a>
                                @endif
                            @else
                                Tidak ada file
                            @endif
                        </td>
                        <td>
                            @if ($task->gambar)
                                <img src="{{ asset('uploads/' . $task->gambar) }}" alt="Gambar"
                                    style="max-width: 100px; height: auto;">
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning"
                                title="Edit Tugas">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Hapus Tugas"
                                    onclick="return confirm('Yakin ingin menghapus tugas ini?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada tugas yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Tambahan efek --}}
    <style>
        .tambah-tugas-btn {
            transition: all 0.3s ease;
            border: 2px solid #A8BDA3;
            background-color: transparent;
            color: #198754;
        }

        .tambah-tugas-btn:hover {
            transform: scale(1.05);
            background: #A8BDA3;
            color: white;
        }

        .footer {
            background-color: #328E6E;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            margin-top: 40px;
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
    </style>
@endsection
