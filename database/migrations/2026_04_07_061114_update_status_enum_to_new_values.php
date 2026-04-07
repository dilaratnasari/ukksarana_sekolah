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
        // Update existing data
        DB::statement("UPDATE complaints SET status = 'menunggu' WHERE status = 'approved'");
        // No 'rejected' data, so no update for ditolak

        // Alter enum
        DB::statement("ALTER TABLE complaints MODIFY COLUMN status ENUM('waiting', 'menunggu', 'proses', 'selesai') DEFAULT 'menunggu'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert data
        DB::statement("UPDATE complaints SET status = 'waiting' WHERE status = 'menunggu'");
        DB::statement("UPDATE complaints SET status = 'process' WHERE status = 'proses'");
        DB::statement("UPDATE complaints SET status = 'finished' WHERE status = 'selesai'");

        // Revert enum
        DB::statement("ALTER TABLE complaints MODIFY COLUMN status ENUM('waiting', 'process', 'finished') DEFAULT 'waiting'");
    }
};
