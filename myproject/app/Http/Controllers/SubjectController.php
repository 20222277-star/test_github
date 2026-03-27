<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('teacher')->paginate(10);
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        // Chỉ admin không được tạo
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect('/')->with('error', 'Chỉ admin có thể tạo môn học');
        }
        
        $teachers = User::where('role_id', 2)->get();
        return view('subjects.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'credits' => 'required|integer|min:1|max:6',
            'description' => 'nullable|min:5',
            'teacher_id' => 'required|exists:users,id',
        ]);

        Subject::create($request->all());

        return redirect('/subjects')->with('success', 'Tạo môn học thành công!');
    }

    public function edit(Subject $subject)
    {
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect('/')->with('error', 'Chỉ admin có thể chỉnh sửa');
        }
        
        $teachers = User::where('role_id', 2)->get();
        return view('subjects.edit', compact('subject', 'teachers'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|min:3',
            'credits' => 'required|integer|min:1|max:6',
            'description' => 'nullable|min:5',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $subject->update($request->all());

        return redirect('/subjects')->with('success', 'Cập nhật môn học thành công!');
    }

    public function destroy(Subject $subject)
    {
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect('/')->with('error', 'Chỉ admin có thể xóa');
        }
        
        $subject->delete();

        return redirect('/subjects')->with('success', 'Xóa môn học thành công!');
    }
}
