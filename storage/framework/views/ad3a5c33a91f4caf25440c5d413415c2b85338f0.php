<?php $__env->startSection('title', '| Analysis customers'); ?>
<?php $__env->startSection('content'); ?>

    <div class="col-md-4">
        <div id="anaylsisCustomers">
            <p><?php echo app('translator')->getFromJson('analysis.lastc'); ?></p>
            <ol>
                <?php $__currentLoopData = $lastCustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $last): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(url('/customers').'/'.$last->number); ?>"><?php echo e($last->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <canvas id="day" width="200"></canvas>
            </div> <!-- end div .panel-body -->
        </div> <!-- end div .panel -->
    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <canvas id="yearly" width="200"></canvas>
            </div> <!-- end div .panel-body -->
        </div> <!-- end div .panel -->
    </div>
    <script src="<?php echo e(asset('js/plugins/Chart.min.js')); ?>"></script>
    <script>
        //Week
        var ctx = $("#day");
        var DayChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php if(!empty($week)): ?> <?php $__currentLoopData = $week; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo '"'.$a->day.'",'; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>],
                datasets: [{
                    label: '<?php echo app('translator')->getFromJson('analysis.most'); ?>',
                    data: [<?php if(!empty($week)): ?> <?php $__currentLoopData = $week; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo '"'.$a->number.'",'; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }],
            },
            options: {
                scales: {

                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: "<?php echo app('translator')->getFromJson('analysis.weekly'); ?>"
                        }
                    }]
                }
            }
        });

        // Month
        var ctx = $("#yearly");
        var salesMoney = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php if(!empty($year)): ?> <?php $__currentLoopData = $year; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo '"'.$a->month.'",'; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>],
                datasets: [
                    {
                        label: '<?php echo app('translator')->getFromJson('analysis.yearly'); ?>',
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
                        data: [<?php if(!empty($year)): ?> <?php $__currentLoopData = $year; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($a->number.','); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>],
                        spanGaps: false,
                    }
                ]
            },

            options: {
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: "<?php echo app('translator')->getFromJson('analysis.yearly'); ?>"
                        }
                    }]
                }
            }
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>