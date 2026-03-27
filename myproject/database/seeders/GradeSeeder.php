<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Thêm các bản ghi điểm cho sinh viên trong các môn học
        $grades = [
            // Sinh viên 1 (id=3)
            ['student_id' => 3, 'subject_id' => 1, 'score' => 8.5, 'semester' => 1],
            ['student_id' => 3, 'subject_id' => 2, 'score' => 7.5, 'semester' => 1],
            ['student_id' => 3, 'subject_id' => 3, 'score' => 9.0, 'semester' => 1],
            ['student_id' => 3, 'subject_id' => 4, 'score' => 8.0, 'semester' => 1],
            
            // Sinh viên 2 (id=4)
            ['student_id' => 4, 'subject_id' => 1, 'score' => 7.0, 'semester' => 1],
            ['student_id' => 4, 'subject_id' => 2, 'score' => 8.0, 'semester' => 1],
            ['student_id' => 4, 'subject_id' => 3, 'score' => 6.5, 'semester' => 1],
            ['student_id' => 4, 'subject_id' => 5, 'score' => 7.5, 'semester' => 1],
            
            // Sinh viên 3 (id=5)
            ['student_id' => 5, 'subject_id' => 1, 'score' => 9.0, 'semester' => 1],
            ['student_id' => 5, 'subject_id' => 2, 'score' => 8.5, 'semester' => 1],
            ['student_id' => 5, 'subject_id' => 4, 'score' => 9.5, 'semester' => 1],
            ['student_id' => 5, 'subject_id' => 5, 'score' => 8.0, 'semester' => 1],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
