<?php $__env->startSection('title' , $category->name . ' - '); ?>
<?php $__env->startSection('content'); ?>
    <div class="allNews width">
        <div class="topBlogs">
            <div class="allNewsRight">
                <div class="allNewsRightItems">
                    <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="allNewsRightItem" href="/blog/<?php echo e($item->slug); ?>" title="<?php echo e($item->titleSeo); ?>">
                            <figure>
                                <img src="<?php echo e($item->image); ?>" alt="<?php echo e($item->imageAlt); ?>">
                            </figure>
                            <div class="allNewsRightItemOver">
                                <h3><?php echo e($item->title); ?></h3>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="allNewsSideBar">
                <div class="allNewsSideBarItem">
                    <label><?php echo e(__('messages.suggest')); ?></label>
                    <ul>
                        <?php $__currentLoopData = $suggest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <article>
                                    <a href="/blog/<?php echo e($item->slug); ?>" title="<?php echo e($item->titleSeo); ?>">
                                        <img src="<?php echo e($item->image); ?>" alt="<?php echo e($item->imageAlt); ?>">
                                        <div class="showInfo">
                                            <h4><?php echo e($item->title); ?></h4>
                                            <span><?php echo e($item->created_at); ?></span>
                                        </div>
                                    </a>
                                </article>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="description">
            <h1><?php echo e($category->name); ?></h1>
            <p><?php echo $category->body; ?></p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/home/archive/news.blade.php ENDPATH**/ ?>