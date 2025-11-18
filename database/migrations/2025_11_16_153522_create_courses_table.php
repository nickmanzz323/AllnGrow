<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id('courseID'); // Custom primary key name
            $table->unsignedBigInteger('instructorID');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();

            $table->index('instructorID');
            $table->index('status');
        });

        // Foreign key terpisah
        Schema::table('courses', function (Blueprint $table) {
            $table->foreign('instructorID')
                  ->references('id')
                  ->on('instructors')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
