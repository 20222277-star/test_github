<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role_id == 2) {
            // Teacher - xem điểm của học sinh trong các môn họ dạy
            $grades = Grade::whereHas('subject', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->with('student', 'subject')->paginate(10);
        } else {
            // Student - xem điểm của mình
            $grades = Grade::where('student_id', $user->id)->with('subject')->paginate(10);
        }
        
        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        $user = Auth::user();
        
        if ($user->role_id != 2) {
            return redirect('/')->with('error', 'Chỉ giáo viên có thể nhập điểm');
        }
        
        $subjects = Subject::where('teacher_id', $user->id)->get();
        $students = User::where('role_id', 3)->get();
        
        return view('grades.create', compact('subjects', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'score' => 'required|numeric|min:0|max:10',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        $user = Auth::user();
        
        // Kiểm tra authorize - chỉ có thể nhập điểm cho môn của mình
        $subject = Subject::find($request->subject_id);
        if ($subject->teacher_id != $user->id && $user->role_id != 1) {
            return redirect()->back()->with('error', 'Bạn không có quyền nhập điểm cho môn này');
        }

        Grade::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'subject_id' => $request->subject_id,
                'semester' => $request->semester,
            ],
            [
                'score' => $request->score,
            ]
        );

        return redirect('/grades')->with('success', 'Cập nhật điểm thành công!');
    }

    public function edit(Grade $grade)
    {
        $user = Auth::user();
        
        if ($grade->subject->teacher_id != $user->id && $user->role_id != 1) {
            return redirect()->back()->with('error', 'Bạn không có quyền chỉnh sửa điểm này');
        }
        
        $subjects = Subject::where('teacher_id', $user->id)->get();
        $students = User::where('role_id', 3)->get();
        
        return view('grades.edit', compact('grade', 'subjects', 'students'));
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'score' => 'required|numeric|min:0|max:10',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        $user = Auth::user();
        
        if ($grade->subject->teacher_id != $user->id && $user->role_id != 1) {
            return redirect()->back()->with('error', 'Bạn không có quyền chỉnh sửa điểm này');
        }

        $grade->update($request->only('score', 'semester'));

        return redirect('/grades')->with('success', 'Cập nhật điểm thành công!');
    }

    public function destroy(Grade $grade)
    {
        $user = Auth::user();
        
        if ($grade->subject->teacher_id != $user->id && $user->role_id != 1) {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa điểm này');
        }

        $grade->delete();

        return redirect('/grades')->with('success', 'Xóa điểm thành công!');
    }

    public function transcript()
    {
        $user = Auth::user();
        
        if ($user->role_id != 3) {
            return redirect('/')->with('error', 'Chỉ sinh viên có thể xem bảng đạo hạo');
        }
        
        $grades = Grade::where('student_id', $user->id)->with('subject')->get();
        $gpa = $this->calculateGPA($grades);
        
        return view('grades.transcript', compact('grades', 'gpa', 'user'));
    }

    private function calculateGPA($grades)
    {
        if ($grades->isEmpty()) {
            return 0;
        }

        $totalScore = 0;
        $totalCredits = 0;

        foreach ($grades as $grade) {
            $totalScore += $grade->score * $grade->subject->credits;
            $totalCredits += $grade->subject->credits;
        }

        return $totalCredits > 0 ? round($totalScore / $totalCredits, 2) : 0;
    }
}
