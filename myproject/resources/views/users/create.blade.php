<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Tài Khoản</title>
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
            <span class="navbar-brand text-white fw-bold">➕ Tạo Tài Khoản</span>
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
                        <h5 class="mb-0">➕ Tạo Tài Khoản Mới</h5>
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

                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">👤 Tên Người Dùng</label>
                                <input type="text" name="name" id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">📧 Email</label>
                                <input type="email" name="email" id="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">🔐 Mật Khẩu</label>
                                <input type="password" name="password" id="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">🔐 Xác Nhận Mật Khẩu</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="role_id" class="form-label">🎭 Vai Trò</label>
                                <select name="role_id" id="role_id" 
                                        class="form-control @error('role_id') is-invalid @enderror" required>
                                    <option value="">-- Chọn Vai Trò --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ $role->id == 2 ? '👨‍🏫 Giáo Viên' : '👨‍🎓 Sinh Viên' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">✓ Tạo Tài Khoản</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary w-100 mt-2">✕ Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
