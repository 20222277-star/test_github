<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Chỉ Admin được truy cập
            if (Auth::user()->role_id != 1) {
                return redirect('/dashboard')->with('error', 'Chỉ Admin có quyền này');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::with('role')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('id', '!=', 1)->get(); // Không cho tạo admin thêm
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|in:2,3', // Teacher or Student
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Tạo tài khoản thành công!');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->route('profile.edit')->with('error', 'Vui lòng sử dụng trang hồ sơ để sửa thông tin của bạn');
        }

        $roles = Role::where('id', '!=', 1)->get();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->back()->with('error', 'Không thể sửa tài khoản của chính mình từ đây');
        }

        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|in:2,3',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Cập nhật tài khoản thành công!');
    }

    public function resetPassword(User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->back()->with('error', 'Không thể reset mật khẩu của chính mình từ đây');
        }

        // Đặt lại mật khẩu thành "password"
        $user->update(['password' => Hash::make('password')]);

        return redirect()->route('users.index')->with('success', "Đã reset mật khẩu của {$user->name}!");
    }

    public function destroy(User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->back()->with('error', 'Không thể xóa chính mình');
        }

        if ($user->role_id == 1) {
            return redirect()->back()->with('error', 'Không thể xóa Admin');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Xóa tài khoản thành công!');
    }

    public function bulkDeactivate(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
        ]);

        User::whereIn('id', $request->user_ids)
            ->where('id', '!=', Auth::id())
            ->where('role_id', '!=', 1)
            ->delete();

        return redirect()->back()->with('success', 'Xóa tài khoản thành công!');
    }
}
