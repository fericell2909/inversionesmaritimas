<?php $__env->startSection('title', '| Reporte de Ventas'); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                
                <h3 class="text-center text-info"><?php echo app('translator')->getFromJson('sales.title'); ?></h3>
            </div>
            <div class="panel-body">
                <div id="tablePanel">
                    <!-- Pdf generate dropdown -->
                    <div class="dropdown" id="pdfgenerate">
                        <button class="btn btn-sm btn-info  dropdown-toggle" data-toggle="dropdown">
                            <?php echo app('translator')->getFromJson('products.inventory'); ?>
                            <span class="caret">
                    </span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo e(url('/sales/pdf/0')); ?>"> Todos </a></li>
                            <li><a href="<?php echo e(url('/sales/pdf/1')); ?>"> Semana </a></li>
                            <li><a href="<?php echo e(url('/sales/pdf/2')); ?>"> Mes </a></li>
                            <li><a href="<?php echo e(url('/sales/pdf/3')); ?>"> 6 Meses </a></li>
                            <li><a href="<?php echo e(url('/sales/pdf/4')); ?>"> Año </a></li>
                            <li><a href="<?php echo e(url('/sales/pdf/5')); ?>"> Dia </a></li>
                        </ul>
                    </div> <!-- end div #pdfgenerate -->
                </div> <!-- end div #tablePanel -->
                <div class="col-md-4" id="searchDiv">
                    <div id="custom-search-input">
                        <div class="input-group ">
                            <input type="text" class="form-control input-md" id="SearchSales" name="search"
                                   placeholder="DNI O RUC"/>
                            <span class="input-group-btn">
                         <button class="btn btn-info btn-md" type="button">
                         <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                     </span>
                        </div>
                    </div>
                </div>  <!-- end div #searchDiv -->
                <!-- Table -->
                <div class="col-md-12 col-sm-12">
                    <div class="table-responsive" id="divProductTable">
                        <table class="table table-responsive results">
                            <tr>
                                <th>
                                    <?php echo app('translator')->getFromJson('sales.invoiceno'); ?>
                                </th>
                                <th>
                                    <?php echo app('translator')->getFromJson('sales.products'); ?>
                                </th>
                                <th>
                                    <?php echo app('translator')->getFromJson('sales.tprice'); ?>
                                </th>
                                <th>
                                    <?php echo app('translator')->getFromJson('sales.saledate'); ?>
                                </th>
                                <th class="text-center" >
                                    <?php echo app('translator')->getFromJson('sales.control'); ?>
                                </th>
                            </tr>
                            <tbody id="salesDivBoxAjax">
                            </tbody>
                            <tbody id="salesDivBox">
                            <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($sale->invoice_no); ?>

                                    </td>
                                    <td style="word-break: break-all;">
                                        <?php echo e($sale->name); ?>

                                    </td>
                                    <td>
                                        <small style="float: left;">
                                            <?php echo e(get_currencySymbols()); ?>

                                        </small>
                                        <?php echo e(number_format($sale->price,2)); ?>

                                    </td>
                                    <td>
                                        <?php echo e(date('d-M-Y', strtotime($sale->created_at))); ?>

                                    </td>
                                    <td>
                                        <a href="<?php echo e(url('sales/invoice') .'/' . $sale->id); ?>">
                                            <button class="btn btn-xs btn-white">
                                                <i aria-hidden="true" class="fa fa-download">
                                                </i>
                                                <?php echo app('translator')->getFromJson('button.download'); ?>
                                            </button>
                                        </a>
                                        <a href="<?php echo e(route('sales.show',$sale->id)); ?>">
                                            <button class="btn btn-xs btn-white">
                                                <i aria-hidden="true" class="fa fa-eye">
                                                </i>
                                                <?php echo app('translator')->getFromJson('button.show'); ?>
                                            </button>
                                        </a>
                                         
                                        <?php echo e(Form::open(['route' => ['sales.destroy', $sale->id], 'method' => 'DELETE' ,  'id' => 'deleteFormSale'])); ?>


                                        <?php echo e(Form::button('
                                        <i aria-hidden="true" class="fa fa-trash-o">
                                        </i>
                                        '. trans('button.delete'), ['class'=>'btn btn-xs btn-danger deleteBtnSale', 'type'=>'submit', 'data-id' => $sale->id])); ?>


                                        <?php echo e(Form::close()); ?>

                                       

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="text-left">
                            <?php echo e($sales->links()); ?>

                        </div>
                    </div> <!-- end div #divProductTable -->
                </div> <!-- end col 12-->

                <!-- Print page -->

                <?php if(session()->has('success')): ?>
                    <?php if(get_setting()->ph_print === '1' || get_setting()->ph_print === '2'): ?>
                        <?php echo $__env->make('invoice.1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php elseif(get_setting()->ph_print === '3' || get_setting()->ph_print === '4'): ?>
                        <?php echo $__env->make('invoice.2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                <?php endif; ?>

                <script>
                    /*
                     Products search
                     */

                    //Language
                    var _show = 'MOSTRAR';
                    var _edit = 'DESCARGAR';
                    var _delete = 'BORRAR';
                    $(function () {
                        $("#SearchSales").keyup(function () {
                            var _search = $(this).val();
                            if (_search === '') {
                                $('#salesDivBoxAjax').hide();
                                $('#salesDivBox').show();
                                return false;
                            }
                            $.ajax({
                                type: 'POST',
                                dataType: "json",
                                url: '/sales/search',
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'search': _search
                                },
                                success: function (data) {
                                    var $a;
                                    $.each(data, function (i, result) {
                                        if (jQuery.isEmptyObject(result.RoleOwners)) {
                                            $('#salesDivBox').hide();
                                            $('#salesDivBoxAjax').show();
                                            $a += '<tr>',
                                                $a += '<td >' + result.invoice_no + '</td >',
                                                $a += '<td >' + result.name + '</td >',
                                                $a += '<td ><small style="float: left;"> S/. </small>' + result.price + '</td >',
                                                $a += '<td >' + result.created_at + '</td >',
                                                $a += '<td >',
                                                $a += '<a href="/sales/invoice/' + result.id + '"><button class="btn btn-xs btn-white"><i class="fa fa-download" aria-hidden="true"></i>' + _edit + '</button></a>'
                                                $a += '<a href="/sales/' + result.id + '"><button class="btn btn-xs btn-white"><i class="fa fa-eye" aria-hidden="true"></i>' + _show + '</button></a>',
                                                
                                                
                                                $a += '<form method="POST" action="sales/' + result.id + '" accept-charset="UTF-8" style="display:inline-block;" id="deleteFormSale"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="' + $('input[name=_token]').val() + '">',
                                                $a += '<button class="btn btn-xs btn-danger deleteBtnSale" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i>' + _delete + '</button>',

                                                $a += '</form>',
                                                
                                                $a += '</td >'
                                        }
                                    });
                                    $('tbody#salesDivBoxAjax').html($a);
                                }
                            });
                        });


                    });
                </script>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>