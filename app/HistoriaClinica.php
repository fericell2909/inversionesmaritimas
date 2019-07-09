<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;

use App\Paciente;
use App\HistoriaClinicaBiologicas;
use App\HistoriaClinicaDiagnostico;
use App\HistoriaClinicaFamiliares;
use App\HistoriaClinicaPatologicos;
use App\Cie10;

class HistoriaClinica extends Model
{
	protected $table='historias_clinicas';

	public static function Listar_Datos_Patologicos($dni,$correlativo)
	{
		$id_paciente = Paciente::Devuelve_ID_Paciente_x_Dni($dni);

		return HistoriaClinicaPatologicos::select('hc__patologicos.pato_id','hc__patologicos.valor_id')
											->where('hc__patologicos.paciente_id',$id_paciente)
											->where('hc__patologicos.ncorrelativo',$correlativo)
											->get();

	}

	public static function Listar_Datos_Familiares($dni,$correlativo)
	{

		$id_paciente = Paciente::Devuelve_ID_Paciente_x_Dni($dni);

		return HistoriaClinicaFamiliares::select('hc__familiares.fam_id','hc__familiares.valor_id')
											->where('hc__familiares.paciente_id',$id_paciente)
											->where('hc__familiares.ncorrelativo',$correlativo)
											->get();

	}

	public static function Cambiar_Estado_Consulta($dni,$correlativo)
	{

		$id_paciente = Paciente::Devuelve_ID_Paciente_x_Dni($dni);

		$historias = HistoriaClinica::select('historias_clinicas.estado_id')
								->where('historias_clinicas.paciente_id',$id_paciente)
								->where('historias_clinicas.ncorrelativo',$correlativo)
								->get();


		if (count($historias) > 0 ) {
				
			$valor_actualizar = 0;

			if ($historias[0]->estado_id == 1) {
				$valor_actualizar = 2;
			} else {
				$valor_actualizar = 1;
			}
			
			$valores=array('estado_id'=> $valor_actualizar);

	            HistoriaClinica::where('historias_clinicas.paciente_id',$id_paciente)
	            				->where('historias_clinicas.ncorrelativo',$correlativo)
	                			->update($valores);

	            HistoriaClinicaBiologicas::where('hc_biologicas.paciente_id',$id_paciente)
	            				->where('hc_biologicas.ncorrelativo',$correlativo)
	                			->update($valores);

	            HistoriaClinicaFamiliares::where('hc__familiares.paciente_id',$id_paciente)
	            				->where('hc__familiares.ncorrelativo',$correlativo)
	                			->update($valores);

	            HistoriaClinicaPatologicos::where('hc__patologicos.paciente_id',$id_paciente)
	            				->where('hc__patologicos.ncorrelativo',$correlativo)
	                			->update($valores);

	            HistoriaClinicaDiagnostico::where('hc__diagnostico.paciente_id',$id_paciente)
	            				->where('hc__diagnostico.ncorrelativo',$correlativo)
	                			->update($valores);

			return true;
		} else {
			return false;
		}
		
	}

	public static function Listar_Datos_Biologicos($dni,$correlativo)
	{

		$id_paciente = Paciente::Devuelve_ID_Paciente_x_Dni($dni);
		
		return HistoriaClinicaBiologicas::select('hc_biologicas.bio_id','hc_biologicas.valor_id')
											->where('hc_biologicas.paciente_id',$id_paciente)
											->where('hc_biologicas.ncorrelativo',$correlativo)
											->get();

	}

	public static function Listar_Datos_Diagnosticos($dni,$correlativo)
	{

		$id_paciente = Paciente::Devuelve_ID_Paciente_x_Dni($dni);

		return HistoriaClinicaDiagnostico::select(  'hc__diagnostico.paciente_id',
													'hc__diagnostico.sexo_id',
													'hc__diagnostico.tipo_id',
													'hc__diagnostico.ncorrelativo',
													'hc__diagnostico.estado_id',
													'hc__diagnostico.diag_id',
													'hc__diagnostico.id10',
													'hc__diagnostico.dec10')
											->where('hc__diagnostico.paciente_id',$id_paciente)
											->where('hc__diagnostico.ncorrelativo',$correlativo)
											->get();
	}

	public static function Listar_Datos_Historia($dni,$correlativo)
	{

		$id_paciente = Paciente::Devuelve_ID_Paciente_x_Dni($dni);

		return HistoriaClinica::select( 'historias_clinicas.paciente_id','historias_clinicas.sexo_id',
										'historias_clinicas.tipo_id',
										'historias_clinicas.ncorrelativo',
										'historias_clinicas.fecha_historia',
										'historias_clinicas.user_id',
										'historias_clinicas.nombre_medico',
										'historias_clinicas.estado_id',
										'historias_clinicas.acompanante',
										'historias_clinicas.paciente_funciones_biologicas',
										'historias_clinicas.paciente_antecedentes_generales',
										'historias_clinicas.paciente_antecedentes_fisiologicos',
										'historias_clinicas.paciente_antecedentes_familiares_otros',
										'historias_clinicas.paciente_antecedentes_patologicos_otros',
										'historias_clinicas.gineco_menarquia',
										'historias_clinicas.gineco_regimen_catamenial',
										'historias_clinicas.gineco_fur',
										'historias_clinicas.gineco_edad_gestacional',
										'historias_clinicas.gineco_gesta',
										'historias_clinicas.gineco_para',
										'historias_clinicas.gineco_irs',
										'historias_clinicas.gineco_urs',
										'historias_clinicas.gineco_mac',
										'historias_clinicas.gineco_tipo_parto',
										'historias_clinicas.gineco_pap',
										'historias_clinicas.gineco_leucorrea',
										'historias_clinicas.gineco_dispareunia',
										'historias_clinicas.paciente_antecedentes_gineco_otros',
										'historias_clinicas.fisico_pa',
										'historias_clinicas.fisico_pulso',
										'historias_clinicas.fisico_temperatura',
										'historias_clinicas.fisico_frecuencia_respiratoria',
										'historias_clinicas.fisico_sat_o2',
										'historias_clinicas.fisico_imc',
										'historias_clinicas.fisico_talla',
										'historias_clinicas.fisico_peso',
										'historias_clinicas.paciente_observaciones_examen_fisicos',
										'historias_clinicas.paciente_plantrabajo_ayuda_dignostica',
										'historias_clinicas.paciente_plantrabajo_laboratorio',
										'historias_clinicas.paciente_plantrabajo_estudio_imagenes',
										'historias_clinicas.paciente_plantrabajo_procedimientos_especiales',
										'historias_clinicas.paciente_plantrabajo_interconsultas',
										'historias_clinicas.paciente_plantrabajo_referencia',
										'historias_clinicas.paciente_tratamiento','pacientes.apellido_paterno','pacientes.apellido_materno','pacientes.nombres','pacientes.edad','sexos.nombre_sexo as sexo','gruposanguineos.nombre_grupo as gruposanguineo','pacientes.fecha_nacimiento','pacientes.estado_id','pacientes.dni','historiatipos.nombre_historia','pacientes.celular','maestro_macs.nombre_campo as nombre_campo_mac','gineco_tipo_partos.nombre_campo as nombre_campo_partos',
										'historias_clinicas.paciente_general_apreciacion',
							            'historias_clinicas.paciente_general_piel_faneras',
							            'historias_clinicas.paciente_general_conjuntivas',
							            'historias_clinicas.paciente_general_cuello',
							            'historias_clinicas.paciente_general_torax_pulmones',
							            'historias_clinicas.paciente_general_cardiovascular',
							            'historias_clinicas.paciente_general_abdomen',
							            'historias_clinicas.paciente_general_genito_urinario',
							            'historias_clinicas.paciente_general_sistema_nervioso'
										)
								->join('pacientes','pacientes.id','=','historias_clinicas.paciente_id')
								->join('historiatipos','historiatipos.id','historias_clinicas.tipo_id')
								->join('sexos','sexos.id','pacientes.sexo_id')
								->join('gruposanguineos','gruposanguineos.id','pacientes.grupo_sanguineo_id')
								->join('maestro_macs','maestro_macs.id','historias_clinicas.gineco_mac')
								->join('gineco_tipo_partos','gineco_tipo_partos.id','historias_clinicas.gineco_tipo_parto')
								->where('historias_clinicas.paciente_id',$id_paciente)
								->where('historias_clinicas.ncorrelativo',$correlativo)
								->get();

	}

	public static function Listar_Historias_Clinicas_x_Paciente($name)
	{

		return HistoriaClinica::select('historias_clinicas.paciente_id','historias_clinicas.sexo_id','historias_clinicas.tipo_id','historias_clinicas.ncorrelativo','pacientes.id','pacientes.apellido_paterno','pacientes.apellido_materno','pacientes.nombres','pacientes.edad','sexos.nombre_sexo as sexo','gruposanguineos.nombre_grupo as gruposanguineo','pacientes.fecha_nacimiento','pacientes.estado_id','pacientes.dni','historiatipos.nombre_historia','historias_clinicas.estado_id as estado_id_historia')
                ->join('pacientes','pacientes.id','=','historias_clinicas.paciente_id')
                ->join('estados','estados.id','pacientes.estado_id')
    			->join('sexos','sexos.id','pacientes.sexo_id')
    			->join('gruposanguineos','gruposanguineos.id','pacientes.grupo_sanguineo_id')
    			->join('historiatipos','historiatipos.id','historias_clinicas.tipo_id')
                ->Where('pacientes.dni', 'like', "$name%")
                ->orWhere('pacientes.apellido_paterno', 'like', "$name%")
                ->OrderBy('historias_clinicas.ncorrelativo','asc')
                ->get();

	}
    public static function Registrar_Historia_Clinica($data,$codigo_usuario,$nombre_usuario)
    {

    	$Numero_Correlativo = Paciente::Devuelve_Correlativo_Paciente($data['paciente-id']);

    	$sexo = Paciente::Devuelve_Sexo_Paciente($data['paciente-id']);

    	$Numero_Correlativo = $Numero_Correlativo + 1;


    	if ($Numero_Correlativo > 0) {

    			// try {
    				
    			// 	DB::beginTransaction();

    				$historia = new HistoriaClinica();

	    					$historia->paciente_id = $data['paciente-id'];
	    					$historia->sexo_id = $sexo;
							$historia->tipo_id = $data['tipo_historia_id'];
							$historia->ncorrelativo = $Numero_Correlativo;
							$historia->fecha_historia = $data['fecha_historia'];
							$historia->user_id = $codigo_usuario;
							$historia->nombre_medico = $nombre_usuario;
							$historia->estado_id = 1;
							$historia->acompanante = $data['paciente_acompanante'];	

            				$historia->paciente_funciones_biologicas = $data['paciente_funciones_biologicas'];
				            $historia->paciente_antecedentes_generales = $data['paciente_antecedentes_generales'];
				            $historia->paciente_antecedentes_fisiologicos = $data['paciente_antecedentes_fisiologicos'];
				            $historia->paciente_antecedentes_familiares_otros = $data['paciente_antecedentes_familiares_otros'];
				            $historia->paciente_antecedentes_patologicos_otros = $data['paciente_antecedentes_patologicos_otros'];
				            $historia->gineco_menarquia = $data['gineco_menarquia'];
				            $historia->gineco_regimen_catamenial = $data['gineco_regimen_catamenial'];
				            $historia->gineco_fur = $data['gineco_fur'];
				            $historia->gineco_edad_gestacional = $data['gineco_edad_gestacional'];
				            $historia->gineco_gesta = $data['gineco_gesta'];
				            $historia->gineco_para = $data['gineco_para'];
				            $historia->gineco_irs = $data['gineco_irs'];
				            $historia->gineco_urs = $data['gineco_urs'];
				            $historia->gineco_mac = $data['gineco_mac'];
				            $historia->gineco_tipo_parto = $data['gineco_tipo_parto'];
				            $historia->gineco_pap = $data['gineco_pap'];
				            $historia->gineco_leucorrea = $data['gineco_leucorrea'];
				            $historia->gineco_dispareunia = $data['gineco_dispareunia'];
				            $historia->paciente_antecedentes_gineco_otros = $data['paciente_antecedentes_gineco_otros'];

				            $historia->fisico_pa = $data['fisico_pa'];
				            $historia->fisico_pulso = $data['fisico_pulso'];
				            $historia->fisico_temperatura = $data['fisico_temperatura'];
				            $historia->fisico_frecuencia_respiratoria = $data['fisico_frecuencia_respiratoria'];
				            $historia->fisico_sat_o2 = $data['fisico_sat_o2'];
				            $historia->fisico_imc = $data['fisico_imc'];
				            $historia->fisico_talla = $data['fisico_talla'];
				            $historia->fisico_peso = $data['fisico_peso'];
				            $historia->paciente_observaciones_examen_fisicos = $data['paciente_observaciones_examen_fisicos']; 

				            $historia->paciente_plantrabajo_ayuda_dignostica = $data['paciente_plantrabajo_ayuda_dignostica'];
				            $historia->paciente_plantrabajo_laboratorio = $data['paciente_plantrabajo_laboratorio'];
				            $historia->paciente_plantrabajo_estudio_imagenes = $data['paciente_plantrabajo_estudio_imagenes']; 
				            $historia->paciente_plantrabajo_procedimientos_especiales = $data['paciente_plantrabajo_procedimientos_especiales']; 
				            $historia->paciente_plantrabajo_interconsultas = $data['paciente_plantrabajo_interconsultas'];
				            $historia->paciente_plantrabajo_referencia = $data['paciente_plantrabajo_referencia']; 
				            $historia->paciente_tratamiento = $data['paciente_tratamiento']; 

				            $historia->paciente_general_apreciacion = $data['paciente_general_apreciacion'];
				            $historia->paciente_general_piel_faneras = $data['paciente_general_piel_faneras'];
				            $historia->paciente_general_conjuntivas = $data['paciente_general_conjuntivas'];
				            $historia->paciente_general_cuello = $data['paciente_general_cuello'];
				            $historia->paciente_general_torax_pulmones = $data['paciente_general_torax_pulmones'];
				            $historia->paciente_general_cardiovascular = $data['paciente_general_cardiovascular'];
				            $historia->paciente_general_abdomen = $data['paciente_general_abdomen'];
				            $historia->paciente_general_genito_urinario = $data['paciente_general_genito_urinario'];
				            $historia->paciente_general_sistema_nervioso = $data['paciente_general_sistema_nervioso'];


							$historia->save();

							// Se Registro Historia Clinica.

							// Insertar hc_biologica

								for ($i=0; $i < count($data['biologicas']) ; $i++) { 
									
									$biologicas = new HistoriaClinicaBiologicas();

            						$biologicas->paciente_id = $data['paciente-id'];
            						$biologicas->sexo_id = $sexo;
            						$biologicas->tipo_id = $data['tipo_historia_id'];
            						$biologicas->ncorrelativo = $Numero_Correlativo;
            						$biologicas->estado_id = 1;
            						$biologicas->bio_id = $i + 1;
            						$biologicas->valor_id = $data['biologicas'][$i];
            						$biologicas->save();
								
								}

							// Fin Biologica

							// Insertar Familiares

								for ($i=0; $i < count($data['familiares']) ; $i++) { 
									
									$familiares = new HistoriaClinicaFamiliares();

            						$familiares->paciente_id = $data['paciente-id'];
            						$familiares->sexo_id = $sexo;
            						$familiares->tipo_id = $data['tipo_historia_id'];
            						$familiares->ncorrelativo = $Numero_Correlativo;
            						$familiares->estado_id = 1;
            						$familiares->fam_id = $i + 1;
            						$familiares->valor_id = $data['familiares'][$i];
            						$familiares->save();
								}
								
							// Fin Fammiliares

							// Insertar Patologicos

								for ($i=0; $i < count($data['patologicos']) ; $i++) { 
									
									$patologicos = new HistoriaClinicaPatologicos();

            						$patologicos->paciente_id = $data['paciente-id'];
            						$patologicos->sexo_id = $sexo;
            						$patologicos->tipo_id = $data['tipo_historia_id'];
            						$patologicos->ncorrelativo = $Numero_Correlativo;
            						$patologicos->estado_id = 1;
            						$patologicos->pato_id = $i + 1;
            						$patologicos->valor_id = $data['patologicos'][$i];
            						$patologicos->save();
								}

							// Fin Patologicos

							// Insertar Diagnostico

								for ($i=0; $i < count($data['idarticulo']) ; $i++) { 
									
									$patologicos = new HistoriaClinicaDiagnostico();
									
									$datos = Cie10::Devuelve_Datos_Cie10($data['idarticulo'][$i]);				
            						
            						$patologicos->paciente_id = $data['paciente-id'];
            						$patologicos->sexo_id = $sexo;
            						$patologicos->tipo_id = $data['tipo_historia_id'];
            						$patologicos->ncorrelativo = $Numero_Correlativo;
            						$patologicos->estado_id = 1;
            						$patologicos->diag_id = $datos[0]->id;
            						$patologicos->id10 = $datos[0]->id10;
            						$patologicos->dec10 = $datos[0]->dec10;
            						$patologicos->valor_id = $i + 1;
            						$patologicos->save();
								
								}


								// Actualizar Paciente Correlativo y HistoriaClinica.

									Paciente::Actualiza_Historia_Paciente($data['paciente-id'],$Numero_Correlativo);

								//  Fin Actualizacion Datos Paciente.

								return true;

    		} else {
    			
    			return false;

    	 }

    }
}
