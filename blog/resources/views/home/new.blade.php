@extends('layouts.home')

@section('info')
    <title>{{$article->title}}</title>
    <meta name="keywords" content="{{$article->tag}}" />
    <meta name="description" content="{{$article->description}}" />
@stop

@section('link')
@parent
    <link href="{{asset('resource/front/css/new.css')}}" rel="stylesheet">
@stop

@section('content')
<article class="blogs">
  <h1 class="t_nav"><span>您当前的位置：<a href="{{url('/')}}">首页</a>&nbsp;&gt;&nbsp;<a href="{{url('/category/'.$category->id)}}">{{$category->name}}</a></span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('/category/'.$category->id)}}" class="n2">{{$category->name}}</a></h1>
  <div class="index_about">
    <h2 class="c_titile">{{$article->title}}</h2>
    <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d', $article->time)}}</span><span>编辑：{{$article->editor}}</span><span>查看次数：{{$article->view}}</span></p>
    <ul class="infos">
      {!! $article->content !!}
    </ul>
    <div class="keybq">
    <p><span>关键字词</span>：{{$article->tag}}</p>
    
    </div>
    <div class="ad"> </div>
    <div class="nextinfo">
      @if($nextinfo['pre'])
      <p>上一篇：<a href="{{url('/a/'.$nextinfo['pre']->id)}}">{{$nextinfo['pre']->title}}</a></p>
      @endif
      @if($nextinfo['next'])
      <p>下一篇：<a href="{{url('/a/'.$nextinfo['next']->id)}}">{{$nextinfo['next']->title}}</a></p>
      @endif
    </div>
    <div class="otherlink">
      <h2>相关文章</h2>
      <ul>
        @foreach($otherlink as $v)
        <li><a href="{{url('/a/'.$v->id)}}" title="{{$v->title}}">{{$v->title}}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
  <aside class="right">
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END -->
    <div class="blank"></div>
    <div class="news">
    @parent
    </div>
  </aside>
</article>
@stop