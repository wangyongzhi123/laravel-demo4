@extends('admin.layouts.app')

@section('title', '编辑用户')

@section('content')
<div class="layui-card">
    <div class="layui-card-header">编辑用户</div>
    <div class="layui-card-body">
        <form class="layui-form" action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="layui-form-item">
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-block">
                    <input type="text" name="name" required lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input" value="{{ old('name', $user->name) }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block">
                    <input type="email" name="email" required lay-verify="required|email" placeholder="请输入邮箱" autocomplete="off" class="layui-input" value="{{ old('email', $user->email) }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="password" name="password" lay-verify="pass" placeholder="不修改请留空" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    <button type="button" class="layui-btn layui-btn-normal" onclick="history.back()">返回</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
layui.use(['form'], function(){
    var form = layui.form;
    
    // 自定义验证规则
    form.verify({
        pass: function(value){
            if(value !== '' && value.length < 8){
                return '密码必须8个字符以上';
            }
        },
        email: [
            /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
            '邮箱格式不正确'
        ]
    });
    
    // 表单提交
    form.on('submit(formDemo)', function(data){
        return true;
    });
});

@if($errors->any())
    layui.use(['layer'], function(){
        layui.layer.msg('{{ $errors->first() }}', {icon: 2});
    });
@endif
</script>
@endpush