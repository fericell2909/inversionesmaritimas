<?php $__env->startSection('title', '| Reportes y Análisis'); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        
        <div class="panel-body">
            <div class="col-md-12" id="analysis">
                <div class="col-md-4">
                    <a href="<?php echo e(url('/analysis/sales')); ?>">
                        <div id="sales">
                            <i class="fa fa-cart-plus fa-5x"></i>
                            <h3><small style="color:#fff;"><?php echo app('translator')->getFromJson('analysis.sales'); ?></small></h3>
                        </div>
                    </a>
                </div>   <!-- end div #sales -->

                <div class="col-md-4">
                    <a href="<?php echo e(url('/analysis/purchases')); ?>">
                        <div id="purchases">
                            <i class="fa fa-truck fa-5x"></i>
                            <h3><small style="color:#fff;"><?php echo app('translator')->getFromJson('analysis.purchases'); ?></small></h3>
                        </div>  <!-- end div #purchase -->
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo e(url('/analysis/customers')); ?>">
                        <div id="customers">
                            <i class="fa fa-users fa-5x"></i>
                            <h3><small style="color:#fff;">Analisis de Clientes</small></h3>
                        </div>  <!-- end div #customer -->
                    </a>
                </div>
            </div> <!-- end div #analysis -->
            <div class="col-md-12" style="margin-top: 5px;"  id="analysis">
                <div class="col-md-4"><a href="<?php echo e(url('analysis/reportes/preciosventa')); ?>"><div id="purchases"><i class="fa fa-list fa-5x"></i><h3 style="margin-top: 0px;"><small style="color:#fff;">Reporte Precios de Venta</small></h3></div></a>
                </div>
                <div class="col-md-4"><a href="<?php echo e(url('analysis/reportes/VentasUsuario')); ?>"><div id="purchases"><i class="fa fa-handshake-o fa-5x"></i><h3 style="margin-top: 0px;"><small style="color:#fff;">Reporte de Ventas por Usuario</small></h3></div></a>
                </div>
                <div class="col-md-4"><a href="<?php echo e(url('analysis/reportes/stockmedicamentos')); ?>"><div id="purchases"><i class="fa fa-list fa-5x"></i><h3 style="margin-top: 0px;"><small style="color:#fff;">Reporte Stock de Productos</small></h3></div></a>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 5px;"  id="analysis">
                <div class="col-md-4"><a href="<?php echo e(url('analysis/reportes/movimientosalmacen')); ?>"><div id="purchases"><i class="fa fa-list fa-5x"></i><h3 style="margin-top: 0px;"><small style="color:#fff;">Reporte de Kardex de Almacen</small></h3></div></a>
                </div>
            </div>
        </div>
         <!-- end div .panel-body -->
    </div> <!-- end div .panel -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>