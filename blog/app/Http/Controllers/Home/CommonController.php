<?php

namespace App\Http\Controllers\Home;

use App\Models\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs = Nav::all();

        view()->share('navs', $navs);
    }
}
