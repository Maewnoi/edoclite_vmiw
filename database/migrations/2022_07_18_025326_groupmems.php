<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Groupmems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('groupmems', function (Blueprint $table) {
            $table->id('group_id');
            $table->integer('group_site_id');
            $table->string('group_name')->nullable();
            $table->string('group_token')->nullable();
            $table->string('group_seal')->nullable();
            $table->timestamp('group_created_at')->nullable();
            $table->timestamp('group_updated_at')->nullable();
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
        Schema::dropIfExists('groupmems');
    }
}
