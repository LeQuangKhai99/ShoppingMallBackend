<?php

Route::group(['prefix'=>'admin','middleware'=>['check_login']],function () {

    Route::get('/logout', function (){
        auth()->logout();
    })->name('logout');

    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as'=>'categories.index',
            'uses'=>'CategoryController@index',
            'middleware'=>'can:category-list'
        ]);
        Route::get('/create', [
            'as'=>'categories.create',
            'uses'=>'CategoryController@create',
            'middleware'=>'can:category-add'
        ]);
        Route::post('/create', [
            'as'=>'categories.create',
            'uses'=>'CategoryController@postCreate',
            'middleware'=>'can:category-add'
        ]);
        Route::get('/edit/{id}', [
            'as'=>'categories.edit',
            'uses'=>'CategoryController@edit',
            'middleware'=>'can:category-update'
        ]);
        Route::post('/edit/{id}', [
            'as'=>'categories.edit',
            'uses'=>'CategoryController@postEdit',
            'middleware'=>'can:category-update'
        ]);
        Route::get('/delete/{id}', [
            'as'=>'categories.delete',
            'uses'=>'CategoryController@delete',
            'middleware'=>'can:category-delete'
        ]);
    });

    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as'=>'menus.index',
            'uses'=>'MenuController@index',
            'middleware'=>'can:menu-list'
        ]);
        Route::get('/create', [
            'as'=>'menus.create',
            'uses'=>'MenuController@create',
            'middleware'=>'can:menu-add'
        ]);
        Route::post('/create', [
            'as'=>'menus.create',
            'uses'=>'MenuController@postCreate',
            'middleware'=>'can:menu-add'
        ]);
        Route::get('/edit/{id}', [
            'as'=>'menus.edit',
            'uses'=>'MenuController@edit',
            'middleware'=>'can:menu-update'
        ]);
        Route::post('/edit/{id}', [
            'as'=>'menus.edit',
            'uses'=>'MenuController@postEdit',
            'middleware'=>'can:menu-update'
        ]);
        Route::get('/delete/{id}', [
            'as'=>'menus.delete',
            'uses'=>'MenuController@delete',
            'middleware'=>'can:menu-delete'
        ]);
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [
            'as'=>'products.index',
            'uses'=>'ProductController@index',
            'middleware'=>'can:product-list'
        ]);
        Route::get('/create', [
            'as'=>'products.create',
            'uses'=>'ProductController@create',
            'middleware'=>'can:product-add'
        ]);
        Route::post('/create', [
            'as'=>'products.create',
            'uses'=>'ProductController@postCreate',
            'middleware'=>'can:product-add'
        ]);
        Route::get('/edit/{id}', [
            'as'=>'products.edit',
            'uses'=>'ProductController@edit',
            'middleware'=>'can:product-update,id'
        ]);
        Route::post('/edit/{id}', [
            'as'=>'products.edit',
            'uses'=>'ProductController@postEdit',
            'middleware'=>'can:product-update,id'
        ]);
        Route::get('/delete/{id}', [
            'as'=>'products.delete',
            'uses'=>'ProductController@delete',
            'middleware'=>'can:product-delete'
        ]);
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as'=>'sliders.index',
            'uses'=>'SliderController@index',
            'middleware'=>'can:slider-list'
        ]);
        Route::get('/create', [
            'as'=>'sliders.create',
            'uses'=>'SliderController@create',
            'middleware'=>'can:slider-add'
        ]);
        Route::post('/create', [
            'as'=>'sliders.create',
            'uses'=>'SliderController@postCreate',
            'middleware'=>'can:slider-add'
        ]);
        Route::get('/edit/{id}', [
            'as'=>'sliders.edit',
            'uses'=>'SliderController@edit',
            'middleware'=>'can:slider-update'
        ]);
        Route::post('/edit/{id}', [
            'as'=>'sliders.edit',
            'uses'=>'SliderController@postEdit',
            'middleware'=>'can:slider-update'
        ]);
        Route::get('/delete/{id}', [
            'as'=>'sliders.delete',
            'uses'=>'SliderController@delete',
            'middleware'=>'can:slider-delete'
        ]);
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as'=>'settings.index',
            'uses'=>'SettingController@index',
            'middleware'=>'can:setting-list'
        ]);
        Route::get('/create', [
            'as'=>'settings.create',
            'uses'=>'SettingController@create',
            'middleware'=>'can:setting-add'
        ]);
        Route::post('/create', [
            'as'=>'settings.create',
            'uses'=>'SettingController@postCreate',
            'middleware'=>'can:setting-add'
        ]);
        Route::get('/edit/{id}', [
            'as'=>'settings.edit',
            'uses'=>'SettingController@edit',
            'middleware'=>'can:setting-update'
        ]);
        Route::post('/edit/{id}', [
            'as'=>'settings.edit',
            'uses'=>'SettingController@postEdit',
            'middleware'=>'can:setting-update'
        ]);
        Route::get('/delete/{id}', [
            'as'=>'settings.delete',
            'uses'=>'SettingController@delete',
            'middleware'=>'can:setting-delete'
        ]);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as'=>'users.index',
            'uses'=>'UserController@index',
            'middleware'=>'can:user-list'
        ]);
        Route::get('/create', [
            'as'=>'users.create',
            'uses'=>'UserController@create',
            'middleware'=>'can:user-add'
        ]);
        Route::post('/create', [
            'as'=>'users.create',
            'uses'=>'UserController@postCreate',
            'middleware'=>'can:user-add'
        ]);
        Route::get('/edit/{id}', [
            'as'=>'users.edit',
            'uses'=>'UserController@edit',
            'middleware'=>'can:user-update'
        ]);
        Route::post('/edit/{id}', [
            'as'=>'users.edit',
            'uses'=>'UserController@postEdit',
            'middleware'=>'can:user-update'
        ]);
        Route::get('/delete/{id}', [
            'as'=>'users.delete',
            'uses'=>'UserController@delete',
            'middleware'=>'can:user-delete'
        ]);
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as'=>'roles.index',
            'uses'=>'RoleController@index',
            'middleware'=>'can:role-list'
        ]);
        Route::get('/create', [
            'as'=>'roles.create',
            'uses'=>'RoleController@create',
            'middleware'=>'can:role-add'
        ]);
        Route::post('/create', [
            'as'=>'roles.create',
            'uses'=>'RoleController@postCreate',
            'middleware'=>'can:role-add'
        ]);
        Route::get('/edit/{id}', [
            'as'=>'roles.edit',
            'uses'=>'RoleController@edit',
            'middleware'=>'can:role-update'
        ]);
        Route::post('/edit/{id}', [
            'as'=>'roles.edit',
            'uses'=>'RoleController@postEdit',
            'middleware'=>'can:role-update'
        ]);
        Route::get('/delete/{id}', [
            'as'=>'roles.delete',
            'uses'=>'RoleController@delete',
            'middleware'=>'can:role-delete'
        ]);
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', [
            'as'=>'permissions.index',
            'uses'=>'PermissionController@index',
            'middleware'=>'can:permission-list'
        ]);
        Route::get('/create', [
            'as'=>'permissions.create',
            'uses'=>'PermissionController@create',
            'middleware'=>'can:permission-add'
        ]);
        Route::post('/create', [
            'as'=>'permissions.create',
            'uses'=>'PermissionController@postCreate',
            'middleware'=>'can:permission-add'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'permissions.edit',
            'uses'=>'PermissionController@edit',
            'middleware'=>'can:permission-update'
        ]);

        Route::post('/edit/{id}', [
            'as'=>'permissions.edit',
            'uses'=>'PermissionController@postEdit',
            'middleware'=>'can:permission-update'
        ]);

        Route::get('/delete/{id}', [
            'as'=>'permissions.delete',
            'uses'=>'PermissionController@delete',
            'middleware'=>'can:permission-delete'
        ]);

    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [
            'as'=>'orders.index',
            'uses'=>'OrderController@index',
            'middleware'=>'can:order-list'
        ]);

        Route::get('/detail/{id}', [
            'as'=>'orders.detail',
            'uses'=>'OrderController@detail',
            'middleware'=>'can:order-detail'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'orders.edit',
            'uses'=>'OrderController@edit',
            'middleware'=>'can:order-update'
        ]);

        Route::get('/delete/{id}', [
            'as'=>'orders.delete',
            'uses'=>'OrderController@delete',
            'middleware'=>'can:order-delete'
        ]);

    });
});
