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
            $table->string('fullname')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->text('bio')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });

        Schema::table('student_details', function (Blueprint $table) {
            $table->foreign('studentID')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_details');
    }
};
