@extends('layouts/admin')

@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/nav')}}">导航管理</a> &raquo; 添加导航
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>快捷操作</h3>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/nav/create')}}"><i class="fa fa-plus"></i>添加导航</a>
            <a href="{{url('admin/nav')}}"><i class="fa fa-refresh"></i>全部导航</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <div class="result_title">
        @foreach($errors->all() as $error)
            <div class="mark">
                <p>{{$error}}</p>
            </div>
        @endforeach
    </div>
    <form action="{{url('admin/nav')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
                <tr>
                    <th><i class="require">*</i>导航名称：</th>
                    <td>
                        <input type="text" class="lg" name="name" value="{{old('name')}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>必须填写导航名称</span>
                    </td>
                </tr>
                <tr>
                    <th>导航别名：</th>
                    <td>
                        <input type="text" class="lg" name="alias" value="{{old('alias')}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>导航地址：</th>
                    <td>
                        <input type="text" class="lg" name="url" value="{{old('url')}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>地址必须以http://开头</span>
                    </td>
                </tr>

                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" class="sm" name="order" value="{{old('order')}}">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
@stop