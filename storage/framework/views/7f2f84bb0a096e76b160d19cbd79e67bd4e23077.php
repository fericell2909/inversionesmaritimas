<?php $__env->startSection('title', '| Editar Sub Categoria'); ?>

<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <h2 class="text-center text-info"><?php echo app('translator')->getFromJson('subcategory.edittitle'); ?> <?php echo e($subcategory->name); ?></h2>
        <div class="panel-body">
            <?php echo e(Form::model ($subcategory, ['route' => ['subcategory.update', $subcategory->id], 'method' => 'PUT', 'class' => 'form-horizontal' ])); ?>

            <div class="form-group">
                <?php echo e(Form::label('name' , 'Categoria', ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-10">
                    <select name="categories_id" id="categories_id" class="form form-control" readonly >
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($subcategory->categories_id == $cat->id): ?>
                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('name' ,trans('subcategory.name'),['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-10">
                    <?php echo e(Form::text('name', $subcategory->name, ['class'=>'form-control', 'placeholder' => 'Nombre'])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('name' , 'Estado', ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-10">
                    <select name="estado_id" id="estado_id" class="form form-control">
                        <?php if($subcategory->estado_id == 1): ?>
                            <option selected value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        <?php else: ?>
                            <option  value="1">Activo</option>
                            <option selected value="2">Inactivo</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info"><i class="fa fa-pencil"
                                                                  aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.update'); ?>
                    </button>
                </div>
            </div>
        <?php echo e(Form::close()); ?>    <!-- end form -->

        </div> <!-- end div .panel-body -->
    </div>  <!-- end div .panel -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>