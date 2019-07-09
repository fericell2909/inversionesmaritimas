<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Paciente;
use App\Sexo;
use App\GrupoSanguineo;
use App\Estado;
use App\EstadoCivil;
use App\Settings;
use PDP;

class PacienteController extends Controller
{
	// Listado de Pacientes.
 	public function index()
 	{
 		
 		$pacientes = Paciente::Listar_Pacientes();
 		
 		return view('pacientes.index',compact('pacientes'));

 	}

 	// Esto es para registrar al paciente.
 	public function create()
 	{
 		$sexos =  Sexo::Listar_Sexos();
 		$sanguineos = GrupoSanguineo::Listar_Grupos();
 		$estados = Estado::Listar_Estados();
 		$estadociviles = EstadoCivil::Listar_Estados_Civiles(); 


 		return view('pacientes.create',compact('sexos','sanguineos','estados','estadociviles'));
 		
 	}

 	public function search(Request $request)
 	{

 		$name = $request->input('search');

        $this->validate($request, array(
            'search' => 'required|max:30',
        ));

        if ($name) {
            $pacientes = Paciente::Listar_search($name);
            return response()->json($pacientes);
        }
 	}

 	public function edit($id)
 	{

 		$sexos =  Sexo::Listar_Sexos();
 		$sanguineos = GrupoSanguineo::Listar_Grupos();
 		$estados = Estado::Listar_Estados();
 		$pacientes = Paciente::Buscar_Paciente_X_ID($id);
 		$estadociviles = EstadoCivil::Listar_Estados_Civiles(); 

 		return view('pacientes.edit',compact('sexos','sanguineos','estados','pacientes','estadociviles'));

 	}

 	public function ImprimirFicha($id)
 	{

  		$empresas =  Settings::Listar_Datos_Empresa();
        $pacientes = Paciente::Buscar_Paciente_X_ID($id);
        
        $vistaurl = 'pacientes.imprimirficha';

        return $this->pdfImprimirFicha($empresas,$pacientes,$vistaurl,2);

    }
    private function pdfImprimirFicha($empresa,$paciente,$vistaurl,$tipo)
    {
        $empresas = $empresa;

        $pacientes = $paciente;
        
        $nombre_documento = 'Reporte-Ficha-Filiacion'; 

        $view =  \View::make($vistaurl,['empresas' => $empresas,'pacientes' => $pacientes])->render();
        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
         
        //return $pdf; 
        if($tipo==2){return $pdf->stream(strval($nombre_documento));}
        if($tipo==1){return $pdf->download(strval($nombre_documento).'.pdf');}        
    
    } 

 	public function saveedit(Request $request)
 	{
		
		$data = $request->all();

		$bretorno = Paciente::Editar_Paciente($data,Auth::user()->id);

		// Grabacion Exitosa.
		if ($bretorno == 1) {
 			
 				return redirect()->route('ListarPacientes')->with('success','El paciente se edito correctamente.' );
 				
	 		} else {

	 			return redirect()->route('ListarPacientes')->with('warning','No se pudo editar al paciente. Comunicarse con Sistemas.');
	 		
	 		}


 	}
 	public function save(Request $request)
 	{

 		$data = $request->all();

 		$bretorno = Paciente::Registrar_Paciente($data,Auth::user()->id);

 		if ($bretorno == 1) {
 			
 			return redirect()->route('ListarPacientes')->with('success','Se Registro el paciente correctamente.');
 			
 		} else {

 			if ($bretorno == -1) {
 			
 				return redirect()->route('ListarPacientes')->with('warning','El paciente ya se encuentra registrado. DNI' );
 				
	 		} else {

	 			return redirect()->route('ListarPacientes')->with('warning','No se pudo registrar al paciente.');
	 		
	 		}
 	
 		}
 		

 	}
}
