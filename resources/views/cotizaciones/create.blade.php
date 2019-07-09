@extends('layouts.app')
@section('title', '| Registrar Cotizacion')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"> <h3 class="text-center text-info"><i class="fa fa-calculator fa fa-2x" aria-hidden="true"></i>&nbsp; Registar Cotización&nbsp;<i class="fa fa-calculator fa fa-2x" aria-hidden="true"></i>&nbsp;</h3></div>
            
                <div class="form-group row">
                   
                    <div class=" input-group col-xs-12">
                         <input type="text" class="form-control text-center"  id="cCliente" name="cCliente"  required placeholder="Datos del Cliente" maxlength="40" value="" readonly>
                         <span class="input-group-btn">
                          <a class="btn btn-xs btn-info" data-toggle="modal" href='#modal-id'>
                                <i aria-hidden="true" class="fa fa-search"></i>
                                BUSCAR CLIENTE
                            </a>
                        </span>
                    </div>
                </div>

            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                                <a href="{{url('/Cliente/CrearCliente')}}">
                                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                                      aria-hidden="true"></i> CREAR CLIENTE
                                    </button>
                                </a>
                                {{-- <a href="{{url('/customers/create')}}">
                                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                                      aria-hidden="true"></i> @lang('customers.newcustomers')
                                    </button>
                                </a> --}}
                                <div class="col-md-12">
                                    <div class="input-group col-md-12">
                                        <input type="text" class="form-control input-cliente" autocomplete="off" id="input-cliente"
                                               name="search" placeholder="Nombre o Dni del Cliente"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-md" type="button" id="btn-buscar-cliente">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="ClienteModelBodyAjax"></div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                    <div class="col-sm-3">
                        {{Form::label('fechadocumento','Fecha de Cotizacion')}}
                        {{Form::text('fechadocumento', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'text-center datepicker form-control', 'data-date-format' => 'yyyy-mm-dd','readonly'=>'readonly'])}}
                    </div>
                <div class="col-sm-3" style="display:none;">
                    <label class="color-azul">Tipo de Documento:</label>
                    <select class="form-control text-center" name="tipo_documento_id" id="tipo_documento_id">
                        @foreach($tiposdocumentos as $tiposdocumento)
                            <option value="{{ $tiposdocumento->tipo_documento_id }}" >{{ $tiposdocumento->descripcion_tipo_documento}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="panel-body" id="divProduct">
                <div class="row">   
                    <div class="col-xs-12">
                        <div id="custom-search-input" class="col-md-4">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control input-md" autocomplete="off" id="SearchProducts"
                                       name="search" placeholder="@lang('products.search')"/>
                                {{-- <span class="input-group-btn"><button class="btn btn-info btn-md" type="button" readonly><i
                                                class="fa fa-search" aria-hidden="true"></i></button></span> --}}
                            </div>
                        </div>
                    </div>
                </div>    


                <div id="salesModelBody">
                    @foreach($product as $pro)
                        @if($pro->p_id == 1)
                            <button class="btn btn-white btn-consulta-medica" data-placement="bottom" data-html="true" data-toggle="tooltip" id="btn-consulta-medica"
                                title="<h4 class='text-left'>@lang('sales.description')</h4><br>
                        <p class='text-left'>{{str_limit($pro->p_desc,400)}}</p>
                        <h4 class='text-left'>@lang('products.seffect')</h4><br>
                        <p class='text-left'>{{str_limit($pro->p_seffect,400)}}</p>"
                                data-discount="{{$pro->p_discount}}" data-id="{{$pro->p_id}}"
                                data-price="{{$pro->p_price}}">
                            @if($pro->p_icon !== NULL)
                                <img src="{{asset('img').'/'.$pro->p_icon.'.png'}}" width="20">
                            @endif
                            {{$pro->p_bname}}
                        </button> 
                        @else
                            <button class="btn btn-white" data-placement="bottom" data-html="true" data-toggle="tooltip"
                                title="<h4 class='text-left'>@lang('sales.description')</h4><br>
                        <p class='text-left'>{{str_limit($pro->p_desc,400)}}</p>"
                                data-discount="{{$pro->p_discount}}" data-id="{{$pro->p_id}}"
                                data-price="{{$pro->p_price}}">
                            @if($pro->p_image !== NULL)
                                <img src="{{asset('upload').'/'.$pro->p_image.''}}" width="50">
                            @endif
                            {{$pro->p_bname}}
                        </button> 
                        @endif
                       
                    @endforeach
                </div>
                <div id="salesModelBodyAjax"></div>
            </div>
        </div>
        <!-- Icon order button -->
        <div id="divIconOrder" style="display: none;">
            <div class="col-md-1 col-md-offset-9 col-sm-offset-9" id="notif-circle-order">
                <span><p>0</p></span>
            </div>
            <button id="iconOrder" class="btn btn-danger btn-fab btn-round">
                <i class="fa fa-shopping-basket"></i>
            </button>
        </div>
        <div class="col-md-4 pull-right" id="divOrder" style="display: none;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DETALLE DE COTIZACION
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        {{Form::open(['route' => 'cotizaciones.store' , 'id' => 'orderForm'])}}
                            <input type="text" style="display:none;" id="cliente_id" name="cliente_id">

                            <input type="text" style="display:none;" id="cliente" name="cliente">
                            <input type="text" style="display:none;" id="cDnicRuc" name="cDnicRuc">
                            <input type="text" style="display:none;" id="cliente_fechadocumento" name="cliente_fechadocumento">
                            <input type="text" style="display:none;" id="cliente_serie_id" name="cliente_serie_id">
                            <input type="text" style="display:none;" id="cliente_tipo_documento_id" name="cliente_tipo_documento_id">
                            <input type="text" style="display:none;" id="cliente_tipo_pago_id" name="cliente_tipo_pago_id">

                            <div id="divOrderPro">

                                <span id="order"></span>
                                <span id="totalPriceSpan" style="display:none;">
                                        <strong> @lang('sell.totalPrice'):</strong>
                                        <small>{{get_currencySymbols() }}</small>
                                        <p id="totalPrice"></p>
                                    </span><br>
                                <button class="btn btn-sm btn-danger" id="saleBtn"><i class="fa fa-cart-plus"
                                                                                      aria-hidden="true"></i>COTIZAR
                                </button>
                            </div> <!-- end div #divOrderPro -->
                        {{Form::close()}}
                    </div>  <!-- end form-->
                </div> <!-- end div .panel-body -->
            </div> <!-- end div .panel -->
        </div>  <!-- end div #divOrder -->

<div class="modal fade" id="modal-id-2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title text-center">Ingrese el precio de la Consulta Médica</h5>
            </div>
                <input type="number" class="form-control text-center"  id="txtprecioconsulta" name="txtprecioconsulta"  required maxlength="40" value="70.00" step="0.10">
            <div class="modal-footer">
                <button type="button" id="btn-Cerrar-Precio" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn-Seleccionar-Precio" class="btn btn-info">Continuar</button>
            </div>
        </div>
    </div>
</div>

        <script>


            // Function to remove product

            $(function () {

            //     var valor_tipo_documento = $('select[name=departamento_id]').val();

            // if (!(typeof valor_tipo_documento === 'undefined')) { 
                
                 jQuery.ajax({
                              url: '../../series/listar_ajax/' + $('select[name=tipo_documento_id]').val(),
                              type: 'POST',
                              data: {'_token': $('input[name=_token]').val(),
                                     id: $('select[name=tipo_documento_id]').val()},
                              success: function(lista){
                                    //var lista = JSON.parse(respuesta);
                                    //console.log(lista);
                                    $.each(lista, function(index, val) {
                                        //alert(lista[index].nombre_distrito);
                                                $('#serie_id').append($('<option>', { 
                                                    value:lista[index].serie_id,
                                                    text : lista[index].cDenominacionSerie
                                                }));

                                            });
                                    lista = null;
                                    $('#serie_id').fadeIn("slow");
                              }
                            })
                            .fail(function() {
                              //console.log("error");
                        })

                // }

                $("select[name=tipo_documento_id]").change(function(){

                    $('#serie_id option').remove();

                    jQuery.ajax({
                              url: '../../series/listar_ajax/' + $('select[name=tipo_documento_id]').val(),
                              type: 'POST',
                              data: {'_token': $('input[name=_token]').val(),
                                     id: $('select[name=tipo_documento_id]').val()},
                              success: function(lista){
                                    //var lista = JSON.parse(respuesta);
                                    //console.log(lista);
                                    $.each(lista, function(index, val) {
                                        //alert(lista[index].nombre_distrito);
                                                $('#serie_id').append($('<option>', { 
                                                    value:lista[index].serie_id,
                                                    text : lista[index].cDenominacionSerie
                                                }));

                                            });
                                    lista = null;
                                    $('#serie_id').fadeIn("slow");
                              }
                            })
                            .fail(function() {
                              //console.log("error");
                        })

                          event.preventDefault();
                });


                $(document).on('click', '#deleteOrderProduct', function (e) {
                    var $id = $(this).attr('data-id');
                    var $disabled = $("#salesModelBody").find("[data-id='" + $id + "']").removeClass('disabled');
                    var $discount = $(this).parent().find('#aDiscount').text();
                    var $tPrice = $('#totalPrice').text();
                    if ($discount > 0) {
                        //$('#totalPrice').html((parseFloat($tPrice) - parseFloat($discount)).toFixed(2));
                        $(this).parent().fadeOut(200).remove();

                        //decrease when add new product to notifcation icon order
                        var $number = $('#notif-circle-order p').text(function (index) {
                            var $increase = $(this).text();
                            $increase--
                            $(this).text($increase);
                        });
                    }
                    // get total price after removed
                    // if total price = 0 hide orderbox
                    // var $totalPrice2 = $('#totalPrice').text();
                    // if (parseFloat($totalPrice2) === 0) {
                    //     $('#divOrder,#divIconOrder').hide();
                    // }
 
                    let items =  document.querySelectorAll(".divOrderProduct");
                    
                    if (items.length <= 0) { $('#divOrder,#divIconOrder').hide();}

                });

                $(document).on('click', '#saleBtn', function (e) {

                    $('#cliente_fechadocumento').val($('#fechadocumento').val());
                    $('#cliente_serie_id').val($('#serie_id').val());
                    $('#cliente_tipo_documento_id').val($('#tipo_documento_id').val());
                    $('#cliente_tipo_pago_id').val($('#tipo_pago_id').val());


                    var cliente = $('#cCliente').val();
                    if (cliente === '') {alert('Seleccionar el Cliente'); return false;}
                    $('#orderForm').submit();


                });


            });


            // This function to set the product in box order
            $(function () {
                var indica_codigo_clinicia= 0;
                //toggle box order if click to icon order button
                $(document).on('click', '#iconOrder', function () {
                    $('#divOrder').toggle();
                });

                // Evento click cuando el precio es seleccionado.

                $(document).on('click', '#btn-Seleccionar-Precio', function () {
                    
                    //Asignacion de Valores.
                    
                    //p _id = 1 : es el codigo del articulo en Consulta Medica

                    var _precio =  $('#txtprecioconsulta').val();

                    if ( _precio < 70 || _precio > 90) { alert('El Precio debe estar entre  70 y 90 soles');return;}

                    $('#oldPrice-1').val($('#txtprecioconsulta').val());

                    $('#productPrice-1').text('S/. ' + $('#txtprecioconsulta').val());


                    $('#modal-id-2').modal('hide');

                    $('#btn-consulta-medica').addClass('disabled');

                    $('#divIconOrder').show();

                });

                $(document).on('click', '#btn-Cerrar-Precio', function () {
                    //alert('Estas Cerrando');
                    $(this).removeClass('disabled');
                });

                $(document).on('click', '#divProduct button  ', function (e) {
                    e.preventDefault();

                    //disabled after choose
                    if (!$(this).hasClass('disabled')) {


                        if ($(this).hasClass('btn-consulta-medica')) {
                            //alert("Tiene Clase Consulta Medica Shi Shi.");

                            $('#modal-id-2').modal('show');

                        }
                        //increase when add new product to notifcation icon order
                        var $number = $('#notif-circle-order p').text(function (index) {
                            var $increase = $(this).text();
                            $increase++
                            $(this).text($increase);
                            
                            if (parseInt($(this).attr('data-id'))== 1) {indica_codigo_clinicia = $increase;}

                        });


                         

                        if (!$(this).hasClass('btn-consulta-medica')) {
                            //alert("Tiene Clase Consulta Medica Shi Shi.");
                            $(this).addClass('disabled');

                        }

                        var $id = $(this).attr('data-id');
                        var $price = $(this).attr('data-price');
                        var $discount = $(this).attr('data-discount');
                        var $name = $(this).text();
                        if ($discount !== '') {
                            var $_dis = (parseFloat($price) - (parseFloat($price) * (parseFloat($discount / 100)))).toFixed(2); // discount calc
                        } else {
                            $_dis = 0;
                        }
                        if ($('#aDiscount').text() === '') {  //calc price and put it in totalprice id
                            sum = $_dis;
                        } else {
                            var sum = $_dis;
                            $("[id=aDiscount]").each(function () {
                                sum = parseFloat(sum) + parseFloat($(this).text());
                            });
                        }

                        // $('#totalPrice').html(sum);
                        //$('#divIconOrder').show();

                        if (!$(this).hasClass('btn-consulta-medica')) {
                            //alert("Tiene Clase Consulta Medica Shi Shi.");
                            $('#divIconOrder').show();
                        }

                        $('span#order').append(
                            '<div class="divOrderProduct">' +
                            '<i class="fa fa-times " aria-hidden="true" data-id="' + $id + '"id="deleteOrderProduct"></i>' +
                            '<ul>' +
                            '<li style="margin-bottom: 10px;"><span>' +
                            '<strong> Nombre del Producto : </strong>' + $name +
                            '</span></li>' +
                            '<input type="hidden" class="CodigoProducto" id="productID" name="productID[]" value="' + $id + '" /> ' +
                            '<input type="hidden" class="PrecioEnviar" id="oldPrice-'+ $id +'" name="orderPrice[]" value="' + $price + '" />' +
                            '<li><span id="productPriceSpan"><strong> @lang('sell.price') :  </strong> <p id="productPrice-'+ $id +'"><small"> {{get_currencySymbols() }} </small>' + $price + '</p></span></li>' +
                            '<li style="display:none;"><span id="productPriceSpan"><strong> @lang('sell.discount') :  </strong> <p id="productDiscount" >  ' + $discount + '%</p></span></li>' +
                            '<li style="display:none;"><span id="productPriceSpan"><strong> @lang('sell.adiscount') :  </strong> <p id="aDiscount" >  ' + $_dis + '</p></span></li>' +
                            '<li><span id="quantityOrderSpan"><strong>@lang('sell.quantity') :  </strong> <input class="form-control" id="quantityOrder"  type="number" max="50" min="1" name="orderQuantity[]" value="1"> </span></li></ul>' +
                            '<textarea class="form-control" rows="2" id="productInfo" name="orderInfo[]" placeholder="Descripcion"></textarea>' +
                            '<hr></div>');




                    }
                });

                //if quantity change clac price and put it in totalprice
                $(document).on('change', '#quantityOrder', function () {
                    // var $number = $(this).val();
                    // var $price = $(this).parent().parent().parent().find('#productPrice').text();
                    // var $orgPrice = $(this).parent().parent().parent().find('#oldPrice').val();
                    // var $discount = $(this).parent().parent().parent().find('#productDiscount').text();
                    // //if discount empty
                    // if ($discount.split(' ').join('') === '%') {
                    //     var $plus = (parseFloat($orgPrice) * parseFloat($number)).toFixed(2);
                    //     alert('sad');
                    // } else {
                    //     var $_dis = parseFloat($discount) / parseFloat('100') * parseFloat($orgPrice);
                    //     var $_dis2 = parseFloat($orgPrice) - parseFloat($_dis);
                    //     var $plus = (parseFloat($_dis2) * parseFloat($number)).toFixed(2);
                    // }

                    //$(this).parent().parent().parent().find('#productPrice').html('<small"> {{get_currencySymbols() }} </small>' + $plus);

                    //total price after change quantity
                    // var suma = 0;
                    // $("[id=oldPrice]").each(function () {
                    //     suma += parseFloat($(this).val() * $(''));
                    // });
                    //     suma=suma.toFixed(2)
                    // $('#totalPrice').html(suma);

                });

                // Product search

                $(document).on('click','.btnBusquedaPaciente',function(e){
                                
                                $('#cCliente').val($(this).data('name') + ' - ' + $(this).data('dni') + ' - ' + $(this).data('phone'));

                                $('#cliente_id').val($(this).data('id'));
                                $('#cliente').val($(this).data('name'));
                                $('#cDnicRuc').val($(this).data('dni'));
                                $('#modal-id').modal('hide');
                             });

                $('#input-cliente').keyup(function () {

                    var _search_cliente = $(this).val();

                    if (_search_cliente === '') {
                        $('#ClienteModelBodyAjax').hide();
                        return false;
                    }

                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: '/customers/search',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'search': _search_cliente
                        },
                        success: function (data) {
                            //$('#salesModelBody').hide();
                            $('#ClienteModelBodyAjax').show();
                            var $a = '';
                            
                            $.each(data, function (i, result) {
                                
                                $a += '<button class="btnBusquedaPaciente row btn btn-info" data-phone="' + result.phone + '" data-id="' + result.id + '" data-name="' + result.name + '" data-dni="' + result.dni + '" data-number="' + result.number + '">'
                                
                                $a += result.name + ' - ' + result.dni + ' - '+ result.phone +'</button>'
                            
                            });



                            $('#ClienteModelBodyAjax').html($a);
                        }
                    });


                });


                $("#SearchProducts").keyup(function () {
                    var _search = $(this).val();

                    //if search input is empty
                    if (_search === '') {
                        $('#salesModelBodyAjax').hide();
                        $('#salesModelBody').show();
                        return false;
                    }
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: '/product/search',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'search': _search
                        },
                        success: function (data) {
                            $('#salesModelBody').hide();
                            $('#salesModelBodyAjax').show();
                            var $a = '';
                            $.each(data, function (i, result) {
                                if(result.p_id != '1'){
                                    $a += '<button class="btn btn-white" data-discount="' + result.p_discount + '" data-id="' + result.p_id + '" data-price="' + result.p_price + '">'
                                    if (result.p_image) {
                                        $a += '<img src="../upload/' + result.p_image + '" width="50">'
                                    }
                                    $a += result.p_bname + '</button>'
                                }
                            });
                            $('#salesModelBodyAjax').html($a);
                        }
                    });
                });
            });
        </script>
@endsection

