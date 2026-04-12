<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản Lý Điểm Sinh Viên') - HỌC SẾP</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        :root {
            --primary: #667eea;
            --primary-dark: #5568d3;
            --secondary: #764ba2;
            --success: #48bb78;
            --warning: #f6ad55;
            --danger: #f56565;
            --light: #f7fafc;
            --dark: #2d3748;
            --border-radius: 12px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        /* === GLOBAL STYLES === */
        body {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            min-height: 100vh;
            color: var(--dark);
        }
        
        a {
            text-decoration: none;
            color: var(--primary);
            transition: var(--transition);
        }
        
        a:hover {
            color: var(--primary-dark);
        }
        
        /* === NAVBAR === */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            box-shadow: var(--box-shadow);
            padding: 1rem 0;
            border-bottom: none;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 24px;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 14px;
            padding: 0.5rem 1rem !important;
            border-radius: 6px;
            transition: var(--transition);
            margin: 0 5px;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
        }
        
        .nav-link.active {
            background: rgba(255, 255, 255, 0.25);
            color: white !important;
        }
        
        .navbar-user {
            color: white !important;
            font-weight: 500;
            font-size: 14px;
            margin-right: 20px;
        }
        
        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white !important;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 13px;
            transition: var(--transition);
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        /* === CARDS === */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            font-weight: 600;
            padding: 1.25rem;
            font-size: 16px;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* === BUTTONS === */
        .btn {
            font-weight: 600;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            border: none;
            transition: var(--transition);
            font-size: 14px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .btn-secondary {
            background: var(--light);
            color: var(--dark);
            border: 2px solid var(--primary);
        }
        
        .btn-secondary:hover {
            background: var(--primary);
            color: white;
        }
        
        .btn-success {
            background: var(--success);
            color: white;
        }
        
        .btn-success:hover {
            background: #38a169;
            color: white;
        }
        
        .btn-danger {
            background: var(--danger);
            color: white;
        }
        
        .btn-danger:hover {
            background: #e53e3e;
            color: white;
        }
        
        .btn-warning {
            background: var(--warning);
            color: white;
        }
        
        .btn-warning:hover {
            background: #ed8936;
            color: white;
        }
        
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 12px;
        }
        
        /* === FORMS === */
        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
            font-size: 14px;
            transition: var(--transition);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark);
            font-size: 14px;
            margin-bottom: 0.5rem;
        }
        
        /* === TABLES === */
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background: #f7fafc;
            color: var(--dark);
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table tbody tr {
            border-bottom: 1px solid #e2e8f0;
            transition: var(--transition);
        }
        
        .table tbody tr:hover {
            background: #f7fafc;
        }
        
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }
        
        /* === BADGES === */
        .badge {
            padding: 0.5rem 0.75rem;
            font-weight: 600;
            border-radius: 6px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* === ALERTS === */
        .alert {
            border: none;
            border-radius: var(--border-radius);
            padding: 1rem 1.25rem;
            font-weight: 500;
        }
        
        .alert-success {
            background: #c6f6d5;
            color: #22543d;
        }
        
        .alert-danger {
            background: #fed7d7;
            color: #742a2a;
        }
        
        .alert-warning {
            background: #feebc8;
            color: #7c2d12;
        }
        
        .alert-info {
            background: #bee3f8;
            color: #2c5282;
        }
        
        /* === CONTAINERS === */
        .container {
            padding: 2rem 1rem;
        }
        
        /* === STATS BOXES === */
        .stat-box {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            border-left: 5px solid var(--primary);
            transition: var(--transition);
            text-align: center;
        }
        
        .stat-box:hover {
            transform: translateY(-5px);
        }
        
        .stat-box.success {
            border-left-color: var(--success);
        }
        
        .stat-box.warning {
            border-left-color: var(--warning);
        }
        
        .stat-box.danger {
            border-left-color: var(--danger);
        }
        
        .stat-label {
            color: #a0aec0;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }
        
        .stat-value {
            color: var(--dark);
            font-size: 32px;
            font-weight: 700;
        }
        
        /* === HEADINGS === */
        h1, h2, h3, h4, h5, h6 {
            color: var(--dark);
            font-weight: 700;
        }
        
        h1 {
            font-size: 32px;
            margin-bottom: 0.5rem;
        }
        
        h2 {
            font-size: 24px;
            margin-bottom: 1rem;
        }
        
        .page-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }
        
        .page-subtitle {
            color: #718096;
            font-size: 14px;
            font-weight: 500;
        }
        
        /* === FOOTER === */
        .footer {
            background: var(--dark);
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
            font-size: 13px;
        }
        
        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 20px;
            }
            
            .nav-link {
                padding: 0.5rem 0.5rem !important;
                font-size: 12px;
            }
            
            .stat-value {
                font-size: 24px;
            }
            
            h1 {
                font-size: 24px;
            }
        }
    </style>
    
    @yield('extra_css')
</head>
<body>
    <!-- === NAVBAR === -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="/">
                <i class="fas fa-graduation-cap"></i>
                <span>HỌC SẾP</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto d-flex align-items-center">
                    @auth
                        <span class="navbar-user">
                            <i class="fas fa-user-circle"></i>
                            {{ Auth::user()->name }}
                        </span>
                        
                        @if(Auth::user()->role_id == 3)
                            <a href="{{ route('grades.warning.student') }}" class="nav-link">
                                <i class="fas fa-exclamation-circle"></i> Cảnh Báo
                            </a>
                            <a href="{{ route('student.transcript') }}" class="nav-link">
                                <i class="fas fa-book"></i> Học Bạ
                            </a>
                        @elseif(Auth::user()->role_id == 2)
                            <a href="{{ route('grades.index') }}" class="nav-link">
                                <i class="fas fa-clipboard-list"></i> Quản Lý Điểm
                            </a>
                            <a href="{{ route('grades.warning.teacher') }}" class="nav-link">
                                <i class="fas fa-exclamation-circle"></i> Cảnh Báo
                            </a>
                        @elseif(Auth::user()->role_id == 1)
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="fas fa-users"></i> Người Dùng
                            </a>
                            <a href="{{ route('students.index') }}" class="nav-link">
                                <i class="fas fa-list"></i> Sinh Viên
                            </a>
                        @endif
                        
                        <a href="{{ route('profile.edit') }}" class="nav-link">
                            <i class="fas fa-cog"></i> Hồ Sơ
                        </a>
                        
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <!-- === MAIN CONTENT === -->
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                <strong>Có lỗi xảy ra!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @yield('content')
    </div>
    
    <!-- === FOOTER === -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Hệ Thống Quản Lý Điểm Sinh Viên (HỌC SẾP) - Thiết kế với ❤️ bằng Laravel</p>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('extra_js')
</body>
</html>
