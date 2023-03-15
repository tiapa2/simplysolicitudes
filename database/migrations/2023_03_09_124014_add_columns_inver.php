<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->string('monto_inv_1')->after('id_inv_1')->nullable($value = true);
            $table->string('monto_inv_2')->after('id_inv_2')->nullable($value = true);
            $table->string('monto_inv_3')->after('id_inv_3')->nullable($value = true);
            $table->string('monto_inv_4')->after('id_inv_4')->nullable($value = true);
            $table->string('monto_inv_5')->after('id_inv_5')->nullable($value = true);
            $table->string('monto_inv_6')->after('id_inv_6')->nullable($value = true);
            $table->string('monto_inv_7')->after('id_inv_7')->nullable($value = true);
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
