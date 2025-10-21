<?php

namespace Database\Seeders;

use App\Enums\EnumPermissionsEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Enums\EnumRolesEnum;
use App\Models\User;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # create roles
        $adminRole      =  Role::create(['name' => EnumRolesEnum::Admin->value]);
        $commenterRole  =  Role::create(['name' => EnumRolesEnum::Commenter->value]);
        $userRole       =  Role::create(['name' => EnumRolesEnum::User->value]);


        # create permissions
        $manageFeaturesPermission   = Permission::create(['name' => EnumPermissionsEnum::ManageFeatures->value]);
        $manageUsersPermission      = Permission::create(['name' => EnumPermissionsEnum::ManageUsers->value]);
        $manageCommentsPermission   = Permission::create(['name' => EnumPermissionsEnum::ManageComments->value]);
        $upvoteDownvotePermission   = Permission::create(['name' => EnumPermissionsEnum::UpvoteDownvote->value]);

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
