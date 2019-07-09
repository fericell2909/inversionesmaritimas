<?php $__env->startSection('title', '| Productos'); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <h2 class="text-center text-info"><?php echo app('translator')->getFromJson('products.title'); ?></h2>
        <div class="panel-body">
            <!-- BEGIN OPTIONS PANEL -->
            <div id="tablePanel">
                <a href="<?php echo e(url('/product/create')); ?>">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> <?php echo app('translator')->getFromJson('products.newproduct'); ?>
                    </button>
                </a>

                <a href="<?php echo e(url('/product/notaingreso')); ?>">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> <?php echo app('translator')->getFromJson('products.newproductstock'); ?>
                    </button>
                </a>

                <div class="dropdown" id="categoryDropdown">
                    <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                            data-toggle="dropdown"><?php echo app('translator')->getFromJson('products.selectcat'); ?>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo e(url('/product')); ?>">Todos</a></li>
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(url('/product/?cat=').$cat->id); ?>"><?php echo e($cat->name); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div> <!-- end div #categoryDropdown -->

                <div class="dropdown" id="pdfgenerate">

                    <button class="btn btn-sm  btn-info dropdown-toggle" data-toggle="dropdown">
                        <?php echo app('translator')->getFromJson('products.inventory'); ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo e(url('/product/pdf/0')); ?>">Todos</a></li>
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(url('/product/pdf').'/'.$cat->id); ?>"><?php echo e($cat->name); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </div> <!-- end div #pdfgenerate -->

            </div>

            <div class="col-md-4" id="searchDiv">
                <div id="custom-search-input">
                    <div class="input-group ">
                        <input type="text" class="form-control input-md" id="SearchProducts" name="search"
                               placeholder="<?php echo app('translator')->getFromJson('products.search'); ?>"/>
                        <span class="input-group-btn">
                                      <button class="btn btn-info btn-md" type="button">
                                          <i class="fa fa-search" aria-hidden="true"></i>
                                       </button>
                                    </span>
                    </div>
                </div>  <!-- end div #custom-search-input -->
            </div> <!-- end div #searchDiv -->

            <!-- END OPTIONS PANEL -->

            <!-- BEGIN TABLE -->

            <div class="col-md-12 col-sm-12  col-xs-12">
                <div class="table-responsive" id="divProductTable">
                    <table class="table table-hover results">
                        <tr>
                            <th><?php echo app('translator')->getFromJson('products.bname'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.imagen'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.subcategory'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.price'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.quantity'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.discount'); ?></th>
                            <th><?php echo app('translator')->getFromJson('products.expire'); ?></th>
                            <th>Tiempo Faltante</th>
                            <th class="text-center" ><?php echo app('translator')->getFromJson('products.control'); ?></th>

                        </tr>
                        <tbody id="productDivBoxAjax"></tbody>

                        <tbody id="productDivBox">
                        <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;">
                                    <?php echo e($pro->p_bname); ?></td>
                                <td style="vertical-align: middle;text-align: center;"><img src="<?php echo e(asset('upload').'/'.$pro->p_image); ?>" width="150"></td>
                                <td style="vertical-align: middle;text-align: center;"><?php echo e($pro->name); ?></td>
                                <td style="vertical-align: middle;text-align: center;">
                                    <small style="float: left;"> <?php echo e(get_currencySymbols()); ?> </small><?php echo e($pro->p_price); ?>

                                </td>
                                <td id="quantityProduct" style="vertical-align: middle;text-align: center;"> 
                                    <?php if(preg_replace('/[^0-9]/','',$pro->p_quantity  ) < 21 ): ?>
                                        <span class="label label-danger" data-toggle="tooltip"
                                              title="Le queda poco de este producto, todo lo que tiene <?php echo e($pro->p_quantity); ?>"> SOLO HAY :  <?php echo e($pro->p_quantity); ?> </span>
                                    <?php else: ?>
                                       
                                        <?php echo e($pro->p_quantity); ?>

                                    <?php endif; ?></td>
                                <td style="vertical-align: middle;text-align: center;"><?php echo e($pro->p_discount); ?>%</td>
                                <td style="vertical-align: middle;text-align: center;">
                                    
                                    <?php if(strtotime($pro->p_exdate) < strtotime(Carbon\Carbon::now()->addDay(-1))): ?>
                                        <span class="label label-danger" data-toggle="tooltip" title="El producto Vencio en : 
                                    <?php echo e(date('d-M-Y', strtotime($pro->p_exdate))); ?>"> Producto Vencido </span>
                                    <?php else: ?>
                                        <?php echo e(date('d-M-Y', strtotime($pro->p_exdate))); ?>

                                    <?php endif; ?>
                                </td>
                                <td style="vertical-align: middle;text-align: center;">
                                    <?php if(NumerodiferenciaDias($pro->p_exdate) <= 90): ?>
                                            <span class="label label-danger" data-toggle="tooltip" title="El producto Vence el : 
                                    <?php echo e(date('d-M-Y', strtotime($pro->p_exdate))); ?>">  <?php echo e(diferenciaDias($pro->p_exdate)); ?>  </span>
                                    <?php else: ?>
                                            <span class="label label-success" data-toggle="tooltip" title="El producto Vence el : 
                                    <?php echo e(date('d-M-Y', strtotime($pro->p_exdate))); ?>">  <?php echo e(diferenciaDias($pro->p_exdate)); ?>  </span>
                                    <?php endif; ?>
                                    
                                       
                                </td>
                                <td style="vertical-align: middle;text-align: center;">
                                    <a href="<?php echo e(route('product.show', $pro->p_id)); ?>">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-eye"
                                                                                aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.show'); ?>
                                        </button>
                                    </a>
                                    <a href="<?php echo e(route('product.edit', $pro->p_id)); ?>">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.edit'); ?>
                                        </button>
                                    </a>

                                    
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table> <!-- end tbody #productDivBox -->
                    <div class="text-left ">
                        <ul class="pagination-primary">
                            <?php echo e($product->links()); ?>

                        </ul> <!-- end div .pagination-primary -->
                    </div>
                </div> <!-- end div #divProductTable -->
            </div>  <!-- end col 12 -->
            <!-- END TABLE -->
        </div>  <!-- end div .panel-body-->
    </div>  <!-- end div .panel-->

    <script>

        /*
         Products search
         */


        //Language
        var _show = '<?php echo app('translator')->getFromJson('button.show'); ?>';
        var _edit = '<?php echo app('translator')->getFromJson('button.edit'); ?>';
        var _delete = '<?php echo app('translator')->getFromJson('button.delete'); ?>';
        $(function () {
            $("#SearchProducts").keyup(function () {
                var _search = $(this).val();
                if (_search === '') {
                    $('#productDivBoxAjax').hide();
                    $('#productDivBox').show();
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: './product/search',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'search': _search
                    },
                    success: function (data) {
                        var $a;
                        $.each(data, function (i, result) {
                            $('#productDivBox').hide();
                            $('#productDivBoxAjax').show();
                            $a += '<tr>',
                                $a += '<td >' + result.p_id + '</td >',
                                $a += '<td style="width: 130px;" >' + (result.p_icon !== '' ? '<img src="../img/' + result.p_icon + '.png" width="20"> ' : '') + result.p_bname + '</td >',
                                $a += '<td >' + result.p_gname + '</td >',
                                $a += '<td >' + result.name + '</td >',
                                $a += '<td style="width: 100px;" ><small style="float: left;"> <?php echo e(get_currencySymbols()); ?> </small>' + result.p_price + '</td >'
                            if (result.p_quantity < 21) {
                                $a += '<td ><span class="label label-danger" data-toggle="tooltip" title="Le queda poco de este producto, todo lo que tiene' + result.p_quantity + '"> SOLO HAY ' + result.p_quantity + '</span></td>';
                            } else {
                                $a += '<td >' + result.p_quantity + '</td>';
                            }
                            $a += '<td >' + result.p_discount + '%</td >'
                            if (new Date(result.p_exdate) <  sumarDias(new Date(),-1)) {
                                $a += '<td ><span class="label label-danger" data-toggle="tooltip" title="El producto Vencio en :  ' + dateFormat(result.p_exdate)     + '"> Producto Vencido </span></td >'

                            } else {
                                $a += '<td >' + dateFormat(result.p_exdate) + '</td >';
                            }
                                
                                if(result.dias <= 90)
                                 { 
                                        $a +=  '<td><span class="label label-danger" data-toggle="tooltip" title="El producto Vence el : ' + result.p_exdate +'">'  + result.dias + ' dias'  +'</span></td>';
                                 } else{
                                 
                                        $a += '<td><span class="label label-success" data-toggle="tooltip" title="El producto Vence el : ' + result.p_exdate +'">'  + result.dias + ' dias'  +'</span></td>';
                                }

                            $a += '<td style="display: inline-flex;" >',
                                $a += '<a href="/product/' + result.p_id + '"><button class="btn btn-xs btn-white"><i class="fa fa-eye" aria-hidden="true"></i>' + _show + '</button></a>',
                                $a += '<a href="/product/' + result.p_id + '/edit"><button class="btn btn-xs btn-white"><i class="fa fa-pencil" aria-hidden="true"></i>' + _edit + '</button></a>',
                                $a += '<form method="POST" action="product/' + result.p_id + '" accept-charset="UTF-8" style="display:inline-block;" id="deleteForm"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="' + $('input[name=_token]').val() + '">',
                                // $a += '<button class="btn btn-xs btn-danger deleteBtn" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i>' + _delete + '</button>',
                                $a += '</form>',
                                $a += '</td ></tr>'
                        });
                        $('tbody#productDivBoxAjax').html($a);
                    }
                });
            });

            function sumarDias(fecha, dias){
              fecha.setDate(fecha.getDate() + dias);
              return fecha;
            }
            function jsNumerodiferenciaDias(f1,f2)
             {
             var aFecha1 = f1;
             var aFecha2 = f2; 
             var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-5,aFecha1[0]); 
             var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-5,aFecha2[0]); 
             var dif = fFecha2 - fFecha1;
             var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
             alert(dias);
             return dias;
             }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>