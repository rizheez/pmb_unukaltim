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
        Schema::create('document_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_biodata_id')->constrained()->onDelete('cascade');
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // Admin yang verifikasi
            $table->enum('document_type', ['kk', 'ktp', 'certificate', 'photo', 'biodata']); // Jenis dokumen/data
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable(); // Catatan dari admin
            $table->timestamp('verified_at')->nullable();
            $table->boolean('is_read')->default(false); // Apakah sudah dibaca student
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_verifications');
    }
};
