<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('course_rating', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('courseID');
            $table->unsignedBigInteger('studentID');
            $table->tinyInteger('rating')->comment('1-5 scale');
            $table->text('review')->nullable();
            $table->timestamps();

            $table->unique(['courseID', 'studentID']);
            $table->index('courseID');
            $table->index('studentID');
        });

        // Foreign keys terpisah
        Schema::table('course_rating', function (Blueprint $table) {
            $table->foreign('courseID')
                  ->references('courseID')
                  ->on('courses')
                  ->onDelete('cascade');

            $table->foreign('studentID')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_rating');
    }
};
