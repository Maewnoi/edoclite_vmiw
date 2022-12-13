<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Site extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sites', function (Blueprint $table) {
            $table->id('site_id');
            $table->string('site_name');
            $table->enum('site_number_run', array('0', '1'));
            $table->string('site_path_folder');
            $table->timestamp('site_created_at')->nullable();
            $table->timestamp('site_updated_at')->nullable();
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
        Schema::dropIfExists('sites');
    }
}
