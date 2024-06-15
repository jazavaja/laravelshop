<section class="allOffProduct width">
    <h3><?php echo e(__('messages.best_off')); ?></h3>
    <ul>
        <?php $__currentLoopData = $data['post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="/product/<?php echo e($item->slug); ?>" title="<?php echo e($item->title); ?>" name="<?php echo e($item->title); ?>">
                    <article>
                        <figure class="pic">
                            <?php if($item->image != '[]'): ?>
                                <img lazy="loading" class="lazyload" style="height:<?php echo e($data['height']); ?>rem" src="/img/404Image.png" data-src="<?php echo e(json_decode($item->image)[0]); ?>" alt="<?php echo e($item->imageAlt); ?>">
                            <?php endif; ?>
                            <?php if($item->lotteryStatus == 1): ?>
                                <div class="lotteryStatus">
                                    <svg class="icon">
                                        <use xlink:href="#lotteryShow"></use>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </figure>
                        <?php if($item->colors != '[]'): ?>
                            <div class="colors">
                                <?php $__currentLoopData = json_decode($item->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="color" style="background-color: <?php echo e($value->color); ?>"></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                        <div class="options">
                            <?php if($item->inquiry == 0): ?>
                                <div class="optionItem" name="quickBuy" title="<?php echo e(__('messages.buy_fast')); ?>" id="<?php echo e($item->id); ?>">
                                    <svg class="icon">
                                        <use xlink:href="#time-fast"></use>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <div class="optionItem" name="addCart" title="<?php echo e(__('messages.add_cart')); ?>" id="<?php echo e($item->id); ?>">
                                <svg class="icon">
                                    <use xlink:href="#add-cart"></use>
                                </svg>
                            </div>
                            <div class="optionItem" name="counselingBtn" title="<?php echo e(__('messages.counseling_fast')); ?>" data="<?php echo e($item->title); ?>" id="<?php echo e($item->id); ?>">
                                <svg class="icon">
                                    <use xlink:href="#counseling"></use>
                                </svg>
                            </div>
                            <div class="optionItem" name="compareBtn" title="<?php echo e(__('messages.compare')); ?>" id="<?php echo e($item->product_id); ?>">
                                <svg class="icon">
                                    <use xlink:href="#chart"></use>
                                </svg>
                            </div>
                        </div>
                        <h3><?php echo e($item->title); ?></h3>
                        <div class="price">
                            <?php if($item->off): ?>
                                <div class="off">
                                    <s><?php echo e(number_format($item->offPrice)); ?></s>
                                    <div class="offProduct">
                                        <div class="offProductItem">
                                            <svg class="icon">
                                                <use xlink:href="#off-tag"></use>
                                            </svg>
                                            <div>
                                                <span>%<?php echo e($item->off); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <h5>
                                <?php if(auth()->user()): ?>
                                    <?php if(auth()->user()->roles()->whereIn('name' , collect(json_decode($item['levels']))->pluck('name'))->first()): ?>
                                        <?php if($item->levels): ?>
                                            <?php if($item['levels'] != '[]'): ?>
                                                <?php $__currentLoopData = json_decode($item['levels']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(in_array($val->name, auth()->user()->roles()->pluck('name')->toArray())): ?>
                                                        <?php echo e(number_format($val->price)); ?>

                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo e(number_format($item->price)); ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php echo e(number_format($item->price)); ?>

                                <?php endif; ?>
                                <?php echo e(__('messages.arz')); ?>

                            </h5>
                        </div>
                    </article>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</section>
<?php /**PATH /var/www/html/resources/views/home/index/offProduct.blade.php ENDPATH**/ ?>