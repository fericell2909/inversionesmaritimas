@extends('layouts.app')
@section('title', '| Reportes de Consultas Medicas')
@section('content')
	<div class="panel panel-default">
		<h2 class="text-center text-info">Reporte de Consultas Medicas</h2>
		<div class="panel-body">
			<div class="dropdown" id="pdfgenerate">
                        <button class="btn btn-sm btn-info  dropdown-toggle" data-toggle="dropdown">
                            @lang('products.inventory')
                            <span class="caret">
                    </span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/sales/pdfmedicas/0')}}"> Todos </a></li>
                            <li><a href="{{url('/sales/pdfmedicas/1')}}"> Semana </a></li>
                            <li><a href="{{url('/sales/pdfmedicas/2')}}"> Mes </a></li>
                            <li><a href="{{url('/sales/pdfmedicas/3')}}"> 6 Meses </a></li>
                            <li><a href="{{url('/sales/pdfmedicas/4')}}"> Año </a></li>
                        </ul>
                    </div>
			<div class="col-md-12 col-sm-12">
                    <div class="table-responsive" id="divProductTable">
                        <table class="table table-responsive results">
                            <tr>
                                <th>
                                    @lang('sales.invoiceno')
                                </th>
                                <th>
                                    @lang('sales.products')
                                </th>
                                <th>
                                    @lang('sales.tprice')
                                </th>
                                <th>
                                    @lang('sales.saledate')
                                </th>
                                <th class="text-center" >
                                    @lang('sales.control')
                                </th>
                            </tr>
                            <tbody id="salesDivBoxAjax">
                            </tbody>
                            <tbody id="salesDivBox">
                            @foreach($sales as $sale)
                                <tr>
                                    <td>
                                        {{  $sale->invoice_no   }}
                                    </td>
                                    <td style="word-break: break-all;">
                                        {{  $sale->name }}
                                    </td>
                                    <td>
                                        <small style="float: left;">
                                            {{get_currencySymbols() }}
                                        </small>
                                        {{  number_format($sale->price,2) }}
                                    </td>
                                    <td>
                                        {{  date('d-M-Y', strtotime($sale->created_at)) }}
                                    </td>
                                    <td>
                                        <a href="{{url('sales/invoice') .'/' . $sale->id}}">
                                            <button class="btn btn-xs btn-white">
                                                <i aria-hidden="true" class="fa fa-download">
                                                </i>
                                                @lang('button.download')
                                            </button>
                                        </a>
                                        <a href="{{route('sales.show',$sale->id) }}">
                                            <button class="btn btn-xs btn-white">
                                                <i aria-hidden="true" class="fa fa-eye">
                                                </i>
                                                @lang('button.show')
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-left">
                            {{$sales->links()}}
                        </div>
                    </div> <!-- end div #divProductTable -->
                </div>
		</div>
	</div>
@endsection