<?php $__env->startSection('title', '| Sub Categorías'); ?>
<?php $__env->startSection('content'); ?>

    <div class="panel panel-default">
        <h2 class="text-center text-info"><?php echo app('translator')->getFromJson('subcategory.title'); ?></h2>
        <div class="panel-body">
            <div id="tablePanel">
                <a href="<?php echo e(url('/subcategory/create')); ?>">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> <?php echo app('translator')->getFromJson('subcategory.addcat'); ?>
                    </button>
                </a>
            </div> <!-- end div #tablePanel -->

            <div class="col-md-12">
                <div class="table-responsive" id="divProductTable">
                    <table class="table table-hover results">
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->getFromJson('subcategory.name'); ?></th>
                            <th>Estado</th>
                            <th>Nombre de Categoría</th>
                            <th class="text-center" ><?php echo app('translator')->getFromJson('subcategory.control'); ?></th>
                        </tr>
                        <tbody class="table-responsive" id="categoryDivBox">
                        <?php $__currentLoopData = $subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($cat->id); ?></td>
                                <td><?php echo e($cat->name); ?></td>
                                
                                <td>
                                    <?php if($cat->estado_id == 1): ?>
                                        <span class="label label-success">
                                           <?php echo e($cat->nombre_estado); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="label label-danger">
                                           <?php echo e($cat->nombre_estado); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($cat->nombrecategoria); ?></td>
                                <td>
                                    <a href="<?php echo e(route('subcategory.edit', $cat->id)); ?>">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.edit'); ?>
                                        </button>
                                    </a>
                                    <?php echo e(Form::open(['route' => ['subcategory.destroy', $cat->id], 'method' => 'DELETE' , 'id' => 'deleteFormSubCategory'])); ?>


                                    <?php echo e(Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> '.trans('button.delete'), ['class'=>'btn btn-xs btn-danger deleteBtnSubCategory', 'type'=>'submit', 'data-id' => $cat->id])); ?>


                                    <?php echo e(Form::close()); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody> <!-- end #categoryDivBox -->
                    </table>
                    <div class="text-left">
                    </div>
                </div> <!-- end div #divProductTable -->
            </div> <!-- end 12 -->
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>