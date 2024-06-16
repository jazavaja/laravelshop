<?php $__env->startSection('tab' , 7); ?>
<?php $__env->startSection('content'); ?>
    <div class="allShowPay">
        <div class="topShowPay">
            <div class="title">
                <?php if($pays->method != 6): ?>
                    <h1>جزئیات سفارش</h1>
                <?php else: ?>
                    <h1>جزئیات پرداخت</h1>
                <?php endif; ?>
                <span><?php echo e($pays->created_at); ?></span>
                <a href="/admin/pay/invoice/<?php echo e($pays->id); ?>" target="_blank">
                    <svg class="icon">
                        <use xlink:href="#pay"></use>
                    </svg>
                    دریافت فاکتور
                </a>
                <?php if($pays->method != 6): ?>
                    <a href="/admin/pay/print/<?php echo e($pays->id); ?>" target="_blank" style="color:#fff;padding: 0.3rem 1rem" class="print-button2">
                        <svg class="icon">
                            <use xlink:href="#print"></use>
                        </svg>
                        لیبل گیرنده
                    </a>
                    <button class="btnMap">
                        <svg class="icon">
                            <use xlink:href="#map"></use>
                        </svg>
                        نمایش نقشه
                    </button>
                <?php endif; ?>
            </div>
            <div class="detail">
                <div class="topDetail">
                    <div class="items">
                        <?php if(count($pays->address) >= 1): ?>
                            <div class="item">
                                <h5>نام گیرنده :</h5>
                                <div><?php echo e($pays->address[0]->name); ?></div>
                            </div>
                            <div class="item">
                                <h5>شماره تماس :</h5>
                                <div><?php echo e($pays->address[0]->number); ?></div>
                            </div>
                            <div class="item">
                                <h5>کد پستی :</h5>
                                <div><?php echo e($pays->address[0]->post); ?></div>
                            </div>
                        <?php else: ?>
                            <div class="item">
                                <h5>نام گیرنده :</h5>
                                <div><?php echo e($pays->user->name); ?></div>
                            </div>
                            <div class="item">
                                <h5>شماره تماس :</h5>
                                <div><?php echo e($pays->user->number); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if($pays->method != 6): ?>
                            <div class="item">
                                <h5>نوع حامل :</h5>
                                <div><?php echo e($pays->carrier); ?></div>
                            </div>
                            <div class="item">
                                <h5>مبلغ حمل :</h5>
                                <div><?php echo e(number_format($pays->carrier_price)); ?> تومان </div>
                            </div>
                        <?php endif; ?>
                        <div class="item">
                            <h5>درگاه پرداختی :</h5>
                            <?php if($pays->gate == 0): ?>
                                <div>زرینپال</div>
                            <?php elseif($pays->gate == 1): ?>
                                <div>زیبال</div>
                            <?php elseif($pays->gate == 2): ?>
                                <div>نکست پی</div>
                            <?php elseif($pays->gate == 3): ?>
                                <div>نکست پی</div>
                            <?php elseif($pays->gate == 4): ?>
                                <div>آیدی پی</div>
                            <?php elseif($pays->gate == 5): ?>
                                <div>به پرداخت ملت</div>
                            <?php elseif($pays->gate == 6): ?>
                                <div>سداد ملی</div>
                            <?php elseif($pays->gate == 7): ?>
                                <div>آسان پرداخت</div>
                            <?php elseif($pays->gate == 8): ?>
                                <div>پاسارگاد</div>
                            <?php endif; ?>
                        </div>
                        <?php if($pays->time): ?>
                            <?php if(json_decode($pays->time)->day): ?>
                                <div class="item">
                                    <h5>بازه زمانی :</h5>
                                    <div>
                                        <span>بازه</span>
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
                                <h5>آدرس :</h5>
                                <div>
                                    <?php echo e($pays->address[0]->state); ?>

                                    -<?php echo e($pays->address[0]->city); ?>

                                    -<?php echo e($pays->address[0]->address); ?>

                                    پلاک :
                                    <?php echo e($pays->address[0]->plaque); ?>

                                    واحد :
                                    <?php echo e($pays->address[0]->unit); ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="botDetail">
                    <div class="items">
                        <div class="item">
                            <h5>مبلغ پرداخت :</h5>
                            <div><?php echo e(number_format($pays->price)); ?> تومان</div>
                        </div>
                        <?php if($pays->method != 6): ?>
                            <div class="item">
                                <h5>مبلغ بیعانه :</h5>
                                <div><?php echo e(number_format($pays->deposit)); ?> تومان</div>
                            </div>
                        <?php endif; ?>
                        <div class="item">
                            <h5>وضعیت پرداخت :</h5>
                            <select name="status">
                                <option value="100">پرداخت شده</option>
                                <option value="50">پرداخت بیعانه</option>
                                <option value="20">تایید و آماده پرداخت</option>
                                <option value="10">در حال بررسی</option>
                                <option value="0">پرداخت نشده</option>
                                <option value="1">لغو شده</option>
                                <option value="2">مرجوعی</option>
                            </select>
                        </div>
                        <?php if($pays->method != 6): ?>
                            <div class="item">
                                <h5>وضعیت ارسال :</h5>
                                <select name="deliver">
                                    <option value="0">دریافت سفارش</option>
                                    <option value="1">در انتظار بررسی</option>
                                    <option value="2">بسته بندی شده</option>
                                    <option value="3">تحویل پیک</option>
                                    <option value="4">تکمیل شده</option>
                                </select>
                            </div>
                        <?php endif; ?>
                        <div class="item">
                            <h5>روش پرداخت :</h5>
                            <?php if($pays->method == 0): ?>
                                <div>پرداخت از درگاه</div>
                            <?php endif; ?>
                            <?php if($pays->method == 1): ?>
                                <div>پرداخت از کیف پول</div>
                            <?php endif; ?>
                            <?php if($pays->method == 2): ?>
                                <div>پرداخت در محل</div>
                            <?php endif; ?>
                            <?php if($pays->method == 3): ?>
                                <div>پرداخت اقساطی</div>
                            <?php endif; ?>
                            <?php if($pays->method == 4): ?>
                                <div>پرداخت فوری</div>
                            <?php endif; ?>
                            <?php if($pays->method == 5): ?>
                                <div>کارت به کارت</div>
                            <?php endif; ?>
                            <?php if($pays->method == 6): ?>
                                <div>پرداخت مستقیم</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($pays->method != 6): ?>
                <div class="trackPay">
                    <input type="text" placeholder="کد رهگیری را وارد کنید" name="track" value="<?php echo e($pays->track); ?>">
                    <button>اعمال کد</button>
                </div>
            <?php endif; ?>
            <?php if($pays->note): ?>
                <div class="trackPay">
                    <span>مطلب کاربر</span>
                    <p><?php echo e($pays->note); ?></p>
                </div>
            <?php else: ?>
                <div class="trackPay">
                    <span>مطلب کاربر</span>
                    <p>وارد نشده</p>
                </div>
            <?php endif; ?>
        </div>
        <?php if($pays->status != 100 && $pays->status != 50): ?>
            <div class="note">
                <label>لینک پرداخت مستقیم توسط کاربر :</label>
                <a target="_blank" href="<?php echo e(url('/fast?order='.$pays->property)); ?>"><?php echo e(url('/fast?order=')); ?><span class="link1"><?php echo e($pays->property); ?></span></a>
            </div>
        <?php endif; ?>
        <?php if($pays->method != 6): ?>
            <div class="allShowPayContainer">
                <div class="topContainer">
                    <div class="level">
                        <h3>وضعیت ارسال :</h3>
                        <?php if($pays->deliver == 0): ?>
                            <span class="unActive">دریافت سفارش</span>
                        <?php endif; ?>
                        <?php if($pays->deliver == 1): ?>
                            <span class="unActive">در انتظار بررسی</span>
                        <?php endif; ?>
                        <?php if($pays->deliver == 2): ?>
                            <span class="unActive">بسته بندی شده</span>
                        <?php endif; ?>
                        <?php if($pays->deliver == 3): ?>
                            <span class="unActive">تحویل پیک</span>
                        <?php endif; ?>
                        <?php if($pays->deliver == 4): ?>
                            <span class="activeStatus">تکمیل شده</span>
                        <?php endif; ?>
                    </div>
                    <div class="rateItemsCount">
                        <div class="rateItemsCountItem" title="دریافت سفارش">
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
                        <div class="rateItemsCountItem" title="در انتظار بررسی">
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
                        <div class="rateItemsCountItem" title="بسته بندی شده">
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
                        <div class="rateItemsCountItem" title="تحویل پیک">
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
                        <div class="rateItemsCountItem" title="تکمیل شده">
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
                        <h3>شماره سفارش :</h3>
                        <span><?php echo e($pays->property); ?></span>
                    </div>
                    <div class="cashBacks">
                        <div class="cash1">
                            <?php if($pays->back == 1): ?>
                                <button class="active">کش بک به کیف پول سایت</button>
                            <?php else: ?>
                                <button>کش بک به کیف پول سایت</button>
                            <?php endif; ?>
                        </div>
                        <div class="cash2">
                            <?php if($pays->back == 2): ?>
                                <button class="active">کش بک به حساب با شبا</button>
                            <?php else: ?>
                                <button>کش بک به حساب با شبا</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if(count($pays->installments) >= 1): ?>
                    <div class="abilityPost">
                        <div class="abilityTitle">
                            <label>اقساط این سفارش</label>
                        </div>
                        <ul class="abilityTable">
                            <li>
                                <h4>شماره چک</h4>
                                <h4>مبلغ قسط (تومان)</h4>
                                <h4>سررسید قسط</h4>
                                <h4>وضعیت پرداخت</h4>
                                <h4>زمان پرداخت مشتری</h4>
                            </li>
                            <?php $__currentLoopData = $pays->installments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <input type="text" name="title" value="<?php echo e($item->title); ?>" placeholder="شماره را وارد کنید">
                                    <input type="text" name="price" value="<?php echo e($item->price); ?>" placeholder="مبلغ را وارد کنید">
                                    <input type="text" name="time" value="<?php echo e($item->time); ?>" placeholder="تاریخ را وارد کنید">
                                    <select name="status" id="<?php echo e($item->id); ?>">
                                        <option value="0">پرداخت نشده</option>
                                        <option value="1">پرداخت شده</option>
                                    </select>
                                    <input type="text" name="pay" value="<?php echo e($item->pay); ?>" placeholder="زمان پرداخت مشتری">
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <button class="btnClick">ثبت اقساط</button>
                    </div>
                <?php endif; ?>
                <div class="items">
                    <div class="titleProducts">
                        <div class="title">محصولاتی که سفارش داده شده</div>
                        <button>افزودن محصول</button>
                    </div>
                    <?php $__currentLoopData = $pays->payMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <?php if($item->product): ?>
                                <a href="/product/<?php echo e($item->product->slug); ?>" class="cartDetailPic">
                                    <img src="<?php echo e(json_decode($item->product->image)[0]); ?>" alt="<?php echo e($item->product->title); ?>">
                                    <i id="<?php echo e($item->id); ?>">
                                        <svg class="icon">
                                            <use xlink:href="#cancel"></use>
                                        </svg>
                                    </i>
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
                                        <h3>
                                            <?php echo e($item->product->title); ?>

                                            <?php if($item->cancel): ?>
                                                <span class="cancel">(لغو شده)</span>
                                            <?php endif; ?>
                                        </h3>
                                    </a>
                                <?php endif; ?>
                                <?php if($item->collection): ?>
                                    <a href="/pack/<?php echo e($item->collection->slug); ?>" class="cartDetailInfoItem">
                                        <h3><?php echo e($item->collection->title); ?></h3>
                                    </a>
                                <?php endif; ?>
                                <?php if($item->prebuy): ?>
                                    <div class="cartDetailInfoItem activePay">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#pay"></use>
                                            </svg>
                                        </i>
                                        <span>پیش خرید</span>
                                    </div>
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
                                    <span><?php echo e(number_format($item->price)); ?> تومان</span>
                                </div>
                                <div class="cartDetailInfoItem">
                                    <i>
                                        <svg class="icon">
                                            <use xlink:href="#car"></use>
                                        </svg>
                                    </i>
                                    <select name="deliver" id="<?php echo e($item->id); ?>">
                                        <?php if($item->deliver == 0): ?>
                                            <option value="0" selected>دریافت سفارش</option>
                                            <?php else: ?>
                                            <option value="0">دریافت سفارش</option>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 1): ?>
                                            <option value="1" selected>در انتظار بررسی</option>
                                        <?php else: ?>
                                            <option value="1">در انتظار بررسی</option>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 2): ?>
                                            <option value="2" selected>بسته بندی شده</option>
                                        <?php else: ?>
                                            <option value="2">بسته بندی شده</option>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 3): ?>
                                            <option value="3" selected>تحویل پیک</option>
                                        <?php else: ?>
                                            <option value="3">تحویل پیک</option>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 4): ?>
                                            <option value="4" selected>تکمیل شده</option>
                                        <?php else: ?>
                                            <option value="4">تکمیل شده</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="addProducts" style="display:none;">
                <form method="post" action="/admin/add-pay/<?php echo e($pays->id); ?>" class="showProducts">
                    <?php echo csrf_field(); ?>
                    <div class="item">
                        <h4>محصول</h4>
                        <select name="productM">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="item">
                        <h4>رنگ</h4>
                        <input type="text" placeholder="رنگ" name="colorM">
                    </div>
                    <div class="item">
                        <h4>سایز</h4>
                        <input type="text" placeholder="سایز" name="sizeM">
                    </div>
                    <div class="item">
                        <h4>تعداد</h4>
                        <input type="text" placeholder="تعداد" name="countM">
                    </div>
                    <div class="item">
                        <h4>گارانتی</h4>
                        <input type="text" placeholder="گارانتی" name="guaranteeM">
                    </div>
                    <div class="item">
                        <h4>مبلغ کل</h4>
                        <input type="text" placeholder="مبلغ" name="priceM">
                    </div>
                    <div class="buttons">
                        <button>ارسال</button>
                        <button class="btnCan">انصراف</button>
                    </div>
                </form>
            </div>
            <div class="showAllMap">
                <div class="map1">
                    <div id="map1"></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).mouseup(function(e)
        {
            var container = $(".showAllMap");
            if (container.is(e.target) && container.has(e.target).length == 0)
            {
                $('.showAllMap').attr('class','showAllMap');
            }
        });
        $(document).ready(function(){
            var pays = <?php echo $pays->toJson(); ?>;
            $.each(pays.installments , function (e){
                $(".abilityTable select[id="+this.id+"]").val(this.status);
            })
            $('.allShowPay .btnMap').click(function (){
                if($('.showAllMap').attr('class') == 'showAllMap activesAddress'){
                    $('.showAllMap').attr('class','showAllMap');
                }else{
                    $('.showAllMap').attr('class','showAllMap activesAddress');
                }
            })
            $('.print-button').click(function() {
                var divToPrint=document.getElementById('printMe1');
                var newWin=window.open('','Print-Window');
                newWin.document.open();
                newWin.document.write('<html><head><link rel="stylesheet" href="/css/admin.css"/></head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                newWin.document.close();
            });
            $('.print-button2').click(function() {
                var divToPrint=document.getElementById('printMe2');
                var newWin=window.open('','Print-Window');
                newWin.document.open();
                newWin.document.write('<html><head><link rel="stylesheet" href="/css/admin.css"/></head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                newWin.document.close();
            });
            $(".botDetail .item select[name='deliver']").val(pays.deliver);
            $(".item select[name='status']").val(pays.status);
            $(".item select[name='status']").change(function() {
                var status=$(".item select[name='status'] :selected").val();
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    status:status,
                    update:1,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
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
                    },
                });
            });
            $(".botDetail .item select[name='deliver']").change(function() {
                var deliver=$(".item select[name='deliver'] :selected").val();
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    deliver:deliver,
                    update:2,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
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
                        window.location.reload();
                    },
                });
            });
            $(".allShowPayContainer .item select[name='deliver']").change(function() {
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    deliver:$(this).val(),
                    payMeta:$(this).attr('id'),
                    update:6,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
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
                        window.location.reload();
                    },
                });
            });
            $(".trackPay button").on('click',function() {
                var track=$(".trackPay input[name='track']").val();
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    track:track,
                    update:3,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
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
                    },
                });
            });
            $(".cash1 button").on('click',function() {
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    back:1,
                    update:4,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
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
                        window.location.reload();
                    },
                });
            });
            $(".cash2 button").on('click',function() {
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    back:2,
                    update:4,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
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
                        window.location.reload();
                    },
                });
            });
            $(".abilityPost button").on('click',function() {
                var installs = [];
                $(".abilityPost li").each(function(){
                    if($(this).find("input").length >= 1) {
                        var install = {
                            title: "",
                            price: "",
                            time: "",
                            status: "",
                            pay: "",
                            id: "",
                        };
                        $(this).find("input").each(function () {
                            if (this.name == 'title') {
                                install.title = this.value;
                            }
                            if (this.name == 'price') {
                                install.price = this.value;
                            }
                            if (this.name == 'time') {
                                install.time = this.value;
                            }
                            if (this.name == 'status') {
                                install.status = this.value;
                            }
                            if (this.name == 'pay') {
                                install.pay = this.value;
                            }
                        })
                        $(this).find("select").each(function () {
                            if (this.name == 'status') {
                                install.status = this.value;
                            }
                            install.id = this.id;
                        })
                        installs.push(install);
                    }
                });
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    installs:JSON.stringify(installs),
                    update:5,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
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
                        window.location.reload();
                    },
                });
            });
            $(".cartDetailPic i").click(function(e) {
                e.preventDefault();
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                };
                $.ajax({
                    url: "/admin/delete-pay/"+$(this).attr('id'),
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
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
                        window.location.reload();
                    },
                });
            });
            $(".titleProducts button").click(function(e) {
                $('.addProducts').toggle();
            })
            $(".addProducts .btnCan").click(function(e) {
                e.preventDefault();
                $('.addProducts').toggle();
            })
            if(pays.address.length >= 1){
                var originLat = pays.address[0].originLat;
                var originLng = pays.address[0].originLng;
                var app = new Mapp({
                    element: '#map1',
                    presets: {
                        latlng: {
                            lat: originLat,
                            lng: originLng,
                        },
                        zoom: 15,
                    },
                    apiKey: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjVmMDFmMDMxOTE2MmYxMWM4YjFmNjAxZGEzZWM0ZTcyZDI1ZjMxY2ZiZDI0NjM2MzE0OGJjZWI5NzcwN2VlOTM4NjBhZmNlOTc0NTZlMjk2In0.eyJhdWQiOiIxNjMzMCIsImp0aSI6IjVmMDFmMDMxOTE2MmYxMWM4YjFmNjAxZGEzZWM0ZTcyZDI1ZjMxY2ZiZDI0NjM2MzE0OGJjZWI5NzcwN2VlOTM4NjBhZmNlOTc0NTZlMjk2IiwiaWF0IjoxNjk1MjQwOTI3LCJuYmYiOjE2OTUyNDA5MjcsImV4cCI6MTY5NzU3MzcyNywic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.ggya0Flw4c5RI67geif-boTPM15vM4nIRF1fKflZbHxVHdv6TMhRQkR_cyCOnoL8M-JzsHrVloiHZqb64_laAMNqNMjjWPqcmPFo-AOEqG3v_-8k1bPfxM_6iZEsARwmdVqwByG9KEKleJ8lZR6TKuSWQtDPw_9wTP39bWAw7udKLCw_cDRo_ZOYUSqFXwypDi3YEvQNXP1YaTDvTIQbZRWMgwDEJ1d9F2oymRcWnJyTSiW_KCDeYl7kQr74pGafUAGtgGskB2Weh2MZYJzsdM-9ioX1lBHbnDCdaHY8rLzDeLPu7gFSgK6HQ2CXQlbkrY90a-f2G69GG1iqGsPHjA'
                });
                app.addLayers();
                app.addMarker({
                    name: 'advanced-marker',
                    latlng: {
                        lat: originLat,
                        lng: originLng
                    },
                    zoom: 16,
                    draggable: false,
                    popup: false,
                });
            }
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('map'); ?>
    <script src="/js/jquery.toast.min.js"></script>
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mapLink'); ?>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pay/show.blade.php ENDPATH**/ ?>