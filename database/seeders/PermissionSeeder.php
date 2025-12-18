<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // User Management
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            'users.manage_roles',

            // Room Management
            'rooms.view',
            'rooms.create',
            'rooms.edit',
            'rooms.delete',

            // Message Management
            'messages.view',
            'messages.read',
            'messages.delete',

            // Food Order Management
            'food_orders.view',
            'food_orders.update_status',

            // Event Reservation Management
            'event_reservations.view',
            'event_reservations.update_status',

            // Reservation Management
            'reservations.view',
            'reservations.update_status',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo([
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            'users.manage_roles',
            'rooms.view',
            'rooms.create',
            'rooms.edit',
            'rooms.delete',
            'messages.view',
            'messages.read',
            'messages.delete',
            'food_orders.view',
            'food_orders.update_status',
            'event_reservations.view',
            'event_reservations.update_status',
            'reservations.view',
            'reservations.update_status',
        ]);

        $ownerRole = Role::create(['name' => 'owner', 'guard_name' => 'web']);
        $ownerRole->givePermissionTo(Permission::all());

        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);
        $userRole->givePermissionTo([
            'reservations.view',
            'food_orders.view',
        ]);
    }
}
