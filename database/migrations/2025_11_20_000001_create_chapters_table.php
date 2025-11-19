<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index('course_id');
            $table->index('order');
        });

        // Foreign key terpisah
        Schema::table('chapters', function (Blueprint $table) {
            $table->foreign('course_id')
                  ->references('courseID')
                  ->on('courses')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chapters');
    }
};
