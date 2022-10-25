<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReserveNumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('reserve_numbers', function (Blueprint $table) {
            $table->id('reserve_id');
            $table->integer('reserve_number');
            $table->string('reserve_topic')->nullable();
            $table->dateTime('reserve_date');
            $table->enum('reserve_status', array('0', '1', '2'))->comment('0=จอง,1=ใช้งานแล้ว,2=ว่าง')->default('0');
            $table->string('reserve_type');
            $table->enum('reserve_template', array('A', 'B', 'C', 'D', 'E'));
            $table->integer('reserve_used')->nullable();
            $table->integer('reserve_group')->nullable();
            $table->integer('reserve_owner');
            $table->integer('reserve_site');
            $table->timestamp('reserve_created_at')->nullable();
            $table->timestamp('reserve_updated_at')->nullable();
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
        Schema::dropIfExists('reserve_numbers');
    }
}
