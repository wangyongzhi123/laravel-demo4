@extends('admin.layouts.app')

@section('title', '控制台')

@section('content')
<div class="layui-row layui-col-space15">
    <div class="layui-col-md3">
        <div class="layui-card">
            <div class="layui-card-header">用户统计</div>
            <div class="layui-card-body">
                <p class="layui-text-center" style="font-size: 30px;font-weight: 300;color: #666;">{{ $userCount ?? 0 }}</p>
            </div>
        </div>
    </div>
    <div class="layui-col-md3">
        <div class="layui-card">
            <div class="layui-card-header">管理员统计</div>
            <div class="layui-card-body">
                <p class="layui-text-center" style="font-size: 30px;font-weight: 300;color: #666;">{{ $adminCount ?? 0 }}</p>
            </div>
        </div>
    </div>
    <div class="layui-col-md3">
        <div class="layui-card">
            <div class="layui-card-header">角色统计</div>
            <div class="layui-card-body">
                <p class="layui-text-center" style="font-size: 30px;font-weight: 300;color: #666;">{{ $roleCount ?? 0 }}</p>
            </div>
        </div>
    </div>
    <div class="layui-col-md3">
        <div class="layui-card">
            <div class="layui-card-header">权限统计</div>
            <div class="layui-card-body">
                <p class="layui-text-center" style="font-size: 30px;font-weight: 300;color: #666;">{{ $permissionCount ?? 0 }}</p>
            </div>
        </div>
    </div>
</div>

<div class="layui-row layui-col-space15" style="margin-top: 15px;">
    <div class="layui-col-md12">
        <div class="layui-card">
            <div class="layui-card-header">系统信息</div>
            <div class="layui-card-body">
                <table class="layui-table" lay-skin="line">
                    <colgroup>
                        <col width="150">
                        <col>
                    </colgroup>
                    <tbody>
                        <tr>
                            <td>服务器操作系统</td>
                            <td>{{ PHP_OS }}</td>
                        </tr>
                        <tr>
                            <td>PHP版本</td>
                            <td>{{ PHP_VERSION }}</td>
                        </tr>
                        <tr>
                            <td>Laravel版本</td>
                            <td>{{ app()->version() }}</td>
                        </tr>
                        <tr>
                            <td>服务器时间</td>
                            <td>{{ date('Y-m-d H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
layui.use(['layer'], function(){
    var layer = layui.layer;
    
    // 欢迎信息
    layer.msg('欢迎使用后台管理系统', {
        offset: '15px',
        icon: 1,
        time: 3000
    });
});
</script>
@endpush