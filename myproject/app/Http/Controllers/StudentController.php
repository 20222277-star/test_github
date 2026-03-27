<?php

namespace App\Http\Controllers;
use App\Models\Student;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    // 📋 Danh sách sinh viên (với search và pagination)
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        if ($search) {
            $students = Student::where('name', 'like', '%' . $search . '%')
                               ->orWhere('major', 'like', '%' . $search . '%')
                               ->paginate(5);
        } else {
            $students = Student::paginate(5);
        }
        
        return view('student_list', ['students' => $students, 'search' => $search]);
    }

    // 👁️ Chi tiết sinh viên
    public function show($id)
    {
        $student = Student::find($id);
        return view('student_detail', ['student' => $student]);
    }

    // ➕ Form tạo mới
    public function create()
    {
        return view('student_create');
    }

    // 💾 Lưu sinh viên mới
    public function store(Request $request)
    {
        // PHẦN 4: KIỂM TRA DỮ LIỆU (VALIDATION)
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'major' => 'required|min:3|max:255'
        ], [
            'name.required' => 'Tên sinh viên không được để trống!',
            'name.min' => 'Tên sinh viên phải có ít nhất 3 ký tự!',
            'major.required' => 'Ngành học không được để trống!',
            'major.min' => 'Ngành học phải có ít nhất 3 ký tự!',
        ]);

        Student::create($validated);

        return redirect('/students')->with('success', 'Sinh viên được tạo thành công!');
    }

    // ✏️ Form chỉnh sửa
    public function edit($id)
    {
        $student = Student::find($id);
        return view('student_edit', ['student' => $student]);
    }

    // 🔄 Cập nhật sinh viên
    public function update(Request $request, $id)
    {
        // PHẦN 4: KIỂM TRA DỮ LIỆU (VALIDATION)
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'major' => 'required|min:3|max:255'
        ], [
            'name.required' => 'Tên sinh viên không được để trống!',
            'name.min' => 'Tên sinh viên phải có ít nhất 3 ký tự!',
            'major.required' => 'Ngành học không được để trống!',
            'major.min' => 'Ngành học phải có ít nhất 3 ký tự!',
        ]);

        $student = Student::find($id);
        $student->update($validated);

        return redirect('/students')->with('success', 'Sinh viên được cập nhật thành công!');
    }
    
    // ❌ Xóa sinh viên
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        return redirect('/students')->with('success', 'Sinh viên được xóa thành công!');
    }
}