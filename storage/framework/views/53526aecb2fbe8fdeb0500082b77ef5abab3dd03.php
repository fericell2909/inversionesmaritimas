<?php $__env->startSection('title', '| Sin stock'); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><h4 class="text-center text-info"><?php echo app('translator')->getFromJson('navbar.outstock'); ?></h4></div>
        <div class="panel-body">
            <div class="col-md-12 col-sm-12  col-xs-12">
                <div class="table-responsive" id="divProductTable">
                    <table class="table table-hover results">
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->getFromJson('products.bname'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.gname'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.category'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.price'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.quantity'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.discount'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.expire'); ?></th>
                            <th class="text-center" ><?php echo app('translator')->getFromJson('products.control'); ?></th>
                        </tr>
                        <tbody id="productDivBoxAjax"></tbody>  <!-- end tbody #productDivBoxAjax -->
                        <tbody id="productDivBox">
                        <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($pro->p_id); ?></td>
                                <td style="width: 130px;">
                                    <?php if(!empty($pro->p_icon)): ?>
                                        <img src="<?php echo e(asset('img').'/'.$pro->p_icon); ?>.png" width="20">
                                    <?php endif; ?>
                                    <?php echo e($pro->p_bname); ?></td>
                                <td><?php echo e($pro->p_gname); ?></td>
                                <td><?php echo e($pro->name); ?></td>
                                <td style="width: 100px;">
                                    <small style="float: left;"> <?php echo e(get_currencySymbols()); ?> </small><?php echo e($pro->p_price); ?>

                                </td>
                                <td id="quantityProduct">
                                    <?php if(preg_replace('/[^0-9]/','',$pro->p_quantity) < 4 ): ?>
                                        <span class="label label-danger" data-toggle="tooltip"
                                              title="Le queda poco de este producto, todo lo que tiene <?php echo e($pro->p_quantity); ?>"> SOLO HAY <?php echo e($pro->p_quantity); ?> </span>
                                    <?php else: ?>
                                        <?php echo e($pro->p_quantity); ?>

                                    <?php endif; ?></td>
                                <td><?php echo e($pro->p_discount); ?>%</td>
                                <td>
                                    <?php if(strtotime($pro->p_exdate) < strtotime(Carbon\Carbon::now())): ?>
                                        <span class="label label-danger" data-toggle="tooltip"
                                              title="El Producto Vencio en <?php echo e(date('d-M-y', strtotime($pro->p_exdate))); ?>"> Producto Vencido </span>
                                    <?php else: ?>
                                        <?php echo e(date('d-M-y', strtotime($pro->p_exdate))); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('product.show', $pro->p_id)); ?>">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-eye"
                                                                                aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.show'); ?>
                                        </button>
                                    </a>
                                    <a href="<?php echo e(route('product.edit', $pro->p_id)); ?>">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.edit'); ?>
                                        </button>
                                    </a>

                                    
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody> <!-- end tbody #productDivBox -->
                    </table>
                    <div class="text-left ">
                        <ul class="pagination-primary">
                            <?php echo e($product->links()); ?>

                        </ul> <!-- end div .pagination-primary -->
                    </div>
                </div> <!-- end div #divProductTable -->
            </div>    <!-- end col 12 -->
        </div>  <!-- end div .panel-body -->
    </div>  <!-- end div .panel -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>