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

Route::resource('/cfs', 'User\HomeController');

Route::resource('/confession', 'User\ConfessionController');

//*************** Phan Admin *****************
//login
Route::get('admin/login', [
    'as' => 'login',
    'uses' => 'admin\loginController@ViewLogin',
]);

Route::post('admin/login', [
    'as' => 'loginAdmin',
    'uses' => 'admin\loginController@PostLogin',
]);

//logout
Route::get('admin/logOut', [
    'as' => 'logout',
    'uses' => 'admin\loginController@AdminlogOut',
]);

Route::group(['prefix' => 'admin', 'middleware' => ['adminLogin', 'locale']], function () {
    Route::resource('dashboard', 'admin\DashboardController');
    Route::get('change-language/{lang}', [
        'as' => 'change_lang',
        'uses' => 'admin\DashboardController@change_lang',
    ]);

    //confessions
    Route::resource('confessions', 'admin\ConfessionController')->except(['create', 'store', 'edit', 'update']);

    //home
    Route::get('home', function () {
        return view('admin.home');
    });

    //topics
    Route::resource('topics', 'admin\TopicController');
    Route::put('topics/{id?}/edit', ['as' => 'topics/updateAll', 'uses' => 'admin\TopicController@updateAll']);
    Route::post('topics/update/{id}', ['as' => 'topics/update', 'uses' => 'admin\TopicController@update']);
    Route::post('topics/bulk_update', ['as' => 'topics/bulk_update', 'uses' => 'admin\TopicController@bulk_update']);

    //posts
    Route::resource('posts', 'admin\PostController')->except(['create', 'store', 'edit', 'update']);
});
