<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


use think\facade\Route;
//Route::get('think', function () {
//    return 'hello,ThinkPHP5!';
//});
//
//Route::get('hello/:name', 'index/hello');

//return [

//];


Route::get('index','index/index/index');

Route::any('insert','index/index/insert');
Route::get('delete/:id','index/index/delete');
Route::get('update/:id','index/index/update');
Route::any('show','index/index/show');
Route::any('showFirst','index/index/showFirst');