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
        Schema::table('student_biodatas', function (Blueprint $table) {
            $table->string('kk_path')->nullable()->after('photo_path'); // Kartu Keluarga
            $table->string('ktp_path')->nullable()->after('kk_path'); // KTP
            $table->string('certificate_path')->nullable()->after('ktp_path'); // Ijazah/SKL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_biodatas', function (Blueprint $table) {
            $table->dropColumn(['kk_path', 'ktp_path', 'certificate_path']);
        });
    }
};
