@extends('layouts.admin')

@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">分类管理</a> &raquo; 分类列表
</div>
<!--面包屑导航 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-refresh"></i>全部分类</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">排序</th>
                    <th class="tc">ID</th>
                    <th>分类名称</th>
                    <th>标题</th>
                    <th>查看次数</th>
                    <th>操作</th>
                </tr>

                @foreach($data as $v)
                <tr>
                    <td class="tc" width="5%">
                        <input type="text" onchange="changeOrder(this, {{$v->id}})" name="ord[]" value={{$v->order}}>
                    </td>
                    {{--<td class="tc">{{$v->id}}</td>--}}
                    <td>
                        <a href="#">{{$v->name}}</a>
                    </td>
                    <td>{{$v->title}}</td>
                    <td>{{$v->view}}</td>
                    <td>
                        <a href="{{url('admin/category/'.$v->id.'/edit')}}">修改</a>
                        <a href="javascript::" onclick="delCate({{$v->id}})">删除</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
<script>
    function changeOrder(obj, cate_id) {
        var cate_order = $(obj).val();
        $.post("{{url('admin/cate/changeorder')}}", {
            '_token':'{{csrf_token()}}',
            'cate_id':cate_id,
            'cate_order':cate_order}, function(data) {
            if(data.status == 0) {
                layer.alert(data.msg, {icon:6});
            } else {
                layer.alert(data.msg, {icon:5});
            }
        });
    }

    function delCate(cate_id) {
        layer.confirm('您确定删除这个分类吗?', {
            btn: ['确定','取消']
        }, function () {
            $.post("{{url('admin/category')}}/"+cate_id, {
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