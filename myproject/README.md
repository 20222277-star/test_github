# Hệ Thống Quản Lý Học Tập - Student Management System

<p align="center">
  <strong>Một ứng dụng web dùng Laravel để quản lý thông tin học sinh, giáo viên, môn học và điểm số</strong>
</p>

---

## 📋 Mục Lục

- [Giới Thiệu](#giới-thiệu)
- [Yêu Cầu Hệ Thống](#yêu-cầu-hệ-thống)
- [Cài Đặt & Setup](#cài-đặt--setup)
- [Tài Khoản Mẫu](#tài-khoản-mẫu)
- [Cấu Trúc Dự Án](#cấu-trúc-dự-án)
- [Mô Tả File Quan Trọng](#mô-tả-file-quan-trọng)
- [Hướng Dẫn Sử Dụng](#hướng-dẫn-sử-dụng)
- [API Endpoints](#api-endpoints)

---

## 🎯 Giới Thiệu

**Hệ Thống Quản Lý Học Tập** là một ứng dụng web được xây dựng với **Laravel 10** nhằm cung cấp giải pháp quản lý toàn diện cho các trường học. 

**Tính năng chính:**
- ✅ Quản lý người dùng (Admin, Giáo viên, Sinh viên)
- ✅ Quản lý thông tin sinh viên
- ✅ Quản lý môn học và giáo viên
- ✅ Quản lý điểm số và nhận xét
- ✅ Hệ thống phân quyền người dùng
- ✅ Đăng nhập/Đăng xuất an toàn
- ✅ **⚠️ MỚI: Cảnh báo điểm thấp cho sinh viên và giáo viên**

---

## 🛠️ Yêu Cầu Hệ Thống

- **PHP** >= 8.1
- **Composer** (để quản lý dependencies)
- **MySQL** hoặc **SQLite** (cho database)
- **Node.js & npm** (cho frontend assets)
- **Git** (tuỳ chọn)

**Các packages chính:**
- Laravel Framework ^10.10
- Laravel Sanctum ^3.3 (API authentication)
- GuzzleHTTP ^7.2 (HTTP client)

---

## 🚀 Cài Đặt & Setup

### Bước 1: Clone hoặc Copy Dự Án

```bash
# Copy dự án vào máy (nếu chưa có)
cd d:\hoclaravel\myproject
```

### Bước 2: Cài Đặt Dependencies

```bash
# Cài dependencies PHP
composer install

# Cài dependencies JavaScript
npm install
```

### Bước 3: Tạo File .env

```bash
# Copy file .env.example thành .env
cp .env.example .env

# Hoặc trên Windows:
copy .env.example .env
```

### Bước 4: Tạo App Key

```bash
php artisan key:generate
```

### Bước 5: Được Cấu Hình Database

Mở file `.env` và cấu hình database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hoclaravel
DB_USERNAME=root
DB_PASSWORD=
```

**Hoặc dùng SQLite:**

```env
DB_CONNECTION=sqlite
DB_DATABASE=database.sqlite
```

### Bước 6: Chạy Database Migrations & Seeding

```bash
# Tạo các bảng trong database
php artisan migrate

# Chèn dữ liệu mẫu (tài khoản test, vai trò, v.v.)
php artisan db:seed
```

### Bước 7: Build Frontend Assets (tuỳ chọn)

```bash
# Development
npm run dev

# Production
npm run build
```

### Bước 8: Chạy Ứng Dụng

```bash
# Chạy development server
php artisan serve

# Ứng dụng sẽ khởi chạy tại http://127.0.0.1:8000
```

---

## 👥 Tài Khoản Mẫu

Sau khi chạy lệnh `php artisan db:seed`, bạn sẽ có các tài khoản mẫu sau:

### 1. **Admin Account** (Quản Trị Viên)
```
Email:    admin@test.com
Password: password
Vai Trò:  Admin (Quản lý toàn bộ hệ thống)
```
**Quyền hạn:** 
- Quản lý người dùng (tạo, chỉnh sửa, xóa)
- Quản lý sinh viên
- Quản lý môn học
- Quản lý giáo viên
- Xem toàn bộ điểm số

---

### 2. **Teacher Account** (Giáo Viên)
```
Email:    teacher@test.com
Password: password
Vai Trò:  Teacher (Giáo viên)
```
**Quyền hạn:**
- Xem danh sách sinh viên lớp mình dạy
- Nhập điểm số cho sinh viên
- Xem/Chỉnh sửa profile
- Đổi mật khẩu

---

### 3. **Student Accounts** (Sinh Viên)
```
Email:    student1@test.com  | Password: password | Name: Sinh viên 1
Email:    student2@test.com  | Password: password | Name: Sinh viên 2
Email:    student3@test.com  | Password: password | Name: Sinh viên 3
Vai Trò:  Student (Sinh viên)
```
**Quyền hạn:**
- Xem profile của bản thân
- Xem điểm số của bản thân
- Xem danh sách môn học
- Đổi mật khẩu

---

## 📁 Cấu Trúc Dự Án

```
myproject/
├── app/                          # Thư mục ứng dụng chính
│   ├── Console/                 # Artisan commands
│   │   └── Kernel.php
│   ├── Exceptions/              # Xử lý exceptions
│   │   └── Handler.php
│   ├── Http/                    # Controllers & Middleware
│   │   ├── Controllers/         # Controllers (xử lý business logic)
│   │   │   ├── AuthController.php
│   │   │   ├── StudentController.php
│   │   │   ├── GradeController.php
│   │   │   ├── SubjectController.php
│   │   │   ├── UserController.php
│   │   │   ├── ProfileController.php
│   │   │   └── Controller.php
│   │   ├── Kernel.php           # Middleware configuration
│   │   └── Middleware/          # Custom middleware
│   ├── Models/                  # Eloquent Models (kết nối database)
│   │   ├── User.php
│   │   ├── Student.php
│   │   ├── Grade.php
│   │   ├── Subject.php
│   │   └── Role.php
│   └── Providers/               # Service Providers
│       ├── AppServiceProvider.php
│       ├── RouteServiceProvider.php
│       └── ...
├── bootstrap/                   # Bootstrap files
│   └── app.php                 # Application bootstrap
├── config/                      # Cấu hình ứng dụng
│   ├── app.php                 # Cấu hình app
│   ├── database.php            # Cấu hình database
│   ├── auth.php                # Cấu hình authentication
│   ├── mail.php                # Cấu hình email
│   └── ...
├── database/                    # Database files
│   ├── migrations/              # Database migrations (tạo bảng)
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2026_03_24_055914_create_students_table.php
│   │   ├── 2026_03_27_155308_create_roles_table.php
│   │   ├── 2026_03_27_155309_add_role_id_to_users_table.php
│   │   ├── 2026_03_27_155310_create_subjects_table.php
│   │   └── 2026_03_27_155311_create_grades_table.php
│   ├── seeders/                 # Database seeders (chèn dữ liệu mẫu)
│   │   ├── DatabaseSeeder.php
│   │   ├── UserSeeder.php
│   │   ├── RoleSeeder.php
│   │   ├── StudentSeeder.php
│   │   ├── SubjectSeeder.php
│   │   └── GradeSeeder.php
│   └── factories/               # Model factories (tạo fake data)
├── routes/                      # Route definitions
│   ├── web.php                 # Web routes
│   ├── api.php                 # API routes
│   └── ...
├── resources/                   # Frontend assets
│   ├── css/                    # CSS files
│   ├── js/                     # JavaScript files
│   └── views/                  # Blade templates (HTML views)
├── storage/                     # Storage files
│   └── logs/                   # Application logs
├── tests/                       # Unit & Feature tests
├── public/                      # Web root (chứa index.php)
│   └── index.php               # Entry point
├── vendor/                      # Composer dependencies
├── .env                         # Environment variables
├── .env.example                 # Example env file
├── composer.json                # PHP dependencies
├── package.json                 # Node.js dependencies
├── vite.config.js              # Vite configuration
├── phpunit.xml                 # PHPUnit configuration
└── README.md                    # File này
```

---

## 🆕 Chức Năng Mới: ⚠️ Cảnh Báo Điểm Thấp

Từ phiên bản mới, hệ thống có tính năng **cảnh báo điểm thấp** để hỗ trợ sinh viên và giáo viên theo dõi học tập.

### **Cho Sinh Viên:**
- 📊 Xem **danh sách môn học có điểm thấp** (dưới 5.0)
- 🔴 Nhận cảnh báo **nguy hiểm** khi điểm dưới 3.0
- 📈 Xem thống kê: số môn cảnh báo, điểm trung bình, tỷ lệ phần trăm
- 💡 Nhận được lời kiến nghị cải thiện học tập

**Truy cập:** Dashboard → Bấm nút `⚠️ Cảnh Báo`

### **Cho Giáo Viên:**
- 👁️ **Theo dõi danh sách sinh viên** có điểm thấp trong các môn họ dạy
- 🔴 Xem **sinh viên nguy hiểm** (điểm < 3.0) cần hỗ trợ ngay
- 📑 Xem **danh sách sinh viên có điểm trung bình thấp**
- ✏️ **Chỉnh sửa điểm** trực tiếp từ trang cảnh báo

**Truy cập:** Dashboard → Bấm nút `⚠️ Cảnh Báo`

### **Thiết Cấu Hình Cảnh Báo:**

File cấu hình: `config/grades.php`

```php
'warning_threshold' => 5.0,  // Mức điểm cảnh báo
'critical_threshold' => 3.0, // Mức điểm nguy hiểm
```

---

### **Services** (app/Services/)

| File | Chức Năng |
|------|-----------|
| `GradeWarningService.php` | **⭐ MỚI** - Service xử lý logic cảnh báo điểm thấp. Cung cấp các method: `getLowGradesForTeacher()`, `getLowGradesForStudent()`, `getCriticalGradesForTeacher()`, `getGradeStatisticsForStudent()`, `getWarningLevel()`, v.v. |

---

### **Cấu Hình** (config/)

| File | Chức Năng |
|------|-----------|
| `grades.php` | **⭐ MỚI** - Cấu hình mức điểm cảnh báo và nguy hiểm. Thiết lập ngưỡng: `warning_threshold` (mặc định 5.0) và `critical_threshold` (mặc định 3.0) |

---

## 📄 Mô Tả File Quan Trọng

### **Models** (app/Models/)

| File | Chức Năng |
|------|-----------|
| `User.php` | Model đại diện cho người dùng (Admin, Giáo viên, Sinh viên). Chứa mối quan hệ với Role |
| `Role.php` | Model đại diện cho vai trò (Admin, Teacher, Student). Quản lý phân quyền |
| `Student.php` | Model đại diện cho sinh viên. Chứa thông tin như MSSV, ngày sinh, lớp học |
| `Grade.php` | Model đại diện cho điểm số. Lưu trữ điểm của sinh viên từng môn |
| `Subject.php` | Model đại diện cho môn học. Chứa tên môn, số tín chỉ, giáo viên phụ trách |

---

### **Controllers** (app/Http/Controllers/)

| File | Chức Năng |
|------|-----------|
| `AuthController.php` | Xử lý đăng nhập/đăng xuất, hiển thị dashboard theo vai trò |
| `UserController.php` | Quản lý người dùng (tạo, chỉnh sửa, xóa, liệt kê) - chỉ Admin |
| `StudentController.php` | Quản lý thông tin sinh viên (CRUD operations) |
| `GradeController.php` | Quản lý điểm số, nhập điểm cho sinh viên, **cảnh báo điểm thấp** ⭐ |
| `SubjectController.php` | Quản lý môn học (tạo, chỉnh sửa, xóa) |
| `ProfileController.php` | Cho phép người dùng chỉnh sửa profile và đổi mật khẩu |

---

### **Database Migrations** (database/migrations/)

| File | Chức Năng |
|------|-----------|
| `2014_10_12_000000_create_users_table.php` | Tạo bảng `users` - lưu trữ thông tin người dùng |
| `2026_03_27_155308_create_roles_table.php` | Tạo bảng `roles` - lưu trữ các vai trò (Admin, Teacher, Student) |
| `2026_03_27_155309_add_role_id_to_users_table.php` | Thêm cột `role_id` vào bảng `users` - liên kết người dùng với vai trò |
| `2026_03_24_055914_create_students_table.php` | Tạo bảng `students` - lưu trữ thông tin chi tiết sinh viên |
| `2026_03_27_155310_create_subjects_table.php` | Tạo bảng `subjects` - lưu trữ thông tin môn học |
| `2026_03_27_155311_create_grades_table.php` | Tạo bảng `grades` - lưu trữ điểm số của sinh viên |

---

### **Database Seeders** (database/seeders/)

| File | Chức Năng |
|------|-----------|
| `DatabaseSeeder.php` | File chính - gọi tất cả các seeder khác để chèn dữ liệu mẫu |
| `RoleSeeder.php` | Chèn 3 vai trò: Admin, Teacher, Student |
| `UserSeeder.php` | Chèn các tài khoản mẫu (1 Admin, 1 Giáo viên, 3 Sinh viên) |
| `StudentSeeder.php` | Chèn thông tin sinh viên mẫu |
| `SubjectSeeder.php` | Chèn các môn học mẫu |
| `GradeSeeder.php` | Chèn điểm số mẫu cho sinh viên |

---

### **Routes** (routes/)

| File | Chức Năng |
|------|-----------|
| `web.php` | Định nghĩa tất cả routes web (đăng nhập, dashboard, quản lý, v.v.) |
| `api.php` | Định nghĩa API routes (nếu cần sử dụng API) |

---

### **Các File Cấu Hình Quan Trọng** (config/)

| File | Chức Năng |
|------|-----------|
| `.env` | File biến môi trường - cấu hình database, app key, v.v. |
| `config/app.php` | Cấu hình ứng dụng (tên app, timezone, providers) |
| `config/database.php` | Cấu hình kết nối database |
| `config/auth.php` | Cấu hình authentication (driver, guards, providers) |

---

## 🎓 Hướng Dẫn Sử Dụng

### 📝 Quy Trình Sử Dụng Sistem

#### **1. Bước Đầu: Đăng Nhập**

1. Truy cập `http://127.0.0.1:8000` hoặc `http://localhost:8000`
2. Bạn sẽ được chuyển hướng tới trang đăng nhập `/login`
3. Sử dụng một trong các tài khoản mẫu ở trên để đăng nhập

---

#### **2. Cho Admin (Quản Trị Viên)**

```
Đăng nhập với: admin@test.com / password
```

**Dashboard Admin có thể:**
- 📊 Xem tổng quan thống kê (số sinh viên, giáo viên, môn học)
- 👥 **Quản lý Người Dùng** `/users`
  - Xem danh sách tất cả người dùng
  - Thêm người dùng mới
  - Chỉnh sửa thông tin người dùng
  - Xóa người dùng
  
- 📚 **Quản lý Sinh Viên** `/students`
  - Xem danh sách toàn bộ sinh viên
  - Thêm sinh viên mới
  - Chỉnh sửa thông tin sinh viên
  
- 📖 **Quản lý Môn Học** `/subjects`
  - Xem danh sách môn học
  - Thêm môn học mới
  
- 📋 **Quản lý Điểm Số** `/grades`
  - Xem toàn bộ điểm số
  - Nhập/Chỉnh sửa điểm

---

#### **3. Cho Giáo Viên (Teacher)**

```
Đăng nhập với: teacher@test.com / password
```

**Dashboard Giáo Viên có thể:**
- 👨‍🎓 Xem danh sách sinh viên lớp mình dạy
- 📝 Nhập điểm số cho sinh viên
- ✏️ Chỉnh sửa profile của bản thân
- 🔑 Đổi mật khẩu `/profile/change-password`

---

#### **4. Cho Sinh Viên (Student)**

```
Đăng nhập với: student1@test.com / password
hoặc:        student2@test.com / password
hoặc:        student3@test.com / password
```

**Dashboard Sinh Viên có thể:**
- 📄 Xem profile cá nhân
- 📊 Xem điểm số của bản thân
- 📚 Xem danh sách các môn học
- 🔑 Đổi mật khẩu

---

### 🔧 Các Lệnh Artisan Hữu Ích

```bash
# Hiển thị toàn bộ routes
php artisan route:list

# Xem danh sách các models
php artisan make:model NamModel

# Tạo controller mới
php artisan make:controller NamController

# Tạo migration mới
php artisan make:migration migration_name

# Chạy lại toàn bộ migrations (xóa & tạo lại database)
php artisan migrate:refresh

# Chạy seeder lại
php artisan db:seed

# Xóa cache
php artisan cache:clear

# Xem logs realtime
php artisan tinker
```

---

## 🌐 API Endpoints

Nếu cần công khai API, dưới đây là các endpoints API khả dụng:

```
POST   /api/login              - Đăng nhập
POST   /api/logout             - Đăng xuất
GET    /api/users              - Danh sách người dùng
GET    /api/students           - Danh sách sinh viên
GET    /api/subjects           - Danh sách môn học
GET    /api/grades             - Danh sách điểm số
POST   /api/grades             - Thêm điểm số mới
```

---

## 📌 Lưu Ý Quan Trọng

✅ **Ghi chú file trong README KHÔNG gây lỗi** - Đây chỉ là file Markdown để hướng dẫn, không ảnh hưởng đến code

✅ **Mật khẩu mẫu:** Tất cả tài khoản test đều dùng mật khẩu `password`

✅ **Environment:** File `.env` không nên commit lên Git (đã được gitignore)

✅ **Database:** Luôn backup trước khi chạy `php artisan migrate:refresh`

---

## 📞 Support & Thông Tin Thêm

- 📖 Tài liệu Laravel: [laravel.com/docs](https://laravel.com/docs)
- 🎓 Khóa học Laravel: [laravel.com/bootcamp](https://bootcamp.laravel.com)
- 💬 Cộng đồng: [Laravel Community](https://laravel.com/community)

---

## 📜 License

Dự án này được cấp phép dưới MIT License.

---

**Cập nhật lần cuối:** 29/03/2026

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


