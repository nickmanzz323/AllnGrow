<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subcourses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('fileUpload')->nullable();
            $table->timestamps();

            $table->index('course_id');
        });

        // Foreign key terpisah
        Schema::table('subcourses', function (Blueprint $table) {
            $table->foreign('course_id')
                  ->references('courseID')
                  ->on('courses')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subcourses');
    }
};
