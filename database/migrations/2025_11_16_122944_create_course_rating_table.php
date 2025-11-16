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
            $table->unsignedBigInteger('courseID'); // Ubah ini
            $table->unsignedBigInteger('studentID'); // Ubah ini
            $table->tinyInteger('rating')->comment('1-5 scale');
            $table->text('review')->nullable();
            $table->timestamps();

            // Foreign key terpisah
            $table->foreign('courseID')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('cascade');

            $table->foreign('studentID')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');

            $table->unique(['courseID', 'studentID']);
            $table->index('courseID');
            $table->index('studentID');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_rating');
    }
};