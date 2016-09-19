<?php

namespace App\Http\Controllers\Admin;

use App\Http\Utils\Code\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

class CommonController extends Controller
{
    public function code()
    {
        $code = new Code();

        return $code->make();
    }
}
