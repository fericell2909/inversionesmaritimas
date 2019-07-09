<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
     protected $table='tiposdocumentos';
        public $primaryKey ='id';
    
    public static function Mostrar_Tipos_Documento()
    {
     return TipoDocumento::select(
                                    "tiposdocumentos.id as tipo_documento_id",
                                     "tiposdocumentos.descripcion_tipo_documento"
                                    )
                                ->get();   
    }

    public static function Listar_Tipo_Documento($id)
    {
    	return TipoDocumento::select(
    		                        "tiposdocumentos.id as tipo_documento_id",
    								 "tiposdocumentos.descripcion_tipo_documento"
    								)
    							->where("tiposdocumentos.id",$id)
    							->get();

    }

    public static function Listar_Tipos_Documentos_Factura_Boleta()
    {
        // Para que salga primero boleta a solicitud del cliente.
        return TipoDocumento::select(
                                    "tiposdocumentos.id as tipo_documento_id",
                                     "tiposdocumentos.descripcion_tipo_documento"
                                    )
                                ->whereIn('tiposdocumentos.id', [1, 2])
                                ->orderBy('tiposdocumentos.id','desc')
                                ->get();
    }

    public static function Listar_Tipos_Documentos_Factura()
    {
        // Para que salga primero boleta a solicitud del cliente.
        return TipoDocumento::select(
                                    "tiposdocumentos.id as tipo_documento_id",
                                     "tiposdocumentos.descripcion_tipo_documento"
                                    )
                                ->whereIn('tiposdocumentos.id', [1])
                                ->orderBy('tiposdocumentos.id','desc')
                                ->get();
    }    
}
