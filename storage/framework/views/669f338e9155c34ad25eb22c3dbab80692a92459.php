<?php $__env->startSection('title', '| Listado de Pacientes '); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <h2 class="text-center text-info"><i class="fa fa-wheelchair" aria-hidden="true"></i> <?php echo app('translator')->getFromJson('pacientes.title'); ?> <i class="fa fa-wheelchair" aria-hidden="true"></i></h2>
        <div class="panel-body">
            <div id="tablePanel">
                 <a href="<?php echo e(route('RegistrarPacientes')); ?>">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> <?php echo app('translator')->getFromJson('pacientes.newpacientes'); ?>
                    </button>
                </a>
                <a href="<?php echo e(route('RegistrarHistoriaClinica')); ?>">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> <?php echo app('translator')->getFromJson('historias.newhistoria'); ?>
                    </button>
                </a>                
            </div> <!-- end div #tablePanel -->

            <div class="col-md-4" id="searchDiv">
                <div id="pacientes-search-input">
                    <div class="input-group ">
                        <input type="text" class="form-control input-md" id="Searchpacientes" name="search"
                               placeholder="<?php echo app('translator')->getFromJson('pacientes.search'); ?>"/>
                        <span class="input-group-btn">
                              <button class="btn btn-info btn-md" type="button">
                                <i class="fa fa-search" aria-hidden="true"></i>
                               </button>
                            </span>
                    </div>
                </div>
            </div>  <!-- end div #searchDiv -->


            <div class="col-md-12 col-sm-12">
                <div class="table-responsive" id="divCuctomersTable">
                    <table class="table table-hover results">
                        <tr>
                            <th>#</th>
                            <th>Paciente</th>
                            <th><?php echo app('translator')->getFromJson('pacientes.sexo'); ?></th>
                            <th><?php echo app('translator')->getFromJson('pacientes.dni'); ?></th>
                            <th><?php echo app('translator')->getFromJson('pacientes.gruposanguineo'); ?></th>
                            <th><?php echo app('translator')->getFromJson('pacientes.fechanacimiento'); ?></th>
                            <th><?php echo app('translator')->getFromJson('pacientes.estado'); ?></th>
                            <th class="text-center" ><?php echo app('translator')->getFromJson('pacientes.control'); ?></th>

                        </tr>
                        <tbody id="pacientesDivBoxAjax"></tbody> 

                        <tbody id="pacientesDivBox">
                        <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paciente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($paciente->id); ?></td>
                                <td><?php echo e($paciente->apellido_paterno . ' ' . $paciente->apellido_materno . ' ' . $paciente->nombres); ?></td>
                                <td><?php echo e($paciente->sexo); ?></td>
                                <td><?php echo e($paciente->dni); ?></td>
                                <td><?php echo e($paciente->gruposanguineo); ?></td>
                               
                                <td><?php echo e($paciente->fecha_nacimiento); ?></td>
                                <td>
                                    <?php if($paciente->estado_id == 1): ?>
                                        <span class="label label-info">Activo</span>
                                    <?php else: ?>
                                        <span class="label label-danger">Inactivo</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('Pacientes.edit', $paciente->id)); ?>">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.edit'); ?>
                                        </button>
                                    </a>
                                    <a href="<?php echo e(route('Pacientes.ImprimirFicha', $paciente->id)); ?>">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-print"
                                                                                aria-hidden="true"></i> Imprimir Ficha
                                        </button>
                                    </a>
                                </td>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody> <!-- end tbody #cuctomersDivBox -->
                    </table>
                    
                </div> <!-- end col 12 -->
            </div>  <!-- end div # ivCuctomersTable-->
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->

    <script>

        var _edit = '<?php echo app('translator')->getFromJson('button.edit'); ?>';
        var _imprimir_ficha = "Imprimir Ficha"
        $(function () {
            $("#Searchpacientes").keyup(function () {
                var _search = $(this).val();
                if (_search === '') {
                    $('#pacientesDivBoxAjax').hide();
                    $('#pacientesDivBox').show();
                    return false;
                }

                //send ajax request
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: '../Pacientes/search',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'search': _search
                    },
                    success: function (data) {
                        var $a;
                        $.each(data, function (i, result) {
                            //append the response
                            if (jQuery.isEmptyObject(result.RoleOwners)) {
                                $('#pacientesDivBox').hide();
                                $('#pacientesDivBoxAjax').show();

                                if (result.estado_id == 1) 
                                {
                                    nombre_estado = 'ACTIVO';
                                    $b = '<span class="label label-info">';
                                } else
                                {
                                    $b = '<span class="label label-danger">';
                                    nombre_estado = 'INACTIVO';
                                }

                                $a += '<tr>',
                                    $a += '<td >' + result.id + '</td >',
                                    $a += '<td >' + result.apellido_paterno + ' ' + result.apellido_materno + ' ' + result.nombres + '</td >',
                                    $a += '<td >' + result.sexo + '</td >',
                                    $a += '<td >' + result.dni + '</td >',
                                    $a += '<td >' + result.gruposanguineo + '</td >',
                                    $a += '<td >' + result.fecha_nacimiento + '</td >',
                                    $a += '<td >' + $b + nombre_estado + '</span>'+'</td >',
                                    $a += '<td >' + '<a href="../Pacientes/Editar/' + result.id + '""><button class="btn btn-xs btn-white"><i class="fa fa-pencil" aria-hidden="true"></i>' + _edit + '</button></a><a href="../Pacientes/Editar/' + result.id + '""><button class="btn btn-xs btn-white"><i class="fa fa-print" aria-hidden="true"></i>' + _imprimir_ficha + '</button></a>',
                                    $a += '</td></tr>'
                            }
                        });
                        $('tbody#pacientesDivBoxAjax').html($a);
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>