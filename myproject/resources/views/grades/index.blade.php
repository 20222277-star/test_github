<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Điểm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }
        .navbar-custom a {
            color: white !important;
            margin-right: 10px;
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
            <span class="navbar-brand text-white fw-bold">📚 Kỳ</span>
            <div class="ms-auto">
                <a href="/dashboard" class="text-white me-3">🏠 Dashboard</a>
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">🚪 Đăng Xuất</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <strong>✓ Thành Công!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>✗ Lỗi!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📊 Danh Sách Điểm</h5>
                <a href="{{ route('grades.create') }}" class="btn btn-light btn-sm">➕ Nhập Điểm Mới</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Sinh Viên</th>
                                <th>Môn Học</th>
                                <th>Điểm</th>
                                <th>Kỳ</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($grades as $grade)
                                <tr>
                                    <td>{{ $grade->student->name }}</td>
                                    <td>{{ $grade->subject->name }}</td>
                                    <td>
                                        @php
                                            $score = $grade->score;
                                            if ($score >= 8) $class = 'bg-success';
                                            elseif ($score >= 7) $class = 'bg-info';
                                            elseif ($score >= 5) $class = 'bg-warning';
                                            else $class = 'bg-danger';
                                        @endphp
                                        <span class="badge {{ $class }}">{{ $score }}/10</span>
                                    </td>
                                    <td>{{ $grade->semester }}</td>
                                    <td>
                                        <a href="{{ route('grades.edit', $grade) }}" class="btn btn-sm btn-outline-primary">✏️ Sửa</a>
                                        <button onclick="if(confirm('Xóa bản ghi này?')) { document.getElementById('delete-form-{{ $grade->id }}').submit(); }" class="btn btn-sm btn-outline-danger">🗑️ Xóa</button>
                                        <form id="delete-form-{{ $grade->id }}" action="{{ route('grades.destroy', $grade) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Không có bản ghi điểm</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $grades->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
