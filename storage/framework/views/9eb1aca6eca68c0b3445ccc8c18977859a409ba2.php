<?php $__env->startSection('title', '| Registrar Nuevo Cliente'); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            
            <div class="col-md-6">

                <h3 class="text-center text-info">Registrar Nuevo Cliente Natural</h3>
                <?php echo e(Form::open(['route' => 'customers.CrearPaciente', 'class' => 'form-horizontal','method'=>'POST'])); ?>

                <div class="form-group">
                    <?php echo e(Form::label('name' , 'Nombres y Apellidos', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('name', null, ['required' => 'required','class'=>'form-control letras', 'placeholder' => 'Nombres y Apellidos'])); ?>

                    </div>
                </div>
                <div class="form-group">
                      <?php echo e(Form::label('dni' , 'Dni', ['required' => 'required','class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-10">
                            <input class="form-control numero" maxlength="8" placeholder="Dni" name="dni" type="text" id="dni" required>
                        </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('phone' , trans('customers.phone'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('phone', null, ['required' => 'required','class'=>'form-control numero', 'placeholder' => trans('customers.phone')])); ?>

                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('info' , trans('customers.info'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::textarea('info', null, ['required' => 'required','class'=>'form-control','id' => 'textarea',  'placeholder' => trans('customers.info')])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="tipo" id="tipo" class="form-control" value="1" required="required" style="display:none;">
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button class="btn btn-info" type="submit"><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> Crear Cliente Natural
                        </button>
                    </div>
                </div>
                 <?php echo e(Form::close()); ?> <!-- end form !-->
            </div>
            <div class="col-md-6">
                <h3 class="text-center text-info">Registrar Nuevo Cliente Jurídico</h3>
                <?php echo e(Form::open(['route' => 'customers.CrearPaciente', 'class' => 'form-horizontal','method'=>'POST'])); ?>

                <div class="form-group">
                    <?php echo e(Form::label('name' , 'Razon Social', ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('name', null, ['required' => 'required','class'=>'form-control letras', 'placeholder' => 'Razon Social'])); ?>

                    </div>
                </div>
                <div class="form-group">
                      <?php echo e(Form::label('dni' , 'ruc', ['required' => 'required','class' => 'control-label col-sm-2'])); ?>

                        <div class="col-sm-10">
                            <input class="form-control numero" maxlength="11" placeholder="ruc" name="dni" type="text" id="ruc" required>
                        </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('phone' , trans('customers.phone'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('phone', null, ['required' => 'required','class'=>'form-control numero', 'placeholder' => trans('customers.phone')])); ?>

                    </div>
                </div>

                <div class="form-group">
                    <?php echo e(Form::label('info' , trans('customers.info'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::textarea('info', null, ['required' => 'required','class'=>'form-control','id' => 'textarea',  'placeholder' => trans('customers.info')])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="tipo" id="tipo2" class="form-control" value="2" required="required" style="display:none;">
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button class="btn btn-info" type="submit"><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> Crear Cliente Jurídico
                        </button>
                    </div>
                </div>
            <?php echo e(Form::close()); ?>

            </div>
           
<!-- end col 6 -->
                <!-- end col 12 -->
        </div> <!-- end div .panel-body -->
   
    </div>


    <script>
        $(function () {
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