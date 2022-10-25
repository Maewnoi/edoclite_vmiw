<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Documents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Documents', function (Blueprint $table) {
            $table->id('doc_id');
            $table->integer('doc_site_id');
            $table->string('doc_year')->nullable();
            $table->integer('doc_recnum')->nullable();
            $table->string('doc_docnum')->nullable();
            $table->date('doc_date');
            $table->time('doc_time');
            $table->date('doc_date_2')->nullable();
            $table->string('doc_origin')->nullable();
            $table->string('doc_title')->nullable();
            $table->string('doc_filedirec')->nullable();
            $table->string('doc_filedirec_1')->nullable();
            $table->string('doc_attached_file')->nullable();
            $table->string('doc_type')->nullable();
            $table->enum('doc_template', array('A', 'B', 'C', 'D', 'E'));
            $table->enum('doc_president_active', array('0', '1', '2'));
            $table->string('doc_note')->nullable();
            $table->string('doc_note2')->nullable();
            $table->enum('doc_speed', array('0', '1', '2', '3'));
            $table->enum('doc_secret', array('0', '1', '2', '3'));
            $table->string('doc_tab')->nullable();
            $table->enum('doc_status', array('waiting', 'success'));
            $table->integer('doc_owner');
            $table->integer('doc_group')->nullable();
            $table->string('seal_point')->default('0');
            $table->string('seal_deteil')->nullable();
            $table->date('seal_date')->nullable();
            $table->timestamp('doc_created_at')->nullable();
            $table->timestamp('doc_updated_at')->nullable();
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
        Schema::dropIfExists('Documents');
    }
}
