<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Step 1: Add chapter_id and new columns to subcourses
        Schema::table('subcourses', function (Blueprint $table) {
            $table->unsignedBigInteger('chapter_id')->nullable()->after('course_id');
            $table->integer('duration')->nullable()->after('order')->comment('Duration in minutes');
            $table->boolean('is_free')->default(false)->after('duration')->comment('Free preview lesson');

            $table->index('chapter_id');
        });

        // Step 2: Migrate existing data - create chapters from existing subcourses
        $courses = DB::table('courses')->get();

        foreach ($courses as $course) {
            // Create a default chapter for each course
            $chapterId = DB::table('chapters')->insertGetId([
                'course_id' => $course->courseID,
                'title' => 'Bab 1: Pendahuluan',
                'description' => 'Materi utama kursus',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update all subcourses for this course to belong to the new chapter
            DB::table('subcourses')
                ->where('course_id', $course->courseID)
                ->update(['chapter_id' => $chapterId]);
        }

        // Step 3: Make chapter_id required and add foreign key
        Schema::table('subcourses', function (Blueprint $table) {
            $table->unsignedBigInteger('chapter_id')->nullable(false)->change();

            $table->foreign('chapter_id')
                  ->references('id')
                  ->on('chapters')
                  ->onDelete('cascade');
        });

        // Step 4: Rename table from subcourses to lessons
        Schema::rename('subcourses', 'lessons');
    }

    public function down()
    {
        // Rename back to subcourses
        Schema::rename('lessons', 'subcourses');

        // Remove foreign key and new columns
        Schema::table('subcourses', function (Blueprint $table) {
            $table->dropForeign(['chapter_id']);
            $table->dropColumn(['chapter_id', 'duration', 'is_free']);
        });

        // Drop chapters table
        Schema::dropIfExists('chapters');
    }
};
