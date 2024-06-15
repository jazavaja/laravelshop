<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="/js/jquery-3.6.1.min.js"></script>
    <?php if(\App\Models\Setting::where('key' , 'font')->pluck('value')->first() == 0): ?>
        <link rel="stylesheet" href="/css/font-iransans.css" type="text/css"/>
    <?php elseif(\App\Models\Setting::where('key' , 'font')->pluck('value')->first() == 1): ?>
        <link rel="stylesheet" href="/css/font-vazir.css" type="text/css"/>
    <?php else: ?>
        <link rel="stylesheet" href="/css/font-sahel.css" type="text/css"/>
    <?php endif; ?>
    <link rel="stylesheet" href="/css/home.css" type="text/css"/>
    <title>فاکتور</title>
</head>
<body>
<div class="allInvoicePay">
    <div class="allTitle" style="display: grid;grid-template-columns: auto 1fr auto;grid-gap: 1rem;align-items: center">
        <div class="right" style="font-size: 1.3rem;font-weight: 500;">صورتحساب فروش</div>
        <div class="center" style="height: 5px;background: #eee"></div>
        <div class="left">
            <div class="leftTop" style="display:grid;grid-template-columns: auto auto;grid-gap: .5rem;justify-content: center;align-items: center;font-size: .8rem;font-weight: 300;color:#000;">
                <?php echo e($title); ?>

                <img style="height: 3rem;width: 3rem;object-fit: contain" src="<?php echo e($logo); ?>" alt="<?php echo e($title); ?>">
            </div>
            <h4 style="text-align: center;font-size: .9rem;font-weight: 300;margin: .5rem 0;"><?php echo e($pays->property); ?></h4>
            <h5 style="text-align: center;font-size: .7rem;font-weight: 300;color: #777"><?php echo e($pays->created_at); ?></h5>
        </div>
    </div>
    <button class="print-button">پرینت</button>
    <div class="page">
        <h1 style="text-align: center;">
            صورت حساب الکترونیکی
            فروش
        </h1>
        <table class="header-table" style="width: 100%">
            <tr>
                <td style="width: 1.8cm; height: 2.5cm;vertical-align: middle;padding-bottom: 4px;">
                    <div class="header-item-wrapper">
                        <div style="display: grid;justify-content: center;align-items: center;width: 100%;">فروشنده</div>
                    </div>
                </td>
                <td style="padding: 0 4px 4px;height: 2.5cm;" colspan="2">
                    <div class="bordered grow header-item-data">
                        <table class="grow centered">
                            <tr>
                                <td style="width: 7cm">
                                    <span class="label">فروشنده:</span><?php echo e($title); ?>

                                </td>
                                <td colspan="2">
                                    <span class="label">شماره سفارش:</span> <?php echo e($pays->property); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="label">نشانی شرکت:</span><?php echo e($address); ?></td>
                                <td colspan="2">
                                    <span class="label">ایمیل:</span> <?php echo e($email); ?>

                                </td>
                                <td colspan="2">
                                    <span class="label">تلفن و فکس:</span> <?php echo e($number); ?>

                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 1.8cm; height: 2.5cm;vertical-align: center; padding: 0 0 4px">
                    <div class="header-item-wrapper">
                        <div style="display: grid;justify-content: center;align-items: center;width: 100%;">خریدار</div>
                    </div>
                </td>
                <td style="height: 2.5cm;vertical-align: center; padding: 0 4px 4px" colspan="2">
                    <div class="bordered header-item-data">
                        <table class="centered" style="height: 100%">
                            <tr>
                                <?php if($pays->method != 6): ?>
                                    <?php if(count($pays->address) >= 1): ?>
                                        <td>
                                            <span class="label">خریدار:</span> <?php echo e($pays->address[0]->name); ?>

                                        </td>
                                        <td style="width: 6.7cm">
                                            <span class="label">شماره ‌اقتصادی / شماره ‌ملی:</span>
                                            <span>-</span>
                                        </td>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <td>
                                        <span class="label">خریدار:</span> <?php echo e($pays->user->name); ?>

                                    </td>
                                    <td style="width: 6.7cm">
                                        <span class="label">شماره تماس:</span>
                                        <span><?php echo e($pays->user->number); ?></span>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <?php if(count($pays->address) >= 1): ?>
                                <tr>
                                    <td colspan="4">
                                        <span class="label">نشانی:</span>
                                        <?php echo e($pays->address[0]->state); ?>

                                        - <?php echo e($pays->address[0]->city); ?>

                                        - <?php echo e($pays->address[0]->address); ?>

                                        - <?php echo e($pays->address[0]->plaque); ?>

                                        <?php if($pays->address[0]->unit): ?>
                                            - <?php echo e($pays->address[0]->unit); ?>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <span class="label">شماره تماس:</span> <?php echo e($pays->address[0]->number); ?>

                                    </td>
                                    <td colspan="2">
                                        <span class="label">کد پستی:</span> <?php echo e($pays->address[0]->post); ?>

                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <table class="content-table">
            <thead>
            <tr>
                <th style="width: 1cm">ردیف</th>
                <th style="width: 1cm">شناسه کالا</th>
                <th colspan="5" style="width: 30%">شرح کالا یا خدمت</th>
                <th style="width: 1cm">تعداد</th>
                <th style="width: 2.3cm">مبلغ واحد (تومان)</th>
                <th style="width: 2.3cm">مبلغ کل (تومان)</th>
                <th style="width: 2.3cm">مبلغ کل پس از تخفیف(تومان)</th>
                <th style="width: 2.3cm">مقدار تخفیف (درصد)</th>
                <th style="width: 2.5cm"> جمع کل پس از تخفیف و مالیات و عوارض (تومان)</th>
            </tr>
            </thead>
            <tr>
                <td style="width: 1cm">1</td>
                <td style="width: 1cm">1</td>
                <td colspan="5">
                    <?php if($pays->method != 6): ?>
                        <div class="title"><?php echo e($pays->carrier); ?></div>
                    <?php else: ?>
                        <div class="title">مبلغ پرداخت</div>
                    <?php endif; ?>
                </td>
                <td style="width: 1cm"><span class="ltr">1</span></td>
                <td><span class="ltr">
                                              <?php if($pays->method != 6): ?>
                            <?php echo e(number_format($pays->carrier_price)); ?>

                        <?php else: ?>
                            <?php echo e(number_format($pays->price)); ?>

                        <?php endif; ?>
                                        </span></td>
                <td><span class="ltr">
                                              <?php if($pays->method != 6): ?>
                            <?php echo e(number_format($pays->carrier_price)); ?>

                        <?php else: ?>
                            <?php echo e(number_format($pays->price)); ?>

                        <?php endif; ?>
                                        </span></td>
                <td><span class="ltr">
                                              <?php if($pays->method != 6): ?>
                            <?php echo e(number_format($pays->carrier_price)); ?>

                        <?php else: ?>
                            <?php echo e(number_format($pays->price)); ?>

                        <?php endif; ?>
                                        </span></td>
                <td>
                    <span class="ltr">-</span>
                </td>
                <td><span class="ltr">
                    <?php if($pays->method != 6): ?>
                            <?php echo e(number_format($pays->carrier_price)); ?>

                        <?php else: ?>
                            <?php echo e(number_format($pays->price)); ?>

                        <?php endif; ?>
                    </span></td>
            </tr>
            <?php $__currentLoopData = $pays->payMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="width: 1cm"><?php echo e($loop->iteration + 1); ?></td>
                    <td style="width: 1cm"><?php echo e($item->id); ?></td>
                    <td colspan="5">
                        <?php if($item->product): ?>
                            <div class="title">
                                <?php echo e($item->product->title); ?>

                                <?php if($item->color): ?>
                                    <span>| <?php echo e($item->color); ?></span>
                                <?php endif; ?>
                                <?php if($item->size): ?>
                                    <span>| <?php echo e($item->size); ?></span>
                                <?php endif; ?>
                                <?php if($item->guarantee_name): ?>
                                    <span>| <?php echo e($item->guarantee_name); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="serials"><?php echo e($item->product->product_id); ?></div>
                        <?php else: ?>
                            <div class="title">
                                <?php echo e($item->collection->title); ?>

                            </div>
                            <div class="serials"><?php echo e($item->collection->id); ?></div>
                        <?php endif; ?>
                    </td>
                    <td style="width: 1cm"><span class="ltr"><?php echo e($item->count); ?></span></td>
                    <td><span class="ltr">
                                            <?php echo e(number_format($item->price/$item->count)); ?>

                                        </span></td>
                    <td><span class="ltr">
                                            <?php echo e(number_format($item->price)); ?>

                                        </span></td>
                    <td><span class="ltr">
                                            <?php echo e(number_format($item->price)); ?>

                                        </span></td>
                    <td>
                        <?php if($item->discount_off): ?>
                            <span class="ltr"><?php echo e($item->discount_off); ?></span>
                        <?php else: ?>
                            <span class="ltr">-</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="ltr"><?php echo e(number_format($item->price)); ?></span></td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tfoot>
            <tr>
                <td colspan="7">
                <td class="font-small" colspan="4">جمع کل پس از کسر تخفیف با احتساب مالیات و عوارض (تومان):</td>
                <td class="font-small" colspan="1">%<?php echo e($pays->added); ?></td>

                <td><span class="ltr">
                                    <?php echo e(number_format($pays->price)); ?>

                                </span></td>
            </tr>
            <tr style="background: #fff">
                <td colspan="13" style="height: 2.5cm;vertical-align: top">
                    <div class="flex">
                        <?php if($pays->time && $pays->method != 6): ?>
                            <div class="flex-grow">تاریخ تحویل:</div>
                            <div class="flex-grow">ساعت تحویل:</div>
                        <?php endif; ?>

                        <div class="flex-grow">روش‌های پرداخت:</div>

                        <div class="flex-grow" style="width: 1.8cm"></div>
                    </div>
                    <div class="flex">
                        <?php if($pays->time && $pays->method != 6): ?>
                            <div class="flex-grow">
                                    <span v-if="$pays->time">
                                        <?php echo e(json_decode($pays->time)->dayL); ?>

                                        <?php echo e(json_decode($pays->time)->day); ?>

                                        <?php echo e(json_decode($pays->time)->month); ?>

                                    </span>
                            </div>
                            <div class="flex-grow" v-if="$pays->time">
                                    <span>
                                        00::<?php echo e(json_decode($pays->time)->from); ?>

                                        -
                                        00::<?php echo e(json_decode($pays->time)->to); ?>

                                    </span>
                            </div>
                        <?php endif; ?>
                        <div class="flex-grow">اعتباری : <?php echo e(number_format($pays->price)); ?></div>
                        <div class="flex-grow"></div>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('.print-button').click(function() {
            window.print();
        });
    })
</script>

<style>
    html, body {
        padding: 0;
        margin: 0 auto;
        max-width: 29.7cm;
        -webkit-print-color-adjust: exact;
    }

    body {
        padding: 0.5cm
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    table {
        width: 100%;
        table-layout: fixed;
        border-spacing: 0;
    }

    .header-table {
        table-layout: fixed;
        border-spacing: 0;
    }

    .header-table td {
        padding: 0;
        vertical-align: top;
    }

    body {
        font-weight: 300;
        direction: rtl;
    }

    .print-button {
        cursor: pointer;
        -webkit-box-shadow: none;
        box-shadow: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        border-radius: 5px;
        background: none;
        -webkit-transition: all .3s ease-in-out;
        transition: all .3s ease-in-out;
        position: relative;

        outline: none;
        text-align: center;

        padding: 8px 16px;
        font-size: 12px;
        font-size: .857rem;
        line-height: 1.833;
        font-weight: 500;
        background-color: #0fabc6;
        color: #fff;
        border: 1px solid #0fabc6;
    }

    .page {
        background: white;
        page-break-after: always;
    }

    .flex {
        display: flex;
    }

    .flex > * {
        float: left;
    }

    .flex-grow {
        flex-grow: 10000000;
    }

    .barcode {
        text-align: center;
        margin: 12px 0 0 0;
        height: 30px;
    }

    .barcode span {
        font-size: 35pt;
    }

    .portait {
        transform: rotate(-90deg) translate(0, 40%);
        text-align: center;
    }

    .header-item-wrapper {
        border: 1px solid #000;
        width: 100%;
        height: 100%;
        background: #eee;
        display: flex;
        align-content: center;
    }

    thead, tfoot {
        background: #eee;
    }

    .header-item-data {
        height: 100%;
        width: 100%;
    }

    .bordered {
        border: 1px solid #000;
        padding: 0.12cm;
    }

    .header-table table {
        width: 100%;
        vertical-align: middle;
    }

    .content-table {
        border-collapse: collapse;
    }

    .content-table td, th {
        border: 1px solid #000;
        text-align: center;
        padding: 0.1cm;
        font-weight: 300;
    }

    table.centered td {
        vertical-align: middle;
    }

    .serials {
        direction: ltr;
        text-align: left;
    }

    .title {
        text-align: right;
    }

    .grow {
        width: 100%;
        height: 100%;
    }

    .font-small {
        font-size: 8pt;
    }

    .font-medium {
        font-size: 10pt;
    }

    .font-big {
        font-size: 15pt;
    }

    .label {
        font-weight: bold;
        padding: 0 0 0 2px;
    }

    @page {
        size: A4 landscape;
        margin: 0;
        margin-bottom: 0.5cm;
        margin-top: 0.5cm;
    }

    .ltr {
        direction: ltr;
        display: block;
    }

    @media print {
        .print-button {
            display: none;
            visibility: hidden;
        }
    }
</style>
<?php /**PATH /var/www/html/resources/views/admin/pay/invoice.blade.php ENDPATH**/ ?>