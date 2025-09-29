<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions'],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'module' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        Permission::create($validated);

        return redirect()->route('admin.permissions.index')->with('success', '权限创建成功');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'module' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        $permission->update($validated);

        return redirect()->route('admin.permissions.index')->with('success', '权限更新成功');
    }

    public function destroy(Permission $permission)
    {
        if ($permission->roles()->exists()) {
            return response()->json(['message' => '该权限已被角色使用，不能删除'], 422);
        }

        $permission->delete();
        return response()->json(['message' => '权限删除成功']);
    }
}
