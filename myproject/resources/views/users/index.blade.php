<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tài Khoản</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        .badge-teacher {
            background: #0dcaf0;
        }
        .badge-student {
            background: #198754;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <span class="navbar-brand text-white fw-bold">👥 Quản Lý Tài Khoản</span>
            <div class="ms-auto">
                <a href="/dashboard" class="text-white me-3">🏠 Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="text-white me-3">👤 Hồ Sơ</a>
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">🚪 Đăng Xuất</a>
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
                <h5 class="mb-0">📋 Danh Sách Tài Khoản</h5>
                <a href="{{ route('users.create') }}" class="btn btn-light btn-sm">➕ Tạo Tài Khoản</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Vai Trò</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr>
                                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $user->name }}</strong>
                                        @if ($user->id == Auth::id())
                                            <span class="badge bg-warning">Bạn</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role_id == 1)
                                            <span class="badge bg-danger">Admin</span>
                                        @elseif ($user->role_id == 2)
                                            <span class="badge badge-teacher">Giáo Viên</span>
                                        @else
                                            <span class="badge badge-student">Sinh Viên</span>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-success">Hoạt Động</span></td>
                                    <td>
                                        <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                                            👁️
                                        </a>
                                        @if ($user->id != Auth::id() && $user->role_id != 1)
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary" title="Sửa">
                                                ✏️
                                            </a>
                                            <form action="{{ route('users.resetPassword', $user) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-warning" title="Reset mật khẩu" onclick="return confirm('Reset mật khẩu thành &quot;password&quot;?')">
                                                    🔑
                                                </button>
                                            </form>
                                            <button onclick="if(confirm('Xóa tài khoản này?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }" class="btn btn-sm btn-outline-danger" title="Xóa">
                                                🗑️
                                            </button>
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Không có tài khoản nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
