@extends('admin.layouts.app')

@section('title', '角色管理')

@section('content')
<div class="layui-card">
    <div class="layui-card-header">
        角色管理
        <button class="layui-btn layui-btn-sm layui-btn-normal" onclick="location.href='{{ route('admin.roles.create') }}'">
            <i class="layui-icon">&#xe654;</i> 添加角色
        </button>
    </div>
    <div class="layui-card-body">
        <table class="layui-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>角色标识</th>
                    <th>显示名称</th>
                    <th>描述</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ $role->description }}</td>
                    <td>
                        @if($role->status)
                            <span class="layui-badge layui-bg-green">启用</span>
                        @else
                            <span class="layui-badge">禁用</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="layui-btn layui-btn-xs">编辑</a>
                        <button class="layui-btn layui-btn-xs layui-btn-danger" onclick="deleteRole({{ $role->id }})">删除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $roles->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
layui.use(['layer'], function(){
    var layer = layui.layer;
    
    window.deleteRole = function(id) {
        layer.confirm('确定要删除这个角色吗？', {
            btn: ['确定','取消']
        }, function(){
            fetch('{{ url("admin/roles") }}/' + id, {
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