<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sub3Details extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sub3_details', function (Blueprint $table) {
            $table->id('sub3d_id');
            $table->integer('sub3d_sub_3id');
            $table->string('sub3d_government')->nullable(); //ส่วนราชการ
            $table->string('sub3d_draft')->nullable(); //ที่ร่าง
            $table->string('sub3d_date')->nullable(); //วันที่
            $table->string('sub3d_topic')->nullable(); //เรื่อง
            $table->string('sub3d_learn')->nullable(); //เรียน
            $table->string('sub3d_podium')->nullable(); //ข้อความตั้งแท่น
            $table->string('sub3d_therefore')->nullable(); //จึงเรียน.
            $table->string('sub3d_pos')->nullable(); //ตำแหน่ง+หมายเหตุ
            $table->enum('sub3d_speed', array('0', '1', '2', '3')); //ชั้นความเร็ว
            $table->string('sub3d_file')->nullable(); //ไฟล์เอกสาร
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('sub3_details');
    }
}
