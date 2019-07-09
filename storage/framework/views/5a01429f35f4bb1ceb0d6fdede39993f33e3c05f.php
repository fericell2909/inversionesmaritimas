<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'PMS')); ?> <?php echo $__env->yieldContent('title'); ?></title>

    <link rel="shortcut icon" href="<?php echo e(asset('img/favicon.ico')); ?>" type="image/x-icon">

    <!-- JS -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/plugins/toastr.min.js')); ?> " type="text/javascript"></script>
    <script src="<?php echo e(asset('js/plugins/print.js')); ?>" type="text/javascript"></script>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/material-kit.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/toastr.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('js/plugins/Trumbowyg/dist/ui/trumbowyg.min.css')); ?>">

    <?php if(get_setting()->color === 'white' ): ?>
        <link href="<?php echo e(asset('css/white_main.css')); ?>" rel="stylesheet">
    <?php elseif(get_setting()->color === 'black'): ?>
        <link href="<?php echo e(asset('css/black_main.css')); ?>" rel="stylesheet">
    <?php endif; ?>
    <?php echo $__env->yieldContent('estilos_adicionales'); ?>
</head>
