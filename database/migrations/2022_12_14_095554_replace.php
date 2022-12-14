<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Replace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('replaces', function (Blueprint $table) {
            $table->id('replace_id');
            $table->string('replace_user_id');
            $table->string('replace_user_id_acting');
            $table->timestamp('replace_created_at')->nullable();
            $table->timestamp('replace_updated_at')->nullable();
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
