<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('权限标识');
            $table->string('display_name')->comment('显示名称');
            $table->string('description')->nullable()->comment('权限描述');
            $table->string('module')->comment('所属模块');
            $table->tinyInteger('status')->default(1)->comment('状态 0:禁用 1:启用');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
