<?php $__env->startSection('title', '| Discount'); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-offset-2 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"> <?php echo app('translator')->getFromJson('tools.titlediscount'); ?> </div>

            <div class="panel-body">

                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2"><?php echo app('translator')->getFromJson('tools.before'); ?></label>
                        <div class="col-md-10">
                            <div class="input-discount-calc">
                                <?php echo e(get_currencySymbols()); ?>

                                <input type="text" class="form-control" autocomplete="off" maxlength="14" id="before"
                                       placeholder="<?php echo app('translator')->getFromJson('tools.price'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2"><?php echo app('translator')->getFromJson('tools.discount'); ?></label>
                        <div class="col-md-10">
                            <div class="input-discount-calc">
                                <i id="discount-calc">%</i>
                                <input type="text" class="form-control" autocomplete="off" maxlength="14" id="discount"
                                       placeholder="<?php echo app('translator')->getFromJson('tools.discount'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2"><?php echo app('translator')->getFromJson('tools.after'); ?></label>
                        <div class="col-md-10">
                            <div class="input-discount-calc">
                                <?php echo e(get_currencySymbols()); ?>

                                <input type="text" class="form-control" autocomplete="off" maxlength="14" id="after"
                                       maxlength="14" placeholder="<?php echo app('translator')->getFromJson('tools.afterd'); ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2"><?php echo app('translator')->getFromJson('tools.save'); ?></label>
                        <div class="col-md-10">
                            <div class="input-discount-calc">
                                <?php echo e(get_currencySymbols()); ?>

                                <input type="text" class="form-control" id="saver" maxlength="14"
                                       placeholder="<?php echo app('translator')->getFromJson('tools.save'); ?>" disabled>
                            </div>
                        </div>
                    </div>
                </form>  <!-- end forn-->
            </div>  <!-- end div .panel-->
        </div> <!-- end div .panel-->
    </div> <!-- end col 6 -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>