<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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

        // Optionally assign super_admin to the first user if none has it
        $firstUser = User::query()->first();
        if ($firstUser && ! $firstUser->hasRole($super)) {
            $firstUser->assignRole($super);
        }
    }
}

