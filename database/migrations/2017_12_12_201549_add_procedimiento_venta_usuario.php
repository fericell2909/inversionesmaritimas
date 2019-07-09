<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProcedimientoVentaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared('CREATE PROCEDURE usp_laurus_venta_usuario(IN FECHA VARCHAR(10),IN CODIGO INTEGER ) BEGIN select FECHA as FechaVenta,trango.descripcion_rango as FechaVentaHora,reporte.cantidad as cantidad, reporte.total as total
                from (
                SELECT DATE_FORMAT(created_at,"%H") as rango ,sum(nNumeroMedicamentos)  as cantidad,
                        sum(Total) as total
                FROM orders
                WHERE user_id = CODIGO and FechaDocumento = FECHA and nNumeroMedicamentos > 0
                GROUP BY DATE_FORMAT(created_at,"%H")
            ) reporte
            inner join rangohoras trango on trango.string_numero_rango = reporte.rango; END');
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
