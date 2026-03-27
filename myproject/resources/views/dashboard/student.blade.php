<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
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
        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <span class="navbar-brand">📚 Quản Lý Điểm Sinh Viên</span>
            <div class="ms-auto">
                <span class="text-white me-3">👤 {{ Auth::user()->name }}</span>
                <a href="{{ route('student.transcript') }}" class="text-white me-3">📚 Học Bạ</a>
                <a href="{{ route('profile.edit') }}" class="text-white me-3">⚙️ Hồ Sơ</a>
                <a href="{{ route('logout') }}" class="btn btn-logout btn-sm">🚪 Đăng Xuất</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">📖 Các Môn Học Của Bạn</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tên Môn Học</th>
                                    <th>Giáo Viên</th>
                                    <th>Tín Chỉ</th>
                                    <th>Điểm</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (Auth::user()->grades as $grade)
                                    <tr>
                                        <td>{{ $grade->subject->name }}</td>
                                        <td>{{ $grade->subject->teacher->name }}</td>
                                        <td><span class="badge bg-info">{{ $grade->subject->credits }}</span></td>
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
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Chưa có điểm nào</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">📊 Biểu Đồ Điểm</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="gradeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">📊 Thông Tin Học Tập</h5>
                    </div>
                    <div class="card-body">
                        <div class="info-box">
                            <div class="info-box-label">Tổng Môn Học</div>
                            <div class="info-box-value">{{ Auth::user()->grades->count() }}</div>
                        </div>

                        <div class="info-box">
                            <div class="info-box-label">Điểm Trung Bình Tích Lũy</div>
                            <div class="info-box-value">
                                @php
                                    $gpa = 0;
                                    $totalScore = 0;
                                    $totalCredits = 0;
                                    foreach (Auth::user()->grades as $grade) {
                                        $totalScore += $grade->score * $grade->subject->credits;
                                        $totalCredits += $grade->subject->credits;
                                    }
                                    $gpa = $totalCredits > 0 ? round($totalScore / $totalCredits, 2) : 0;
                                @endphp
                                {{ $gpa }}
                            </div>
                        </div>

                        <div class="info-box">
                            <div class="info-box-label">Tổng Tín Chỉ</div>
                            <div class="info-box-value">
                                @php
                                    $totalCredits = Auth::user()->grades->sum(function ($grade) {
                                        return $grade->subject->credits;
                                    });
                                @endphp
                                {{ $totalCredits }}
                            </div>
                        </div>

                        <div class="info-box">
                            <div class="info-box-label">Xếp Hạng</div>
                            <div class="info-box-value">
                                @php
                                    if ($gpa >= 8.5) $rank = '🏆 Xuất Sắc';
                                    elseif ($gpa >= 8) $rank = '🥇 Giỏi';
                                    elseif ($gpa >= 7) $rank = '🥈 Khá';
                                    elseif ($gpa >= 5) $rank = '🥉 TBình';
                                    else $rank = '📚 Yếu';
                                @endphp
                                {!! $rank !!}
                            </div>
                        </div>

                        <a href="{{ route('student.transcript') }}" class="btn btn-primary w-100">
                            📚 Xem Học Bạ Chi Tiết
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const grades = @json(Auth::user()->grades);
        if (grades.length > 0) {
            const labels = grades.map(g => g.subject.name);
            const scores = grades.map(g => g.score);
            const colors = scores.map(s => {
                if (s >= 8) return '#28a745';
                if (s >= 7) return '#17a2b8';
                if (s >= 5) return '#ffc107';
                return '#dc3545';
            });

            const ctx = document.getElementById('gradeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Điểm Số',
                        data: scores,
                        backgroundColor: colors,
                        borderRadius: 5,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true,
                            max: 10,
                            ticks: {
                                callback: function(value) {
                                    return value.toFixed(1);
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
