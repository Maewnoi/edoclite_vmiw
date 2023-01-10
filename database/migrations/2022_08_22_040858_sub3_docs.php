<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sub3Docs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sub3_docs', function (Blueprint $table) {
            $table->id('sub3_id');
            $table->integer('sub3_docid');
            $table->integer('sub3_subid');
            $table->integer('sub3_sub_2id');
            $table->enum('sub3_type', array('0', '1' ,'2'));
            $table->enum('sub3_status', array('C','0','1','2','3','4','5','6','7','8','9'))->default('0');
            $table->string('sub3_note')->nullable();

            $table->enum('sub3_check_0', array('0', '1'))->default('0'); //หัวหน้าฝ่าย 0
            $table->integer('sub3_inspector_0')->nullable();
            $table->dateTime('sub3_datetime_0')->nullable();

            $table->enum('sub3_check_1', array('0', '1'))->default('0'); //หัวหน้ากอง 1
            $table->integer('sub3_inspector_1')->nullable();
            $table->dateTime('sub3_datetime_1')->nullable();

            $table->enum('sub3_check_2', array('0', '1'))->default('0'); //นิติ 2
            $table->integer('sub3_inspector_2')->nullable();
            $table->dateTime('sub3_datetime_2')->nullable();

            $table->string('sub3_sealdetail_0')->nullable(); //หน้าห้องปลัด || หน้าห้องนายก 3
            $table->string('sub3_sealnote_0')->nullable();
            $table->string('sub3_sealpos_0')->nullable();
            $table->dateTime('sub3_sealdate_0')->nullable();
            $table->integer('sub3_sealid_0')->nullable();
            $table->text('sub3_ca_0')->nullable();

            $table->string('sub3_sealdetail_1')->nullable(); //หน้าห้องปลัด || หน้าห้องนายก 4
            $table->string('sub3_sealnote_1')->nullable();
            $table->string('sub3_sealpos_1')->nullable();
            $table->dateTime('sub3_sealdate_1')->nullable();
            $table->integer('sub3_sealid_1')->nullable();
            $table->text('sub3_ca_1')->nullable();

            $table->string('sub3_sealdetail_2')->nullable(); //รองปลัด | ปลัด 5
            $table->string('sub3_sealnote_2')->nullable();
            $table->string('sub3_sealpos_2')->nullable();
            $table->dateTime('sub3_sealdate_2')->nullable();
            $table->integer('sub3_sealid_2')->nullable();
            $table->text('sub3_ca_2')->nullable();

            $table->string('sub3_sealdetail_3')->nullable(); //รองปลัด | ปลัด 6
            $table->string('sub3_sealnote_3')->nullable();
            $table->string('sub3_sealpos_3')->nullable();
            $table->dateTime('sub3_sealdate_3')->nullable();
            $table->integer('sub3_sealid_3')->nullable();
            $table->text('sub3_ca_3')->nullable();

            $table->string('sub3_sealdetail_4')->nullable(); //รองนายก 7
            $table->string('sub3_sealnote_4')->nullable();
            $table->string('sub3_sealpos_4')->nullable();
            $table->dateTime('sub3_sealdate_4')->nullable();
            $table->integer('sub3_sealid_4')->nullable();
            $table->text('sub3_ca_4')->nullable();

            $table->string('sub3_sealdetail_5')->nullable(); //นายก 8
            $table->string('sub3_sealnote_5')->nullable();
            $table->string('sub3_sealpos_5')->nullable();
            $table->dateTime('sub3_sealdate_5')->nullable();
            $table->integer('sub3_sealid_5')->nullable();
            $table->text('sub3_ca_5')->nullable();

            $table->timestamp('sub3_created_at')->nullable();
            $table->timestamp('sub3_updated_at')->nullable();
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
        Schema::dropIfExists('sub3_docs');
    }
}
