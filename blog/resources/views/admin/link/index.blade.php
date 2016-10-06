@extends('layouts.admin')

@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/link')}}">链接管理</a> &raquo; 链接列表
</div>
<!--面包屑导航 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/link/create')}}"><i class="fa fa-plus"></i>添加链接</a>
                <a href="{{url('admin/link')}}"><i class="fa fa-refresh"></i>全部链接</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">排序</th>
                    <th>链接名称</th>
                    <th>链接地址</th>
                    <th>链接描述</th>
                    <th>操作</th>
                </tr>

                @foreach($data as $v)
                <tr>
                    <td class="tc" width="5%">
                        <input type="text" onchange="changeOrder(this, {{$v->id}})" name="ord[]" value={{$v->order}}>
                    </td>
                    {{--<td class="tc">{{$v->id}}</td>--}}
                    <td>
                        <a href="{{$v->url}}" target="_blank">{{$v->name}}</a>
                    </td>
                    <td>
                        <a href="{{$v->url}}" target="_blank">{{$v->url}}</a>
                    </td>
                    <td>{{$v->description}}</td>
                    <td>
                        <a href="{{url('admin/link/'.$v->id.'/edit')}}">修改</a>
                        <a href="javascript::" onclick="delLink({{$v->id}})">删除</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
<script>
    function changeOrder(obj, id) {
        var order = $(obj).val();
        $.post("{{url('admin/link/changeorder')}}", {
            '_token':'{{csrf_token()}}',
            'id':id,
            'order':order}, function(data) {
            if(data.status == 0) {
                layer.alert(data.msg, {icon:6});
            } else {
                layer.alert(data.msg, {icon:5});
            }
        });
    }

    function delLink(id) {
        layer.confirm('您确定删除这个分类吗?', {
            btn: ['确定','取消']
        }, function () {
            $.post("{{url('admin/link')}}/"+id, {
                '_method':'delete',
                '_token':"{{csrf_token()}}" }, function(data) {
                if(data.status == 0) {
                    location.href = location.href;
                    layer.msg(data.msg,{icon:6});
                } else {
                    layer.msg(data.msg,{icon:5});
                }
            });
        }, function () {

        });
    }


</script>
@stop