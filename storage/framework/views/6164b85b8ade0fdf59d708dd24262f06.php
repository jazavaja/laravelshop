<?php $__env->startSection('title', 'صفحه پیدا نشد - '); ?>
<?php $__env->startSection('content'); ?>
    <div class="allErrorContent">
        <h1>صفحه مورد نظر پیدا نشد</h1>
        <img src="/img/gif404.gif" alt="صفحه پیدا نشد">
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/errors/404.blade.php ENDPATH**/ ?>