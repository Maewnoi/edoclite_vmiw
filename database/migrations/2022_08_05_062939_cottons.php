<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cottons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cottons', function (Blueprint $table) {
            $table->id('cottons_id');
            $table->string('cottons_name');
            $table->integer('cottons_group');
            $table->timestamp('cottons_created_at')->nullable();
            $table->timestamp('cottons_updated_at')->nullable();
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
        Schema::dropIfExists('cottons');
    }
}
