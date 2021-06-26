<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Middleware\Benchmark;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller {

    public function __construct() {
        // 注册中间件，并排除 hello, 只有 hello2 中间件会被调用
        // $this->middleware(Benchmark::class, ['except'=>['hello']]);
        // 仅用中间件
        // $this->middleware(Benchmark::class, ['only'=>['hello']]);
         // 中间件传参：
        // $this->middleware('auth:admin,general');
        $this->middleware('benchmark:test1,test2');
    }

    public function hello() {
        return "Hello World!";
    }
    public function hello2() {
        return "Hello2 World!";
    }
    public function dbTest() {
        DB::select('select * from user');
    }
    /**
     * url : http://laravel.test/getOrder?id=1&name=cup
     *
     */
    // public function getOrder(Request $request) {
    //     $input = $request->input();
    //     // 用 get 方法：
    //     return $input; //  $input: { id: "1", name: "cup" }
    // }

    // public function getOrder(Request $request) {
    //     $input = $request->input();
    //     // 用 POST 方法：
    //     // body : {"name": "tanfan-post", "id": "1" }
    //     return $input; // response: $input: {"name": "tanfan-post", "id": "1" }
    // }

    // public function getOrder(Request $request) {

    //     // 用 POST 方法：
    //     // 区分 query 跟 body
    //     // http://laravel.test/getOrder?id=2&name=cup
    //     // body : {"name": "tanfan-post", "id": "1" }
    //     $query = $request->query();
    //     $post = $request->post();
    //     return ['query' => $query, 'post' => $post]; 
    //     // response in postman:
    //     // {
    //     //     "query": {
    //     //         "id": "2",
    //     //         "name": "cup"
    //     //     },
    //     //     "post": {
    //     //         "name": "tanfan-post",
    //     //         "id": "1"
    //     //     }
    //     // }
    // }
    
    // 用 GET 方法 提取路径中的 id：
    // http://laravel.test/getOrder/id=100

    // public function getOrder($id) {
    //     return $id; // 100
    // }

    // 设置默认值：
    // Route::get('getOrder/{id?}', [HomeController::class, 'getOrder']);
    // public function getOrder($id = 100) {
    //     return $id; // 100
    // }

    // 传多个参数：
    // Route::get('getOrder/{id}/{name}', [HomeController::class, 'getOrder']);
    // 控制器方式：
    // public function getOrder($id, $name) {
    //     // get: http://laravel.test/getOrder/100/tanfan
    //     return [$id, $name]; // ["100","tanfan"]
    // }
    // // 闭包路由：
    //  public function getOrder($id, $name) {
    //     // get: http://laravel.test/getOrder/100/tanfan
    //     return [$id, $name]; // ["100","tanfan"]
    // }
    public function getUser(Request $request) {
        return $request->input('id');
    }
}