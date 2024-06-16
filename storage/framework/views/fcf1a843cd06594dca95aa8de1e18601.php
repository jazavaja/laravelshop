<div class="allProfileList">
    <div class="allUserIndexList">
        <div class="allUserIndexListsUser">
            <div class="allUserIndexListsUserPic">
                <div class="pic">
                    <?php if(auth()->user()->profile): ?>
                        <img src="<?php echo e(auth()->user()->profile); ?>" alt="<?php echo e(auth()->user()->name); ?>">
                    <?php else: ?>
                        <img src="/img/user.png" alt="<?php echo e(auth()->user()->name); ?>">
                    <?php endif; ?>
                </div>
            </div>
            <div class="allUserIndexListsUserItem">
                <div class="allUserIndexListsUserName"><?php echo e(auth()->user()->name); ?></div>
            </div>
            <h4> <?php echo e(__('messages.identification_code')); ?> : <?php echo e(auth()->user()->referral); ?></h4>
            <h4> <?php echo e(__('messages.my_score')); ?> : <?php echo e($scores); ?></h4>
        </div>
        <div class="allUserIndexListItems">
            <a href="/profile/personal-info"><?php echo e(__('messages.user_edit')); ?></a>
            <a href="/logout"><?php echo e(__('messages.exit_user')); ?></a>
        </div>
    </div>
    <div class="walletData">
        <i>
            <svg class="icon">
                <use xlink:href="#wallet"></use>
            </svg>
        </i>
        <h3><?php echo e(number_format($wallet)); ?> <span><?php echo e(__('messages.arz')); ?></span></h3>
        <a href="/charge"><?php echo e(__('messages.charge1')); ?></a>
    </div>
    <?php if($checkSeller == 1): ?>
        <a class="becomeList" href="/seller/dashboard">
            <h4>
                <i>
                    <svg class="icon">
                        <use xlink:href="#seller"></use>
                    </svg>
                </i>
                <?php echo e(__('messages.seller_panel')); ?>

            </h4>
            <div class="pic"></div>
        </a>
    <?php else: ?>
        <a class="becomeList" href="/become-seller">
            <h4>
                <i>
                    <svg class="icon">
                        <use xlink:href="#seller"></use>
                    </svg>
                </i>
                <?php echo e(__('messages.seller')); ?>

            </h4>
            <div class="pic"></div>
        </a>
    <?php endif; ?>
    <div class="allUserIndexListsItems">
        <div class="allUserIndexListsItem">
            <a href="/profile/subcategory"><?php echo e(__('messages.sub1')); ?></a>
            <?php if($tab == 6): ?>
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            <?php endif; ?>
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/pay"><?php echo e(__('messages.order_user')); ?></a>
            <?php if($tab == 1): ?>
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            <?php endif; ?>
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/like"><?php echo e(__('messages.like_user')); ?></a>
            <?php if($tab == 2): ?>
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            <?php endif; ?>
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/convert"><?php echo e(__('messages.change_score')); ?></a>
            <?php if($tab == 7): ?>
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            <?php endif; ?>
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/bookmark"><?php echo e(__('messages.bookmark_user')); ?></a>
            <?php if($tab == 3): ?>
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            <?php endif; ?>
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/comment"><?php echo e(__('messages.comments')); ?></a>
            <?php if($tab == 4): ?>
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            <?php endif; ?>
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/ticket"><?php echo e(__('messages.ticket1')); ?></a>
            <?php if($tab == 5): ?>
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            <?php endif; ?>
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/counseling"><?php echo e(__('messages.counseling')); ?></a>
            <?php if($tab == 6): ?>
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            <?php endif; ?>
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile"><?php echo e(__('messages.dashboard')); ?></a>
            <?php if($tab == 0): ?>
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/home/profile/list.blade.php ENDPATH**/ ?>