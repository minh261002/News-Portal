<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    use FileUploadTrait;
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . Auth::guard('admin')->id(),
            'image' => 'nullable|image',
        ]);
        $admin = Auth::guard('admin')->user();

        $imgUrl = $this->handleFileUpload($request, 'image');
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->image = $imgUrl ?? $admin->image;
        $admin->save();

        toast()->success('Cập nhật thông tin thành công');
        return redirect()->back();
    }

    public function changePassword(UpdatePasswordRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->password = bcrypt($request->password);
        $admin->save();

        toast()->success('Đổi mật khẩu thành công');
        return redirect()->back();
    }
}
