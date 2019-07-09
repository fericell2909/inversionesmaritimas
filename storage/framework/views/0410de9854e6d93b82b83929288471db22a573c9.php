<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;

        }

        th, td {
            text-align: left;
            padding: 1px;
            word-break: break-all;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>
</head>
<body>


<table cellspacing="0" style="width: 100%;">
        <tr>


            <td style="width: 75%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold"><?php echo e($empresas[0]->ph_name); ?></span>
                <br> <?php echo e($empresas[0]->ph_caracteristicas); ?>

                <br>RUC: <?php echo e($empresas[0]->ph_ruc); ?>

                <br><?php echo e($empresas[0]->ph_address); ?><br>

                Teléfono: <?php echo e($empresas[0]->ph_telephone); ?><br>
                Email: <?php echo e($empresas[0]->ph_email); ?>

                
            </td>
        </tr>
    </table>
    <br>

<table>
    <tr>
        <th style="background:black;color:white;"><?php echo app('translator')->getFromJson('print.gname'); ?></th>
        <th style="background:black;color:white;"><?php echo app('translator')->getFromJson('print.bname'); ?></th>
        <th style="background:black;color:white;"><?php echo app('translator')->getFromJson('print.imdate'); ?></th>
        <th style="background:black;color:white;"><?php echo app('translator')->getFromJson('print.expire'); ?></th>
        <th style="background:black;color:white;"><?php echo app('translator')->getFromJson('print.price'); ?></th>
        <th style="background:black;color:white;"><?php echo app('translator')->getFromJson('print.orgprice'); ?></th>
        <th style="background:black;color:white;"><?php echo app('translator')->getFromJson('print.quantity'); ?></th>
    </tr>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($product->p_id > 1): ?>
            <tr>
                <td><?php echo e($product->p_gname); ?></td>
                <td><?php echo e($product->p_bname); ?></td>
                <td><?php echo e($product->p_imdate); ?></td>
                <td><?php echo e($product->p_exdate); ?></td>
                <td><?php echo e($product->p_price); ?></td>
                <td><?php echo e($product->p_imprice); ?></td>
                <td><?php echo e($product->p_quantity); ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

</body>
</html>
