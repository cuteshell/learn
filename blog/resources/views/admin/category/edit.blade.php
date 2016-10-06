@extends('layouts/admin')

@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">分类管理</a> &raquo; 修改分类
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>快捷操作</h3>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
            <a href="{{url('admin/category')}}"><i class="fa fa-refresh"></i>全部分类</a>
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
    <form action="{{url('admin/category/'.$fields->id)}}" method="post">
        {{method_field('put')}}
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>顶级分类：</th>
                    <td>
                        <select name="pid"">
                            <option value="0">==顶级分类==</option>
                            @foreach($categories as $category)
                                @if($category->id == $fields->pid)
                                <option selected="selected" value="{{$category->id}}">{{$category->name}}</option>
                                @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分类名称：</th>
                    <td>
                        <input type="text" class="lg" name="name" value="{{$fields->name}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>必须填写分类名称</span>
                    </td>
                </tr>
                <tr>
                    <th>分类标题：</th>
                    <td>
                        <input type="text" class="lg" name="title" value="{{$fields->title}}">
                    </td>
                </tr>

                <tr>
                    <th>关键词：</th>
                    <td>
                        <textarea name="keywords">{{$fields->keywords}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea class="lg" name="description">{{$fields->description}}</textarea>
                        <p>标题可以写30个字</p>
                    </td>
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" class="sm" name="order" value="{{$fields->order}}">
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