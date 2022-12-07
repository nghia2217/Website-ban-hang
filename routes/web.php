<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', 'Client\HomeController@home')
    ->name('Route_Frontend_Home');
Route::get('/list-product', 'Client\ListProductController@listProduct');
Route::get('/product-detail', 'Client\ListProductController@productDetail');
Route::get('/product-detail/{id}/{id_category}','Client\ListProductController@productDetail')
    ->name('route_Backend_Product_productDetail');

Route::get('/category-detail/{id}','Client\CategoryController@categoryDetail')
    ->name('route_Backend_Category_categoryDetail');

Route::get('/filter-product/{price_min}/{price_max}','Client\ListProductController@filterProduct')
->name('Route_Frontend_Product_filterProduct');

//Route::get('/register', function () {
//    return view('client.register');
//});

Route::get('/cart', 'Client\CartController@list')
    ->name('Route_Frontend_Cart_List');
Route::post('/cart/add','Client\CartController@add')
    ->name('Route_Frontend_Cart_Add');
Route::post('cart/update','Client\CartController@update')
    ->name('Route_Frontend_Cart_Update');
Route::post('cart/remove','Client\CartController@remove')
    ->name('Route_Frontend_Cart_Remove');
Route::post('/cart/clear','Client\CartController@clear')
    ->name('Route_Frontend_Cart_Clear');

Route::get('/order', 'Client\OrderController@list')
    ->name('Route_Frontend_Order_List');
Route::post('/order', 'Client\OrderController@add')
    ->name('Route_Frontend_Order_Add');

Route::get('/client/user', 'Client\UserController@detail')
    ->name('Route_Frontend_User_Detail');
Route::get('/client/user/change-password', 'Client\UserController@changePassword')
    ->name('Route_Frontend_User_ChangePassword');
Route::post('/client/user/change-password', 'Client\UserController@updatePassword')
    ->name('Route_Frontend_User_UpdatePassword');
Route::get('/client/user/change-information', 'Client\UserController@changeInformation')
    ->name('Route_Frontend_User_ChangeInformation');
Route::post('/client/user/change-information/{id}', 'Client\UserController@updateInformation')
    ->name('Route_Frontend_User_UpdateInformation');

Route::post('/search','Client\ListProductController@search')
    ->name('Route_Frontend_Product_Search');

Route::get('/bill-client/{user_id}', 'Admin\BillController@billClient')
    ->name('Route_Frontend_Bill_BillClient');
Route::get('/bill-client/delete/{id}/{user_id}', 'Admin\BillController@billClientDelete')
    ->name('Route_Frontend_Bill_BillClientDelete');

//Dang nhap admin
Route::get('/admin/login', ['as'=>'login','uses'=>'Auth\LoginController@getLogin']);
Route::post('/admin/login', ['as'=>'login','uses'=>'Auth\LoginController@postLogin']);
Route::get('/admin/logout', ['as'=>'/admin/logout','uses'=>'Auth\LoginController@getLogout']);

//Dang nhap client
Route::get('/login', ['as'=>'login','uses'=>'Auth\LoginController@getLoginClient']);
Route::post('/login', ['as'=>'login','uses'=>'Auth\LoginController@postLoginClient']);
Route::get('/logout', ['as'=>'logout','uses'=>'Auth\LoginController@getLogoutClient']);
Route::match(['get','post'],'/register', 'Admin\UserController@addUserClient')->name('router_BackEnd_AddUserClient_index');

Route::middleware(['auth'])->group(function (){
    //Tất cả những đường link muôn bảo vệ chỉ cần đáp vào đây
    
        Route::get('/admin/users', 'Admin\UserController@user')
        ->name('router_BackEnd_ListUser_index');
    Route::match(['get','post'],'/admin/user/add', 'Admin\UserController@addUser')
        ->name('router_BackEnd_AddUser_index');
    Route::get('/admin/user/detail/{id}','Admin\UserController@detail')
        ->name('route_Backend_User_Detail');
    Route::post('/admin/user/update/{id}','Admin\UserController@update')
        ->name('route_Backend_User_Update');
    Route::get('/admin/user/delete/{id}','Admin\UserController@delete')
        ->name('route_Backend_User_Delete');

    Route::get('/roles', 'Admin\RoleController@role')
        ->name('router_BackEnd_ListRole_index');
    Route::match(['get','post'],'/admin/role/add', 'Admin\RoleController@addRole')
        ->name('router_BackEnd_AddRole_index');
    Route::get('/admin/role/detail/{id}','Admin\RoleController@detail')
        ->name('route_Backend_Role_Detail');
    Route::post('/admin/role/update/{id}','Admin\RoleController@update')
        ->name('route_Backend_Role_Update');
    Route::get('/admin/role/delete/{id}','Admin\RoleController@delete')
        ->name('route_Backend_Role_Delete');

    Route::get('/categories', 'Admin\CategoryController@category')
        ->name('router_BackEnd_ListCategory_index');
    Route::match(['get','post'],'/admin/category/add', 'Admin\CategoryController@addCategory')
        ->name('router_BackEnd_AddCategory_index');
    Route::get('/admin/category/detail/{id}','Admin\CategoryController@detail')
        ->name('route_Backend_Category_Detail');
    Route::post('/admin/category/update/{id}','Admin\CategoryController@update')
        ->name('route_Backend_Category_Update');
    Route::get('/admin/category/delete/{id}','Admin\CategoryController@delete')
        ->name('route_Backend_Category_Delete');

    Route::get('/products', 'Admin\ProductController@product')
        ->name('router_BackEnd_ListProduct_index');
    Route::match(['get','post'],'/admin/product/add', 'Admin\ProductController@addProduct')
        ->name('router_BackEnd_AddProduct_index');
    Route::get('/admin/product/detail/{id}','Admin\ProductController@detail')
        ->name('route_Backend_Product_Detail');
    Route::post('/admin/product/update/{id}','Admin\ProductController@update')
        ->name('route_Backend_Product_Update');
    Route::get('/admin/product/delete/{id}','Admin\ProductController@delete')
        ->name('route_Backend_Product_Delete');

    Route::get('/promotions', 'Admin\PromotionController@promotion')
        ->name('router_BackEnd_ListPromotion_index');
    Route::match(['get','post'],'/admin/promotion/add', 'Admin\PromotionController@addPromotion')
        ->name('router_BackEnd_AddPromotion_index');
    Route::get('/admin/promotion/detail/{id}','Admin\PromotionController@detail')
        ->name('route_Backend_Promotion_Detail');
    Route::post('/admin/promotion/update/{id}','Admin\PromotionController@update')
        ->name('route_Backend_Promotion_Update');
    Route::get('/admin/promotion/delete/{id}','Admin\PromotionController@delete')
        ->name('route_Backend_Promotion_Delete');

    Route::get('/bills', 'Admin\BillController@bill')
        ->name('route_Backed_Bill_Bill');
    Route::get('/admin/bill/detail/{id}','Admin\BillController@detail')
        ->name('route_Backend_Bill_Detail');
    Route::post('/admin/bill/update/{id}','Admin\BillController@update')
        ->name('route_Backend_Bill_Update');
    Route::get('/admin/bill/delete/{id}','Admin\BillController@delete')
        ->name('route_Backend_Bill_Delete');

    Route::get('/banners', 'Admin\BannerController@banner')
        ->name('router_BackEnd_ListBanner_index');
    Route::match(['get','post'],'/admin/banner/add', 'Admin\BannerController@addBanner')
        ->name('router_BackEnd_AddBanner_index');
    Route::get('/admin/banner/detail/{id}','Admin\BannerController@detail')
        ->name('route_Backend_Banner_Detail');
    Route::post('/admin/banner/update/{id}','Admin\BannerController@update')
        ->name('route_Backend_Banner_Update');
    Route::get('/admin/banner/delete/{id}','Admin\BannerController@delete')
        ->name('route_Backend_Banner_Delete');
    
});
