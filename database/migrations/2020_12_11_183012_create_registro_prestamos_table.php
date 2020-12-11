<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroPrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_prestamos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("numero_cuenta",11);
            $table->date("fecha")->nullable();
            $table->integer("cantidad")->default(0);
            $table->foreignId("id_recurso")->references("id")->on("recursos");
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
        Schema::dropIfExists('registro_prestamos');
    }
}
