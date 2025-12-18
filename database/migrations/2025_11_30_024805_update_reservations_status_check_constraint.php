<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For SQLite, we need to recreate the CHECK constraint
        DB::statement("PRAGMA foreign_keys = OFF;");
        DB::statement("
            CREATE TEMPORARY TABLE reservations_backup AS SELECT * FROM reservations;
            DROP TABLE reservations;
            CREATE TABLE reservations (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER NOT NULL,
                room_id INTEGER NOT NULL,
                check_in DATE NOT NULL,
                check_out DATE NOT NULL,
                guests INTEGER NOT NULL,
                total_amount DECIMAL(10,2) NOT NULL,
                status TEXT NOT NULL CHECK (status IN ('pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled', 'completed')) DEFAULT 'pending',
                special_requests TEXT,
                additional_services TEXT,
                created_at DATETIME,
                updated_at DATETIME,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
            );
            INSERT INTO reservations SELECT * FROM reservations_backup;
            DROP TABLE reservations_backup;
        ");
        DB::statement("PRAGMA foreign_keys = ON;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to old constraint
        DB::statement("
            CREATE TEMPORARY TABLE reservations_backup AS SELECT * FROM reservations;
            DROP TABLE reservations;
            CREATE TABLE reservations (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER NOT NULL,
                room_id INTEGER NOT NULL,
                check_in DATE NOT NULL,
                check_out DATE NOT NULL,
                guests INTEGER NOT NULL,
                total_amount DECIMAL(10,2) NOT NULL,
                status TEXT NOT NULL CHECK (status IN ('pending', 'confirmed', 'cancelled', 'completed')) DEFAULT 'pending',
                special_requests TEXT,
                additional_services TEXT,
                created_at DATETIME,
                updated_at DATETIME,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
            );
            INSERT INTO reservations SELECT * FROM reservations_backup;
            DROP TABLE reservations_backup;
        ");
    }
};
