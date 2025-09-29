@extends('admin.layouts.app')

@section('title', '菜单管理')

@section('content')
<div class="layui-card">
    <div class="layui-card-header">
        菜单管理
        <button class="layui-btn layui-btn-sm layui-btn-normal" onclick="location.href='{{ route('admin.menus.create') }}'">
            <i class="layui-icon">&#xe654;</i> 添加菜单
        </button>
    </div>
    <div class="layui-card-body">
        <table class="layui-table" lay-size="lg">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>菜单名称</th>
                    <th>图标</th>
                    <th>路由</th>
                    <th>权限标识</th>
                    <th>排序</th>
                    <th>状态</th>
                    <th>显示</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->id }}</td>
                    <td>
                        @if($menu->ancestors->count() > 0)
                            {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $menu->ancestors->count()) !!}├─
                        @endif
                        {{ $menu->name }}
                    </td>
                    <td><i class="layui-icon">{{ $menu->icon }}</i></td>
                    <td>{{ $menu->uri }}</td>
                    <td>{{ $menu->permission }}</td>
                    <td>{{ $menu->sort }}</td>
                    <td>
                        @if($menu->status)
                            <span class="layui-badge layui-bg-green">启用</span>
                        @else
                            <span class="layui-badge">禁用</span>
                        @endif
                    </td>
                    <td>
                        @if($menu->is_show)
                            <span class="layui-badge layui-bg-green">显示</span>
                        @else
                            <span class="layui-badge">隐藏</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="layui-btn layui-btn-xs">编辑</a>
                        <button class="layui-btn layui-btn-xs layui-btn-danger" onclick="deleteMenu({{ $menu->id }})">删除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
layui.use(['layer'], function(){
    var layer = layui.layer;
    
    window.deleteMenu = function(id) {
        layer.confirm('确定要删除这个菜单吗？', {
            btn: ['确定','取消']
        }, function(){
            fetch('{{ url("admin/menus") }}/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.message) {
                    layer.msg(data.message);
                    if(response.ok) {
                        setTimeout(() => location.reload(), 1000);
                    }
                }
            })
            .catch(error => {
                layer.msg('删除失败');
                console.error('Error:', error);
            });
        });
    }
});

@if(session('success'))
    layui.use(['layer'], function(){
        layui.layer.msg('{{ session("success") }}', {icon: 1});
    });
@endif
</script>
@endpush