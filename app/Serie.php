<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table='series';
    public $primaryKey ='id';

    public static function Listar_Series()
    {
        return Serie::select("series.id as serie_id","series.cDenominacionSerie as cDenominacionSerie","tiposdocumentos.descripcion_tipo_documento as descripcion_tipo_documento","series.nCorrelativo as nCorrelativo",
            "series.updated_at as updated_at")
                      ->join("tiposdocumentos","tiposdocumentos.id","=","series.tipo_documento_id")
                      ->get(); 
    } 

    public static function Listar_Busqueda_Series($number)
    {
      $series = Serie::select("series.id as serie_id","series.cDenominacionSerie as cDenominacionSerie","tiposdocumentos.descripcion_tipo_documento as descripcion_tipo_documento","series.nCorrelativo as nCorrelativo",
            "series.updated_at as updated_at")
                      ->join("tiposdocumentos","tiposdocumentos.id","=","series.tipo_documento_id")
                       ->where('series.cDenominacionSerie', 'like', "$number%")
                      ->get();   
    
        return  response()->json($series);
    }

    public static function  listarseriesajax($id)
    {
        $series =  Serie::select("series.id as serie_id","series.cDenominacionSerie")
                      ->where("series.tipo_documento_id",$id)
                      ->get();

         return  response()->json($series);
    }

    public static function EsRepetido_Tipo_Documento_y_Serie($codigo_tipo_documento,$codigo_numero)
    {

        $series = Serie::select('series.id')
                        ->where('series.tipo_documento_id',$codigo_tipo_documento)
                        ->where('series.nNumero',$codigo_numero)
                        ->get();

        if (COUNT($series)> 0) {return true;}else{return false;}
        
    }

    public static function Inserta_Tipo_Documento_y_Serie($codigo_tipo_documento,$codigo_numero)
    {
        $codigo_letra = '';
        

        switch ($codigo_tipo_documento) {
            case 1:
                $codigo_letra = 'F';
                break;
            
            case 2:
                $codigo_letra = 'B';
                break;

            case 3:
                $codigo_letra = 'N';
                break;
            default:
                $codigo_letra = 'D';
                break;
        }

        $denominacion = $codigo_letra . substr('00000' . strval($codigo_numero),-3);

        $datos = new Serie();
        $datos->tipo_documento_id = $codigo_tipo_documento;
        $datos->nNumero = $codigo_numero;
        $datos->cDenominacionSerie = $denominacion;
        $datos->nCorrelativo = 0;

        $datos->save();

        $denominacion = null;
        $codigo_letra = null;        

        return true;

    }

    public static function Listar_Series_Facturas()
    {
    	return Serie::select("series.id as serie_id","series.cDenominacionSerie")
    				  ->where("series.tipo_documento_id",1)
    				  ->get();
    }

    public static function Listar_Series_Boletas()
    {

        return Serie::select("series.id as serie_id","series.cDenominacionSerie")
                      ->where("series.tipo_documento_id",2)
                      ->get();

    }

    public static Function ActualizarCorrelativo($id)
    {
    	$cantidad = Serie::select("series.nCorrelativo")
    				  ->where("series.id",$id)
    				  ->get();


    	 $valores=array('nCorrelativo'=>intval($cantidad[0]->nCorrelativo) + 1 );

            Serie::where('id',$id)
                ->update($valores);

            $valores = null;
            $cantidad = null;
      
    }

    public static function DevuelveFormatoDenominacionSerie($id)
    {
        $Denominacion = Serie::selectRAW("CONCAT(series.cDenominacionSerie,'-000000',series.nCorrelativo) AS cDenominacionSerie")
                      ->where("series.id",$id)
                      ->get();

        //return $Denominacion[0]->cDenominacionSerie + '-0000'+ strval($Denominacion[0]->nCorrelativo);
        //$retorno = $Denominacion[0]->cDenominacionSerie + '-0000'; 
        return $Denominacion[0]->cDenominacionSerie;
         
        //return $retorno;
    }
    public static function DevuelveCorrelativo($id)
    {
    	$correlativo = Serie::select("series.nCorrelativo")
    				  ->where("series.id",$id)
    				  ->get();

    	return $correlativo[0]->nCorrelativo;
    
    }

}
