<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocumentsRetrunDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Documents_retrun_details', function (Blueprint $table) {
            $table->id('docrtdt_id');
            $table->integer('docrtdt_sub_3id');
            $table->string('docrtdt_government')->nullable(); //ส่วนราชการ
            $table->string('docrtdt_draft')->nullable(); //ที่ร่าง
            $table->string('docrtdt_date')->nullable(); //วันที่
            $table->string('docrtdt_topic')->nullable(); //เรื่อง
            $table->string('docrtdt_learn')->nullable(); //เรียน
            $table->string('docrtdt_podium')->nullable(); //ข้อความตั้งแท่น
            $table->string('docrtdt_therefore')->nullable(); //จึงเรียน.
            $table->string('docrtdt_pos')->nullable(); //ตำแหน่ง+หมายเหตุ
            $table->enum('docrtdt_speed', array('0', '1', '2', '3')); //ชั้นความเร็ว
            $table->string('docrtdt_file')->nullable(); //ไฟล์เอกสาร
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
        Schema::dropIfExists('Documents_retrun_details');
    }
}
