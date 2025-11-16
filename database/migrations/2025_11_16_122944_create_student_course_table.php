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
            $table->foreignId('studentID')->constrained('students')->cascadeOnDelete();
            $table->foreignId('courseID')->constrained('courses')->cascadeOnDelete();
            $table->tinyInteger('completion')->default(0)->comment('0-100 progress percent');
            $table->boolean('completed')->default(false);
            $table->timestamps();

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