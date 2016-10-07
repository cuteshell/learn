@extends('layouts.admin')

@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/config')}}">配置管理</a> &raquo; 配置列表
</div>
<!--面包屑导航 结束-->

<!--搜索结果页面 列表 开始-->
<form action="{{url('admin/config/changecontent')}}" method="post">
    {{csrf_field()}}
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置</a>
                <a href="{{url('admin/config')}}"><i class="fa fa-refresh"></i>全部配置</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_title">
            @foreach($errors->all() as $error)
                <div class="mark">
                    <p>{{$error}}</p>
                </div>
            @endforeach
        </div>
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">排序</th>
                    <th>标题</th>
                    <th>名称</th>
                    <th>内容</th>
                    <th>操作</th>
                </tr>

                @foreach($data as $v)
                <tr>
                    <td class="tc" width="5%">
                        <input type="text" onchange="changeOrder(this, {{$v->id}})" name="ord[]" value={{$v->order}}>
                    </td>
                    <td>{{$v->title}}</td>
                    <td>{{$v->name}}</td>
                    <td>
                        <input type="hidden" name="id[]" value="{{$v->id}}">
                    @if($v->type == 'input')
                        <input type="text" class="lg" name="content[]" value="{{$v->content}}">
                    @elseif($v->type == 'textarea')
                        <textarea name="content[]">{{$v->content}}</textarea>
                    @elseif($v->type == 'radio')
                        <input type="radio" name="content[]" @if($v->content == '1') checked @endif value="1">打开
                        <input type="radio" name="content[]" @if($v->content == '0') checked @endif value="0">关闭
                    @endif
                    </td>
                    <td>
                        <a href="{{url('admin/config/'.$v->id.'/edit')}}">修改</a>
                        <a href="javascript::" onclick="delConfig({{$v->id}})">删除</a>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="btn_group">
                <input type="submit" value="提交">
                <input type="button" class="back" onclick="history.go(-1)" value="返回" >
            </div>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
<script>
    function changeOrder(obj, id) {
        var order = $(obj).val();
        $.post("{{url('admin/config/changeorder')}}", {
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

    function delConfig(id) {
        layer.confirm('您确定删除吗?', {
            btn: ['确定','取消']
        }, function () {
            $.post("{{url('admin/config')}}/"+id, {
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