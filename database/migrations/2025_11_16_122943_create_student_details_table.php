<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->unsignedBigInteger('studentID')->primary();
            $table->foreign('studentID')->references('id')->on('students')->cascadeOnDelete();
            $table->string('fullname')->nullable();
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_details');
    }
};