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

//*************** Phan Admin *****************
//login
Route::get('admin/login', [
    'as' => 'login',
    'uses' => 'admin\LoginController@viewLogin',
]);

Route::post('admin/login', [
    'as' => 'loginAdmin',
    'uses' => 'admin\LoginController@postLogin',
]);

//logout
Route::get('admin/logOut', [
    'as' => 'logout',
    'uses' => 'admin\LoginController@adminLogOut',
]);

Route::group(['prefix' => 'admin', 'middleware' => ['adminLogin', 'locale']], function () {
    Route::resource('dashboard', 'admin\DashboardController');
    Route::get('change-language/{lang}', [
        'as' => 'change_lang',
        'uses' => 'admin\DashboardController@changeLang',
    ]);

    //confessions
    Route::resource('confessions', 'admin\ConfessionController')->except(['create', 'store', 'edit', 'update']);

    //topics
    Route::resource('topics', 'admin\TopicController');
    Route::put('topics/{id?}/edit', ['as' => 'topics/updateAll', 'uses' => 'admin\TopicController@updateAll']);
    Route::post('topics/update/{id}', ['as' => 'topics/update', 'uses' => 'admin\TopicController@update']);
    Route::post('topics/bulk_update', ['as' => 'topics/bulk_update', 'uses' => 'admin\TopicController@bulkUpdate']);

    //posts
    Route::get('posts', ['as' => 'postAdmin', 'uses' => 'admin\PostController@index']);
    Route::get('posts/{id?}', ['as' => 'postShowAdmin', 'uses' => 'admin\PostController@show']);
    Route::delete('posts/{id?}/delete', ['as' => 'postDelAdmin', 'uses' => 'admin\PostController@destroy']);
});

Route::group(['prefix' => 'cfs'], function () {
    Route::get('/', 'User\HomeController@index')->name('cfs');

    Route::get('/login', 'User\LoginController@loginForm')->name('user.login_form');

    Route::post('/login', 'User\LoginController@login')->name('user.login');

    Route::get('/logout', 'User\LoginController@logout')->name('user.logout');

    Route::get('/register', 'User\RegisterController@registerForm')->name('user.register_form');

    Route::post('/register', 'User\RegisterController@register')->name('user.register');

    Route::resource('/posts', 'User\PostController');

});
