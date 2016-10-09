<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @section('info')
    <title>{{Config::get('web.web_title')}}</title>
    <meta name="keywords" content="{{Config::get('web.web_keywords')}}" />
    <meta name="description" content="{{Config::get('web.web_description')}}" />
    @show

    @section('link')
    <link href="{{asset('resource/front/css/base.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('resource/front/js/modernizr.js')}}"></script>
    <![endif]-->
    @show
</head>
<body>
<header>
    <div id="logo">
    <a href="{{url('/')}}"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $k => $v)
        <a href="{{$v->url}}"><span>{{$v->name}}</span><span class="en">{{$v->alias}}</span></a>
        @endforeach
    </nav>
</header>
@section('content')
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @foreach($latest as $v)
            <li><a href="{{url('/a/'.$v->id)}}" title="{{$v->title}}" target="_blank">{{$v->title}}</a></li>
        @endforeach
    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @foreach($righthot as $v)
            <li><a href="{{url('/a/'.$v->id)}}" title="{{$v->title}}" target="_blank">{{$v->title}}</a></li>
        @endforeach
    </ul>
@show
<footer>
    <p>{{Config::get('web.web_copyright')}}</p>
</footer>
<script src="{{asset('resource/front/js/silder.js')}}"></script>
</body>
</html>
