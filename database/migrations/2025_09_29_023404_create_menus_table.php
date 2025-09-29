<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('菜单名称');
            $table->string('icon')->nullable()->comment('图标');
            $table->string('uri')->nullable()->comment('路由');
            $table->string('permission')->nullable()->comment('权限标识');
            $table->integer('sort')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 0:禁用 1:启用');
            $table->tinyInteger('is_show')->default(1)->comment('是否显示 0:隐藏 1:显示');
            $table->nestedSet();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
