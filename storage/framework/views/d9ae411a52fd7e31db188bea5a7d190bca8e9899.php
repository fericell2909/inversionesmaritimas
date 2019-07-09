<?php $__env->startSection('title', '| Inicio'); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="text-success"><?php echo app('translator')->getFromJson('dashboard.dashboard'); ?></span></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="allSales">
                            <div id="pContent">
                                <h3>
                                    <?php if(!empty($totalproduct)): ?>
                                        <?php echo e($totalproduct[0]->totalproduct); ?>

                                    <?php else: ?>
                                        0
                                    <?php endif; ?>
                                </h3>
                                <hr>
                                <p>
                                    <?php echo e(product($dayProduct['yasterday'],$dayProduct['today'])); ?>

                                    <?php echo app('translator')->getFromJson('dashboard.instock'); ?> </p>
                            </div> <!-- end div #pContent -->
                            <i class="fa fa-archive fa-5x"></i>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6  col-xs-12">
                        <div id="totalSale">
                            <div id="pContent">
                                <h3>
                                    <?php if(!empty($totalsale)): ?>
                                       S/. <?php echo e($daySales['today']); ?> 
                                    <?php else: ?>
                                        S/. <?php echo e(number_format($daySales['today'],2)); ?>

                                    <?php endif; ?>
                                </h3>
                                <hr>
                                <p>
                                    <?php echo e(check($daySales['yasterday'],$daySales['today'])); ?>

                                    Ventas del Dia </p> 
                            </div>  <!-- end div #pContent -->
                            <i class="fa fa-product-hunt fa-5x"></i>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="totalPurchases">
                            <div id="pContent">
                                <h3>
                                    <?php if(!empty($totalpurchases)): ?>
                                        <?php echo e($totalpurchases[0]->totalpurchases); ?> S/.
                                    <?php else: ?>
                                        0 S/.
                                    <?php endif; ?>
                                </h3>
                                <hr>
                                <p>
                                    <?php echo e(check($dayPurchases['yasterday'],$dayPurchases['today'])); ?>

                                    <?php echo app('translator')->getFromJson('dashboard.totalpurchases'); ?> </p>
                            </div>    <!-- end div #pContent -->
                            <i class="fa fa-truck fa-5x"></i>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="totalCustomers">
                            <div id="pContent">
                                <h3>
                                    <?php if(!empty($totalcustomers)): ?>
                                        <?php echo e($totalcustomers[0]->customers); ?>

                                    <?php else: ?>
                                        0
                                    <?php endif; ?>
                                </h3>
                                <hr>
                                <p>
                                    <?php echo e(product($dayCustomers['yasterday'],$dayCustomers['today'])); ?>

                                    <?php echo app('translator')->getFromJson('customers.title'); ?> </p>
                            </div>   <!-- end div #pContent -->
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                    </div>
                </div>
            </div> <!-- end div .panel-body -->
        </div> <!-- end div .panel -->
    </div> <!-- end col 12 -->
    <div class="col-md-8 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="text-info"><?php echo app('translator')->getFromJson('dashboard.analysis'); ?></span></div>
            <div class="panel-body">
                <div class="col-md-12  col-sm-12 col-xs-12 pull-right">
                    <canvas id="salesMoney" width="200"></canvas>
                </div>
            </div> <!-- end div .panel-body -->
        </div> <!-- end div .panel -->
    </div> <!-- end col 8 -->
    <div class="col-md-4 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="text-info"><?php echo app('translator')->getFromJson('dashboard.analysisTop'); ?></span></div>
            <div class="panel-body">
                <div class="col-md-12 col-sm-12 col-xs-12 pull-right">
                    <canvas id="topSalesProducts" width="200"></canvas>
                </div>
            </div> <!-- end div .panel-body -->
        </div> <!-- end div .panel -->
    </div> <!-- end col 4 -->
    <!--Latest customers -->
    <div class="col-md-8 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="text-info"><?php echo app('translator')->getFromJson('dashboard.lastcustomer'); ?></span></div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <tr>
                            <th><?php echo app('translator')->getFromJson('customers.name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('customers.dni'); ?></th>
                            <th><?php echo app('translator')->getFromJson('customers.phone'); ?></th>
                            <th><?php echo app('translator')->getFromJson('customers.date'); ?></th>
                        </tr>
                        <tbody id="cuctomersDivBox">
                        <?php if(!empty($customers)): ?>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($cust->name); ?></td>
                                    <td><?php echo e($cust->dni); ?></td>
                                    <td><?php echo e($cust->phone); ?></td>
                                    <td><?php echo e(date('F j, Y', strtotime($cust->created_at))); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </tbody>   <!-- end tbody #cuctomersDivBox -->
                    </table>  <!-- end div table -->
                </div>
            </div> <!-- end div .panel-body -->
        </div> <!-- end div .panel -->
    </div> <!-- end col 8 -->
    <?php if(!empty($customers)): ?>
        <div class="col-md-4 col-xs-12">
            <?php $__currentLoopData = $note; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body <?php echo e($no->color); ?>" id="noteContent">
                            <div class="form-group label-floating" style="margin: 0;">
                                <p class="noteName"><?php echo e($no->name); ?></p>
                                <small class="noteDate"><?php echo e($no->created_at); ?></small>
                            </div>
                            <div class="form-group label-floating" style="margin-top: 0;">
                                <textarea class="form-control" id="noteText" cols="20" id="" maxlength="200"
                                          name="noteText" rows="5" disabled><?php echo e($no->content); ?> </textarea>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col 12 -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div> <!-- end col 4 -->
        </div> <!-- end div .panel-body -->
        <script src="<?php echo e(asset('js/plugins/Chart.min.js')); ?>"></script>
        <script>

            /*
             Sales Chart
             */
            var ctx = $("#topSalesProducts");
            var salesChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [<?php if(!empty($salequantity)): ?> <?php $__currentLoopData = $salequantity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo '"'.$a->money.'",'; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>],
                    datasets: [{
                        backgroundColor: ['#f44336', '#e91e63', '#03a9f4', '#004d40', '#ffc400', '#ff5722', '#263238', '#4caf50', '#6200ea', '#880e4f'],
                        hoverBackgroundColor: "rgba(75,192,192,0.4)",
                        data: [<?php if(!empty($salequantity)): ?> <?php $__currentLoopData = $salequantity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($a->total.','); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>]
                    }
                    ]
                }
            });

            /*
             Sales money within a year
             */

            var ctx = $("#salesMoney");
            var salesMoney = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?php if(!empty($apurchases)): ?> <?php $__currentLoopData = $apurchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo '"'.$a->month.'",'; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>],
                    datasets: [
                        {
                            label: "<?php echo app('translator')->getFromJson('dashboard.amountmoney'); ?>",
                            fill: true,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,

                            pointHitRadius: 10,
                            data: [<?php if(!empty($salemoney)): ?> <?php $__currentLoopData = $salemoney; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($a->money.','); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>],
                            spanGaps: false,
                        }, {
                            label: "<?php echo app('translator')->getFromJson('dashboard.amountpurchases'); ?>",
                            pointHoverBackgroundColor: "rgba(244, 67, 53,1)",
                            pointHoverBorderColor: "rgba(244, 67, 53,1)",
                            pointBorderColor: "rgba(14, 0, 0,1)",
                            pointBackgroundColor: "#fff",
                            backgroundColor: "rgba(244, 67, 53, 0.67)",
                            borderColor: "rgba(244, 67, 53,1)",
                            data: [<?php if(!empty($apurchases)): ?> <?php $__currentLoopData = $apurchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($a->money.','); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>],
                        }
                    ]
                }
            });
        </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>