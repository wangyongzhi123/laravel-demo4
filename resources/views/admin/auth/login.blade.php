<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录 - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/layui/css/layui.css">
    <style>
        body {
            background-color: #f2f2f2;
        }
        .login-wrap {
            margin: 150px auto;
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .login-wrap h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .layui-form-item {
            margin-bottom: 20px;
        }
        .login-wrap .layui-input {
            padding-left: 38px;
        }
        .login-wrap .layui-form-label {
            position: absolute;
            left: 1px;
            top: 1px;
            width: 38px;
            line-height: 36px;
            text-align: center;
            color: #d2d2d2;
        }
        .login-wrap .layui-form-label i {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="login-wrap">
        <h2>管理员登录</h2>
        <form class="layui-form" action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="layui-form-item">
                <label class="layui-form-label"><i class="layui-icon layui-icon-username"></i></label>
                <div class="layui-input-block">
                    <input type="text" name="username" required lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"><i class="layui-icon layui-icon-password"></i></label>
                <div class="layui-input-block">
                    <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block" style="margin-left: 0;">
                    <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="login">登 录</button>
                </div>
            </div>
        </form>
    </div>

    <script src="/layui/layui.js"></script>
    <script>
        layui.use(['form', 'layer'], function(){
            var form = layui.form;
            var layer = layui.layer;
            
            // 监听提交
            form.on('submit(login)', function(data){
                return true;
            });
            
            // 显示错误信息
            @if($errors->any())
                layer.msg('{{ $errors->first() }}', {icon: 2});
            @endif
        });
    </script>
</body>
</html>