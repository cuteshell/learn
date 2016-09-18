<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Utils\Code\Code;


class LoginController extends CommonController
{
    public function login()
    {
        return view('admin.login');
    }

    public function code()
    {
        $code = new Code();

        return $code->make();
    }

    public function getCode()
    {
        $code = new Code();

        return $code->get();
    }
}
