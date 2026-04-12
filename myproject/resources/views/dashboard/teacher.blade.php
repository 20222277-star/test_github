@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 2rem;">
        <div style="margin-bottom: 1.5rem;">
            <h1 style="font-size: 32px; font-weight: 700; color: #2d3748; margin: 0;">
                <i class="fas fa-chalkboard-user" style="margin-right: 10px; color: var(--primary);"></i>Dashboard Giáo Viên
            </h1>
            <p style="color: #a0aec0; margin: 0.5rem 0 0 0;">Chào mừng bạn, {{ Auth::user()->name }}</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 4px solid var(--primary);">
            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--primary); letter-spacing: 0.5px; margin-bottom: 0.75rem;">
                <i class="fas fa-book"></i> Môn Học
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #2d3748;">{{ Auth::user()->subjects->count() }}</div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 4px solid var(--secondary);">
            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--secondary); letter-spacing: 0.5px; margin-bottom: 0.75rem;">
                <i class="fas fa-users"></i> Sinh Viên
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #2d3748;">
                @php
                    $totalStudents = 0;
                    foreach (Auth::user()->subjects as $subject) {
                        $totalStudents += $subject->grades->count();
                    }
                @endphp
                {{ $totalStudents }}
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 4px solid #48bb78;">
            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #48bb78; letter-spacing: 0.5px; margin-bottom: 0.75rem;">
                <i class="fas fa-graduation-cap"></i> Tín Chỉ
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #2d3748;">
                @php
                    $totalCredits = Auth::user()->subjects->sum('credits');
                @endphp
                {{ $totalCredits }}
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 4px solid #f6ad55;">
            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #f6ad55; letter-spacing: 0.5px; margin-bottom: 0.75rem;">
                <i class="fas fa-chart-bar"></i> Điểm Nhập
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #2d3748;">
                @php
                    $totalGrades = 0;
                    foreach (Auth::user()->subjects as $subject) {
                        $totalGrades += $subject->grades->count();
                    }
                @endphp
                {{ $totalGrades }}
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        <!-- Main Content -->
        <div>
            <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
                <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                    <h2 style="margin: 0; font-size: 18px; font-weight: 700;">
                        <i class="fas fa-book-open"></i> Các Môn Học Của Bạn
                    </h2>
                    <a href="{{ route('grades.create') }}" style="background: white; color: var(--primary); padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 700; font-size: 13px; transition: all 0.3s;">
                        <i class="fas fa-plus"></i> Thêm Điểm
                    </a>
                </div>
                <div style="padding: 1.5rem; overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                        <thead>
                            <tr style="border-bottom: 2px solid #e2e8f0;">
                                <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700;">Tên Môn Học</th>
                                <th style="padding: 12px; text-align: center; color: #2d3748; font-weight: 700;">Tín Chỉ</th>
                                <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700;">Mô Tả</th>
                                <th style="padding: 12px; text-align: center; color: #2d3748; font-weight: 700;">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (Auth::user()->subjects as $subject)
                                <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.3s;">
                                    <td style="padding: 12px; color: #2d3748; font-weight: 600;">{{ $subject->name }}</td>
                                    <td style="padding: 12px; text-align: center;">
                                        <span style="background: var(--primary); color: white; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                            {{ $subject->credits }}
                                        </span>
                                    </td>
                                    <td style="padding: 12px; color: #718096;">{{ Str::limit($subject->description, 40) }}</td>
                                    <td style="padding: 12px; text-align: center;">
                                        <a href="{{ route('grades.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 12px; padding: 6px 12px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(102, 126, 234, 0.05) 100%); border-radius: 6px; display: inline-block; transition: all 0.3s;">
                                            <i class="fas fa-edit"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="padding: 2rem; text-align: center; color: #a0aec0;">
                                        <i class="fas fa-inbox" style="font-size: 24px; margin-bottom: 1rem; display: block;"></i>
                                        Chưa có môn học nào
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
                <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white; padding: 1.5rem;">
                    <h2 style="margin: 0; font-size: 18px; font-weight: 700;">
                        <i class="fas fa-info-circle"></i> Thông Tin Nhanh
                    </h2>
                </div>
                <div style="padding: 1.5rem;">
                    <a href="{{ route('grades.index') }}" style="display: block; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 12px 16px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 700; margin-bottom: 1rem; transition: all 0.3s; cursor: pointer; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(102, 126, 234, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-list"></i> Quản Lý Điểm
                    </a>

                    <a href="{{ route('grades.warning.teacher') }}" style="display: block; background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%); color: white; padding: 12px 16px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 700; margin-bottom: 1rem; transition: all 0.3s; cursor: pointer; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(245, 101, 101, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-exclamation-triangle"></i> Cảnh Báo Điểm
                    </a>

                    <a href="{{ route('grades.create') }}" style="display: block; background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white; padding: 12px 16px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 700; margin-bottom: 1rem; transition: all 0.3s; cursor: pointer; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(72, 187, 120, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-plus-circle"></i> Thêm Điểm
                    </a>

                    <a href="{{ route('profile.edit') }}" style="display: block; background: linear-gradient(135deg, var(--secondary) 0%, #a855f7 100%); color: white; padding: 12px 16px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 700; margin-bottom: 1rem; transition: all 0.3s; cursor: pointer; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(118, 75, 162, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-user-cog"></i> Chỉnh Sửa Hồ Sơ
                    </a>

                    <a href="{{ route('logout') }}" style="display: block; background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%); color: white; padding: 12px 16px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 700; transition: all 0.3s; cursor: pointer; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(245, 86, 86, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
