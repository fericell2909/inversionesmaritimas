@extends('layouts.app')
@section('title', '| Listado de Pacientes')
@section('content')
    <div class="panel panel-default">
        <h2 class="text-center text-info">@lang('customers.title')</h2>
        <div class="panel-body">
            <div id="tablePanel">
                <a href="{{url('/customers/create')}}" style="display:none;">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> @lang('customers.newcustomers')
                    </button>
                </a>
                 <a href="{{url('/Cliente/CrearCliente')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> @lang('customers.crearcliente')
                    </button>
                </a>
                <div class="dropdown" id="pdfgenerate" style ="display:none;">

                    <button class="btn btn-sm  btn-info dropdown-toggle" data-toggle="dropdown">
                        @lang('products.inventory')
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" >
                        <li><a href="{{url('/customers/pdf/0')}}">Todos</a></li>
                        <li><a href="{{url('/customers/pdf/1')}}">Semana</a></li>
                        <li><a href="{{url('/customers/pdf/2')}}">Mes</a></li>
                        <li><a href="{{url('/customers/pdf/3')}}">6 Meses</a></li>
                        <li><a href="{{url('/customers/pdf/4')}}">Año</a></li>

                    </ul>
                </div>  <!-- end div #pdfgenerate -->
            </div> <!-- end div #tablePanel -->

            <div class="col-md-4" id="searchDiv">
                <div id="custom-search-input">
                    <div class="input-group ">
                        <input type="text" class="form-control input-md" id="Searchcustomers" name="search"
                               placeholder="@lang('customers.search')"/>
                        <span class="input-group-btn">
                              <button class="btn btn-info btn-md" type="button">
                                <i class="fa fa-search" aria-hidden="true"></i>
                               </button>
                            </span>
                    </div>
                </div>
            </div>  <!-- end div #searchDiv -->


            <div class="col-md-12 col-sm-12">
                <div class="table-responsive" id="divCuctomersTable">
                    <table class="table table-hover results">
                        <tr>
                            <th>#</th>
                            <th>@lang('customers.name')</th>
                            <th>@lang('customers.dni')</th>
                            <th>@lang('customers.estado')</th>
                            <th>@lang('customers.date')</th>
                            <th class="text-center" >@lang('customers.control')</th>

                        </tr>
                        <tbody id="cuctomersDivBoxAjax"></tbody> <!-- end tbody  cuctomersDivBoxAjax -->

                        <tbody id="cuctomersDivBox">
                        @foreach($customers as $cust)
                            <tr>
                                <td>{{  $cust->id      }}</td>
                                <td>{{  $cust->name   }}</td>
                                <td>{{  $cust->dni     }}</td>
                                <td>
                                @if($cust->estado_id == 1)
                                    <span class="label label-info">Activo</span>
                                @else
                                    <span class="label label-danger">Inactivo</span>
                                @endif
                                </td>
                                <td>{{  date('d-M-y-g:i ', strtotime($cust->created_at))  }}</td>

                                <td>
                                    <a href="{{route('customers.show', $cust->number)}}">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-eye"
                                                                                aria-hidden="true"></i> @lang('button.show')
                                        </button>
                                    </a>
                                    <a href="{{route('customers.edit', $cust->id)}}">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i> @lang('button.edit')
                                        </button>
                                    </a>

                                    {{-- {{Form::open(['route' => ['customers.destroy', $cust->id], 'method' => 'DELETE' ,  'id' => 'deleteCustomersForm'])}}

                                    {{Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> '.trans('button.delete'), ['class'=>'btn btn-xs btn-danger deleteCustomersBtn', 'type'=>'submit', 'data-id' => $cust->id]) }}

                                    {{Form::close()}} --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody> <!-- end tbody #cuctomersDivBox -->
                    </table>
                    <div class="text-left ">
                        <ul class="pagination-primary">
                            {{$customers->links()}}
                        </ul>
                    </div>
                </div> <!-- end col 12 -->
            </div>  <!-- end div # ivCuctomersTable-->
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->

    <script>

        /*
         customers search
         */

        // Language translate
        var _show = '@lang('button.show')';
        var _edit = '@lang('button.edit')';
        var _delete = '@lang('button.delete')';
        $(function () {
            $("#Searchcustomers").keyup(function () {
                var _search = $(this).val();
                if (_search === '') {
                    $('#cuctomersDivBoxAjax').hide();
                    $('#cuctomersDivBox').show();
                    return false;
                }



                //send ajax request
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: '/customers/search',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'search': _search
                    },
                    success: function (data) {
                        var $a;
                        $.each(data, function (i, result) {
                            //append the response
                            if (jQuery.isEmptyObject(result.RoleOwners)) {
                                $('#cuctomersDivBox').hide();
                                $('#cuctomersDivBoxAjax').show();

                                if (result.estado_id == 1) 
                                {
                                    nombre_estado = 'ACTIVO';
                                    $b = '<span class="label label-info">';
                                } else
                                {
                                    $b = '<span class="label label-danger">';
                                    nombre_estado = 'INACTIVO';
                                }

                                $a += '<tr>',
                                    $a += '<td >' + result.id + '</td >',
                                    $a += '<td >' + result.name + '</td >',
                                    $a += '<td >' + result.dni + '</td >',
                                    $a += '<td >' + $b + nombre_estado + '</span>'+'</td >',
                                    $a += '<td >' + result.created_at + '</td >',
                                    $a += '<td >',
                                    $a += '<a href="/customers/' + result.number + '"><button class="btn btn-xs btn-white"><i class="fa fa-eye" aria-hidden="true"></i>' + _show + '</button></a>',
                                    $a += '<a href="/customers/' + result.id + '/edit"><button class="btn btn-xs btn-white"><i class="fa fa-pencil" aria-hidden="true"></i>' + _edit + '</button></a>',
                                    $a += '</form>',
                                    $a += '</td >'
                            }
                        });
                        $('tbody#cuctomersDivBoxAjax').html($a);
                    }
                });
            });
        });
    </script>
@endsection
