<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission = null): Response
    {
        if (!Auth::guard('admin')->check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => '未登录或登录已过期'], 401);
            }
            return redirect()->route('admin.login');
        }

        $admin = Auth::guard('admin')->user();

        // 如果没有指定权限，则只需要登录即可访问
        if (is_null($permission)) {
            return $next($request);
        }

        // 检查用户是否有指定权限
        if (!$admin->hasPermission($permission)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => '没有访问权限'], 403);
            }
            abort(403, '没有访问权限');
        }

        return $next($request);
    }
}
