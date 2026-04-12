@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 2rem;">
        <div style="margin-bottom: 1.5rem;">
            <h1 style="font-size: 32px; font-weight: 700; color: #2d3748; margin: 0;">
                <i class="fas fa-home" style="margin-right: 10px; color: var(--primary);"></i>Dashboard
            </h1>
            <p style="color: #a0aec0; margin: 0.5rem 0 0 0;">Chào mừng bạn trở lại, {{ Auth::user()->name }}</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        @php
            $gpa = 0;
            $totalScore = 0;
            $totalCredits = 0;
            foreach (Auth::user()->grades as $grade) {
                $totalScore += $grade->score * $grade->subject->credits;
                $totalCredits += $grade->subject->credits;
            }
            $gpa = $totalCredits > 0 ? round($totalScore / $totalCredits, 2) : 0;
            if ($gpa >= 8.5) $rank = 'Xuất Sắc';
            elseif ($gpa >= 8) $rank = 'Giỏi';
            elseif ($gpa >= 7) $rank = 'Khá';
            elseif ($gpa >= 5) $rank = 'Tạm Tốt';
            else $rank = 'Yếu';
        @endphp
        
        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 4px solid var(--primary);">
            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--primary); letter-spacing: 0.5px; margin-bottom: 0.75rem;">
                <i class="fas fa-book"></i> Tổng Môn Học
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #2d3748;">{{ Auth::user()->grades->count() }}</div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 4px solid var(--secondary);">
            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--secondary); letter-spacing: 0.5px; margin-bottom: 0.75rem;">
                <i class="fas fa-star"></i> Điểm GPA
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #2d3748;">{{ $gpa }}/10</div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 4px solid #48bb78;">
            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #48bb78; letter-spacing: 0.5px; margin-bottom: 0.75rem;">
                <i class="fas fa-graduation-cap"></i> Tín Chỉ
            </div>
            <div style="font-size: 32px; font-weight: 700; color: #2d3748;">{{ $totalCredits }}</div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 4px solid #f6ad55;">
            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #f6ad55; letter-spacing: 0.5px; margin-bottom: 0.75rem;">
                <i class="fas fa-medal"></i> Xếp Hạng
            </div>
            <div style="font-size: 28px; font-weight: 700; color: #2d3748;">{{ $rank }}</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        <!-- Main Content -->
        <div>
            <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 2rem;">
                <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 1.5rem;">
                    <h2 style="margin: 0; font-size: 18px; font-weight: 700;">
                        <i class="fas fa-book-open"></i> Các Môn Học Của Bạn
                    </h2>
                </div>
                <div style="padding: 1.5rem; overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                        <thead>
                            <tr style="border-bottom: 2px solid #e2e8f0;">
                                <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700; white-space: nowrap;">Tên Môn Học</th>
                                <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700; white-space: nowrap;">Giáo Viên</th>
                                <th style="padding: 12px; text-align: center; color: #2d3748; font-weight: 700; white-space: nowrap;">Tín Chỉ</th>
                                <th style="padding: 12px; text-align: center; color: #2d3748; font-weight: 700; white-space: nowrap;">Điểm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (Auth::user()->grades as $grade)
                                <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.3s;">
                                    <td style="padding: 12px; color: #2d3748;">{{ $grade->subject->name }}</td>
                                    <td style="padding: 12px; color: #718096;">{{ $grade->subject->teacher->name ?? 'N/A' }}</td>
                                    <td style="padding: 12px; text-align: center;">
                                        <span style="background: var(--primary); color: white; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                            {{ $grade->subject->credits }}
                                        </span>
                                    </td>
                                    <td style="padding: 12px; text-align: center;">
                                        @php
                                            $score = $grade->score;
                                            if ($score >= 8) $badgeColor = 'var(--success)';
                                            elseif ($score >= 7) $badgeColor = 'var(--primary)';
                                            elseif ($score >= 5) $badgeColor = 'var(--warning)';
                                            else $badgeColor = 'var(--danger)';
                                        @endphp
                                        <span style="background: {{ $badgeColor }}; color: white; padding: 4px 12px; border-radius: 6px; font-weight: 600; font-size: 12px;">
                                            {{ number_format($score, 2) }}/10
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="padding: 2rem; text-align: center; color: #a0aec0;">
                                        <i class="fas fa-inbox" style="font-size: 24px; margin-bottom: 1rem; display: block;"></i>
                                        Chưa có điểm nào
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
                <div style="background: linear-gradient(135deg, var(--secondary) 0%, #a855f7 100%); color: white; padding: 1.5rem;">
                    <h2 style="margin: 0; font-size: 18px; font-weight: 700;">
                        <i class="fas fa-chart-line"></i> Biểu Đồ Điểm
                    </h2>
                </div>
                <div style="padding: 1.5rem;">
                    <div style="position: relative; height: 300px;">
                        <canvas id="gradeChart"></canvas>
                    </div>
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
                    <a href="{{ route('student.transcript') }}" style="display: block; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 12px 16px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 700; margin-bottom: 1rem; transition: all 0.3s; cursor: pointer; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(102, 126, 234, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-download"></i> Xem Học Bạ
                    </a>

                    <a href="{{ route('grades.warning.student') }}" style="display: block; background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%); color: white; padding: 12px 16px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 700; margin-bottom: 1rem; transition: all 0.3s; cursor: pointer; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(245, 101, 101, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-exclamation-triangle"></i> Cảnh Báo Điểm
                    </a>

                    <a href="{{ route('profile.edit') }}" style="display: block; background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white; padding: 12px 16px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 700; margin-bottom: 1rem; transition: all 0.3s; cursor: pointer; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(72, 187, 120, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-user-cog"></i> Chỉnh Sửa Hồ Sơ
                    </a>

                    <a href="{{ route('logout') }}" style="display: block; background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%); color: white; padding: 12px 16px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: 700; transition: all 0.3s; cursor: pointer; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(245, 86, 86, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
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
@endsection
