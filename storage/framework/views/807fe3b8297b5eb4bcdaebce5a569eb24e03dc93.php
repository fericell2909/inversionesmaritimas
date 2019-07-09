<div id="app">
    <div id="cover"></div> <!-- end div #cover -->

    <?php if(Auth::user()): ?>
        <nav class="navbar navbar-info navbar-static-top navbar-fixed ">
            <div class="navbar-header col-md-offset-1 col-sm-offset-1">
                <!-- Collapsed  -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a href="<?php echo e(url('/')); ?>">
                    <img src="<?php echo e(asset('img/logo.jpg')); ?>" width="140" >
                </a>
            </div>

            <div class="col-md-4 col-sm-5 col-md-offset-2 col-sm-offset-2 " id="searchBox">
                <div id="custom-search-input">
                    <div class="input-group ">
                        <input type="text" class="form-control input-md" v-model="search"
                               autocomplete="off" id="Search" name="search" placeholder="<?php echo app('translator')->getFromJson('navbar.search'); ?>"/>
                        <span class="input-group-btn">
                    <button class="btn btn-info btn-md" type="button">
                     <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </span>
                    </div>
                </div>
                <div class="col-md-10" id="resultSearchBox"
                ">
            </div>
</div>  <!-- end div #searchDiv -->
<div class="collapse navbar-collapse" id="app-navbar-collapse">
    <!-- Left Side Of Navbar -->
    <ul class="nav navbar-nav">
        &nbsp;
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        <li class="dropdown" id="logout">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="fa fa-user-circle-o"></span>
                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="<?php echo e(url('/account')); ?>"><span class="fa fa-edit"></span> <?php echo app('translator')->getFromJson('navbar.account'); ?></a>
                </li>
                <li>
                    <a href="<?php echo e(route('logout')); ?>"
                       onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                        <span class="fa fa-sign-out"></span>
                        <?php echo app('translator')->getFromJson('navbar.logout'); ?>
                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                    </form>
                </li>
            </ul>
        </li>

        <!-- Phone only -->
        <ul class="nav navbar-nav navbar-right nav-menu-phone hidden-lg hidden-md hidden-lg hidden-md hidden-lg hidden-md hidden-sm">
            <?php if(Auth::user()->hasAnyRole(['admin','superadmin'])): ?>

            <li class="<?php echo e(set_active(['sales', 'sales/*'])); ?>"><a href="<?php echo e(url('/sales/create')); ?>"><i
                            class="fa fa-money fa fa-2x" aria-hidden="true"></i>
                    <p class="hidden-lg hidden-md hidden-sm">  <?php echo app('translator')->getFromJson('navbar.sell'); ?></p></a></li>


            <li class="<?php echo e(set_active(['sales', 'sales/*'])); ?>"><a href="<?php echo e(url('/sales')); ?>"><i
                            class="fa fa-cart-plus fa -2x" aria-hidden="true"></i>
                    <p class="hidden-lg hidden-md hidden-sm">  <?php echo app('translator')->getFromJson('navbar.sales'); ?></p></a></li>
            <li class="<?php echo e(set_active(['category', 'category/*'])); ?>"><a href="<?php echo e(url('/category')); ?>"><i
                            class="fa fa-list  fa-2x" aria-hidden="true"></i>
                    <p class="hidden-lg hidden-md hidden-sm">  <?php echo app('translator')->getFromJson('navbar.category'); ?></p></a></li>
            <li class="<?php echo e(set_active(['suppliers', 'suppliers/*'])); ?>"><a href="<?php echo e(url('/suppliers')); ?>"><i
                            class="fa fa-truck  fa-2x" aria-hidden="true"></i>
                    <p class="hidden-lg hidden-md hidden-sm">  <?php echo app('translator')->getFromJson('navbar.provider'); ?></p></a></li>
            <li class="<?php echo e(set_active(['customers', 'customers/*'])); ?>"><a href="<?php echo e(url('/customers')); ?>"><i
                            class="fa fa-users  fa-2x" aria-hidden="true"></i>
                    <p class="hidden-lg hidden-md hidden-sm">  <?php echo app('translator')->getFromJson('navbar.customers'); ?></p></a></li>

            <li class="<?php echo e(set_active(['users', 'users/*'])); ?>"><a href="<?php echo e(url('/users')); ?>"><i
                            class="fa  fa-user fa-2x" aria-hidden="true"></i>
                    <p class="hidden-lg hidden-md hidden-sm">  <?php echo app('translator')->getFromJson('navbar.users'); ?></p></a></li>

            <li class="<?php echo e(set_active(['analysis', 'analysis/*'])); ?>"><a href="<?php echo e(url('/analysis')); ?>"><i
                            class="fa  fa-line-chart fa-2x" aria-hidden="true"></i>
                    <p class="hidden-lg hidden-md hidden-sm">  <?php echo app('translator')->getFromJson('navbar.analysis'); ?></p></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-puzzle-piece fa fa-2x">
                    </i>
                    <p class="hidden-lg hidden-md hidden-sm"><?php echo app('translator')->getFromJson('navbar.tools'); ?><span class="caret"></span></p></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="<?php echo e(set_active(['tools', 'tools/*'])); ?>"><a href="<?php echo e(url('/tools/discount')); ?>"><i
                                    class="fa  fa-sort-amount-desc fa fa-2x" aria-hidden="true"></i>
                            <p>  <?php echo app('translator')->getFromJson('navbar.discount'); ?></p></a></li>
                    <li class="<?php echo e(set_active(['tools', 'tools/*'])); ?>"><a href="<?php echo e(url('/tools/note')); ?>"><i
                                    class="fa fa-sticky-note-o fa fa-2x" aria-hidden="true"></i>
                            <p>  <?php echo app('translator')->getFromJson('navbar.note'); ?></p></a></li>
                    <li class="<?php echo e(set_active(['tools', 'tools/*'])); ?>"><a href="<?php echo e(url('/tools/dsearch')); ?>"><i
                                    class="fa fa-search fa fa-2x" aria-hidden="true"></i>
                            <p>  <?php echo app('translator')->getFromJson('navbar.dsearch'); ?></p></a></li>
                </ul>
            </li>
            <li class="dropdown" id="settingNav">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sliders fa fa-2x">
                    </i>
                    <p class="hidden-lg hidden-md hidden-sm"><?php echo app('translator')->getFromJson('navbar.setting'); ?><span class="caret"></span></p></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="<?php echo e(set_active(['setting', 'setting/*'])); ?>"><a href="<?php echo e(url('/setting/lt')); ?>"><i
                                    class="fa fa-globe fa-2x" aria-hidden="true"></i>
                            <p>  <?php echo app('translator')->getFromJson('navbar.lt'); ?></p></a></li>
                    <li class="<?php echo e(set_active(['setting', 'setting/*'])); ?>"><a href="<?php echo e(url('/setting/printer')); ?>"><i
                                    class="fa fa-info-circle  fa-2x" aria-hidden="true"></i>
                            <p>  <?php echo app('translator')->getFromJson('navbar.printer'); ?></p></a></li>
                    <li class=""><a href="<?php echo e(url('/setting/series')); ?>"><i
                                    class="fa fa-file-text-o  fa-2x" aria-hidden="true"></i>
                            <p>  <?php echo app('translator')->getFromJson('navbar.series'); ?></p></a></li>
                    <li class="<?php echo e(set_active(['setting', 'setting/*'])); ?>"><a href="<?php echo e(url('/setting/other')); ?>"><i
                                    class="fa fa-barcode  fa-2x" aria-hidden="true"></i>
                            <p> <?php echo app('translator')->getFromJson('navbar.other'); ?></p></a></li>
                    <li class="<?php echo e(set_active(['setting', 'setting/*'])); ?>"><a href="<?php echo e(url('/setting/backup')); ?>"><i
                                    class="fa fa-cloud  fa-2x" aria-hidden="true"></i>
                            <p> <?php echo app('translator')->getFromJson('navbar.backup'); ?></p></a></li>
                </ul>
            </li>
            <li class="dropdown">

                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-medkit fa fa-2x">
                    </i>
                    <p class="hidden-lg hidden-md hidden-sm"><?php echo app('translator')->getFromJson('navbar.products'); ?><span class="caret"></span></p></a>

                    <ul class="dropdown-menu" role="menu">
                        <li class="<?php echo e(set_active(['product', '/prodcut'])); ?>"><a href="<?php echo e(url('product')); ?>"><i
                                        class="fa fa-pencil fa-2x" aria-hidden="true"></i>
                                <p>  <?php echo app('translator')->getFromJson('navbar.manage'); ?> </p></a></li>
                        <li class="<?php echo e(set_active(['product', '/prodcut/outstock'])); ?>"><a
                                    href="<?php echo e(url('/product/outstock')); ?>"><i class="fa fa-archive fa-2x"
                                                                             aria-hidden="true"></i>
                                <p>  <?php echo app('translator')->getFromJson('navbar.outstock'); ?>  </p>
                                <span id="notif-circle"><p><?php echo e(outStockCount()); ?></p></span></a></li>
                        <li class="<?php echo e(set_active(['product', '/prodcut/expired'])); ?>"><a
                                    href="<?php echo e(url('/product/expired')); ?>"><i class="fa fa-exclamation-circle fa-2x"
                                                                            aria-hidden="true"></i>
                                <p> <?php echo app('translator')->getFromJson('navbar.expired'); ?></p><span id="notif-circle"><p><?php echo e(expiredCount()); ?></p></span>
                            </a></li>
                    </ul>
            </li>
            <?php endif; ?>
            <?php if(Auth::user()->hasAnyRole(['logistica'])): ?>
                <li class="<?php echo e(set_active(['/', '/*'])); ?>"><a href="<?php echo e(url('/')); ?>" title=" <?php echo app('translator')->getFromJson('navbar.dashboard'); ?>"
                                                                     data-toggle="tooltip"><i
                                        class="fa fa-tachometer fa fa-2x " aria-hidden="true"></i><p class="hidden-lg hidden-md hidden-sm">  <?php echo app('translator')->getFromJson('navbar.dashboard'); ?></p></a></li></a></li>

                        <li class="<?php echo e(set_active(['sales', 'sales/*'])); ?>"><a href="<?php echo e(url('/sales/create')); ?>"><i
                            class="fa fa-money fa fa-2x" aria-hidden="true"></i>
                    <p class="hidden-lg hidden-md hidden-sm">  <?php echo app('translator')->getFromJson('navbar.sell'); ?></p></a></li>


            <li class="<?php echo e(set_active(['sales', 'sales/*'])); ?>"><a href="<?php echo e(url('/sales')); ?>"><i
                            class="fa fa-cart-plus fa -2x" aria-hidden="true"></i>
                    <p class="hidden-lg hidden-md hidden-sm">  <?php echo app('translator')->getFromJson('navbar.sales'); ?></p></a></li>

                           <li class="<?php echo e(set_active(['customers', 'customers/*'])); ?>"><a href="<?php echo e(url('/customers')); ?>"><i
                            class="fa fa-users  fa-2x" aria-hidden="true"></i>
                    <p class="hidden-lg hidden-md hidden-sm">  <?php echo app('translator')->getFromJson('navbar.customers'); ?></p></a></li>
                        
                         <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-puzzle-piece fa fa-2x">
                    </i>
                    <p class="hidden-lg hidden-md hidden-sm"><?php echo app('translator')->getFromJson('navbar.tools'); ?><span class="caret"></span></p></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="<?php echo e(set_active(['tools', 'tools/*'])); ?>"><a href="<?php echo e(url('/tools/discount')); ?>"><i
                                    class="fa  fa-sort-amount-desc fa fa-2x" aria-hidden="true"></i>
                            <p>  <?php echo app('translator')->getFromJson('navbar.discount'); ?></p></a></li>
                    <li class="<?php echo e(set_active(['tools', 'tools/*'])); ?>"><a href="<?php echo e(url('/tools/note')); ?>"><i
                                    class="fa fa-sticky-note-o fa fa-2x" aria-hidden="true"></i>
                            <p>  <?php echo app('translator')->getFromJson('navbar.note'); ?></p></a></li>
                    <li class="<?php echo e(set_active(['tools', 'tools/*'])); ?>"><a href="<?php echo e(url('/tools/dsearch')); ?>"><i
                                    class="fa fa-search fa fa-2x" aria-hidden="true"></i>
                            <p>  <?php echo app('translator')->getFromJson('navbar.dsearch'); ?></p></a></li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
        
       
    </ul>
    <!-- End phone -->
    <?php endif; ?>
</div>
</nav> <!-- end nav -->
