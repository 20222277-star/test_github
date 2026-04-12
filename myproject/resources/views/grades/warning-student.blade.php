@extends('layouts.app')

@section('title', 'Cảnh Báo Điểm Thấp - Sinh Viên')

@section('content')
<div>
    <!-- Page Header -->
    <div class="page-title mb-4">
        <h1>
            <i class="fas fa-exclamation-triangle" style="color: var(--warning);"></i>
            Cảnh Báo Điểm Thấp
        </h1>
        <p class="page-subtitle">Theo dõi tình trạng học tập của bạn</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-box">
                <div class="stat-label">📊 Tổng Số Môn</div>
                <div class="stat-value">{{ $statistics['total'] }}</div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-box warning">
                <div class="stat-label">🟠 Điểm Cảnh Báo</div>
                <div class="stat-value">{{ $statistics['low_grades_count'] }}</div>
                <small style="color: #a0aec0;">< 5.0 điểm</small>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-box danger">
                <div class="stat-label">🔴 Điểm Nguy Hiểm</div>
                <div class="stat-value">{{ $statistics['critical_grades_count'] }}</div>
                <small style="color: #a0aec0;">< 3.0 điểm</small>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-box success">
                <div class="stat-label">📈 Điểm Trung Bình</div>
                <div class="stat-value">{{ $statistics['average_score'] }}</div>
                <small style="color: #a0aec0;">/10</small>
            </div>
        </div>
    </div>

    <!-- Alert if no low grades -->
    @if($lowGrades->isEmpty())
        <div class="card border-0 bg-success bg-opacity-10">
            <div class="card-body text-center">
                <h3 class="text-success mb-2">✅ Tuyệt Vời!</h3>
                <p class="mb-0">Bạn không có điểm nào dưới mức cảnh báo. Hãy tiếp tục duy trì thành tích tốt!</p>
            </div>
        </div>
    @else
        <!-- Low Grades Table -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-list-check"></i> Danh Sách Môn Học Có Điểm Thấp
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
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
                                    $level = (new \App\Services\GradeWarningService())->getWarningLevel($grade->score);
                                @endphp
                                <tr>
                                    <td>
                                        <strong>{{ $grade->subject->name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: var(--{{ $level['class'] === 'danger' ? 'danger' : ($level['class'] === 'warning' ? 'warning' : 'primary') }});">
                                            {{ $grade->score }} / 10
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">Kỳ {{ $grade->semester }}</span>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: var(--{{ $level['class'] === 'danger' ? 'danger' : 'warning' }});">
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
            <div class="card-header">
                <i class="fas fa-lightbulb"></i> Lời Kiến Nghị Cải Thiện
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div style="padding: 1rem; background: #f7fafc; border-radius: 8px; margin-bottom: 1rem;">
                            <h5 style="color: var(--primary); margin-bottom: 0.5rem;">
                                <i class="fas fa-book"></i> Ôn Tập Lại Kiến Thức
                            </h5>
                            <p class="mb-0" style="font-size: 13px; color: #718096;">
                                Tập trung vào các phần trọng điểm và ôn lại những kiến thức chưa nắm vững
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="padding: 1rem; background: #f7fafc; border-radius: 8px; margin-bottom: 1rem;">
                            <h5 style="color: var(--primary); margin-bottom: 0.5rem;">
                                <i class="fas fa-handshake"></i> Gặp Giáo Viên
                            </h5>
                            <p class="mb-0" style="font-size: 13px; color: #718096;">
                                Yêu cầu giáo viên giải thích chi tiết những phần bạn không hiểu
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="padding: 1rem; background: #f7fafc; border-radius: 8px; margin-bottom: 1rem;">
                            <h5 style="color: var(--primary); margin-bottom: 0.5rem;">
                                <i class="fas fa-users"></i> Học Nhóm
                            </h5>
                            <p class="mb-0" style="font-size: 13px; color: #718096;">
                                Cùng bạn bè thảo luận và chia sẻ kiến thức để hiểu sâu hơn
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="padding: 1rem; background: #f7fafc; border-radius: 8px; margin-bottom: 1rem;">
                            <h5 style="color: var(--primary); margin-bottom: 0.5rem;">
                                <i class="fas fa-pencil"></i> Luyện Tập Thêm
                            </h5>
                            <p class="mb-0" style="font-size: 13px; color: #718096;">
                                Làm bài tập bổ sung để thực hành và nắm vững kiến thức
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Back Button -->
    <div class="mt-4 pb-3">
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay Lại Danh Sách Điểm
        </a>
    </div>
</div>
@endsection
