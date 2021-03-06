<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Movimientos de Almacen</title>
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
  	<p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="background: #2c3e50;color:#fff;padding: 10px;">REPORTE DE MOVIMIENTOS DE ALMACEN</span></p>	
    <br>    
    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
        <p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="color:#000;padding: 10px;"> Nombre Generico: <?php echo e($producto->p_gname); ?></span></p>
        <br>
        <p style="font-size:14px;font-weight:bold;text-align:center;display: block; margin-left: auto;margin-right: auto;"><span style="color:#000;padding: 10px;"> Nombre Comercial : <?php echo e($producto->p_bname); ?></span></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;border:1px solid #000;">
        <tr>
            <th style="width: 10%;text-align:center;color:#fff;border-right: 1px solid #fff;background-color: #2c3e50;" class='midnight-blue'>Fecha de Operacion</th>
            <th style="width: 10%;text-align:center;color:#fff;;border-right: 1px solid #fff;background-color: #2c3e50;" class='midnight-blue'>Tipo Movimiento</th>
            <th style="width: 10%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'>Descripcion</th>
            <th style="width: 10%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'>Correo Usuario</th>
            <th style="width: 10%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'> Ingreso</th>
            <th style="width: 10%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'> Salida</th>
            <th style="width: 10%;text-align: center;color:#fff;background-color: #2c3e50;" class='midnight-blue'> Saldo</th>
            
        </tr>
        
        <?php if(count($movimientos) > 0): ?>
            <?php $__currentLoopData = $movimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td  style="width: 10%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($movimiento->FechaOperacion); ?></small></td>
                    <td  style="width: 10%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($movimiento->SubTipoOperacion); ?></small></td>
                    <td  style="width: 10%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($movimiento->DescripcionOperacion); ?></small></td>
                    <td  style="width: 10%; text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php echo e($movimiento->CorreoUSuarioOperacion); ?></small></td>
                    
                    <td  style="text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">
                    <?php if($movimiento->nIngreso > 0): ?>
                        <?php echo e($movimiento->nIngreso); ?>

                    <?php else: ?>
                        
                    <?php endif; ?>
                    </small></td>

                    <td  style="text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;"><?php if($movimiento->nSalida > 0): ?>
                        <?php echo e($movimiento->nSalida); ?>

                    <?php else: ?>
                        
                    <?php endif; ?>
                    </small></td>

                    <td  style="text-align: center;border-bottom: 1px solid #000; border-right: 1px solid #000;"><small style="padding: 5px;">
                    <?php if($movimiento->nSaldo > 0): ?>
                        <?php echo e($movimiento->nSaldo); ?>

                    <?php else: ?>
                        
                    <?php endif; ?>
                    </small></td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
        <?php else: ?>
            <tr>
                <td colspan="3"  style="text-align: center;""> No se han registrado movimientos para el periodo seleccionado. </td>
            </tr>
        <?php endif; ?>

    </table>
</body>
