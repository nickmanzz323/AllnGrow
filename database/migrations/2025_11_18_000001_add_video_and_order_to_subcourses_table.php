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
            // Cek apakah kolom description sudah ada
            $hasDescription = DB::select("SHOW COLUMNS FROM subcourses LIKE 'description'");
            if (empty($hasDescription)) {
                $table->text('description')->nullable()->after('title');
            }
            
            // Cek apakah kolom video_url sudah ada
            $hasVideoUrl = DB::select("SHOW COLUMNS FROM subcourses LIKE 'video_url'");
            if (empty($hasVideoUrl)) {
                $table->string('video_url')->nullable()->after('content');
            }
            
            // Cek apakah kolom order sudah ada
            $hasOrder = DB::select("SHOW COLUMNS FROM subcourses LIKE 'order'");
            if (empty($hasOrder)) {
                $table->integer('order')->default(0)->after('video_url');
            }
        });
    }

    public function down()
    {
        Schema::table('subcourses', function (Blueprint $table) {
            $columns = [];
            
            if (DB::select("SHOW COLUMNS FROM subcourses LIKE 'description'")) {
                $columns[] = 'description';
            }
            if (DB::select("SHOW COLUMNS FROM subcourses LIKE 'video_url'")) {
                $columns[] = 'video_url';
            }
            if (DB::select("SHOW COLUMNS FROM subcourses LIKE 'order'")) {
                $columns[] = 'order';
            }
            
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
