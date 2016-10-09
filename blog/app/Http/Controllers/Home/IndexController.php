<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Category;
use App\Models\Link;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends CommonController
{
    public function index()
    {
        //6篇热门文章
        $hot = Article::orderBy('view','desc')->take(6)->get();

        //5篇最新分页文章
        $data = Article::orderBy('time', 'desc')->paginate(5);

        //友情链接
        $link = Link::orderBy('order','asc')->get();

        return view('home.index',compact('hot', 'righthot', 'data', 'latest', 'link'));
    }

    public function category($id)
    {
        $category = Category::find($id);

        $category->increment('view');

        $data = $category->article()->paginate(4);

        $submenu = $category->children;

        return view('home.list', compact('category', 'data', 'submenu'));
    }

    public function article($id)
    {
        $article = Article::find($id);

        $article->increment('view');

        $category = $article->category;

        $nextinfo['pre'] = Article::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextinfo['next'] = Article::where('id', '>', $id)->orderBy('id', 'asc')->first();

        $otherlink = $category->article()->take(6)->get();

        return view('home.new',compact('article', 'category', 'nextinfo', 'otherlink'));
    }
}
