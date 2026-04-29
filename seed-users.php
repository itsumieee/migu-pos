<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Clear existing users
User::query()->delete();

// Create admin
User::create([
    'name' => 'Admin',
    'email' => 'admin@migu.com',
    'password' => Hash::make('password'),
    'role' => 'admin',
    'email_verified_at' => now(),
]);

// Create kasir
User::create([
    'name' => 'Kasir',
    'email' => 'kasir@migu.com',
    'password' => Hash::make('password'),
    'role' => 'kasir',
    'email_verified_at' => now(),
]);

// Create test user
User::create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => Hash::make('password'),
    'role' => 'user',
    'email_verified_at' => now(),
]);

echo "Users seeded successfully!\n";
echo "Admin: admin@migu.com / password\n";
echo "Kasir: kasir@migu.com / password\n";
echo "User: test@example.com / password\n";
