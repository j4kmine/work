<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKotaWithHarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('kota')){ 
            Schema::create('kota', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama')->nullable();
                $table->string('longitude')->nullable();
                $table->string('latitude')->nullable();
                $table->integer('id_negara')->nullable();
                $table->string('origin')->nullable();
                $table->string('U_DTD_GC_50+',255)->default('0');
                $table->string('U_DTD_GC_100+',255)->default('0');
                $table->string('U_DTD_GC_350+',255)->default('0');
                $table->string('U_DTD_GC_500+',255)->default('0');
                $table->string('U_DTD_GC_1000+',255)->default('0');
                $table->string('L_DTD_GC_LCL_2+',255)->default('0');
                $table->string('L_DTD_GC_LCL_6+',255)->default('0');
                $table->string('L_DTD_GC_LCL_10+',255)->default('0');
                $table->string('L_DTD_GC_FCL_20ft',255)->default('0');
                $table->string('L_DTD_GC_FCL_40ft',255)->default('0');
                $table->string('U_DTP_GC_50+',255)->default('0');
                $table->string('U_DTP_GC_100+',255)->default('0');
                $table->string('U_DTP_GC_350+',255)->default('0');
                $table->string('U_DTP_GC_500+',255)->default('0');
                $table->string('U_DTP_GC_1000+',255)->default('0');
                $table->string('L_DTP_GC_LCL_2',255)->default('0');
                $table->string('L_DTP_GC_LCL_3',255)->default('0');
                $table->string('L_DTP_GC_LCL_4',255)->default('0');
                $table->string('L_DTP_GC_LCL_5',255)->default('0');
                $table->string('L_DTP_GC_LCL_6',255)->default('0');
                $table->string('L_DTP_GC_LCL_7',255)->default('0');
                $table->string('L_DTP_GC_LCL_8',255)->default('0');
                $table->string('L_DTP_GC_LCL_9',255)->default('0');
                $table->string('L_DTP_GC_LCL_10',255)->default('0');
                $table->string('L_DTP_GC_FCL_20ft',255)->default('0');
                $table->string('L_DTP_GC_FCL_40ft',255)->default('0');
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
        Schema::dropIfExists('kota');
    }
}
