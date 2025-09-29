@extends('admin.layouts.app')

@section('title', '添加权限')

@section('content')
<div class="layui-card">
    <div class="layui-card-header">添加权限</div>
    <div class="layui-card-body">
        <form class="layui-form" action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf
            <div class="layui-form-item">
                <label class="layui-form-label">权限标识</label>
                <div class="layui-input-block">
                    <input type="text" name="name" required lay-verify="required" placeholder="请输入权限标识" autocomplete="off" class="layui-input" value="{{ old('name') }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">显示名称</label>
                <div class="layui-input-block">
                    <input type="text" name="display_name" required lay-verify="required" placeholder="请输入显示名称" autocomplete="off" class="layui-input" value="{{ old('display_name') }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">所属模块</label>
                <div class="layui-input-block">
                    <input type="text" name="module" required lay-verify="required" placeholder="请输入所属模块" autocomplete="off" class="layui-input" value="{{ old('module') }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <input type="text" name="description" placeholder="请输入描述" autocomplete="off" class="layui-input" value="{{ old('description') }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="1" title="启用" checked>
                    <input type="radio" name="status" value="0" title="禁用">
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