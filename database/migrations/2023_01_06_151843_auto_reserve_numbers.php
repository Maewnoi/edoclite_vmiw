<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AutoReserveNumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('auto_reserve_numbers', function (Blueprint $table) {
            $table->id('arn_id');
            $table->integer('arn_site_id');
            $table->integer('arn_level');
            $table->integer('arn_user_id');
            $table->integer('arn_quantity')->default('1');
            $table->enum('arn_template', array('receive', 'receive_inside', 'delivery', 'delivery_inside', 'announce', 'order', 'certificate'))->default('0');
            $table->timestamp('arn_created_at')->nullable();
            $table->timestamp('arn_updated_at')->nullable();
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
        Schema::dropIfExists('replaces');
    }
}
