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
        Schema::table('registrations', function (Blueprint $table) {
            // Add new foreign key column
            $table->foreignId('registration_path_id')->nullable()->after('registration_type_id')->constrained('registration_paths')->onDelete('set null');

            // Keep the old column for now (we'll migrate data in seeder)
            // $table->string('registration_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign(['registration_path_id']);
            $table->dropColumn('registration_path_id');
        });
    }
};
