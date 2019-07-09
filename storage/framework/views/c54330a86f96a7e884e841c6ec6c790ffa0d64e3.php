<?php $__env->startSection('title', '| Crear Nuevo Medicamento'); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center text-info"><?php echo app('translator')->getFromJson('products.newtitle'); ?></h3>
        </div>

        <div class="panel-body">
            <?php echo e(Form::open (['route' => 'product.store' ,'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'] )); ?>

            <div class="col-md-6 col-xs-12">
                <div class="form-group">
                    <?php echo e(Form::label('name' , trans('products.gname'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('gname', null, ['class'=>'form-control', 'placeholder' => trans('products.gname')])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('bname',trans('products.bname'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('bname', null,['class' => 'form-control', 'placeholder' => trans('products.bname')])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('description',trans('products.desc'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::textarea('desc',null,['class' => 'form-control' ,'id' => 'textarea', 'placeholder' => trans('products.desc'), 'Description'])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('country' , trans('products.country'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('country',null, ['class'=>'form-control', 'placeholder' => trans('products.country')])); ?>

                    </div>
                </div>
                <div class="form-group" style="display:none;">
                    <?php echo e(Form::label('idnumber',trans('products.idp'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('idnumber',null,['class' => 'form-control', 'placeholder' => trans('products.idp')])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('imdate',trans('products.imdate'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('imdate', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'datepicker form-control', 'data-date-format' => 'yyyy-mm-dd'])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('exdate',trans('products.exdate'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('exdate', \Carbon\Carbon::now()->format("Y-n-j"), ['class' => 'datepicker form-control' , 'data-date-format' => 'yyyy-mm-dd'])); ?>

                    </div>
                </div>
                <div class="form-group" style="display:none;">
                    <?php echo e(Form::label('statue',trans('products.seffect'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::textarea('statue', null, ['class' => 'form-control' ,'id' => 'textarea',  'placeholder' => trans('products.seffect')])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-info" type="submit">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> <?php echo app('translator')->getFromJson('button.create'); ?>
                        </button>
                    </div>
                </div>
            </div>   <!-- end col 6 -->
            <div class="col-md-6 col-xs-12">
                <div class="form-group">
                    <?php echo e(Form::label('Category',trans('products.subcategory'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::select('category',$category, null,  ['class' => 'form-control'])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('quantity',trans('products.quantity'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => trans('products.quantity')])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('money',trans('products.salePrice'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('money', null, ['class' => 'form-control', 'placeholder' => trans('products.salePrice')])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('imname',trans('products.provName'), ['class' => 'control-label col-sm-2'])); ?>

                    
                    <div class="col-sm-10">
                        <select class="form form-control" name="imname" id="imname">
                        <?php $__currentLoopData = $provider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($prov->name); ?>"><?php echo e($prov->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('immoney',trans('products.orgPrice'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('immoney', null, ['class' => 'form-control', 'placeholder' =>  trans('products.orgPrice')])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('Discount',trans('products.discount'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('discount', null, ['class' => 'form-control', 'placeholder' =>  trans('products.discount')])); ?>

                    </div>
                </div>
                <div class="form-group" style="display:none;">
                    <?php echo e(Form::label('icontype',trans('products.dtype'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <div class="dropdown" id="productIcon">
                            <button class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                                Seleccionar
                                <span class="caret">
                            </span>
                            </button>
                            <input id="producIconSelect" name="icon" type="hidden"/>
                            <ul class="dropdown-menu">
                                <li>
                                    <a data-type="pills">
                                        <img src="<?php echo e(asset('img/pills.png')); ?>" width="30">
                                        <?php echo app('translator')->getFromJson('products.pill'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a data-type="syrup">
                                        <img src="<?php echo e(asset('img/syrup.png')); ?>" width="30">
                                        <?php echo app('translator')->getFromJson('products.syrup'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a data-type="syringe">
                                        <img src="<?php echo e(asset('img/syringe.png')); ?>" width="30">
                                        <?php echo app('translator')->getFromJson('products.syringe'); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>     <!-- end div #productIcon !-->
                    </div>
                </div>
                <div class="form-group" style="display:none;">
                    <?php echo e(Form::label('barcodeg',trans('products.barcode'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <?php echo e(Form::text('barcodeg', null, ['class' => 'form-control', 'placeholder' =>  trans('products.barcode')])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('barcode',trans('products.img'), ['class' => 'control-label col-sm-2'])); ?>

                    <div class="col-sm-10">
                        <!-- image-preview-filename input [CUT FROM HERE]-->
                        <div class="input-group image-preview">
                            <input class="form-control image-preview-filename" disabled="disabled" type="text">
                            <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button class="btn btn-default image-preview-clear" style="display:none;" type="button">
                                    <span class="glyphicon glyphicon-remove">
                                    </span>
                                    <?php echo app('translator')->getFromJson('products.clear'); ?>
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open">
                                    </span>
                                    <span class="image-preview-input-title">
                                    <?php echo app('translator')->getFromJson('products.browser'); ?>
                                    </span>
                                    <input accept="image/png, image/jpeg, image/gif" name="file" type="file"/>
                                    <!-- rename  it -->
                                </div>
                            </span>
                        </div>
                        <!-- /input-group image-preview [TO HERE]-->
                    </div>
                </div>
            </div>   <!-- end col 6 -->
        <?php echo e(Form::close()); ?>   <!-- end form !-->
        </div>   <!-- end div .panel-body-->
    </div>  <!-- end div .panel-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>