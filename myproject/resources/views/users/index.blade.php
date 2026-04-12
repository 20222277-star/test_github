@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <div>
                <h1 style="font-size: 32px; font-weight: 700; color: #2d3748; margin: 0;">
                    <i class="fas fa-users-cog" style="margin-right: 10px; color: var(--primary);"></i>Quản Lý Tài Khoản
                </h1>
                <p style="color: #a0aec0; margin: 0.5rem 0 0 0;">Danh sách tất cả người dùng hệ thống</p>
            </div>
            <a href="{{ route('users.create') }}" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 700; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(102, 126, 234, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <i class="fas fa-plus-circle"></i> Tạo Tài Khoản
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

    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 1.5rem;">
            <h2 style="margin: 0; font-size: 18px; font-weight: 700;">
                <i class="fas fa-list"></i> Danh Sách Tài Khoản
            </h2>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%); border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700;">#</th>
                        <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700;">Tên</th>
                        <th style="padding: 12px; text-align: left; color: #2d3748; font-weight: 700;">Email</th>
                        <th style="padding: 12px; text-align: center; color: #2d3748; font-weight: 700;">Vai Trò</th>
                        <th style="padding: 12px; text-align: center; color: #2d3748; font-weight: 700;">Trạng Thái</th>
                        <th style="padding: 12px; text-align: center; color: #2d3748; font-weight: 700;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.3s;">
                            <td style="padding: 12px; color: #718096; font-family: monospace;">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                            <td style="padding: 12px; color: #2d3748; font-weight: 500;">
                                {{ $user->name }}
                                @if ($user->id == Auth::id())
                                    <span style="background: #f6ad55; color: white; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; display: inline-block; margin-left: 8px;">Bạn</span>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #718096;">{{ $user->email }}</td>
                            <td style="padding: 12px; text-align: center;">
                                @if ($user->role_id == 1)
                                    <span style="background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%); color: white; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;">
                                        <i class="fas fa-crown"></i> Admin
                                    </span>
                                @elseif ($user->role_id == 2)
                                    <span style="background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%); color: white; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;">
                                        <i class="fas fa-chalkboard-user"></i> Giáo Viên
                                    </span>
                                @else
                                    <span style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;">
                                        <i class="fas fa-user-graduate"></i> Sinh Viên
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <span style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;">
                                    <i class="fas fa-check-circle"></i> Hoạt Động
                                </span>
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <a href="{{ route('users.show', $user) }}" style="display: inline-block; padding: 6px 12px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 12px; transition: all 0.3s; margin-right: 4px;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" title="Xem chi tiết">
                                    <i class="fas fa-eye"></i> Xem
                                </a>
                                @if ($user->id != Auth::id() && $user->role_id != 1)
                                    <a href="{{ route('users.edit', $user) }}" style="display: inline-block; padding: 6px 12px; background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%); color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 12px; transition: all 0.3s; margin-right: 4px;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" title="Sửa">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('users.resetPassword', $user) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="display: inline-block; padding: 6px 12px; background: linear-gradient(135deg, var(--secondary) 0%, #a855f7 100%); color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.3s; margin-right: 4px;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" title="Reset mật khẩu" onclick="return confirm('Reset mật khẩu thành password?')">
                                            <i class="fas fa-key"></i> Reset
                                        </button>
                                    </form>
                                    <button onclick="if(confirm('Bạn chắc chắn muốn xóa?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }" style="display: inline-block; padding: 6px 12px; background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%); color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" title="Xóa">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 2rem; text-align: center; color: #a0aec0;">
                                <i class="fas fa-inbox" style="font-size: 24px; margin-bottom: 1rem; display: block;"></i>
                                Không có tài khoản nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div style="padding: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: center;">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
