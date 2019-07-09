<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Movimientos de Almacen</title>
    <body>
        
 <table cellspacing="0" style="width: 100%;border-bottom: 1px solid #000;">
        <tr>

        @foreach($empresas as $empresa)
            <td style="width: 100%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold">{{$empresas[0]->ph_name}}</span>
                <br> {{$empresas[0]->ph_caracteristicas}}
                <br>RUC: {{$empresas[0]->ph_ruc}}
                <br>{{$empresas[0]->ph_address}}<br> 
                Teléfono: {{$empresas[0]->ph_telephone}}<br>
                Email: {{$empresas[0]->ph_email}}
                
            </td>
        @endforeach
        <td style="width: 0%;text-align:right">
        </td>
        </tr>
    </table>
    <br>
  	<p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="background: #2c3e50;color:#fff;padding: 10px;">REPORTE DE MOVIMIENTOS DE ALMACEN</span></p>	
    <br>    
    @foreach($productos as $producto)    
        <p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="color:#000;padding: 10px;"> Nombre Generico: {{$producto->p_gname}}</span></p>
        <br>
        <p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="color:#000;padding: 10px;"> Nombre Comercial : {{$producto->p_bname}}</span></p>
    @endforeach
        
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;border:1px solid #000;">
        <tr>
            <th style="width: 10%;text-align:center;color:#fff;border-right: 1px solid #fff;background-color: #2c3e50;" class='midnight-blue'>Fecha de Operacion</th>
            <th style="width: 10%;text-align:center;color:#fff;;border-right: 1px solid #fff;background-color: #2c3e50;" class='midnight-blue'>Tipo Movimiento</th>
            <th style="width: 10%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'>Descripcion</th>
            <th style="width: 10%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'>Correo Usuario</th>
            <th style="width: 10%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'> Ingreso</th>
            <th style="width: 10%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'> Salida</th>
            <th style="width: 10%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'> Saldo</th>
            
        </tr>
        
        @if(count($movimientos) > 0)
            @foreach($movimientos as $movimiento)
                <tr>
                    <td  style="width: 10%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">{{$movimiento->FechaOperacion}}</small></td>
                    <td  style="width: 10%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">{{$movimiento->SubTipoOperacion}}</small></td>
                    <td  style="width: 10%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">{{$movimiento->DescripcionOperacion}}</small></td>
                    <td  style="width: 10%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">{{$movimiento->CorreoUSuarioOperacion}}</small></td>
                    
                    <td  style="text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">
                    @if($movimiento->nIngreso > 0)
                        {{$movimiento->nIngreso}}
                    @else
                        
                    @endif
                    </small></td>

                    <td  style="text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">@if($movimiento->nSalida > 0)
                        {{$movimiento->nSalida}}
                    @else
                        
                    @endif
                    </small></td>

                    <td  style="text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">
                    @if($movimiento->nSaldo > 0)
                        {{$movimiento->nSaldo}}
                    @else
                        
                    @endif
                    </small></td>

                </tr>
            @endforeach  
        @else
            <tr>
                <td colspan="3"  style="text-align: center;""> No se han registrado movimientos para el periodo seleccionado. </td>
            </tr>
        @endif

    </table>
</body>
