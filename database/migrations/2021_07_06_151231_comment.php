<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('Comment')) {
            Schema::create('Comment', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->longText('NoiDung');
                $table->bigInteger('idUser')->unsigned();
                $table->integer('idTinTuc')->unsigned();
                $table->foreign('idUser')->references('id')->on('users');
                $table->foreign('idTinTuc')->references('id')->on('TinTuc');
                $table->timestamps();
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
        Schema::dropIfExists('Comment');
    }
}
