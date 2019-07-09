<?php if(session()->has('success')): ?>
    <script>
        toastr.success(' <?php echo e(session()->get('success')); ?>');
    </script>

<?php elseif(session()->has('warning')): ?>
    <script>
        toastr.warning('<?php echo e(session()->get('warning')); ?>');
    </script>
<?php endif; ?>
<?php if(count($errors) > 0): ?>
    <script>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastr.error('<?php echo e($error); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>
