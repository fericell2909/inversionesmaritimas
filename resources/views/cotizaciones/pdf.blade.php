<html>
<head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;

        }

        th, td {
            text-align: left;
            padding: 1px;
            word-break: break-all;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>
</head>
<body>

<table cellspacing="0" style="width: 100%;">
        <tr>

{{--             <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="" alt="Logo"><br>
                
            </td> --}}
            <td style="width: 75%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold">{{$empresas[0]->ph_name}}</span>
                <br> {{$empresas[0]->ph_caracteristicas}}
                <br>RUC: {{$empresas[0]->ph_ruc}}
                <br>{{$empresas[0]->ph_address}}<br>

                Teléfono: {{$empresas[0]->ph_telephone}}<br>
                Email: {{$empresas[0]->ph_email}}
                
            </td>
        </tr>
    </table>
    <br>

<table>
    <tr>
        <th style="background:black;color:white;">Documento</th>
        <th style="background:black;color:white;">Cliente</th>
        <th style="background:black;color:white;">Precio Total</th>
        <th style="background:black;color:white;">Fecha de Venta</th>

    </tr>
    @foreach($sales as $sale)
        <tr>
            <td>{{$sale->invoice_no}}</td>
            <td>{{$sale->name}}</td>
            <td>{{number_format($sale->price,2)}}</td>
            <td>{{$sale->created_at}}</td>
        </tr>
    @endforeach
        <tr>
            <td colspan="2" style="text-align: right;border-left: 1px solid #fff;border-bottom: 1px solid #fff; border-right: 1px solid #fff;">Total de Ventas : </td>
            <td style="text-align: center;border-bottom: 1px solid #fff; border-right: 1px solid #fff;">{{number_format($cantidadtotalvendida,2)}}</td>
        </tr>

</table>

</body>
</html>
