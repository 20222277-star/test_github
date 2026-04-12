@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <div>
                <h1 style="font-size: 32px; font-weight: 700; color: #2d3748; margin: 0;">
                    <i class="fas fa-users" style="margin-right: 10px; color: var(--primary);"></i>Quản Lý Sinh Viên
                </h1>
                <p style="color: #a0aec0; margin: 0.5rem 0 0 0;">Danh sách tất cả sinh viên</p>
            </div>
            <a href="/students/create" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 700; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(102, 126, 234, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <i class="fas fa-plus-circle"></i> Thêm Sinh Viên
            </a>
        </div>
    </div>

    @if(session('success'))
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

    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 2rem;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #e2e8f0;">
            <form method="GET" action="/students" style="display: flex; gap: 1rem;">
                <div style="flex: 1;">
                    <input type="text" name="search" placeholder="Tìm theo tên hoặc ngành học..." value="{{ $search ?? '' }}" style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.3s; background: #f7fafc;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#e2e8f0'">
                </div>
                <button type="submit" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(102, 126, 234, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <i class="fas fa-search"></i> Tìm kiếm
                </button>
                @if($search)
                    <a href="/students" style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 700; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(108, 117, 125, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-times"></i> Xóa Bộ Lọc
                    </a>
                @endif
            </form>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%); border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700;">ID</th>
                        <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700;">Tên</th>
                        <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700;">Ngành Học</th>
                        <th style="padding: 12px; text-align: center; color: #2d3748; font-weight: 700;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.3s;">
                            <td style="padding: 12px; color: #718096; font-family: monospace;">#{{ $student->id }}</td>
                            <td style="padding: 12px; color: #2d3748; font-weight: 500;">{{ $student->name }}</td>
                            <td style="padding: 12px; color: #718096;">{{ $student->major ?? 'N/A' }}</td>
                            <td style="padding: 12px; text-align: center;">
                                <a href="/students/{{ $student->id }}" style="display: inline-block; padding: 6px 12px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 12px; transition: all 0.3s; margin-right: 4px;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fas fa-eye"></i> Xem
                                </a>
                                <a href="/students/{{ $student->id }}/edit" style="display: inline-block; padding: 6px 12px; background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%); color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 12px; transition: all 0.3s; margin-right: 4px;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <button onclick="if(confirm('Bạn chắc chắn muốn xóa?')) { document.getElementById('delete-form-{{ $student->id }}').submit(); }" style="display: inline-block; padding: 6px 12px; background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%); color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                                <form id="delete-form-{{ $student->id }}" method="POST" action="/students/{{ $student->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 2rem; text-align: center; color: #a0aec0;">
                                <i class="fas fa-inbox" style="font-size: 24px; margin-bottom: 1rem; display: block;"></i>
                                Không có sinh viên nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($students->hasPages())
            <div style="padding: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: center;">
                {{ $students->links() }}
            </div>
        @endif
    </div>
@endsection
                {{ $students->links() }}
            </div>
        @else
            <div class="no-data">
                <p>Không có sinh viên nào trong danh sách.</p>
            </div>
        @endif
    </div>
</body>
</html>
    </div>
</body>
</html>
