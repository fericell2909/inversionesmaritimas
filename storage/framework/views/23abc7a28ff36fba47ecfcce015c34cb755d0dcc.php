<?php $__env->startSection('title', '| Editar Paciente '); ?>
<?php $__env->startSection('content'); ?>

    <div class="panel panel-default">
        <h2 class="text-center text-info"><?php echo app('translator')->getFromJson('customers.editcust'); ?> <?php echo e($customers->name); ?></h2>

        <div class="panel-body">
            <?php echo e(Form::model($customers, ['route' => ['customers.update', $customers->id],  'method' => 'PUT', 'class' => 'form-horizontal'  ])); ?>


            <div class="form-group">
                
                <?php if($customers->tipo == 1): ?>
                    <?php echo e(Form::label('name' ,'Nombres y Apellidos', ['class' => 'control-label col-sm-2'])); ?>

                <?php else: ?>
                    <?php echo e(Form::label('name' ,'Razon Social', ['class' => 'control-label col-sm-2'])); ?>

                <?php endif; ?>
                

                <div class="col-sm-8">
                    
                    <?php if($customers->tipo == 1): ?>
                        <?php echo e(Form::text('name',  $customers->name, ['class'=>'form-control', 'placeholder' => 'Nombres y Apellidos'])); ?>

                    <?php else: ?>
                        <?php echo e(Form::text('name',  $customers->name, ['class'=>'form-control', 'placeholder' => 'Razon Social'])); ?>

                    <?php endif; ?>    
                </div>

            </div>
            <div class="form-group">
                
                <?php if($customers->tipo == 1): ?>
                    <?php echo e(Form::label('dni' , 'dni', ['class' => 'control-label col-sm-2'])); ?>

                <?php else: ?>
                    <?php echo e(Form::label('dni' , 'ruc', ['class' => 'control-label col-sm-2'])); ?>

                <?php endif; ?>

                
                
                <div class="col-sm-8">
                    <?php if($customers->tipo == 1): ?>
                        <?php echo e(Form::text('dni',  $customers->dni, ['class'=>'form-control','readonly'=>'readonly' ,'maxlength'=>8 ,'placeholder' => 'dni'])); ?>

                    <?php else: ?>
                        <?php echo e(Form::text('dni',  $customers->dni, ['class'=>'form-control','readonly'=>'readonly' , 'maxlength'=>11 ,'placeholder' => 'ruc'])); ?>

                    <?php endif; ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('phone' , trans('customers.phone'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::text('phone',  $customers->phone, ['class'=>'form-control', 'placeholder' => trans('customers.phone')])); ?>

                </div>
            </div>

            <div class="form-group">
                <?php echo e(Form::label('info' , trans('customers.info'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::textarea('info',  $customers->info, ['class'=>'form-control','id' => 'textarea',  'placeholder' => trans('customers.info')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('estado' ,trans('users.estado'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    
                    <select class="form-control text-center" name="estado" id="estado">
                                <?php if($customers->estado_id == 1): ?>
                                     <option selected value="1">Activo</option>
                                     <option  value="2">Inactivo</option>
                                <?php else: ?>
                                    <option value="1">Activo</option>
                                    <option selected value="2">Inactivo</option>
                                <?php endif; ?>
                    </select>
                </div>
            </div>
            <input type="text" name="tipo" id="tipo" style="display:none;" class="form-control" value="<?php echo e($customers->tipo); ?>" required="required"  title="">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <button type="submit" class="btn  btn-info"><i class="fa fa-pencil"
                                                                   aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.update'); ?>
                    </button>
                </div>
            </div>
        <?php echo e(Form::close()); ?> <!--end form !-->
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>