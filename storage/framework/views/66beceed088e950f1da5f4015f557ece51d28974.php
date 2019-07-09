<?php $__env->startSection('title', '| Crear Nuevo Proveedor'); ?>
<?php $__env->startSection('content'); ?>

    <div class="panel panel-default">
        <h2 class="text-info text-center"><?php echo app('translator')->getFromJson('supplied.addprov'); ?></h2>

        <div class="panel-body">
            <?php echo e(Form::open(['route' => 'suppliers.store', 'class' => 'form-horizontal'])); ?>

            <div class="form-group">
                <?php echo e(Form::label('name' , trans('supplied.name'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::text('name', null, ['class'=>'form-control', 'placeholder' => trans('supplied.name')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('fax' , trans('supplied.ruc'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::text('ruc', null, ['class'=>'form-control', 'placeholder' => trans('supplied.ruc'),'maxlength'=>'11'])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('address' , trans('supplied.address'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::text('address', null, ['class'=>'form-control', 'placeholder' => trans('supplied.address')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('telephone' , trans('supplied.phone'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::text('telephone', null, ['class'=>'form-control', 'placeholder' => trans('supplied.phone')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('fax' , trans('supplied.fax'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::text('fax', null, ['class'=>'form-control', 'placeholder' => trans('supplied.fax')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('info' , trans('supplied.info'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::textarea('info', null, ['class'=>'form-control', 'id' => 'textarea', 'placeholder' => trans('supplied.info')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('estado' ,trans('supplied.estado'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    
                    <select class="form-control text-center" name="estado" id="estado">
                                     <option selected value="1">Activo</option>
                                     <option  value="2">Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn  btn-info"><i class="fa fa-plus-circle"
                                                                   aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.create'); ?>
                    </button>
                </div>
            </div>
        <?php echo e(Form::close()); ?> <!-- end form -->
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>