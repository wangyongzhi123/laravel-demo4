@extends('admin.layouts.app')

@section('title', '管理员列表')

@section('content')
<div class="layui-card">
    <div class="layui-card-header">
        管理员列表
        <button class="layui-btn layui-btn-sm layui-btn-normal" onclick="location.href='{{ route('admin.admins.create') }}'">
            <i class="layui-icon">&#xe654;</i> 添加管理员
        </button>
    </div>
    <div class="layui-card-body">
        <table class="layui-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>姓名</th>
                    <th>邮箱</th>
                    <th>电话</th>
                    <th>角色</th>
                    <th>状态</th>
                    <th>最后登录时间</th>
                    <th>最后登录IP</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adminUsers as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->username }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->phone }}</td>
                    <td>{{ $admin->roles->pluck('display_name')->implode(', ') }}</td>
                    <td>
                        @if($admin->status)
                            <span class="layui-badge layui-bg-green">启用</span>
                        @else
                            <span class="layui-badge">禁用</span>
                        @endif
                    </td>
                    <td>{{ $admin->last_login_at }}</td>
                    <td>{{ $admin->last_login_ip }}</td>
                    <td>
                        <a href="{{ route('admin.admins.edit', $admin) }}" class="layui-btn layui-btn-xs">编辑</a>
                        <button class="layui-btn layui-btn-xs layui-btn-danger" onclick="deleteAdmin({{ $admin->id }})">删除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $adminUsers->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
layui.use(['layer'], function(){
    var layer = layui.layer;
    
    window.deleteAdmin = function(id) {
        layer.confirm('确定要删除这个管理员吗？', {
            btn: ['确定','取消']
        }, function(){
            fetch('{{ url("admin/admins") }}/' + id, {
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