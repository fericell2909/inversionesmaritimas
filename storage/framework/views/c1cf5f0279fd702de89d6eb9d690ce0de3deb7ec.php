<?php $__env->startSection('title', '| Ver Producto'); ?>

<?php $__env->startSection('content'); ?>

    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3 class="text-info" >Detalle del Producto</h3></div>

        <div class="panel-body">
            <div class="col-md-6" id="productShow">
                <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <h2><?php echo e($pro->p_gname); ?></h2>
                    <ul class="list-unstyled">
                        <li><strong><?php echo app('translator')->getFromJson('products.gname'); ?>: </strong> <?php echo e($pro->p_gname); ?></li>
                        <li><strong><?php echo app('translator')->getFromJson('products.bname'); ?>: </strong> <?php echo e($pro->p_bname); ?></li>
                    </ul>
                    <hr>
                    <h3><?php echo app('translator')->getFromJson('products.desc'); ?></h3>
                    <p><?php echo $pro->p_desc; ?></p>
                    <hr>
                    <p><strong><?php echo app('translator')->getFromJson('products.subcategory'); ?>: </strong> <?php echo e($pro->name); ?></p>
                    <p><strong><?php echo app('translator')->getFromJson('products.quantity'); ?>: </strong>
                        <?php if( $pro->p_quantity - $pro->sale_quantity < 4): ?>
                            <?php echo e($pro->p_quantity - $pro->sale_quantity); ?> <span class="label label-danger">There is only
                                <?php echo e($pro->p_quantity - $pro->sale_quantity); ?> </span>
                        <?php else: ?>
                            <?php echo e($pro->p_quantity - $pro->sale_quantity); ?>

                        <?php endif; ?>
                    </p>
                    <p><strong><?php echo app('translator')->getFromJson('products.salePrice'); ?>: </strong>
                        <small> <?php echo e(get_currencySymbols()); ?> </small> <?php echo e($pro->p_price); ?></p>
                    <p><strong><?php echo app('translator')->getFromJson('products.provName'); ?>: </strong> <?php echo e($pro->p_imname); ?></p>
                    <p><strong><?php echo app('translator')->getFromJson('products.orgPrice'); ?>: </strong>
                        <small> <?php echo e(get_currencySymbols()); ?> </small> <?php echo e($pro->p_imprice); ?></p>
                    <p><strong><?php echo app('translator')->getFromJson('products.discount'); ?>: </strong> <?php echo e($pro->p_discount); ?>%</p>
                    <p><strong><?php echo app('translator')->getFromJson('products.country'); ?>: </strong> <?php echo e($pro->p_country); ?></p>
                    <p style="display:none;"><strong><?php echo app('translator')->getFromJson('products.idp'); ?>: </strong> <?php echo e($pro->p_idnumber); ?></p>
                    <p><strong><?php echo app('translator')->getFromJson('products.exdate'); ?> : </strong> <?php echo e(date('d-M-y', strtotime($pro->p_imdate ))); ?>

                    </p>
                    <p><strong><?php echo app('translator')->getFromJson('products.imdate'); ?> : </strong> <?php echo e(date('d-M-y', strtotime($pro->p_exdate ))); ?>

                    </p>
            </div>  <!-- end div #productShow -->

            <div class="col-md-6 text-center">
                <!--  Drug photo   -->
                <div class="col-md-12">
                    <?php if(!empty($pro->p_image)): ?>
                        <img src="<?php echo e(asset('upload').'/'.$pro->p_image); ?>" data-toggle="tooltip"
                             title="<?php echo e($pro->p_bname); ?> Image " width="250">
                    <?php endif; ?>
                    <hr>
                </div> <!-- end col 12 -->
                <!--  Barcode   -->
                <?php if(!empty($pro->p_barcodeg) && get_setting()->barcode_type !== 'QRCODE' && get_setting()->barcode_type !== 'DATAMATRIX' && get_setting()->barcode_type !== 'PDF417'): ?>
                    <div class="col-md-12" style=" padding: 50px;">
                        <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("$pro->p_barcodeg ", get_setting()->barcode_type) . '" alt="barcode" width="220" data-toggle="tooltip" title=" Barcode " />'; ?>

                        <p><?php echo e($pro->p_barcodeg); ?></p>
                    </div> <!-- end col 12-->
            </div>  <!-- end col 6 -->
            <?php elseif(!empty($pro->p_barcodeg)): ?>
                <div class="col-md-12" style="padding: 50px;">
                    <?php echo '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG("$pro->p_barcodeg ", get_setting()->barcode_type) . '" alt="barcode" width="220" data-toggle="tooltip" title=" Barcode " />'; ?>

                    <p><?php echo e($pro->p_barcodeg); ?></p>
                </div>
        </div> <!-- end div .panel-body -->
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div> <!-- end div .panel -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>