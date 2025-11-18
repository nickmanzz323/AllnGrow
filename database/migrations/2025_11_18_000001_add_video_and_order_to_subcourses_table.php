<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('subcourses', function (Blueprint $table) {
            // Add columns if they don't exist (works for both MySQL and SQLite)
            if (!Schema::hasColumn('subcourses', 'description')) {
                $table->text('description')->nullable()->after('title');
            }

            if (!Schema::hasColumn('subcourses', 'video_url')) {
                $table->string('video_url')->nullable()->after('content');
            }

            if (!Schema::hasColumn('subcourses', 'order')) {
                $table->integer('order')->default(0)->after('video_url');
            }
        });
    }

    public function down()
    {
        Schema::table('subcourses', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('subcourses', 'description')) {
                $columns[] = 'description';
            }
            if (Schema::hasColumn('subcourses', 'video_url')) {
                $columns[] = 'video_url';
            }
            if (Schema::hasColumn('subcourses', 'order')) {
                $columns[] = 'order';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
