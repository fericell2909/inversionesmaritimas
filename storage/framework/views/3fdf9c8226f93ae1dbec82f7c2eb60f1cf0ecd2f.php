<?php $__env->startSection('title', '|Actualizar Cuenta'); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo app('translator')->getFromJson('account.title'); ?></div>
            <div class="panel-body">
                <?php echo e(Form::model (['route' => 'account.update', 'method' => 'PUT' ], ['class' => 'form-horizontal'] )); ?>

                <div class="form-group">
                    <?php echo e(Form::label('name' , trans('account.name'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('name',Auth::user()->name, ['class'=>'form-control'])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('email',trans('account.email'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::email('email',Auth::user()->email,['class' => 'form-control','readonly'=>'readonly'])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('password',trans('account.password'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::password('password',['class' => 'form-control'])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-info"><?php echo app('translator')->getFromJson('button.update'); ?></button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>