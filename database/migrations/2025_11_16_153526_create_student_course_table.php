<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studentID');
            $table->unsignedBigInteger('courseID');
            $table->tinyInteger('completion')->default(0)->comment('0-100 progress percent');
            $table->boolean('completed')->default(false);
            $table->enum('payment_status', ['pending', 'paid'])->default('pending')->comment('pending = belum dibayar/dikonfirmasi, paid = sudah dikonfirmasi instructor');
            $table->timestamps();

            $table->unique(['studentID', 'courseID']);
            $table->index('studentID');
            $table->index('courseID');
            $table->index('payment_status');
        });

        // Foreign keys terpisah
        Schema::table('student_course', function (Blueprint $table) {
            $table->foreign('studentID')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');

            $table->foreign('courseID')
                  ->references('courseID')
                  ->on('courses')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_course');
    }
};
