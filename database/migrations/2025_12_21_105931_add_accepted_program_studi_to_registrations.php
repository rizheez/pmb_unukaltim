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
            // Program studi yang diterima (bisa dari choice_1 atau choice_2)
            $table->foreignId('accepted_program_studi_id')
                ->nullable()
                ->after('acceptance_notes')
                ->constrained('program_studi')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign(['accepted_program_studi_id']);
            $table->dropColumn('accepted_program_studi_id');
        });
    }
};
