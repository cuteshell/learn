@extends('layouts.home')

@section('link')
@parent
    <link href="{{asset('resource/front/css/index.css')}}" rel="stylesheet">

    {{--如果不加style.css,则找不到.page class 导致分类按钮显示异常--}}
    <link href="{{asset('resource/front/css/style.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
      <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
      <p>加了锁的青春，不会再因谁而推开心门。</p>
    </ul>
    <div class="avatar"><a href="#"><span>后盾</span></a> </div>
  </section>
</div>
<div class="template">
  <div class="box">
    <h3>
      <p><span>编辑推荐</span>Recommend</p>
    </h3>
    <ul>
      @foreach($hot as $v)
      <li><a href="{{url('/a/'.$v->id)}}"  target="_blank"><img src="{{url($v->thumb == ''?"/resource/front/images/001.png":$v->thumb)}}"></a><span>{{$v->title}}</span></li>
      @endforeach
    </ul>
  </div>
</div>
<article>
  <h2 class="title_tj">
    <p>文章<span>推荐</span></p>
  </h2>
  <div class="bloglist left">
    @foreach($data as $v)
    <h3>{{$v->title}}</h3>
    <figure><img src="{{url($v->thumb == ''?"/resource/front/images/001.png":$v->thumb)}}"></figure>
    <ul>
      <p>{{$v->description}}</p>
      <a title="{{$v->title}}" href="{{url('/a/'.$v->id)}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <p class="dateview"><span>{{date('Y-m-d',$v->time)}}</span><span>作者：{{$v->editor}}</span></p>
    @endforeach
    <div class="page">
        {{$data->links()}}
    </div>
  </div>
  <aside class="right">
    <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
    <div class="news">
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
    <h3 class="links">
      <p>友情<span>链接</span></p>
    </h3>
    <ul class="website">
      @foreach($link as $v)
      <li><a href="{{$v->url}}" target="_blank">{{$v->name}}</a></li>
      @endforeach
    </ul> 
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