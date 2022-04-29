<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //사용자 정보 테이블(users)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nickname');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->rememberToken();
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->unique('nickname');
            $table->unique('email');

            $table->index('email');
            $table->index('nickname');
            $table->index('created_at');
            $table->index('deleted_at');
        });

        //기기 시리얼 번호 테이블
        Schema::create('serials', function (Blueprint $table){
            $table->id();
            $table->string('code');
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->unique('code');

            $table->index('code');
            $table->index('created_at');
            $table->index('deleted_at');
        });

        //식물 정보 테이블(plants)
        Schema::create('plants', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('serial_id');
            $table->string('plantname');
            $table->string('crops_code');
            $table->timestampTz('device_verification_at')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('serial_id')->references('id')->on('serials')->onDelete('cascade');

            $table->index('plantname');
            $table->index('created_at');
            $table->index('deleted_at');
        });

        //아두이노 송신값 테이블(arduinos)
        Schema::create('arduinos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plant_id');
            $table->unsignedSmallInteger('humidity');
            $table->smallInteger('temp');
            $table->unsignedSmallInteger('humidity_soil');
            $table->unsignedSmallInteger('illuminance');
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plant_id')->references('id')->on('users')->onDelete('cascade');

            $table->index('humidity');
            $table->index('temp');
            $table->index('humidity_soil');
            $table->index('illuminance');
            $table->index('created_at');
            $table->index('deleted_at');
        });

        //사용자 토큰값 테이블(personal_access_tokens)
        // DB::statement('CREATE DATABASE IF NOT EXISTS `personal_access_tokens`');
        // Schema::create('personal_access_tokens', function (Blueprint $table) {
        //     $table->id();
        //     $table->morphs('tokenable');
        //     $table->string('name');
        //     $table->string('token', 64)->unique();
        //     $table->text('abilities')->nullable();
        //     $table->timestamp('last_used_at')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plants');
        Schema::dropIfExists('arduinos');
        Schema::dropIfExists('serials');
        Schema::dropIfExists('users');
        // Schema::dropIfExists('personal_access_tokens');
    }
};
