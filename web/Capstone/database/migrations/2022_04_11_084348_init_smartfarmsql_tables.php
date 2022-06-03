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
            $table->boolean('is_admin')->default(false);
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

        //농사로 API (실내정원용 식물 목록) 테이블
        Schema::create('nongsaro_gardenlists', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('cntntsNo');
            $table->string('cntntsSj');
            $table->string('rtnFileSeCode');
            $table->string('rtnFileSn');
            $table->string('rtnOrginlFileNm', 500);
            $table->string('rtnStreFileNm', 500);
            $table->string('rtnFileCours');
            $table->string('rtnImageDc');
            $table->string('rtnThumbFileNm', 500);
            $table->string('rtnImgSeCode');
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->index('cntntsNo');
            $table->index('cntntsSj');
            $table->index('rtnFileCours');
            $table->index('rtnStreFileNm');
            $table->index('rtnThumbFileNm');
            $table->index('created_at');
            $table->index('deleted_at');
        });

        Schema::create('nongsaro_gardendtls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nongsaro_gardenlist_id');
            $table->string('plntbneNm');
            $table->string('plntzrNm');
            $table->string('distbNm');
            $table->string('fmlCodeNm');
            $table->string('orgplceInfo');
            $table->string('adviseInfo');
            $table->string('growthHgInfo');
            $table->string('growthAraInfo');
            $table->string('lefStleInfo');
            $table->string('prpgtEraInfo');
            $table->string('managelevelCodeNm');
            $table->string('grwtveCodeNm');
            $table->string('grwhTpCodeNm');
            $table->string('hdCodeNm');
            $table->string('frtlzrInfo');
            $table->string('soilInfo');
            $table->string('watercycleSprngCodeNm');
            $table->string('watercycleSummerCodeNm');
            $table->string('watercycleAutumnCodeNm');
            $table->string('watercycleWinterCodeNm');
            $table->text('fncltyInfo');
            $table->string('managedemanddoCodeNm');
            $table->string('clCodeNm');
            $table->string('grwhstleCodeNm');
            $table->string('indoorpsncpacompositionCodeNm');
            $table->string('eclgyCodeNm');
            $table->string('lefmrkCodeNm');
            $table->string('lefcolrCodeNm');
            $table->string('ignSeasonCodeNm');
            $table->string('flclrCodeNm');
            $table->string('fmldecolrCodeNm');
            $table->string('prpgtmthCodeNm');
            $table->string('lighttdemanddoCodeNm');
            $table->string('postngplaceCodeNm');
            $table->string('dlthtsCodeNm');
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->foreign('nongsaro_gardenlist_id')->references('id')->on('nongsaro_gardenlists')->onDelete('cascade');
            $table->index('created_at');
            $table->index('deleted_at');
        });

        //식물 정보 테이블(plants)
        Schema::create('plants', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('serial_id');
            $table->string('plantname');
            $table->unsignedBigInteger('nongsaro_gardenlist_id');
            $table->timestampTz('device_verification_at')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('serial_id')->references('id')->on('serials')->onDelete('cascade');
            $table->foreign('nongsaro_gardenlist_id')->references('id')->on('nongsaro_gardenlists')->onDelete('cascade');

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

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plant_id');
            $table->unsignedBigInteger('filesize');
            $table->string('path');
            $table->string('filename');
            $table->string('originalname');
            $table->string('type');
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
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
        Schema::dropIfExists('files');
        Schema::dropIfExists('plants');
        Schema::dropIfExists('arduinos');
        Schema::dropIfExists('nongsaro_gardendtls');
        Schema::dropIfExists('nongsaro_gardenlists');
        Schema::dropIfExists('serials');
        Schema::dropIfExists('users');
        // Schema::dropIfExists('personal_access_tokens');
    }
};
