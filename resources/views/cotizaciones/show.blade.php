@extends('layouts.app')
@section('title', '| Ver Cotizacion')
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
        <a href="{{url('cotizaciones/invoice') .'/' . $orders[0]->id}}">
                                            <button class="btn btn-xs btn-white">
                                                <i aria-hidden="true" class="fa fa-download">
                                                </i>
                                                Descargar Cotizacion
                                            </button>
                                        </a>
        <a href="{{url('cotizaciones/imprimir') .'/' . $orders[0]->id . '/1'}}" target="_blanck">
                                            <button class="btn btn-xs btn-white">
                                                <i aria-hidden="true" class="fa fa-print">
                                                </i>
                                                Imprimir Cotizacion
                                            </button>
                                        </a>

    <div class="panel panel-default">
        <div class="panel-body">
           <table cellspacing="0" style="width: 100%;">
        <tr>

           {{--  <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="" alt=""><br>
                
            </td> --}}

        @foreach($empresas as $empresa)
            <td style="width: 75%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold">{{$empresas[0]->ph_name}}</span>
                <br> {{$empresas[0]->ph_caracteristicas}}
                <br>RUC: {{$empresas[0]->ph_ruc}}
                <br>{{$empresas[0]->ph_address}}<br> 
                Teléfono: {{$empresas[0]->ph_telephone}}<br>
                Email: {{$empresas[0]->ph_email}}
                
            </td>
        @endforeach
            <td style="width: 25%;text-align:right">
             COTIZACION N°: {{$orders[0]->codigogenerado}}
            </td>
            
        </tr>
    </table>
    <br>
    

    
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>DATOS DEL CLIENTE</td>
        </tr>
        <tr>
           <td style="width:50%;" >
                {{$orders[0]->cliente}}
                <br>
                {{$orders[0]->cDnicRuc}}
           </td>
        </tr>
    </table>
    
       <br>
        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:35%;" class='midnight-blue'>USUARIO</td>
          <td style="width:25%;" class='midnight-blue'>FECHA COTIZACION</td>
        </tr>
        <tr>
           <td style="width:35%;">
            {{$orders[0]->email}}
           </td>
          <td style="width:25%;">{{$orders[0]->FechaDocumento}}</td>
        </tr>
        
        
   
    </table>
    <br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 10%;text-align:center" class='midnight-blue'>CANT.</th>
            <th style="width: 60%" class='midnight-blue'>DESCRIPCION</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>
            
        </tr>
         @foreach($ordendetalles as $ordendetalle)
            <tr>
                    <td  style="width: 10%; text-align: center">{{$ordendetalle->quantity}}</td>
                    <td  style="width: 60%; text-align: left">{{$ordendetalle->p_gname}}</td>
                    <td  style="width: 15%; text-align: right">{{number_format($ordendetalle->price,2)}}</td>
                    <td  style="width: 15%; text-align: right">{{number_format($ordendetalle->SubTotal,2)}}</td>
                    
                </tr>
        @endforeach 
      
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL S/. </td>
            <td style="width: 15%; text-align: right;"> {{number_format($orders[0]->SubTotal,2)}}</td>
        </tr>
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">IGV S/. </td>
            <td style="width: 15%; text-align: right;"> {{number_format($orders[0]->IGv,2)}}</td>
        </tr>
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL S/. </td>
            <td style="width: 15%; text-align: right;"> {{number_format($orders[0]->Total,2)}}</td>
        </tr>
    </table>
    
    
    
    <br>
    <div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por confiar en nosotros. Lo Esperamos pronto...</div>
        </div>  <!-- end div .panel-body -->
    </div>  <!-- end div .panel -->

@endsection
