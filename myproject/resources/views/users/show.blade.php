<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Tài Khoản</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }
        .navbar-custom a {
            color: white !important;
        }
        .info-box {
            padding: 15px;
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <span class="navbar-brand text-white fw-bold">👤 Chi Tiết Tài Khoản</span>
            <div class="ms-auto">
                <a href="{{ route('users.index') }}">👈 Quay Lại</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ $user->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="info-box">
                            <p class="text-muted mb-1"><strong>Tên:</strong></p>
                            <h6>{{ $user->name }}</h6>
                        </div>

                        <div class="info-box">
                            <p class="text-muted mb-1"><strong>Email:</strong></p>
                            <h6>{{ $user->email }}</h6>
                        </div>

                        <div class="info-box">
                            <p class="text-muted mb-1"><strong>Vai Trò:</strong></p>
                            @if ($user->role_id == 1)
                                <span class="badge bg-danger">Admin</span>
                            @elseif ($user->role_id == 2)
                                <span class="badge bg-info">Giáo Viên</span>
                            @else
                                <span class="badge bg-success">Sinh Viên</span>
                            @endif
                        </div>

                        <div class="info-box">
                            <p class="text-muted mb-1"><strong>Ngày Tạo:</strong></p>
                            <h6>{{ $user->created_at->format('d/m/Y H:i') }}</h6>
                        </div>

                        <div class="info-box">
                            <p class="text-muted mb-1"><strong>Cập Nhật Lần Cuối:</strong></p>
                            <h6>{{ $user->updated_at->format('d/m/Y H:i') }}</h6>
                        </div>

                        @if ($user->id != Auth::id() && $user->role_id != 1)
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary w-100">✏️ Chỉnh Sửa</a>
                            <button onclick="if(confirm('Xóa tài khoản này?')) { document.getElementById('delete-form').submit(); }" class="btn btn-danger w-100 mt-2">🗑️ Xóa</button>
                            <form id="delete-form" action="{{ route('users.destroy', $user) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @else
                            <div class="alert alert-info">
                                Bạn hoặc Admin không thể chỉnh sửa từ đây
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
