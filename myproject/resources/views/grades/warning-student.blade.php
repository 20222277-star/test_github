@extends('layouts.app')

@section('title', 'Cảnh báo Điểm Thấp - Sinh Viên')

@section('content')
<div class="container mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>⚠️ Cảnh Báo Điểm Thấp</h1>
            <p class="text-muted">Theo dõi tình trạng học tập của bạn</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">📊 Tổng Số Môn</h5>
                    <h2 class="text-primary">{{ $statistics['total'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning bg-opacity-10">
                <div class="card-body">
                    <h5 class="card-title">🟠 Điểm Cảnh Báo</h5>
                    <h2 class="text-warning">{{ $statistics['low_grades_count'] }}</h2>
                    <small class="text-muted">(< 5.0 điểm)</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger bg-opacity-10">
                <div class="card-body">
                    <h5 class="card-title">🔴 Điểm Nguy Hiểm</h5>
                    <h2 class="text-danger">{{ $statistics['critical_grades_count'] }}</h2>
                    <small class="text-muted">(< 3.0 điểm)</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success bg-opacity-10">
                <div class="card-body">
                    <h5 class="card-title">📈 Điểm Trung Bình</h5>
                    <h2 class="text-success">{{ $statistics['average_score'] }}/10</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert if no low grades -->
    @if($lowGrades->isEmpty())
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">✅ Tuyệt vời!</h4>
            <p>Bạn không có điểm nào dưới mức cảnh báo. Hãy tiếp tục duy trì thành tích tốt!</p>
        </div>
    @else
        <!-- Low Grades Table -->
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">📋 Danh Sách Môn Học Có Điểm Thấp</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Môn Học</th>
                                <th>Điểm</th>
                                <th>Học Kỳ</th>
                                <th>Mức Cảnh Báo</th>
                                <th>Kiến Nghị</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowGrades as $grade)
                                @php
                                    $warningLevel = \App\Services\GradeWarningService::class;
                                    $service = new $warningLevel();
                                    $level = $service->getWarningLevel($grade->score);
                                @endphp
                                <tr>
                                    <td>
                                        <strong>{{ $grade->subject->name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $level['class'] }}">
                                            {{ $grade->score }} / 10
                                        </span>
                                    </td>
                                    <td>Kỳ {{ $grade->semester }}</td>
                                    <td>
                                        <span class="badge bg-{{ $level['class'] }}">
                                            {{ $level['icon'] }} {{ $level['label'] }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($grade->score < 3.0)
                                            <span class="text-danger">⚠️ Cần hỗ trợ ngay</span>
                                        @elseif($grade->score < 5.0)
                                            <span class="text-warning">📚 Cần ôn tập thêm</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Advice Section -->
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">💡 Lời Kiến Nghị</h5>
            </div>
            <div class="card-body">
                <ul>
                    <li>📖 <strong>Ôn tập lại kiến thức:</strong> Tập trung vào các phần trọng điểm</li>
                    <li>🤝 <strong>Gặp giáo viên:</strong> Yêu cầu giáo viên giải thích những phần khó</li>
                    <li>👥 <strong>Học nhóm:</strong> Cùng bạn bè thảo luận và chia sẻ kiến thức</li>
                    <li>📝 <strong>Làm thêm bài tập:</strong> Luyện tập thêm để hiểu sâu hơn</li>
                    <li>⏰ <strong>Quản lý thời gian:</strong> Học đều đặn, không nên học dồn</li>
                </ul>
            </div>
        </div>
    @endif

    <!-- Back Button -->
    <div class="mt-4">
        <a href="/grades" class="btn btn-secondary">← Quay lại Danh sách Điểm</a>
    </div>
</div>

<style>
    .card {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .bg-opacity-10 {
        background-color: rgba(var(--bs-body-color-rgb), 0.1);
    }
</style>
@endsection
