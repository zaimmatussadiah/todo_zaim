<!DOCTYPE html>
<html>

<head>
    <title>Upload Gambar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="container mt-5">
    <h2>Upload Gambar</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Pilih Gambar:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</body>

</html>
