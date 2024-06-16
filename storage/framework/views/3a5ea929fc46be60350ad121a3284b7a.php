<?php $__env->startSection('tab' , 17); ?>
<?php $__env->startSection('content'); ?>
    <div class="profileIndexTicket">
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <table>
            <tr>
                <th>عنوان</th>
                <th>وضعیت پاسخ</th>
                <th>وضعیت درخواست</th>
                <th>زمان ثبت</th>
                <th>عملیات</th>
            </tr>
            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <span><?php echo e($item->body); ?></span>
                    </td>
                    <td>
                        <?php if($item->answer): ?>
                            <span>پاسخ داده شده</span>
                        <?php else: ?>
                            <span>در حال بررسی</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($item->status == 0): ?>
                            <span>در حال بررسی</span>
                        <?php endif; ?>
                        <?php if($item->status == 1): ?>
                            <span>تایید شده</span>
                        <?php endif; ?>
                        <?php if($item->status == 2): ?>
                            <span>رد شده</span>
                        <?php endif; ?>
                        <?php if($item->status == 3): ?>
                            <span>بسته شده</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span><?php echo e($item->created_at); ?></span>
                    </td>
                    <td>
                        <div class="buttons">
                            <input type="hidden" value="<?php echo e($item->body); ?>" name="body" id="<?php echo e($item->id); ?>">
                            <button id="<?php echo e($item->id); ?>" class="editButton">نمایش کامل</button>
                            <input type="hidden" value="<?php echo e($item->answer); ?>" name="answer" id="<?php echo e($item->id); ?>">
                            <button id="<?php echo e($item->id); ?>" class="deleteButton">حذف</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف درخواست مطمئن هستید؟</div>
                <p>با حذف درخواست اطلاعات درخواست به طور کامل حذف میشوند</p>
                <div class="buttonsPop">
                    <form method="POST" action="" id="deletePost">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit">حذف شود</button>
                    </form>
                    <button id="cancelDelete">منصرف شدم</button>
                </div>
            </div>
        </div>
        <div class="showTicket" style="display:none">
            <form class="ticketData" action="" method="POST">
                <?php echo csrf_field(); ?>
                <div class="itemsTicket">
                    <h4>درخواست :</h4>
                    <textarea name="body"></textarea>
                </div>
                <div class="itemsAnswer">
                    <h4>پاسخ :</h4>
                    <textarea name="answer"></textarea>
                </div>
                <div class="itemsStatus">
                    <h4>وضعیت :</h4>
                    <select name="status">
                        <option value="0">در حال بررسی</option>
                        <option value="1">تایید شده</option>
                        <option value="2">رد شده</option>
                        <option value="3">بسته شده</option>
                    </select>
                </div>
                <div class="buttonsPop">
                    <button>ثبت</button>
                    <h5 id="btnCancel">انصراف</h5>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            var post = 0;
            $('.popUp').hide();
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.buttons').on('click' , '.deleteButton' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/ticket/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                $('.showTicket').show(100);
                $('.showTicket form').attr('action' , '/admin/ticket/' + this.id+'/edit');
                $(".showTicket .itemsTicket textarea[name='body']").val($(this.previousElementSibling).val())
                $(".showTicket .itemsAnswer textarea[name='answer']").val($(this.nextElementSibling).val())
            })
            $('.showTicket #btnCancel').on('click' ,function(){
                post = 0;
                $('.showTicket').hide(100);
                $(".showTicket .itemsTicket textarea[name='body']").val('')
                $(".showTicket .itemsAnswer textarea[name='answer']").val('')
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/ticket/index.blade.php ENDPATH**/ ?>