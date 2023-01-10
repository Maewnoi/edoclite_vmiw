<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubDocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sub_docs', function (Blueprint $table) {
            $table->id('sub_id');
            $table->integer('sub_docid');
            $table->integer('sub_recnum')->nullable();
            $table->date('sub_date')->nullable();
            $table->time('sub_time')->nullable();
            $table->integer('sub_recid');
            $table->integer('sub_cotton');
            $table->enum('sub_status', array('0', '1', '2', '3', '4', '5', '6', '7', '8'))->default('0');
            $table->enum('sub_check', array('0', '1'))->default('0');
            $table->timestamp('sub_created_at')->nullable();
            $table->timestamp('sub_updated_at')->nullable();

            $table->string('seal_recname_0')->nullable();
            $table->string('seal_detail_0')->nullable();
            $table->string('seal_note_0')->nullable();
            $table->string('seal_pos_0')->nullable();
            $table->dateTime('seal_date_0')->nullable();
            $table->integer('seal_id_0')->nullable();

            $table->string('seal_recname_1')->nullable();
            $table->string('seal_detail_1')->nullable();
            $table->string('seal_note_1')->nullable();
            $table->string('seal_pos_1')->nullable();
            $table->dateTime('seal_date_1')->nullable();
            $table->integer('seal_id_1')->nullable();

            $table->string('seal_recname_2')->nullable();
            $table->string('seal_detail_2')->nullable();
            $table->string('seal_note_2')->nullable();
            $table->string('seal_pos_2')->nullable();
            $table->dateTime('seal_date_2')->nullable();
            $table->integer('seal_id_2')->nullable();

            $table->string('seal_recname_3')->nullable();
            $table->string('seal_detail_3')->nullable();
            $table->string('seal_note_3')->nullable();
            $table->string('seal_pos_3')->nullable();
            $table->dateTime('seal_date_3')->nullable();
            $table->integer('seal_id_3')->nullable();

            $table->string('seal_recname_4')->nullable();
            $table->string('seal_detail_4')->nullable();
            $table->string('seal_note_4')->nullable();
            $table->string('seal_pos_4')->nullable();
            $table->dateTime('seal_date_4')->nullable();
            $table->integer('seal_id_4')->nullable();

            $table->string('seal_recname_5')->nullable();
            $table->string('seal_detail_5')->nullable();
            $table->string('seal_note_5')->nullable();
            $table->string('seal_pos_5')->nullable();
            $table->dateTime('seal_date_5')->nullable();
            $table->integer('seal_id_5')->nullable();

            $table->string('seal_file')->nullable();
            $table->text('seal_file_group_ca')->nullable();
            $table->text('seal_file_division_ca')->nullable();
            $table->text('seal_file_department_ca')->nullable();
            $table->integer('seal_point')->nullable();
            $table->string('seal_file2')->nullable();
            $table->string('seal_recid')->nullable();
            $table->date('seal_recdate')->nullable();
            $table->string('sub_resendby')->nullable();
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
        Schema::dropIfExists('sub_docs');
    }
}
