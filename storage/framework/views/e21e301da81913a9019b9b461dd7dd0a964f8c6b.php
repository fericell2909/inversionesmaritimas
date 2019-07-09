<?php echo $__env->make('layouts._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="col-md-12" id="background-login">
    <img src="<?php echo e(asset('img/background-login.jpg')); ?>" alt="background-login" class="img-responsive"
         style="    height: 100vh;">
</div>
<div class="col-md-4 col-md-offset-4" id="login">
    <div class="panel panel-default">
        <div class="panel-heading"><img src="<?php echo e(asset('img/logo.png')); ?>" alt="logo" width="140"></div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="col-md-12">
                    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?> ">
                        <label for="email" class="control-label"><?php echo app('translator')->getFromJson('login.email'); ?></label>
                        <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>"
                               required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> ">
                        <label for="password" class="control-label"><?php echo app('translator')->getFromJson('login.password'); ?></label>

                        <input id="password" type="password" class="form-control" name="password" required>

                        <?php if($errors->has('password')): ?>
                            <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"
                                       name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> <?php echo app('translator')->getFromJson('login.remember'); ?>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" id="buttonlogin" class="btn btn-default">
                            <?php echo app('translator')->getFromJson('button.login'); ?>
                        </button>

                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php echo $__env->make('layouts._javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
// $(function () {
//     $('#buttonlogin').on('click', function () {
//             alert('click');
//             return false;
//     });
// });
</script>
<?php echo $__env->make('layouts._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>