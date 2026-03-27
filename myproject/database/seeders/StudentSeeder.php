<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Thêm 15 dữ liệu mẫu cho bảng students (đủ 3 trang, 5 sinh viên/trang)
        Student::create(['name' => 'Nguyễn Văn A', 'major' => 'Kỹ thuật phần mềm']);
        Student::create(['name' => 'Trần Thị B', 'major' => 'Công nghệ thông tin']);
        Student::create(['name' => 'Lê Văn C', 'major' => 'Khoa học máy tính']);
        Student::create(['name' => 'Phạm Thị D', 'major' => 'Quản trị mạng']);
        Student::create(['name' => 'Đỗ Văn E', 'major' => 'An ninh mạng']);
        Student::create(['name' => 'Võ Thị F', 'major' => 'Thiết kế đồ họa']);
        Student::create(['name' => 'Hoàng Văn G', 'major' => 'Phát triển web']);
        Student::create(['name' => 'Dương Thị H', 'major' => 'Cơ sở dữ liệu']);
        Student::create(['name' => 'Bùi Văn I', 'major' => 'Hệ thống thông tin']);
        Student::create(['name' => 'Tô Thị K', 'major' => 'Công nghệ phần mềm']);
        Student::create(['name' => 'Trương Văn L', 'major' => 'Mạng máy tính']);
        Student::create(['name' => 'Phan Thị M', 'major' => 'Lập trình ứng dụng']);
        Student::create(['name' => 'Vũ Văn N', 'major' => 'Trí tuệ nhân tạo']);
        Student::create(['name' => 'Ngô Thị O', 'major' => 'Phân tích dữ liệu']);
        Student::create(['name' => 'Hà Văn P', 'major' => 'Bảo mật thông tin']);
    }
}
