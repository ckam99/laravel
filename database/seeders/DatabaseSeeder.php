<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::truncate();
        \App\Models\Permission::truncate();

        $owner_perm = [
            ['name' => 'create_admin', 'description' => 'Can create Admin'],
            ['name' => 'update_admin', 'description' => 'Can update Admin'],
            ['name' => 'edit_admin', 'description' => 'Can edit Admin'],
            ['name' => 'delete_admin', 'description' => 'Can delete Admin'],
        ];

        $admin_perm = [
            ['name' => 'create_user', 'description' => 'Can create User'],
            ['name' => 'update_user', 'description' => 'Can update User'],
            ['name' => 'edit_user', 'description' => 'Can edit User'],
            ['name' => 'delete_user', 'description' => 'Can delete User'],
        ];

        // \App\Models\User::factory(10)->create();
        \App\Models\Role::insert([
            ['name' => 'user', 'description' => 'Guest'],
            ['name' => 'admin', 'description' => 'Administrator'],
            ['name' => 'owner', 'description' => 'Owner'],
        ]);

        \App\Models\Permission::insert(array_merge($owner_perm, $admin_perm));
    }
}
