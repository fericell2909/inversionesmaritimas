<?php if(Auth::user()): ?>
    <div class="container-fluid">
        <div class="col-md-1 col-sm-1 hidden-xs" id="sideNavbar">
            <?php if(Auth::user()->hasAnyRole(['admin','superadmin'])): ?>
                <div class="navbar navbar-inverse navbar-fixed-left">

                    <ul class="nav navbar-nav"  style ="margin-top: 5px;">
                        <li class="<?php echo e(set_active(['/', '/*'])); ?>"><a href="<?php echo e(url('/')); ?>" title=" <?php echo app('translator')->getFromJson('navbar.dashboard'); ?>"
                                                                     data-toggle="tooltip"><i
                                        class="fa fa-tachometer fa fa-2x " aria-hidden="true"></i></a></li>
                        <li class="dropdown" title=" <?php echo app('translator')->getFromJson('navbar.products'); ?>" data-toggle="tooltip">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-medkit fa fa-2x">
                                </i><span class="caret"></span></a>
                            <?php if(outStockCount() + expiredCount() !== 0): ?>
                                <div class="col-md-1 col-md-offset-9 col-sm-offset-9" id="notif-circle-product">
                                    <span><p><?php echo e(outStockCount() + expiredCount()); ?></p></span>
                                </div>
                            <?php endif; ?>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo e(url('product')); ?>"><i class="fa fa-pencil fa fa-2x" aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.manage'); ?> </p></a></li>
                                <li><a href="<?php echo e(url('/product/outstock')); ?>"><i class="fa fa-archive fa fa-2x"
                                                                                aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.outstock'); ?></p>
                                        <span id="notif-circle"><p><?php echo e(outStockCount()); ?></p></span></a></li>
                                <li><a href="<?php echo e(url('/product/expired')); ?>"><i class="fa fa-exclamation-circle fa-2x"
                                                                               aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.expired'); ?></p><span
                                                id="notif-circle"><p><?php echo e(expiredCount()); ?></p></span></a></li>
                                </a></li>
                            </ul>
                        </li>
                        <li class="<?php echo e(set_active(['sales', 'sales/*'])); ?>"><a href="<?php echo e(url('/sales/create')); ?>"
                                                                              title="<?php echo app('translator')->getFromJson('navbar.sell'); ?>"
                                                                              data-toggle="tooltip"><i
                                        class="fa fa-money fa fa-2x" aria-hidden="true"></i></a></li>
                        <li class="<?php echo e(set_active(['sales', 'sales/*'])); ?>"><a href="<?php echo e(url('/sales')); ?>"
                                                                              title="<?php echo app('translator')->getFromJson('navbar.sales'); ?>"
                                                                              data-toggle="tooltip"><i
                                        class="fa fa-cart-plus fa fa-2x" aria-hidden="true"></i></a></li>
                        <li class="<?php echo e(set_active(['category', 'category/*'])); ?>"><a href="<?php echo e(url('/category')); ?>"
                                                                                    title="<?php echo app('translator')->getFromJson('navbar.category'); ?>"
                                                                                    data-toggle="tooltip"><i
                                        class="fa fa-list fa fa-2x" aria-hidden="true"></i></a></li>
                        <li class="<?php echo e(set_active(['suppliers', 'suppliers/*'])); ?>"><a href="<?php echo e(url('/suppliers')); ?>"
                                                                                      title="<?php echo app('translator')->getFromJson('navbar.provider'); ?>"
                                                                                      data-toggle="tooltip"><i
                                        class="fa fa-truck fa fa-2x" aria-hidden="true"></i></a></li>
                        <li class="<?php echo e(set_active(['customers', 'customers/*'])); ?>"><a href="<?php echo e(url('/customers')); ?>"
                                                                                      title="<?php echo app('translator')->getFromJson('navbar.customers'); ?>"
                                                                                      data-toggle="tooltip"><i
                                        class="fa fa-users fa fa-2x" aria-hidden="true"></i></a></li>
                        <li class="<?php echo e(set_active(['analysis', 'analysis/*'])); ?>"><a href="<?php echo e(url('/analysis')); ?>"
                                                                                    title=" <?php echo app('translator')->getFromJson('navbar.analysis'); ?>"
                                                                                    data-toggle="tooltip"><i
                                        class="fa fa-line-chart fa-2x" aria-hidden="true"></i></a></li>
                        <li class="<?php echo e(set_active(['users', 'users/*'])); ?>"><a href="<?php echo e(url('/users')); ?>"
                                                                              title="<?php echo app('translator')->getFromJson('navbar.users'); ?>"
                                                                              data-toggle="tooltip"><i
                                        class="fa fa-user fa-2x" aria-hidden="true"></i></a></li>

                        <li class="dropdown">
                        <li class="dropup" title="Medicos" data-toggle="tooltip">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="fa fa-user-md fa-2x">
                                </i><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo e(route('RegistrarHistoriaClinica')); ?>"><i class="fa  fa-file-text fa fa-2x"
                                                                            aria-hidden="true"></i>
                                        <p>Registrar Historia Clínica</p></a></li>

                                <li><a href="<?php echo e(route('ListarPacientes')); ?>"><i class="fa  fa-file-text fa fa-2x"
                                                                            aria-hidden="true"></i>
                                        <p>Pacientes</p></a></li>
                                        
                                <li><a href="<?php echo e(route('ListarHistoriaClinicaxPaciente')); ?>"><i class="fa  fa-list fa fa-2x"
                                                                            aria-hidden="true"></i>
                                        <p>Listado de Historias Clinicas</p></a></li>
                                <li><a href="<?php echo e(url('/tools/dsearch')); ?>"><i class="fa fa-search fa fa-2x"
                                                                           aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.dsearch'); ?></p></a></li>
                            </ul>
                        </li>

                        <li class="dropup" title="<?php echo app('translator')->getFromJson('navbar.tools'); ?>" data-toggle="tooltip">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="fa fa-puzzle-piece fa fa-2x">
                                </i><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo e(url('/tools/discount')); ?>"><i class="fa  fa-sort-amount-desc fa fa-2x"
                                                                            aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.discount'); ?></p></a></li>
                                <li><a href="<?php echo e(url('/tools/note')); ?>"><i class="fa fa-sticky-note-o fa fa-2x"
                                                                        aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.note'); ?></p></a></li>
                                <li><a href="<?php echo e(url('/tools/dsearch')); ?>"><i class="fa fa-search fa fa-2x"
                                                                           aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.dsearch'); ?></p></a></li>
                            </ul>
                        </li>
                        <li class="dropup" id="settingNav" title="<?php echo app('translator')->getFromJson('navbar.setting'); ?>" data-toggle="tooltip">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sliders fa fa-2x">
                                </i><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo e(url('/setting/lt')); ?>"><i class="fa fa-globe fa fa-2x" aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.lt'); ?></p></a></li>
                                <li><a href="<?php echo e(url('/setting/printer')); ?>"><i class="fa fa-info-circle fa fa-2x"
                                                                             aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.printer'); ?></p></a></li>
                                
                                <li><a href="<?php echo e(url('/setting/series')); ?>"><i
                                        class="fa fa-file-text-o fa fa-2x" aria-hidden="true"></i>
                                    <p>  <?php echo app('translator')->getFromJson('navbar.series'); ?></p></a></li>

                                <li><a href="<?php echo e(url('/setting/other')); ?>"><i class="fa fa-barcode fa fa-2x"
                                                                           aria-hidden="true"></i>
                                        <p> <?php echo app('translator')->getFromJson('navbar.other'); ?></p></a></li>
                                <li><a href="<?php echo e(url('/setting/backup')); ?>"><i class="fa fa-cloud fa fa-2x"
                                                                            aria-hidden="true"></i>
                                        <p> <?php echo app('translator')->getFromJson('navbar.backup'); ?></p></a></li>

                            </ul>
                        </li>   <!-- end li #settingNav-->
                    </ul>
                </div> <!-- end div .navbar -->
                
            <?php endif; ?>
            <?php if(Auth::user()->hasAnyRole(['farmacia'])): ?>
                <div class="navbar navbar-inverse navbar-fixed-left">

                    <ul class="nav navbar-nav" style ="margin-top: 50px;">
                        <li class="<?php echo e(set_active(['/', '/*'])); ?>"><a href="<?php echo e(url('/')); ?>" title=" <?php echo app('translator')->getFromJson('navbar.dashboard'); ?>"
                                                                     data-toggle="tooltip"><i
                                        class="fa fa-tachometer fa fa-2x " aria-hidden="true"></i></a></li>
                        <li class="<?php echo e(set_active(['sales', 'sales/*'])); ?>"><a href="<?php echo e(url('/sales/create')); ?>"
                                                                              title="<?php echo app('translator')->getFromJson('navbar.sell'); ?>"
                                                                              data-toggle="tooltip"><i
                                        class="fa fa-money fa fa-2x" aria-hidden="true"></i></a></li>
                        <li class="<?php echo e(set_active(['sales', 'sales/*'])); ?>"><a href="<?php echo e(url('/sales')); ?>"
                                                                              title="<?php echo app('translator')->getFromJson('navbar.sales'); ?>"
                                                                              data-toggle="tooltip"><i
                                        class="fa fa-cart-plus fa fa-2x" aria-hidden="true"></i></a></li>
                        <li class="<?php echo e(set_active(['customers', 'customers/*'])); ?>"><a href="<?php echo e(url('/customers')); ?>"
                                                                                      title="<?php echo app('translator')->getFromJson('navbar.customers'); ?>"
                                                                                      data-toggle="tooltip"><i
                                        class="fa fa-users fa fa-2x" aria-hidden="true"></i></a></li>
                        <li class="dropdown">
                        <li class="dropup" title="<?php echo app('translator')->getFromJson('navbar.tools'); ?>" data-toggle="tooltip">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="fa fa-puzzle-piece fa fa-2x">
                                </i><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo e(url('/tools/discount')); ?>"><i class="fa  fa-sort-amount-desc fa fa-2x"
                                                                            aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.discount'); ?></p></a></li>
                                <li><a href="<?php echo e(url('/tools/note')); ?>"><i class="fa fa-sticky-note-o fa fa-2x"
                                                                        aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.note'); ?></p></a></li>
                                <li><a href="<?php echo e(url('/tools/dsearch')); ?>"><i class="fa fa-search fa fa-2x"
                                                                           aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.dsearch'); ?></p></a></li>
                            </ul>
                        </li>
                    </ul>
                </div> 
            <?php endif; ?>
            <?php if(Auth::user()->hasAnyRole(['Medico(a)'])): ?>
                <div class="navbar navbar-inverse navbar-fixed-left">

                    <ul class="nav navbar-nav" style ="margin-top: 350px;">
                        <li class="dropup" title="Medicos" data-toggle="tooltip">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="fa fa-user-md fa-2x">
                                </i><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo e(route('RegistrarHistoriaClinica')); ?>"><i class="fa  fa-file-text fa fa-2x"
                                                                            aria-hidden="true"></i>
                                        <p>Registrar Historia Clínica</p></a></li>

                                <li><a href="<?php echo e(route('ListarPacientes')); ?>"><i class="fa  fa-file-text fa fa-2x"
                                                                            aria-hidden="true"></i>
                                        <p>Pacientes</p></a></li>
                                        
                                <li><a href="<?php echo e(route('ListarHistoriaClinicaxPaciente')); ?>"><i class="fa  fa-list fa fa-2x"
                                                                            aria-hidden="true"></i>
                                        <p>Listado de Historias Clinicas</p></a></li>
                                <li><a href="<?php echo e(url('/tools/dsearch')); ?>"><i class="fa fa-search fa fa-2x"
                                                                           aria-hidden="true"></i>
                                        <p>  <?php echo app('translator')->getFromJson('navbar.dsearch'); ?></p></a></li>
                            </ul>
                        </li>
                    </ul>
                </div> 
            <?php endif; ?>
        </div> <!-- end div #sideNavbar -->

        <?php endif; ?>
        <div class="col-md-11 col-sm-11 col-xs-12 content">
            <?php echo $__env->yieldContent('content'); ?>
        </div> <!-- end div #content -->
    </div> <!-- end div .container-fluid -->
