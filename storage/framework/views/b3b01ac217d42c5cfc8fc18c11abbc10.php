<div class="allCircleProduct width">
    <div class="container">
        <ul class='circle-container'>
            <?php $__currentLoopData = $data['cats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($loop->index == 0): ?>
                    <li class="active" data-id="<?php echo e($loop->index); ?>">
                <?php else: ?>
                    <li data-id="<?php echo e($loop->index); ?>">
                <?php endif; ?>
                    <a href='#'>
                        <img src="<?php echo e($val->image); ?>" alt="<?php echo e($val->nameSep); ?>">
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <ul class="services-container">
            <?php $__currentLoopData = $data['post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($loop->index == 0 ?'active' : ''); ?>">
                    <div class="service-item" data-id="<?php echo e($loop->index); ?>">
                        <div class="titleCat">
                            <?php echo e($posts['name']); ?>

                        </div>
                        <div class="containerItems">
                            <?php $__currentLoopData = $posts['product']->slice(0,3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="/product/<?php echo e($item->slug); ?>" title="<?php echo e($item->titleSeo); ?>" name="<?php echo e($item->title); ?>">
                                    <article>
                                        <figure class="pic">
                                            <?php if($item->image != '[]'): ?>
                                                <img lazy="loading" class="lazyload" style="height:<?php echo e($data['height']); ?>rem" src="/img/404Image.png" data-src="<?php echo e(json_decode($item->image)[0]); ?>" alt="<?php echo e($item->imageAlt); ?>">
                                                <?php if(count(json_decode($item->image)) >= 2): ?>
                                                    <img lazy="loading" class="lazyload" style="height:<?php echo e($data['height']); ?>rem" src="/img/404Image.png" data-src="<?php echo e(json_decode($item->image)[1]); ?>" alt="<?php echo e($item->imageAlt); ?>">
                                                <?php else: ?>
                                                    <img lazy="loading" class="lazyload" style="height:<?php echo e($data['height']); ?>rem" src="/img/404Image.png" data-src="<?php echo e(json_decode($item->image)[0]); ?>" alt="<?php echo e($item->imageAlt); ?>">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if($item->lotteryStatus == 1 && $item->count >= 1): ?>
                                                <div class="lotteryStatus">
                                                    <svg class="icon">
                                                        <use xlink:href="#lotteryShow"></use>
                                                    </svg>
                                                </div>
                                            <?php endif; ?>
                                            <?php if($item->rate != '[]' && $item->rate != ''): ?>
                                                <div class="allRateProduct">
                                                    <?php $__currentLoopData = json_decode($item->rate); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="rateItem1">
                                                            <div class="rateTitle"><?php echo e($val->name); ?></div>
                                                            <div class="rateBody"><?php echo e(($val->rate * 100) / 4); ?>%</div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if($item->colors != '[]'): ?>
                                                <div class="colors">
                                                    <?php $__currentLoopData = json_decode($item->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="color" style="background-color: <?php echo e($value->color); ?>"></div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </figure>
                                        <?php if($item->count >= 1): ?>
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
                                        <?php endif; ?>
                                        <h3><?php echo e($item->title); ?></h3>
                                        <?php if($item->count >= 1): ?>
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
                                        <?php endif; ?>
                                        <?php if($item->count <= 0 && $item->prebuy == 0): ?>
                                            <div class="emptyProduct"></div>
                                        <?php endif; ?>
                                        <?php if($item->count <= 0 && $item->prebuy == 1): ?>
                                            <div class="preProduct"></div>
                                        <?php endif; ?>
                                        <?php if($item->note): ?>
                                            <div class="note">
                                                <h4><?php echo e($item->note); ?></h4>
                                            </div>
                                        <?php elseif($item->suggest): ?>
                                            <div class="countdown" data-time="<?php echo e($item->suggest); ?>"></div>
                                        <?php else: ?>
                                            <div class="optionDown">
                                                <div class="optionItem" name="addCart" title="<?php echo e(__('messages.add_cart')); ?>" id="<?php echo e($item->id); ?>">
                                                    <svg class="icon">
                                                        <use xlink:href="#add-cart"></use>
                                                    </svg>
                                                    <?php echo e(__('messages.add_cart')); ?>

                                                </div>
                                                <div class="optionItem" name="counselingBtn" title="<?php echo e(__('messages.counseling_fast')); ?>" data="<?php echo e($item->title); ?>" id="<?php echo e($item->id); ?>">
                                                    <svg class="icon">
                                                        <use xlink:href="#counseling"></use>
                                                    </svg>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </article>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/home/index/circleProduct.blade.php ENDPATH**/ ?>