<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - HỌC SẾP</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        :root {
            --primary: #667eea;
            --primary-dark: #5568d3;
            --secondary: #764ba2;
        }
        
        body {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-wrapper {
            width: 100%;
            max-width: 420px;
        }
        
        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }
        
        .login-header .brand {
            font-size: 40px;
            margin-bottom: 10px;
        }
        
        .login-header h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 10px 0 5px 0;
        }
        
        .login-header p {
            font-size: 14px;
            opacity: 0.95;
            margin: 0;
        }
        
        .login-body {
            padding: 2.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #2d3748;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
        }
        
        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f7fafc;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            background: white;
        }
        
        .password-wrapper {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 14px;
            top: 40px;
            cursor: pointer;
            color: var(--primary);
            font-size: 18px;
            user-select: none;
            transition: all 0.3s ease;
        }
        
        .toggle-password:hover {
            color: var(--primary-dark);
            transform: scale(1.1);
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 1.5rem;
            padding: 12px 16px;
            font-size: 13px;
        }
        
        .alert-danger {
            background: #fed7d7;
            color: #742a2a;
        }
        
        .alert ul {
            margin: 8px 0 0 20px;
            padding-left: 0;
        }
        
        .alert li {
            margin: 4px 0;
        }
        
        .divider {
            margin: 2rem 0;
            text-align: center;
            position: relative;
            color: #a0aec0;
            font-size: 12px;
            font-weight: 600;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e2e8f0;
            z-index: 0;
        }
        
        .divider span {
            position: relative;
            background: white;
            padding: 0 10px;
            z-index: 1;
        }
        
        .credentials-box {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: 12px;
            padding: 1.5rem;
            border-left: 4px solid var(--primary);
        }
        
        .credentials-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        .credentials-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
            font-size: 12px;
            color: #2d3748;
        }
        
        .credentials-item:last-child {
            border-bottom: none;
        }
        
        .credentials-role {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
            min-width: 80px;
        }
        
        .credentials-role.teacher {
            background: #f6ad55;
        }
        
        .credentials-role.student {
            background: #48bb78;
        }
        
        @media (max-width: 480px) {
            .login-header {
                padding: 2rem 1.5rem;
            }
            
            .login-body {
                padding: 1.5rem;
            }
            
            .login-header .brand {
                font-size: 32px;
            }
            
            .login-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="brand">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1>HỌC SẾP</h1>
                <p>Hệ Thống Quản Lý Điểm Sinh Viên</p>
            </div>
            
            <!-- Body -->
            <div class="login-body">
                <!-- Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong><i class="fas fa-exclamation-circle"></i> Lỗi Đăng Nhập!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="Nhập email của bạn" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <div class="password-wrapper">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" 
                                   placeholder="Nhập mật khẩu" required>
                            <span class="toggle-password" id="togglePassword" onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> ĐĂNG NHẬP
                    </button>
                </form>
                
                <!-- Divider -->
                <div class="divider">
                    <span>Tài Khoản Thử Nghiệm</span>
                </div>
                
                <!-- Credentials -->
                <div class="credentials-box">
                    <div class="credentials-title">
                        <i class="fas fa-user-lock"></i> Tài Khoản Test
                    </div>
                    
                    <div class="credentials-item">
                        <span class="credentials-role">Quản Trị</span>
                        <span>admin@test.com</span>
                    </div>
                    
                    <div class="credentials-item">
                        <span class="credentials-role teacher">Giáo Viên</span>
                        <span>teacher@test.com</span>
                    </div>
                    
                    <div class="credentials-item">
                        <span class="credentials-role student">Sinh Viên</span>
                        <span>student1@test.com</span>
                    </div>
                    
                    <div class="credentials-item">
                        <strong style="color: var(--primary);">Mật Khẩu:</strong>
                        <span>password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword').querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
            font-weight: 600;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e2e8f0;
            z-index: 0;
        }
        
        .divider span {
            position: relative;
            background: white;
            padding: 0 10px;
            z-index: 1;
        }
        
        .credentials-box {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: 12px;
            padding: 1.5rem;
            border-left: 4px solid var(--primary);
        }
        
        .credentials-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        .credentials-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
            font-size: 12px;
            color: #2d3748;
        }
        
        .credentials-item:last-child {
            border-bottom: none;
        }
        
        .credentials-role {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
            min-width: 80px;
        }
        
        .credentials-role.teacher {
            background: #f6ad55;
        }
        
        .credentials-role.student {
            background: #48bb78;
        }
        
        @media (max-width: 480px) {
            .login-header {
                padding: 2rem 1.5rem;
            }
            
            .login-body {
                padding: 1.5rem;
            }
            
            .login-header .brand {
                font-size: 32px;
            }
            
            .login-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="brand">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1>HỌC SẾP</h1>
                <p>Hệ Thống Quản Lý Điểm Sinh Viên</p>
            </div>
            
            <!-- Body -->
            <div class="login-body">
                <!-- Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong><i class="fas fa-exclamation-circle"></i> Lỗi Đăng Nhập!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="Nhập email của bạn" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <div class="password-wrapper">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" 
                                   placeholder="Nhập mật khẩu" required>
                            <span class="toggle-password" id="togglePassword" onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> ĐĂNG NHẬP
                    </button>
                </form>
                
                <!-- Divider -->
                <div class="divider">
                    <span>Tài Khoản Thử Nghiệm</span>
                </div>
                
                <!-- Credentials -->
                <div class="credentials-box">
                    <div class="credentials-title">
                        <i class="fas fa-user-lock"></i> Tài Khoản Test
                    </div>
                    
                    <div class="credentials-item">
                        <span class="credentials-role">Quản Trị</span>
                        <span>admin@test.com</span>
                    </div>
                    
                    <div class="credentials-item">
                        <span class="credentials-role teacher">Giáo Viên</span>
                        <span>teacher@test.com</span>
                    </div>
                    
                    <div class="credentials-item">
                        <span class="credentials-role student">Sinh Viên</span>
                        <span>student1@test.com</span>
                    </div>
                    
                    <div class="credentials-item">
                        <strong style="color: var(--primary);">Mật Khẩu:</strong>
                        <span>password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword').querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>

