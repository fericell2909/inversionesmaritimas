@extends('layouts.app')
@section('title', '| Registrar Historia Clinica')
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
    <div class="col-md-12 col-sm-12 col-xs-12">
{{Form::open (['route' => 'GuardarHistoriaClinica' ,'class' => 'form-horizontal','id' => 'FrmRegistrarHistoriaClinica'] )}}
        <div class="panel panel-default">
            {{-- <div class="panel-heading"> <h3 class="text-center text-info">Realizar Venta</h3></div> --}}
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                                <a href="{{route('RegistrarPacientes')}}">
                                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                                      aria-hidden="true"></i> CREAR PACIENTE
                                    </button>
                                </a>
                                <div class="col-md-12">
                                    <div class="input-group col-md-12">
                                        <input type="text" class="form-control input-paciente" autocomplete="off" id="input-paciente"
                                               name="search" placeholder="Dni del Paciente"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-md" type="button" id="btn-buscar-paciente">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="PacienteModelBodyAjax"></div>
                                </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-id-cie10">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                                <h3 class="text-center" style="color: #03a9f4;">Catalogo de Códigos CIE-10</h3>
                                <div class="col-md-12">
                                    <div class="input-group col-md-12">
                                        <input type="text" class="form-control input-busqueda-cie10" autocomplete="off" id="input-busqueda-cie10"
                                               name="search" placeholder="Descripcion CIE-10"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-md" type="button" id="btn-buscar-cie10">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="CIE10ModelBodyAjax"></div>
                                </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body" id="divCabecera">
                <h2 class="text-center" style="color: #03a9f4;">Registar Historia Clínica</h2>
                    <div class="row">
                        <ul class="nav nav-pills" id="myTab" >
                          <li class="active">
                            <a id="home-tab" data-toggle="pill" href="#home" aria-controls="home" aria-selected="true">Datos del Paciente</a>
                          </li>
                          <li id="li-profile">
                            <a id="profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="false">F. Biológicas</a>
                          </li>
                          <li id="li-antecedentes">
                            <a id="antecedentes-tab" data-toggle="pill" href="#antecedentes" role="tab" aria-controls="antecedentes" aria-selected="false">A. GENERALES</a>
                          </li>
                          <li id="li-patologicos">
                            <a id="patologicos-tab" data-toggle="pill" href="#patologicos" role="tab" aria-controls="patologicos" aria-selected="false">A. PATOLOGICOS</a>
                          </li>
                          <li id="li-familiares">
                            <a id="familiares-tab" data-toggle="pill" href="#familiares" role="tab" aria-controls="familiares" aria-selected="false">A. FAMILIARES</a>
                          </li>
                          <li id="li-gineco">
                            <a id="gineco-tab" data-toggle="pill" href="#gineco" role="tab" aria-controls="gineco" aria-selected="false">A. GINECO -  OBSTETRICOS</a>
                          </li>
                          <li id="li-fisico">
                            <a id="fisico-tab" data-toggle="pill" href="#fisico" role="tab" aria-controls="fisico" aria-selected="false">E. FISICO</a>
                          </li>
                          <li id="li-general">
                            <a id="general-tab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="false">E. GENERAL</a>
                          </li>
                          <li  id="li-diagnostico">
                            <a id="diagnostico-tab" data-toggle="pill" href="#diagnostico" role="tab" aria-controls="diagnostico" aria-selected="false">DIAGNOSTICO</a>
                          </li>
                          <li id="li-plantrabajo">
                            <a id="plantrabajo-tab" data-toggle="pill" href="#plantrabajo" role="tab" aria-controls="plantrabajo" aria-selected="false">PLAN DE TRABAJO</a>
                          </li>
                          <li id="li-tratamiento">
                            <a id="tratamiento-tab" data-toggle="pill" href="#tratamiento" role="tab" aria-controls="tratamiento" aria-selected="false">TRATAMIENTO</a>
                          </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" readonly style="display:none;" id="paciente-id" name="paciente-id" value="">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-nombres" name="paciente-nombres" value="Nombres">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-apellido_paterno" name="paciente-apellido_paterno" value="Apellido Paterno">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-apellido_materno" name="paciente-apellido_materno" value="Apellido Materno">
                                </div>
                                <div class="col-sm-3">
                                        <br>
                                        <a class="btn btn-xs btn-info" data-toggle="modal" href='#modal-id'>
                                            <i aria-hidden="true" class="fa fa-search"></i>
                                                BUSCAR PACIENTE
                                        </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-dni" name="paciente-dni" value="Dni">
                                </div>  
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-edad" name="paciente-edad" value="Edad">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-fecha_nacimiento" name="paciente-fecha_nacimiento" value="Fecha de Nacimiento">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" readonly class=" text-center form-control" id="paciente-grupo_sanguineo" name="paciente-grupo_sanguineo" value="Grupo Sanguineo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="" class="">Tipo de Historia</label>
                                        <select name="tipo_historia_id" id="tipo_historia_id" class="form-control">
                                            @foreach($historiatipos as $historiatipo)
                                                <option value="{{$historiatipo->id}}">{{$historiatipo->nombre_historia}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" class="">Fecha de Historia</label>
                                            {{Form::text('fecha_historia', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'datepicker form-control text-center' , 'data-date-format' => 'yyyy-mm-dd'])}}
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="">Acompañante</label>
                                        <input type="text" class="form-control" id="paciente_acompanante" name="paciente_acompanante" value="">
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                          <div class="row">
                            @foreach($biologicas as $biologica)
                              <div class="form-group col-sm-4">
                                  <label for="col-sm-2">{{$biologica->nombre_campo}}</label>
                                  <select class="form-control col-sm-2" name="biologicas[]" id="biologica_{{$biologica->id}}">
                                      <option value="1">Si</option>
                                      <option value="2">No</option>
                                  </select>
                              </div>
                            @endforeach
                          </div>
                           <div class="form-group">
                                    <label for="" class="col-sm-6">Observaciones Funciones Biológicas</label>
                                    <br>
                                    {{Form::textarea('paciente_funciones_biologicas',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                </div>
                        </div>
                        <div class="tab-pane fade" id="antecedentes" role="tabpanel" aria-labelledby="antecedentes-tab">
                            <div class="row">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-sm-1">Antecedentes Generales</label>
                                        <br>
                                            {{Form::textarea('paciente_antecedentes_generales',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                    </div>                            
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-sm-1">Antecedentes Fisiológicos</label>
                                        <br>
                                            {{Form::textarea('paciente_antecedentes_fisiologicos',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                    </div>                            
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="familiares" role="tabpanel" aria-labelledby="familiares-tab">
                          
                            <div class="row">
                                @foreach($familiares as $familiar)
                                            <div class="form-group col-sm-4">
                                                <label for="col-sm-2">{{$familiar->nombre_campo}}</label>
                                                <select class="form-control col-sm-2" name="familiares[]" id="familiar_{{$familiar->id}}">
                                                  <option value="1">Si</option>
                                                  <option value="2">No</option>
                                                </select>
                                            </div>
                                @endforeach
                            </div>            
                                <div class="form-group">
                                    <label for="" class="col-sm-6">Observaciones Antecedentes Familiares</label>
                                    <br>
                                    {{Form::textarea('paciente_antecedentes_familiares_otros',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                </div>
                        </div>

                        <div class="tab-pane fade" id="patologicos" role="tabpanel" aria-labelledby="patologicos-tab">
                          
                            <div class="row">
                                @foreach($patologicos as $patologico)
                                            <div class="form-group col-sm-4">
                                                <label for="col-sm-2">{{$patologico->nombre_campo}}</label>
                                                <select class="form-control col-sm-2" name="patologicos[]" id="patologico_{{$patologico->id}}">
                                                  <option value="1">Si</option>
                                                  <option value="2">No</option>
                                                </select>
                                            </div>
                                @endforeach
                            </div>            
                            <div class="form-group">
                                <label for="" class="col-sm-6">Observaciones Antecedentes Patológicos</label>
                                <br>
                                {{Form::textarea('paciente_antecedentes_patologicos_otros',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}

                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="gineco" role="tabpanel" aria-labelledby="gineco-tab">
                           
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="gineco_menarquia" class="col-sm-2">Menarquía</label>
                                    {{Form::text('gineco_menarquia', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'datepicker form-control col-sm-10 text-center' , 'data-date-format' => 'yyyy-mm-dd'])}}
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="gineco_regimen_catamenial" class="col-sm-4">RC (días)</label>
                                    <select name="gineco_regimen_catamenial" id="gineco_regimen_catamenial" class="form-control text-center">
                                        @for ($i = 1; $i < 32; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option> 
                                        @endfor

                                    </select>   
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="gineco_fur" class="col-sm-2">FUR</label>
                                    {{Form::text('gineco_fur', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'datepicker form-control col-sm-10 text-center' , 'data-date-format' => 'yyyy-mm-dd'])}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="gineco_edad_gestacional" class="col-sm-4">EG (semanas)</label>
                                    <select name="gineco_edad_gestacional" id="gineco_edad_gestacional" class="form-control text-center">
                                        @for ($i = 0; $i < 44; $i++)
                                            <option value="{{ $i }}">{{ $i }} semanas</option> 
                                        @endfor

                                    </select>   
                                </div>
                                
                                <div class="form-group col-sm-4">
                                    <label for="gineco_gesta" class="col-sm-2">Gesta</label>
                                    <input type="text"  value="1"   class = "form-control col-sm-10" id ="gineco_gesta" name="gineco_gesta">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="gineco_para" class="col-sm-2">Para</label>
                                    <input type="text" value="1" class = "form-control col-sm-10" id ="gineco_para" name="gineco_para">
                                </div>

                            </div>

                            <div class="row">   
                                <div class="form-group col-sm-4">
                                    <label for="gineco_irs" class="col-sm-2">IRS</label>
                                    {{Form::text('gineco_irs', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'datepicker form-control col-sm-10 text-center' , 'data-date-format' => 'yyyy-mm-dd'])}}
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="gineco_urs" class="col-sm-2">URS</label>
                                    {{Form::text('gineco_urs', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'datepicker form-control col-sm-10 text-center' , 'data-date-format' => 'yyyy-mm-dd'])}}
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="gineco_mac" class="col-sm-2">MAC</label>
                                    <select name="gineco_mac" id="gineco_mac" class="form-control text-center">
                                        @foreach($macs as $mac)
                                            <option value="{{ $mac->id }}">{{ $mac->nombre_campo }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="gineco_tipo_parto" class="col-sm-2">Parto</label>
                                    <select name="gineco_tipo_parto" id="gineco_tipo_parto" class="form-control text-center">
                                        @foreach($tipopartos as $tipoparto)
                                            <option value="{{ $tipoparto->id }}">{{ $tipoparto->nombre_campo }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="form-group col-sm-4">
                                    <label for="col-sm-2">PAP</label>
                                    <select class="form-control col-sm-2" name="gineco_pap" id="gineco_pap">
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
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
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="col-sm-2">Dispareunia</label>
                                    <select class="form-control col-sm-2" name="gineco_dispareunia" id="gineco_dispareunia">
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-6">Observaciones Antecedentes Gineco-Obstetricos</label>
                                <br>
                                {{Form::textarea('paciente_antecedentes_gineco_otros',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}

                            </div>     
                        </div>
                        <div class="tab-pane fade" id="fisico" role="tabpanel" aria-labelledby="fisico-tab">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="fisico_pa" class="col-sm-4">PA(mmHg)</label>
                                    <input id ="fisico_pa" name="fisico_pa" type="text" class="form-control col-sm-10 text-center">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fisico_pulso" class="col-sm-2">Pulso</label>
                                    <input id ="fisico_pulso" name="fisico_pulso" type="text" class="form-control col-sm-10 text-center">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fisico_temperatura" class="col-sm-2">Tº</label>
                                    <input id ="fisico_temperatura" name="fisico_temperatura" type="text" class="form-control col-sm-10 text-center">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="fisico_frecuencia_respiratoria" class="col-sm-2">FR</label>
                                    <input id ="fisico_frecuencia_respiratoria" name="fisico_frecuencia_respiratoria" type="text" class="form-control col-sm-10 text-center">                             
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fisico_sat_o2" class="col-sm-8">Sat O2 (%)</label>
                                    <input id ="fisico_sat_o2" name="fisico_sat_o2" type="text" class="form-control col-sm-10 text-center">                             
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fisico_imc" class="col-sm-2">IMC</label>
                                    <input id ="fisico_imc" name="fisico_imc" type="text" class="form-control col-sm-10 text-center">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="fisico_talla" class="col-sm-8">Talla (cm)</label>
                                    <input id ="fisico_talla" name="fisico_talla" type="text" class="form-control col-sm-10 text-center">                             
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fisico_peso" class="col-sm-8">Peso (Kg)</label>
                                    <input id ="fisico_peso" name="fisico_peso" type="text" class="form-control col-sm-10 text-center">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="" class="col-sm-6">Observaciones Examen Físico</label>
                                    <br>
                                    {{Form::textarea('paciente_observaciones_examen_fisicos',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">APRECIACION GENERAL</label>
                                            <br>
                                                {{Form::textarea('paciente_general_apreciacion',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Comentarios', 'Description'])}}
                                        </div>                            
                                    </div>
                            </div>
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-6">
                                         
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Piel y Faneras</label>
                                            <br>
                                                {{Form::textarea('paciente_general_piel_faneras',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí sus Comentarios', 'Description'])}}
                                        </div>                           
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Conjuntivas</label>
                                            <br>
                                                {{Form::textarea('paciente_general_conjuntivas',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí sus Comentarios', 'Description'])}}
                                        </div>                          
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Cuello</label>
                                            <br>
                                                {{Form::textarea('paciente_general_cuello',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Comentarios', 'Description'])}}
                                        </div>                            
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Torax y Pulmones</label>
                                            <br>
                                                {{Form::textarea('paciente_general_torax_pulmones',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí sus Comentarios', 'Description'])}}
                                        </div>                            
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">CardioVascular</label>
                                            <br>
                                                {{Form::textarea('paciente_general_cardiovascular',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí sus Comentarios', 'Description'])}}
                                        </div>                            
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Abdomen</label>
                                            <br>
                                                {{Form::textarea('paciente_general_abdomen',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí sus Comentarios', 'Description'])}}
                                        </div>                            
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Genito-Urinario</label>
                                            <br>
                                                {{Form::textarea('paciente_general_genito_urinario',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí sus Comentarios', 'Description'])}}
                                        </div>                            
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Sistema Nervioso</label>
                                            <br>
                                                {{Form::textarea('paciente_general_sistema_nervioso',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí sus Comentarios', 'Description'])}}
                                        </div>                            
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
                                                   name="input-diagnostico" placeholder="Nombre del Diagnostico" class="col-sm-8"/>
                                                 
                                                 <span class="input-group-btn">
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
                                            <th style="vertical-align:middle;text-align:center;">Accion</th>   
                                        </thead>
                                        <tbody>
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
                                                {{Form::textarea('paciente_plantrabajo_ayuda_dignostica',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                        </div>                            
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Laboratorio</label>
                                            <br>
                                                {{Form::textarea('paciente_plantrabajo_laboratorio',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Estudio de Imágenes</label>
                                            <br>
                                                {{Form::textarea('paciente_plantrabajo_estudio_imagenes',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                        </div>                            
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Procedimientos Especiales</label>
                                            <br>
                                                {{Form::textarea('paciente_plantrabajo_procedimientos_especiales',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                        </div>                            
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Interconsultas</label>
                                            <br>
                                                {{Form::textarea('paciente_plantrabajo_interconsultas',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
                                        </div>                            
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-5">Referencia</label>
                                            <br>
                                                {{Form::textarea('paciente_plantrabajo_referencia',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí Observaciones', 'Description'])}}
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
                                                {{Form::textarea('paciente_tratamiento',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => 'Digite Aquí el Tratamiento', 'Description'])}}
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
               
                
                
            </div>
           



        </div>
                <button class="btn btn-lg btn-info" type="submit" id="btn-Registrar-Historia-Clinica" style="margin-left: 15px;">
                    <i class="fa fa-plus-square" aria-hidden="true"></i> REGISTRAR HISTORIA
                </button>
{{Form::close()}} 

    </div>
<script>

            var cont=0;

            // This function to set the product in box order
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

                $('#btn-Registrar-Historia-Clinica').click(function(){
                
                    if ($('table#detalles tbody tr').length > 0){
                            $('#FrmRegistrarHistoriaClinica').submit();    
                        } 
                        else {
                            alert('Debe Ingresar un Diagnostico como minimo');
                            return false;
                        }
                        

                });

                $('#bt_add').click(function(){
                    
                    var _texto_agregar = $('#input-diagnostico').val();

                    if (_texto_agregar == null || _texto_agregar.length <= 0 || _texto_agregar == "") {
                        alert('Debe Seleccionar un Codigo CIE-10');
                        return false;
                    } else
                    {
                        var repetidos = document.querySelectorAll(".filaagregada");
                        repetidos = [].slice.call(repetidos);
                        
                        repetido = false;     

                        idarticulo = $('#input-diagnostico-id10').val();

                  
                        $.each(repetidos, function( index, value ) {
                                if (repetidos[index].value == idarticulo) {
                                    repetidos = null;                       
                                    repetido = true;
                                };
                            });
                        
                        if (repetido) {
                            alert('No se puede ingresar dicho codigo CIE-10.');
                        }
                        else
                        {
                            agregar();  
                        }
                    }
                });

                $(document).on('click','.btnBusquedaPaciente',function(e){
                                
                                $('#paciente-id').val($(this).data('paciente_id'));
                                $('#paciente-nombres').val($(this).data('nombres'));
                                $('#paciente-apellido_paterno').val($(this).data('apellido_paterno'));
                                $('#paciente-apellido_materno').val($(this).data('apellido_materno'));
                                $('#paciente-dni').val($(this).data('dni'));
                                $('#paciente-edad').val($(this).data('edad'));
                                $('#paciente-grupo_sanguineo').val($(this).data('gruposanguineo'));
                                $('#paciente-fecha_nacimiento').val($(this).data('fecha_nacimiento'));
                                $('#modal-id').modal('hide');
                                return false;
                             });

                $(document).on('click','.btnBusquedaCie10',function(e){
                                
                                $('#input-diagnostico-id10').val($(this).data('id10'));
                                $('#input-diagnostico').val($(this).data('dec10'));
                                $('#modal-id-cie10').modal('hide');
                                return false;
                    });
                
                $('#input-paciente').keyup(function () {

                    var _search_paciente = $(this).val();

                    if (_search_paciente === '') {
                        $('#PacienteModelBodyAjax').hide();
                        return false;
                    }

                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: '/Pacientes/search',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'search': _search_paciente
                        },
                        success: function (data) {
                            //$('#salesModelBody').hide();
                            $('#PacienteModelBodyAjax').show();
                            var $a = '';
                            
                            $.each(data, function (i, result) {
                                
                                $a += '<button class="btnBusquedaPaciente row btn btn-info" data-sexo="' + result.sexo + '" data-paciente_id="' + result.id + '" data-nombres="' + result.nombres  +'" data-apellido_paterno ="'+ result.apellido_paterno +'" data-apellido_materno ="'+ result.apellido_materno + '" data-dni="' + result.dni + '" data-edad="' + result.edad + '" data-grupo_sanguineo="' + result.gruposanguineo + '" data-gruposanguineo="' + result.gruposanguineo + '" data-fecha_nacimiento="' + result.fecha_nacimiento + '">'                               
                                $a += result.apellido_paterno + ' ' + result.apellido_materno + ' ' + result.nombres + ' - ' + result.dni +'</button>'
                            });

                            $('#PacienteModelBodyAjax').html($a);
                        }
                    });


                });


                $('#input-busqueda-cie10').keyup(function () { 

                    var _search_cie10 = $(this).val();

                    if (_search_cie10 === '') {
                        $('#CIE10ModelBodyAjax').hide();
                        return false;
                    }

                    if (_search_cie10.length < 5 || _search_cie10 == null ) {
                        $('#CIE10ModelBodyAjax').hide();
                        return false;
                    }

                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: '/CodigosCie/search',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'search': _search_cie10
                        },
                        success: function (data) {
                            //$('#salesModelBody').hide();
                            $('#CIE10ModelBodyAjax').show();
                            var $a = '';
                            
                            $.each(data, function (i, result) {
                                
                                $a += '<button class="btnBusquedaCie10 row btn btn-info" data-codigo_id="' + result.id + '" data-id10="' + result.id10 + '" data-dec10="' + result.dec10 + '">' + result.dec10 + '</button>'
                            });

                            $('#CIE10ModelBodyAjax').html($a);
                        }
                    });

                });



            });

            function agregar(){
                

                idarticulo = $('#input-diagnostico-id10').val();
                descripcion=$('#input-diagnostico').val();

                
                if (idarticulo!="" && descripcion != "") {

                    var fila='<tr class="selected text-center" id="fila'+cont+'"><td>' + idarticulo +'</td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'" class="filaagregada">'+descripcion+'</td><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td></tr>';

                    cont++;
                    $('#detalles').append(fila);
                }else{
                    alert('Error al Ingresar Datos');
                }

            }

            function eliminar(index){   
                $("#fila" + index).remove();
            }
        </script>
@endsection

