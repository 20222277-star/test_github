@extends('layouts.app')

@section('title', 'Cảnh Báo Điểm Thấp - Giáo Viên')

@section('content')
<div>
    <!-- Page Header -->
    <div class="page-title mb-4">
        <h1>
            <i class="fas fa-chart-bar" style="color: var(--primary);"></i>
            Theo Dõi Sinh Viên - Điểm Thấp
        </h1>
        <p class="page-subtitle">Quản lý danh sách sinh viên có điểm thấp để hỗ trợ kịp thời</p>
    </div>

    <!-- Critical Grades Section -->
    @if($criticalGrades->isNotEmpty())
        <div class="card mb-4 border-danger border">
            <div class="card-header" style="background: linear-gradient(135deg, var(--danger) 0%, #e53e3e 100%);">
                <i class="fas fa-exclamation-circle"></i> Điểm Nguy Hiểm (< 3.0) - Cần Hỗ Trợ Ngay
                <span class="badge bg-white text-danger float-end">{{ $criticalGrades->count() }} sinh viên</span>
            </div>
            <div class="card-body">
                <div class="alert alert-danger mb-3">
                    <i class="fas fa-warning"></i>
                    <strong> Lưu Ý!</strong> Có <strong>{{ $criticalGrades->count() }}</strong> bản ghi điểm nguy hiểm. Các sinh viên cần sự hỗ trợ từ giáo viên.
                </div>

                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Sinh Viên</th>
                                <th>Môn Học</th>
                                <th>Điểm</th>
                                <th>Học Kỳ</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($criticalGrades as $grade)
                                <tr class="table-danger">
                                    <td>
                                        <strong class="text-danger">{{ $grade->student->name }}</strong>
                                        <br>
                                        <small style="color: #a0aec0;">{{ $grade->student->email }}</small>
                                    </td>
                                    <td>{{ $grade->subject->name }}</td>
                                    <td>
                                        <span class="badge bg-danger">{{ $grade->score }}/10</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">Kỳ {{ $grade->semester }}</span>
                                    </td>
                                    <td>
                                        <a href="/grades/{{ $grade->id }}/edit" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Chỉnh Sửa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <!-- Low Grades Section -->
    @if($lowGrades->isNotEmpty())
        <div class="card mb-4">
            <div class="card-header" style="background: linear-gradient(135deg, var(--warning) 0%, #ed8936 100%);">
                <i class="fas fa-exclamation-triangle"></i> Điểm Cảnh Báo (< 5.0)
                <span class="badge bg-white text-dark float-end">{{ $lowGrades->count() }} bản ghi</span>
            </div>
            <div class="card-body">
                <div class="alert alert-warning mb-3">
                    <i class="fas fa-info-circle"></i> Có <strong>{{ $lowGrades->count() }}</strong> bản ghi điểm cảnh báo.
                </div>

                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Sinh Viên</th>
                                <th>Môn Học</th>
                                <th>Điểm</th>
                                <th>Học Kỳ</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowGrades as $grade)
                                <tr>
                                    <td>
                                        <strong>{{ $grade->student->name }}</strong>
                                        <br>
                                        <small style="color: #a0aec0;">{{ $grade->student->email }}</small>
                                    </td>
                                    <td>{{ $grade->subject->name }}</td>
                                    <td>
                                        <span class="badge bg-warning">{{ $grade->score }}/10</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">Kỳ {{ $grade->semester }}</span>
                                    </td>
                                    <td>
                                        <a href="/grades/{{ $grade->id }}/edit" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Chỉnh Sửa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <!-- Students with Low Average -->
    @if($studentsWithLowAverage->isNotEmpty())
        <div class="card mb-4">
            <div class="card-header" style="background: linear-gradient(135deg, var(--secondary) 0%, #6B46A6 100%);">
                <i class="fas fa-chart-line"></i> Sinh Viên Có Điểm Trung Bình Thấp
                <span class="badge bg-white text-dark float-end">{{ $studentsWithLowAverage->count() }} sinh viên</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Sinh Viên</th>
                                <th>Điểm Trung Bình</th>
                                <th>Số Khóa Học</th>
                                <th>Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentsWithLowAverage as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item['student']->name }}</strong>
                                        <br>
                                        <small style="color: #a0aec0;">{{ $item['student']->email }}</small>
                                    </td>
                                    <td>
                                        @if($item['average'] < 3.0)
                                            <span class="badge bg-danger">{{ $item['average'] }}/10</span>
                                        @elseif($item['average'] < 5.0)
                                            <span class="badge bg-warning">{{ $item['average'] }}/10</span>
                                        @else
                                            <span class="badge bg-info">{{ $item['average'] }}/10</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span style="color: var(--dark); font-weight: 600;">{{ $item['count'] }}</span>
                                    </td>
                                    <td>
                                        @if($item['average'] < 3.0)
                                            <span class="badge bg-danger">🔴 Nguy Hiểm</span>
                                        @elseif($item['average'] < 5.0)
                                            <span class="badge bg-warning">🟠 Cảnh Báo</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <!-- No Low Grades Message -->
    @if($lowGrades->isEmpty() && $criticalGrades->isEmpty())
        <div class="card border-0 bg-success bg-opacity-10">
            <div class="card-body text-center">
                <h3 class="text-success mb-2">✅ Tuyệt Vời!</h3>
                <p class="mb-0">Tất cả sinh viên của bạn đều có điểm tốt. Hãy tiếp tục khuyến khích họ!</p>
            </div>
        </div>
    @endif

    <!-- Recommendations -->
    <div class="card mt-4" style="background: #f7fafc;">
        <div class="card-header" style="background: linear-gradient(135deg, var(--dark) 0%, #1a202c 100%);">
            <i class="fas fa-lightbulb"></i> Kiến Nghị Cho Giáo Viên
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div style="padding: 1rem; background: white; border-radius: 8px; border-left: 4px solid var(--primary);">
                        <h5 style="color: var(--dark); margin-bottom: 0.5rem;">
                            <i class="fas fa-phone"></i> Liên Hệ Sinh Viên
                        </h5>
                        <p class="mb-0" style="font-size: 13px; color: #718096;">
                            Gọi hoặc gửi email để tìm hiểu nguyên nhân điểm thấp của sinh viên
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div style="padding: 1rem; background: white; border-radius: 8px; border-left: 4px solid var(--success);">
                        <h5 style="color: var(--dark); margin-bottom: 0.5rem;">
                            <i class="fas fa-graduation-cap"></i> Cung Cấp Hỗ Trợ Học Tập
                        </h5>
                        <p class="mb-0" style="font-size: 13px; color: #718096;">
                            Đưa ra bài tập bổ sung, hướng dẫn thêm để giúp sinh viên hiểu tốt hơn
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div style="padding: 1rem; background: white; border-radius: 8px; border-left: 4px solid var(--warning);">
                        <h5 style="color: var(--dark); margin-bottom: 0.5rem;">
                            <i class="fas fa-calendar"></i> Tổ Chức Buổi Ôn Tập
                        </h5>
                        <p class="mb-0" style="font-size: 13px; color: #718096;">
                            Cấp thêm thời gian ôn tập trước kỳ thi để sinh viên chuẩn bị tốt hơn
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div style="padding: 1rem; background: white; border-radius: 8px; border-left: 4px solid var(--danger);">
                        <h5 style="color: var(--dark); margin-bottom: 0.5rem;">
                            <i class="fas fa-chart-pie"></i> Lập Kế Hoạch Cải Thiện
                        </h5>
                        <p class="mb-0" style="font-size: 13px; color: #718096;">
                            Thiết lập mục tiêu rõ ràng cùng sinh viên và theo dõi tiến độ
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-4 pb-3">
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay Lại Danh Sách Điểm
        </a>
    </div>
</div>
@endsection
