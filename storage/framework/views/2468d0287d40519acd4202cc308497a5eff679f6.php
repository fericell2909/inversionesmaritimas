<?php $__env->startSection('title', '| Listado de Pacientes'); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <h2 class="text-center text-info"><?php echo app('translator')->getFromJson('customers.title'); ?></h2>
        <div class="panel-body">
            <div id="tablePanel">
                <a href="<?php echo e(url('/customers/create')); ?>" style="display:none;">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> <?php echo app('translator')->getFromJson('customers.newcustomers'); ?>
                    </button>
                </a>
                 <a href="<?php echo e(url('/Cliente/CrearCliente')); ?>">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> <?php echo app('translator')->getFromJson('customers.crearcliente'); ?>
                    </button>
                </a>
                <div class="dropdown" id="pdfgenerate" style ="display:none;">

                    <button class="btn btn-sm  btn-info dropdown-toggle" data-toggle="dropdown">
                        <?php echo app('translator')->getFromJson('products.inventory'); ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" >
                        <li><a href="<?php echo e(url('/customers/pdf/0')); ?>">Todos</a></li>
                        <li><a href="<?php echo e(url('/customers/pdf/1')); ?>">Semana</a></li>
                        <li><a href="<?php echo e(url('/customers/pdf/2')); ?>">Mes</a></li>
                        <li><a href="<?php echo e(url('/customers/pdf/3')); ?>">6 Meses</a></li>
                        <li><a href="<?php echo e(url('/customers/pdf/4')); ?>">Año</a></li>

                    </ul>
                </div>  <!-- end div #pdfgenerate -->
            </div> <!-- end div #tablePanel -->

            <div class="col-md-4" id="searchDiv">
                <div id="custom-search-input">
                    <div class="input-group ">
                        <input type="text" class="form-control input-md" id="Searchcustomers" name="search"
                               placeholder="<?php echo app('translator')->getFromJson('customers.search'); ?>"/>
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
                            <th><?php echo app('translator')->getFromJson('customers.name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('customers.dni'); ?></th>
                            <th><?php echo app('translator')->getFromJson('customers.estado'); ?></th>
                            <th><?php echo app('translator')->getFromJson('customers.date'); ?></th>
                            <th class="text-center" ><?php echo app('translator')->getFromJson('customers.control'); ?></th>

                        </tr>
                        <tbody id="cuctomersDivBoxAjax"></tbody> <!-- end tbody  cuctomersDivBoxAjax -->

                        <tbody id="cuctomersDivBox">
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($cust->id); ?></td>
                                <td><?php echo e($cust->name); ?></td>
                                <td><?php echo e($cust->dni); ?></td>
                                <td>
                                <?php if($cust->estado_id == 1): ?>
                                    <span class="label label-info">Activo</span>
                                <?php else: ?>
                                    <span class="label label-danger">Inactivo</span>
                                <?php endif; ?>
                                </td>
                                <td><?php echo e(date('d-M-y-g:i ', strtotime($cust->created_at))); ?></td>

                                <td>
                                    <a href="<?php echo e(route('customers.show', $cust->number)); ?>">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-eye"
                                                                                aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.show'); ?>
                                        </button>
                                    </a>
                                    <a href="<?php echo e(route('customers.edit', $cust->id)); ?>">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.edit'); ?>
                                        </button>
                                    </a>

                                    
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody> <!-- end tbody #cuctomersDivBox -->
                    </table>
                    <div class="text-left ">
                        <ul class="pagination-primary">
                            <?php echo e($customers->links()); ?>

                        </ul>
                    </div>
                </div> <!-- end col 12 -->
            </div>  <!-- end div # ivCuctomersTable-->
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->

    <script>

        /*
         customers search
         */

        // Language translate
        var _show = '<?php echo app('translator')->getFromJson('button.show'); ?>';
        var _edit = '<?php echo app('translator')->getFromJson('button.edit'); ?>';
        var _delete = '<?php echo app('translator')->getFromJson('button.delete'); ?>';
        $(function () {
            $("#Searchcustomers").keyup(function () {
                var _search = $(this).val();
                if (_search === '') {
                    $('#cuctomersDivBoxAjax').hide();
                    $('#cuctomersDivBox').show();
                    return false;
                }



                //send ajax request
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: '/customers/search',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'search': _search
                    },
                    success: function (data) {
                        var $a;
                        $.each(data, function (i, result) {
                            //append the response
                            if (jQuery.isEmptyObject(result.RoleOwners)) {
                                $('#cuctomersDivBox').hide();
                                $('#cuctomersDivBoxAjax').show();

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
                                    $a += '<td >' + result.name + '</td >',
                                    $a += '<td >' + result.dni + '</td >',
                                    $a += '<td >' + $b + nombre_estado + '</span>'+'</td >',
                                    $a += '<td >' + result.created_at + '</td >',
                                    $a += '<td >',
                                    $a += '<a href="/customers/' + result.number + '"><button class="btn btn-xs btn-white"><i class="fa fa-eye" aria-hidden="true"></i>' + _show + '</button></a>',
                                    $a += '<a href="/customers/' + result.id + '/edit"><button class="btn btn-xs btn-white"><i class="fa fa-pencil" aria-hidden="true"></i>' + _edit + '</button></a>',
                                    $a += '</form>',
                                    $a += '</td >'
                            }
                        });
                        $('tbody#cuctomersDivBoxAjax').html($a);
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>