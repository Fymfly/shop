<?php

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

Route::get('/hello2','TestController@hello');
// Route::get('/index','host\IndexController@index')->name('index'); 

// 前
Route::group(['prefix'=>'host'],function(){

    // 首页
    Route::get('/','host\IndexController@index')->name('index'); 


    // 显示登录页面
    Route::get('/login','host\LoginController@login')->name('login');
    // 处理登录表单
    Route::post('/dologin','host\LoginController@dologin')->name('dologin');
    // 退出登录
    Route::get('/logout','host\LoginController@logout')->name('logout');


    // 显示注册页面
    Route::get('/register','host\RegisterController@register')->name('register');
    // 处理注册表单
    Route::post('/doregist','host\RegisterController@doregist')->name('doregist');
    // 发送短信验证码
    Route::get('/sendmobilecode','host\RegisterController@sendmobilecode')->name('ajax-send-modbile-code');

});



// 后
Route::group(['prefix'=>'admin'],function(){

    Route::middleware(['login'])->group(function() {

        // 产品管理-产品类表
    Route::get('/goods_index','admin\GoodsController@goods_index')->name('goods_index');

    // 产品管理-品牌管理
    Route::get('/brand_index','admin\BrandController@brand_index')->name('brand_index');

    // 产品管理-分类管理
    Route::get('/category_index','admin\CategoryController@category_index')->name('category_index');
    Route::get('/category_add','admin\CategoryController@category_add')->name('category_add');



    // 会员管理-会员列表
    Route::get('/members_index','admin\MembersController@members_index')->name('members_index');

    // 会员管理-等级管理
    Route::get('/grade_index','admin\GradeController@grade_index')->name('grade_index');

    // 会员管理-会员记录管理
    Route::get('/record_index','admin\RecordController@record_index')->name('record_index');



    // 管理员管理-权限管理
    Route::get('/privilege_index','admin\PrivilegeController@privilege_index')->name('privilege_index');

    // 管理员管理-管理员列表
    Route::get('/admin_index','admin\AdminController@admin_index')->name('admin_index');

    // 管理员管理-个人信息
    Route::get('/personage_index','admin\PersonageController@personage_index')->name('personage_index');

    });

    // 首页
    Route::get('/','admin\IndexController@index')->name('aindex');
    Route::get('/home','admin\IndexController@home')->name('home');


    // 显示登录页面
    Route::get('/alogin','admin\LoginController@alogin')->name('alogin');
    // 处理登录表单
    Route::post('/adologin','admin\LoginController@adologin')->name('adologin');
    // 退出登录
    Route::get('/alogout','admin\LoginController@alogout')->name('alogout');


    



    // 测试
    Route::get('/test','admin\TestController@test')->name('test');
});

