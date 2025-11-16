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
            $table->unsignedBigInteger('instructorID'); // Ubah ini
            $table->string('title');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('thumbnail')->nullable();
            $table->timestamps();

            // Foreign key terpisah
            $table->foreign('instructorID')
                  ->references('id')
                  ->on('instructors')
                  ->onDelete('cascade');

            $table->index('instructorID');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};