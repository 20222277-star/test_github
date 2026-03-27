<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Cá Nhân</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f4f6f9;
        }
        .navbar-custom {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }
        .navbar-custom a {
            color: white !important;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .card-header {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px 10px 0 0 !important;
        }
        .info-box {
            padding: 15px;
            background: white;
            border-left: 4px solid #667eea;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <span class="navbar-brand text-white fw-bold">👤 Hồ Sơ Cá Nhân</span>
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

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white">
                        <h5 class="mb-0">📋 Thông Tin Cá Nhân</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">👤 Tên Đầy Đủ</label>
                                <input type="text" name="name" id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">📧 Email</label>
                                <input type="email" name="email" id="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">🎭 Vai Trò</label>
                                <input type="text" class="form-control" disabled value="{{ $user->role->name }}">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">✓ Cập Nhật Thông Tin</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white">
                        <h5 class="mb-0">🔐 Đổi Mật Khẩu</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.changePassword') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="current_password" class="form-label">🔑 Mật Khẩu Hiện Tại</label>
                                <input type="password" name="current_password" id="current_password" 
                                       class="form-control @error('current_password') is-invalid @enderror" 
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">🔑 Mật Khẩu Mới</label>
                                <input type="password" name="password" id="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">🔑 Xác Nhận Mật Khẩu</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-warning w-100">✓ Đổi Mật Khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">ℹ️ Thông Tin Hệ Thống</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box">
                            <p class="text-muted mb-1"><strong>Ngày Tạo Tài Khoản:</strong></p>
                            <h6>{{ $user->created_at->format('d/m/Y H:i') }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <p class="text-muted mb-1"><strong>Cập Nhật Gần Đây:</strong></p>
                            <h6>{{ $user->updated_at->format('d/m/Y H:i') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
