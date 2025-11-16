<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('instructor_details', function (Blueprint $table) {
            $table->unsignedBigInteger('instructorID')->primary();
            $table->foreign('instructorID')->references('id')->on('instructors')->cascadeOnDelete();
            $table->string('fullname')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->text('bio')->nullable();
            $table->string('country')->nullable();
            $table->string('expertise')->nullable();
            $table->integer('yearsOfExperience')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('cv')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('instructor_details');
    }
};