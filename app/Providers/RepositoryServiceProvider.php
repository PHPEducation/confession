<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected static $repositories = [
//        [
////            Repo of Confessions
//            'App\Repositories\Contracts\ConfessionRepository',
//            'App\Repositories\Eloquents\ConfessionEloquentRepository',
//        ],
        [
//            Repo of Topics
            'App\Repositories\Contracts\TopicRepository',
            'App\Repositories\Eloquents\TopicEloquentRepository',
        ],
        [
//          Repo of Posts
            'App\Repositories\Contracts\PostRepository',
            'App\Repositories\Eloquents\PostEloquentRepository',
        ],
//        [
////          Repo of Reports
//            'App\Repositories\Contracts\ReportRepository',
//            'App\Repositories\Eloquents\ReportEloquentRepository',
//        ],
        [
//          Repo of Permission
            'App\Repositories\Contracts\PermissionRepository',
            'App\Repositories\Eloquents\PermissionEloquentRepository',
        ],
        [
//          Repo of Role
            'App\Repositories\Contracts\RoleRepository',
            'App\Repositories\Eloquents\RoleEloquentRepository',
        ],
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (static::$repositories as $repository) {
            $this->app->bind(
                $repository[0],
                $repository[1]
            );
        }
    }
}
