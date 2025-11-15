<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::first();
if ($user) {
    echo "User: " . $user->name . "\n";
    echo "Roles: " . $user->roles->pluck('name')->implode(', ') . "\n";
    echo "User Permissions: " . $user->getAllPermissions()->whereIn('name', ['ViewAny:User', 'View:User', 'Create:User', 'Update:User', 'Delete:User'])->pluck('name')->implode(', ') . "\n";
    echo "Can ViewAny User: " . ($user->can('ViewAny:User') ? 'Yes' : 'No') . "\n";
    echo "Can Create User: " . ($user->can('Create:User') ? 'Yes' : 'No') . "\n";
} else {
    echo "No user found\n";
}
