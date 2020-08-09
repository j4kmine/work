<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQtyPackageToRelItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rel_item', function (Blueprint $table) {
            $table->integer('qty_barang')->nullable();
            $table->integer('id_package_barang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rel_item', function (Blueprint $table) {
            $table->dropColumn('qty_barang');
            $table->dropColumn('id_package_barang');
        });
    }
}
