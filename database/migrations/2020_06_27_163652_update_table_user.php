<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableUser extends Migration
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
            $table->string('negara')->nullable();
            $table->string('perusahaan')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->longText('code')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('negara');
            $table->dropColumn('perusahaan');
            $table->dropColumn('status');
            $table->dropColumn('code');
        });
    }
}
