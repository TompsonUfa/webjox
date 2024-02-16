<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('slug', str_slug('Администратор'))->first();
        $moderator = Role::where('slug', str_slug('Модератор'))->first();

        $createTasks = new Permission();
        $createTasks->name = 'Create Tasks';
        $createTasks->slug = str_slug($createTasks->name);
        $createTasks->save();
        $createTasks->fresh();

        $updateTasks = new Permission();
        $updateTasks->name = 'Update Tasks';
        $updateTasks->slug = str_slug($updateTasks->name);
        $updateTasks->save();
        $updateTasks->fresh();

        $deleteTasks = new Permission();
        $deleteTasks->name = 'Delete Tasks';
        $deleteTasks->slug = str_slug($deleteTasks->name);
        $deleteTasks->save();
        $deleteTasks->fresh();

        $admin->permissions()->attach([$createTasks->id, $updateTasks->id, $deleteTasks->id]);

        $moderator->permissions()->attach($updateTasks->id);

    }
}
