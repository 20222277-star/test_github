<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Giáo Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f4f6f9;
            padding: 20px 0;
        }
        .navbar-custom {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-custom .navbar-brand {
            font-weight: bold;
            font-size: 20px;
        }
        .navbar-custom a {
            color: white !important;
            margin-right: 15px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        .info-box {
            padding: 15px;
            background: white;
            border-left: 4px solid #667eea;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .info-box-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
        }
        .info-box-value {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .btn-logout {
            background: #ff6b6b;
            color: white;
        }
        .btn-logout:hover {
            background: #ff5252;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <span class="navbar-brand">📚 Quản Lý Điểm Sinh Viên</span>
            <div class="ms-auto">
                <span class="text-white me-3">👤 {{ Auth::user()->name }}</span>
                <a href="{{ route('grades.index') }}" class="text-white me-3">📊 Quản Lý Điểm</a>
                <a href="{{ route('grades.warning.teacher') }}" class="text-white me-3">⚠️ Cảnh Báo</a>
                <a href="{{ route('profile.edit') }}" class="text-white me-3">⚙️ Hồ Sơ</a>
                <a href="{{ route('logout') }}" class="btn btn-logout btn-sm">🚪 Đăng Xuất</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">📖 Các Môn Học Của Bạn</h5>
                        <a href="{{ route('grades.create') }}" class="btn btn-light btn-sm">➕ Nhập Điểm</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tên Môn Học</th>
                                    <th>Tín Chỉ</th>
                                    <th>Mô Tả</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (Auth::user()->subjects as $subject)
                                    <tr>
                                        <td><strong>{{ $subject->name }}</strong></td>
                                        <td><span class="badge bg-info">{{ $subject->credits }}</span></td>
                                        <td>{{ Str::limit($subject->description, 30) }}</td>
                                        <td>
                                            <a href="{{ route('grades.index') }}" class="btn btn-sm btn-outline-primary">
                                                📝 Xem Điểm
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Chưa dạy môn nào</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">📊 Thông Tin Giảng Dạy</h5>
                    </div>
                    <div class="card-body">
                        <div class="info-box">
                            <div class="info-box-label">Tổng Môn Học</div>
                            <div class="info-box-value">{{ Auth::user()->subjects->count() }}</div>
                        </div>

                        <div class="info-box">
                            <div class="info-box-label">Tổng Sinh Viên</div>
                            <div class="info-box-value">
                                @php
                                    $totalStudents = 0;
                                    foreach (Auth::user()->subjects as $subject) {
                                        $totalStudents += $subject->grades->count();
                                    }
                                @endphp
                                {{ $totalStudents }}
                            </div>
                        </div>

                        <div class="info-box">
                            <div class="info-box-label">Tổng Tiêu Chí</div>
                            <div class="info-box-value">
                                @php
                                    $totalCredits = Auth::user()->subjects->sum('credits');
                                @endphp
                                {{ $totalCredits }}
                            </div>
                        </div>

                        <a href="{{ route('grades.index') }}" class="btn btn-primary w-100">
                            📋 Xem Tất Cả Điểm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
