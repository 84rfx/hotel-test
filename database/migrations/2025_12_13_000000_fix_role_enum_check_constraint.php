<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For SQLite, we need to recreate the table to update CHECK constraints
        // First, backup existing data
        $users = DB::table('users')->get();

        // Drop the existing table
        Schema::dropIfExists('users');

        // Recreate the table with correct enum values
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['owner', 'admin', 'user'])->default('user');
            $table->string('profile_photo')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Restore the data
        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'password' => $user->password,
                'role' => $user->role,
                'profile_photo' => $user->profile_photo,
                'remember_token' => $user->remember_token,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // For SQLite, we need to recreate the table to update CHECK constraints
        // First, backup existing data
        $users = DB::table('users')->get();

        // Drop the existing table
        Schema::dropIfExists('users');

        // Recreate the table with old enum values
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('profile_photo')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Restore the data (filter out 'owner' roles)
        foreach ($users as $user) {
            $role = $user->role;
            if ($role === 'owner') {
                $role = 'admin'; // Convert owner to admin on rollback
            }

            DB::table('users')->insert([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'password' => $user->password,
                'role' => $role,
                'profile_photo' => $user->profile_photo,
                'remember_token' => $user->remember_token,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
        }
    }
};
