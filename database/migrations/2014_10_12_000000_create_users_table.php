<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('site_id');
            $table->string('name')->comment('ชื่อนามสกุล'); //ชื่อนามสกุล
            $table->string('email')->unique()->comment('เมลหรือชื่อผู้ใช้'); //เมลหรือชื่อผู้ใช้
            $table->string('pos')->nullable()->comment('ตำแหน่งพิมพ์เอา'); //ตำแหน่งพิมพ์เอา
            $table->integer('group')->nullable()->comment('กองงาน'); //กองงาน
            $table->integer('cotton')->nullable()->comment('กองงาน'); //ฝ่าย
            $table->string('tel')->comment('เบอร์โทรติดต่อ'); //เบอร์โทรติดต่อ
            $table->enum('submem', ['0', '1'])->nullable()->comment('ไม่รู้อะไร'); //ไม่รู้อะไร
            $table->string('sign')->nullable()->comment('รูปลายเซ็น'); //รูปลายเซ็น
            $table->string('head')->nullable()->comment('ไม่รู้อะไร'); //ไม่รู้อะไร
            $table->string('password')->comment('รหัสผ่าน'); //รหัสผ่าน
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->enum('level', ['0', '1', '2', '3', '4', '5', '6', '7'])->comment('0=แอดมิน\1=นายก\2=รองนายก,ปลัด,รองปลัด\3=สารบรรณกลาง\4=หัวหน้ากอง\5=หัวหน้าฝ่าย\6=สารบรรณกอง\7=งาน'); //สิทธิ์การเข้าถึง  0=แอดมิน\1=นายก\2=รองนายก,ปลัด,รองปลัด\3=สารบรรณกลาง\4=หัวหน้ากอง\5=หัวหน้าฝ่าย\6=สารบรรณกอง\7=งาน
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}