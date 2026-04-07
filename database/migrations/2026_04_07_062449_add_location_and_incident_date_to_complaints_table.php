<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('nis')->nullable()->after('user_id');
            $table->string('location')->nullable()->after('nis');
            $table->date('incident_date')->nullable()->after('location');
            $table->text('feedback')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn(['nis', 'location', 'incident_date', 'feedback']);
        });
    }
};
