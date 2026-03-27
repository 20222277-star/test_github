<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .stat-card .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
        }
        .stat-card .stat-label {
            color: #999;
            font-size: 14px;
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
                <a href="{{ route('logout') }}" class="btn btn-logout btn-sm">🚪 Đăng Xuất</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3 class="mb-4">👋 Chào Mừng Quản Trị Viên {{ Auth::user()->name }}</h3>

        <div class="row">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-label">👨‍🎓 Tổng Sinh Viên</div>
                    <div class="stat-number">{{ \App\Models\User::where('role_id', 3)->count() }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-label">👨‍🏫 Tổng Giáo Viên</div>
                    <div class="stat-number">{{ \App\Models\User::where('role_id', 2)->count() }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-label">📖 Tổng Môn Học</div>
                    <div class="stat-number">{{ \App\Models\Subject::count() }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-label">📝 Tổng Bản Ghi Điểm</div>
                    <div class="stat-number">{{ \App\Models\Grade::count() }}</div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">👨‍🎓 Danh Sách Sinh Viên</h5>
                        <small class="text-white">{{ \App\Models\User::where('role_id', 3)->count() }} người</small>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (\App\Models\User::where('role_id', 3)->limit(5)->get() as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td><small>{{ $student->email }}</small></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted">Không có sinh viên</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">👨‍🏫 Danh Sách Giáo Viên</h5>
                        <small class="text-white">{{ \App\Models\User::where('role_id', 2)->count() }} người</small>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (\App\Models\User::where('role_id', 2)->limit(5)->get() as $teacher)
                                        <tr>
                                            <td>{{ $teacher->name }}</td>
                                            <td><small>{{ $teacher->email }}</small></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted">Không có giáo viên</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">📖 Danh Sách Môn Học</h5>
                        <a href="{{ route('subjects.create') }}" class="btn btn-light btn-sm">➕ Thêm Môn Học</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên Môn</th>
                                        <th>Tín Chỉ</th>
                                        <th>Giáo Viên</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (\App\Models\Subject::with('teacher')->limit(10)->get() as $subject)
                                        <tr>
                                            <td>{{ $subject->name }}</td>
                                            <td><span class="badge bg-info">{{ $subject->credits }}</span></td>
                                            <td>{{ $subject->teacher->name }}</td>
                                            <td>
                                                <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                                                <button onclick="if(confirm('Xóa môn này?')) { document.getElementById('delete-form-{{ $subject->id }}').submit(); }" class="btn btn-sm btn-outline-danger">Xóa</button>
                                                <form id="delete-form-{{ $subject->id }}" action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Không có môn học nào</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
