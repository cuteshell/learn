@extends('layouts/admin')

@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 添加文章
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
    <form action="{{url('admin/article')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
                <tr>
                    <th width="120">分类：</th>
                    <td>
                        <select name="cateid"">
                            <option value="0">==文章分类==</option>
                            @foreach($categories as $category)
                                @if($category->id == old('cate_pid'))
                                <option selected="selected" value="{{$category->id}}">{{$category->name}}</option>
                                @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>编辑：</th>
                    <td>
                        <input type="text" class="sm" name="editor" value="{{old('editor')}}">
                    </td>
                </tr>
                <tr>
                    <th>缩略图：</th>
                    <td>
                        <input type="text" size="50" name="thumb">
                        <script src="{{asset('vender/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css" href="{{asset('vender/uploadify/uploadify.css')}}">
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                        <script type="text/javascript">
                            $(function() {
                                $('#file_upload').uploadify({
                                    'buttonText' : "上传图片",
                                    'formData'     : {
                                        'timestamp' : '{{time()}}',
                                        '_token' : '{{csrf_token()}}',
                                    },
                                    'swf'      : "{{asset('vender/uploadify/uploadify.swf')}}",
                                    'uploader' : "{{asset('admin/upload')}}",
                                    'onUploadSuccess' : function(file, data, response) {
                                        var data = JSON.parse(data);
                                        $('input[name=thumb]').val(data.msg);
                                        if(response) {


                                            if(data.status == 0) {
                                                $('#thumb_img').attr('src',data.msg);
                                            } else {
                                                layer.alert(data.msg, {icon:5});
                                                $('#thumb_img').attr('src','');
                                            }
                                        } else {
                                            $('#thumb_img').attr('src','');
                                        }
                                        //alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
                                    }
                                });
                            });
                        </script>
                        <style>
                            .uploadify{display:inline-block;}
                            .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                            table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                        </style>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src="" alt="" id="thumb_img" style="max-width: 350px; max-height: 100px">
                    </td>
                </tr>
                <tr>
                    <th>文章标题：</th>
                    <td>
                        <input type="text" class="lg" name="title">
                        {{--<span><i class="fa fa-exclamation-circle yellow"></i>必须填写分类名称</span>--}}
                    </td>
                </tr>
                <tr>
                    <th>关键词：</th>
                    <td>
                        <input type="text" class="lg" name="tag" value="{{old('tag')}}">
                    </td>
                </tr>

                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea name="description">{{old('description')}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>内容：</th>
                    <td>
                        <script type="text/javascript" charset="utf-8" src="{{asset('vender/ueditor/ueditor.config.js')}}"></script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('vender/ueditor/ueditor.all.min.js')}}"> </script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('vender/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                        <script id="editor" type="text/plain" name="content" style="width:800px;height:500px;"></script>
                        <script type="text/javascript">
                            var ue = UE.getEditor('editor');
                        </script>
                        <style>
                            .edui-default{line-height: 28px;}
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            {overflow: hidden; height:20px;}
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>
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