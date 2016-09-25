<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except'=>['getChange', 'postChange']]);
    }

    public function getChange()
    {
        return view('auth.change');
    }

    public function postChange(ChangeRequest $request)
    {
        $user = $request->user();

        if(!Hash::check($request->password_o,$user->password)) {
            return redirect()->back()->withInput($request->except('password_o'))->withErrors('旧密码错误！');
        }

        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->withInput($request->all())->withErrors('密码修改成功！');
    }
}
