@extends('layouts.app')
@section('title', '| Reportes de Ventas Por Usuario')
@section('content')

       <div class="panel panel-default">
        {{-- <h2 class="text-center text-info">@lang('category.title')</h2> --}}
        <div class="panel-body">
            <div class="col-md-12" id="analysis">
            	
            	<h4 class="text-info text-center">Reporte de Ventas por Usuario</h4>

				<div class="row">

					 {{Form::open(['route' => 'reportes.GenerarReporteVentasUsuario' , 'id' => 'ReporteForm'])}}
						<div class="col-xs-12 col-sm-12 col-md-3">
	                        {{Form::text('fechaventadocumento', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'text-center datepicker form-control', 'data-date-format' => 'yyyy-mm-dd'])}}
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
							<select class="form-control text-center" name="usuario_id" id="usuario_id">
	                            @foreach($usuarios as $usuario)
	                            	<option value="{{ $usuario->id }}" >{{ $usuario->email}}</option>
	                            @endforeach
	                        </select>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
							<select class="form-control text-center" name="tipo_reporte_id" id="tipo_reporte_id">
	                            <option selected value="1" style="text-align: center;">Descargar</option>
								<option value="2" style="text-align: center;">Imprimir</option>                            
	                        </select>

						</div>
						<div class="col-xs-12 col-sm-12 col-md-3 text-center">
	                            <button type="submit" style="margin-top: 32px;" class="btn btn-sm btn-info" data-id=""><i class="fa fa-list"
	                                aria-hidden="true"></i>&nbsp; GENERAR REPORTE
	                            </button>
						</div>
					{{Form::close()}}
				</div>


            </div> <!-- end div #analysis -->
            
        </div>
         <!-- end div .panel-body -->
    </div> <!-- end div .panel -->
	

@endsection