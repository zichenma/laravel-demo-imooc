<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    // 全局中间件
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        // 客户端和服务器之间存在代理服务器的时候，可以用来配置可信任代理识别真正客户端
        \App\Http\Middleware\TrustProxies::class,
        // 处理跨域
        \Fruitcake\Cors\HandleCors::class,
        // 检测laravel是否处于维护状态 （显示站点维护中。。。）
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        // 检测 POST body 大小
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // 把传入参数的头尾去空格
        \App\Http\Middleware\TrimStrings::class,
        // 把空字符串转换成 nulld
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        // \App\Http\Middleware\Benchmark::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    // 路由中间件组
    protected $middlewareGroups = [
        'web' => [
            // 加解秘 cookie
            \App\Http\Middleware\EncryptCookies::class,
            // 把 cookie 放到 response 里
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // \App\Http\Middleware\VerifyCsrfToken::class,
            // 显示或者隐式绑定对象： 假设url传了个1，则可以显示ID为1的用户对象
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // 'benchmark'
        ],

        'api' => [
            // 限流
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    // 路由中间件
    protected $routeMiddleware = [
        // 建权
        'auth' => \App\Http\Middleware\Authenticate::class,
         // 建权
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        // 设置缓存头
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
         // 建权
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
         // 建权
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        // 验证密码
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        // 验签
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        // 限流
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        // 验证邮箱
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'benchmark' => \App\Http\Middleware\Benchmark::class
    ];
   
}
