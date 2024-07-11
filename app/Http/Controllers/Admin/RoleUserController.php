<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use App\Mail\RoleUserCreateMail;
use Illuminate\Support\Facades\Mail;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.role_user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.role_user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = new Admin();
            $user->image = '';
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->status = 1;
            $user->save();

            /** assign the role to user */
            $user->assignRole($request->role);

            /** send mail to the user */
            Mail::to($request->email)->send(new RoleUserCreateMail($request->email, $request->password));

            toast(__('Thêm người dùng thành công'), 'success');

            return redirect()->route('admin.role_user.index');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::find($id);
        $roles = Role::all();
        return view('admin.role_user.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if ($request->has('password') && !empty($request->password)) {
            $request->validate([
                'password' => ['confirmed', 'min:6']
            ]);
        }

        $user = Admin::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->has('password') && !empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();


        /** assign the role to user */
        $user->syncRoles($request->role);

        toast(__('Chỉnh sửa người dùng thành công'), 'success');

        return redirect()->route('admin.role_user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Admin::findOrFail($id);
        if ($user->getRoleNames()->first() === 'Admin') {
            return response(['status' => 'error', 'message' => __('Không thể xóa quản trị viên')]);
        }
        $user->delete();

        toast(__('Xóa người dùng thành công'), 'success');
        return response(['status' => 'success', 'message' => __('Xóa người dùng thành công')]);
    }
}