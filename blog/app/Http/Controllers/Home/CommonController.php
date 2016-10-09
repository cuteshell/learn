<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs = Nav::all();

        $righthot = Article::orderBy('view', 'desc')->take(5)->get();

        //8篇最新文章
        $latest = Article::orderBy('time', 'desc')->take(8)->get();

        view()->share(['navs'=>$navs, 'righthot'=>$righthot, 'latest'=>$latest]);
    }
}
