<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập Điểm</title>
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
                        <h5 class="mb-0">➕ Nhập Điểm Mới</h5>
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

                        <form action="{{ route('grades.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="student_id" class="form-label">👨‍🎓 Sinh Viên</label>
                                <select name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror" required>
                                    <option value="">-- Chọn Sinh Viên --</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="subject_id" class="form-label">📖 Môn Học</label>
                                <select name="subject_id" id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" required>
                                    <option value="">-- Chọn Môn Học --</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="score" class="form-label">📊 Điểm (0-10)</label>
                                <input type="number" name="score" id="score" min="0" max="10" step="0.5" 
                                       class="form-control @error('score') is-invalid @enderror" 
                                       value="{{ old('score') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="semester" class="form-label">🔢 Kỳ</label>
                                <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" required>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Kỳ {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">✓ Lưu Điểm</button>
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
