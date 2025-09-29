<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        $adminUsers = AdminUser::with('roles')->paginate(10);
        return view('admin.admin-users.index', compact('adminUsers'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.admin-users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:admin_users'],
            'password' => ['required', 'string', 'min:6'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:admin_users'],
            'phone' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:roles,id'],
        ]);

        $adminUser = AdminUser::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'status' => $validated['status'],
        ]);

        $adminUser->roles()->sync($validated['roles']);

        return redirect()->route('admin.admins.index')->with('success', '管理员创建成功');
    }

    public function edit(AdminUser $admin)
    {
        $roles = Role::all();
        $admin->load('roles');
        return view('admin.admin-users.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, AdminUser $admin)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('admin_users')->ignore($admin->id)],
            'password' => ['nullable', 'string', 'min:6'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('admin_users')->ignore($admin->id)],
            'phone' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:roles,id'],
        ]);

        $admin->update([
            'username' => $validated['username'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'status' => $validated['status'],
        ]);

        if (!empty($validated['password'])) {
            $admin->update(['password' => Hash::make($validated['password'])]);
        }

        $admin->roles()->sync($validated['roles']);

        return redirect()->route('admin.admins.index')->with('success', '管理员更新成功');
    }

    public function destroy(AdminUser $admin)
    {
        if ($admin->id === auth()->id()) {
            return response()->json(['message' => '不能删除当前登录的管理员'], 403);
        }

        $admin->delete();
        return response()->json(['message' => '管理员删除成功']);
    }
}
