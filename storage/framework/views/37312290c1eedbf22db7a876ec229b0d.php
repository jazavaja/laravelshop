<?php $__env->startSection('title' , $post->title .' - '); ?>
<?php $__env->startSection('content'); ?>
    <main class="allSingleIndex3">
        <section class="address width">
            <a href="/"><?php echo e(__('messages.home')); ?></a>
            <?php if(count($post['category']) >= 1): ?>
                <?php $__currentLoopData = $post['category']->slice(0,1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/category/<?php echo e($address->slug); ?>"><?php echo e($address->name); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <a><?php echo e($post->title); ?></a>
        </section>
        <section class="topSingle width">
            <div style="display: none" class="imageContainer resImage">
                <div class="showImage">
                    <?php if($post->lotteryStatus == 1): ?>
                        <div class="lotteryShow"><?php echo e(__('messages.lottery')); ?></div>
                    <?php endif; ?>
                    <img class="zoom lazyload" lazy="loading" src="/img/404Image.png" data-src="" alt="<?php echo e($post->imageAlt); ?>"/>
                </div>
                <div class="imageSlider">
                    <div class="slider-image owl-carousel owl-theme">
                        <?php $__currentLoopData = json_decode($post['image']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <figure>
                                <img class="lazyload" lazy="loading" src="/img/404Image.png" data-src="<?php echo e($item); ?>" alt="<?php echo e($post->imageAlt); ?>">
                            </figure>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="right">
                <h1><?php echo e($post->title); ?></h1>
                <h2><?php echo e($post->titleEn); ?></h2>
                <div class="price">
                    <?php if($levelUser): ?>
                        <?php if($post->levels): ?>
                            <?php if($post['levels'] != '[]'): ?>
                                <?php $__currentLoopData = json_decode($post['levels']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($item->name, $levelUser)): ?>
                                        <div class="priceItem">
                                            <h4><?php echo e(__('messages.price_me')); ?> :</h4>
                                            <div class="prices">
                                                <h5><?php echo e(number_format($post->price)); ?></h5>
                                                <span><?php echo e(__('messages.arz')); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="priceItem">
                                    <h4><?php echo e(__('messages.product_price')); ?> :</h4>
                                    <div class="prices">
                                        <?php if($post->off): ?>
                                            <s><?php echo e(number_format($post->offPrice)); ?></s>
                                            <div class="offData">%<?php echo e($post->off); ?></div>
                                        <?php endif; ?>
                                        <h6><?php echo e(number_format($post->price)); ?></h6>
                                        <span><?php echo e(__('messages.arz')); ?></span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="leftDataItem">
                                    <h4><?php echo e(__('messages.product_price')); ?> :</h4>
                                    <div class="prices">
                                        <?php if($post->off): ?>
                                            <div class="off">
                                                <s><?php echo e(number_format($post->offPrice)); ?></s>
                                                <div class="offData">%<?php echo e($post->off); ?></div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="priceData">
                                            <h5><?php echo e(number_format($post->price)); ?></h5>
                                            <span><?php echo e(__('messages.arz')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="priceItem">
                                <h4><?php echo e(__('messages.product_price')); ?> :</h4>
                                <div class="prices">
                                    <?php if($post->off): ?>
                                        <s><?php echo e(number_format($post->offPrice)); ?></s>
                                        <div class="offData">%<?php echo e($post->off); ?></div>
                                    <?php endif; ?>
                                    <h5><?php echo e(number_format($post->price)); ?></h5>
                                    <span><?php echo e(__('messages.arz')); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="priceItem">
                            <h4><?php echo e(__('messages.product_price')); ?> :</h4>
                            <div class="prices">
                                <?php if($post->off): ?>
                                    <s><?php echo e(number_format($post->offPrice)); ?></s>
                                    <div class="offData">%<?php echo e($post->off); ?></div>
                                <?php endif; ?>
                                <h5><?php echo e(number_format($post->price)); ?></h5>
                                <span><?php echo e(__('messages.arz')); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if($post->size): ?>
                    <?php if($post['size'] != '[]'): ?>
                        <div class="optionAdd">
                            <label for="size"><?php echo e(__('messages.size')); ?></label>
                            <select name="size" id="size">
                                <?php $__currentLoopData = json_decode($post['size']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->name); ?>" data="<?php echo e($item->price); ?>" count="<?php echo e($item->count); ?>"><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(count($post->guarantee) >= 1): ?>
                    <div class="optionAdd">
                        <label for="guarantee"><?php echo e(__('messages.guarantee')); ?></label>
                        <select name="guarantee" id="guarantee">
                            <?php $__currentLoopData = $post['guarantee']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <?php endif; ?>
                <?php if($post->colors): ?>
                    <?php if($post['colors'] != '[]'): ?>
                        <div class="optionAdd colorContainer">
                            <label for="size"><?php echo e(__('messages.color')); ?></label>
                            <div class="swatch clearfix" data-option-index="1">
                                <?php $__currentLoopData = json_decode($post['colors']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div data-value="<?php echo e($item->name); ?>" class="swatch-element color blue available">
                                        <div class="tooltip"><?php echo e($item->name); ?></div>
                                        <input quickbeam="color" id="<?php echo e($item->name); ?>" count="<?php echo e($item->count); ?>" type="radio" name="color" price="<?php echo e($item->price); ?>" value="<?php echo e($item->name); ?>"  />
                                        <label for="<?php echo e($item->name); ?>" style="border-color: <?php echo e($item->color); ?>">
                                            <span style="background-color: <?php echo e($item->color); ?>"></span>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="calls">
                    <a target="_blank" href="https://wa.me/<?php echo e(\App\Models\Setting::where('key' , 'number')->pluck('value')->first()); ?>?text=سلام سوال داشتم در مورد <?php echo e($post->title); ?>">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#whatsapp"></use>
                            </svg>
                        </i>
                        <?php echo e(__('messages.contact1')); ?>

                    </a>
                    <a href="tel:<?php echo e(\App\Models\Setting::where('key' , 'number')->pluck('value')->first()); ?>">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#phone-call"></use>
                            </svg>
                        </i>
                        <?php echo e(__('messages.contact2')); ?>

                    </a>
                </div>
                <div class="addButton" id="addCart">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#cart"></use>
                        </svg>
                    </i>
                    <button><?php echo e(__('messages.add_cart')); ?></button>
                </div>
            </div>
            <div class="imageContainer desc">
                <div class="showImage">
                    <?php if($post->lotteryStatus == 1): ?>
                        <div class="lotteryShow"><?php echo e(__('messages.lottery')); ?></div>
                    <?php endif; ?>
                    <img class="zoom lazyload" lazy="loading" src="/img/404Image.png" data-src="" alt="<?php echo e($post->imageAlt); ?>"/>
                </div>
                <div class="imageSlider">
                    <div class="slider-image owl-carousel owl-theme">
                        <?php $__currentLoopData = json_decode($post['image']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <figure>
                                <img class="lazyload" lazy="loading" src="/img/404Image.png" data-src="<?php echo e($item); ?>" alt="<?php echo e($post->imageAlt); ?>">
                            </figure>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="left">
                <?php if($post->note): ?>
                    <div class="note">
                        <div class="noteTitle">
                            <h6><?php echo e(__('messages.news')); ?></h6>
                            <h6><?php echo e(__('messages.news')); ?></h6>
                        </div>
                        <p><?php echo e($post->note); ?></p>
                    </div>
                <?php endif; ?>
                <?php if($post->ability): ?>
                    <div class="ability">
                        <h4><?php echo e(__('messages.product_property')); ?></h4>
                        <ul>
                            <?php $__currentLoopData = json_decode($post->ability); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <svg class="icon">
                                        <use xlink:href="#checkmark"></use>
                                    </svg>
                                    <span><?php echo e($ability->name); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <svg class="icon">
                                        <use xlink:href="#checkmark"></use>
                                    </svg>
                                    <span><?php echo e(\App\Models\Field::where('id' , $item->field_id)->pluck('name')->first()); ?> : <?php echo e($item->value); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="boxes">
                    <div class="box">
                        <h4><?php echo e(__('messages.cats')); ?> :</h4>
                        <ul>
                            <?php $__currentLoopData = $post['category']->slice(0,1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="/category/<?php echo e($address->slug); ?>"><?php echo e($address->name); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="box">
                        <h4><?php echo e(__('messages.brand')); ?> :</h4>
                        <ul>
                            <?php $__currentLoopData = $post['brand']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="/brand/<?php echo e($address->slug); ?>"><?php echo e($address->name); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="scoreProduct">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#score"></use>
                        </svg>
                    </i>
                    <span>
                            <?php echo e(__('messages.receive')); ?>

                        <?php if($post->score): ?>
                            <span><?php echo e($post->score); ?></span>
                        <?php else: ?>
                            <span>0</span>
                        <?php endif; ?>
                        <?php echo e(__('messages.score_buy')); ?>

                        </span>
                </div>
                <div class="gifOptions options">
                    <a href="/gift" class="warnGift">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#gift"></use>
                            </svg>
                        </i>
                        <p><?php echo e(__('messages.get_discount')); ?></p>
                    </a>
                    <a href="#videos" class="productVideo">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#video"></use>
                            </svg>
                        </i>
                        <p><?php echo e(__('messages.product_video')); ?></p>
                    </a>
                    <div class="optionItem" name="quickBuy" title="<?php echo e(__('messages.order_method4')); ?>" id="<?php echo e($post->id); ?>">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#time-fast"></use>
                            </svg>
                        </i>
                        <p><?php echo e(__('messages.order_method4')); ?></p>
                    </div>
                    <div class="optionItem" name="counselingBtn" title="<?php echo e(__('messages.counseling_fast')); ?>" data="<?php echo e($post->title); ?>" id="<?php echo e($post->id); ?>">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#counseling"></use>
                            </svg>
                        </i>
                        <p><?php echo e(__('messages.counseling_fast')); ?></p>
                    </div>
                </div>
            </div>
        </section>
        <?php if(count($post->collection) >= 1): ?>
            <?php $__currentLoopData = $post->collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="collectionProduct width">
                    <div class="rightCollect">
                        <a href="/product/<?php echo e($post->slug); ?>" class="collectProduct">
                            <div class="pic">
                                <img src="<?php echo e(json_decode($post->image)[0]); ?>" alt="<?php echo e($post->titleSeo); ?>">
                            </div>
                            <h6><?php echo e($post->product_id); ?></h6>
                            <h4><?php echo e($post->title); ?></h4>
                        </a>
                        <?php $__currentLoopData = $item->product->slice(0,1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="/product/<?php echo e($value->slug); ?>" class="collectProduct">
                                <div class="pic">
                                    <img src="<?php echo e(json_decode($value->image)[0]); ?>" alt="<?php echo e($value->titleSeo); ?>">
                                </div>
                                <h6><?php echo e($value->product_id); ?></h6>
                                <h4><?php echo e($value->title); ?></h4>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="leftCollect">
                        <a class="titleCollect" href="/pack/<?php echo e($item->slug); ?>"><?php echo e($item->title); ?></a>
                        <ul>
                            <?php $__currentLoopData = $item->product->slice(0,2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <h3>
                                        <?php echo e($value->title); ?>

                                        <span><?php echo e(number_format($value->price)); ?> <?php echo e(__('messages.arz')); ?> </span>
                                    </h3>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(count($item->product) >= 3): ?>
                                <li>
                                    <h3><?php echo e(__('messages.and')); ?></h3>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <div class="collectPrice">
                            <?php if($item->off): ?>
                                <s><?php echo e(number_format($item->offPrice)); ?></s>
                            <?php endif; ?>
                            <h5><?php echo e(number_format($item->price)); ?></h5>
                        </div>
                        <div class="addCollect" id="<?php echo e($item->id); ?>">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#cart"></use>
                                </svg>
                            </i>
                            <button id="addCartPack"><?php echo e(__('messages.add_cart')); ?></button>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if(count($post->product) >= 1): ?>
            <div class="sellers width">
                <div class="titleSeller">
                    <svg class="icon">
                        <use xlink:href="#seller"></use>
                    </svg>
                    <?php echo e(__('messages.product_sellers')); ?>

                </div>
                <ul>
                    <?php $__currentLoopData = $post->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="postItem">
                                <div class="postTop">
                                    <div class="postTitle">
                                        <div class="postImages">
                                            <div class="postImage">
                                                <?php if($item->user->profile): ?>
                                                    <img class="lazyload" src="/img/404Image.png" data-src="<?php echo e($item->user->profile); ?>" alt="<?php echo e($item->user->name); ?>">
                                                <?php else: ?>
                                                    <img src="/img/user.png" alt="<?php echo e($item->user->name); ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <ul id="<?php echo e($item->id); ?>">
                                            <li>
                                                <span><?php echo e(__('messages.seller_user')); ?> :</span>
                                                <a href="/mall/<?php echo e($item->user->slug); ?>"><?php echo e($item->user->name); ?></a>
                                            </li>
                                            <?php if($item->size): ?>
                                                <?php if($item['size'] != '[]'): ?>
                                                    <li>
                                                        <label for="size"><?php echo e(__('messages.size')); ?> :</label>
                                                        <select name="size" id="size">
                                                            <?php $__currentLoopData = json_decode($item['size']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($value->name); ?>" data="<?php echo e($value->price); ?>"><?php echo e($value->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if($item->colors): ?>
                                                <?php if($item['colors'] != '[]'): ?>
                                                    <li>
                                                        <label for="colors"><?php echo e(__('messages.color')); ?> :</label>
                                                        <select name="colors" id="colors">
                                                            <?php $__currentLoopData = json_decode($item['colors']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($value->name); ?>" data="<?php echo e($value->price); ?>"><?php echo e($value->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(count($item->guarantee) >= 1): ?>
                                                <li>
                                                    <label for="guarantee"><?php echo e(__('messages.guarantee')); ?> :</label>
                                                    <select name="guarantee" id="guarantee">
                                                        <?php $__currentLoopData = json_decode($item['guarantee']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </li>
                                            <?php endif; ?>
                                            <li>
                                                <span><?php echo e(__('messages.price1')); ?> :</span>
                                                <span><?php echo e(number_format($item->price)); ?> <?php echo e(__('messages.arz')); ?> </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="postOptions">
                                        <i title="<?php echo e(__('messages.add_cart')); ?>" class="addCart" id="<?php echo e($item->id); ?>">
                                            <svg class="icon">
                                                <use xlink:href="#cart"></use>
                                            </svg>
                                            <?php echo e(__('messages.add_cart')); ?>

                                        </i>
                                    </div>
                                </div>
                                <div class="postBot">
                                    <ul>
                                        <li>
                                            <span><?php echo e(__('messages.seller2')); ?> :</span>
                                            <span>%100</span>
                                        </li>
                                        <li>
                                            <span><?php echo e(__('messages.seller3')); ?> :</span>
                                            <span>%100</span>
                                        </li>
                                        <li>
                                            <span><?php echo e(__('messages.seller4')); ?> :</span>
                                            <span>%100</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if(count($post->lottery) >= 1): ?>
            <div class="allLotterySingle width">
                <div class="title">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#diploma"></use>
                        </svg>
                    </i>
                    <h4><?php echo e(__('messages.lottery')); ?></h4>
                </div>
                <div class="items">
                    <?php $__currentLoopData = $post->lottery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <div class="titleItem" id="topLottery">
                                <div class="right">
                                    <span><?php echo e(__('messages.lottery_status')); ?> :</span>
                                    <?php if($item->status == 1): ?>
                                        <span><?php echo e(__('messages.done1')); ?></span>
                                    <?php else: ?>
                                        <span><?php echo e(__('messages.wait2')); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="left">
                                    <span><?php echo e($item->created_at); ?></span>
                                    <?php if(count($item->winner) >= 1): ?>
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#down"></use>
                                            </svg>
                                        </i>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if(count($item->winner) >= 1): ?>
                                <div class="bot">
                                    <table>
                                        <tr>
                                            <th><?php echo e(__('messages.winner_code')); ?></th>
                                            <th><?php echo e(__('messages.user_name')); ?></th>
                                        </tr>
                                        <?php $__currentLoopData = $item->winner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <span><?php echo e($value->code); ?></span>
                                                </td>
                                                <td>
                                                    <span><?php echo e($value->user->name); ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if(count($post->tag) >= 1): ?>
            <div class="tags width">
                <h5><?php echo e(__('messages.tags')); ?> :</h5>
                <ul>
                    <?php $__currentLoopData = $post->tag; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="/tag/<?php echo e($item->slug); ?>" title="<?php echo e($item->nameSeo); ?>">#<?php echo e($item->name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if(count($related) >= 1): ?>
            <section class="allProductList width">
                <div class="title">
                    <h3><?php echo e(__('messages.product_rel')); ?></h3>
                </div>
                <div class="slider-productList owl-carousel owl-theme">
                    <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <a href="/product/<?php echo e($item->slug); ?>" title="<?php echo e($item->titleSeo); ?>" name="<?php echo e($item->title); ?>">
                                <article>
                                    <figure class="pic">
                                        <?php if($item->image != '[]'): ?>
                                            <img lazy="loading" class="lazyload" style="height:15rem" src="/img/404Image.png" data-src="<?php echo e(json_decode($item->image)[0]); ?>" alt="<?php echo e($item->imageAlt); ?>">
                                            <?php if(count(json_decode($item->image)) >= 2): ?>
                                                <img lazy="loading" class="lazyload" style="height:15rem" src="/img/404Image.png" data-src="<?php echo e(json_decode($item->image)[1]); ?>" alt="<?php echo e($item->imageAlt); ?>">
                                            <?php else: ?>
                                                <img lazy="loading" class="lazyload" style="height:15rem" src="/img/404Image.png" data-src="<?php echo e(json_decode($item->image)[0]); ?>" alt="<?php echo e($item->imageAlt); ?>">
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
                                            <div class="optionItem" name="addCart" title="<?php echo e(__('messages.add_cart')); ?>"  id="<?php echo e($item->id); ?>">
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
                                            <h5><?php echo e(number_format($item->price)); ?> <?php echo e(__('messages.arz')); ?></h5>
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
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endif; ?>
        <section class="detailProducts width">
            <div class="detailProduct">
                <div class="tabs">
                    <a href="#body"><?php echo e(__('messages.body')); ?></a>
                    <a href="#properties"><?php echo e(__('messages.product_property2')); ?></a>
                    <a href="#comment"><?php echo e(__('messages.comments')); ?></a>
                    <a href="#videos"><?php echo e(__('messages.videos')); ?></a>
                </div>
                <div class="body">
                    <div class="bodyItem" id="body">
                        <h3>
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#review"></use>
                                </svg>
                            </i>
                            <?php echo e(__('messages.body1')); ?>

                        </h3>
                        <p><?php echo e($post->short); ?></p>
                    </div>
                    <?php if($post->body): ?>
                        <div class="bodyItem">
                            <h3>
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#review"></use>
                                    </svg>
                                </i>
                                <?php echo e(__('messages.body2')); ?>

                            </h3>
                            <p><?php echo $post->body; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if($post->specifications): ?>
                    <div class="property">
                        <h3 id="properties">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#off-tag"></use>
                                </svg>
                            </i>
                            <?php echo e(__('messages.techno_body')); ?>

                        </h3>
                        <ul>
                            <?php $__currentLoopData = json_decode($post->specifications); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <h4>
                                        <span><?php echo e($item->title); ?></span>
                                    </h4>
                                    <p>
                                        <span><?php echo e($item->body); ?></span>
                                    </p>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php echo $__env->make('home.single.comment' , ['post' => $post , 'comments' => $comments], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if($post->video): ?>
                    <div class="video">
                        <h3 id="videos">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#video"></use>
                                </svg>
                            </i>
                            <?php echo e(__('messages.product_videos')); ?>

                        </h3>
                        <ul>
                            <?php $__currentLoopData = $post->video; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <video
                                        id="vid1"
                                        controls
                                        preload="auto" width="640" height="264"
                                        class="video-js vjs-fluid vjs-default-skin vjs-big-play-centered"
                                        data-setup="{}"
                                        poster="<?php echo e(json_decode($post->image)[0]); ?>"
                                        style="height: 100%;"
                                    >
                                        <source src="<?php echo e($item->url); ?>" type="video/mp4">
                                    </video>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <div class="detailBox">
                    <div class="pic">
                        <img src="<?php echo e(json_decode($post['image'])[0]); ?>" alt="<?php echo e($post->titleSeo); ?>">
                    </div>
                    <h3><?php echo e($post->title); ?></h3>
                    <h4 id="finalP"><?php echo e($post->price); ?></h4>
                    <div class="addButton" id="addCart">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#cart"></use>
                            </svg>
                        </i>
                        <button><?php echo e(__('messages.add_cart')); ?></button>
                    </div>
                </div>
            </div>
        </section>
        <div class="allShare">
            <?php echo $__env->make('home.single.share' , ['slug' => $post->product_id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="allNotification">
            <?php echo $__env->make('home.single.notification' , ['product_id' => $post->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="allChart">
            <?php echo $__env->make('home.single.chart' , ['product_id' => $post->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="all3DSingle">
            <div class="all3DSingleItems">
                <div class="title360Single">
                    <?php echo e(__('messages.show360')); ?>

                    <i>
                        <svg class="icon">
                            <use xlink:href="#cancel"></use>
                        </svg>
                    </i>
                </div>
                <div id="product360"></div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/blowup.min.js"></script>
    <link rel="stylesheet" href="/css/owl.carousel.min.css"/>
    <script src="/js/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="/css/jquery.raty.css"/>
    <script src="/js/jquery.raty.js"></script>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <script src="/js/jquery.toast.min.js"></script>
    <script src="/js/spritespin.min.js"></script>
    <script src="/js/chart.js"></script>
    <script src="/js/countdown.min.js"></script>
    <script src="/js/photoviewer.js"></script>
    <link rel="stylesheet" href="/css/photoviewer.css"/>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php echo $__env->make('feed::links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script1'); ?>
    <script>
        $(document).mouseup(function(e)
        {
            var container = $(".showAllShare");
            if (container.is(e.target) && container.has(e.target).length == 0)
            {
                $('.allShare').hide();
            }
        });
        $(document).ready(function(){
            var post = <?php echo $post->toJson(); ?>;
            var priceChange = <?php echo $priceChange->toJson(); ?>;
            var finalPrices = <?php echo json_encode($finalPrices, JSON_HEX_TAG); ?>;
            var images = JSON.parse(post.image);
            var price = finalPrices;
            var price2 = post.price;
            var color = '';
            var size = '';
            var guarantee = '';
            var unavailable1 = <?php echo json_encode(__('messages.unavailable1'), JSON_HEX_TAG); ?>;
            $('.countdown').each(function() {
                    var $this = $(this), finalDate = $(this).attr('data-time');
                    $this.countdown(finalDate, function(event) {
                            $this.html(event.strftime(''
                                + '<span class="countdown-section"><span class="countdown-time">%D</span></span>'
                                + '<span class="countdown-section"><span class="countdown-time">%H</span></span>'
                                + '<span class="countdown-section"><span class="countdown-time">%M</span></span>'
                                + '<span class="countdown-section"><span class="countdown-time">%S</span></span>'));
                        }
                    );
                }
            );
            if(post.colors){
                if(post.colors.length){
                    if(JSON.parse(post.colors)[0]){
                        color = JSON.parse(post.colors)[0].name;
                        if(JSON.parse(post.colors)[0].count <= 0){
                            $('.topSingle .addButton').remove();
                            $('.topSingle .emptyProduct').remove();
                            $('.detailProducts .addButton').remove();
                            $('.detailProducts .emptyProduct').remove();
                            $('.topSingle .left').append(
                                $('<div class="emptyProduct"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+unavailable1+'</button></div>')
                            )
                            $('.detailProducts .detailBox').append(
                                $('<div class="emptyProduct"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+unavailable1+'</button></div>')
                            )
                        }
                    }
                }
            }
            if(post.size){
                if(post.size.length){
                    if(JSON.parse(post.size)[0]){
                        size = JSON.parse(post.size)[0].name;
                        if(JSON.parse(post.size)[0].count <= 0){
                            $('.topSingle .addButton').remove();
                            $('.topSingle .emptyProduct').remove();
                            $('.detailProducts .addButton').remove();
                            $('.detailProducts .emptyProduct').remove();
                            $('.topSingle .left').append(
                                $('<div class="emptyProduct"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+unavailable1+'</button></div>')
                            )
                            $('.detailProducts .detailBox').append(
                                $('<div class="emptyProduct"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+unavailable1+'</button></div>')
                            )
                        }
                    }
                }
            }
            var prebuy1 = <?php echo json_encode(__('messages.prebuy'), JSON_HEX_TAG); ?>;
            if(post.count <= 0){
                if(post.prebuy == 1){
                    $('.topSingle .addButton').remove();
                    $('.topSingle .emptyProduct').remove();
                    $('.detailProducts .addButton').remove();
                    $('.detailProducts .emptyProduct').remove();
                    $('.topSingle .left').append(
                        $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+prebuy1+'</button></div>')
                    )
                    $('.detailProducts .detailBox').append(
                        $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+prebuy1+'</button></div>')
                    )
                }else{
                    $('.topSingle .addButton').remove();
                    $('.topSingle .emptyProduct').remove();
                    $('.detailProducts .addButton').remove();
                    $('.detailProducts .emptyProduct').remove();
                    $('.topSingle .left').append(
                        $('<div class="emptyProduct"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+unavailable1+'</button></div>')
                    )
                    $('.detailProducts .detailBox').append(
                        $('<div class="emptyProduct"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+unavailable1+'</button></div>')
                    )
                }
            }
            if(post.guarantee.length){
                guarantee = post.guarantee[0].id;
            }
            $('#show3DImage').on('click' , function (){
                $('.all3DSingle').show();
            })
            $('.all3DSingle .title360Single i').on('click' , function (){
                $('.all3DSingle').hide();
            })
            $('.allLotterySingle #topLottery').on('click' , function (){
                $(this.nextElementSibling).toggle();
            })
            $('.slider-productList').owlCarousel({
                loop:false,
                rtl:true,
                nav:true,
                items:6,
                responsive:{
                    0:{
                        items:2,
                    },
                    800:{
                        items:5,
                    }
                }
            })
            $(".topSingle input[name='color']:first").prop("checked", true );
            getPrice()
            function makePrice(){
                price += '';
                x = price.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                var finalPrice2 = x1 + x2;
                $('.topSingle .prices h5').text(finalPrice2);
                $('.detailBox #finalP').text(finalPrice2);
            }
            function makePrice2(){
                price2 += '';
                x = price2.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                var finalPrice2 = x1 + x2;
                $('.topSingle .prices h6').text(finalPrice2);
            }

            $(".allSingleIndex3 #product360").spritespin({
                source: post.image3d,
                width: 480,
                height: 327,
                frames: post.imageCount3d,
                framesX: post.imageFirstCount,
                sense: -1,
                animate   : false,
                responsive: true,
                plugins: [
                    'progress',
                    '360',
                    'drag'
                ]
            });

            var success1 = <?php echo json_encode(__('messages.success'), JSON_HEX_TAG); ?>;
            var add_cart1 = <?php echo json_encode(__('messages.add_cart'), JSON_HEX_TAG); ?>;
            var add_cart21 = <?php echo json_encode(__('messages.add_cart2'), JSON_HEX_TAG); ?>;
            var number2 = <?php echo json_encode(__('messages.number'), JSON_HEX_TAG); ?>;
            var arz2 = <?php echo json_encode(__('messages.arz'), JSON_HEX_TAG); ?>;
            var login_attention1 = <?php echo json_encode(__('messages.login_attention'), JSON_HEX_TAG); ?>;
            var error1 = <?php echo json_encode(__('messages.error1'), JSON_HEX_TAG); ?>;
            var unavailable_color = <?php echo json_encode(__('messages.unavailable_color'), JSON_HEX_TAG); ?>;
            var unavailable_size = <?php echo json_encode(__('messages.unavailable_size'), JSON_HEX_TAG); ?>;
            var wait1 = <?php echo json_encode(__('messages.wait'), JSON_HEX_TAG); ?>;
            var no_count1 = <?php echo json_encode(__('messages.no_count'), JSON_HEX_TAG); ?>;
            var count11 = <?php echo json_encode(__('messages.count1'), JSON_HEX_TAG); ?>;
            var max_cart1 = <?php echo json_encode(__('messages.max_cart1'), JSON_HEX_TAG); ?>;
            var max22 = <?php echo json_encode(__('messages.max2'), JSON_HEX_TAG); ?>;
            $('.sellers .postOptions i').on('click',function(){
                var sizeSeller = $('.sellers '+'#'+$(this).attr('id')+" select[name='size'] option:selected").val();
                var colorSeller = $('.sellers '+'#'+$(this).attr('id')+" select[name='colors'] option:selected").val();
                var guaranteeSeller = $('.sellers '+'#'+$(this).attr('id')+" select[name='guarantee'] option:selected").val();
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "color": colorSeller,
                    "size": sizeSeller,
                    "guarantee": guaranteeSeller,
                    "product": $(this).attr('id'),
                };
                $.ajax({
                    url: "/add-cart",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $.toast({
                            text: add_cart21, // Text that is to be shown in the toast
                            heading: success1, // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                        });
                        $.each($('#showCartLi li'), function(key,value) {
                            this.remove();
                        });
                        var count = 0;
                        $.each(data[1],function(){
                            count = count +this.count;
                            var prices = cartPrice(this.price*this.count);
                            $('#showCartLi').append(
                                $('<li id="'+this.slug+'" pack="'+this.pack+'" count="'+this.count+'" price="'+this.price+'"><div class="cartPic">' +
                                    (this.pack == 1 ? '<a href="/pack/'+this.slug+'"><img src="'+this.image+'" alt="'+this.title+'"></a>':'<a href="/product/'+this.slug+'"><img src="'+JSON.parse(this.image)[0]+'" alt="'+this.title+'"></a>') +
                                    '</div><div class="cartText"><div class="cartTitle"><h4>'+this.title+
                                    (this.color ? '<h4> - '+this.color+'</h4>': '')+
                                    (this.size ? '<h4> - '+this.size+'</h4>': '') +
                                    (this.count ? '<h4 class="countCart"> - '+this.count+number2+' </h4>': '') +
                                    '</h4><i id="deleteCart" pack="'+this.pack+'" size="'+this.size+'" color="'+this.color+'" guarantee="'+this.guarantee_id+'" product="'+this.product+'"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></div><div class="cartTextItem"><div class="cartPrice"><span>'+prices+'</span></div></div></div></li>')
                                    .on('click' , '#deleteCart',function(ss){
                                        $('.allLoading').show();
                                        var form = {
                                            "_token": "<?php echo e(csrf_token()); ?>",
                                            "color": $(this).attr('color'),
                                            "size": $(this).attr('size'),
                                            "pack": $(this).attr('pack'),
                                            "guarantee": $(this).attr('guarantee'),
                                            "product": $(this).attr('product'),
                                        };

                                        $.ajax({
                                            url: "/delete-cart",
                                            type: "post",
                                            data: form,
                                            success: function (data) {
                                                $('.allLoading').hide();
                                                if(window.location.pathname == '/checkout'){
                                                    window.location.reload();
                                                }else{
                                                    var cartCounts = $('.cartShowBtn h5').text();
                                                    $('.cartShowBtn h5').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                    $('#allCountCart span').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                    $('.tabs .active span').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                    $('#allPrice2 h3').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                    $('#allPrice1 span').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))) + ' ' + arz2);
                                                    $('#allPrice2 h3').attr('id',parseInt($('#allPrice2 h3').attr('id') - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                    $('#allPrice1 span').attr('id',parseInt($('#allPrice2 h3').attr('id') - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                    $('.cartIndex .cartItems #'+$(ss.currentTarget.parentElement.parentElement.parentElement).attr('id')).remove();
                                                    if($('.cartShowBtn h5').text() <= 0){
                                                        $('.showCartEmpty').show();
                                                        $('.allCartIndexEmpty').show();
                                                        $('.cartIndex').hide();
                                                        $('.topCartIndex').hide();
                                                    }
                                                    ss.currentTarget.parentElement.parentElement.parentElement.remove();
                                                }
                                            },
                                        });
                                    })
                            );
                        })
                        if(data[1].length){
                            $('.headerCart .showCartEmpty').hide();
                        }
                        $('.cartShowBtn h5').text(count);
                    },
                    error: function (xhr) {
                        $.toast({
                            text: error1, // Text that is to be shown in the toast
                            heading: login_attention1, // Optional heading to be shown on the toast
                            icon: 'error', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',
                            loader: true,
                            loaderBg: '#c60000',
                        });
                    }
                });
            })
            $('.topSingle .colorContainer input').on('change' , function(){
                color = $(this).attr('id');
                size = $(".topSingle select[name='size']").val();
                if($(this).attr('count') <= 0){
                    $('.topSingle .addButton').remove();
                    $('.topSingle .emptyProduct').remove();
                    $('.detailProducts .addButton').remove();
                    $('.detailProducts .emptyProduct').remove();
                    if(post.prebuy == 1 && post.count <= 0){
                        $('.topSingle .left').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+prebuy1+'</button></div>')
                        )
                        $('.detailProducts .detailBox').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+prebuy1+'</button></div>')
                        )
                    }else{
                        $('.topSingle .left').append(
                            $('<div class="emptyProduct"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+unavailable_color+'</button></div>')
                        )
                        $('.detailProducts .detailBox').append(
                            $('<div class="emptyProduct"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+unavailable_color+'</button></div>')
                        )
                    }
                }
                else{
                    $('.topSingle .addButton').remove();
                    $('.topSingle .emptyProduct').remove();
                    $('.detailProducts .addButton').remove();
                    $('.detailProducts .emptyProduct').remove();
                    if(post.prebuy == 1 && post.count <= 0){
                        $('.topSingle .right').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+prebuy1+'</button></div>')
                        )
                        $('.detailProducts .detailBox').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+prebuy1+'</button></div>')
                        )
                    }else{
                        $('.topSingle .right').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+add_cart1+'</button></div>')
                        )
                        $('.detailProducts .detailBox').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+add_cart1+'</button></div>')
                        )
                    }
                }
                getPrice()
            })
            $(".topSingle select[name='size']").on('change' , function(){
                color = $(".topSingle input[name='color']:checked").attr('id');
                size = $(".topSingle select[name='size'] option:selected").attr('value');
                if($(".topSingle select[name='size'] option:selected").attr('count') <= 0){
                    $('.topSingle .addButton').remove();
                    $('.topSingle .emptyProduct').remove();
                    $('.detailProducts .addButton').remove();
                    $('.detailProducts .emptyProduct').remove();
                    if(post.prebuy == 1 && post.count <= 0){
                        $('.topSingle .right').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+prebuy1+'</button></div>')
                        )
                        $('.detailProducts .detailBox').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+prebuy1+'</button></div>')
                        )
                    }else{
                        $('.topSingle .right').append(
                            $('<div class="emptyProduct"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+unavailable_size+'</button></div>')
                        )
                        $('.detailProducts .detailBox').append(
                            $('<div class="emptyProduct"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+unavailable_size+'</button></div>')
                        )
                    }
                }
                else{
                    $('.topSingle .addButton').remove();
                    $('.topSingle .emptyProduct').remove();
                    $('.detailProducts .addButton').remove();
                    $('.detailProducts .emptyProduct').remove();
                    if(post.prebuy == 1 && post.count <= 0){
                        $('.topSingle .right').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+prebuy1+'</button></div>')
                        )
                        $('.detailProducts .detailBox').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+prebuy1+'</button></div>')
                        )
                    }else{
                        $('.topSingle .right').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+add_cart1+'</button></div>')
                        )
                        $('.detailProducts .detailBox').append(
                            $('<div class="addButton" id="addCart"><i><svg class="icon"><use xlink:href="#cart"></use></svg></i><button>'+add_cart1+'</button></div>')
                        )
                    }
                }
                getPrice()
            })
            $(".topSingle select[name='guarantee']").on('change' , function(){
                guarantee = $(".topSingle select[name='guarantee'] option:selected").attr('value');
            })
            $('.topSingle .zoom').attr('src' , images[0]);
            if(window.innerWidth >= 800){
                $(".topSingle .desc .zoom").blowup({
                    "scale" : 1
                })
            }
            $('.slider-image').owlCarousel({
                loop:false,
                rtl:true,
                nav:true,
                margin:10,
                items:4
            })
            $('.slider-image img').on('click' , function(){
                $('.zoom').attr('src' , this.currentSrc);
                $(".topSingle .desc .zoom").blowup({
                    "scale" : 1
                })
            })
            $('.options #share').on('click' , function(){
                $('.allShare').show();
            })
            $('.allSingleIndex3 .allNotification').hide();
            $('.allSingleIndex3 .options #notificationBtn').on('click' , function(){
                $('.allNotification').show();
            })
            $('.allChart .closeChart').on('click' , function(){
                $('.allChart').hide();
            })
            $('.allSingleIndex3 .options #charts').on('click' , function(){
                $('.allChart').show();
            })
            $(document).on('click','#addCart',function (){
                var addButtonText = $(this).find('button').text();
                $(this).find('button').text(wait1);
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "color": color,
                    "size": size,
                    "guarantee": guarantee,
                    "product": post.id,
                };

                $.ajax({
                    url: "/add-cart",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $('.topSingle #addCart').find('button').text(addButtonText);
                        $('.detailProducts #addCart').find('button').text(addButtonText);
                        if (data == 'limit'){
                            $.toast({
                                text: no_count1, // Text that is to be shown in the toast
                                heading: count11, // Optional heading to be shown on the toast
                                icon: 'error', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#c60000',  // Background color of the toast loader
                            });
                        }else if (data == 'maxCart'){
                            $.toast({
                                text: max_cart1, // Text that is to be shown in the toast
                                heading: max22, // Optional heading to be shown on the toast
                                icon: 'error', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#c60000',  // Background color of the toast loader
                            });
                        }else{
                            $.toast({
                                text: add_cart21, // Text that is to be shown in the toast
                                heading: success1, // Optional heading to be shown on the toast
                                icon: 'success', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#9EC600',  // Background color of the toast loader
                            });
                            $.each($('#showCartLi li'), function(key,value) {
                                this.remove();
                            });
                            var count = 0;
                            $.each(data[1],function(){
                                count = parseInt(count) + parseInt(this.count);
                                var prices = cartPrice(this.price*this.count);
                                $('#showCartLi').append(
                                    $('<li id="'+this.slug+'" pack="'+this.pack+'" count="'+this.count+'" price="'+this.price+'"><div class="cartPic">' +
                                        (this.pack == 1 ? '<a href="/pack/'+this.slug+'"><img src="'+this.image+'" alt="'+this.title+'"></a>':'<a href="/product/'+this.slug+'"><img src="'+JSON.parse(this.image)[0]+'" alt="'+this.title+'"></a>') +
                                        '</div><div class="cartText"><div class="cartTitle"><h4>'+this.title+
                                        (this.color ? '<h4> - '+this.color+'</h4>': '')+
                                        (this.size ? '<h4> - '+this.size+'</h4>': '') +
                                        (this.count ? '<h4 class="countCart"> - '+this.count+number2+' </h4>': '') +
                                        '</h4><i id="deleteCart" pack="'+this.pack+'" size="'+this.size+'" color="'+this.color+'" guarantee="'+this.guarantee_id+'" product="'+this.product+'"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></div><div class="cartTextItem"><div class="cartPrice"><span>'+prices+'</span></div></div></div></li>')
                                        .on('click' , '#deleteCart',function(ss){
                                            $('.allLoading').show();
                                            var form = {
                                                "_token": "<?php echo e(csrf_token()); ?>",
                                                "color": $(this).attr('color'),
                                                "size": $(this).attr('size'),
                                                "guarantee": $(this).attr('guarantee'),
                                                "pack": $(this).attr('pack'),
                                                "product": $(this).attr('product'),
                                            };

                                            $.ajax({
                                                url: "/delete-cart",
                                                type: "post",
                                                data: form,
                                                success: function (data) {
                                                    $('.allLoading').hide();
                                                    if(window.location.pathname == '/checkout'){
                                                        window.location.reload();
                                                    }else{
                                                        var cartCounts = $('.cartShowBtn h5').text();
                                                        $('.cartShowBtn h5').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                        $('#allCountCart span').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                        $('.tabs .active span').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                        $('#allPrice2 h3').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                        $('#allPrice1 span').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))) + ' ' + arz2);
                                                        $('#allPrice2 h3').attr('id',parseInt($('#allPrice2 h3').attr('id') - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                        $('#allPrice1 span').attr('id',parseInt($('#allPrice2 h3').attr('id') - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                        $('.cartIndex .cartItems #'+$(ss.currentTarget.parentElement.parentElement.parentElement).attr('id')).remove();
                                                        if($('.cartShowBtn h5').text() <= 0){
                                                            $('.showCartEmpty').show();
                                                            $('.allCartIndexEmpty').show();
                                                            $('.cartIndex').hide();
                                                            $('.topCartIndex').hide();
                                                        }
                                                        ss.currentTarget.parentElement.parentElement.parentElement.remove();
                                                    }
                                                },
                                            });
                                        })
                                );
                            })
                            if(data[1].length){
                                $('.headerCart .showCartEmpty').hide();
                            }
                            $('.cartShowBtn h5').text(parseInt(count));
                            $('.postCount span').text(parseInt(count));
                        }
                    },
                    error: function (xhr) {
                        $('#addCart').find('button').text(addButtonText);
                        $.toast({
                            text: error1, // Text that is to be shown in the toast
                            heading: login_attention1, // Optional heading to be shown on the toast
                            icon: 'error', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',
                            loader: true,
                            loaderBg: '#c60000',
                        });
                    }
                });
            });

            var like_add = <?php echo json_encode(__('messages.like_add'), JSON_HEX_TAG); ?>;
            var book_add = <?php echo json_encode(__('messages.book_add'), JSON_HEX_TAG); ?>;
            var log_first = <?php echo json_encode(__('messages.log_first'), JSON_HEX_TAG); ?>;
            var need_login2 = <?php echo json_encode(__('messages.need_login2'), JSON_HEX_TAG); ?>;
            var like_delete = <?php echo json_encode(__('messages.like_delete'), JSON_HEX_TAG); ?>;
            var book_delete = <?php echo json_encode(__('messages.book_delete'), JSON_HEX_TAG); ?>;
            var price1 = <?php echo json_encode(__('messages.price1'), JSON_HEX_TAG); ?>;
            $('#likeBtn').click(function (){
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "product": post.id,
                };

                $.ajax({
                    url: "/like",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if(data == 'success'){
                            $.toast({
                                text: like_add, // Text that is to be shown in the toast
                                heading: success1, // Optional heading to be shown on the toast
                                icon: 'success', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#9EC600',  // Background color of the toast loader
                            });
                            $('#likeBtn svg').remove();
                            $('#likeBtn').append(
                                $('<svg class="icon"><use xlink:href="#like"></use></svg>')
                            );
                        }
                        if(data == 'noUser'){
                            $.toast({
                                text: log_first, // Text that is to be shown in the toast
                                heading: need_login2, // Optional heading to be shown on the toast
                                icon: 'error', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#c60000',
                            });
                        }
                        if(data == 'delete'){
                            $.toast({
                                text: like_delete, // Text that is to be shown in the toast
                                heading: success1, // Optional heading to be shown on the toast
                                icon: 'success', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#9EC600',  // Background color of the toast loader
                            });
                            $('#likeBtn svg').remove();
                            $('#likeBtn').append(
                                $('<svg class="icon"><use xlink:href="#unlike"></use></svg>')
                            );
                        }
                    },
                });
            });

            $('#bookmarkBtn').click(function (){
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "product": post.id,
                };

                $.ajax({
                    url: "/bookmark",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if(data == 'success'){
                            $.toast({
                                text: book_add, // Text that is to be shown in the toast
                                heading: success1, // Optional heading to be shown on the toast
                                icon: 'success', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#9EC600',  // Background color of the toast loader
                            });
                            $('#bookmarkBtn svg').remove();
                            $('#bookmarkBtn').append(
                                $('<svg class="icon"><use xlink:href="#bookmark"></use></svg>')
                            );
                        }
                        if(data == 'noUser'){
                            $.toast({
                                text: log_first, // Text that is to be shown in the toast
                                heading: need_login2, // Optional heading to be shown on the toast
                                icon: 'error', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#c60000',
                            });
                        }
                        if(data == 'delete'){
                            $.toast({
                                text: book_delete, // Text that is to be shown in the toast
                                heading: success1, // Optional heading to be shown on the toast
                                icon: 'success', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#9EC600',  // Background color of the toast loader
                            });
                            $('#bookmarkBtn svg').remove();
                            $('#bookmarkBtn').append(
                                $('<svg class="icon"><use xlink:href="#unbookmark"></use></svg>')
                            );
                        }
                    },
                });
            });

            function cartPrice(price){
                price += '';
                x = price.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }

            var form = {
                "_token": "<?php echo e(csrf_token()); ?>",
                "productId": post.id,
            };

            $.ajax({
                url: "/view",
                type: "post",
                data: form,
            });

            const labelsChart = [];
            const datasChart = [];
            $.each(priceChange.reverse(),function (){
                labelsChart.push(this.created_at);
                datasChart.push(this.price);
            });
            const dataChart = {
                labels: labelsChart,
                datasets: [{
                    label: price1,
                    backgroundColor: '#23bf53',
                    borderColor: '#23bf53',
                    data: datasChart,
                }]
            };
            const config = {
                type: 'line',
                data: dataChart,
                options: {
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 11,
                                    family: 'irsans'
                                },
                            },
                        }
                    }
                }
            };
            function getPrice(){
                if($(".allSingleIndex3 select[name='size'] option:selected").attr('data')){
                    if($(".allSingleIndex3 input[name='color']:checked").attr('price') >= 1){
                        if(post.prebuy == 1){
                            price = parseInt(post.prePrice) + parseInt($(".allSingleIndex3 input[name='color']:checked").attr('price')) + parseInt($(".allSingleIndex3 select[name='size'] option:selected").attr('data'));
                            price2 = parseInt(post.prePrice) + parseInt($(".allSingleIndex3 input[name='color']:checked").attr('price')) + parseInt($(".allSingleIndex3 select[name='size'] option:selected").attr('data'));
                        }else{
                            price = parseInt(finalPrices) + parseInt($(".allSingleIndex3 input[name='color']:checked").attr('price')) + parseInt($(".allSingleIndex3 select[name='size'] option:selected").attr('data'));
                            price2 = parseInt(post.price) + parseInt($(".allSingleIndex3 input[name='color']:checked").attr('price')) + parseInt($(".allSingleIndex3 select[name='size'] option:selected").attr('data'));
                        }
                    }else{
                        if(post.prebuy == 1){
                            price = parseInt(post.prePrice) + parseInt($(".allSingleIndex3 select[name='size'] option:selected").attr('data'));
                            price2 = parseInt(post.prePrice) + parseInt($(".allSingleIndex3 select[name='size'] option:selected").attr('data'));
                        }else{
                            price = parseInt(finalPrices) + parseInt($(".allSingleIndex3 select[name='size'] option:selected").attr('data'));
                            price2 = parseInt(post.price) + parseInt($(".allSingleIndex3 select[name='size'] option:selected").attr('data'));
                        }
                    }
                }else{
                    if($(".allSingleIndex3 input[name='color']:checked").attr('price') >= 1){
                        if(post.prebuy == 1){
                            price = parseInt(post.prePrice) + parseInt($(".allSingleIndex3 input[name='color']:checked").attr('price'));
                            price2 = parseInt(post.prePrice) + parseInt($(".allSingleIndex3 input[name='color']:checked").attr('price'));
                        }else{
                            price = parseInt(finalPrices) + parseInt($(".allSingleIndex3 input[name='color']:checked").attr('price'));
                            price2 = parseInt(post.price) + parseInt($(".allSingleIndex3 input[name='color']:checked").attr('price'));
                        }
                    }else{
                        if(post.prebuy == 1){
                            price = parseInt(post.prePrice);
                            price2 = parseInt(post.prePrice);
                        }else{
                            price = parseInt(finalPrices);
                            price2 = parseInt(post.price);
                        }
                    }
                }
                makePrice();
                makePrice2();
            }
            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );

            $('.showImage,.imageSlider').click(function(e){
                e.preventDefault();
                $('.photoviewer-modal').remove();
                var items = [],
                    options = {
                        index: 0,
                        appendTo: 'html',
                    };
                $.each(JSON.parse(post.image),function(){
                    items.push({
                        src: this
                    });
                });
                new PhotoViewer(items, options);
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('torobTag'); ?>
    <meta name="og:image" content="<?php echo e(json_encode($post->image[0])); ?>">
    <meta name="product_id" content="<?php echo e($post->product_id); ?>">
    <meta name="product_old_price" content="<?php echo e($post->offPrice); ?>">
    <meta name="product_name" content="<?php echo e($post->title); ?>">
    <?php if($post->colors): ?>
        <?php if($post['colors'] != '[]'): ?>
            <?php if($post->size): ?>
                <?php if($post['size'] != '[]'): ?>
                    <meta name="product_price" content="<?php echo e(number_format($post->price + json_decode($post['colors'],true)[0]['price'] + json_decode($post['size'],true)[0]['price'])); ?>">
                <?php else: ?>
                    <meta name="product_price" content="<?php echo e(number_format($post->price + json_decode($post['colors'],true)[0]['price'])); ?>">
                <?php endif; ?>
            <?php else: ?>
                <meta name="product_price" content="<?php echo e(number_format($post->price + json_decode($post['colors'],true)[0]['price'])); ?>">
            <?php endif; ?>
        <?php elseif($post->size): ?>
            <?php if($post['size'] != '[]'): ?>
                <meta name="product_price" content="<?php echo e(number_format($post->price + json_decode($post['size'],true)[0]['price'])); ?>">
            <?php else: ?>
                <meta name="product_price" content="<?php echo e(number_format($post->price)); ?>">
            <?php endif; ?>
        <?php else: ?>
            <meta name="product_price" content="<?php echo e(number_format($post->price)); ?>">
        <?php endif; ?>
    <?php elseif($post->size): ?>
        <?php if($post['size'] != '[]'): ?>
            <meta name="product_price" content="<?php echo e(number_format($post->price + json_decode($post['size'],true)[0]['price'])); ?>">
        <?php else: ?>
            <meta name="product_price" content="<?php echo e(number_format($post->price)); ?>">
        <?php endif; ?>
    <?php else: ?>
        <meta name="product_price" content="<?php echo e(number_format($post->price)); ?>">
    <?php endif; ?>
    <?php if($post->count == 0): ?>
        <meta name="availability" content="outofstock">
        <?php else: ?>
        <meta name="availability" content="instock">
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/home/single/product3.blade.php ENDPATH**/ ?>