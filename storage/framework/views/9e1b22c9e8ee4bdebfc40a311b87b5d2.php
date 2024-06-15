<div class="momentProduct width">
    <div class="rightMoment">
        <div class="rightMomentTitle"><?php echo e($data['title']); ?></div>
        <div class="slider-moment owl-carousel owl-theme">
            <?php $__currentLoopData = $data['post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <a href="/product/<?php echo e($item->slug); ?>" title="<?php echo e($item->titleSeo); ?>" name="<?php echo e($item->title); ?>">
                        <article>
                            <figure class="pic">
                                <div class="picBlock">
                                    <?php if($item->image != '[]'): ?>
                                        <img lazy="loading" class="lazyload" src="/img/404Image.png" data-src="<?php echo e(json_decode($item->image)[0]); ?>" alt="<?php echo e($item->imageAlt); ?>">
                                    <?php endif; ?>
                                    <?php if($item->colors != '[]'): ?>
                                        <div class="colors">
                                            <?php $__currentLoopData = json_decode($item->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="color" style="background-color: <?php echo e($value->color); ?>"></div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </figure>
                            <div class="leftProduct">
                                <h3>
                                    <?php echo e($item->title); ?>

                                    <span>
                                        <svg class="icon">
                                            <use xlink:href="#cart"></use>
                                        </svg>
                                        <?php echo e(number_format($item->pay_meta_count)); ?>

                                        <?php echo e(__('messages.success_buy')); ?>

                                    </span>
                                </h3>
                                <div class="starProduct">
                                    <svg class="icon">
                                        <use xlink:href="#star"></use>
                                    </svg>
                                    <?php if($item->rates_count): ?>
                                        <span><?php echo e($item->rates_count); ?></span>
                                    <?php else: ?>
                                        <span>0</span>
                                    <?php endif; ?>
                                </div>
                                <div class="price">
                                    <?php if($item->off): ?>
                                        <s><?php echo e(number_format($item->offPrice)); ?></s>
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
                                <?php if($item->ability != '[]'): ?>
                                    <div class="ability">
                                        <h4><?php echo e(__('messages.product_property')); ?> :</h4>
                                        <ul>
                                            <?php $__currentLoopData = json_decode($item->ability); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($loop->index <= 3): ?>
                                                <li><?php echo e($value->name); ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="leftMoment">
        <h4>
            <svg class="icon">
                <use xlink:href="#clock"></use>
            </svg>
            <?php echo e(__('messages.suggest_moment')); ?>

        </h4>
        <div class="slider-moment2 owl-carousel owl-theme">
            <?php $__currentLoopData = $moment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <a href="/product/<?php echo e($item->slug); ?>" name="<?php echo e($item->title); ?>" title="<?php echo e($item->title); ?>">
                        <article>
                            <div class="timer"></div>
                            <div class="momentPic">
                                <?php if($item->image != '[]'): ?>
                                    <img class="lazyload" src="/img/404Image.png" data-src="<?php echo e(json_decode($item->image)[0]); ?>" alt="<?php echo e($item->imageAlt); ?>">
                                <?php endif; ?>
                            </div>
                            <h3><?php echo e($item->title); ?></h3>
                            <h5><?php echo e(number_format($item->price)); ?> <?php echo e(__('messages.arz')); ?></h5>
                        </article>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/home/index/momentProduct.blade.php ENDPATH**/ ?>