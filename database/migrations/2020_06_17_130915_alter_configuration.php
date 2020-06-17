<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterConfiguration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('configuration', function($table) {
            $table->integer('local_charge')->nullable();
            $table->integer('fob')->nullable();
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
        Schema::table('configuration', function($table) {
            $table->dropColumn('local_charge')->nullable();
            $table->dropColumn('fob')->nullable();
        });
    }
}
