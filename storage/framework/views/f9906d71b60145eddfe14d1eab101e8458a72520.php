<?php $__env->startSection('title', '| Nueva Sub Categoria'); ?>

<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">

        <h2 class="text-center text-info"><?php echo app('translator')->getFromJson('subcategory.addtitle'); ?></h2>
        <div class="panel-body">
            <?php echo e(Form::open (['route' => 'subcategory.store',  'class' => 'form-horizontal' ])); ?>

            <div class="form-group">
                <?php echo e(Form::label('name' , 'Categoria', ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-10">
                    <select name="categories_id" id="categories_id" class="form form-control">
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

            </div>
            <div class="form-group">
                <?php echo e(Form::label('name' , trans('subcategory.name'), ['class' => 'control-label col-sm-2'])); ?>

                <div class="col-sm-10">
                    <?php echo e(Form::text('name', null, ['class'=>'form-control', 'placeholder' => trans('subcategory.name')])); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info"><?php echo app('translator')->getFromJson('button.create'); ?></button>
                </div>
            </div>
        <?php echo e(Form::close()); ?>    <!-- end form -->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>