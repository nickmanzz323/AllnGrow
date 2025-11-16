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
            $table->unsignedBigInteger('course_id'); // Ubah ini
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('fileUpload')->nullable();
            $table->timestamps();

            // Foreign key terpisah
            $table->foreign('course_id')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('cascade');

            $table->index('course_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subcourses');
    }
};