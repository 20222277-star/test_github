@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 32px; font-weight: 700; color: #2d3748; margin: 0;">
            <i class="fas fa-user-circle" style="margin-right: 10px; color: var(--primary);"></i>Hồ Sơ Cá Nhân
        </h1>
        <p style="color: #a0aec0; margin: 0.5rem 0 0 0;">Quản lý thông tin cá nhân và bảo mật</p>
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

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
        <!-- Thông Tin Cá Nhân -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
            <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 1.5rem;">
                <h2 style="margin: 0; font-size: 18px; font-weight: 700;">
                    <i class="fas fa-id-card"></i> Thông Tin Cá Nhân
                </h2>
            </div>
            <div style="padding: 1.5rem;">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--primary); letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block;">Tên Đầy Đủ</label>
                        <input type="text" name="name" 
                               style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.3s; @error('name') border-color: #f56565; @enderror" 
                               value="{{ old('name', $user->name) }}" required
                               onfocus="this.style.borderColor='var(--primary)'" 
                               onblur="this.style.borderColor='#e2e8f0'">
                        @error('name')
                            <p style="color: #f56565; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--primary); letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block;">Email</label>
                        <input type="email" name="email" 
                               style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.3s; @error('email') border-color: #f56565; @enderror" 
                               value="{{ old('email', $user->email) }}" required
                               onfocus="this.style.borderColor='var(--primary)'" 
                               onblur="this.style.borderColor='#e2e8f0'">
                        @error('email')
                            <p style="color: #f56565; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--primary); letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block;">Vai Trò</label>
                        <input type="text" 
                               style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; background: #f7fafc; color: #718096;" 
                               value="{{ $user->role->name }}" disabled>
                    </div>

                    <button type="submit" style="width: 100%; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 12px 16px; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(102, 126, 234, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-save"></i> Cập Nhật Thông Tin
                    </button>
                </form>
            </div>
        </div>

        <!-- Đổi Mật Khẩu -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
            <div style="background: linear-gradient(135deg, var(--secondary) 0%, #a855f7 100%); color: white; padding: 1.5rem;">
                <h2 style="margin: 0; font-size: 18px; font-weight: 700;">
                    <i class="fas fa-lock"></i> Đổi Mật Khẩu
                </h2>
            </div>
            <div style="padding: 1.5rem;">
                <form action="{{ route('profile.changePassword') }}" method="POST">
                    @csrf

                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--secondary); letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block;">Mật Khẩu Hiện Tại</label>
                        <input type="password" name="current_password" 
                               style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.3s; @error('current_password') border-color: #f56565; @enderror" 
                               required
                               onfocus="this.style.borderColor='var(--secondary)'" 
                               onblur="this.style.borderColor='#e2e8f0'">
                        @error('current_password')
                            <p style="color: #f56565; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--secondary); letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block;">Mật Khẩu Mới</label>
                        <input type="password" name="password" 
                               style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.3s; @error('password') border-color: #f56565; @enderror" 
                               required
                               onfocus="this.style.borderColor='var(--secondary)'" 
                               onblur="this.style.borderColor='#e2e8f0'">
                        @error('password')
                            <p style="color: #f56565; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--secondary); letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block;">Xác Nhận Mật Khẩu</label>
                        <input type="password" name="password_confirmation" 
                               style="width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.3s;" 
                               required
                               onfocus="this.style.borderColor='var(--secondary)'" 
                               onblur="this.style.borderColor='#e2e8f0'">
                    </div>

                    <button type="submit" style="width: 100%; background: linear-gradient(135deg, var(--secondary) 0%, #a855f7 100%); color: white; padding: 12px 16px; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(118, 75, 162, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fas fa-key"></i> Đổi Mật Khẩu
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Thông Tin Hệ Thống -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); color: white; padding: 1.5rem;">
            <h2 style="margin: 0; font-size: 18px; font-weight: 700;">
                <i class="fas fa-info-circle"></i> Thông Tin Hệ Thống
            </h2>
        </div>
        <div style="padding: 1.5rem;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div>
                    <div style="font-size: 12px; color: #a0aec0; text-transform: uppercase; font-weight: 700; margin-bottom: 0.5rem;">Ngày Tạo Tài Khoản</div>
                    <div style="font-size: 16px; color: #2d3748; font-weight: 600;">{{ $user->created_at->format('d/m/Y') }} <span style="color: #a0aec0; font-size: 13px;">{{ $user->created_at->format('H:i') }}</span></div>
                </div>
                <div>
                    <div style="font-size: 12px; color: #a0aec0; text-transform: uppercase; font-weight: 700; margin-bottom: 0.5rem;">Cập Nhật Gần Đây</div>
                    <div style="font-size: 16px; color: #2d3748; font-weight: 600;">{{ $user->updated_at->format('d/m/Y') }} <span style="color: #a0aec0; font-size: 13px;">{{ $user->updated_at->format('H:i') }}</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection
