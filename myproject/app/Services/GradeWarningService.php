<?php

namespace App\Services;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GradeWarningService
{
    /**
     * Lấy danh sách sinh viên có điểm thấp cho giáo viên
     * 
     * @param User $teacher - Giáo viên
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLowGradesForTeacher(User $teacher)
    {
        $warningThreshold = config('grades.warning_threshold');

        return Grade::whereHas('subject', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
            ->where('score', '<', $warningThreshold)
            ->with('student', 'subject')
            ->orderBy('score', 'asc')
            ->get();
    }

    /**
     * Lấy điểm thấp của sinh viên hiện tại
     * 
     * @param User $student - Sinh viên
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLowGradesForStudent(User $student)
    {
        $warningThreshold = config('grades.warning_threshold');

        return Grade::where('student_id', $student->id)
            ->where('score', '<', $warningThreshold)
            ->with('subject')
            ->orderBy('score', 'asc')
            ->get();
    }

    /**
     * Lấy danh sách sinh viên có điểm nguy hiểm (dưới 3.0)
     * 
     * @param User $teacher - Giáo viên
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCriticalGradesForTeacher(User $teacher)
    {
        $criticalThreshold = config('grades.critical_threshold');

        return Grade::whereHas('subject', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
            ->where('score', '<', $criticalThreshold)
            ->with('student', 'subject')
            ->orderBy('score', 'asc')
            ->get();
    }

    /**
     * Lấy thống kê điểm thấp cho sinh viên
     * 
     * @param User $student - Sinh viên
     * @return array
     */
    public function getGradeStatisticsForStudent(User $student)
    {
        $grades = Grade::where('student_id', $student->id)->with('subject')->get();

        $total = $grades->count();
        $lowGrades = $grades->where('score', '<', config('grades.warning_threshold'))->count();
        $criticalGrades = $grades->where('score', '<', config('grades.critical_threshold'))->count();
        $averageScore = $grades->avg('score');

        return [
            'total' => $total,
            'low_grades_count' => $lowGrades,
            'critical_grades_count' => $criticalGrades,
            'average_score' => round($averageScore, 2),
            'percentage_warning' => $total > 0 ? round(($lowGrades / $total) * 100, 2) : 0,
        ];
    }

    /**
     * Xác định mức cảnh báo dựa trên điểm
     * 
     * @param float $score - Điểm
     * @return array
     */
    public function getWarningLevel($score)
    {
        $thresholds = config('grades.thresholds');

        if ($score < $thresholds['critical']['score']) {
            return $thresholds['critical'];
        } elseif ($score < $thresholds['warning']['score']) {
            return $thresholds['warning'];
        } elseif ($score < $thresholds['good']['score']) {
            return $thresholds['good'];
        } else {
            return $thresholds['excellent'];
        }
    }

    /**
     * Lấy danh sách sinh viên với điểm trung bình thấp
     * 
     * @param User $teacher - Giáo viên
     * @param float $threshold - Ngưỡng điểm
     * @return \Illuminate\Support\Collection
     */
    public function getStudentsWithLowAverage(User $teacher, $threshold = 5.0)
    {
        $grades = Grade::whereHas('subject', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
            ->with('student', 'subject')
            ->get();
        
        if ($grades->isEmpty()) {
            return collect();
        }
        
        return $grades->groupBy('student_id')
            ->map(function ($gradeCollection) use ($threshold) {
                $firstGrade = $gradeCollection->first();
                
                // Safety check
                if (!$firstGrade || !$firstGrade->student) {
                    return null;
                }
                
                return [
                    'student' => $firstGrade->student,
                    'average' => round($gradeCollection->avg('score'), 2),
                    'count' => $gradeCollection->count(),
                ];
            })
            ->filter(function ($item) use ($threshold) {
                return $item !== null && $item['average'] < $threshold;
            })
            ->sortBy('average')
            ->values();
    }
}
