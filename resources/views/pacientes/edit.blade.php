@extends('layouts.app')
@section('title', '| Editara Paciente')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            
            <div class="col-xs-12">

                <h3 class="text-center text-info"><i class="fa fa-wheelchair" aria-hidden="true"></i> Editar Paciente <i class="fa fa-wheelchair" aria-hidden="true"></i></h3>
                {{ Form::open(['route' => 'EditarPacientes', 'class' => 'form-horizontal','method'=>'POST']) }}
                <div class="form-group">
                    {{Form::label('apellido_paterno' , 'Apellido Paterno', ['class' => 'control-label col-sm-2'])}}
                    <div class="col-sm-6">
                        {{Form::text('apellido_paterno', $pacientes[0]->apellido_paterno, ['required' => 'required','class'=>'form-control letras text-center', 'placeholder' => 'Apellido Paterno'])}}
                    </div>
                    <span  id ="ErrorMensaje-apellido_paterno" class="help-block">Ingrese Apellido Paterno</span>
                </div>
                <div class="form-group">
                    {{Form::label('apellido_materno' , 'Apellido Materno', ['class' => 'control-label col-sm-2'])}}
                    <div class="col-sm-6">
                        {{Form::text('apellido_materno', $pacientes[0]->apellido_materno, ['required' => 'required','class'=>'form-control letras text-center', 'placeholder' => 'Apellido Materno'])}}
                    </div>
                    <span  id ="ErrorMensaje-apellido_materno" class="help-block">Ingrese Apellido Materno</span>
                </div>
                <div class="form-group">
                    {{Form::label('nombres' , 'Nombres', ['class' => 'control-label col-sm-2'])}}
                    <div class="col-sm-6">
                        {{Form::text('nombres', $pacientes[0]->nombres, ['required' => 'required','class'=>'form-control letras text-center', 'placeholder' => 'Nombres'])}}
                    </div>
                    <span  id ="ErrorMensaje-nombres" class="help-block">Ingrese Nombres</span>
                </div>
                <div class="form-group">
                      {{Form::label('dni' , 'Dni', ['required' => 'required','class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-6">
                            <input class="form-control numero text-center" value="{{$pacientes[0]->dni}}"  maxlength="8" placeholder="Dni" name="dni" type="text" id="dni" required readonly>
                        </div>
                        <span  id ="ErrorMensaje-dni" class="help-block">Ingrese Dni</span>
                </div>
                <div class="form-group">
                    {{Form::label('fechanacimiento','Fecha de Nac.', ['class' => 'control-label col-sm-2'])}}
                    <div class="col-sm-6">
                        {{Form::text('fecha_nacimiento', $pacientes[0]->fecha_nacimiento , ['class' => 'datepicker form-control text-center' , 'data-date-format' => 'yyyy-mm-dd'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('lugarnacimiento','Lugar de Nac.', ['class' => 'control-label col-sm-2'])}}
                    <div class="col-sm-6">
                            <input class="form-control text-center" placeholder = "Lugar de Nacimiento"  name="lugarnacimiento" type="text" id="lugarnacimiento" value="{{$pacientes[0]->lugarnacimiento}}"> 
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('EstadoCivil' , 'Estado Civil', ['class' => 'control-label col-sm-2'])}}
                    <div class="col-sm-4">
                        <select name="estado_civil_id" id="estado_civil_id" class="form-control text-center">
                            @foreach($estadociviles as $estadocivil)
                                @if($pacientes[0]->estado_civil_id == $estadocivil->id)
                                    <option value="{{$estadocivil->id}}" selected>{{$estadocivil->nombre_estado_civil}}</option>
                                @else
                                    <option value="{{$estadocivil->id}}">{{$estadocivil->nombre_estado_civil}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    {{Form::label('sexo' , 'Sexo', ['class' => 'control-label col-sm-2'])}}
                    <div class="col-sm-4">
                        <select name="sexo_id" id="sexo_id" class="form-control">
                            @foreach($sexos as $sexo)
                                @if($pacientes[0]->sexo_id == $sexo->id)
                                    <option value="{{$sexo->id}}" selected>{{$sexo->nombre_sexo}}</option>
                                @else
                                    <option value="{{$sexo->id}}">{{$sexo->nombre_sexo}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('gruposanguineo' , 'Grupo Sanguineo', ['class' => 'control-label col-sm-2'])}}
                    <div class="col-sm-4">
                        <select name="grupo_sanguineo_id" id="grupo_sanguineo_id"  class="form-control">
                            @foreach($sanguineos as $sanguineo)
                                @if($pacientes[0]->grupo_sanguineo_id == $sanguineo->id)
                                    <option selected value="{{$sanguineo->id}}">{{$sanguineo->nombre_grupo}}</option>
                                @else
                                    <option value="{{$sanguineo->id}}">{{$sanguineo->nombre_grupo}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('estado_id' , 'Estado', ['class' => 'control-label col-sm-2'])}}
                    <div class="col-sm-4">
                        <select name="estado_id" id="estado_id"  class="form-control">
                           @foreach($estados as $estado)
                                @if($pacientes[0]->estado_id == $estado->id)
                                    <option selected value="{{$estado->id}}">{{$estado->nombre_estado}}</option>
                                @else
                                    <option value="{{$estado->id}}">{{$estado->nombre_estado}}</option>
                                @endif     
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('direccion' , 'Dirección', ['class' => 'control-label col-sm-2'])}}
                    <div class="col-sm-10">
                        {{Form::textarea('direccion', $pacientes[0]->direccion, ['required' => 'required','class'=>'form-control','id' => 'textarea',  'placeholder' => 'Digite su dirección'])}}
                    </div>
                    <span  id ="ErrorMensaje-direccion" class="help-block">Ingrese Dirección</span>
                </div>
                <div class="form-group">
                      {{Form::label('telefono' , 'Telefono', ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-10">
                            <input class="form-control" value="{{$pacientes[0]->telefono}}"  placeholder="043-316895" name="telefono" type="text" id="telefono">
                        </div>
                </div>
                <div class="form-group">
                      {{Form::label('celular' , 'Celular', ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-10">
                            <input class="form-control numero" value="{{$pacientes[0]->celular}}" maxlength="9" placeholder="955453193" name="celular" type="text" id="celular">
                        </div>
                </div>    


                <div class="form-group">
                      {{Form::label('CarnetExtranjeria' , 'Carnet de Extranjeria', ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-6">
                            <input class="form-control text-center" placeholder = "Carnet de Extranjeria"  name="CarnetExtranjeria" type="text" id="CarnetExtranjeria" value="{{$pacientes[0]->CarnetExtranjeria}}">
                        </div>
                </div>
                 <div class="form-group">
                      {{Form::label('DomicilioActual' , 'Domicilio Actual', ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-6">
                            <input class="form-control text-center" placeholder="Domicilio Actual"  name="DomicilioActual" type="text" id="DomicilioActual" value="{{$pacientes[0]->DomicilioActual}}">
                        </div>
                </div>
                 <div class="form-group">
                      {{Form::label('DomicilioProcedencia' , 'Domicilio de Procedencia', ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-6">
                            <input class="form-control text-center" placeholder="Domicilio de Procedencia"  name="DomicilioProcedencia" type="text" id="DomicilioProcedencia"  value="{{$pacientes[0]->DomicilioProcedencia}}">
                        </div>
                </div>

                <div class="form-group">
                      {{Form::label('GradoInstruccion' , 'Grado de Instruccion', ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-6">
                            <input class="form-control text-center" placeholder ="Grado de Instruccion"  name="GradoInstruccion" type="text" id="GradoInstruccion" value="{{$pacientes[0]->GradoInstruccion}}">
                        </div>
                </div>

                <div class="form-group">
                      {{Form::label('Ocupacion' , ' Ocupacion', ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-6">
                            <input  value="{{$pacientes[0]->Ocupacion}}" class="form-control text-center" placeholder = "Ocupacion"   name="Ocupacion" type="text" id="Ocupacion">
                        </div>
                </div>

                <div class="form-group">
                      {{Form::label('Religion' , 'Religion', ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-6">
                            <input class="form-control text-center"  value="{{$pacientes[0]->Religion}}"  placeholder = "Religion"  name="Religion" type="text" id="Religion">
                        </div>
                </div>

                <div class="form-group">
                      {{Form::label('NombreAcompanante' , 'Nombre de Acompañante', ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-6">
                            <input class="form-control text-center" value="{{$pacientes[0]->NombreAcompanante}}" placeholder="Nombre de Acompañante"  name="NombreAcompanante" type="text" id="NombreAcompanante">
                        </div>
                </div>

                <div class="form-group">
                      {{Form::label('GradoParentesco' , 'Grado de Parentesco', ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-6">
                            <input class="form-control text-center"   value="{{$pacientes[0]->GradoParentesco}}" name="GradoParentesco" type="text" id="GradoParentesco"
                                placeholder ="Grado de Parentesco"
                            >
                        </div>
                </div>
                <div class="form-group">
                      {{Form::label('DomicilioAcompanante' , 'Domicilio de Acompañante', ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-6">
                            <input value="{{$pacientes[0]->DomicilioAcompanante}}" class="form-control text-center"  name="DomicilioAcompanante" type="text" id="DomicilioAcompanante"
                            placeholder = "Domicilio de Acompañante">
                        </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button class="btn btn-info" id="EditarPaciente" type="submit"><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> Editar Paciente
                        </button>
                    </div>
                </div>
                 {{ Form::close() }} <!-- end form !-->
            </div>
        </div> <!-- end div .panel-body -->  
    </div>


    <script>
        $(function () {
            
            $("#apellido_paterno").on('keypress',function(event) {
              $("#ErrorMensaje-apellido_paterno").hide();
            });

            $("#apellido_materno").on('keypress',function(event) {
              $("#ErrorMensaje-apellido_materno").hide();
            });

            $("#nombres").on('keypress',function(event) {
              $("#ErrorMensaje-nombres").hide();
            });

            $("#dni").on('keypress',function(event) {
              $("#ErrorMensaje-dni").hide();
            });

            $(".numero").on("keydown", function (e) {
                    //console.log(e.keyCode);

                    if ( e.keyCode == 8 ||  e.keyCode == 37 ||  e.keyCode == 39 )
                    {
                        return true;
                    }

                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) 
                    {
                        return false;
                    }
             
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105 )) {
                        e.preventDefault();
                    }
                })
            $(".letras").keypress(function (key) {
            //window.console.log(key.charCode)

                if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
                    && (key.charCode < 65 || key.charCode > 90) //letras minusculas
                    && (key.charCode != 45) //retroceso
                    && (key.charCode != 241) //ñ
                     && (key.charCode != 209) //Ñ
                     && (key.charCode != 32) //espacio
                     && (key.charCode != 225) //á
                     && (key.charCode != 233) //é
                     && (key.charCode != 237) //í
                     && (key.charCode != 243) //ó
                     && (key.charCode != 250) //ú
                     && (key.charCode != 193) //Á
                     && (key.charCode != 201) //É
                     && (key.charCode != 205) //Í
                     && (key.charCode != 211) //Ó
                     && (key.charCode != 218) //Ú
     
                    )
                    return false;
             }); 
        
        });
    </script>
@endsection  

