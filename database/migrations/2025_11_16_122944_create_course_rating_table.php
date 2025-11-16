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
            $table->foreignId('courseID')->constrained('courses')->cascadeOnDelete();
            $table->foreignId('studentID')->constrained('students')->cascadeOnDelete();
            $table->tinyInteger('rating')->comment('1-5 scale');
            $table->text('review')->nullable();
            $table->timestamps();

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