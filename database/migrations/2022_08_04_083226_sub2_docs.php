<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sub2Docs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sub2_docs', function (Blueprint $table) {
            $table->id('sub2_id');
            $table->integer('sub2_docid');
            $table->integer('sub2_subid');
            $table->integer('sub2_sendid');
            $table->integer('sub2_recid');
            $table->enum('sub2_status', array('0', '1'))->default('0');
            $table->enum('sub2_check', array('0', '1'))->default('0');
            $table->timestamp('sub2_created_at')->nullable();
            $table->timestamp('sub2_updated_at')->nullable();
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
        Schema::dropIfExists('sub2_docs');
    }
}
