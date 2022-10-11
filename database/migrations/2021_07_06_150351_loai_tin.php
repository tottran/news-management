<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoaiTin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('LoaiTin')) {
            Schema::create('LoaiTin', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('Ten');
                $table->string('TenKhongDau');
                $table->timestamps();
                $table->integer('idTheLoai')->unsigned();
                $table->foreign('idTheLoai')->references('id')->on('TheLoai');
                $table->unique('Ten');
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
        Schema::dropIfExists('LoaiTin');
    }
}
