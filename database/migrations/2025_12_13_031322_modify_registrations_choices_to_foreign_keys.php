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
            // Drop old string columns
            $table->dropColumn(['choice_1', 'choice_2', 'choice_3']);
        });

        Schema::table('registrations', function (Blueprint $table) {
            // Add new foreign key columns
            $table->foreignId('choice_1')->nullable()->constrained('program_studi')->nullOnDelete();
            $table->foreignId('choice_2')->nullable()->constrained('program_studi')->nullOnDelete();
            $table->foreignId('choice_3')->nullable()->constrained('program_studi')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Drop foreign key columns
            $table->dropForeign(['choice_1']);
            $table->dropForeign(['choice_2']);
            $table->dropForeign(['choice_3']);
            $table->dropColumn(['choice_1', 'choice_2', 'choice_3']);
        });

        Schema::table('registrations', function (Blueprint $table) {
            // Restore old string columns
            $table->string('choice_1')->nullable();
            $table->string('choice_2')->nullable();
            $table->string('choice_3')->nullable();
        });
    }
};
