<?php

namespace App\Http\Middleware;

use App\Http\Utils\Code\Code;
use Closure;

class VerificationCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(strtoupper($request->code) != $this->getCode()) {
            return redirect()->back()->withInput($request->input())->withErrors('验证码错误!');
        }
        return $next($request);
    }

    public function getCode()
    {
        $code = new Code();

        return $code->get();
    }
}
