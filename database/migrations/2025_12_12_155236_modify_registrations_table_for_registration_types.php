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
        // First, delete all existing registrations to avoid foreign key constraint issues
        DB::table('registrations')->truncate();

        // Check if registration_type column exists before dropping
        if (Schema::hasColumn('registrations', 'registration_type')) {
            Schema::table('registrations', function (Blueprint $table) {
                $table->dropColumn('registration_type');
            });
        }

        // Check if registration_type_id doesn't exist before adding
        if (!Schema::hasColumn('registrations', 'registration_type_id')) {
            Schema::table('registrations', function (Blueprint $table) {
                $table->foreignId('registration_type_id')->after('registration_period_id')->constrained('registration_types')->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('registrations', 'registration_type_id')) {
            Schema::table('registrations', function (Blueprint $table) {
                $table->dropForeign(['registration_type_id']);
                $table->dropColumn('registration_type_id');
            });
        }

        if (!Schema::hasColumn('registrations', 'registration_type')) {
            Schema::table('registrations', function (Blueprint $table) {
                $table->enum('registration_type', ['Reguler', 'CBT'])->after('registration_period_id');
            });
        }
    }
};
