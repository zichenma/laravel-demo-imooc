<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home/hello', [HomeController::class, 'hello']);
// 尽量不用 any

Route::any('/home/hello', [HomeController::class, 'hello']);
// 路由中间件
// ->middleware('benchmark');
Route::any('/home/hello2', [HomeController::class, 'hello2']);

// 重定向：
Route::get('here', function(){
    return '重定向之前';
});
Route::get('there', function(){
    return '重定向之后';
});
// 301 - 永久重定向  SEO tracking 之后地址
Route::permanentRedirect('here', 'there');
// 302 - 临时重定向  SEO tracking 之前地址
Route::redirect('here', 'there');

// 传参：
// Route::any('getOrder', [HomeController::class, 'getOrder']);
// 获取路径参数：
// Route::get('getOrder/{id}', [HomeController::class, 'getOrder']);
// 设置参数默认值
// Route::get('getOrder/{id?}', [HomeController::class, 'getOrder']);
// 传多个参数：
// Route::get('getOrder/{id}/{name}', [HomeController::class, 'getOrder']);
// 闭包路由：
// Route::get('getOrder/{id}/{name}', function($id, $name){
//     return [1, $id, $name]; // [1, "100","tanfan"]
// });
// 限制参数:
// Route::get('getOrder/{id}/{name}', function($id, $name){
//     return [1, $id, $name]; // [1, "100","tanfan"]
//     // id 为 0 - 9 包括， name 为 a-zA-Z
//     // 如果 url: http://laravel.test/getOrder/abcd/tanfan
//     // 第一个参数为字符串，则返回404
// })->where('id', '[0-9]+')->where('name', '[a-zA-Z]+');
// 限制所有路由参数：
// 在 laravel/app/Providers/RouteServiceProvider.php：
// public function boot() 中：
// $this->routes(function () {
//     Route:: pattern('id', '[0-9]+');
// }
// 匹配所有参数包括 ‘/’ (在搜索中有可能用到）：
// Route::get('getOrder/{id}/{name}', function($id, $name){
//     // 如果 url: http://laravel.test/getOrder/1/tanfan/xxx/xxx
//     return [1, $id, $name]; 
//     // [
//     //     1,
//     //     "1",
//     //     "tanfan/xxx/xxx"
//     // ]
// })->where('name', '.*');
// 命名路由：
// 可以用 route 函数来获取相关路由的完整路径
Route::get('getUser', [HomeController::class, 'getUser'])->name('get.user');
Route::get('getUrl', function(){
    // return redirect()->route('get.user', ['id'=>'10']); //更简洁写法重定向： http://laravel.test/getUser?id=10
    // return redirect()->to(\route('get.user',['id'=>'10'])); //重定向： http://laravel.test/getUser?id=10
    // return \route('get.user'); //可以获得url:  http://laravel.test/getUser
    // 第一个参数是 name, 第二个参数是key:value，第三个参数是是否为绝对路径
    return \route('get.user',[], false);//可以获得url:  /getUser
});
Route::get('dbTest', [HomeController::class, 'dbTest']);
Route::get('modelTest', [HomeController::class, 'modelTest']);
Route::get('modelTest', [HomeController::class, 'collectionTest']);
Route::get('cacheTest', [HomeController::class, 'cacheTest']);