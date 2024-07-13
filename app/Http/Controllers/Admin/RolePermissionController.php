<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RolePermissionController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('permission:Access Management Index,admin', only: ['index']),
            new Middleware('permission:Access Management Create,admin', only: ['create', 'store']),
            new Middleware('permission:Access Management Update,admin', only: ['edit', 'update']),
            new Middleware('permission:Access Management Delete,admin', only: ['destroy']),
        ];
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.role_permission.index', compact('roles'));
    }

    public function create()
    {
        $premissions = Permission::all()->groupBy('group_name');
        return view('admin.role_permission.create', compact('premissions'));
    }

    function store(Request $request)
    {
        $request->validate([
            'role' => ['required', 'max:50', 'unique:permissions,name']
        ]);

        /** create the role */
        $role = Role::create(['guard_name' => 'admin', 'name' => $request->role]);

        /** assgin permissions to the role */
        $role->syncPermissions($request->permissions);

        toast('Thêm mới thành công!', 'success')->autoClose(2000);

        return redirect()->route('admin.role.index');

    }

    function edit(string $id)
    {
        $premissions = Permission::all()->groupBy('group_name');
        $role = Role::findOrFail($id);
        $rolesPermissions = $role->permissions;
        $rolesPermissions = $rolesPermissions->pluck('name')->toArray();
        return view('admin.role_permission.edit', compact('premissions', 'role', 'rolesPermissions'));
    }

    function update(Request $request, string $id)
    {
        $request->validate([
            'role' => ['required', 'max:50', 'unique:permissions,name']
        ]);

        /** create the role */
        $role = Role::findOrFail($id);
        $role->update(['guard_name' => 'admin', 'name' => $request->role]);

        /** assgin permissions to the role */
        $role->syncPermissions($request->permissions);

        toast(__('Cập nhật thành công!'), 'success')->autoClose(2000);

        return redirect()->route('admin.role.index');
    }


    function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        if ($role->name === 'Admin') {
            return response(['status' => 'error', 'message' => __('Không thể xoá quyền quản trị viên')]);
        }

        $role->delete();

        return response(['status' => 'success', 'message' => __('Xoá thành công')]);
    }
}
