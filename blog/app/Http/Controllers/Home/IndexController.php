<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Link;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends CommonController
{
    public function index()
    {
        //6篇热门文章
        $hot = Article::orderBy('view','desc')->take(6)->get();

        $righthot = Article::orderBy('view', 'desc')->take(5)->get();

        //5篇最新分页文章
        $data = Article::orderBy('time', 'desc')->paginate(5);

        //8篇最新文章
        $latest = Article::orderBy('time', 'desc')->take(8)->get();

        //友情链接
        $link = Link::orderBy('order','asc')->get();

        return view('home.index',compact('hot', 'righthot', 'data', 'latest', 'link'));
    }

    public function category()
    {
        return view('home.list');
    }

    public function article()
    {
        return view('home.new');
    }
}
