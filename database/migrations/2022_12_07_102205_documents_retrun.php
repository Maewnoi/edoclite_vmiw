<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocumentsRetrun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Documents_retruns', function (Blueprint $table) {
            $table->id('docrt_id');
            $table->integer('docrt_owner');
            $table->integer('docrt_sites_id');
            $table->integer('docrt_groupmems_id');
            $table->enum('docrt_type', array('0', '1', '2'));
            $table->enum('docrt_status', array('C','0','1','2','3','4','5','6','7','8','9'))->default('0');
            $table->string('docrt_note')->nullable();
            
            $table->enum('docrt_check_0', array('0', '1'))->default('0');//หัวหน้าฝ่าย 0
            $table->integer('docrt_inspector_0')->nullable();
            $table->dateTime('docrt_datetime_0')->nullable();

            $table->enum('docrt_check_1', array('0', '1'))->default('0'); //หัวหน้ากอง 1
            $table->integer('docrt_inspector_1')->nullable();
            $table->dateTime('docrt_datetime_1')->nullable();

            $table->enum('docrt_check_2', array('0', '1'))->default('0'); //นิติ 2
            $table->integer('docrt_inspector_2')->nullable();
            $table->dateTime('docrt_datetime_2')->nullable();

            $table->string('docrt_sealdetail_0')->nullable();//หน้าห้องปลัด || หน้าห้องนายก 3
            $table->string('docrt_sealnote_0')->nullable();
            $table->string('docrt_sealpos_0')->nullable();
            $table->dateTime('docrt_sealdate_0')->nullable();
            $table->integer('docrt_sealid_0')->nullable();

            $table->string('docrt_sealdetail_1')->nullable();//หน้าห้องปลัด || หน้าห้องนายก 4
            $table->string('docrt_sealnote_1')->nullable();
            $table->string('docrt_sealpos_1')->nullable();
            $table->dateTime('docrt_sealdate_1')->nullable();
            $table->integer('docrt_sealid_1')->nullable();

            $table->string('docrt_sealdetail_2')->nullable(); //รองปลัด | ปลัด 5
            $table->string('docrt_sealnote_2')->nullable();
            $table->string('docrt_sealpos_2')->nullable();
            $table->dateTime('docrt_sealdate_2')->nullable();
            $table->integer('docrt_sealid_2')->nullable();

            $table->string('docrt_sealdetail_3')->nullable(); //รองปลัด | ปลัด 6
            $table->string('docrt_sealnote_3')->nullable();
            $table->string('docrt_sealpos_3')->nullable();
            $table->dateTime('docrt_sealdate_3')->nullable();
            $table->integer('docrt_sealid_3')->nullable();

            $table->string('docrt_sealdetail_4')->nullable(); //รองนายก 7
            $table->string('docrt_sealnote_4')->nullable();
            $table->string('docrt_sealpos_4')->nullable();
            $table->dateTime('docrt_sealdate_4')->nullable();
            $table->integer('docrt_sealid_4')->nullable();

            $table->string('docrt_sealdetail_5')->nullable(); //นายก 8
            $table->string('docrt_sealnote_5')->nullable();
            $table->string('docrt_sealpos_5')->nullable();
            $table->dateTime('docrt_sealdate_5')->nullable();
            $table->integer('docrt_sealid_5')->nullable();

            $table->timestamp('docrt_created_at')->nullable();
            $table->timestamp('docrt_updated_at')->nullable();
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
        Schema::dropIfExists('Documents_retruns');
    }
}
