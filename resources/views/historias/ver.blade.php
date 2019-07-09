@extends('layouts.app')
@section('title', '| Ver Historia Clinica Paciente')
@section('estilos_adicionales')
    <style>
        .nav-pills
        {
            background-color: #03a9f4 !important;   
        }
        .nav-pills > li > a {
            color: #fff !important;
        }
        .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover 
        {
            background-color: #03a0e9 !important;
            box-shadow: 0 16px 26px -10px #03a0e9, 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px #03a0e9;
        }
    </style>
@endsection
@section('content')
@if(count($pacientes) >0)
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body" id="divCabecera">
                <h2 class="text-center" style="color: #03a9f4;">Ver Historia Clínica</h2>
                    <div class="row">
                        <ul class="nav nav-pills" id="myTab" >
                          <li class="active">
                            <a id="home-tab" data-toggle="pill" href="#home" aria-controls="home" aria-selected="true">Datos del Paciente</a>
                          </li>
                          <li  id="li-profile">
                            <a id="profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="false">F. Biológicas</a>
                          </li>
                          <li id="li-antecedentes">
                            <a id="antecedentes-tab" data-toggle="pill" href="#antecedentes" role="tab" aria-controls="antecedentes" aria-selected="false">A. GENERALES</a>
                          </li>
                          <li id="li-patologicos">
                            <a id="patologicos-tab" data-toggle="pill" href="#patologicos" role="tab" aria-controls="patologicos" aria-selected="false">A. PATOLOGICOS</a>
                          </li>
                          <li  id="li-familiares">
                            <a id="familiares-tab" data-toggle="pill" href="#familiares" role="tab" aria-controls="familiares" aria-selected="false">A. FAMILIARES</a>
                          </li>
                          @if($pacientes[0]->sexo_id == 2)
                              <li  id="li-gineco">
                                <a id="gineco-tab" data-toggle="pill" href="#gineco" role="tab" aria-controls="gineco" aria-selected="false">A. GINECO -  OBSTETRICOS</a>
                              </li>
                          @endif
                          <li id="li-fisico">
                            <a id="fisico-tab" data-toggle="pill" href="#fisico" role="tab" aria-controls="fisico" aria-selected="false">E. FISICO</a>
                          </li>
                          <li id="li-diagnostico">
                            <a id="diagnostico-tab" data-toggle="pill" href="#diagnostico" role="tab" aria-controls="diagnostico" aria-selected="false">DIAGNOSTICO</a>
                          </li>
                          <li  id="li-plantrabajo">
                            <a id="plantrabajo-tab" data-toggle="pill" href="#plantrabajo" role="tab" aria-controls="plantrabajo" aria-selected="false">PLAN DE TRABAJO</a>
                          </li>
                          <li  id="li-tratamiento">
                            <a id="tratamiento-tab" data-toggle="pill" href="#tratamiento" role="tab" aria-controls="tratamiento" aria-selected="false">TRATAMIENTO</a>
                          </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" readonly style="display:none;" id="paciente-id" name="paciente-id" value="">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-nombres" name="paciente-nombres" value="{{$pacientes[0]->nombres}}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-apellido_paterno" name="paciente-apellido_paterno" value="{{$pacientes[0]->apellido_paterno}}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-apellido_materno" name="paciente-apellido_materno" value="{{$pacientes[0]->apellido_materno}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-dni" name="paciente-dni" value="{{$pacientes[0]->dni}}">
                                </div>  
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-edad" name="paciente-edad" value="{{$pacientes[0]->edad}}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-fecha_nacimiento" name="paciente-fecha_nacimiento" value="{{$pacientes[0]->fecha_nacimiento}}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-grupo_sanguineo" name="paciente-grupo_sanguineo" value="{{$pacientes[0]->gruposanguineo}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="" class="">Tipo de Historia</label>
                                        <select name="tipo_historia_id" id="tipo_historia_id" class="form-control">
                                            <option value="{{$pacientes[0]->tipo_id}}">{{$pacientes[0]->nombre_historia}}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" class="">Fecha de Historia</label>

                                            <input type="text" readonly class=" text-center form-control" id="fecha_historia" name="fecha_historia" value="{{$pacientes[0]->fecha_historia}}">

                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="">Acompañante</label>
                                        <input type="text" readonly class="form-control" id="paciente_acompanante" name="paciente_acompanante" value="{{$pacientes[0]->acompanante}}">
                                    </div>
                                </div>   
                            </div>
                        </div>
                        @if(count($biologicas) > 0)
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                          <div class="row">
                            @foreach($biologicas as $biologica)
                              <div class="form-group col-sm-4">
                                  <label for="col-sm-2">{{$biologica->nombre_campo}}</label>
                                  <select class="form-control col-sm-2" name="biologicas[]" id="biologica_{{$biologica->id}}">
                                      
                                      @if($pacientes_biologicos[$biologica->id - 1]->valor_id == 1)
                                        <option selected value="1">Si</option>
                                      @else
                                        <option  selected  value="2">No</option>
                                      @endif
                                  </select>
                              </div>
                            @endforeach
                          </div>
                           <div class="form-group">
                                    <label for="" class="col-sm-6">Observaciones Funciones Biológicas</label>
                                    <br>
                                    {{Form::textarea('paciente_funciones_biologicas',$pacientes[0]->paciente_funciones_biologicas,['class' => 'form-control','disabled' => 'disabled' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                </div>
                        </div>
                        @endif
                        <div class="tab-pane fade" id="antecedentes" role="tabpanel" aria-labelledby="antecedentes-tab">
                            <div class="row">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-sm-1">Antecedentes Generales</label>
                                        <br>
                                            {{Form::textarea('paciente_antecedentes_generales',$pacientes[0]->paciente_antecedentes_generales,['class' => 'form-control' ,'id' => 'textarea', 'disabled' => 'disabled','placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                    </div>                            
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-sm-1">Antecedentes Fisiológicos</label>
                                        <br>
                                            {{Form::textarea('paciente_antecedentes_fisiologicos',$pacientes[0]->paciente_antecedentes_fisiologicos,['class' => 'form-control' ,'id' => 'textarea', 'disabled' => 'disabled' ,'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                    </div>                            
                                </div>
                            </div>
                            </div>
                        </div>
                        @if(count($familiares) > 0)
                        <div class="tab-pane fade" id="familiares" role="tabpanel" aria-labelledby="familiares-tab">
                          
                            <div class="row">
                                @foreach($familiares as $familiar)
                                            <div class="form-group col-sm-4">
                                                <label for="col-sm-2">{{$familiar->nombre_campo}}</label>
                                                <select class="form-control col-sm-2" name="familiares[]" id="familiar_{{$familiar->id}}">

                                                  @if($pacientes_familiares[$familiar->id - 1]->valor_id == 1)
                                                    <option selected value="1">Si</option>
                                                  @else
                                                    <option  selected  value="2">No</option>
                                                  @endif
                                                </select>
                                            </div>
                                @endforeach
                            </div>            
                                <div class="form-group">
                                    <label for="" class="col-sm-6">Observaciones Antecedentes Familiares</label>
                                    <br>
                                    {{Form::textarea('paciente_antecedentes_familiares_otros',$pacientes[0]->paciente_antecedentes_familiares_otros,['class' => 'form-control' ,'disabled' => 'disabled','id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                </div>
                        </div>
                        @endif
                        @if(count($patologicos) > 0)
                        <div class="tab-pane fade" id="patologicos" role="tabpanel" aria-labelledby="patologicos-tab">
                          
                            <div class="row">
                                @foreach($patologicos as $patologico)
                                            <div class="form-group col-sm-4">
                                                <label for="col-sm-2">{{$patologico->nombre_campo}}</label>
                                                <select class="form-control col-sm-2" name="patologicos[]" id="patologico_{{$patologico->id}}">
                                                  @if($pacientes_patologicos[$patologico->id - 1]->valor_id == 1)
                                                    <option selected value="1">Si</option>
                                                  @else
                                                    <option  selected  value="2">No</option>
                                                  @endif
                                                </select>
                                            </div>
                                @endforeach
                            </div>            
                            <div class="form-group">
                                <label for="" class="col-sm-6">Observaciones Antecedentes Patológicos</label>
                                <br>
                                {{Form::textarea('paciente_antecedentes_patologicos_otros',$pacientes[0]->paciente_antecedentes_patologicos_otros,['class' => 'form-control','disabled' => 'disabled' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}

                            </div>
                        </div>
                        @endif

                        <div class="tab-pane fade" id="gineco" role="tabpanel" aria-labelledby="gineco-tab">
                           
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="gineco_menarquia" class="col-sm-2">Menarquía</label>                                  
                                    <input type="text" readonly class=" text-center form-control" id="gineco_menarquia" name="gineco_menarquia" value="{{$pacientes[0]->gineco_menarquia}}">

                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="gineco_regimen_catamenial" class="col-sm-4">RC (días)</label>
                                    <select name="gineco_regimen_catamenial" id="gineco_regimen_catamenial" class="form-control text-center">
                                        @for ($i = 1; $i < 32; $i++)
                                            @if($pacientes[0]->gineco_regimen_catamenial == $i)
                                                <option selected value="{{ $i }}">{{ $i }}</option> 
                                            @endif
                                        @endfor

                                    </select>   
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="gineco_fur" class="col-sm-2">FUR</label>
                                    <input type="text" readonly class=" text-center form-control" id="gineco_fur" name="gineco_fur" value="{{$pacientes[0]->gineco_fur}}">

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="gineco_edad_gestacional" class="col-sm-4">EG (semanas)</label>
                                    <select name="gineco_edad_gestacional" id="gineco_edad_gestacional" class="form-control text-center">
                                        @for ($i = 0; $i < 44; $i++)

                                             @if($pacientes[0]->gineco_edad_gestacional == $i)
                                                 <option selected value="{{ $i }}">{{ $i }} semanas</option>  
                                            @endif

                                        @endfor

                                    </select>   
                                </div>
                                
                                <div class="form-group col-sm-4">
                                    <label for="gineco_gesta" class="col-sm-2">Gesta</label>
                                    <input type="text"  value="{{$pacientes[0]->gineco_gesta}}"  readonly  class = "text-center form-control col-sm-10" id ="gineco_gesta" name="gineco_gesta">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="gineco_para" class="col-sm-2">Para</label>

                                    <input type="text" value="{{$pacientes[0]->gineco_para}}" readonly class = "text-center form-control col-sm-10" id ="gineco_para" name="gineco_para">
                                
                                </div>

                            </div>

                            <div class="row">   
                                <div class="form-group col-sm-4">
                                    <label for="gineco_irs" class="col-sm-2">IRS</label>
                                    <input type="text" value="{{$pacientes[0]->gineco_irs}}" readonly class = "text-center form-control col-sm-10" id ="gineco_irs" name="gineco_irs">

                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="gineco_urs" class="col-sm-2">URS</label>
                                    
                                    <input type="text" value="{{$pacientes[0]->gineco_urs}}" readonly class = "text-center form-control col-sm-10" id ="gineco_urs" name="gineco_urs">

                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="gineco_mac" class="col-sm-2">MAC</label>
                                    <select name="gineco_mac" id="gineco_mac" class="form-control text-center">
                                        @foreach($macs as $mac)
                                            @if($pacientes[0]->gineco_mac == $mac->id )
                                                 <option selected value="{{ $mac->id }}">{{ $mac->nombre_campo }}</option>   
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="gineco_tipo_parto" class="col-sm-2">Parto</label>
                                    <select name="gineco_tipo_parto" id="gineco_tipo_parto" class="form-control text-center">
                                        @foreach($tipopartos as $tipoparto)
                                            @if($pacientes[0]->gineco_tipo_parto == $tipoparto->id )
                                                 <option selected value="{{ $tipoparto->id }}">{{ $tipoparto->nombre_campo }}</option>   
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="form-group col-sm-4">
                                    <label for="col-sm-2">PAP</label>
                                    <select class="form-control col-sm-2" name="gineco_pap" id="gineco_pap">

                                                @if($pacientes[0]->gineco_pap == 1)
                                                    <option selected value="1">Si</option>
                                                  @else
                                                    <option  selected  value="2">No</option>
                                                  @endif
                                    </select>
                                </div>
                                <div class="form-group col-sm-4" style="display:none;">
                                    <label for="col-sm-2">Síntomas Climatericos</label>
                                    <select class="form-control col-sm-2" name="gineco_pap" id="gineco_pap">
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="col-sm-2">Leucorrea</label>
                                    <select class="form-control col-sm-2" name="gineco_leucorrea" id="gineco_leucorrea">

                                         @if($pacientes[0]->gineco_leucorrea == 1)
                                                    <option selected value="1">Si</option>
                                                  @else
                                                    <option  selected  value="2">No</option>
                                                  @endif
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="col-sm-2">Dispareunia</label>
                                    <select class="form-control col-sm-2" name="gineco_dispareunia" id="gineco_dispareunia">
                                          @if($pacientes[0]->gineco_dispareunia == 1)
                                                    <option selected value="1">Si</option>
                                                  @else
                                                    <option  selected  value="2">No</option>
                                                  @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-6">Observaciones Antecedentes Gineco-Obstetricos</label>
                                <br>
                                {{Form::textarea('paciente_antecedentes_gineco_otros',$pacientes[0]->paciente_antecedentes_gineco_otros,['class' => 'form-control' ,'id' => 'textarea', 'disabled' => 'disabled','placeholder' => 'Digite Aquí Observaciones', 'Description'])}}

                            </div>     
                        </div>
                        <div class="tab-pane fade" id="fisico" role="tabpanel" aria-labelledby="fisico-tab">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="fisico_pa" class="col-sm-4">PA(mmHg)</label>
                                    <input id ="fisico_pa" name="fisico_pa" type="text" class="form-control col-sm-10 text-center" readonly
                                          value="{{$pacientes[0]->fisico_pa}}"  
                                        >
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fisico_pulso" class="col-sm-2">Pulso</label>
                                    <input readonly value="{{$pacientes[0]->fisico_pulso}}" id ="fisico_pulso" name="fisico_pulso" type="number" class="form-control col-sm-10 text-center">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fisico_temperatura" class="col-sm-2">Tº</label>
                                    <input readonly value="{{$pacientes[0]->fisico_temperatura}}" id ="fisico_temperatura" name="fisico_temperatura" type="number" class="form-control col-sm-10 text-center">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="fisico_frecuencia_respiratoria" class="col-sm-2">FR</label>
                                    <input readonly value="{{$pacientes[0]->fisico_frecuencia_respiratoria}}" id ="fisico_frecuencia_respiratoria" name="fisico_frecuencia_respiratoria" type="number" class="form-control col-sm-10 text-center">                             
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fisico_sat_o2" class="col-sm-8">Sat O2 (%)</label>
                                    <input readonly value="{{$pacientes[0]->fisico_sat_o2}}" id ="fisico_sat_o2" name="fisico_sat_o2" type="number" class="form-control col-sm-10 text-center">                             
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fisico_imc" class="col-sm-2">IMC</label>
                                    <input  readonly value="{{$pacientes[0]->fisico_imc}}" id ="fisico_imc" name="fisico_imc" type="number" class="form-control col-sm-10 text-center">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="fisico_talla" class="col-sm-8">Talla (cm)</label>
                                    <input readonly value="{{$pacientes[0]->fisico_talla}}" id ="fisico_talla" name="fisico_talla" type="number" class="form-control col-sm-10 text-center">                             
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fisico_peso" class="col-sm-8">Peso (Kg)</label>
                                    <input readonly value="{{$pacientes[0]->fisico_peso}}" id ="fisico_peso" name="fisico_peso" type="number" class="form-control col-sm-10 text-center">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="" class="col-sm-6">Observaciones Examen Físico</label>
                                    <br>
                                    {{Form::textarea('paciente_observaciones_examen_fisicos',$pacientes[0]->paciente_observaciones_examen_fisicos,['class' => 'form-control' ,'id' => 'textarea', 'disabled' => 'disabled' , 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="diagnostico" role="tabpanel" aria-labelledby="diagnostico-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <br>
                                    <label for="">Impresión Diagnóstica</label>
                                    <div class="col-md-12">
                                        <div class="input-group col-md-12">
                                        <input type="text" style="display:none;" class="form-control input-diagnostico-id10 text-center" readonly autocomplete="off" id="input-diagnostico-id10"
                                                   name="input-diagnostico-input-diagnostico-id10" placeholder="Codigo" class="col-sm-2"/>
                                            <input type="text" class="form-control input-diagnostico text-center" readonly autocomplete="off" id="input-diagnostico"
                                                   name="input-diagnostico" placeholder="Nombre del Diagnostico" class="col-sm-8" style ="display:none;"/>
                                                <span class="input-group-btn" style = "display:none;">
                                                    <button class="btn btn-info btn-md" type="button" id="btn-buscar-diagnostico"  data-toggle="modal" href='#modal-id-cie10'>
                                                        <i class="fa fa-search" aria-hidden="true"> CIE-10</i>
                                                    </button>
                                                    <br>
                                                    <button class="btn btn-success btn-md" type="button" id="bt_add">
                                                        <i class="fa fa-plus" aria-hidden="true"> Agregar</i>
                                                    </button>
                                                </span>
                                        </div>
                                        <span class="help-block" id="mensaje-validacion"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <table id="detalles" class="table table-striped table-bordered table-condensed">
                                        <thead  style="background-color:#03a9f4; color:#fff;">
                                            <th style="vertical-align:middle;text-align:center;width: 10%">Código</th>
                                            <th style="vertical-align:middle;text-align:center;">Descripción</th>
                                        </thead>
                                        <tbody>
                                            @foreach($diagnosticos as $diagnostico)
                                                <tr>
                                                    <td class="text-center">{{$diagnostico->id10}}</td>
                                                    <td>{{$diagnostico->dec10}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="plantrabajo" role="tabpanel" aria-labelledby="plantrabajo-tab">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Examenes de Ayuda Diagnostica</label>
                                            <br>
                                                {{Form::textarea('paciente_plantrabajo_ayuda_dignostica', $pacientes[0]->paciente_plantrabajo_ayuda_dignostica ,['class' => 'form-control' ,'id' => 'textarea','disabled' => 'disabled' ,'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                        </div>                            
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Laboratorio</label>
                                            <br>
                                                {{Form::textarea('paciente_plantrabajo_laboratorio',$pacientes[0]->paciente_plantrabajo_laboratorio,['class' => 'form-control' ,'id' => 'textarea', 'disabled' => 'disabled' ,'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Estudio de Imágenes</label>
                                            <br>
                                                {{Form::textarea('paciente_plantrabajo_estudio_imagenes', $pacientes[0]->paciente_plantrabajo_estudio_imagenes ,['class' => 'form-control' , 'disabled' => 'disabled' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                        </div>                            
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Procedimientos Especiales</label>
                                            <br>
                                                {{Form::textarea('paciente_plantrabajo_procedimientos_especiales', $pacientes[0]->paciente_plantrabajo_procedimientos_especiales ,['class' => 'form-control','disabled' => 'disabled' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                        </div>                            
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Interconsultas</label>
                                            <br>
                                                {{Form::textarea('paciente_plantrabajo_interconsultas', $pacientes[0]->paciente_plantrabajo_interconsultas ,['class' => 'form-control', 'disabled' => 'disabled' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                        </div>                            
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Referencia</label>
                                            <br>
                                                {{Form::textarea('paciente_plantrabajo_referencia',$pacientes[0]->paciente_plantrabajo_referencia,['class' => 'form-control', 'disabled' => 'disabled' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                        </div>                            
                                    </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tratamiento" role="tabpanel" aria-labelledby="tratamiento-tab">
                            <div class="row">
                                <div class="row">
                                    <div class="col-xs-10 col-xs-offset-1">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Tratamiento</label>
                                            <br>
                                                {{Form::textarea('paciente_tratamiento', $pacientes[0]->paciente_tratamiento ,['class' => 'form-control' ,'id' => 'textarea', 'disabled' => 'disabled' , 'placeholder' => 'Digite Aquí el Tratamiento', 'Description'])}}
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<script>
$(function () {

                var select = $("#tipo_historia_id option:selected").val();

                    // Consulta Externa Solo Algunos Datos. Ultimos Requerimientos.    
                    if (select == 5) {
                        $('#li-patologicos').hide();
                        $('#li-antecedentes').hide();
                        $('#li-familiares').hide();
                        $('#li-gineco').hide();
                        $('#li-fisico').hide();
                        $('#li-general').hide();
                        $('#li-plantrabajo').hide();
                        $('#li-tratamiento').hide();

                    } else {

                        $('#li-patologicos').show();
                        $('#li-antecedentes').show();
                        $('#li-familiares').show();
                        $('#li-gineco').show();
                        $('#li-fisico').show();
                        $('#li-general').show();
                        $('#li-plantrabajo').show();
                        $('#li-tratamiento').show();
                    }

                $("#tipo_historia_id").change(function(){
                    var select = $("#tipo_historia_id option:selected").val();

                    // Consulta Externa Solo Algunos Datos. Ultimos Requerimientos.    
                    if (select == 5) {
                        $('#li-patologicos').hide();
                        $('#li-antecedentes').hide();
                        $('#li-familiares').hide();
                        $('#li-gineco').hide();
                        $('#li-fisico').hide();
                        $('#li-general').hide();
                        $('#li-plantrabajo').hide();
                        $('#li-tratamiento').hide();

                    } else {

                        $('#li-patologicos').show();
                        $('#li-antecedentes').show();
                        $('#li-familiares').show();
                        $('#li-gineco').show();
                        $('#li-fisico').show();
                        $('#li-general').show();
                        $('#li-plantrabajo').show();
                        $('#li-tratamiento').show();
                    }

                });

});
</script>
@endsection