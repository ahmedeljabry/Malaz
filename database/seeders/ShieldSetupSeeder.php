<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ShieldSetupSeeder extends Seeder
{
    public function run(): void
    {
        $guard = config('auth.defaults.guard', 'web');

        $super = Role::query()->firstOrCreate([
            'name' => config('filament-shield.super_admin.name', 'super_admin'),
            'guard_name' => $guard,
        ]);

        $panelUser = Role::query()->firstOrCreate([
            'name' => config('filament-shield.panel_user.name', 'panel_user'),
            'guard_name' => $guard,
        ]);

        // Create User permissions if they don't exist
        $userPermissions = [
            'ViewAny:User',
            'View:User',
            'Create:User',
            'Update:User',
            'Delete:User',
        ];

        foreach ($userPermissions as $permissionName) {
            Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => $guard,
            ]);
        }

        // Assign all User permissions to super_admin role
        $userPerms = Permission::whereIn('name', $userPermissions)->get();
        $super->givePermissionTo($userPerms);

        // Optionally assign super_admin to the first user if none has it
        $firstUser = User::query()->first();
        if ($firstUser && ! $firstUser->hasRole($super)) {
            $firstUser->assignRole($super);
        }

        // Also ensure the first user has all User permissions directly
        if ($firstUser) {
            $firstUser->givePermissionTo($userPerms);
        }
    }
}

