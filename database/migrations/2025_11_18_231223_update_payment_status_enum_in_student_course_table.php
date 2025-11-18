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
        // First, add the payment_status column if it doesn't exist
        if (!Schema::hasColumn('student_course', 'payment_status')) {
            Schema::table('student_course', function (Blueprint $table) {
                $table->string('payment_status')->default('pending')->after('completed');
            });
        }

        // Update existing 'paid' to 'confirmed' for consistency
        DB::table('student_course')->where('payment_status', 'paid')->update(['payment_status' => 'confirmed']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert 'confirmed' back to 'paid'
        DB::table('student_course')->where('payment_status', 'confirmed')->update(['payment_status' => 'paid']);

        // Drop the column if we added it
        if (Schema::hasColumn('student_course', 'payment_status')) {
            Schema::table('student_course', function (Blueprint $table) {
                $table->dropColumn('payment_status');
            });
        }
    }
};
