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

    //permissions
    Route::resource('permissions', 'admin\PermissionController');
    Route::put('permissions/{id?}/edit', ['as' => 'permissions/updateAll', 'uses' => 'admin\PermissionController@updateAll']);
    Route::post('permissions/update/{id}', ['as' => 'permissions/update', 'uses' => 'admin\PermissionController@update']);
    Route::post('permissions/bulk_update', ['as' => 'permissions/bulk_update', 'uses' => 'admin\PermissionController@bulkUpdate']);

    //roles
    Route::resource('roles', 'admin\RoleController');
    Route::put('roles/{id?}/edit', ['as' => 'roles/updateAll', 'uses' => 'admin\RoleController@updateAll']);
    Route::post('roles/update/{id}', ['as' => 'roles/update', 'uses' => 'admin\RoleController@update']);
    Route::post('roles/bulk_update', ['as' => 'roles/bulk_update', 'uses' => 'admin\RoleController@bulkUpdate']);
});

Route::group(['prefix' => 'cfs'], function () {
    Route::get('/', 'User\HomeController@index')->name('cfs');

    Route::get('/login', 'User\LoginController@loginForm')->name('user.login_form');

    Route::post('/login', 'User\LoginController@login')->name('user.login');

    Route::get('/logout', 'User\LoginController@logout')->name('user.logout');

    Route::get('/register', 'User\RegisterController@registerForm')->name('user.register_form');

    Route::post('/register', 'User\RegisterController@register')->name('user.register');

    Route::resource('/profiles', 'User\ProfileController');
    Route::post('/profiles/{id}', 'User\ProfileController@uploadImage')->name('user.upload_images');

    Route::resource('/posts', 'User\PostController');

    Route::resource('/comments', 'User\CommentController');

    Route::resource('/likes', 'User\LikeController');

    Route::resource('/reports', 'User\ReportController');

    Route::resource('/follows', 'User\FollowController');
    Route::delete('/follows/destroyUser/{id}', ['as' => 'destroyUser', 'uses' => 'User\FollowController@destroyUser']);
});
