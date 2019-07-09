<?php echo $__env->make('layouts._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body>
<!-- BEGIN HEADER  -->
<?php echo $__env->make('layouts._nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- END HEADER  -->
<!-- BEGIN CONTENT  -->
<?php echo $__env->make('layouts._body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts._message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- END CONTENT  -->
<?php echo $__env->make('layouts._javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>