<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Môn Học</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }
        .navbar-custom a {
            color: white !important;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <span class="navbar-brand text-white fw-bold">📚 Thêm Môn Học</span>
            <div class="ms-auto">
                <a href="/dashboard">🏠 Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">➕ Tạo Môn Học Mới</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Lỗi!</strong>
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('subjects.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">📖 Tên Môn Học</label>
                                <input type="text" name="name" id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="credits" class="form-label">🔢 Tín Chỉ</label>
                                <input type="number" name="credits" id="credits" min="1" max="6"
                                       class="form-control @error('credits') is-invalid @enderror" 
                                       value="{{ old('credits', 3) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="teacher_id" class="form-label">👨‍🏫 Giáo Viên Phụ Trách</label>
                                <select name="teacher_id" id="teacher_id" 
                                        class="form-control @error('teacher_id') is-invalid @enderror" required>
                                    <option value="">-- Chọn Giáo Viên --</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">📝 Mô Tả</label>
                                <textarea name="description" id="description" rows="4"
                                          class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">✓ Lưu Môn Học</button>
                            <a href="{{ route('subjects.index') }}" class="btn btn-secondary w-100 mt-2">✕ Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
