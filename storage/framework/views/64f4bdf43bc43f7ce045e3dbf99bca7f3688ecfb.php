<?php $__env->startSection('title', '| Registrar Nuevo Paciente'); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            
            <div class="col-xs-12">

                <h3 class="text-center text-info"><i class="fa fa-wheelchair" aria-hidden="true"></i> Registrar Nuevo Paciente <i class="fa fa-wheelchair" aria-hidden="true"></i></h3>
                <?php echo e(Form::open(['route' => 'GuardarPacientes', 'class' => 'form-horizontal','method'=>'POST'])); ?>

                <div class="form-group">
                    <?php echo e(Form::label('apellido_paterno' , 'Apellido Paterno', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-6">
                        <?php echo e(Form::text('apellido_paterno', null, ['required' => 'required','class'=>'form-control letras text-center', 'placeholder' => 'Apellido Paterno'])); ?>

                    </div>
                    <span  id ="ErrorMensaje-apellido_paterno" class="help-block">Ingrese Apellido Paterno</span>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('apellido_materno' , 'Apellido Materno', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-6">
                        <?php echo e(Form::text('apellido_materno', null, ['required' => 'required','class'=>'form-control letras text-center', 'placeholder' => 'Apellido Materno'])); ?>

                    </div>
                    <span  id ="ErrorMensaje-apellido_materno" class="help-block">Ingrese Apellido Materno</span>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('nombres' , 'Nombres', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-6">
                        <?php echo e(Form::text('nombres', null, ['required' => 'required','class'=>'form-control letras text-center', 'placeholder' => 'Nombres'])); ?>

                    </div>
                    <span  id ="ErrorMensaje-nombres" class="help-block">Ingrese Nombres</span>
                </div>
                <div class="form-group">
                      <?php echo e(Form::label('dni' , 'Dni', ['required' => 'required','class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control numero text-center"  maxlength="8" placeholder="Dni" name="dni" type="text" id="dni" required>
                        </div>
                        <span  id ="ErrorMensaje-dni" class="help-block">Ingrese Dni</span>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('fechanacimiento','Fecha de Nac.', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-6">
                        <?php echo e(Form::text('fecha_nacimiento', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'datepicker form-control text-center' , 'data-date-format' => 'yyyy-mm-dd'])); ?>

                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('lugarnacimiento','Lugar de Nac.', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-6">
                            <input class="form-control text-center" placeholder = "Lugar de Nacimiento"  name="lugarnacimiento" type="text" id="lugarnacimiento">
                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('EstadoCivil' , 'Estado Civil', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-4">
                        <select name="estado_civil_id" id="estado_civil_id" class="form-control text-center">
                            <?php $__currentLoopData = $estadociviles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estadocivil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($estadocivil->id); ?>"><?php echo e($estadocivil->nombre_estado_civil); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <?php echo e(Form::label('sexo' , 'Sexo', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-4">
                        <select name="sexo_id" id="sexo_id" class="form-control">
                            <?php $__currentLoopData = $sexos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sexo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sexo->id); ?>"><?php echo e($sexo->nombre_sexo); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('gruposanguineo' , 'Grupo Sanguineo', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-4">
                        <select name="grupo_sanguineo_id" id="grupo_sanguineo_id"  class="form-control">
                            <?php $__currentLoopData = $sanguineos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sanguineo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sanguineo->id); ?>"><?php echo e($sanguineo->nombre_grupo); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('estado_id' , 'Estado', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-4">
                        <select name="estado_id" id="estado_id"  class="form-control">
                           
                            <option value="1">Activo</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('direccion' , 'Dirección', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::textarea('direccion', null, ['required' => 'required','class'=>'form-control','id' => 'textarea',  'placeholder' => 'Digite su dirección'])); ?>

                    </div>
                    <span  id ="ErrorMensaje-direccion" class="help-block">Ingrese Dirección</span>
                </div>
                
                <div class="form-group">
                      <?php echo e(Form::label('telefono' , 'Telefono', ['class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control text-center"  placeholder="043-316895" name="telefono" type="text" id="telefono">
                        </div>
                </div>

                
                <div class="form-group">
                      <?php echo e(Form::label('celular' , 'Celular', ['class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control numero text-center" maxlength="9" placeholder="955453193" name="celular" type="text" id="celular">
                        </div>
                </div>     
                <div class="form-group">
                      <?php echo e(Form::label('CarnetExtranjeria' , 'Carnet de Extranjeria', ['class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control text-center" placeholder = "Carnet de Extranjeria"  name="CarnetExtranjeria" type="text" id="CarnetExtranjeria">
                        </div>
                </div>
                 <div class="form-group">
                      <?php echo e(Form::label('DomicilioActual' , 'Domicilio Actual', ['class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control text-center" placeholder="Domicilio Actual"  name="DomicilioActual" type="text" id="DomicilioActual">
                        </div>
                </div>
                 <div class="form-group">
                      <?php echo e(Form::label('DomicilioProcedencia' , 'Domicilio de Procedencia', ['class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control text-center" placeholder="Domicilio de Procedencia"  name="DomicilioProcedencia" type="text" id="DomicilioProcedencia">
                        </div>
                </div>

                <div class="form-group">
                      <?php echo e(Form::label('GradoInstruccion' , 'Grado de Instruccion', ['class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control text-center" placeholder ="Grado de Instruccion"  name="GradoInstruccion" type="text" id="GradoInstruccion">
                        </div>
                </div>

                <div class="form-group">
                      <?php echo e(Form::label('Ocupacion' , ' Ocupacion', ['class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control text-center" placeholder = "Ocupacion"   name="Ocupacion" type="text" id="Ocupacion">
                        </div>
                </div>

                <div class="form-group">
                      <?php echo e(Form::label('Religion' , 'Religion', ['class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control text-center" placeholder = "Religion"  name="Religion" type="text" id="Religion">
                        </div>
                </div>

                <div class="form-group">
                      <?php echo e(Form::label('NombreAcompanante' , 'Nombre de Acompañante', ['class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control text-center" placeholder="Nombre de Acompañante"  name="NombreAcompanante" type="text" id="NombreAcompanante">
                        </div>
                </div>

                <div class="form-group">
                      <?php echo e(Form::label('GradoParentesco' , 'Grado de Parentesco', ['class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control text-center"  name="GradoParentesco" type="text" id="GradoParentesco"
                                placeholder ="Grado de Parentesco"
                            >
                        </div>
                </div>
                <div class="form-group">
                      <?php echo e(Form::label('DomicilioAcompanante' , 'Domicilio de Acompañante', ['class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-6">
                            <input class="form-control text-center"  name="DomicilioAcompanante" type="text" id="DomicilioAcompanante"
                            placeholder = "Domicilio de Acompañante">
                        </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button class="btn btn-info" id="RegistrarPaciente" type="submit"><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> Crear Paciente
                        </button>
                    </div>
                </div>
                 <?php echo e(Form::close()); ?> <!-- end form !-->
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
<?php $__env->stopSection(); ?>  


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>