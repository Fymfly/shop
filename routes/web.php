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

        // 首页
        Route::get('/','admin\IndexController@index')->name('aindex');
        Route::get('/home','admin\IndexController@home')->name('home'); 

        // 产品管理-产品类表
        Route::get('/goods_index','admin\GoodsController@goods_index')->name('goods_index');
        // 产品管理-产品类表（增加页面）
        Route::get('/goods_create','admin\GoodsController@goods_create')->name('goods_create');
        // 产品管理-产品类表（处理增加）
        Route::post('/goods_docreate','admin\GoodsController@goods_docreate')->name('goods_docreate');

        // 产品管理-产品类表（修改页面）
        Route::get('/goods_edit/{id}','admin\GoodsController@goods_edit')->name('goods_edit');
        // 产品管理-产品类表（处理修改）
        Route::post('/goods_doedit{id}','admin\GoodsController@goods_doedit')->name('goods_doedit');

        // 产品管理-产品类表（删除）
        Route::get('/goods_delete/{id}','admin\GoodsController@goods_delete')->name('goods_delete');



        // 产品管理-品牌管理
        Route::get('/brand_index','admin\BrandController@brand_index')->name('brand_index');
        // 产品管理-品牌管理（增加页面）
        Route::get('/brand_create','admin\BrandController@brand_create')->name('brand_create');
        // 产品管理-品牌管理（处理增加）
        Route::post('/brand_docreate','admin\BrandController@brand_docreate')->name('brand_docreate');

        // 产品管理-品牌管理（修改页面）
        Route::get('/brand_edit/{id}','admin\BrandController@brand_edit')->name('brand_edit');
        // 产品管理-品牌管理（处理修改）
        Route::post('/brand_doedit/{id}','admin\BrandController@brand_doedit')->name('brand_doedit');

        // 产品管理-品牌管理（删除）
        Route::get('/brand_delete/{id}','admin\BrandController@brand_delete')->name('brand_delete');


        // 产品管理-分类管理
        Route::get('/category_index','admin\CategoryController@category_index')->name('category_index');
        // 产品管理-分类管理（增加页面）
        Route::get('/category_create','admin\CategoryController@category_create')->name('category_create');
        Route::get('/category_createt','admin\CategoryController@category_createt')->name('category_createt');
        // 产品管理-分类管理（处理增加）
        Route::post('/category_docreate','admin\CategoryController@category_docreate')->name('category_docreate');
        Route::post('/category_docreatet','admin\CategoryController@category_docreatet')->name('category_docreatet');
        Route::get('/category_delete','admin\CategoryController@category_delete')->name('category_delete');

        // 产品管理-分类管理（修改页面）
        Route::get('/category_edit/{id}','admin\CategoryController@category_edit')->name('category_edit');
        // 产品管理-分类管理（处理修改）
        Route::post('/category_doedit/{id}','admin\CategoryController@category_doedit')->name('category_doedit');


        // 会员管理-会员列表
        Route::get('/members_index','admin\MembersController@members_index')->name('members_index');
        // 会员管理-会员列表（增加页面）
        Route::get('/members_create','admin\MembersController@members_create')->name('members_create');
        // 会员管理-会员列表（处理增加）
        Route::post('/members_docreate','admin\MembersController@members_docreate')->name('members_docreate');

        // 会员管理-会员列表（修改页面）
        Route::get('/members_edit/{id}','admin\MembersController@members_edit')->name('members_edit');
        // 会员管理-会员列表（处理修改）
        Route::post('/members_doedit/{id}','admin\MembersController@members_doedit')->name('members_doedit');

        // 会员管理-会员列表（删除）
        Route::get('/members_delete/{id}','admin\MembersController@members_delete')->name('members_delete');


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



        // 文章管理-文章列表
        Route::get('/articlelist_index','admin\ArticlelistController@articlelist_index')->name('articlelist_index');

        // 文章管理-文章列表（显示添加）
        Route::get('/articlelist_create','admin\ArticlelistController@articlelist_create')->name('articlelist_create');
        // 文章管理-文章列表（处理添加）
        Route::post('/articlelist_docreate','admin\ArticlelistController@articlelist_docreate')->name('articlelist_docreate');

        // 文章管理-文章列表（显示修改）
        Route::get('/articlelist_edit/{id}','admin\ArticlelistController@articlelist_edit')->name('articlelist_edit');
        // 文章管理-文章列表（处理修改）
        Route::post('/articlelist_doedit/{id}','admin\ArticlelistController@articlelist_doedit')->name('articlelist_doedit');

        // 文章管理-文章列表（删除）
        Route::get('/articlelist_delete/{id}','admin\ArticlelistController@articlelist_delete')->name('articlelist_delete');


        // 文章管理-分类管理
        Route::get('/articlecate_index','admin\ArticlecateController@articlecate_index')->name('articlecate_index');

        // 文章管理-分类管理（添加页面）
        Route::get('/articlecate_create','admin\ArticlecateController@articlecate_create')->name('articlecate_create');
        // 文章管理-分类管理（处理添加）
        Route::post('/articlecate_docreate','admin\ArticlecateController@articlecate_docreate')->name('articlecate_docreate');

        // 文章管理-分类管理（修改页面）
        Route::get('/articlecate_edit/{id}','admin\ArticlecateController@articlecate_edit')->name('articlecate_edit');
        // 文章管理-分类管理（处理修改）
        Route::post('/articlecate_doedit/{id}','admin\ArticlecateController@articlecate_doedit')->name('articlecate_doedit');

        // 文章管理-分类管理（删除）
        Route::get('/articlecate_delete/{id}','admin\ArticlecateController@articlecate_delete')->name('articlecate_delete');
    });


    // 显示登录页面
    Route::get('/alogin','admin\LoginController@alogin')->name('alogin');
    // 处理登录表单
    Route::post('/adologin','admin\LoginController@adologin')->name('adologin');
    // 退出登录
    Route::get('/alogout','admin\LoginController@alogout')->name('alogout');


    



    // 测试
    Route::get('/test','admin\TestController@test')->name('test');
});

