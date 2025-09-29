<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('sort')->get()->toTree();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $menus = Menu::orderBy('sort')->get()->toTree();
        return view('admin.menus.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => ['nullable', 'exists:menus,id'],
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'uri' => ['nullable', 'string', 'max:255'],
            'permission' => ['nullable', 'string', 'max:255'],
            'sort' => ['required', 'integer'],
            'status' => ['required', 'boolean'],
            'is_show' => ['required', 'boolean'],
        ]);

        Menu::create($validated);

        return redirect()->route('admin.menus.index')->with('success', '菜单创建成功');
    }

    public function edit(Menu $menu)
    {
        $menus = Menu::orderBy('sort')->get()->toTree();
        return view('admin.menus.edit', compact('menu', 'menus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'parent_id' => ['nullable', 'exists:menus,id'],
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'uri' => ['nullable', 'string', 'max:255'],
            'permission' => ['nullable', 'string', 'max:255'],
            'sort' => ['required', 'integer'],
            'status' => ['required', 'boolean'],
            'is_show' => ['required', 'boolean'],
        ]);

        $menu->update($validated);

        return redirect()->route('admin.menus.index')->with('success', '菜单更新成功');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->children()->exists()) {
            return response()->json(['message' => '该菜单下还有子菜单，不能删除'], 422);
        }

        $menu->delete();
        return response()->json(['message' => '菜单删除成功']);
    }
}
