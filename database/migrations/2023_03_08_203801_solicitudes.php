<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Solicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('solicitudes', function (Blueprint $table) {

            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->string('moneda');
            $table->string('monto');
            $table->string('int_anual');
            $table->string('int_comision');
            $table->string('cuotas');
            $table->string('periodo');
            $table->string('fecha_inicial');
            $table->string('fecha_final');
            $table->string('modalidad');
            $table->string('cant_inversionistas');
            $table->string('estado');
            $table->string('referencia');
            $table->bigInteger('id_inv_1')->unsigned();
            $table->bigInteger('id_inv_2')->unsigned();
            $table->bigInteger('id_inv_3')->unsigned();
            $table->bigInteger('id_inv_4')->unsigned();
            $table->bigInteger('id_inv_5')->unsigned();
            $table->bigInteger('id_inv_6')->unsigned();
            $table->bigInteger('id_inv_7')->unsigned();

            $table->timestamps();
            
            $table->foreign('id_inv_1')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_inv_2')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_inv_3')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_inv_4')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_inv_5')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_inv_6')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_inv_7')->references('id')->on('clientes')->onDelete('cascade');
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
