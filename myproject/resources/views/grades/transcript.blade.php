<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Đạo Hạo</title>
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
        .transcript-header {
            text-align: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .grade-row {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .gpa-card {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }
        .gpa-value {
            font-size: 48px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <span class="navbar-brand text-white fw-bold">📚 Quản Lý Điểm</span>
            <div class="ms-auto">
                <a href="/dashboard">🏠 Dashboard</a>
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm ms-3">🚪 Đăng Xuất</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="transcript-header">
            <h2>📋 BẢNG ĐẠO HẠO</h2>
            <p><strong>Họ Tên:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        <div class="gpa-card">
            <div class="gpa-value">{{ $gpa }}</div>
            <div style="font-size: 18px;">Điểm Trung Bình Tích Lũy</div>
        </div>

        <div class="card">
            <div class="card-header text-white">
                <h5 class="mb-0">📖 Kết Quả Học Tập</h5>
            </div>
            <div class="card-body">
                @if ($grades->isEmpty())
                    <div class="alert alert-info">
                        Chưa có bản ghi điểm nào
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Môn Học</th>
                                    <th>Tín Chỉ</th>
                                    <th>Điểm</th>
                                    <th>Kỳ</th>
                                    <th>Kết Luận</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($grades as $index => $grade)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $grade->subject->name }}</td>
                                        <td><span class="badge bg-info">{{ $grade->subject->credits }}</span></td>
                                        <td>
                                            @php
                                                $score = $grade->score;
                                                if ($score >= 8.5) {
                                                    $class = 'bg-success';
                                                    $text = 'Xuất Sắc';
                                                } elseif ($score >= 8) {
                                                    $class = 'bg-success';
                                                    $text = 'Giỏi';
                                                } elseif ($score >= 7) {
                                                    $class = 'bg-info';
                                                    $text = 'Khá';
                                                } elseif ($score >= 5) {
                                                    $class = 'bg-warning';
                                                    $text = 'Trung Bình';
                                                } else {
                                                    $class = 'bg-danger';
                                                    $text = 'Yếu';
                                                }
                                            @endphp
                                            <span class="badge {{ $class }}">{{ $score }}/10</span>
                                        </td>
                                        <td>{{ $grade->semester }}</td>
                                        <td>{{ $text }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Không có bản ghi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <h6>📊 Thống Kê:</h6>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <p class="text-muted mb-0">Tổng Môn Học</p>
                                    <h4>{{ $grades->count() }}</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <p class="text-muted mb-0">Tổng Tín Chỉ</p>
                                    <h4>
                                        @php
                                            $totalCredits = $grades->sum(function ($grade) {
                                                return $grade->subject->credits;
                                            });
                                        @endphp
                                        {{ $totalCredits }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <p class="text-muted mb-0">Điểm Cao Nhất</p>
                                    <h4>{{ $grades->max('score') }}/10</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <p class="text-muted mb-0">Điểm Thấp Nhất</p>
                                    <h4>{{ $grades->min('score') }}/10</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-4 mb-4">
            <a href="/dashboard" class="btn btn-secondary">← Quay Lại</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
