@extends('layouts.app')
@section('title', '| Usuarios')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h2 class="text-info text-center">@lang('navbar.users')</h2></div>

        <div class="panel-body">
            <div id="tablePanel">
                <div class="row">
                    <div class="col-md-8">
                        <a href="{{url('/users/create')}}">
                            <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                          aria-hidden="true"></i> @lang('users.add')
                            </button>
                        </a>
                    </div>
                    <div class="col-md-4 pull-right" id="searchDiv">
                        <div id="custom-search-input">
                            <div class="input-group ">
                                <input type="text" class="form-control input-md" id="SearchUsers" name="search"
                                placeholder="Nombre de Usuario"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-md" type="button">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>  <!-- end div #tablePanel -->
            <div class="col-md-12 col-sm-12  col-xs-12">
                <div class="table-responsive" id="divProductTable">
                    <table class="table table-hover results">
                        <tr>
                            <th>@lang('users.name')</th>
                            <th>@lang('users.email')</th>
                            <th>@lang('users.permission')</th>
                            <th>@lang('users.estado')</th>
                            <th>@lang('users.created_at')</th>
                            <th>@lang('users.updated_at')</th>
                            <th>@lang('users.control')</th>
                        </tr>
                        <tbody id="UserDivBoxAjax">
                            </tbody>
                        <tbody id="UserDivBox">
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <span class="label label-info">
                                           {{$user->nombreroles}} 
                                    </span>
                                </td>
                                <td>
                                    @if($user->estado_id == 1)
                                        <span class="label label-success">
                                           {{$user->nombre_estado}} 
                                        </span>
                                    @else
                                        <span class="label label-danger">
                                           {{$user->nombre_estado}} 
                                        </span>
                                    @endif
                                </td>

                                <td>{{date('d-M-Y-g:i',strtotime($user->created_at))}}</td>
                                <td>{{date('d-M-Y-g:i',strtotime($user->updated_at))}}</td>
                                <td>
                                    <a href="{{route('users.edit', $user->id)}}">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i> @lang('button.edit')
                                        </button>
                                    </a>

                                    {{-- {{Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE' , 'id' => 'deleteUsersForm'])}} --}}

                                    {{-- {{Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> '.trans('button.delete'), ['class'=>'btn btn-xs btn-danger deleteUsers', 'type'=>'submit', 'data-id' => $user->id]) }}

                                    {{Form::close()}} --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table> <!-- end tbody #productDivBox -->

                </div> <!-- end div #divProductTable -->
            </div>  <!-- end col 12 -->

        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel-->
    <script>
                    /*
                     Products search
                     */

                    //Language
                    var _edit = 'EDITAR';
                    $(function () {
                        $("#SearchUsers").keyup(function () {
                            var _search = $(this).val();
                            if (_search === '') {
                                _search = 'Todos';
                                $('#salesDivBoxAjax').hide();
                                $('#salesDivBox').show();
                                //return false;
                            }
                            $.ajax({
                                type: 'POST',
                                dataType: "json",
                                url: '/users/search',
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'search': _search
                                },
                                success: function (data) {
                                    var $a;
                                    $.each(data, function (i, result) {
                                        if (jQuery.isEmptyObject(result.RoleOwners)) {
                                            $('#UserDivBox').hide();
                                            $('#UserDivBoxAjax').show();

                                            var fechainicio = result.created_at;
                                            if (fechainicio == null || fechainicio == undefined){
                                              fechainicio = '31-Dec-1969';
                                            }

                                            var fechaactualizacion = result.updated_at;
                                            if (fechaactualizacion == null || fechaactualizacion == undefined){
                                                fechaactualizacion = '31-Dec-1969';
                                            } 

                                            $a += '<tr>',
                                                $a += '<td >' + result.name + '</td >',
                                                $a += '<td >' + result.email + '</td >',
                                                $a += '<td ><span class="label label-info">' + result.nombreroles + '</span></td >',
                                                $a += '<td ><span class="label label-success">' + result.nombre_estado + '</span></td >',
                                                $a += '<td >' + fechainicio + '</td >',
                                                $a += '<td >' + fechaactualizacion + '</td >',
                                                $a += '<td >',
                                                $a += '<a href="/users/' + result.id+ '/edit"><button class="btn btn-xs btn-white"><i class="fa fa-pencil" aria-hidden="true"></i>' + _edit + '</button></a>',
                                                $a += '</form>',
                                                $a += '</td >'
                                        }
                                    });
                                    $('tbody#UserDivBoxAjax').html($a);
                                }
                            });
                        });


                    });
                </script>
@endsection
