<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNegara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('negara')){ 
            Schema::create('negara', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama')->nullable();
                $table->string('longitude')->nullable();
                $table->string('latitude')->nullable();
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
        Schema::dropIfExists('negara');
    }
}
