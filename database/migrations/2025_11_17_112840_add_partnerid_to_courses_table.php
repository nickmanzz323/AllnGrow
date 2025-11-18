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
        Schema::table('courses', function (Blueprint $table) {
            // add partner id (nullable)
            $table->unsignedBigInteger('partner_id')->nullable()->after('category_id');

            // fk - partner
            $table->foreign('partner_id')
                ->references('id')
                ->on('partners')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            //
            // Hapus fk
            $table->dropForeign(['partner_id']);

            // hapus kolom
            $table->dropColumn('partner_id');
        });
    }
};
