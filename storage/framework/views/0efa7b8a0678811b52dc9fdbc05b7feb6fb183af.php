<?php $__env->startSection('title', '| Editar Cuenta de Usuario'); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-heading"><h2 class="text-info text-center"><?php echo app('translator')->getFromJson('users.edit'); ?></h2></div>

        </div>
        <div class="panel-body">
            <?php echo e(Form::model($users, ['route' => ['users.update', $users->id],  'method' => 'PUT', 'class' => 'form-horizontal'  ])); ?>

            <div class="form-group">
                <?php echo e(Form::label('name' ,trans('users.name'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::text('name',  $users->name, ['class'=>'form-control', 'placeholder' => trans('users.name')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('email' , trans('users.email'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::text('email',  $users->email, ['class'=>'form-control', 'placeholder' => trans('users.email')])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('password' , trans('users.password'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    <?php echo e(Form::text('password',null, ['class'=>'form-control', 'placeholder' => trans('users.password') ])); ?>

                </div>
            </div>
            

            <div class="form-group">
                <?php echo e(Form::label('permission' ,trans('users.permission'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    
                    <select class="form-control text-center" name="role" id="role">
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($role->id == $users->roles_id): ?>
                                     <option selected value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                <?php else: ?>
                                    <option  value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('estado' ,trans('users.estado'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-8">
                    
                    <select class="form-control text-center" name="estado" id="estado">
                                <?php if($users->estado_id == 1): ?>
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
                    <button class="btn btn-info" type="submit">
                        <i class="fa fa-pencil" aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.update'); ?>
                    </button>
                </div>
            </div>
        <?php echo e(Form::close()); ?>

        <!-- end form -->
        </div>
        <!-- end div .panel-body -->
    </div>
    <!-- end div .panel -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>