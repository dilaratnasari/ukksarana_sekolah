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
            if (!Schema::hasColumn('complaints', 'nis')) {
                $table->string('nis')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('complaints', 'location')) {
                $table->string('location')->nullable()->after('nis');
            }
            if (!Schema::hasColumn('complaints', 'incident_date')) {
                $table->date('incident_date')->nullable()->after('location');
            }
            if (!Schema::hasColumn('complaints', 'feedback')) {
                $table->text('feedback')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            if (Schema::hasColumn('complaints', 'feedback')) {
                $table->dropColumn('feedback');
            }
            if (Schema::hasColumn('complaints', 'incident_date')) {
                $table->dropColumn('incident_date');
            }
            if (Schema::hasColumn('complaints', 'location')) {
                $table->dropColumn('location');
            }
            if (Schema::hasColumn('complaints', 'nis')) {
                $table->dropColumn('nis');
            }
        });
    }
};
