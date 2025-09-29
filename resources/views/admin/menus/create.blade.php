@extends('admin.layouts.app')

@section('title', '添加菜单')

@section('content')
<div class="layui-card">
    <div class="layui-card-header">添加菜单</div>
    <div class="layui-card-body">
        <form class="layui-form" action="{{ route('admin.menus.store') }}" method="POST">
            @csrf
            <div class="layui-form-item">
                <label class="layui-form-label">上级菜单</label>
                <div class="layui-input-block">
                    <select name="parent_id">
                        <option value="">顶级菜单</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">
                                @if($menu->ancestors->count() > 0)
                                    {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $menu->ancestors->count()) !!}├─
                                @endif
                                {{ $menu->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">菜单名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" required lay-verify="required" placeholder="请输入菜单名称" autocomplete="off" class="layui-input" value="{{ old('name') }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">图标</label>
                <div class="layui-input-block">
                    <input type="text" name="icon" placeholder="请输入图标代码" autocomplete="off" class="layui-input" value="{{ old('icon') }}">
                    <div class="layui-form-mid layui-word-aux">
                        <a href="https://www.layui.com/doc/element/icon.html" target="_blank">查看图标列表</a>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">路由</label>
                <div class="layui-input-block">
                    <input type="text" name="uri" placeholder="请输入路由" autocomplete="off" class="layui-input" value="{{ old('uri') }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">权限标识</label>
                <div class="layui-input-block">
                    <input type="text" name="permission" placeholder="请输入权限标识" autocomplete="off" class="layui-input" value="{{ old('permission') }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                    <input type="number" name="sort" required lay-verify="required|number" placeholder="请输入排序" autocomplete="off" class="layui-input" value="{{ old('sort', 0) }}">
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
                <label class="layui-form-label">显示</label>
                <div class="layui-input-block">
                    <input type="radio" name="is_show" value="1" title="显示" checked>
                    <input type="radio" name="is_show" value="0" title="隐藏">
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