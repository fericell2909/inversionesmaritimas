<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Impresion de Historia Clinica</title>
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
		.fondo
		{
			background: white;
			color:black;
		}
		table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
	</style>
</head>
<body id="print">

    <table cellspacing="0" style="width: 100%;">
        <tr>
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
    <h1 style="text-align: center; text-decoration: underline;">REPORTE DE HISTORIA CLINICA</h1>
    <h2 style="text-align: center;"> HC-{{strval($pacientes[0]->dni)}}</h2>
	<table border=2>
		<tr>
  			<td class="fondo" colspan="8" style="text-align: center;padding: 5px;font-weight: bold;">Datos del Generales del Paciente e Historia</td>
		</tr>
			<tr>
				<td class="fondo" style="vertical-align: middle;">Nombre</td>
				<td  style="vertical-align: middle;text-align: center">{{$pacientes[0]->nombres}}</td>
				<td class="fondo"  style="vertical-align: middle;">Grupo Sanguineo</td>
				<td  style="vertical-align: middle;text-align: center">{{$pacientes[0]->gruposanguineo}}</td>
				<td class="fondo" style="vertical-align: middle;">Dni</td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->dni}}</td>
				<td class="fondo" style="vertical-align: middle;">Fecha de Historia</td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->fecha_historia}}</td>
			</tr>
			<tr>
				<td class="fondo" style="vertical-align: middle;">Apellido Paterno</td>
				<td  style="vertical-align: middle;text-align: center">{{$pacientes[0]->apellido_paterno}}</td>
				
				<td class="fondo" style="vertical-align: middle;">Edad</td>
				<td style="vertical-align: middle;text-align: center"> {{$pacientes[0]->edad}} </td>
				<td class="fondo" style="vertical-align: middle;">Sexo </td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->sexo}}</td>
				<td class="fondo" style="vertical-align: middle;">Tipo</td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->nombre_historia}}</td>
			</tr>
			<tr>
				<td class="fondo" style="vertical-align: middle;">Apellido Materno</td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->apellido_materno}}</td>
				<td class="fondo" style="vertical-align: middle;">Fecha de Nacimiento</td>
				<td style="vertical-align: middle;text-align: center; width:80px;">{{$pacientes[0]->fecha_nacimiento}}</td>
				<td class="fondo" style="vertical-align: middle;">Celular</td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->celular}}</td>
				<td class="fondo" style="vertical-align: middle;"># Atencion</td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->ncorrelativo}}</td>
			</tr>
	</table>
	
	<br>
	<table border=2>
		<tr>
  			<td class="fondo" colspan="10" style="text-align: center;padding: 5px;font-weight: bold;">Funciones Biologicas</td>
		</tr>
			<tr>
				@foreach($biologicas as $biologica)
					
					<td class="fondo" style="vertical-align: middle;width:65px;">{{$biologica->nombre_campo}}</td>

					@if($pacientes_biologicos[$biologica->id - 1]->valor_id == 1)
                                        <td  style="vertical-align: middle;text-align: center;width:65px;">Si</td>
                                      @else
                                        <td  style="vertical-align: middle;text-align: center;width:65px;">No</td>
                                      @endif

				@endforeach
			</tr>
			@if($pacientes[0]->paciente_funciones_biologicas && !(is_null($pacientes[0]->paciente_funciones_biologicas)))
			<tr>

				<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_funciones_biologicas))}}</p>
			</tr>
			@endif

	</table>
	
	@if( $pacientes[0]->tipo_id  < 5 )
		@if($pacientes[0]->paciente_antecedentes_generales && !(is_null($pacientes[0]->paciente_antecedentes_generales)))
			<label class="fondo" for="" >Antecedentes Generales</label>	
			<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_antecedentes_generales))}}</p>
		
		@endif

		@if($pacientes[0]->paciente_antecedentes_fisiologicos && !(is_null($pacientes[0]->paciente_antecedentes_fisiologicos)))
			<label class="fondo" for="" >Antecedentes Fisiologicos</label>	
			<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_antecedentes_fisiologicos))}}</p>
			
		@endif
	@endif

	

	<br>
	@if( $pacientes[0]->tipo_id  < 5 )
		<table border=2>
			<tr>
	  			<td class="fondo" colspan="12" style="text-align: center;padding: 5px;font-weight: bold;">Antecedentes Patologicas</td>
			</tr>
				<tr>
					@foreach($patologicos as $patologico)
						
						<td class="fondo" style="vertical-align: middle;width:65px;">{{$patologico->nombre_campo}}</td>

						@if($pacientes_patologicos[$patologico->id - 1]->valor_id == 1)
	                                        <td  style="vertical-align: middle;text-align: center">Si</td>
	                                      @else
	                                        <td  style="vertical-align: middle;text-align: center">No</td>
	                                      @endif

					@endforeach
				</tr>
				@if($pacientes[0]->paciente_antecedentes_patologicos_otros && !(is_null($pacientes[0]->paciente_antecedentes_patologicos_otros)))
				<tr>
					<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_antecedentes_patologicos_otros))}}</p>
				</tr>
				@endif

		</table>
	@endif



	@if( $pacientes[0]->tipo_id  < 5 )
		<br>

		<table border=2>
			<tr>
	  			<td class="fondo" colspan="12" style="text-align: center;padding: 5px;font-weight: bold;">Antecedentes Familiares</td>
			</tr>
				<tr>
					@foreach($familiares as $familiar)
						
						<td class="fondo" style="vertical-align: middle;width:65px;">{{$familiar->nombre_campo}}</td>

						@if($pacientes_familiares[$familiar->id - 1]->valor_id == 1)
	                                        <td  style="vertical-align: middle;text-align: center">Si</td>
	                                      @else
	                                        <td  style="vertical-align: middle;text-align: center">No</td>
	                                      @endif

					@endforeach
				</tr>
				@if($pacientes[0]->paciente_antecedentes_familiares_otros && !(is_null($pacientes[0]->paciente_antecedentes_familiares_otros)))
				<tr>
					<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_antecedentes_familiares_otros))}}</p>
				</tr>
				@endif

		</table>
	@endif
	
	@if( $pacientes[0]->tipo_id  < 5 )
	<br>
	<table border=2>
		<tr>
  			<td class="fondo" colspan="8" style="text-align: center;padding: 5px;font-weight: bold;">Antecedentes Ginecostetricos</td>
		</tr>
		<tr>
				<td class="fondo" style="vertical-align: middle;">Menarquia</td>
				<td  style="vertical-align: middle;text-align: center">{{$pacientes[0]->gineco_menarquia}}</td>
				<td class="fondo"  style="vertical-align: middle;">R. C. (días)</td>
				<td  style="vertical-align: middle;text-align: center">{{$pacientes[0]->gineco_regimen_catamenial}}</td>
				<td class="fondo" style="vertical-align: middle;">FUR</td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->gineco_fur}}</td>
				<td class="fondo" style="vertical-align: middle;">EG(Semanas)</td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->gineco_edad_gestacional}}</td>
			</tr>
			<tr>
				<td class="fondo" style="vertical-align: middle;">Gesta</td>
				<td  style="vertical-align: middle;text-align: center">{{$pacientes[0]->gineco_gesta}}</td>
				
				<td class="fondo" style="vertical-align: middle;">Para</td>
				<td style="vertical-align: middle;text-align: center"> {{$pacientes[0]->gineco_para}} </td>
				<td class="fondo" style="vertical-align: middle;">IRS </td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->gineco_irs}}</td>
				<td class="fondo" style="vertical-align: middle;">URS</td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->gineco_urs}}</td>
			</tr>
			<tr>
				<td class="fondo" style="vertical-align: middle;">MAC</td>
				<td style="vertical-align: middle;text-align: center">{{$pacientes[0]->nombre_campo_mac}}</td>
				<td class="fondo" style="vertical-align: middle;">Tipo de Parto</td>
				<td style="vertical-align: middle;text-align: center; width:80px;">{{$pacientes[0]->nombre_campo_partos}}</td>
				<td class="fondo" style="vertical-align: middle;">PAP</td>
				<td style="vertical-align: middle;text-align: center">
					@if($pacientes[0]->gineco_pap == 1)
						Si
					@else
						No
					@endif
				</td>
				<td class="fondo" style="vertical-align: middle;">Leucorrea</td>
				<td style="vertical-align: middle;text-align: center">@if($pacientes[0]->gineco_leucorrea == 1)
						Si
					@else
						No
					@endif</td>
			</tr>
			<tr>
				<td class="fondo" style="vertical-align: middle;">Dispaurenia</td>
				<td style="vertical-align: middle;text-align: center">@if($pacientes[0]->gineco_dispareunia == 1)
						Si
					@else
						No
					@endif</td>
			</tr>

			@if($pacientes[0]->paciente_antecedentes_gineco_otros && !(is_null($pacientes[0]->paciente_antecedentes_gineco_otros)))
			<tr>
				
				<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_antecedentes_gineco_otros))}}</p>
			</tr>
			@endif

	</table>

	@endif
	<br>
	@if( $pacientes[0]->tipo_id  < 5 )
		<table border=2>
			<tr>
	  			<td class="fondo" colspan="10" style="text-align: center;padding: 5px;font-weight: bold;">Examen Físico</td>
			</tr>
			<tr>
					<td class="fondo" style="vertical-align: middle;width:62px;">P.A.</td>
					<td  style="vertical-align: middle;text-align: center;width:62px;"> {{$pacientes[0]->fisico_pa}} </td>
					<td class="fondo"  style="vertical-align: middle;width:62px;">Pulso</td>
					<td  style="vertical-align: middle;text-align: center;width:62px;"> {{$pacientes[0]->fisico_pulso}} </td>
					<td class="fondo" style="vertical-align: middle;width:62px;">Tº</td>
					<td style="vertical-align: middle;text-align: center;width:62px;"> {{$pacientes[0]->fisico_temperatura}} </td>
					<td class="fondo" style="vertical-align: middle;width:62px;">F.R.</td>
					<td style="vertical-align: middle;text-align: center;width:62px;"> {{$pacientes[0]->fisico_frecuencia_respiratoria}} </td>
					<td class="fondo" style="vertical-align: middle;width:62px;">Sat. O2</td>
					<td  style="vertical-align: middle;text-align: center;width:62px;"> {{$pacientes[0]->fisico_sat_o2}} </td>
					
					
				</tr>
				<tr>
					<td class="fondo" style="vertical-align: middle;width:62px;">Talla</td>
					<td style="vertical-align: middle;text-align: center;width:62px;"> {{$pacientes[0]->fisico_talla}} </td>
					<td class="fondo" style="vertical-align: middle;width:62px;"> Peso </td>
					<td style="vertical-align: middle;text-align: center;width:62px;"> {{$pacientes[0]->fisico_peso}} </td>
				</tr>

				@if($pacientes[0]->paciente_observaciones_examen_fisicos && !(is_null($pacientes[0]->paciente_observaciones_examen_fisicos)))
				<tr>
					<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_observaciones_examen_fisicos))}}</p>
				</tr>
				@endif

		</table>
	@endif
	<br>

	@if(count($diagnosticos)>0)
	 <table border=2>
        <tr><td class="fondo" colspan="2" style="text-align: center;padding: 5px;font-weight: bold;">Diagnostico</td></tr>
		<tr><td class="fondo" style="vertical-align:middle;text-align:center;width: 80px;">Código</td>
        	<td class="fondo" style="vertical-align:middle;text-align:center;width:595px;">Descripción</td>
        </tr>
        @foreach($diagnosticos as $diagnostico)
            <tr>
                <td style="vertical-align:middle;text-align:center;">{{$diagnostico->id10}}</td>
                <td style="vertical-align:middle;text-align:left;">{{$diagnostico->dec10}}</td>
            </tr>
        @endforeach
    </table>
    <br>
    @endif
	
	@if( $pacientes[0]->tipo_id  < 5 )
	    @if($pacientes[0]->paciente_plantrabajo_ayuda_dignostica && !(is_null($pacientes[0]->paciente_plantrabajo_ayuda_dignostica)))
			<label class="fondo" for="" >Ayuda Diagnostica</label>	
			<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_plantrabajo_ayuda_dignostica))}}</p>
			<br>
		@endif
		
		@if($pacientes[0]->paciente_plantrabajo_laboratorio && !(is_null($pacientes[0]->paciente_plantrabajo_laboratorio)))
			<label class="fondo" for="" >Laboratorio</label>	
		
			<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_plantrabajo_laboratorio))}}</p>
			<br>
		@endif

		@if($pacientes[0]->paciente_plantrabajo_estudio_imagenes && !(is_null($pacientes[0]->paciente_plantrabajo_estudio_imagenes)))
			<label class="fondo" for="" >Imagenes</label>
			<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_plantrabajo_estudio_imagenes))}}</p>
			<br>
		@endif
		
		@if($pacientes[0]->paciente_plantrabajo_procedimientos_especiales && !(is_null($pacientes[0]->paciente_plantrabajo_procedimientos_especiales)))
			<label class="fondo" for="" >Procedimientos Especiales</label>	
			<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_plantrabajo_procedimientos_especiales))}}</p>
			<br>
		@endif
		
		@if($pacientes[0]->paciente_plantrabajo_interconsultas && !(is_null($pacientes[0]->paciente_plantrabajo_interconsultas)))
			<label class="fondo" for="" >InterConsultas</label>	
			<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_plantrabajo_interconsultas))}}</p>
			<br>
		@endif

		@if($pacientes[0]->paciente_plantrabajo_referencia && !(is_null($pacientes[0]->paciente_plantrabajo_referencia)))
			<label class="fondo" for="" >Referencias</label>	
			<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_plantrabajo_referencia))}}</p>
			<br>
		@endif

		@if($pacientes[0]->paciente_tratamiento && !(is_null($pacientes[0]->paciente_tratamiento)))
			<label class="fondo" for="" >Tratamiento</label>	
			<p style="text-align: justify;">{{ str_replace('</div>', '',str_replace('<div>', '', $pacientes[0]->paciente_tratamiento))}}</p>
			<br>
		@endif
	@endif

	<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por confiar en nosotros</div>
<script>
</script>
</body>
</html>