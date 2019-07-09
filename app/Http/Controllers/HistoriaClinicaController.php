<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\HistoriaTipos;
use App\MaestroFuncionesBiologicas;
use App\MaestroAntecedentesFamiliares;
use App\MaestroAntecedentesPatologicos;
use App\MaestroMacs;
use App\GinecoTipoPartos;
use App\Cie10;
use App\HistoriaClinica;
use App\Settings;
use PDF;

class HistoriaClinicaController extends Controller
{
    public function create()
    {

    	$historiatipos = HistoriaTipos::Listar_Historia_Tipos();
    	$biologicas = MaestroFuncionesBiologicas::Listar_Funciones_Biologicas();
    	$familiares = MaestroAntecedentesFamiliares::Listar_Funciones_Familiares();
    	$patologicos = MaestroAntecedentesPatologicos::Listar_Funciones_Patologicas();
    	$macs = MaestroMacs::Listar_Macs();
        $tipopartos = GinecoTipoPartos::Listar_Tipo_Partos();

		return view('historias.create',compact('historiatipos','biologicas','familiares','patologicos','macs','tipopartos'));

    }

    public function guardar(Request $request)
    {
        $data = $request->all();

       // var_dump($data);
        $bresultado = HistoriaClinica::Registrar_Historia_Clinica($data,Auth::user()->id,Auth::user()->name);

        if ($bresultado) {
            return redirect()->route('RegistrarHistoriaClinica')->with('success','La Historia se registro Correctamente' );
        } else {
            return redirect()->route('RegistrarHistoriaClinica')->with('warning','Ha Ocurrido un Error. Comunicarse con Soporte' );
        }

    }

    public function CambiarEstadoConsulta($dni,$correlativo)
    {

       $bresultado =  HistoriaClinica::Cambiar_Estado_Consulta($dni,$correlativo);        
       
        if ($bresultado) {
            return redirect()->route('ListarHistoriaClinicaxPaciente')->with('success','EL Estado de la Historia se Actualizo Correctamente.' );
        } else {
            return redirect()->route('ListarHistoriaClinicaxPaciente')->with('warning','Ha Ocurrido un Error. Comunicarse con Soporte' );
        }    
    }

    public function VerHistoria($dni,$correlativo)
    {

        //$historiatipos = HistoriaTipos::Listar_Historia_Tipos();
        $biologicas = MaestroFuncionesBiologicas::Listar_Funciones_Biologicas();
        $familiares = MaestroAntecedentesFamiliares::Listar_Funciones_Familiares();
        $patologicos = MaestroAntecedentesPatologicos::Listar_Funciones_Patologicas();
        $macs = MaestroMacs::Listar_Macs();
        $tipopartos = GinecoTipoPartos::Listar_Tipo_Partos();


        $pacientes =  HistoriaClinica::Listar_Datos_Historia($dni,$correlativo);

        $diagnosticos = HistoriaClinica::Listar_Datos_Diagnosticos($dni,$correlativo);

        $pacientes_biologicos = HistoriaClinica::Listar_Datos_Biologicos($dni,$correlativo);
        $pacientes_familiares = HistoriaClinica::Listar_Datos_Familiares($dni,$correlativo);
        $pacientes_patologicos = HistoriaClinica::Listar_Datos_Patologicos($dni,$correlativo);

        return view('historias.ver',compact('biologicas','familiares','patologicos','macs','tipopartos','pacientes','diagnosticos','pacientes_biologicos','pacientes_familiares','pacientes_patologicos'));

    }

    public function ImprimirHistoria($dni,$correlativo)
    {

        $biologicas = MaestroFuncionesBiologicas::Listar_Funciones_Biologicas();
        $familiares = MaestroAntecedentesFamiliares::Listar_Funciones_Familiares();
        $patologicos = MaestroAntecedentesPatologicos::Listar_Funciones_Patologicas();
        $macs = MaestroMacs::Listar_Macs();
        $tipopartos = GinecoTipoPartos::Listar_Tipo_Partos();

        // Obteniendo Datos de la Empresa.
        $empresas =  Settings::Listar_Datos_Empresa();

        $pacientes =  HistoriaClinica::Listar_Datos_Historia($dni,$correlativo);

        $diagnosticos = HistoriaClinica::Listar_Datos_Diagnosticos($dni,$correlativo);

        $pacientes_biologicos = HistoriaClinica::Listar_Datos_Biologicos($dni,$correlativo);
        $pacientes_familiares = HistoriaClinica::Listar_Datos_Familiares($dni,$correlativo);
        $pacientes_patologicos = HistoriaClinica::Listar_Datos_Patologicos($dni,$correlativo);

        $vistaurl="historias.impresion";

        $documento = strval('HC-' . strval($dni) . '-' . strval($correlativo) ); 

        $view =  \View::make($vistaurl,  ['biologicas' => $biologicas,
                                          'familiares'=>$familiares,
                                          'patologicos' => $patologicos,
                                          'macs'=>$macs,
                                          'tipopartos' => $tipopartos,
                                          'pacientes'=>$pacientes,
                                          'diagnosticos' => $diagnosticos,
                                          'pacientes_biologicos'=>$pacientes_biologicos,
                                          'pacientes_familiares' => $pacientes_familiares,
                                          'pacientes_patologicos'=>$pacientes_patologicos,
                                          'empresas' => $empresas])->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
         
         
        return $pdf->stream(strval($documento));

    }

    public function ListarHistoriaClinicaxPaciente()
    {
        return view('historias.listarxpaciente');
    }

    public function searchHistoriasPaciente(Request $request)
    {
        $name = $request->input('search');

        $this->validate($request, array(
            'search' => 'required|max:30',
        ));

        if ($name) {
            
            $atenciones = HistoriaClinica::Listar_Historias_Clinicas_x_Paciente($name);
            
            return response()->json($atenciones);
        }
    }
    public function searchcie10(Request $request)
    {

        $name = $request->input('search');

        $this->validate($request, array(
            'search' => 'required|max:30',
        ));

        if ($name) {
            $codigos = Cie10::Listar_search($name);
            return response()->json($codigos);
        }
    }

}
