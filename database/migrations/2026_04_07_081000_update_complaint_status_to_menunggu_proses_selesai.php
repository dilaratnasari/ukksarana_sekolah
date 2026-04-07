<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, change the column to VARCHAR to allow any value temporarily
        DB::statement("ALTER TABLE complaints MODIFY COLUMN status VARCHAR(255)");
        
        // Update existing data
        DB::statement("UPDATE complaints SET status = 'menunggu' WHERE status = 'pending' OR status = 'waiting'");
        DB::statement("UPDATE complaints SET status = 'proses' WHERE status = 'menunggu_proses' OR status = 'process'");
        // Remove any 'ditolak' or 'approved' records by setting to 'menunggu'
        DB::statement("UPDATE complaints SET status = 'menunggu' WHERE status IN ('ditolak', 'approved')");
        
        // Now update the enum column to only allow the three status values
        DB::statement("ALTER TABLE complaints MODIFY COLUMN status ENUM('menunggu', 'proses', 'selesai') DEFAULT 'menunggu'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE complaints MODIFY COLUMN status VARCHAR(255) DEFAULT 'pending'");
    }
};
