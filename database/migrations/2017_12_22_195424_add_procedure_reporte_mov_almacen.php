<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProcedureReporteMovAlmacen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE PROCEDURE usp_laurus_reporte_mov_almacen(IN anio INTEGER,IN mes_id INTEGER,IN producto_id INTEGER)
                BEGIN
                    SET @cantidad_ingreso_incial = 0;
                    SET @cantidad_stock_actual = 0;
                    SET @fecha_ingreso = date(now());
                    
                    SET @total_ingresos_hasta_fecha = 0;
                    SET @total_ventas_hasta_fecha = 0;
                    SET @saldo_hasta_fecha =0;

                    SET @saldo_inicial_mes = 0;
                    SET @total_ingresos_mes = 0;
                    SET @total_ventas_mes = 0;
    
     
                    SELECT date(p_imdate) , p_cantidad_inicial,
                              p_quantity
                        INTO @fecha_ingreso , @cantidad_ingreso_incial , @cantidad_stock_actual
                    FROM products
                    WHERE  p_id = producto_id;
  
                    SELECT SUM(d.cantidad) 
                        INTO @total_ingresos_hasta_fecha 
                    FROM cab_notaingresos c
                        JOIN det_notaingresos d ON d.cab_nota_ingreso_id = c.id
                    WHERE d.product_id = producto_id AND 
                        date(c.FechaDocumentoIngreso) < DATE_ADD(CONCAT( anio , "-" , mes_id ,"-","01"), INTERVAL 1 MONTH ) and c.estado_id = 1;
  
                    SELECT SUM(s.quantity) 
                        INTO @total_ventas_hasta_fecha
                    FROM orders o
                        JOIN sales s ON s.order_id = o.id
                    WHERE date(o.FechaDocumento) < DATE_ADD(CONCAT( anio , "-" , mes_id ,"-","01"), INTERVAL 1 MONTH ) AND s.product_id = producto_id and o.estado_id = 1;
    
    
                    SET @saldo_hasta_fecha =  @cantidad_ingreso_incial + @total_ingresos_hasta_fecha - @total_ventas_hasta_fecha;
    
                    SELECT  SUM(d.cantidad) 
                        into @total_ingresos_mes
                    FROM cab_notaingresos c
                        JOIN det_notaingresos d ON d.cab_nota_ingreso_id = c.id
                    WHERE d.product_id = producto_id AND 
                        YEAR(c.FechaDocumentoIngreso) = anio AND
                        MONTH(c.FechaDocumentoIngreso) = mes_id and c.estado_id = 1;
        
                    SELECT SUM(s.quantity) 
                        into @total_ventas_mes 
                    FROM orders o
                        JOIN sales s ON s.order_id = o.id
                    WHERE YEAR(o.FechaDocumento) = anio AND
                          MONTH(o.FechaDocumento) = mes_id  AND
                          s.product_id = producto_id and o.estado_id = 1;

    
                    SET @saldo_inicial_mes = @saldo_hasta_fecha + @total_ventas_mes -  @total_ingresos_mes;
    
                    DELETE FROM tmp_movimiento_almacen;
    
                    IF @saldo_inicial_mes > 0 THEN
                    
                        INSERT INTO tmp_movimiento_almacen(anio,mes,product_id,TipoOperacion,SubTipoOperacion,FechaOperacion,DescripcionOperacion,CorreoUSuarioOperacion,nIngreso,nSalida,nSaldo)
                        SELECT anio,mes_id,producto_id,"A","Saldo Inicial",date(CONCAT(anio,"-",mes_id,"-","01")),
                                "Saldo Inicial","admin",0,0,@saldo_inicial_mes;
                        
                    END IF;
    
                    IF YEAR(@fecha_ingreso) = anio and MONTH(@fecha_ingreso) = mes_id  AND @cantidad_ingreso_incial > 0 THEN
                        INSERT INTO tmp_movimiento_almacen(anio,mes,product_id,TipoOperacion,SubTipoOperacion,FechaOperacion,DescripcionOperacion,CorreoUSuarioOperacion,nIngreso,nSalida,nSaldo)
                        SELECT anio,mes_id,producto_id,"I","Ingreso Inicial",@fecha_ingreso,
                                "Ingreso Inicial","",@cantidad_ingreso_incial,0,0;
                    END IF;
    

                    INSERT INTO tmp_movimiento_almacen(anio,mes,product_id,TipoOperacion,SubTipoOperacion,FechaOperacion,DescripcionOperacion,CorreoUSuarioOperacion,nIngreso,nSalida,nSaldo)
                    SELECT anio,mes_id,producto_id,"I","Nota de Ingreso",c.FechaDocumentoIngreso,c.proveedor_nombre,c.usuario_email,d.cantidad,0,0
                    FROM cab_notaingresos c
                        JOIN det_notaingresos d ON d.cab_nota_ingreso_id = c.id
                    WHERE d.product_id = producto_id AND 
                        YEAR(c.FechaDocumentoIngreso) = anio AND
                        MONTH(c.FechaDocumentoIngreso) = mes_id and c.estado_id = 1;
    

    
                    INSERT INTO tmp_movimiento_almacen(anio,mes,product_id,TipoOperacion,SubTipoOperacion,FechaOperacion,DescripcionOperacion,CorreoUSuarioOperacion,nIngreso,nSalida,nSaldo)
                    SELECT  anio,mes_id,producto_id,"S","Salida por Venta",o.FechaDocumento,o.cliente,o.email,0,s.quantity,0
                    FROM orders o
                        JOIN sales s ON s.order_id = o.id
                    WHERE YEAR(o.FechaDocumento) = anio AND
                          MONTH(o.FechaDocumento) = mes_id  AND
                          s.product_id = producto_id and o.estado_id = 1;
    
                    IF @saldo_hasta_fecha > 0 THEN
                    
                        INSERT INTO tmp_movimiento_almacen(anio,mes,product_id,TipoOperacion,SubTipoOperacion,FechaOperacion,DescripcionOperacion,CorreoUSuarioOperacion,nIngreso,nSalida,nSaldo)
                        SELECT anio,mes_id,producto_id,"F","Saldo Final",DATE_ADD(CONCAT( anio , "-" , mes_id ,"-","01"), INTERVAL 1 MONTH ),
                                    "Saldo Final","admin",0,0,@saldo_hasta_fecha;
                    
                    END IF;
    
                    SELECT *
                    FROM tmp_movimiento_almacen;
    
                    END');
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
