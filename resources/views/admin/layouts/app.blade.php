<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title', '管理后台') - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/layui/css/layui.css">
    @stack('styles')
</head>
<body>
    <!-- 布局容器 -->
    <div class="layui-layout layui-layout-admin">
        <!-- 头部区域 -->
        <div class="layui-header">
            <div class="layui-logo layui-hide-xs">{{ config('app.name') }}</div>
            
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item layui-hide layui-show-sm-inline-block">
                    <a href="javascript:;">
                        <img src="{{ Auth::guard('admin')->user()->avatar ?? 'https://gw.alipayobjects.com/zos/rmsportal/BiazfanxmamNRoxxVxka.png' }}" class="layui-nav-img">
                        {{ Auth::guard('admin')->user()->name ?? '' }}
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">个人信息</a></dd>
                        <dd><a href="javascript:;">修改密码</a></dd>
                        <dd><a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">退出登录</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
        
        <!-- 侧边栏 -->
        <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item">
                        <a href="{{ route('admin.dashboard') }}">控制台</a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">系统管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="{{ route('admin.menus.index') }}">菜单管理</a></dd>
                            <dd><a href="{{ route('admin.roles.index') }}">角色管理</a></dd>
                            <dd><a href="{{ route('admin.permissions.index') }}">权限管理</a></dd>
                            <dd><a href="{{ route('admin.admins.index') }}">管理员管理</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">用户管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="{{ route('admin.users.index') }}">用户列表</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- 主体内容 -->
        <div class="layui-body">
            <div style="padding: 15px;">
                @yield('content')
            </div>
        </div>
        
        <!-- 底部固定区域 -->
        <div class="layui-footer">
            © {{ date('Y') }} {{ config('app.name') }}
        </div>
    </div>

    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    
    <script src="/layui/layui.js"></script>
    <script>
        layui.use(['element', 'layer', 'jquery'], function(){
            var element = layui.element;
            var layer = layui.layer;
            var $ = layui.jquery;
            
            // 侧边栏菜单高亮
            var path = window.location.pathname;
            $('.layui-nav-tree a').each(function(){
                if($(this).attr('href') == path){
                    $(this).parent().addClass('layui-this');
                    $(this).parents('.layui-nav-item').addClass('layui-nav-itemed');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>