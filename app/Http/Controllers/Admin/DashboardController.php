<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'userCount' => User::count(),
            'adminCount' => AdminUser::count(),
            'roleCount' => Role::count(),
            'permissionCount' => Permission::count(),
        ];

        return view('admin.dashboard.index', $data);
    }
}
