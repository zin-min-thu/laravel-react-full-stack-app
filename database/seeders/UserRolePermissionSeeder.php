<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Enums\RolesEnum;
use App\Models\User;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # create roles
        $adminRole      =  Role::create(['name' => RolesEnum::Admin->value]);
        $commenterRole  =  Role::create(['name' => RolesEnum::Commenter->value]);
        $userRole       =  Role::create(['name' => RolesEnum::User->value]);


        # create permissions
        $manageFeaturesPermission   = Permission::create(['name' => PermissionsEnum::ManageFeatures->value]);
        $manageUsersPermission      = Permission::create(['name' => PermissionsEnum::ManageUsers->value]);
        $manageCommentsPermission   = Permission::create(['name' => PermissionsEnum::ManageComments->value]);
        $upvoteDownvotePermission   = Permission::create(['name' => PermissionsEnum::UpvoteDownvote->value]);

        # sync roles and permissions
        $adminRole->syncPermissions([
            $manageFeaturesPermission,
            $manageUsersPermission,
            $manageCommentsPermission,
            $upvoteDownvotePermission,
        ]);

        $commenterRole->syncPermissions([
            $manageCommentsPermission,
            $upvoteDownvotePermission,
        ]);

        $userRole->syncPermissions([
            $upvoteDownvotePermission,
        ]);

        # create users
        $adminUser = User::factory()->create([
            'name'      => 'Admin User',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password'),
        ]);

        $commenterUser = User::factory()->create([
            'name'      => 'Commenter User',
            'email'     => 'commenter@example.com',
            'password'  => bcrypt('password'),
        ]);

        $userUser = User::factory()->create([
            'name'      => 'User User',
            'email'     => 'user@example.com',
            'password'  => bcrypt('password'),
        ]);

        # sync users and roles
        $adminUser->assignRole($adminRole);
        $commenterUser->assignRole($commenterRole);
        $userUser->assignRole($userRole);
    }
}
