<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // creating permissions
        // users, posts, categories, tags and comment

        $user_list = Permission::create(['name' => 'user.list']);
        $user_create = Permission::create(['name' => 'user.create']);
        $user_view = Permission::create(['name' => 'user.view']);
        $user_update = Permission::create(['name' => 'user.update']);
        $user_delete = Permission::create(['name' => 'user.delete']);

        $post_list = Permission::create(['name' => 'post.list']);
        $post_create = Permission::create(['name' => 'post.create']);
        $post_view = Permission::create(['name' => 'post.view']);
        $post_update = Permission::create(['name' => 'post.update']);
        $post_delete = Permission::create(['name' => 'post.delete']);

        $category_list = Permission::create(['name' => 'category.list']);
        $category_create = Permission::create(['name' => 'category.create']);
        $category_view = Permission::create(['name' => 'category.view']);
        $category_update = Permission::create(['name' => 'category.update']);
        $category_delete = Permission::create(['name' => 'category.delete']);

        $tag_list = Permission::create(['name' => 'tag.list']);
        $tag_create = Permission::create(['name' => 'tag.create']);
        $tag_view = Permission::create(['name' => 'tag.view']);
        $tag_update = Permission::create(['name' => 'tag.update']);
        $tag_delete = Permission::create(['name' => 'tag.delete']);

        $comment_list = Permission::create(['name' => 'comment.list']);
        $comment_create = Permission::create(['name' => 'comment.create']);
        $comment_view = Permission::create(['name' => 'comment.view']);
        $comment_update = Permission::create(['name' => 'comment.update']);
        $comment_delete = Permission::create(['name' => 'comment.delete']);

        // creating roles
        $author_role = Role::create(['name' => 'author']);
        $admin_role = Role::create(['name' => 'admin']);

        // providing permission
        $permissions = Permission::all();
        $admin_role->syncPermissions($permissions);
        // $admin_role->givePermissionTo(
        //     [
        //         $user_list,
        //         $user_create,
        //         $user_view,
        //         $user_update,
        //         $user_delete
        //     ]
        // );

        $author_role->givePermissionTo(
            [
                $post_list,
                $post_create,
                $post_view,
                $post_update,
                $post_delete,
                $comment_list,
                $comment_create,
                $comment_view,
                $comment_update,
                $comment_delete
            ]
        );

        // creating users
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole($admin_role);

        // $user = User::create([
        //     'name' => 'author1',
        //     'email' => 'author1@gmail.com',
        //     'password' => bcrypt('password')
        // ]);
        // $user->assignRole($author_role);
    }
}
