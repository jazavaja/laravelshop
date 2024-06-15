<?php $__env->startSection('tab',12); ?>
<?php $__env->startSection('content'); ?>
    <div class="allDashboard">
        <div class="widgets">
            <div class="widget">
                <h3>تعداد ثبت نام
                    <?php if($date == 0): ?>
                        <span>امروز</span>
                    <?php elseif($date == 1): ?>
                        <span>دیروز</span>
                    <?php elseif($date == 2): ?>
                        <span>این هفته</span>
                    <?php elseif($date == 3): ?>
                        <span>این ماه</span>
                    <?php elseif($date == 4): ?>
                        <span>امسال</span>
                    <?php endif; ?>
                </h3>
                <h4><?php echo e(number_format($user1)); ?></h4>
            </div>
            <div class="widget">
                <h3>
                    تعداد سفارش
                    <?php if($date == 0): ?>
                        <span>امروز</span>
                    <?php elseif($date == 1): ?>
                        <span>دیروز</span>
                    <?php elseif($date == 2): ?>
                        <span>این هفته</span>
                    <?php elseif($date == 3): ?>
                        <span>این ماه</span>
                    <?php elseif($date == 4): ?>
                        <span>امسال</span>
                    <?php endif; ?>
                </h3>
                <h4><?php echo e(number_format($pay1)); ?></h4>
            </div>
            <div class="widget">
                <h3>
                    میزان درآمد
                    <?php if($date == 0): ?>
                        <span>امروز</span>
                    <?php elseif($date == 1): ?>
                        <span>دیروز</span>
                    <?php elseif($date == 2): ?>
                        <span>این هفته</span>
                    <?php elseif($date == 3): ?>
                        <span>این ماه</span>
                    <?php elseif($date == 4): ?>
                        <span>امسال</span>
                    <?php endif; ?>
                </h3>
                <h4><?php echo e(number_format($income1)); ?> تومان </h4>
            </div>
            <div class="widget">
                <h3>
                    تعداد دیدگاه
                    <?php if($date == 0): ?>
                        <span>امروز</span>
                    <?php elseif($date == 1): ?>
                        <span>دیروز</span>
                    <?php elseif($date == 2): ?>
                        <span>این هفته</span>
                    <?php elseif($date == 3): ?>
                        <span>این ماه</span>
                    <?php elseif($date == 4): ?>
                        <span>امسال</span>
                    <?php endif; ?>
                </h3>
                <h4><?php echo e(number_format($comment1)); ?></h4>
            </div>
            <div class="widget">
                <h3>
                    تعداد تیکت
                    <?php if($date == 0): ?>
                        <span>امروز</span>
                    <?php elseif($date == 1): ?>
                        <span>دیروز</span>
                    <?php elseif($date == 2): ?>
                        <span>این هفته</span>
                    <?php elseif($date == 3): ?>
                        <span>این ماه</span>
                    <?php elseif($date == 4): ?>
                        <span>امسال</span>
                    <?php endif; ?>
                </h3>
                <h4><?php echo e(number_format($tickets1)); ?></h4>
            </div>
            <div class="widget">
                <h3>
                    تعداد مشاوره
                    <?php if($date == 0): ?>
                        <span>امروز</span>
                    <?php elseif($date == 1): ?>
                        <span>دیروز</span>
                    <?php elseif($date == 2): ?>
                        <span>این هفته</span>
                    <?php elseif($date == 3): ?>
                        <span>این ماه</span>
                    <?php elseif($date == 4): ?>
                        <span>امسال</span>
                    <?php endif; ?>
                </h3>
                <h4><?php echo e(number_format($counselings1)); ?></h4>
            </div>
            <div class="widget">
                <h3>
                    تعداد وام
                    <?php if($date == 0): ?>
                        <span>امروز</span>
                    <?php elseif($date == 1): ?>
                        <span>دیروز</span>
                    <?php elseif($date == 2): ?>
                        <span>این هفته</span>
                    <?php elseif($date == 3): ?>
                        <span>این ماه</span>
                    <?php elseif($date == 4): ?>
                        <span>امسال</span>
                    <?php endif; ?>
                </h3>
                <h4><?php echo e(number_format($loan1)); ?></h4>
            </div>
            <div class="widget">
                <h3>
                    تعداد بازدید
                    <?php if($date == 0): ?>
                        <span>امروز</span>
                    <?php elseif($date == 1): ?>
                        <span>دیروز</span>
                    <?php elseif($date == 2): ?>
                        <span>این هفته</span>
                    <?php elseif($date == 3): ?>
                        <span>این ماه</span>
                    <?php elseif($date == 4): ?>
                        <span>امسال</span>
                    <?php endif; ?>
                </h3>
                <h4><?php echo e(number_format($views1)); ?></h4>
            </div>
        </div>
        <div class="allPayChartTops">
            <div class="title">
                پرفروش ترین محصولات
                <?php if($date == 0): ?>
                    امروز
                <?php elseif($date == 1): ?>
                    دیروز
                <?php elseif($date == 2): ?>
                    این هفته
                <?php elseif($date == 3): ?>
                    این ماه
                <?php elseif($date == 4): ?>
                    امسال
                <?php endif; ?>
            </div>
            <div class="items">
                <?php $__currentLoopData = $tops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="allPayChartTopsItem">
                    <h2>#<?php echo e($loop->iteration); ?></h2>
                    <a href="/product/<?php echo e($item->slug); ?>" class="pic">
                        <img alt="<?php echo e($item->title); ?>" src="<?php echo e(json_decode($item->image)[0]); ?>">
                    </a>
                    <a href="/product/<?php echo e($item->slug); ?>"><?php echo e($item->title); ?></a>
                    <div class="allDashboardWidgetOptionMid">
                        <div class="allDashboardWidgetOptionMidItem">
                            <div class="allDashboardWidgetOptionMidItemTitle">
                                <h5>کل خرید این محصول</h5>
                                <span><?php echo e($item->pay_meta_count); ?></span>
                            </div>
                            <div class="allDashboardWidgetOptionMidItemSize">
                                <div style="width : 100%" class="allDashboardWidgetOptionMidItemSizeFill"></div>
                            </div>
                        </div>
                        <div class="allDashboardWidgetOptionMidItem">
                            <div class="allDashboardWidgetOptionMidItemTitle">
                                <h5>
                                    خرید
                                    <?php if($date == 0): ?>
                                        امروز
                                    <?php elseif($date == 1): ?>
                                        دیروز
                                    <?php elseif($date == 2): ?>
                                        این هفته
                                    <?php elseif($date == 3): ?>
                                        این ماه
                                    <?php elseif($date == 4): ?>
                                        امسال
                                    <?php endif; ?>
                                </h5>
                                <span><?php echo e($item->payMeta2); ?></span>
                            </div>
                            <div class="allDashboardWidgetOptionMidItemSize">
                                <div style="width : <?php echo e($item->pay_meta_count == 0 ? 0 :($item->payMeta2 * 100) / $item->pay_meta_count); ?>%" class="allDashboardWidgetOptionMidItemSizeFill"></div>
                            </div>
                        </div>
                        <div class="allDashboardWidgetOptionMidItem">
                            <div class="allDashboardWidgetOptionMidItemTitle">
                                <h5>باقیمانده این محصول</h5>
                                <span><?php echo e($item->count); ?></span>
                            </div>
                            <div class="allDashboardWidgetOptionMidItemSize">
                                <div style="width : <?php echo e($item->pay_meta_count == 0 ? 0 :($item->count * 100) / ($item->count + $item->pay_meta_count)); ?>%" class="allDashboardWidgetOptionMidItemSizeFill"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="allPayChartTops">
            <div class="title">
                پربازدید ترین محصولات
                <?php if($date == 0): ?>
                    امروز
                <?php elseif($date == 1): ?>
                    دیروز
                <?php elseif($date == 2): ?>
                    این هفته
                <?php elseif($date == 3): ?>
                    این ماه
                <?php elseif($date == 4): ?>
                    امسال
                <?php endif; ?>
            </div>
            <div class="items">
                <?php $__currentLoopData = $views; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="allPayChartTopsItem">
                    <h2>#<?php echo e($loop->iteration); ?></h2>
                    <a href="/product/<?php echo e($item->slug); ?>" class="pic">
                        <img alt="<?php echo e($item->title); ?>" src="<?php echo e(json_decode($item->image)[0]); ?>">
                    </a>
                    <a href="/product/<?php echo e($item->slug); ?>"><?php echo e($item->title); ?></a>
                    <div class="allDashboardWidgetOptionMid">
                        <div class="allDashboardWidgetOptionMidItem">
                            <div class="allDashboardWidgetOptionMidItemTitle">
                                <h5>کل بازدید این محصول</h5>
                                <span><?php echo e($item->view_count); ?></span>
                            </div>
                            <div class="allDashboardWidgetOptionMidItemSize">
                                <div style="width : 100%" class="allDashboardWidgetOptionMidItemSizeFill"></div>
                            </div>
                        </div>
                        <div class="allDashboardWidgetOptionMidItem">
                            <div class="allDashboardWidgetOptionMidItemTitle">
                                <h5>
                                     بازدید
                                    <?php if($date == 0): ?>
                                        امروز
                                    <?php elseif($date == 1): ?>
                                        دیروز
                                    <?php elseif($date == 2): ?>
                                        این هفته
                                    <?php elseif($date == 3): ?>
                                        این ماه
                                    <?php elseif($date == 4): ?>
                                        امسال
                                    <?php endif; ?>
                                </h5>
                                <span><?php echo e($item->view2); ?></span>
                            </div>
                            <div class="allDashboardWidgetOptionMidItemSize">
                                <div style="width : <?php echo e($item->view_count == 0 ? 0 :($item->view2 * 100) /$item->view_count); ?>%" class="allDashboardWidgetOptionMidItemSizeFill"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="charts">
            <canvas id="myChart1"></canvas>
        </div>
        <div class="charts">
            <canvas id="myChart2"></canvas>
        </div>
        <div class="charts">
            <canvas id="myChart3"></canvas>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        var farvardinPay = <?php echo json_encode($farvardinPay, JSON_HEX_TAG); ?>;
        var ordibeheshtPay = <?php echo json_encode($ordibeheshtPay, JSON_HEX_TAG); ?>;
        var khordadPay = <?php echo json_encode($khordadPay, JSON_HEX_TAG); ?>;
        var tirPay = <?php echo json_encode($tirPay, JSON_HEX_TAG); ?>;
        var mordadPay = <?php echo json_encode($mordadPay, JSON_HEX_TAG); ?>;
        var shahrivarPay = <?php echo json_encode($shahrivarPay, JSON_HEX_TAG); ?>;
        var mehrPay = <?php echo json_encode($mehrPay, JSON_HEX_TAG); ?>;
        var abanPay = <?php echo json_encode($abanPay, JSON_HEX_TAG); ?>;
        var azarPay = <?php echo json_encode($azarPay, JSON_HEX_TAG); ?>;
        var deyPay = <?php echo json_encode($deyPay, JSON_HEX_TAG); ?>;
        var bahmanPay = <?php echo json_encode($bahmanPay, JSON_HEX_TAG); ?>;
        var esfandPay = <?php echo json_encode($esfandPay, JSON_HEX_TAG); ?>;
        const labels = [
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند',
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: 'تعداد سفارش ماهیانه',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [
                    farvardinPay,
                    ordibeheshtPay,
                    khordadPay,
                    tirPay,
                    mordadPay,
                    shahrivarPay,
                    mehrPay,
                    abanPay,
                    azarPay,
                    deyPay,
                    bahmanPay,
                    esfandPay,
                ],
            }]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 14,
                                family: 'irsans'
                            },
                        }
                    }
                }
            }
        };
        const myChart = new Chart(
            document.getElementById('myChart1'),
            config
        );

        var farvardinPrice = <?php echo json_encode($farvardinPrice, JSON_HEX_TAG); ?>;
        var ordibeheshtPrice = <?php echo json_encode($ordibeheshtPrice, JSON_HEX_TAG); ?>;
        var khordadPrice = <?php echo json_encode($khordadPrice, JSON_HEX_TAG); ?>;
        var tirPrice = <?php echo json_encode($tirPrice, JSON_HEX_TAG); ?>;
        var mordadPrice = <?php echo json_encode($mordadPrice, JSON_HEX_TAG); ?>;
        var shahrivarPrice = <?php echo json_encode($shahrivarPrice, JSON_HEX_TAG); ?>;
        var mehrPrice = <?php echo json_encode($mehrPrice, JSON_HEX_TAG); ?>;
        var abanPrice = <?php echo json_encode($abanPrice, JSON_HEX_TAG); ?>;
        var azarPrice = <?php echo json_encode($azarPrice, JSON_HEX_TAG); ?>;
        var deyPrice = <?php echo json_encode($deyPrice, JSON_HEX_TAG); ?>;
        var bahmanPrice = <?php echo json_encode($bahmanPrice, JSON_HEX_TAG); ?>;
        var esfandPrice = <?php echo json_encode($esfandPrice, JSON_HEX_TAG); ?>;
        const labels2 = [
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند',
        ];
        const data2 = {
            labels: labels2,
            datasets: [{
                label: 'درآمد ماهیانه',
                backgroundColor: 'rgba(60,217,1)',
                borderColor: 'rgb(60,217,1)',
                data: [
                    farvardinPrice,
                    ordibeheshtPrice,
                    khordadPrice,
                    tirPrice,
                    mordadPrice,
                    shahrivarPrice,
                    mehrPrice,
                    abanPrice,
                    azarPrice,
                    deyPrice,
                    bahmanPrice,
                    esfandPrice,
                ],
            }]
        };
        const config2 = {
            type: 'line',
            data: data2,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 14,
                                family: 'irsans'
                            },
                        }
                    }
                }
            }
        };
        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
        );

        var farvardinUser = <?php echo json_encode($farvardinUser, JSON_HEX_TAG); ?>;
        var ordibeheshtUser = <?php echo json_encode($ordibeheshtUser, JSON_HEX_TAG); ?>;
        var khordadUser = <?php echo json_encode($khordadUser, JSON_HEX_TAG); ?>;
        var tirUser = <?php echo json_encode($tirUser, JSON_HEX_TAG); ?>;
        var mordadUser = <?php echo json_encode($mordadUser, JSON_HEX_TAG); ?>;
        var shahrivarUser = <?php echo json_encode($shahrivarUser, JSON_HEX_TAG); ?>;
        var mehrUser = <?php echo json_encode($mehrUser, JSON_HEX_TAG); ?>;
        var abanUser = <?php echo json_encode($abanUser, JSON_HEX_TAG); ?>;
        var azarUser = <?php echo json_encode($azarUser, JSON_HEX_TAG); ?>;
        var deyUser = <?php echo json_encode($deyUser, JSON_HEX_TAG); ?>;
        var bahmanUser = <?php echo json_encode($bahmanUser, JSON_HEX_TAG); ?>;
        var esfandUser = <?php echo json_encode($esfandUser, JSON_HEX_TAG); ?>;
        const labels3 = [
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند',
        ];
        const data3 = {
            labels: labels3,
            datasets: [{
                label: 'تعداد ثبت نام ماهیانه',
                backgroundColor: 'rgb(1,127,217)',
                borderColor: 'rgb(1,127,217)',
                data: [
                    farvardinUser,
                    ordibeheshtUser,
                    khordadUser,
                    tirUser,
                    mordadUser,
                    shahrivarUser,
                    mehrUser,
                    abanUser,
                    azarUser,
                    deyUser,
                    bahmanUser,
                    esfandUser,
                ],
            }]
        };
        const config3 = {
            type: 'line',
            data: data3,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 14,
                                family: 'irsans'
                            },
                        }
                    }
                }
            }
        };
        const myChart3 = new Chart(
            document.getElementById('myChart3'),
            config3
        );
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/chart.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/chart/index.blade.php ENDPATH**/ ?>