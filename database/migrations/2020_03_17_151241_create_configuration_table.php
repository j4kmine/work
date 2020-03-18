<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasTable('configuration')){
            Schema::create('configuration', function (Blueprint $table) {
                $table->increments('id');
                $table->string('meta_title')->nullable();
                $table->string('site_title')->nullable();
                $table->longText('meta_description')->nullable();
                $table->longText('meta_keyword')->nullable();
                $table->string('alamat')->nullable();
                $table->string('hp')->nullable();
                $table->string('fax')->nullable();
                $table->string('email')->nullable();
                $table->string('fb')->nullable();
                $table->string('nophone')->nullable();
                $table->string('twitter')->nullable();
                $table->string('instagram')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('configuration');
    }
}
