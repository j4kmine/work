<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('address')){ 
            Schema::create('address', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_user');
                $table->string('company',255)->nullable();
                $table->string('no_hp')->nullable();
                $table->string('email')->nullable();
                $table->integer('tipe_user')->nullable();
                $table->string('catatan',255)->nullable();
                $table->timestamps();
                $table->string('created_by')->nullable();
                $table->string('modified_by')->nullable();
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
        Schema::dropIfExists('address');
    }
}
