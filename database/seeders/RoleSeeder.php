<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = new Role();
        $admin->name = 'Администратор';
        $admin->slug = str_slug($admin->name);
        $admin->save();

        $moderator = new Role();
        $moderator->name = 'Модератор';
        $moderator->slug = str_slug($moderator->name);
        $moderator->save();
    }
}
