<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Stock de PRODUCTOS</title>
    <body>
        
 <table cellspacing="0" style="width: 100%;border-bottom: 1px solid #000;">
        <tr>

        <?php $__currentLoopData = $empresas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empresa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td style="width: 100%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold"><?php echo e($empresas[0]->ph_name); ?></span>
                <br> <?php echo e($empresas[0]->ph_caracteristicas); ?>

                <br>RUC: <?php echo e($empresas[0]->ph_ruc); ?>

                <br><?php echo e($empresas[0]->ph_address); ?><br> 
                Teléfono: <?php echo e($empresas[0]->ph_telephone); ?><br>
                Email: <?php echo e($empresas[0]->ph_email); ?>

                
            </td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <td style="width: 0%;text-align:right">
             
            </td>
        </tr>
    </table>
    <br>
  	<p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="background: #2c3e50;color:#fff;padding: 10px;">REPORTE DE STOCK DE PRODUCTOS</span></p>
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;border:1px solid #000;">
        <tr>
            <th style="width: 10%;text-align:left;color:#fff;border-right: 1px solid #fff;background-color: #2c3e50;" class='midnight-blue'><?php echo app('translator')->getFromJson('products.bname'); ?></th>
            <th style="width: 60%;text-align:left;color:#fff;;border-right: 1px solid #fff;background-color: #2c3e50;" class='midnight-blue'><?php echo app('translator')->getFromJson('products.gname'); ?></th>
            <th style="width: 15%;text-align: left;color:#fff;background-color: #2c3e50;" class='midnight-blue'>Stock</th>
            
        </tr>
         <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                    <td  style="width: 30%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($producto->p_bname); ?></small></td>
                    <td  style="width: 30%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($producto->p_gname); ?></small></td>
                    <td  style="width: 40%; text-align: left;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($producto->p_quantity); ?></small></td>
                </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
    </table>
</body>
