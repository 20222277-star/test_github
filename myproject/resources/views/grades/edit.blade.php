<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Điểm</title>
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
            <span class="navbar-brand text-white fw-bold">📚 Quản Lý Điểm</span>
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
                        <h5 class="mb-0">✏️ Chỉnh Sửa Điểm</h5>
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

                        <form action="{{ route('grades.update', $grade) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">👨‍🎓 Sinh Viên</label>
                                <input type="text" class="form-control" value="{{ $grade->student->name }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">📖 Môn Học</label>
                                <input type="text" class="form-control" value="{{ $grade->subject->name }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="score" class="form-label">📊 Điểm (0-10)</label>
                                <input type="number" name="score" id="score" min="0" max="10" step="0.5" 
                                       class="form-control @error('score') is-invalid @enderror" 
                                       value="{{ old('score', $grade->score) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="semester" class="form-label">🔢 Kỳ</label>
                                <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" required>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}" {{ old('semester', $grade->semester) == $i ? 'selected' : '' }}>Kỳ {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">✓ Cập Nhật</button>
                            <a href="{{ route('grades.index') }}" class="btn btn-secondary w-100 mt-2">✕ Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
