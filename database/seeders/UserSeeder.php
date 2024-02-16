<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('slug', str_slug('Администратор'))->first();
        $moderator = Role::where('slug', str_slug('Модератор'))->first();
        $createTasks = Permission::where('slug', str_slug('Create Tasks'))->first();
        $updateUsers = Permission::where('slug', str_slug('Update Tasks'))->first();

        $user1 = new User();
        $user1->name = 'Администратор';
        $user1->email = 'admin@webjox.ru';
        $user1->password = Hash::make('admin');
        $user1->save();
        $user1->roles()->attach($admin);
        $user1->permissions()->attach($createTasks);

        $user2 = new User();
        $user2->name = 'Модератор';
        $user2->email = 'moder@webjox.ru';
        $user2->password = Hash::make('moder');
        $user2->save();
        $user2->roles()->attach($moderator);
        $user2->permissions()->attach($updateUsers);
    }
}
