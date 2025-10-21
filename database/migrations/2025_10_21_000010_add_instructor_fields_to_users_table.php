<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('level');
            $table->date('dob')->nullable()->after('gender');
            $table->string('phone')->nullable()->after('dob');
            $table->string('country')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('country');
            $table->string('expertise')->nullable()->after('bio');
            $table->integer('years_experience')->nullable()->after('expertise');
            $table->string('linkedin')->nullable()->after('years_experience');
            $table->string('profile_photo')->nullable()->after('linkedin');
            $table->string('cv')->nullable()->after('profile_photo');
            $table->json('certifications')->nullable()->after('cv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gender', 'dob', 'phone', 'country', 'bio',
                'expertise', 'years_experience', 'linkedin',
                'profile_photo', 'cv', 'certifications'
            ]);
        });
    }
};
