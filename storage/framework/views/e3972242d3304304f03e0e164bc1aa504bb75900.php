<?php $__env->startSection('title', '| Reportes de Ventas Por Usuario'); ?>
<?php $__env->startSection('content'); ?>

       <div class="panel panel-default">
        
        <div class="panel-body">
            <div class="col-md-12" id="analysis">
            	
            	<h4 class="text-info text-center">Reporte de Ventas por Usuario</h4>

				<div class="row">

					 <?php echo e(Form::open(['route' => 'reportes.GenerarReporteVentasUsuario' , 'id' => 'ReporteForm'])); ?>

						<div class="col-xs-12 col-sm-12 col-md-3">
	                        <?php echo e(Form::text('fechaventadocumento', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'text-center datepicker form-control', 'data-date-format' => 'yyyy-mm-dd'])); ?>

						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
							<select class="form-control text-center" name="usuario_id" id="usuario_id">
	                            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            	<option value="<?php echo e($usuario->id); ?>" ><?php echo e($usuario->email); ?></option>
	                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                        </select>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
							<select class="form-control text-center" name="tipo_reporte_id" id="tipo_reporte_id">
	                            <option selected value="1" style="text-align: center;">Descargar</option>
								<option value="2" style="text-align: center;">Imprimir</option>                            
	                        </select>

						</div>
						<div class="col-xs-12 col-sm-12 col-md-3 text-center">
	                            <button type="submit" style="margin-top: 32px;" class="btn btn-sm btn-info" data-id=""><i class="fa fa-list"
	                                aria-hidden="true"></i>&nbsp; GENERAR REPORTE
	                            </button>
						</div>
					<?php echo e(Form::close()); ?>

				</div>


            </div> <!-- end div #analysis -->
            
        </div>
         <!-- end div .panel-body -->
    </div> <!-- end div .panel -->
	

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>