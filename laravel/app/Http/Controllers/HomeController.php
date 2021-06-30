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
        // 查询：
        // $users = DB::select('select * from users');
        // 打印：
        // dd($users);
        // dd($users[0]->name); // "tanfan"
        // 带参数 SQL:
        // $users = DB::select('select * from users where id = ?', [1]);
        // 一样：(这样就不用考虑参数的顺序)
        // $users = DB::select('select * from users where id = :id', ['id' => 1]);

        // 写入：
        // $ret = DB::insert('insert into users (name,email,password) values (?,?,?)',['tanfan','tanfan@163.com','123456']);
        // dd($ret); // true : 2	tanfan	tanfan@163.com	NULL	123456	NULL	NULL	NULL

        // 更新：
        // $ret = DB::update('update users set email = ? where id = ?', ['xxxx@163.com', 2]);
        // dd($ret); // 1 这个返回的是行数

        // $ret = DB::delete('delete from users where id = ?', [2]);
        // dd($ret); // 0

        // 修改表结构:
        // DB::statement('drop table users');

        // 用构造器查询：
        // $user = DB::table('users')->where('id', 1)->get(); // 结果为 Collection
        // find 主键为 1 
        // $user = DB::table('users')->find(1); // 结果为对象
        // 想要查到的第一个对象:
        // $user = DB::table('users')->where('id', 1)->first(); // 结果为对象和find结果相同
        // 查询对象的某一项：
        // $user = DB::table('users')->where('id', 1)->value('name'); // "tanfan"
        // 查询所有的数据：
        // $user = DB::table('users')->get(); 
        // 查询某一列：
        // $user = DB::table('users')->pluck('email')->toArray(); 
        // 分页：
        // $user = DB::table('users')->paginate(2); 
        // $user = DB::table('users')->simplePaginate(2); // 少了 total 与 paginate 比。
        // 最大, 小, 平均... id: 
        // $user = DB::table('users')->max('id'); // 1
        // $user = DB::table('users')->min('id'); // 1
        // $user = DB::table('users')->avg('id'); // 1
        // $user = DB::table('users')->count('id'); // 1
        // $user = DB::table('users')->sum('id'); // 1
        // $user = DB::table('users')->where('id', 4)->exists(); // false
        $user = DB::table('users')->where('id', 4)->doesntExist(); // true
        dd($user);
       
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