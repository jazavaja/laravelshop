<!doctype html>
<html lang="en">
<head>
    <?php $config = (new \LaravelPWA\Services\ManifestService)->generate(); echo $__env->make( 'laravelpwa::meta' , ['config' => $config])->render(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php if(\App\Models\Setting::where('key' , 'font')->pluck('value')->first() == 0): ?>
        <link rel="stylesheet" href="/css/font-iransans.css" type="text/css"/>
    <?php elseif(\App\Models\Setting::where('key' , 'font')->pluck('value')->first() == 1): ?>
        <link rel="stylesheet" href="/css/font-vazir.css" type="text/css"/>
    <?php else: ?>
        <link rel="stylesheet" href="/css/font-sahel.css" type="text/css"/>
    <?php endif; ?>
    <link rel="stylesheet" href="/css/admin.css?v=as21" type="text/css"/>
    <?php echo $__env->yieldContent('links'); ?>
    <?php echo $__env->yieldContent('links2'); ?>
    <script src="/js/jquery-3.6.1.min.js"></script>
    <script src="/js/jquery.toast.min.js"></script>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <?php echo $__env->yieldContent('jsScript'); ?>
    <?php echo $__env->yieldContent('jsScript2'); ?>
    <?php echo $__env->yieldContent('mapLink'); ?>
    <title><?php echo e(env('APP_NAME')); ?></title>
</head>
<body>
    <?php echo $__env->yieldContent('map'); ?>
    <?php echo $__env->make('icons2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.side.sidebar' , ['logo' => $logo,'sideColor' => $sideColor], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.header.header' , ['headerColor' => $headerColor], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="allPanel">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <?php echo $__env->yieldContent('scripts'); ?>
    <?php echo $__env->yieldContent('scripts2'); ?>
    <?php echo $__env->yieldContent('scripts3'); ?>
    <?php echo $__env->yieldContent('scripts4'); ?>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/admin/master.blade.php ENDPATH**/ ?>