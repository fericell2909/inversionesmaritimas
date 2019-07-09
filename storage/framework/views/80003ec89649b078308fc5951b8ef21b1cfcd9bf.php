<?php $__env->startSection('title', '| Ver'); ?>
<?php $__env->startSection('content'); ?>

    <div class="panel panel-default">
        <h2 class="text-center text-info">Datos del Cliente</h2>
        <div class="panel-body">

            <div class="col-md-10" id="customerInfo">

                <?php $__currentLoopData = $custorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                        <div class="col-md-6" id="customer-address">
                            <strong><?php echo app('translator')->getFromJson('customers.customerno'); ?></strong>
                            <p><?php echo e($cust->number); ?></p>
                            <strong>
                                Tipo de Cliente
                            </strong>
                            <p><?php if($cust->tipo == 1): ?>
                                    Cliente Natural
                                <?php else: ?>
                                    Cliente Juridico
                                <?php endif; ?></p>
                            <strong><?php echo app('translator')->getFromJson('customers.phone'); ?></strong>
                            <p><?php echo e($cust->phone); ?></p>
                        </div>

                        <div class="col-md-6" id="customer-info">
                            <strong><?php if($cust->tipo == 1): ?>
                                    Nombres - Apellidos - Dni 
                                <?php else: ?>
                                    Razon Social - Ruc
                                <?php endif; ?></strong>

                            <p><?php echo e($cust->name . ' - ' .$cust->dni); ?> </p>
                            <strong>Fecha de Creacion</strong>
                            <p><?php echo e($cust->created_at); ?></p>
                            <strong><?php echo app('translator')->getFromJson('customers.info'); ?></strong>
                            <p><?php echo $cust->info; ?></p>
                        </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>  <!-- end div #customerInfo !-->

            
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->

    <!-- Print paper -->

   

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>