<?php $__env->startSection('content'); ?>
<style>
    body {
        background: #eefaf3;
    }
    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        border-radius: 18px;
        box-shadow: 0 8px 32px 0 rgba(28, 90, 36, 0.12);
        border: none;
        background: #fff;
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 430px;
        width: 100%;
    }
    .login-card .card-header {
        background: #15401b;
        color: #fff;
        border-radius: 16px 16px 0 0;
        font-size: 1.5rem;
        text-align: center;
        font-weight: 600;
        letter-spacing: 1px;
        border: none;
        margin-bottom: 1.5rem;
        padding: 1.2rem 1rem;
    }
    .form-control:focus {
        border-color: #15401b !important; /* Verde oscuro */
        box-shadow: 0 0 0 0.2rem rgba(21, 64, 27, 0.15) !important; /* Sombra verde */
    }
    .btn-primary {
        background: #15401b;
        border: none;
        font-weight: 600;
        transition: background 0.2s;
    }
    .btn-primary:hover {
        background: #c28e00;
        color: #fff;
    }
    .btn-link {
        color: #c28e00;
        font-weight: 500;
    }
    .btn-link:hover {
        color: #15401b;
        text-decoration: underline;
    }
    .register-link {
        display: block;
        text-align: center;
        margin-top: 1.5rem;
        font-size: 1rem;
        color: #15401b;
    }
    .register-link a {
        color: #c28e00;
        font-weight: 600;
        text-decoration: none;
        margin-left: 4px;
    }
    .register-link a:hover {
        color: #15401b;
        text-decoration: underline;
    }
</style>
<div class="login-container">
    <div class="login-card card">
        <div class="card-header"><?php echo e(__('Login')); ?></div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="email" class="form-label"><?php echo e(__('Email Address')); ?></label>
                    <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label"><?php echo e(__('Password')); ?></label>
                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="password" required autocomplete="current-password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="remember">
                        <?php echo e(__('Remember Me')); ?>

                    </label>
                </div>

                <div class="d-grid gap-2 mb-2">
                    <button type="submit" class="btn btn-primary">
                        <?php echo e(__('Login')); ?>

                    </button>
                </div>

                <?php if(Route::has('password.request')): ?>
                    <div class="text-center">
                        <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                            <?php echo e(__('Forgot Your Password?')); ?>

                        </a>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Yeison\Pictures\Instagram_files\dulcecontigo-copia-ACTULIZADO 23 DE MAYO\resources\views/auth/login.blade.php ENDPATH**/ ?>