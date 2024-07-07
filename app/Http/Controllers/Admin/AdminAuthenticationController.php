<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HandleLoginRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Http\Requests\Admin\SendRestLinkRequest;
use App\Mail\AdminSendResetLinkMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminAuthenticationController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function handleLogin(HandleLoginRequest $request)
    {
        $request->authenticate();
        toast('Đăng nhập thành công', 'success');
        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        toast('Đăng xuất thành công', 'success');
        return redirect()->route('admin.login');
    }

    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLink(SendRestLinkRequest $request)
    {
        $token = \Str::random(64);
        $admin = Admin::where('email', $request->email)->first();
        $admin->remember_token = $token;
        $admin->save();

        Mail::to($admin->email)->send(new AdminSendResetLinkMail($token));
        return redirect()->back()->with('success', 'Kiểm tra email để đặt lại mật khẩu');
    }

    public function resetPassword($token)
    {
        $admin = Admin::where('remember_token', $token)->first();
        $name = $admin->name;
        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Token không hợp lệ');
        }
        return view('admin.auth.reset-password', compact('token', 'name'));
    }

    public function handleResetPassword(ResetPasswordRequest $request, $token)
    {
        $admin = Admin::where('remember_token', $token)->first();
        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Token không hợp lệ');
        }
        $admin->password = bcrypt($request->password);
        $admin->remember_token = null;
        $admin->save();
        return redirect()->route('admin.login')->with('success', 'Đặt lại mật khẩu thành công');
    }
}