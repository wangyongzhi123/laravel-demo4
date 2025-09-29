@extends('admin.layouts.app')

@section('title', '编辑管理员')

@section('content')
<div class="layui-card">
    <div class="layui-card-header">编辑管理员</div>
    <div class="layui-card-body">
        <form class="layui-form" action="{{ route('admin.admins.update', $admin) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block">
                    <input type="text" name="username" required lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input" value="{{ old('username', $admin->username) }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="password" name="password" placeholder="不修改请留空" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-block">
                    <input type="text" name="name" required lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input" value="{{ old('name', $admin->name) }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block">
                    <input type="email" name="email" placeholder="请输入邮箱" autocomplete="off" class="layui-input" value="{{ old('email', $admin->email) }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">电话</label>
                <div class="layui-input-block">
                    <input type="text" name="phone" placeholder="请输入电话" autocomplete="off" class="layui-input" value="{{ old('phone', $admin->phone) }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="1" title="启用" {{ $admin->status ? 'checked' : '' }}>
                    <input type="radio" name="status" value="0" title="禁用" {{ !$admin->status ? 'checked' : '' }}>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">角色</label>
                <div class="layui-input-block">
                    @foreach($roles as $role)
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" title="{{ $role->display_name }}" lay-skin="primary" {{ $admin->roles->contains($role->id) ? 'checked' : '' }}>
                    @endforeach
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
    
    // 表单验证
    form.verify({
        username: function(value){
            if(value.length < 3){
                return '用户名至少得3个字符';
            }
        }
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