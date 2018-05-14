<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id');
            $table->integer('provincia_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('codigo_postal');
            $table->integer('rango_desde');
            $table->integer('rango_hasta');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
