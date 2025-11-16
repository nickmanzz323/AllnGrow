<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studentID'); // Ubah ini
            $table->unsignedBigInteger('courseID'); // Ubah ini
            $table->tinyInteger('completion')->default(0)->comment('0-100 progress percent');
            $table->boolean('completed')->default(false);
            $table->timestamps();

            // Foreign key terpisah
            $table->foreign('studentID')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');

            $table->foreign('courseID')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('cascade');

            $table->unique(['studentID', 'courseID']);
            $table->index('studentID');
            $table->index('courseID');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_course');
    }
};