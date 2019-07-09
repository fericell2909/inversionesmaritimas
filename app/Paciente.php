<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;

use App\Customers;

class Paciente extends Model
{
    protected $table='pacientes';
    public $primaryKey ='id';

    public static function Listar_Pacientes()
    {
    	return Paciente::select('pacientes.id','pacientes.apellido_paterno','pacientes.apellido_materno','pacientes.nombres',
                                'pacientes.edad','sexos.nombre_sexo as sexo','gruposanguineos.nombre_grupo as gruposanguineo','pacientes.fecha_nacimiento','pacientes.estado_id','pacientes.dni')
    					->join('estados','estados.id','pacientes.estado_id')
    					->join('sexos','sexos.id','pacientes.sexo_id')
    					->join('gruposanguineos','gruposanguineos.id','pacientes.grupo_sanguineo_id')
    					->OrderBy('pacientes.id','desc')
    					->take(50)
    				->get();
    }
    public static function Listar_search($name)
    {
         return Paciente::select('pacientes.id','pacientes.apellido_paterno','pacientes.apellido_materno','pacientes.nombres',
                          'pacientes.edad','sexos.nombre_sexo as sexo','gruposanguineos.nombre_grupo as gruposanguineo',
                          'pacientes.fecha_nacimiento','pacientes.estado_id','pacientes.dni')
                    ->join('estados','estados.id','pacientes.estado_id')
                    ->join('sexos','sexos.id','pacientes.sexo_id')
                    ->join('gruposanguineos','gruposanguineos.id','pacientes.grupo_sanguineo_id')
                ->where('pacientes.apellido_paterno', 'like', "$name%")
                ->where('pacientes.apellido_materno', 'like', "$name%")
                ->orWhere('pacientes.dni', 'like', "$name%")
                ->OrderBy('pacientes.id','desc')
                ->get();
    }

    public static function Buscar_Paciente_X_ID($id)
    {
        return Paciente::select('pacientes.apellido_paterno','pacientes.apellido_materno','pacientes.nombres','pacientes.dni',
                                'pacientes.sexo_id','pacientes.direccion','pacientes.telefono','pacientes.celular','pacientes.fecha_nacimiento',
                                'pacientes.edad','pacientes.grupo_sanguineo_id','pacientes.estado_id','pacientes.user_id',
                                'pacientes.lugarnacimiento',
                                'pacientes.estado_civil_id',
                                'pacientes.CarnetExtranjeria',
                                'pacientes.DomicilioActual',
                                'pacientes.DomicilioProcedencia',
                                'pacientes.GradoInstruccion',
                                'pacientes.Ocupacion',
                                'pacientes.Religion',
                                'pacientes.NombreAcompanante',
                                'pacientes.GradoParentesco',
                                'pacientes.DomicilioAcompanante',
                                'estadociviles.nombre_estado_civil' ,'sexos.nombre_sexo as sexo'  
                                )
                            ->join('estadociviles','estadociviles.id','pacientes.estado_civil_id')
                            ->join('sexos','sexos.id','pacientes.sexo_id')
                        ->where('pacientes.id',$id)
                        ->get();


    }
  
    private function Existe_DNI($dni)
    {
        $paciente = Paciente::select('pacientes.dni')
                              ->where('pacientes.dni',$dni)
                              ->get();

        if (count($paciente) > 0) {
            return true;
        } else {
            return false;
        }

    }

    private function CalculaEdad( $fecha ) {
        list($Y,$m,$d) = explode("-",$fecha);
        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }   

    public static function Editar_Paciente($data,$codigo_usuario)
    {

        try {
                
                DB::beginTransaction();
                
                $paciente = new Paciente();

                $valoractualizar = array('apellido_paterno'=> $data['apellido_paterno'],
                                        'apellido_materno'=> $data['apellido_materno'],
                                        'nombres'=> $data['nombres'],
                                        'dni'=> $data['dni'],
                                        'sexo_id'=> $data['sexo_id'],
                                        'direccion'=> $data['direccion'],
                                        'telefono'=> $data['telefono'],
                                        'celular'=> $data['celular'],
                                        'fecha_nacimiento'=> $data['fecha_nacimiento'],
                                        'edad'=> $paciente->CalculaEdad($data['fecha_nacimiento']),
                                        'grupo_sanguineo_id'=> $data['grupo_sanguineo_id'],
                                        'estado_id'=> $data['estado_id'],
                                        'user_id'=> $codigo_usuario,
                                        'lugarnacimiento' => $data['lugarnacimiento'],
                                        'estado_civil_id' => $data['estado_civil_id'],
                                        'CarnetExtranjeria' => $data['CarnetExtranjeria'],
                                        'DomicilioActual' => $data['DomicilioActual'],
                                        'DomicilioProcedencia' => $data['DomicilioProcedencia'],
                                        'GradoInstruccion' => $data['GradoInstruccion'],
                                        'Ocupacion' => $data['Ocupacion'],
                                        'Religion' => $data['Religion'],
                                        'NombreAcompanante' => $data['NombreAcompanante'],
                                        'GradoParentesco' => $data['GradoParentesco'],
                                        'DomicilioAcompanante' => $data['DomicilioAcompanante'],
                                        );

                Paciente::where('dni',$data['dni'])
                        ->update($valoractualizar);

                $valoractualizar = null;          

                DB::commit();

                return 1;

        } catch (Exception $e) {
            DB::rollback();

            return 0; 
        }



    }

    public static function Devuelve_Correlativo_Paciente($codigo_paciente)
    {

       $paciente = Paciente::select('pacientes.nNumeroHistoriaClinica')
                              ->where('pacientes.id',$codigo_paciente)
                              ->get();

        if ( count($paciente) > 0) {
            
            return $paciente[0]->nNumeroHistoriaClinica; 

        } else {
            
            return -1;
        }
        

    }

    public static function Devuelve_ID_Paciente_x_Dni($dni)
    {

        $paciente = Paciente::select('pacientes.id')
                              ->where('pacientes.dni',$dni)
                              ->get();

        if ( count($paciente) > 0) {
            
            return $paciente[0]->id; 

        } else {
            
            return -1;
        }

    }

    public static function Actualiza_Historia_Paciente($codigo_paciente,$numero_correlativo)
    {
         $valores=array('bHistoriaClinica'=> 1,'nNumeroHistoriaClinica' => $numero_correlativo);

          Paciente::where('id',$codigo_paciente)
                ->update($valores);

            $valores = null;


    }

    public static function Devuelve_Sexo_Paciente($codigo_paciente)
    {

       $paciente = Paciente::select('pacientes.sexo_id')
                              ->where('pacientes.id',$codigo_paciente)
                              ->get();

        if ( count($paciente) > 0) {
            
            return $paciente[0]->sexo_id; 

        } else {
            
            return -1;
        }
        

    }

    public static function Registrar_Paciente($data,$codigo_usuario)
    {

        try {
                                
                $paciente = new Paciente();

                if ($paciente->Existe_DNI($data['dni'])) {
                        
                    return -1;

                    } else
                    {
                        DB::beginTransaction();

                        $paciente->apellido_paterno = $data['apellido_paterno'];
                        $paciente->apellido_materno = $data['apellido_materno'];
                        $paciente->nombres = $data['nombres'];
                        $paciente->dni = $data['dni'];
                        $paciente->sexo_id = $data['sexo_id'];
                        $paciente->direccion = $data['direccion'];
                        $paciente->telefono = $data['telefono'];
                        $paciente->celular = $data['celular'];
                        $paciente->fecha_nacimiento = $data['fecha_nacimiento'];
                        $paciente->grupo_sanguineo_id = $data['grupo_sanguineo_id'];
                        $paciente->estado_id = $data['estado_id'];
                        $paciente->edad = $paciente->CalculaEdad($data['fecha_nacimiento']);
                        $paciente->user_id = $codigo_usuario;

                        $paciente->lugarnacimiento = $data['lugarnacimiento'];
                        $paciente->estado_civil_id = $data['estado_civil_id'];
                        $paciente->CarnetExtranjeria = $data['CarnetExtranjeria'];
                        $paciente->DomicilioActual = $data['DomicilioActual'];
                        $paciente->DomicilioProcedencia = $data['DomicilioProcedencia'];
                        $paciente->GradoInstruccion = $data['GradoInstruccion'];
                        $paciente->Ocupacion = $data['Ocupacion'];
                        $paciente->Religion = $data['Religion'];
                        $paciente->NombreAcompanante = $data['NombreAcompanante'];
                        $paciente->GradoParentesco = $data['GradoParentesco'];
                        $paciente->DomicilioAcompanante = $data['DomicilioAcompanante'];



                        $paciente->save();

                        // Registrarlo como Cliente.

                            $bresultado = Customers::Registrar_Cliente_Natural_Desde_Paciente($data,$codigo_usuario);

                        // Fin Registrar Como Cliente Natural.



                        DB::commit();

                        return 1;

                    }


        } catch (Exception $e) {
            DB::rollback();

            return 0; 
        }


    }

}
