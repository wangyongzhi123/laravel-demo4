<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::create([
            'username' => 'admin',
            'password' => Hash::make('admin888'),
            'name' => '超级管理员',
            'email' => 'admin@example.com',
            'status' => 1,
        ]);
    }
}
