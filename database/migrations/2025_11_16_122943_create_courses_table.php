<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructorID')->constrained('instructors')->cascadeOnDelete();
            $table->string('title');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('thumbnail')->nullable();
            $table->timestamps();

            $table->index('instructorID');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};