<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            [
                'name' => 'topic-list',
                'display_name' => 'Display Topic List',
                'description' => 'See only Listing Of Topic',
            ],
            [
                'name' => 'topic-create',
                'display_name' => 'Create Topic',
                'description' => 'Create New Topic',
            ],
            [
                'name' => 'topic-edit',
                'display_name' => 'Edit Topic',
                'description' => 'Edit Topic',
            ],
            [
                'name' => 'topic-delete',
                'display_name' => 'Delete Topic',
                'description' => 'Delete Topic',
            ],
            [
                'name' => 'topic-show',
                'display_name' => 'Show Topic',
                'description' => 'Show Topic',
            ],
            [
                'name' => 'post-list',
                'display_name' => 'Display Post List',
                'description' => 'See only Listing Of Post',
            ],
            [
                'name' => 'post-delete',
                'display_name' => 'Delete Post',
                'description' => 'Delete Post',
            ],
            [
                'name' => 'post-show',
                'display_name' => 'Show Post',
                'description' => 'Show Post',
            ],
            [
                'name' => 'permission-list',
                'display_name' => 'Display Permission List',
                'description' => 'See only Listing of Permission',
            ],
            [
                'name' => 'permission-create',
                'display_name' => 'Create Permission',
                'description' => 'Create New Permission',
            ],
            [
                'name' => 'permission-edit',
                'display_name' => 'Edit Permission',
                'description' => 'Edit Permission',
            ],
            [
                'name' => 'permission-delete',
                'display_name' => 'Delete Permission',
                'description' => 'Delete Permission',
            ],
            [
                'name' => 'role-list',
                'display_name' => 'Display Role List',
                'description' => 'See only Listing of Role',
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role',
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Role',
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role',
            ],
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}
