@extends('layouts.app')
@section('title', '| Reporte de Precios de Venta por Producto')
@section('estilos_adicionales')

<style type="text/css">
        table { vertical-align: top; }
        tr    { vertical-align: top; }
        td    { vertical-align: top; }
        .midnight-blue{
            background:#2c3e50;
            padding: 4px 4px 4px;
            color:white;
            font-weight:bold;
            font-size:12px;
        }
        .silver{
            background:white;
            padding: 3px 4px 3px;
        }
        .clouds{
            background:#ecf0f1;
            padding: 3px 4px 3px;
        }
        .border-top{
            border-top: solid 1px #bdc3c7;
            
        }
        .border-left{
            border-left: solid 1px #bdc3c7;
        }
        .border-right{
            border-right: solid 1px #bdc3c7;
        }
        .border-bottom{
            border-bottom: solid 1px #bdc3c7;
        }
        table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
    </style>

@endsection
@section('content')
        <a href="{{url('analysis/rptprecioventa') .'/1'}}">
                                            <button class="btn btn-xs btn-white">
                                                <i aria-hidden="true" class="fa fa-download">
                                                </i>
                                                Descargar Reporte
                                            </button>
                                        </a>
        <a href="{{url('analysis/rptprecioventa') .'/2'}}" target="_blanck">
                                            <button class="btn btn-xs btn-white">
                                                <i aria-hidden="true" class="fa fa-print">
                                                </i>
                                                Imprimir Reporte
                                            </button>
                                        </a>

    {{-- <button class="btn btn-success">VENDER FACTURAS</button>
    <button class="btn btn-success">VENDER BOLETAS</button>
 --}}    <div class="panel panel-default">
        <div class="panel-body">
           <table cellspacing="0" style="width: 100%;border-bottom: 1px solid #000;">
        <tr>

           {{--  <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="" alt=""><br>
                
            </td> --}}

        @foreach($empresas as $empresa)
            <td style="width: 60%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold">{{$empresas[0]->ph_name}}</span>
                <br> {{$empresas[0]->ph_caracteristicas}}
                <br>RUC: {{$empresas[0]->ph_ruc}}
                <br>{{$empresas[0]->ph_address}}<br> 
                Teléfono: {{$empresas[0]->ph_telephone}}<br>
                Email: {{$empresas[0]->ph_email}}
                
            </td>
        @endforeach
        <td style="width: 40%;text-align:right">
             
            </td>
        </tr>
    </table>
    <br>
  	<p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="background: #2c3e50;color:#fff;padding: 10px;">REPORTE DE PRECIO DE VENTA AL PUBLICO</span></p>	
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;border:1px solid #000;">
        <tr>
            <th style="width: 10%;text-align:left;color:#fff;border-right: 1px solid #fff;" class='midnight-blue'>@lang('products.bname')</th>
            <th style="width: 60%;text-align:left;color:#fff;;border-right: 1px solid #fff;" class='midnight-blue'>@lang('products.gname')</th>
            <th style="width: 15%;text-align: left;color:#fff;" class='midnight-blue'>Precio Venta</th>
            
        </tr>
         @foreach($productos as $producto)
            <tr>
                    <td  style="width: 30%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">{{$producto->p_bname}}</small></td>
                    <td  style="width: 30%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">{{$producto->p_gname}}</small></td>
                    <td  style="width: 40%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">{{number_format($producto->p_price,2)}}</small></td>
                </tr>
        @endforeach  
    </table>
@endsection