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
            //
            // add category id (sort by category)
            $table->unsignedBigInteger('partner_id')->after('category_id');

            // fk - category
            $table->foreign('partner_id')
                ->references('id')
                ->on('partners')
                ->onDelete('cascade');

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
