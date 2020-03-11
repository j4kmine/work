<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog', function($table) {
            $table->string('title')->nullable()->change();
            $table->string('summary')->nullable()->change();
            $table->longText('body')->nullable()->change();
            $table->string('keyword')->nullable()->change();
            $table->string('path')->nullable()->change();
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
