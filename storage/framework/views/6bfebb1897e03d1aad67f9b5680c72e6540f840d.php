<?php $__env->startSection('title', '| Editar Proveedor'); ?>
<?php $__env->startSection('content'); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h2 class="text-info text-center"><?php echo app('translator')->getFromJson('supplied.editprov'); ?> <?php echo e($suppliers->name); ?></h2></div>
        <div class="panel-body">
            <?php echo e(Form::model($suppliers, ['route' => ['suppliers.update', $suppliers->id],  'method' => 'PUT', 'class' => 'form-horizontal'  ])); ?>

            <div class="form-group">
                <?php echo e(Form::label('name' ,trans('supplied.name'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-10">
                    <?php echo e(Form::text('name',  $suppliers->name, ['class'=>'form-control', 'placeholder' => trans('supplied.name')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('fax' , trans('supplied.ruc'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::text('ruc', $suppliers->ruc, ['class'=>'form-control', 'placeholder' => trans('supplied.ruc'),'maxlength'=>'11'])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('address' , trans('supplied.address'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-10">
                    <?php echo e(Form::text('address',  $suppliers->address, ['class'=>'form-control', 'placeholder' => trans('supplied.address')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('telephone' , trans('supplied.phone'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-10">
                    <?php echo e(Form::text('telephone',  $suppliers->phone, ['class'=>'form-control', 'placeholder' => trans('supplied.phone')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('fax' , trans('supplied.fax'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-10">
                    <?php echo e(Form::text('fax', $suppliers->fax, ['class'=>'form-control', 'placeholder' => trans('supplied.fax') ])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('info' , trans('supplied.info'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-10">
                    <?php echo e(Form::textarea('info',  $suppliers->info, ['class'=>'form-control','id' => 'textarea', 'placeholder' => trans('supplied.info')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('estado' ,trans('supplied.estado'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    
                    <select class="form-control text-center" name="estado" id="estado">
                                <?php if($suppliers->estado_id == 1): ?>
                                     <option selected value="1">Activo</option>
                                     <option  value="2">Inactivo</option>
                                <?php else: ?>
                                    <option value="1">Activo</option>
                                    <option selected value="2">Inactivo</option>
                                <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn  btn-info"><i class="fa fa-pencil"
                                                                   aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.update'); ?>
                    </button>
                </div>
            </div>
        <?php echo e(Form::close()); ?> <!-- end form -->
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>