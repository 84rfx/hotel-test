<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

$user = User::where('email', 'admin@grandbandung.com')->first();

if ($user) {
    echo "User found: " . $user->name . PHP_EOL;
    echo "Email: " . $user->email . PHP_EOL;
    echo "Roles: " . $user->roles->pluck('name')->join(', ') . PHP_EOL;
    echo "Permissions: " . $user->getAllPermissions()->pluck('name')->join(', ') . PHP_EOL;

    // Check specific permissions
    echo "Has admin role: " . ($user->hasRole('admin') ? 'YES' : 'NO') . PHP_EOL;
    echo "Has users.view permission: " . ($user->hasPermissionTo('users.view') ? 'YES' : 'NO') . PHP_EOL;
    echo "Has dashboard access: " . ($user->hasPermissionTo('dashboard.view') ? 'YES' : 'NO') . PHP_EOL;
} else {
    echo "User not found" . PHP_EOL;
}
