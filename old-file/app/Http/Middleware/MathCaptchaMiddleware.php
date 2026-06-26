<?php

namespace App\Http\Middleware;

use Closure;

class MathCaptchaMiddleware
{
    public function handle($request, Closure $next)
    {
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $sum = $num1 + $num2;

        // Store the correct answer in the session
        $request->session()->put('math_captcha', $sum);

        // Add the numbers to the request for use in the view
        $request->attributes->add(['num1' => $num1, 'num2' => $num2]);

        return $next($request);
    }
}
