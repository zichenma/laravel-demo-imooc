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
