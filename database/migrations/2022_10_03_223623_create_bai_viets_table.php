<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaiVietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bai_viets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->default('');
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('view_counting')->default(0);
            $table->integer('is_special')->default(0);

            $table->bigInteger('idUser')->unsigned();
            $table->integer('idLoaiTin')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idLoaiTin')->references('id')->on('LoaiTin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bai_viets');
    }
}
