<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Product extends Model
{
    use HasFactory;
    use softDeletes; // 软删除
    // 约定大于配置：
    // 如果都遵循约定，可以完全使用默认配置
  
    // protected $table = 'products';   // 默认 table 名字为 products (Model 名字为 Product)
    // protected $connection = 'mysql'; // 可以更改默认连接为其他

    // protected $primaryKey = 'id'; // 更改主键

    // public $timestamps = true; // false 停止更新 created_at/updated_at 时间戳
    // 如果时间戳命名不是 created_at， 则可以重新声明： 
    // const CREATED_AT = 'add_time';
    // const UPDATED_AT = 'update_time';

    // 获取属性，并进行数据转换，比如 json -> array
    protected $casts = [
        'attr' => 'array'
    ];

    // 白名单（允许数据填充）：
    // 必须要规定可填充字段，要不则报错：
    // Add [title] to fillable property to allow mass assignment on [App\Models\Product].
    // http://laravel.test/modelTest
    protected $fillable = [
        'title',
        'category_id',
        'is_on_sale',
        'price',
        'attr',
    ];
    // 黑白名单不能同时出现!!!
    // 如果仅仅定义了黑名单，并且数组为空，则允许所有字段填充
    // protected $guarded = [];
}
