@extends('layouts.home')

@section('info')
    <title>{{$category->title}}</title>
    <meta name="keywords" content="{{$category->keywords}}" />
    <meta name="description" content="{{$category->description}}" />
@stop

@section('link')
@parent
    <link href="{{asset('resource/front/css/style.css')}}" rel="stylesheet">
@stop

@section('content')
<article class="blogs">
<h1 class="t_nav"><span>{{$category->description}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('/category/'.$category->id)}}" class="n2">{{$category->name}}</a></h1>
<div class="newblog left">
    @foreach($data as $v)
   <h2>{{$v->title}}</h2>
   <p class="dateview"><span>发布时间：{{date('Y-m-d', $v->time)}}</span><span>作者：{{$v->editor}}</span><span>分类：[<a href="{{url('/category/'.$category->id)}}">{{$category->name}}</a>]</span></p>
    <figure><img src="{{url($v->thumb == ''?"/resource/front/images/001.png":$v->thumb)}}"></figure>
    <ul class="nlist">
      <p>{{$v->description}}</p>
      <a title="{{$v->title}}" href="{{url('/a/'.$v->id)}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <div class="line"></div>
    @endforeach

    <div class="blank"></div>
    <div class="page">
        {{$data->links()}}
    </div>
</div>
<aside class="right">
    @if($submenu->all())
   <div class="rnav">
      <ul>
          @foreach($submenu as $k=>$v)
              <li class="rnav{{$k+1}}"><a href="{{url('/category/'.$v->id)}}" target="_blank">{{$v->name}}</a></li>
          @endforeach
     </ul>      
    </div>
    @endif
    <div class="news">
    @parent
    </div>

     <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END -->   
</aside>
</article>
@stop