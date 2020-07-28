<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('rel_addons')){ 
            Schema::create('rel_addons', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_order');
                $table->integer('id_item');
                $table->string('title')->nullable();
                $table->string('jumlah')->nullable();
                $table->string('satuan')->nullable();
                $table->string('harga_satuan',1000)->nullable();
                $table->string('harga_total',1000)->nullable();
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
        Schema::dropIfExists('rel_addons');
    }
}
