<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Stock de PRODUCTOS</title>
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
  	<p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="background: #2c3e50;color:#fff;padding: 10px;">REPORTE DE STOCK DE PRODUCTOS</span></p>
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;border:1px solid #000;">
        <tr>
            <th style="width: 10%;text-align:left;color:#fff;border-right: 1px solid #fff;background-color: #2c3e50;" class='midnight-blue'>@lang('products.bname')</th>
            <th style="width: 60%;text-align:left;color:#fff;;border-right: 1px solid #fff;background-color: #2c3e50;" class='midnight-blue'>@lang('products.gname')</th>
            <th style="width: 15%;text-align: left;color:#fff;background-color: #2c3e50;" class='midnight-blue'>Stock</th>
            
        </tr>
         @foreach($productos as $producto)
            <tr>
                    <td  style="width: 30%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">{{$producto->p_bname}}</small></td>
                    <td  style="width: 30%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">{{$producto->p_gname}}</small></td>
                    <td  style="width: 40%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">{{$producto->p_quantity}}</small></td>
                </tr>
        @endforeach  
    </table>
</body>
