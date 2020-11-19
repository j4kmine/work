<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function($table) {
            $table->string('lastname')->nullable();
            $table->timestamp('datebirth')->nullable();
            $table->string('membershiptype')->nullable();
            $table->string('membershifee')->nullable();
            $table->string('ccnumber')->nullable();
            $table->string('cctype')->nullable();
            $table->string('ccexpiremonth')->nullable();
            $table->string('ccexpireyear')->nullable();
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
    }
}
