<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo roles trước
        $this->call(RoleSeeder::class);
        
        // Tạo users (admin, teacher, students)
        $this->call(UserSeeder::class);
        
        // Tạo môn học
        $this->call(SubjectSeeder::class);
        
        // Tạo dữ liệu điểm
        $this->call(GradeSeeder::class);
        
        // Thêm dữ liệu sinh viên cũ
        $this->call(StudentSeeder::class);
    }
}
