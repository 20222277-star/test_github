<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Môn Học</title>
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
            <span class="navbar-brand text-white fw-bold">📚 Quản Lý Môn Học</span>
            <div class="ms-auto">
                <a href="/dashboard">🏠 Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                ✓ {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📖 Danh Sách Môn Học</h5>
                <a href="{{ route('subjects.create') }}" class="btn btn-light btn-sm">➕ Thêm Môn Học</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Tên Môn</th>
                                <th>Tín Chỉ</th>
                                <th>Giáo Viên</th>
                                <th>Mô Tả</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subjects as $subject)
                                <tr>
                                    <td><strong>{{ $subject->name }}</strong></td>
                                    <td><span class="badge bg-info">{{ $subject->credits }}</span></td>
                                    <td>{{ $subject->teacher->name }}</td>
                                    <td>{{ Str::limit($subject->description, 30) }}</td>
                                    <td>
                                        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-outline-primary">✏️ Sửa</a>
                                        <button onclick="if(confirm('Xóa môn này?')) { document.getElementById('delete-form-{{ $subject->id }}').submit(); }" class="btn btn-sm btn-outline-danger">🗑️ Xóa</button>
                                        <form id="delete-form-{{ $subject->id }}" action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Không có môn học nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $subjects->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
