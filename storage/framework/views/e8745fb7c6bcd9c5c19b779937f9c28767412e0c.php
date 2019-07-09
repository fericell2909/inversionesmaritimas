<?php $__env->startSection('title', '| Reportes de Movimiento de Productos'); ?>
<?php $__env->startSection('content'); ?>

       <div class="panel panel-default">
        
        <div class="panel-body">
            <div class="col-md-12" id="analysis">
            	
            	<h4 class="text-info text-center">Reporte de Movimientos de Productos</h4>

				<div class="row">

					 <?php echo e(Form::open(['route' => 'reportes.GenerarReporteReporteMovimientoAlmacen' , 'id' => 'ReporteForm'])); ?>

						<div class="col-xs-13 col-sm-12 col-md-2">
							<div class="form-group row">
								<label for="anio_id" class="">Año</label>
	                        	<input type="text" id="anio_id" name="anio_id" value="" class="form-control numeros text-center" maxlength="4">
	                        	<span  id="Mensaje-Validacion-Anio"style="display:none;color:red;">Debe Ingresar un Año válido</span>
							</div>
						</div>
						<div class="col-xs-13 col-sm-12 col-md-2">
							<div class="form-group row">
								<label for="mes_id" class="">Mes</label>
			                    <select class="form-control text-center" name="mes_id" id="mes_id">
			                            <?php $__currentLoopData = $meses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                            	<option value="<?php echo e($mes->id); ?>" ><?php echo e($mes->nombre_mes); ?></option>
			                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			                    </select>
			            	</div>     
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
							<div class="form-group row">
								<label for="producto_id" class="">Producto</label>
								<select class="form-control text-center" name="producto_id" id="producto_id">
		                            <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                            	<option value="<?php echo e($producto->p_id); ?>" ><?php echo e($producto->p_gname); ?></option>
		                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                        </select>
							</div>	
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3">
							<div class="form-group row">
								<label for="producto_id" class="">Opción</label>
								<select class="form-control text-center" name="tipo_reporte_id" id="tipo_reporte_id">
		                            <option selected value="1" style="text-align: center;">Descargar</option>
									<option value="2" style="text-align: center;">Imprimir</option>                            
		                        </select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-2 text-center">
	                            <button type="submit" style="margin-top: 60px;" id="btn-mov-rpt-almacen" class="btn btn-sm btn-info" data-id=""><i class="fa fa-list"
	                                aria-hidden="true"></i>&nbsp; GENERAR REPORTE
	                            </button>
						</div>
					<?php echo e(Form::close()); ?>

				</div>


            </div> <!-- end div #analysis -->
            
        </div>
         <!-- end div .panel-body -->
    </div> <!-- end div .panel -->
	
	<script>
		$(function () {
			
			$(".numeros").keydown(function(event) {
			   if(event.shiftKey)
			   {
			        event.preventDefault();
			   }

			   if (event.keyCode == 46 || event.keyCode == 8)    {
			   }
			   else {
			        if (event.keyCode < 95) {
			          if (event.keyCode < 48 || event.keyCode > 57) {
			                event.preventDefault();
			          }
			        } 
			        else {
			              if (event.keyCode < 96 || event.keyCode > 105) {
			                  event.preventDefault();
			              }
			        }
			      }
			});

			$('#btn-mov-rpt-almacen').click(function(event){
				let _anio = $('#anio_id').val();
				if (_anio == null || _anio.length <= 0 || _anio < 2017 ) {
					$('#Mensaje-Validacion-Anio').toggle();
					event.preventDefault();
				}
				_anio = null;
			});

			$("#anio_id").on('keypress',function(event) {
				$("#Mensaje-Validacion-Anio").hide();
			});
		});
	</script>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>