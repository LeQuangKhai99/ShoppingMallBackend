<?php

include 'route_admin.php';

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();

});
Route::get('/', function (){
    return view('welcome');
});

Route::post('/login', [
    'as'=>'login',
    'uses'=>'AdminController@postLogin'
]);
Route::get('/login', [
    'as'=>'login',
    'uses'=>'AdminController@login'
]);

Route::get('/logout', function (){
    auth()->logout();
});

