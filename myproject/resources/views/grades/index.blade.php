@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <div>
                <h1 style="font-size: 32px; font-weight: 700; color: #2d3748; margin: 0;">
                    <i class="fas fa-list-ul" style="margin-right: 10px; color: var(--primary);"></i>Quản Lý Điểm
                </h1>
                <p style="color: #a0aec0; margin: 0.5rem 0 0 0;">Danh sách tất cả điểm sinh viên</p>
            </div>
            <a href="{{ route('grades.create') }}" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 700; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(102, 126, 234, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <i class="fas fa-plus-circle"></i> Thêm Điểm
            </a>
        </div>
    </div>

    @if (session('success'))
        <div style="background: linear-gradient(135deg, rgba(72, 187, 120, 0.1) 0%, rgba(72, 187, 120, 0.05) 100%); border-left: 4px solid #48bb78; color: #22543d; padding: 1rem 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-check-circle" style="color: #48bb78; font-size: 20px;"></i>
                    <div>
                        <strong>Thành công!</strong>
                        <p style="margin: 4px 0 0 0; font-size: 14px;">{{ session('success') }}</p>
                    </div>
                </div>
                <button onclick="this.parentElement.parentElement.style.display='none'" style="background: none; border: none; color: #22543d; cursor: pointer; font-size: 20px;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div style="background: linear-gradient(135deg, rgba(245, 101, 101, 0.1) 0%, rgba(245, 101, 101, 0.05) 100%); border-left: 4px solid #f56565; color: #742a2a; padding: 1rem 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-exclamation-circle" style="color: #f56565; font-size: 20px;"></i>
                    <div>
                        <strong>Lỗi!</strong>
                        <p style="margin: 4px 0 0 0; font-size: 14px;">{{ session('error') }}</p>
                    </div>
                </div>
                <button onclick="this.parentElement.parentElement.style.display='none'" style="background: none; border: none; color: #742a2a; cursor: pointer; font-size: 20px;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 1.5rem;">
            <h2 style="margin: 0; font-size: 18px; font-weight: 700;">
                <i class="fas fa-table"></i> Danh Sách Điểm
            </h2>
        </div>
        
        <div style="padding: 1.5rem; overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700;">Sinh Viên</th>
                        <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700;">Môn Học</th>
                        <th style="padding: 12px; text-align: center; color: #2d3748; font-weight: 700;">Điểm</th>
                        <th style="padding: 12px; text-align: center; color: #2d3748; font-weight: 700;">Kỳ</th>
                        <th style="padding: 12px; text-align: center; color: #2d3748; font-weight: 700;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($grades as $grade)
                        <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.3s;">
                            <td style="padding: 12px; color: #2d3748; font-weight: 500;">{{ $grade->student->name }}</td>
                            <td style="padding: 12px; color: #718096;">{{ $grade->subject->name }}</td>
                            <td style="padding: 12px; text-align: center;">
                                @php
                                    $score = $grade->score;
                                    if ($score >= 8) $badgeColor = 'var(--success)';
                                    elseif ($score >= 7) $badgeColor = 'var(--primary)';
                                    elseif ($score >= 5) $badgeColor = 'var(--warning)';
                                    else $badgeColor = 'var(--danger)';
                                @endphp
                                <span style="background: {{ $badgeColor }}; color: white; padding: 6px 12px; border-radius: 6px; font-weight: 600;">
                                    {{ number_format($score, 2) }}/10
                                </span>
                            </td>
                            <td style="padding: 12px; text-align: center; color: #718096;">Kỳ {{ $grade->semester }}</td>
                            <td style="padding: 12px; text-align: center;">
                                <a href="{{ route('grades.edit', $grade) }}" style="display: inline-block; padding: 6px 12px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 12px; transition: all 0.3s; margin-right: 6px;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <button onclick="if(confirm('Bạn chắc chắn muốn xóa?')) { document.getElementById('delete-form-{{ $grade->id }}').submit(); }" style="display: inline-block; padding: 6px 12px; background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%); color: white; border: none; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                                <form id="delete-form-{{ $grade->id }}" action="{{ route('grades.destroy', $grade) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 2rem; text-align: center; color: #a0aec0;">
                                <i class="fas fa-inbox" style="font-size: 24px; margin-bottom: 1rem; display: block;"></i>
                                Không có bản ghi điểm
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($grades->hasPages())
            <div style="padding: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: center;">
                {{ $grades->links() }}
            </div>
        @endif
    </div>
@endsection
