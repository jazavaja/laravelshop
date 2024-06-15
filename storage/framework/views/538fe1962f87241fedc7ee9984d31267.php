<?php $__env->startSection('tab',0); ?>
<?php $__env->startSection('content'); ?>
    <div class="allDashboard">
        <div class="widgets">
            <div class="widget">
                <h3>ثبت نام امروز</h3>
                <h4><?php echo e(number_format($todayUser)); ?></h4>
            </div>
            <div class="widget">
                <h3>تعداد بازدید ها</h3>
                <h4><?php echo e($allView); ?></h4>
            </div>
            <div class="widget">
                <h3>بازدید امروز</h3>
                <h4><?php echo e($todayView); ?></h4>
            </div>
            <div class="widget">
                <h3>مشاوره فوری امروز</h3>
                <h4><?php echo e(number_format($allComment)); ?></h4>
            </div>
            <div class="widget">
                <h3>دیدگاه امروز</h3>
                <h4><?php echo e(number_format($todayComment)); ?></h4>
            </div>
            <div class="widget">
                <h3>سفارشات امروز</h3>
                <h4><?php echo e(number_format($todayPay)); ?></h4>
            </div>
            <div class="widget">
                <h3>محصولات تمام شده</h3>
                <h4><?php echo e(number_format($allEmpty)); ?></h4>
            </div>
            <div class="widget">
                <h3>درآمد امروز</h3>
                <h4><?php echo e(number_format($allIncome)); ?> تومان </h4>
            </div>
        </div>
        <div class="chartsPie">
            <figure class="pieCharts">
                <div id="pieChart1"></div>
            </figure>
            <figure class="pieCharts">
                <div id="pieChart2"></div>
            </figure>
        </div>
        <div class="chartsData">
            <figure class="chartData">
                <div id="pieChart3"></div>
            </figure>
            <div class="allTables">
                <h4>آخرین مشتریان</h4>
                <div class="allData">
                    <table class="invoiceT">
                        <tr>
                            <th>نام کاربر</th>
                            <th>شماره تماس</th>
                            <th>ایمیل</th>
                            <th>وضعیت</th>
                            <th>زمان ثبت</th>
                        </tr>
                        <?php $__currentLoopData = \App\Models\User::latest()->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->number); ?></td>
                                <td><?php echo e($item->email); ?></td>
                                <td>
                                    <?php if($item->isOnline()): ?>
                                        آنلاین
                                    <?php else: ?>
                                        آفلاین
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($item->created_at); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="listsData">
            <div class="allTables">
                <h4>آخرین سفارشات</h4>
                <div class="allData">
                    <table class="contractsT">
                        <tr>
                            <th>شناسه</th>
                            <th>مشتری</th>
                            <th>مبلغ</th>
                            <th>وضعیت پرداخت</th>
                            <th>شماره سفارش</th>
                            <th>تعداد محصول</th>
                        </tr>
                        <?php $__currentLoopData = \App\Models\Pay::latest()->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>#<?php echo e($item->id); ?></td>
                                <?php if($item->user): ?>
                                    <td><?php echo e($item->user->name); ?></td>
                                <?php else: ?>
                                    <td>-</td>
                                <?php endif; ?>
                                <td><?php echo e(number_format($item->price)); ?> تومان</td>
                                <td>
                                    <?php if($item->status == 100): ?>
                                        <span class="status100">پرداخت شده</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 50): ?>
                                        <span class="status50">پرداخت بیعانه</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 0): ?>
                                        <span class="status0">پرداخت نشده</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 20): ?>
                                        <span class="status20">در حال پرداخت</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 10): ?>
                                        <span class="status10">پرداخت اقساطی</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 1): ?>
                                        <span class="status1">لغو شده</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($item->property); ?></td>
                                <td><?php echo e($item->payMeta()->count()); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
            <div class="allTables">
                <h4>آخرین رویداد</h4>
                <div class="allData">
                    <table class="eventT">
                        <tr>
                            <th>نام کاربر</th>
                            <th>عنوان</th>
                            <th>توضیحات</th>
                            <th>زمان</th>
                        </tr>
                        <?php $__currentLoopData = \App\Models\Event::latest()->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->customer->name); ?></td>
                                <td><?php echo e($item->title); ?></td>
                                <td><?php echo e($item->body); ?></td>
                                <td><?php echo e($item->created_at); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
        </div>
        <div id="update_notification" style="display:none;">
            <div class="toast-header">
                <strong class="me-auto"><?php echo e(trans("laraupdater.Update_Available")); ?></strong>
                <span id="update_version" class="badge rounded-pill bg-info text-dark"></span>
                <button type="button" class="btn-close" data-bs-dismiss="toast">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#cancel"></use>
                        </svg>
                    </i>
                </button>
            </div>
            <div class="toast-body">
                <span id="update_description"></span>
                <hr>
                <button type="button" onclick="update();" class="btn btn-info btn-sm update_btn"><?php echo e(trans('laraupdater.Update_Now')); ?></button>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            var taskChart0 = <?php echo json_encode($taskChart0, JSON_HEX_TAG); ?>;
            var taskChart1 = <?php echo json_encode($taskChart1, JSON_HEX_TAG); ?>;
            var taskChart2 = <?php echo json_encode($taskChart2, JSON_HEX_TAG); ?>;
            var taskChart3 = <?php echo json_encode($taskChart3, JSON_HEX_TAG); ?>;
            var projectChart0 = <?php echo json_encode($projectChart0, JSON_HEX_TAG); ?>;
            var projectChart1 = <?php echo json_encode($projectChart1, JSON_HEX_TAG); ?>;
            var projectChart2 = <?php echo json_encode($projectChart2, JSON_HEX_TAG); ?>;
            var projectChart3 = <?php echo json_encode($projectChart3, JSON_HEX_TAG); ?>;
            var statusProduct0 = <?php echo json_encode($statusProduct0, JSON_HEX_TAG); ?>;
            var statusProduct1 = <?php echo json_encode($statusProduct1, JSON_HEX_TAG); ?>;
            var statusProduct2 = <?php echo json_encode($statusProduct2, JSON_HEX_TAG); ?>;
            Highcharts.chart('pieChart1', {
                colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                }),
                chart: {
                    type: 'pie',
                    style: {
                        fontFamily: 'irsans'
                    },
                    options3d: {
                        enabled: true,
                        alpha: 45
                    }
                },
                title: {
                    text: 'وضعیت پرداخت سفارشات',
                    align: 'center'
                },
                subtitle: {
                    text: 'تمام وضعیت های پرداخت',
                    align: 'center'
                },
                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45
                    }
                },
                series: [{
                    name: 'تعداد',
                    data: [
                        ['پرداخت کامل', taskChart0],
                        ['پرداخت در محل', taskChart1],
                        ['پرداخت نشده', taskChart2],
                        ['لغو شده', taskChart3],
                    ]
                }]
            });
            Highcharts.chart('pieChart2', {
                colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                }),
                chart: {
                    type: 'pie',
                    style: {
                        fontWeight: 300,
                        fontFamily: 'irsans',
                    },
                    options3d: {
                        enabled: true,
                        alpha: 45
                    },
                },
                title: {
                    text: 'وضعیت تحویل سفارشات',
                    align: 'center'
                },
                subtitle: {
                    text: 'تمام وضعیت های تحویل',
                    align: 'center'
                },
                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45
                    }
                },
                series: [{
                    name: 'تعداد',
                    data: [
                        ['در انتظار بررسی', projectChart0],
                        ['بسته بندی شده', projectChart1],
                        ['تحویل پیک', projectChart2],
                        ['تکمیل شده', projectChart3],
                    ]
                }]
            });
            Highcharts.chart('pieChart3', {
                colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                }),
                chart: {
                    type: 'pie',
                    style: {
                        fontWeight: 300,
                        fontFamily: 'irsans',
                    },
                    options3d: {
                        enabled: true,
                        alpha: 45
                    },
                },
                title: {
                    text: 'وضعیت تحویل سفارشات',
                    align: 'center'
                },
                subtitle: {
                    text: 'تمام وضعیت های تحویل',
                    align: 'center'
                },
                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45
                    }
                },
                series: [{
                    name: 'تعداد',
                    data: [
                        ['در انتظار بررسی', statusProduct0],
                        ['بسته بندی شده', statusProduct1],
                        ['تحویل پیک', statusProduct2],
                    ]
                }]
            });
            $.ajax({
                type: 'GET',
                url: '/updater.check',
                async: false,
                success: function(response) {
                    if(response != ''){
                        $('#update_version').text(response.version);
                        $('#update_description').text(response.description);
                        $('#update_notification').show();
                    }else{
                        $('#update_notification').remove();
                    }
                }
            });
        })
        function update() {
            $("#update_description").show();
            $(".update_btn").html('<?php echo e(trans("laraupdater.Updating")); ?>');
            $.ajax({
                type: 'GET',
                url: '/updater.update',
                success: function(response) {
                    if(response != ''){
                        $('#update_description').append(response);
                        $(".update_btn").html('<?php echo e(trans("laraupdater.Updated")); ?>');
                        $(".update_btn").attr("onclick","");
                        $('#update_notification').remove();
                        window.location.reload();
                    }
                },
                error: function(response) {
                    if(response != ''){
                        $('#update_description').append(response);
                        $(".update_btn").html('<?php echo e(trans("laraupdater.error_try_again")); ?>');
                    }
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/highcharts/highcharts.min.js"></script>
    <script src="/js/highcharts/highcharts-3d.min.js"></script>
    <script src="/js/highcharts/exporting.min.js"></script>
    <script src="/js/highcharts/export-data.min.js"></script>
    <script src="/js/highcharts/accessibility.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/panel.blade.php ENDPATH**/ ?>