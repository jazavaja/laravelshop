<?php $__env->startSection('title' , __('messages.detail_order') . ' - '); ?>
<?php $__env->startSection('content'); ?>
    <div class="allProfileIndex width">
        <?php echo $__env->make('home.profile.list' , ['tab' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="allShowPay">
            <div class="topShowPay">
                <div class="title">
                    <h1><?php echo e(__('messages.detail_order')); ?></h1>
                    <span><?php echo e($pays->created_at); ?></span>
                    <div>
                            <span>
                                <a href="/invoice/<?php echo e($pays->property); ?>" target="_blank"><?php echo e(__('messages.invoice1')); ?></a>
                            </span>
                    </div>
                </div>
                <div class="detail">
                    <div class="topDetail">
                        <div class="items">
                            <?php if(count($pays->address) >= 1): ?>
                                <div class="item">
                                    <h5><?php echo e(__('messages.buyer_name')); ?> :</h5>
                                    <div><?php echo e($pays->address[0]->name); ?></div>
                                </div>
                                <div class="item">
                                    <h5><?php echo e(__('messages.buyer_number')); ?> :</h5>
                                    <div><?php echo e($pays->address[0]->number); ?></div>
                                </div>
                                <div class="item">
                                    <h5><?php echo e(__('messages.seller_post')); ?> :</h5>
                                    <div><?php echo e($pays->address[0]->post); ?></div>
                                </div>
                            <?php endif; ?>
                            <?php if($pays->method != 6): ?>
                                <div class="item">
                                    <h5><?php echo e(__('messages.buyer_carrier_type')); ?> :</h5>
                                    <div><?php echo e($pays->carrier); ?></div>
                                </div>
                                <div class="item">
                                    <h5><?php echo e(__('messages.buyer_carrier_price')); ?> :</h5>
                                    <div><?php echo e(number_format($pays->carrier_price)); ?> <?php echo e(__('messages.arz')); ?> </div>
                                </div>
                                <?php if($pays->time): ?>
                                    <div class="item">
                                        <h5><?php echo e(__('messages.buyer_time')); ?> :</h5>
                                        <div>
                                            <span><?php echo e(__('messages.period_cart')); ?></span>
                                            <span><?php echo e(json_decode($pays->time)->from); ?>:00</span>
                                            <span>-</span>
                                            <span><?php echo e(json_decode($pays->time)->to); ?>:00</span>
                                            <span>---></span>
                                            <span><?php echo e(json_decode($pays->time)->day); ?> / </span>
                                            <span><?php echo e(json_decode($pays->time)->month); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php if(count($pays->address) >= 1): ?>
                            <div class="items">
                                <div class="item">
                                    <h5><?php echo e(__('messages.address')); ?> :</h5>
                                    <div>
                                        <?php echo e($pays->address[0]->state); ?>

                                        -<?php echo e($pays->address[0]->city); ?>

                                        -<?php echo e($pays->address[0]->address); ?>

                                        <?php echo e(__('messages.buyer_address')); ?> :
                                        <?php echo e($pays->address[0]->plaque); ?>

                                        <?php echo e(__('messages.unit_address')); ?> :
                                        <?php echo e($pays->address[0]->unit); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="botDetail">
                        <div class="items">
                            <div class="item">
                                <h5><?php echo e(__('messages.order_price')); ?> :</h5>
                                <div><?php echo e(number_format($pays->price)); ?> <?php echo e(__('messages.order_price')); ?></div>
                            </div>
                            <?php if($pays->method == 2): ?>
                                <div class="item">
                                    <h5><?php echo e(__('messages.buyer_deposit')); ?> :</h5>
                                    <div><?php echo e(number_format($pays->deposit)); ?> <?php echo e(__('messages.arz')); ?></div>
                                </div>
                            <?php endif; ?>
                            <div class="item">
                                <h5> :<?php echo e(__('messages.order_install5')); ?></h5>
                                <?php if($pays->status == 100): ?>
                                    <span class="active"><?php echo e(__('messages.order_status2')); ?></span>
                                <?php endif; ?>
                                <?php if($pays->status == 50): ?>
                                    <span class="active"><?php echo e(__('messages.order_status3')); ?></span>
                                <?php endif; ?>
                                <?php if($pays->status == 20): ?>
                                    <span class="active"><?php echo e(__('messages.order_status4')); ?></span>
                                <?php endif; ?>
                                <?php if($pays->status == 10): ?>
                                    <span class="unActive"><?php echo e(__('messages.order_status5')); ?></span>
                                <?php endif; ?>
                                <?php if($pays->status == 0): ?>
                                    <span class="unActive"><?php echo e(__('messages.order_status6')); ?></span>
                                <?php endif; ?>
                                <?php if($pays->status == 1): ?>
                                    <span class="unActive"><?php echo e(__('messages.order_status7')); ?></span>
                                <?php endif; ?>
                                <?php if($pays->status == 2): ?>
                                    <span class="unActive"><?php echo e(__('messages.order_status8')); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if($pays->method != 6): ?>
                                <div class="item">
                                    <h5><?php echo e(__('messages.order_deliver')); ?> :</h5>
                                    <?php if($pays->deliver == 0): ?>
                                        <span class="unActive"><?php echo e(__('messages.order_deliver1')); ?></span>
                                    <?php endif; ?>
                                    <?php if($pays->deliver == 1): ?>
                                        <span class="unActive"><?php echo e(__('messages.order_deliver2')); ?></span>
                                    <?php endif; ?>
                                    <?php if($pays->deliver == 2): ?>
                                        <span class="unActive"><?php echo e(__('messages.order_deliver3')); ?></span>
                                    <?php endif; ?>
                                    <?php if($pays->deliver == 3): ?>
                                        <span class="unActive"><?php echo e(__('messages.order_deliver4')); ?></span>
                                    <?php endif; ?>
                                    <?php if($pays->deliver == 4): ?>
                                        <span class="activeStatus"><?php echo e(__('messages.order_deliver5')); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="item">
                                <h5><?php echo e(__('messages.order_method')); ?> :</h5>
                                <?php if($pays->method == 0): ?>
                                    <div><?php echo e(__('messages.method_cart1')); ?></div>
                                <?php endif; ?>
                                <?php if($pays->method == 1): ?>
                                    <div><?php echo e(__('messages.order_method1')); ?></div>
                                <?php endif; ?>
                                <?php if($pays->method == 2): ?>
                                    <div><?php echo e(__('messages.order_method2')); ?></div>
                                <?php endif; ?>
                                <?php if($pays->method == 3): ?>
                                    <div><?php echo e(__('messages.order_method3')); ?></div>
                                <?php endif; ?>
                                <?php if($pays->method == 4): ?>
                                    <div><?php echo e(__('messages.order_method4')); ?></div>
                                <?php endif; ?>
                                <?php if($pays->method == 5): ?>
                                    <div><?php echo e(__('messages.order_method5')); ?></div>
                                <?php endif; ?>
                                <?php if($pays->method == 6): ?>
                                    <div><?php echo e(__('messages.order_method6')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($pays->method != 6): ?>
                    <div class="trackPay">
                        <span><?php echo e(__('messages.order_track1')); ?></span>
                        <p><?php echo e($pays->track); ?></p>
                    </div>
                    <?php else: ?>
                    <div class="trackPay">
                        <span><?php echo e(__('messages.order_track1')); ?></span>
                        <p><?php echo e(__('messages.order_track2')); ?></p>
                    </div>
                <?php endif; ?>
                <?php if($pays->note): ?>
                    <div class="trackPay">
                        <span><?php echo e(__('messages.my_note1')); ?></span>
                        <p><?php echo e($pays->note); ?></p>
                    </div>
                    <?php else: ?>
                    <div class="trackPay">
                        <span><?php echo e(__('messages.my_note')); ?></span>
                        <p><?php echo e(__('messages.order_track2')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <?php if($pays->status != 100 && $pays->status != 50): ?>
                <div class="note">
                    <label><?php echo e(__('messages.link_dir')); ?> :</label>
                    <p><?php echo e(url('/fast?order=')); ?><span class="link1"><?php echo e($pays->property); ?></span></p>
                </div>
            <?php endif; ?>
            <?php if($pays->method != 6): ?>
                <div class="allShowPayContainer">
                    <div class="topContainer">
                        <div class="level">
                            <h3><?php echo e(__('messages.order_deliver')); ?> :</h3>
                            <?php if($pays->deliver == 0): ?>
                                <span class="unActive"><?php echo e(__('messages.order_deliver1')); ?></span>
                            <?php endif; ?>
                            <?php if($pays->deliver == 1): ?>
                                <span class="unActive"><?php echo e(__('messages.order_deliver2')); ?></span>
                            <?php endif; ?>
                            <?php if($pays->deliver == 2): ?>
                                <span class="unActive"><?php echo e(__('messages.order_deliver3')); ?></span>
                            <?php endif; ?>
                            <?php if($pays->deliver == 3): ?>
                                <span class="unActive"><?php echo e(__('messages.order_deliver4')); ?></span>
                            <?php endif; ?>
                            <?php if($pays->deliver == 4): ?>
                                <span class="activeStatus"><?php echo e(__('messages.order_deliver5')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="rateItemsCount">
                            <div class="rateItemsCountItem" title="<?php echo e(__('messages.order_deliver1')); ?>">
                                <?php if($pays->deliver >= 1): ?>
                                <div class="rateItemsCountItemBarActive"></div>
                                <?php endif; ?>
                                <?php if($pays->deliver == 0): ?>
                                <div class="rateItemsCountItemBar"></div>
                                <?php endif; ?>
                                <?php if($pays->deliver >= 1): ?>
                                    <div class="rateItemsCountItemCircleActives">
                                        <svg class="icon">
                                            <use xlink:href="#delivery-complete"></use>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <?php if($pays->deliver == 0): ?>
                                <div class="rateItemsCountItemCircleActive">
                                    <svg class="icon">
                                            <use xlink:href="#delivery-complete"></use>
                                        </svg>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="rateItemsCountItem" title="<?php echo e(__('messages.order_deliver2')); ?>">
                                <?php if($pays->deliver >= 2): ?>
                                <div class="rateItemsCountItemBarActive"></div>
                                <?php endif; ?>
                                <?php if($pays->deliver <= 1): ?>
                                <div class="rateItemsCountItemBar"></div>
                                <?php endif; ?>
                                <?php if($pays->deliver >= 2): ?>
                                <div class="rateItemsCountItemCircleActives">
                                    <svg class="icon">
                                        <use xlink:href="#waiting-room"></use>
                                    </svg>
                                </div>
                                <?php endif; ?>
                                <?php if($pays->deliver == 1): ?>
                                <div class="rateItemsCountItemCircleActive">
                                    <svg class="icon">
                                        <use xlink:href="#waiting-room"></use>
                                    </svg>
                                </div>
                                <?php endif; ?>
                                <?php if($pays->deliver <= 0): ?>
                                    <div class="rateItemsCountItemCircle">
                                        <svg class="icon">
                                            <use xlink:href="#waiting-room"></use>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="rateItemsCountItem" title="<?php echo e(__('messages.order_deliver3')); ?>">
                                <?php if($pays->deliver >= 3): ?>
                                <div class="rateItemsCountItemBarActive"></div>
                                <?php endif; ?>
                                <?php if($pays->deliver <= 2): ?>
                                    <div class="rateItemsCountItemBar"></div>
                                <?php endif; ?>
                                <?php if($pays->deliver >= 3): ?>
                                    <div class="rateItemsCountItemCircleActives">
                                        <svg class="icon">
                                            <use xlink:href="#package-delivery"></use>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <?php if($pays->deliver == 2): ?>
                                <div class="rateItemsCountItemCircleActive">
                                    <svg class="icon">
                                        <use xlink:href="#package-delivery"></use>
                                    </svg>
                                </div>
                                <?php endif; ?>
                                <?php if($pays->deliver <= 1): ?>
                                <div class="rateItemsCountItemCircle">
                                    <svg class="icon">
                                        <use xlink:href="#package-delivery"></use>
                                    </svg>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="rateItemsCountItem" title="<?php echo e(__('messages.order_deliver4')); ?>">
                                <?php if($pays->deliver >= 4): ?>
                                <div class="rateItemsCountItemBarActive"></div>
                                <?php endif; ?>
                                <?php if($pays->deliver <= 3): ?>
                                <div class="rateItemsCountItemBar"></div>
                                <?php endif; ?>
                                <?php if($pays->deliver >= 4): ?>
                                <div class="rateItemsCountItemCircleActives">
                                    <svg class="icon">
                                        <use xlink:href="#delivery-truck"></use>
                                    </svg>
                                </div>
                                <?php endif; ?>
                                <?php if($pays->deliver == 3): ?>
                                <div class="rateItemsCountItemCircleActive">
                                    <svg class="icon">
                                        <use xlink:href="#delivery-truck"></use>
                                    </svg>
                                </div>
                                <?php endif; ?>
                                <?php if($pays->deliver <= 2): ?>
                                <div class="rateItemsCountItemCircle">
                                    <svg class="icon">
                                        <use xlink:href="#delivery-truck"></use>
                                    </svg>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="rateItemsCountItem" title="<?php echo e(__('messages.order_deliver5')); ?>">
                                <?php if($pays->deliver == 4): ?>
                                    <div class="rateItemsCountItemCircleActive">
                                        <svg class="icon">
                                            <use xlink:href="#delivery-box"></use>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <?php if($pays->deliver <= 3): ?>
                                    <div class="rateItemsCountItemCircle">
                                        <svg class="icon">
                                            <use xlink:href="#delivery-box"></use>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="code">
                            <h3><?php echo e(__('messages.order_property')); ?> :</h3>
                            <span><?php echo e($pays->property); ?></span>
                        </div>
                    </div>
                    <?php if(count($pays->installments) >= 1): ?>
                        <div class="abilityPost">
                            <div class="abilityTitle">
                                <label><?php echo e(__('messages.order_install1')); ?></label>
                            </div>
                            <ul class="abilityTable">
                                <li>
                                    <h4><?php echo e(__('messages.order_install2')); ?></h4>
                                    <h4><?php echo e(__('messages.order_install3')); ?></h4>
                                    <h4><?php echo e(__('messages.order_install4')); ?></h4>
                                    <h4><?php echo e(__('messages.order_install5')); ?></h4>
                                    <h4><?php echo e(__('messages.order_install6')); ?></h4>
                                </li>
                                <?php $__currentLoopData = $pays->installments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <h4><?php echo e($item->title); ?></h4>
                                    <h4><?php echo e(number_format($item->price)); ?> <?php echo e(__('messages.arz')); ?></h4>
                                    <h4><?php echo e($item->time); ?></h4>
                                    <?php if($item->status == 1): ?>
                                        <h4 class="activeS"><?php echo e(__('messages.order_status2')); ?></h4>
                                    <?php else: ?>
                                        <h4 class="activeF"><?php echo e(__('messages.order_status6')); ?></h4>
                                    <?php endif; ?>
                                    <?php if($item->pay): ?>
                                        <h4 class="activeS"><?php echo e($item->pay); ?></h4>
                                    <?php else: ?>
                                        <h4 class="activeF">-</h4>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="items">
                        <div class="titleProducts">
                            <div class="title"><?php echo e(__('messages.order_products')); ?></div>
                        </div>
                        <?php $__currentLoopData = $pays->payMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <?php if($item->product): ?>
                                    <a href="/product/<?php echo e($item->product->slug); ?>" class="cartDetailPic">
                                        <img src="<?php echo e(json_decode($item->product->image)[0]); ?>" alt="<?php echo e($item->product->title); ?>">
                                    </a>
                                <?php endif; ?>
                                <?php if($item->collection): ?>
                                    <a href="/pack/<?php echo e($item->collection->slug); ?>" class="cartDetailPic">
                                        <img src="<?php echo e($item->collection->image); ?>" alt="<?php echo e($item->collection->title); ?>">
                                    </a>
                                <?php endif; ?>
                                <div class="cartDetailInfo">
                                    <?php if($item->product): ?>
                                        <a href="/product/<?php echo e($item->product->slug); ?>" class="cartDetailInfoItem">
                                            <h3><?php echo e($item->product->title); ?></h3>
                                            <?php if($item->cancel): ?>
                                                <span class="cancel">(<?php echo e(__('messages.order_status7')); ?>)</span>
                                            <?php endif; ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if($item->collection): ?>
                                        <a href="/pack/<?php echo e($item->collection->slug); ?>" class="cartDetailInfoItem">
                                            <h3><?php echo e($item->collection->title); ?></h3>
                                        </a>
                                    <?php endif; ?>
                                    <?php if($item->color): ?>
                                        <div class="cartDetailInfoItem">
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#color"></use>
                                                </svg>
                                            </i>
                                            <span><?php echo e($item->color); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($item->size): ?>
                                        <div class="cartDetailInfoItem">
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#sizeFront"></use>
                                                </svg>
                                            </i>
                                            <span><?php echo e($item->size); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($item->guarantee_name): ?>
                                        <div class="cartDetailInfoItem">
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#security"></use>
                                                </svg>
                                            </i>
                                            <span><?php echo e($item->guarantee_name); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="cartDetailInfoItem">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#post"></use>
                                            </svg>
                                        </i>
                                        <span><?php echo e($item->count); ?></span>
                                    </div>
                                    <div class="cartDetailInfoItem">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#cost"></use>
                                            </svg>
                                        </i>
                                        <span><?php echo e(number_format($item->price)); ?> <?php echo e(__('messages.arz')); ?></span>
                                    </div>
                                    <div class="cartDetailInfoItem">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#car"></use>
                                            </svg>
                                        </i>
                                        <?php if($item->deliver == 0): ?>
                                            <span class="unActive"><?php echo e(__('messages.order_deliver1')); ?></span>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 1): ?>
                                            <span class="unActive"><?php echo e(__('messages.order_deliver2')); ?></span>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 2): ?>
                                            <span class="unActive"><?php echo e(__('messages.order_deliver3')); ?></span>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 3): ?>
                                            <span class="unActive"><?php echo e(__('messages.order_deliver4')); ?></span>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 4): ?>
                                            <span class="activeStatus"><?php echo e(__('messages.order_deliver5')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/home/profile/show.blade.php ENDPATH**/ ?>