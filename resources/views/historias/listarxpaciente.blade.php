@extends('layouts.app')
@section('title', '| Busqueda de Historias por Paciente ')
@section('content')
    <div class="panel panel-default">
        <h2 class="text-center text-info"><i class="fa fa-wheelchair" aria-hidden="true"></i> Busqueda de Historias por Paciente <i class="fa fa-wheelchair" aria-hidden="true"></i></h2>
        <div class="panel-body">
            <div id="tablePanel">
                 <a href="{{route('RegistrarPacientes')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> @lang('pacientes.newpacientes')
                    </button>
                </a>
                <a href="{{route('RegistrarHistoriaClinica')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> @lang('historias.newhistoria')
                    </button>
                </a>                
            </div> <!-- end div #tablePanel -->

            <div class="col-md-4" id="searchDiv">
                <div id="pacientes-search-input">
                    <div class="input-group ">
                        <input type="text" class="form-control input-md" id="Searchpacientes" name="search"
                               placeholder="@lang('pacientes.search')"/>
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
                            <th>Paciente</th>
                            <th>@lang('pacientes.sexo')</th>
                            <th>@lang('pacientes.dni')</th>
                            <th>Tipo de Consulta</th>
                            <th>Estado de Consulta</th>
                            <th># de Atenciones</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        <tbody id="pacientesHistoriasDivBoxAjax"></tbody> 
                        <tbody id="pacientesHistoriasDivBox">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>

        var _view = 'Ver';
        var _print = 'Imprimir';
        var _estado = 'Cambiar Estado' 
        
        $(function () {
            $("#Searchpacientes").keyup(function () {
                var _search = $(this).val();

                if (_search === '') {
                    $('#pacientesHistoriasDivBoxAjax').hide();
                    $('#pacientesHistoriasDivBox').show();
                    return false;
                }

                //send ajax request
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: 'HistoriasClinicasPaciente/search',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'search': _search
                    },
                    success: function (data) {
                        var $a;
                        $.each(data, function (i, result) {

                            if (jQuery.isEmptyObject(result.RoleOwners)) {
                                $('#pacientesHistoriasDivBox').hide();
                                $('#pacientesHistoriasDivBoxAjax').show();

                                if (result.estado_id_historia == 1) 
                                {
                                    $nombre_estado = 'ACTIVO';
                                    $b = '<span class="label label-info">';
                                } else
                                {
                                    $b = '<span class="label label-danger">';
                                    $nombre_estado = 'INACTIVO';
                                }

                                $a += '<tr>',
                                    $a += '<td >' + result.id + '</td >',
                                    $a += '<td >' + result.apellido_paterno + ' ' + result.apellido_materno + ' ' + result.nombres + '</td >',
                                    $a += '<td >' + result.sexo + '</td >',
                                    $a += '<td >' + result.dni + '</td >',
                                    $a += '<td >' + result.nombre_historia + '</td >',
                                    $a += '<td >' + $b + $nombre_estado +'</span>' + '</td >',
                                    $a += '<td >' + result.ncorrelativo + '</td >',
                                    $a += '<td >' + '<a href="HistoriasClinicasPaciente/Ver/' + result.dni + '/'+ result.ncorrelativo + '""><button class="btn btn-xs btn-white"><i class="fa fa-eye" aria-hidden="true"></i>' + _view + '</button></a><a href="HistoriasClinicasPaciente/Imprimir/' + result.dni + '/' + result.ncorrelativo + '""><button class="btn btn-xs btn-white"><i class="fa fa-print" aria-hidden="true"></i>' + _print + '</button></a><a href="HistoriasClinicasPaciente/CambiarEstadoConsulta/' + result.dni + '/'+ result.ncorrelativo + '""><button class="btn btn-xs btn-white"><i class="fa fa-edit" aria-hidden="true"></i>' + _estado + '</button></a>',
                                    $a += '</td></tr>'
                            }
                        });
                        $('tbody#pacientesHistoriasDivBoxAjax').html($a);
                    }
                });
            });
        });
    </script>
@endsection
