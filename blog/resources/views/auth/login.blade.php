@extends('layouts.admin')

@section('style')
<style>
	.footer_bottom {
		text-align: center;
		width: 100%;
		position: absolute;
		bottom:12px;
	}
</style>
@stop
@section('content')
<div class="login_box">
	<h1>Blog</h1>
	<h2>欢迎使用博客管理平台</h2>
	<div class="form">
		<form action="" method="post">
			{{csrf_field()}}
			<ul>
				<li>
					<input type="text" name="email" class="text" value="{{old('email')}}"/>
					<span><i class="fa fa-user"></i></span>
				</li>
				<li>
					<input type="password" name="password" class="text"/>
					<span><i class="fa fa-lock"></i></span>
				</li>
				<li>
					<input type="text" class="code" name="code"/>
					<span><i class="fa fa-check-square-o"></i></span>
					<img src="{{url('admin/code')}}" alt="" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
				</li>
				<li>
					<input type="submit" value="立即登陆"/>
				</li>
			</ul>
		</form>
		@foreach($errors->all() as $error)
			<p style="color: red;background-color: antiquewhite">{{$error}}</p>
		@endforeach
	</div>
</div>
<div class="footer_bottom">
	<p><a href="#">返回首页</a> &copy; 2016 Powered by <a href="http://blog.cuteshell.com" target="_blank">http://blog.cuteshell.com</a></p>
</div>
@stop