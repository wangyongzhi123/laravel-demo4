@extends('admin.layouts.app')

@section('title', '用户列表')

@section('content')
<div class="layui-card">
    <div class="layui-card-header">
        用户列表
        <button class="layui-btn layui-btn-sm layui-btn-normal" onclick="location.href='{{ route('admin.users.create') }}'">
            <i class="layui-icon">&#xe654;</i> 添加用户
        </button>
    </div>
    <div class="layui-card-body">
        <table class="layui-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>邮箱</th>
                    <th>注册时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="layui-btn layui-btn-xs">编辑</a>
                        <button class="layui-btn layui-btn-xs layui-btn-danger" onclick="deleteUser({{ $user->id }})">删除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
layui.use(['layer'], function(){
    var layer = layui.layer;
    
    window.deleteUser = function(id) {
        layer.confirm('确定要删除这个用户吗？', {
            btn: ['确定','取消']
        }, function(){
            fetch('{{ url("admin/users") }}/' + id, {
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