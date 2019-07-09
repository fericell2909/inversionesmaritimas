<?php $__env->startSection('title', '| Reporte de Precios de Venta por Producto'); ?>
<?php $__env->startSection('estilos_adicionales'); ?>

<style type="text/css">
        table { vertical-align: top; }
        tr    { vertical-align: top; }
        td    { vertical-align: top; }
        .midnight-blue{
            background:#2c3e50;
            padding: 4px 4px 4px;
            color:white;
            font-weight:bold;
            font-size:12px;
        }
        .silver{
            background:white;
            padding: 3px 4px 3px;
        }
        .clouds{
            background:#ecf0f1;
            padding: 3px 4px 3px;
        }
        .border-top{
            border-top: solid 1px #bdc3c7;
            
        }
        .border-left{
            border-left: solid 1px #bdc3c7;
        }
        .border-right{
            border-right: solid 1px #bdc3c7;
        }
        .border-bottom{
            border-bottom: solid 1px #bdc3c7;
        }
        table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
    </style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <a href="<?php echo e(url('analysis/rptprecioventa') .'/1'); ?>">
                                            <button class="btn btn-xs btn-white">
                                                <i aria-hidden="true" class="fa fa-download">
                                                </i>
                                                Descargar Reporte
                                            </button>
                                        </a>
        <a href="<?php echo e(url('analysis/rptprecioventa') .'/2'); ?>" target="_blanck">
                                            <button class="btn btn-xs btn-white">
                                                <i aria-hidden="true" class="fa fa-print">
                                                </i>
                                                Imprimir Reporte
                                            </button>
                                        </a>

        <div class="panel panel-default">
        <div class="panel-body">
           <table cellspacing="0" style="width: 100%;border-bottom: 1px solid #000;">
        <tr>

           

        <?php $__currentLoopData = $empresas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empresa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td style="width: 60%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold"><?php echo e($empresas[0]->ph_name); ?></span>
                <br> <?php echo e($empresas[0]->ph_caracteristicas); ?>

                <br>RUC: <?php echo e($empresas[0]->ph_ruc); ?>

                <br><?php echo e($empresas[0]->ph_address); ?><br> 
                Teléfono: <?php echo e($empresas[0]->ph_telephone); ?><br>
                Email: <?php echo e($empresas[0]->ph_email); ?>

                
            </td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <td style="width: 40%;text-align:right">
             
            </td>
        </tr>
    </table>
    <br>
  	<p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="background: #2c3e50;color:#fff;padding: 10px;">REPORTE DE PRECIO DE VENTA AL PUBLICO</span></p>	
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;border:1px solid #000;">
        <tr>
            <th style="width: 10%;text-align:left;color:#fff;border-right: 1px solid #fff;" class='midnight-blue'><?php echo app('translator')->getFromJson('products.bname'); ?></th>
            <th style="width: 60%;text-align:left;color:#fff;;border-right: 1px solid #fff;" class='midnight-blue'><?php echo app('translator')->getFromJson('products.gname'); ?></th>
            <th style="width: 15%;text-align: left;color:#fff;" class='midnight-blue'>Precio Venta</th>
            
        </tr>
         <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                    <td  style="width: 30%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($producto->p_bname); ?></small></td>
                    <td  style="width: 30%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($producto->p_gname); ?></small></td>
                    <td  style="width: 40%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e(number_format($producto->p_price,2)); ?></small></td>
                </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>