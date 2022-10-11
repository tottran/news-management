<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TinTuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('TinTuc')) {
            Schema::create('TinTuc', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('TieuDe');
                $table->string('TieuDeKhongDau');
                $table->text('TomTat');
                $table->longText('NoiDung');
                $table->string('Hinh')->default('');
                $table->integer('NoiBat');
                $table->integer('SoLuotXem')->default(0);
                $table->integer('idLoaiTin')->unsigned();
                $table->foreign('idLoaiTin')->references('id')->on('LoaiTin');
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
        Schema::dropIfExists('TinTuc');
    }
}
