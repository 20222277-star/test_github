@extends('layouts.app')

@section('title', 'Cảnh báo Điểm Thấp - Giáo Viên')

@section('content')
<div class="container mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>📊 Theo Dõi Sinh Viên - Điểm Thấp</h1>
            <p class="text-muted">Quản lý danh sách sinh viên có điểm thấp để hỗ trợ kịp thời</p>
        </div>
    </div>

    <!-- Critical Grades Section -->
    @if($criticalGrades->isNotEmpty())
        <div class="card mb-4 border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">🔴 Điểm Nguy Hiểm (< 3.0) - Cần Hỗ Trợ Ngay</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    <strong>⚠️ Lưu Ý!</strong> Có <strong>{{ $criticalGrades->count() }}</strong> bản ghi điểm nguy hiểm. Các sinh viên cần sự hỗ trợ từ giáo viên.
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-danger">
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
                                <tr>
                                    <td>
                                        <strong class="text-danger">{{ $grade->student->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $grade->student->email }}</small>
                                    </td>
                                    <td>{{ $grade->subject->name }}</td>
                                    <td>
                                        <span class="badge bg-danger">{{ $grade->score }}/10</span>
                                    </td>
                                    <td>Kỳ {{ $grade->semester }}</td>
                                    <td>
                                        <a href="/grades/{{ $grade->id }}/edit" class="btn btn-sm btn-warning">
                                            ✏️ Chỉnh Sửa
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
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">🟠 Điểm Cảnh Báo (< 5.0)</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning" role="alert">
                    Có <strong>{{ $lowGrades->count() }}</strong> bản ghi điểm cảnh báo.
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-warning">
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
                                        <small class="text-muted">{{ $grade->student->email }}</small>
                                    </td>
                                    <td>{{ $grade->subject->name }}</td>
                                    <td>
                                        <span class="badge bg-warning">{{ $grade->score }}/10</span>
                                    </td>
                                    <td>Kỳ {{ $grade->semester }}</td>
                                    <td>
                                        <a href="/grades/{{ $grade->id }}/edit" class="btn btn-sm btn-warning">
                                            ✏️ Chỉnh Sửa
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
        <div class="card mb-4 border-info">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">📉 Sinh Viên Có Điểm Trung Bình Thấp</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-info">
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
                                        <small class="text-muted">{{ $item['student']->email }}</small>
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
                                    <td>{{ $item['count'] }}</td>
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
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">✅ Tuyệt vời!</h4>
            <p>Tất cả sinh viên của bạn đều có điểm tốt. Hãy tiếp tục khuyến khích họ!</p>
        </div>
    @endif

    <!-- Recommendations -->
    <div class="card mt-4 bg-light">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">💡 Kiến Nghị Cho Giáo Viên</h5>
        </div>
        <div class="card-body">
            <ul>
                <li>📞 <strong>Liên Hệ Sinh Viên:</strong> Gọi hoặc gửi email để tìm hiểu nguyên nhân điểm thấp</li>
                <li>🎓 <strong>Cung Cấp Hỗ Trợ Học Tập:</strong> Đưa ra bài tập bổ sung, hướng dẫn thêm</li>
                <li>📅 <strong>Tổ Chức Buổi Ôn Tập:</strong> Để sinh viên có đủ thời gian ôn tập trước kỳ thi</li>
                <li>🤔 <strong>Phân Tích Nguyên Nhân:</strong> Xác định xem sinh viên không hiểu phần nào</li>
                <li>🎯 <strong>Lập Kế Hoạch Cải Thiện:</strong> Thiết lập mục tiêu rõ ràng cùng sinh viên</li>
            </ul>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-4">
        <a href="/grades" class="btn btn-secondary">← Quay lại Danh sách Điểm</a>
    </div>
</div>

<style>
    .card {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
