@extends('layouts.app')
@section('title', '| Productos')
@section('content')
    <div class="panel panel-default">
        <h2 class="text-center text-info">@lang('products.title')</h2>
        <div class="panel-body">
            <!-- BEGIN OPTIONS PANEL -->
            <div id="tablePanel">
                <a href="{{url('/product/create')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> @lang('products.newproduct')
                    </button>
                </a>

                <a href="{{url('/product/notaingreso')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> @lang('products.newproductstock')
                    </button>
                </a>

                <div class="dropdown" id="categoryDropdown">
                    <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                            data-toggle="dropdown">@lang('products.selectcat')
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('/product')}}">Todos</a></li>
                        @foreach($category as $cat)
                            <li><a href="{{url('/product/?cat=').$cat->id}}">{{$cat->name}}</a></li>
                        @endforeach
                    </ul>
                </div> <!-- end div #categoryDropdown -->

                <div class="dropdown" id="pdfgenerate">

                    <button class="btn btn-sm  btn-info dropdown-toggle" data-toggle="dropdown">
                        @lang('products.inventory')
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('/product/pdf/0')}}">Todos</a></li>
                        @foreach($category as $cat)
                            <li><a href="{{url('/product/pdf').'/'.$cat->id}}">{{$cat->name}}</a></li>
                        @endforeach

                    </ul>
                </div> <!-- end div #pdfgenerate -->

            </div>

            <div class="col-md-4" id="searchDiv">
                <div id="custom-search-input">
                    <div class="input-group ">
                        <input type="text" class="form-control input-md" id="SearchProducts" name="search"
                               placeholder="@lang('products.search')"/>
                        <span class="input-group-btn">
                                      <button class="btn btn-info btn-md" type="button">
                                          <i class="fa fa-search" aria-hidden="true"></i>
                                       </button>
                                    </span>
                    </div>
                </div>  <!-- end div #custom-search-input -->
            </div> <!-- end div #searchDiv -->

            <!-- END OPTIONS PANEL -->

            <!-- BEGIN TABLE -->

            <div class="col-md-12 col-sm-12  col-xs-12">
                <div class="table-responsive" id="divProductTable">
                    <table class="table table-hover results">
                        <tr>
                            <th>@lang('products.bname')</th>
                            <th>@lang('products.imagen')</th>
                            <th>@lang('products.subcategory')</th>
                            <th>@lang('products.price')</th>
                            <th>@lang('products.quantity')</th>
                            <th>@lang('products.discount')</th>
                            <th>@lang('products.expire')</th>
                            <th>Tiempo Faltante</th>
                            <th class="text-center" >@lang('products.control')</th>

                        </tr>
                        <tbody id="productDivBoxAjax"></tbody>

                        <tbody id="productDivBox">
                        @foreach($product as $pro)
                            <tr>
                                <td style="vertical-align: middle;text-align: center;">
                                    {{  $pro->p_bname   }}</td>
                                <td style="vertical-align: middle;text-align: center;"><img src="{{asset('upload').'/'.$pro->p_image}}" width="150"></td>
                                <td style="vertical-align: middle;text-align: center;">{{  $pro->name      }}</td>
                                <td style="vertical-align: middle;text-align: center;">
                                    <small style="float: left;"> {{get_currencySymbols() }} </small>{{  $pro->p_price  }}
                                </td>
                                <td id="quantityProduct" style="vertical-align: middle;text-align: center;"> {{-- - $pro->sale_quantity --}}
                                    @if(preg_replace('/[^0-9]/','',$pro->p_quantity  ) < 21 )
                                        <span class="label label-danger" data-toggle="tooltip"
                                              title="Le queda poco de este producto, todo lo que tiene {{ $pro->p_quantity   }}"> SOLO HAY :  {{ $pro->p_quantity  }} </span>
                                    @else
                                       {{--  - $pro->sale_quantity --}}
                                        {{ $pro->p_quantity  }}
                                    @endif</td>
                                <td style="vertical-align: middle;text-align: center;">{{  $pro->p_discount  }}%</td>
                                <td style="vertical-align: middle;text-align: center;">
                                    
                                    @if(strtotime($pro->p_exdate) < strtotime(Carbon\Carbon::now()->addDay(-1)))
                                        <span class="label label-danger" data-toggle="tooltip" title="El producto Vencio en : 
                                    {{ date('d-M-Y', strtotime($pro->p_exdate)) }}"> Producto Vencido </span>
                                    @else
                                        {{ date('d-M-Y', strtotime($pro->p_exdate)) }}
                                    @endif
                                </td>
                                <td style="vertical-align: middle;text-align: center;">
                                    @if(NumerodiferenciaDias($pro->p_exdate) <= 90)
                                            <span class="label label-danger" data-toggle="tooltip" title="El producto Vence el : 
                                    {{ date('d-M-Y', strtotime($pro->p_exdate)) }}">  {{ diferenciaDias($pro->p_exdate)}}  </span>
                                    @else
                                            <span class="label label-success" data-toggle="tooltip" title="El producto Vence el : 
                                    {{ date('d-M-Y', strtotime($pro->p_exdate)) }}">  {{ diferenciaDias($pro->p_exdate)}}  </span>
                                    @endif
                                    
                                       
                                </td>
                                <td style="vertical-align: middle;text-align: center;">
                                    <a href="{{route('product.show', $pro->p_id)}}">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-eye"
                                                                                aria-hidden="true"></i> @lang('button.show')
                                        </button>
                                    </a>
                                    <a href="{{route('product.edit', $pro->p_id)}}">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i> @lang('button.edit')
                                        </button>
                                    </a>

                                    {{-- {{Form::open(['route' => ['product.destroy', $pro->p_id], 'method' => 'DELETE' , 'id' => 'deleteForm'])}}

                                    {{Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> '.trans('button.delete'), ['class'=>'btn btn-xs btn-danger deleteBtn', 'type'=>'submit', 'data-id' => $pro->p_id]) }}

                                    {{Form::close()}} --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table> <!-- end tbody #productDivBox -->
                    <div class="text-left ">
                        <ul class="pagination-primary">
                            {{$product->links()}}
                        </ul> <!-- end div .pagination-primary -->
                    </div>
                </div> <!-- end div #divProductTable -->
            </div>  <!-- end col 12 -->
            <!-- END TABLE -->
        </div>  <!-- end div .panel-body-->
    </div>  <!-- end div .panel-->

    <script>

        /*
         Products search
         */


        //Language
        var _show = '@lang('button.show')';
        var _edit = '@lang('button.edit')';
        var _delete = '@lang('button.delete')';
        $(function () {
            $("#SearchProducts").keyup(function () {
                var _search = $(this).val();
                if (_search === '') {
                    $('#productDivBoxAjax').hide();
                    $('#productDivBox').show();
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: './product/search',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'search': _search
                    },
                    success: function (data) {
                        var $a;
                        $.each(data, function (i, result) {
                            $('#productDivBox').hide();
                            $('#productDivBoxAjax').show();
                            $a += '<tr>',
                                $a += '<td >' + result.p_id + '</td >',
                                $a += '<td style="width: 130px;" >' + (result.p_icon !== '' ? '<img src="../img/' + result.p_icon + '.png" width="20"> ' : '') + result.p_bname + '</td >',
                                $a += '<td >' + result.p_gname + '</td >',
                                $a += '<td >' + result.name + '</td >',
                                $a += '<td style="width: 100px;" ><small style="float: left;"> {{get_currencySymbols() }} </small>' + result.p_price + '</td >'
                            if (result.p_quantity < 21) {
                                $a += '<td ><span class="label label-danger" data-toggle="tooltip" title="Le queda poco de este producto, todo lo que tiene' + result.p_quantity + '"> SOLO HAY ' + result.p_quantity + '</span></td>';
                            } else {
                                $a += '<td >' + result.p_quantity + '</td>';
                            }
                            $a += '<td >' + result.p_discount + '%</td >'
                            if (new Date(result.p_exdate) <  sumarDias(new Date(),-1)) {
                                $a += '<td ><span class="label label-danger" data-toggle="tooltip" title="El producto Vencio en :  ' + dateFormat(result.p_exdate)     + '"> Producto Vencido </span></td >'

                            } else {
                                $a += '<td >' + dateFormat(result.p_exdate) + '</td >';
                            }
                                
                                if(result.dias <= 90)
                                 { 
                                        $a +=  '<td><span class="label label-danger" data-toggle="tooltip" title="El producto Vence el : ' + result.p_exdate +'">'  + result.dias + ' dias'  +'</span></td>';
                                 } else{
                                 
                                        $a += '<td><span class="label label-success" data-toggle="tooltip" title="El producto Vence el : ' + result.p_exdate +'">'  + result.dias + ' dias'  +'</span></td>';
                                }

                            $a += '<td style="display: inline-flex;" >',
                                $a += '<a href="/product/' + result.p_id + '"><button class="btn btn-xs btn-white"><i class="fa fa-eye" aria-hidden="true"></i>' + _show + '</button></a>',
                                $a += '<a href="/product/' + result.p_id + '/edit"><button class="btn btn-xs btn-white"><i class="fa fa-pencil" aria-hidden="true"></i>' + _edit + '</button></a>',
                                $a += '<form method="POST" action="product/' + result.p_id + '" accept-charset="UTF-8" style="display:inline-block;" id="deleteForm"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="' + $('input[name=_token]').val() + '">',
                                // $a += '<button class="btn btn-xs btn-danger deleteBtn" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i>' + _delete + '</button>',
                                $a += '</form>',
                                $a += '</td ></tr>'
                        });
                        $('tbody#productDivBoxAjax').html($a);
                    }
                });
            });

            function sumarDias(fecha, dias){
              fecha.setDate(fecha.getDate() + dias);
              return fecha;
            }
            function jsNumerodiferenciaDias(f1,f2)
             {
             var aFecha1 = f1;
             var aFecha2 = f2; 
             var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-5,aFecha1[0]); 
             var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-5,aFecha2[0]); 
             var dif = fFecha2 - fFecha1;
             var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
             alert(dias);
             return dias;
             }
        });
    </script>
@endsection
