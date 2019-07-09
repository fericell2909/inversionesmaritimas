<?php $__env->startSection('title', '| Suppliers'); ?>
<?php $__env->startSection('content'); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h2 class="text-info text-center"><?php echo app('translator')->getFromJson('supplied.title'); ?></h2></div>

        <div class="panel-body">
            <div id="tablePanel">
                <a href="<?php echo e(url('/suppliers/create')); ?>">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> <?php echo app('translator')->getFromJson('supplied.addprov'); ?>
                    </button>
                </a>
            </div>  <!-- end div #tablePanel -->
            <hr> <!-- line -->
            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div id="provideDiv">
                        <strong id="info"><?php echo app('translator')->getFromJson('supplied.name'); ?></strong>
                        <p><?php echo e($prov->name); ?></p>
                        <strong id="info"><?php echo app('translator')->getFromJson('supplied.ruc'); ?></strong>
                        <p><?php echo e($prov->ruc); ?></p>
                        <strong id="info"><?php echo app('translator')->getFromJson('supplied.address'); ?></strong>
                        <p><?php echo e($prov->address); ?></p>
                        <strong id="info"><?php echo app('translator')->getFromJson('supplied.phone'); ?> </strong>
                        <p><?php echo e($prov->phone); ?></p>
                        
                        <strong id="info"><?php echo app('translator')->getFromJson('supplied.fax'); ?> </strong>
                        <p><?php echo e($prov->fax); ?></p>
                        <strong id="info"><?php echo app('translator')->getFromJson('supplied.estado'); ?> </strong>
                        <p>

                            <?php if($prov->estado_id == 1): ?>
                                    <span class="label label-success">
                                        Activo</span>
                            <?php else: ?>
                                    <span class="label label-danger">
                                        Inactivo</span>
                            <?php endif; ?>
                        </p>

                        <strong id="info"><?php echo app('translator')->getFromJson('supplied.info'); ?></strong>
                        <div style="color:#fff !important;"><?php echo $prov->info; ?></div>

                        <div class="btnProviderDiv">
                            <a href="<?php echo e(route('suppliers.edit', $prov->id)); ?>">
                                <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                        aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.edit'); ?>
                                </button>
                            </a>
                            
                        </div>  <!-- end div #btnProviderDiv -->
                    </div>
                </div> <!-- end col-md-3 -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>  <!-- end div #provideDiv -->
    </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>