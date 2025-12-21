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
        // Update status enum to include extended statuses
        DB::statement("ALTER TABLE registrations MODIFY COLUMN status ENUM(
            'draft',
            'submitted',
            'verified',
            'accepted',
            'rejected',
            're_registration_pending',
            're_registration_verified',
            'enrolled'
        ) DEFAULT 'draft'");

        // Add audit trail columns
        Schema::table('registrations', function (Blueprint $table) {
            $table->timestamp('accepted_at')->nullable()->after('status');
            $table->foreignId('accepted_by')->nullable()->constrained('users')->after('accepted_at');
            $table->text('acceptance_notes')->nullable()->after('accepted_by');

            $table->timestamp('rejected_at')->nullable()->after('acceptance_notes');
            $table->foreignId('rejected_by')->nullable()->constrained('users')->after('rejected_at');
            $table->text('rejection_reason')->nullable()->after('rejected_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign(['accepted_by']);
            $table->dropForeign(['rejected_by']);
            $table->dropColumn([
                'accepted_at',
                'accepted_by',
                'acceptance_notes',
                'rejected_at',
                'rejected_by',
                'rejection_reason',
            ]);
        });

        // Revert to original enum
        DB::statement("ALTER TABLE registrations MODIFY COLUMN status ENUM(
            'draft',
            'submitted',
            'verified',
            'accepted',
            'rejected'
        ) DEFAULT 'draft'");
    }
};
