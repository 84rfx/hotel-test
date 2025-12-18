<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::where('email', 'admin@grandbandung.com')->first();

        if (!$user) {
            $user = \App\Models\User::create([
                'name' => 'Admin Grand Bandung',
                'email' => 'admin@grandbandung.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Assign admin role if not already assigned
        if (!$user->hasRole('admin')) {
            $user->assignRole('admin');
        }

        // Also set the role column for middleware compatibility
        $user->update(['role' => 'admin']);
    }
}
