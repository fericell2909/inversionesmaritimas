<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Venta de Productos por Usuario</title>
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
  	<p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="background: #2c3e50;color:#fff;padding: 10px;">REPORTE DE VENTA DE PRODUCTOS POR USUARIO</span></p>
    <br>    
    <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
        <p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="color:#000;padding: 10px;">Usuario : <?php echo e($usuario->name); ?></span></p>
        <br>
        <p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="color:#000;padding: 10px;">Email : <?php echo e($usuario->email); ?></span></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;border:1px solid #000;">
        <tr>
            <th style="width: 10%;text-align:center;color:#fff;border-right: 1px solid #fff;background-color: #2c3e50;" class='midnight-blue'>Fecha de Documento</th>
            <th style="width: 60%;text-align:center;color:#fff;;border-right: 1px solid #fff;background-color: #2c3e50;" class='midnight-blue'>Rango de Hora</th>
            <th style="width: 15%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'>Cantidad Vendida</th>
            <th style="width: 15%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'>Total Vendido</th>
            
        </tr>
        
        <?php if(count($ventas) > 0): ?>
            <?php $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                        <td  style="width: 30%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($venta->FechaVenta); ?></small></td>
                        <td  style="width: 30%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($venta->FechaVentaHora); ?></small></td>
                        <td  style="width: 20%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($venta->cantidad); ?></small></td>
                         <td  style="width: 20%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e(number_format($venta->total,2)); ?></small></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            <tr>
                <td colspan="2" style="text-align: right;border-left: 1px solid #fff;border-bottom: 1px solid #fff; border-right: 1px solid #fff;">Total de Productos Vendidos en el día : </td>
                <td style="text-align: center;border-bottom: 1px solid #fff; border-right: 1px solid #fff;"><?php echo e($cantidadvendida); ?></td>
                <td style="text-align: center;border-bottom: 1px solid #fff; border-right: 1px solid #fff;"><?php echo e(number_format($cantidadtotalvendida,2)); ?></td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="3"  style="text-align: center;""> El Usuario : <?php echo e($usuarios[0]->name); ?> con correo : <?php echo e($usuarios[0]->email); ?> no ha registrado venta de productos en el dia : <?php echo e($fechaventadocumento); ?> </td>
            </tr>
        <?php endif; ?>

    </table>
</body>
