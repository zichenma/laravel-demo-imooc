<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Benchmark
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // $next 就是处理$request的业务逻辑了 
    public function handle(Request $request, Closure $next)
    {   
        // 前置
        // ... 
        $sTime = microtime(true);
        $response = $next($request);
        // 后置
        // ...
        $runTime = microtime(true) - $sTime;
        Log::info('benchmark', [
            'url' => $request->url(),
            'input' => $request->input(),
            'time' => "$runTime ms"
        ]);
        return $response;
    }
}
