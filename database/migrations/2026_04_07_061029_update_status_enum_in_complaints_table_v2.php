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
        DB::statement("UPDATE complaints SET status = 'menunggu' WHERE status = 'waiting'");
        DB::statement("UPDATE complaints SET status = 'proses' WHERE status = 'process'");
        DB::statement("UPDATE complaints SET status = 'selesai' WHERE status = 'fhinished'");

        DB::statement("ALTER TABLE complaints MODIFY COLUMN status ENUM('waiting', 'menunggu', 'proses', 'selesai') DEFAULT 'waiting'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("UPDATE complaints SET status = 'process' WHERE status = 'proses'");
        DB::statement("UPDATE complaints SET status = 'waiting' WHERE status = 'menunggu'");
        DB::statement("UPDATE complaints SET status = 'finished' WHERE status = 'selesai'");

        DB::statement("ALTER TABLE complaints MODIFY COLUMN status ENUM('waiting', 'process', 'finished', 'rejected') DEFAULT 'waiting'");
    }
};
