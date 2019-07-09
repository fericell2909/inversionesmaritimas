<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Serie;
use App\TipoDocumento;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user()->authorizeRoles(['superadmin','admin']);
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lt()
    {
        return view('setting.lt');
    }


    public function ltUpdate(Request $request, $id)
    {

        // If only language change

        $setting = Settings::find($id);

        if (!empty($request->language)) {
            $setting->language = $request->input('language');
        }
        if (!empty($request->color)) {
            $setting->color = $request->input('color');
        }
        if (!empty($request->currency)) {
            $setting->currency = $request->input('currency');
        }

        // If nothing change
        $setting->save();
        session()->flash('success', 'Cambios Realizados Correctamente');
        return redirect()->route('setting.lt');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function printer()
    {
        $printer = Settings::all()->last();
        return view('setting.printer')->withprinter($printer);
    }

    public function series()
    {
       
        $series = Serie::Listar_Series();
        return view('setting.series.index',compact('series'));
    }


    public function search(Request $request)
    {
        $number = $request->input('search');
        $this->validate($request, array(
            'search' => 'required|max:30',
        ));

        if ($number) {
            $series = Serie::Listar_Busqueda_Series($number);
            return $series;
        }
    }
    
    public function agregar()
    {
        $tiposdocumentos = TipoDocumento::Mostrar_Tipos_Documento();

        return view('setting.series.create',compact('tiposdocumentos'));

    }
    public function guardarserie(Request $request)
    {


        $data = $request->all();
        
        // validacion traer datos.
        if (isset($data['numero'])) {
            // validacion no repetido.
            // var_dump($data);
            $repetido = Serie::EsRepetido_Tipo_Documento_y_Serie($data['tipo_documento_id'],$data['numero']);

            if ($repetido) {
                
                session()->flash('warning', 'El Tipo de Documento y numero de Serie ya se encuentra asignado.');       
                return redirect()->route('series.agregar');
            } else {
                
                // insertar.

                $bresultado = Serie::Inserta_Tipo_Documento_y_Serie($data['tipo_documento_id'],$data['numero']);

                if ($bresultado) {
                    session()->flash('success', 'Datos Insertados Correctamente.');
                    return redirect()->route('setting.series');
                }else
                {
                    session()->flash('warning', 'Ha Ocurrido un Error al Intentar Agregar la Serie.');
                    return redirect()->route('series.agregar');
                }


            }
            

        } else
        {
            session()->flash('warning', 'El numero para la Serie no puede ser vacío.');
            return redirect()->route('series.agregar');
        }

        var_dump($data);

    }

    public function printerUpdate(Request $request, $id)
    {
        $printer = Settings::find($id);
        $printer->ph_name = $request->name;
        $printer->ph_address = $request->address;
        $printer->ph_telephone = $request->telephone;
        $printer->ph_fax = $request->fax;
        $printer->ph_email = $request->email;
        $printer->ph_print = $request->inprint;
        $printer->save();

        session()->flash('success', 'Actualizacion Correcta');
        return redirect()->route('setting.printer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function other()
    {
        return view('setting.other');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function otherUpdate(Request $request, $id)
    {
        $other = Settings::find($id);
        $other->barcode_type = $request->barcode;
        $other->save();
        session()->flash('success', 'Actualizacion Correcta');
        return redirect()->route('setting.other');
    }
}
