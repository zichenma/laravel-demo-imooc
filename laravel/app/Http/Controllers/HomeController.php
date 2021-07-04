<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Middleware\Benchmark;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



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
    public function dbTest() {
        // **查询：
        // $users = DB::select('select * from users');
        // 打印：
        // dd($users);
        // dd($users[0]->name); // "tanfan"
        // 带参数 SQL:
        // $users = DB::select('select * from users where id = ?', [1]);
        // 一样：(这样就不用考虑参数的顺序)
        // $users = DB::select('select * from users where id = :id', ['id' => 1]);

        // **写入：
        // $ret = DB::insert('insert into users (name,email,password) values (?,?,?)',['tanfan','tanfan@163.com','123456']);
        // dd($ret); // true : 2	tanfan	tanfan@163.com	NULL	123456	NULL	NULL	NULL

        // **更新：
        // $ret = DB::update('update users set email = ? where id = ?', ['xxxx@163.com', 2]);
        // dd($ret); // 1 这个返回的是行数

        // $ret = DB::delete('delete from users where id = ?', [2]);
        // dd($ret); // 0

        // **修改表结构:
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

        // **分页：
        // $user = DB::table('users')->paginate(2); 
        // $user = DB::table('users')->simplePaginate(2); // 少了 total 与 paginate 比。
        // 最大, 小, 平均... id: 
        // $user = DB::table('users')->max('id'); // 1
        // $user = DB::table('users')->min('id'); // 1
        // $user = DB::table('users')->avg('id'); // 1
        // $user = DB::table('users')->count('id'); // 1
        // $user = DB::table('users')->sum('id'); // 1
        // $user = DB::table('users')->where('id', 4)->exists(); // false
        // $user = DB::table('users')->where('id', 4)->doesntExist(); // true
         // dd($user);


        // **where 语句
        // select * from users where id > 1;
        // DB::table('users')->where('id','>',1)->dump(); // dump 打印这条语句

        // select * from users where id <> 1; 不等于
        // DB::table('users')->where('id','<>',1)->dump();
        // DB::table('users')->where('id', '!=', 1)->dump();

        // select * from users where name like 'tan%'; // 匹配前缀
        // DB::table('users')->where('name','like', 'tan%')->dump();

        // select * from users where id > 1 or name like 'tan%';
        // DB::table('users')->where('id','>',1)->orWhere('name', 'like', 'tan%')->dump();

        // select * from users where id > 1 and (email like '%@163' or name like 'tan%'); 用括号时候，需要用闭包方式写
        // DB::table('users')->where('id','>',1)->where(function(Builder $query){
        //     $query->where('email','like','%@163')
        //     ->orWhere('name', 'like', '%@tan');
        // })->dump();

        // select * from users where id in (1, 3);
        // DB::table('users')->whereIn('id', [1,3])->dump();

        // select * from users where id not in (1, 3);
        // DB::table('users')->whereNotIn('id', [1,3])->dump();

        // select * from users where created_at is null;
        // DB::table('users')->whereNull('craeted_at')->dump();

        // select * from users where created_at is not null;
        // DB::table('users')->whereNotNull('craeted_at')->dump();
     
        // select * from users where 'name' = 'email'; 比较字段
        //DB::table('users')->whereColumn('name', 'email')->dump();

        // **新增:

        // 插入单条数据：
        // $ret = DB::table('users')->insert([
        //     'name' => 'name1',
        //     'password' => Hash::make('123456'),
        //     'email' => 'name1@163.com'
        // ]);
        // dd($ret); // true

        // 批量插入数据：

        // $ret = DB::table('users')->insert([
        //     [
        //         'name' => 'name2',
        //         'password' => Hash::make('123456'),
        //         'email' => 'name2@163.com'
        //     ],
        //     [
        //         'name' => 'name3',
        //         'password' => Hash::make('123456'),
        //         'email' => 'name3@163.com'
        //     ],
        // ]);
        
        // 指定 id : insertOrIgnore 忽略主键冲突

        // $ret = DB::table('users')->insertOrIgnore([
        //     'id' => 4,
        //     'name' => 'name1',
        //     'password' => Hash::make('123456'),
        //     'email' => 'name1@163.com'
        // ]);
        // dd($ret); // 0 没有写入成功
        
        // 写入后立即拿到 id: 

        // $ret = DB::table('users')->insertGetId([
        //     'name' => 'name4',
        //     'password' => Hash::make('123456'),
        //     'email' => 'name4@163.com'
        // ]);

        // dd($ret); // 8

        // **更新数据：
        // $ret = DB::table('users')->where('id', 8)->update(['name' => 'tom', 'email' => 'tom@163.com']);
        // dd($ret); // 1 返回 int 为更新的条数
        
        // 如果数据存在则修改,不存在则写入
        // $ret = DB::table('users')->updateOrInsert(
        //     ['id' => 10], // 查询
        //     [ // 更新/写入：
        //         'name' => 'name6',
        //         'email' => 'name6@163.com',
        //         'password' => Hash::make('123')
        //     ]
        // );
        // dd($ret);

        // 主意命名规范： add(create, update, remove)_{columnName}_to_{tableName}_table
        // php artisan make:migration add_score_to_users_table
        // 用docker时候做数据库更新（php artisan migrate）的时候需要将 DB_HOST=mysql 改成： DB_HOST=127.0.0.1 在 laravel 的 .env 文件里
        
        // 自增自减参数：

        // $ret = DB::table('users')->where('id', '7')->increment('score', 10);
        // dd($ret); // 把当前 id 为 7 的数据，score 每次自增 10

        // $ret = DB::table('users')->where('id', '7')->decrement('score', 10);
        // dd($ret); // 把当前 id 为 7 的数据，score 每次自减 10

        // **删除
        // $ret = DB::table('users')->where('id', 7)->delete();
        // dd($ret);

        // **事务 (transaction)
        // 1.闭包，自动提交，回滚
        // 开启一个事务，执行语句，如有异常 （所有语句都不会执行成功），则回滚
        
        // $ret = DB::transaction(function() {
        //     DB::table('users')->where('id', 4)->update(['name' => Str::random()]);
        //     throw new \Exception(); // 如果有 exception 两条都不会执行成功
        //     DB::table('users')->where('id', 5)->update(['name' => Str::random()]);
        // });

        // 2. 手动，自行提交，回滚 (效果一样，但更灵活，可以控制何时提交何时 rollback)
        // try{
        //     DB::beginTransaction();

        //     DB::table('users')->where('id', 4)->update(['name' => Str::random()]);
        //     DB::table('users')->where('id', 5)->update(['name' => Str::random()]);

        //     DB::commit();
        // }catch(\Exception $exception) {
        //     DB::rollBack();
        // }
       
        //dd($ret);
    }

    public function modelTest() {
        // create 填充字段: (需要在 Models 里面定义 $fillable) 
        // $product = Product::query()->create([
        //     'title'       => '水杯',
        //     'category_id' => 1,
        //     'is_on_sale'  => 1,
        //     'price'       => '1200', // 单位是分
        //     'attr'        => ['高' => '10cm', '容积' => '200ml']
        // ]);
        // dd($product); // 返回一个对象，其中 attributes: array:8
       
        // insert 填充字段 (不需要在 Models 里面定义 $fillable) 
        // 与 DB::table('products')->insert(); 效果一样 
        // 与 create 不同，insert 并不会自动维护时间戳，所以一般不推荐用该方法
        // $ret = Product::query()->insert([
        //     'title'       => 'cup2',
        //     'category_id' => 1,
        //     'is_on_sale'  => 1,
        //     'price'       => '1200', // 单位是分
        //     'attr'        => json_encode(['Height' => '10cm', 'Volumn' => '200ml'])
        // ]);

        // new 对象来填充字段：（需要 $fillable）
        // $product = new Product();
        // $product->fill([
        //     'title'       => 'cup23',
        //     'category_id' => 1,
        //     'is_on_sale'  => 1,
        //     'price'       => '1200', 
        //     'attr'        => json_encode(['Height' => '10cm', 'Volumn' => '200ml'])
        // ]);
        // $product->title = 'cup4'; // 新增一条数据
        // $product->save();
        // dd($product);

        // 查询检索
        // $product = Product::all(); // 返回了一个 Collection 对象
        // 一样： 
        // $product = Product::query()->get();
        // $product = Prodcut::query()->where('is_on_sale', 1)->get();
        // dd($product); 
    }
}