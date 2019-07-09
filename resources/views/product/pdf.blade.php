<html>
<head>
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
        <th style="background:black;color:white;">@lang('print.gname')</th>
        <th style="background:black;color:white;">@lang('print.bname')</th>
        <th style="background:black;color:white;">@lang('print.imdate')</th>
        <th style="background:black;color:white;">@lang('print.expire')</th>
        <th style="background:black;color:white;">@lang('print.price')</th>
        <th style="background:black;color:white;">@lang('print.orgprice')</th>
        <th style="background:black;color:white;">@lang('print.quantity')</th>
    </tr>
    @foreach($products as $product)
        @if($product->p_id > 1)
            <tr>
                <td>{{$product->p_gname}}</td>
                <td>{{$product->p_bname}}</td>
                <td>{{$product->p_imdate}}</td>
                <td>{{$product->p_exdate}}</td>
                <td>{{$product->p_price}}</td>
                <td>{{$product->p_imprice}}</td>
                <td>{{$product->p_quantity}}</td>
            </tr>
        @endif
    @endforeach
</table>

</body>
</html>
