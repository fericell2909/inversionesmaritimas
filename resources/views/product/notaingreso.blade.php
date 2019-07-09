@extends('layouts.app')
@section('title', '| Crear Nueva Nota de Ingreso')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center text-info">Notas de Ingreso</h3>
        </div>
        <div class="panel-body">
            {{Form::open (['route' => 'product.postnotaingreso' ,'class' => 'form-horizontal'] )}}
                <div class="form-group row">
                    <div class="col-md-3">  
                        <label class="color-azul">Proveedor:</label>
                        <select name="proveedor_id" id="proveedor_id" class="form-control col-md-10">
                                @foreach($proveedores as $proveedor)                        
                                    <option value="{{$proveedor->id}}">{{$proveedor->name}}</option>
                                @endforeach
                        </select>
                    </div>
                      <div class="col-md-3">
                        <label class="color-azul">Tipo de Documento:</label>
                        <select class="form-control text-center" name="tipo_documento_id" id="tipo_documento_id">
                            @foreach($tiposdocumentos as $tiposdocumento)
                            <option value="{{ $tiposdocumento->tipo_documento_id }}" >{{ $tiposdocumento->descripcion_tipo_documento}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        {{Form::label('FechaDocumentoCompra','Fecha de Documento Compra:')}}
                        {{Form::text('FechaDocumentoCompra', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'text-center datepicker form-control', 'data-date-format' => 'yyyy-mm-dd'])}}
                    </div>
                    <div class="col-md-3">
                        {{Form::label('NumeroDocumento','Numero de Documento :')}}
                        {{Form::text('NumeroDocumento',null, ['class' => 'text-center form-control'])}}
                    </div>
                </div>   <!-- end col 6 -->
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="color-azul">Producto</label>
                        <select name="pidarticulo"  id="pidarticulo" class="form-control selectpicker" data-live-search="true">
                            @foreach($products as $producto)
                                <option value="{{$producto->p_id}}">{{$producto->p_gname }}</option>
                            @endforeach
                        </select>               
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <label class="color-azul">Cantidad</label>
                        <input type="number" name="pcantidad" id="pcantidad" class="form-control text-center" placeholder="Cantidad" value="1" >
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <label class="color-azul">Precio Unitario</label>
                        <input type="number" name="pprecio" id="pprecio" class="form-control text-center" placeholder="Cantidad" value="1.00" step="0.10" >
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <div class="form-group text-center">
                            <button class="btn btn-info" type="button" id="bt_add">Agregar</button>
                            <span class="help-block" id="mensaje-validacion"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12  col-md-12 col-xs-12 table-responsive">
                         <table id="detalles" class="table">
                            <thead  style="background-color:#03a9f4; color:#fff;">
                             
                                <th style="vertical-align:middle;text-align:center;">Accion</th>
                                <th style="vertical-align:middle;text-align:center;">Articulo</th>
                                <th style="vertical-align:middle;text-align:center;">Cantidad</th>
                                <th style="vertical-align:middle;text-align:center;">Precio Unitario</th>
                                <th style="vertical-align:middle;text-align:center;">Subtotal</th>
                              
                            </thead>
                            <tfoot>
                                 <th colspan="5" style="color: #03a9f4;text-align: right;"><h4 style="color: #03a9f4;" id="total">Total: S/ 0.00 </h4></th>
                                
                            </tfoot>
                            <tbody>
                            </tbody>
                          </table>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-6 col-sm-6 col-xs-12" id="guardar">
                        <button class="btn btn-info" type="submit"> Guardar</button>
                    </div>
                </div>
        {{Form::close()}}   <!-- end form !-->
        </div>   <!-- end div .panel-body-->
    </div>  <!-- end div .panel-->

    <script>
        $(document).ready(function(){
        $('#bt_add').click(function(){

            data=$('#pidarticulo').val();
            
            var repetidos = document.querySelectorAll(".filaagregada");
                repetidos = [].slice.call(repetidos);

            repetido = false;     
              $.each(repetidos, function( index, value ) {

                            if (parseInt(repetidos[index].value) == data) {
                                repetidos = null;                       
                                repetido = true;
                            };

                        });


            if (repetido) {
                alert('No se puede ingresar articulos repetidos');
            }
            else
            {
                idarticulo = $('#pidarticulo').val();
                articulo = $ ("#pidarticulo option:selected").text();
                cantidad = $('#pcantidad').val();
                precio =  $('#pprecio').val();
                
                agregar(idarticulo,articulo,cantidad,precio);  
            
            }

            });

        limpiar()

  });
  var cont=0;
  total=0;
  subtotal=[];
  
  $("#guardar").hide();

function agregar(idarticulo,articulo,cantidad,precio){
    
    if (cantidad <= 0) {
            alert('La Cantidad a Ingresar no puede ser menor a cero.'); 
            return;
        }

    if (precio <= 0) { 
            alert('El precio a Ingresar no puede ser menor a cero.'); 
            return; 
        }


    if (idarticulo!="" && articulo != "" && cantidad > 0 && precio!="" && precio > 0) {

    subtotal[cont]=cantidad*precio;
    total=total+subtotal[cont];
    
    var fila='<tr class="selected text-center" id="fila'+cont+'"><td><button type="button" class="btn btn-error" onclick="eliminar('+cont+');" style="margin:0; padding:5px;"><i class="fa fa-delete"></i>Eliminar</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'" class="filaagregada" style="border:none;">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'" class="text-center" readonly style="border:none;"></td><td><input type="number"  name="precio[]" value="'+precio+'" readonly class="text-center" style="border:none;"></td><td>'+subtotal[cont]+'</td></tr>';
        cont++;

        limpiar();
        // if (total > 0) { total = total.toFixed(2); }
        
        
        $('#total').html("S/."+total);
        //$('#total_ingreso').val(total);

        evaluar();
        
        $('#detalles').append(fila);
        
    }else{
        alert('Error al Ingresar Datos');
        return;
    }
}

function limpiar(){
    $("#pcantidad").val("0");
    $("#pprecio").val("0"); 
}

function evaluar()
  {
    if (total>0)
    {
      $("#guardar").show();
    }
    else
    {
      $("#guardar").hide(); 
    }
}
function eliminar(index){
    total=total-subtotal[index]; 
    total = total.toFixed(2);
    $("#total").html("S/. " + total); 
    //$("#total_ingreso").val(total);   
    $("#fila" + index).remove();
    evaluar();
}
    </script>
@endsection

