<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['name' => 'Lập Trình PHP', 'credits' => 3, 'description' => 'Học lập trình Web với PHP', 'teacher_id' => 2],
            ['name' => 'Cơ Sở Dữ Liệu', 'credits' => 3, 'description' => 'Thiết kế và quản lý cơ sở dữ liệu', 'teacher_id' => 2],
            ['name' => 'Lập Trình JavaScript', 'credits' => 3, 'description' => 'JavaScript frontend và backend', 'teacher_id' => 2],
            ['name' => 'HTML/CSS', 'credits' => 2, 'description' => 'Thiết kế giao diện web', 'teacher_id' => 2],
            ['name' => 'Mạng Máy Tính', 'credits' => 3, 'description' => 'Nguyên lý và ứng dụng mạng', 'teacher_id' => 2],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
