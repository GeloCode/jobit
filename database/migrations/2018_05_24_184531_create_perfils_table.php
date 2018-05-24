<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->integer('portfolio_id')->unsigned();
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onUpdate('cascade');
            $table->string('name');            
            $table->string('telefono');
            $table->string('direccion');
            $table->string('codigo_postal');
            $table->string('lenguajes');            
            $table->string('frameworks');            
            $table->text('descripcion');
            $table->binary('imagen');
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
        Schema::dropIfExists('perfils');
    }
}
