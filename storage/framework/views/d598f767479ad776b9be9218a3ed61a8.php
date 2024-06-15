<?php $__env->startSection('tab',10); ?>
<?php $__env->startSection('content'); ?>
    <div class="allCreatePost">
        <form class="allCreatePost" action="/admin/user/create" method="POST">
            <?php echo csrf_field(); ?>
            <div class="allPostPanelTop">
                <h1>افزودن کاربر</h1>
                <div class="allPostTitle">
                    <a href="/admin">داشبورد</a>
                    <span>/</span>
                    <a href="/admin/user">همه کاربر ها</a>
                    <span>/</span>
                    <a href="/admin/user/create">افزودن کاربر</a>
                </div>
            </div>
            <div class="allCreatePostData">
                <div class="allCreatePostSubject">
                    <div class="allCreatePostItem">
                        <label>نام کاربری :</label>
                        <input type="text" name="name" placeholder="عنوان را وارد کنید">
                        <div class="alert" id="validation-name"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>رمز عبور :</label>
                        <input type="password" name="password" placeholder="رمز عبور را وارد کنید">
                        <div class="alert" id="validation-password"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>ایمیل :</label>
                        <input type="text" name="email" placeholder="ایمیل را وارد کنید">
                        <div class="alert" id="validation-email"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>شماره تماس :</label>
                        <input type="text" name="number" placeholder="شماره تماس را وارد کنید">
                        <div class="alert" id="validation-number"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>وضعیت کاربر :</label>
                        <select name="admin">
                            <option value="0" selected>کاربر ساده</option>
                            <option value="1">مدیر کل</option>
                        </select>
                        <div class="alert" id="validation-admin"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>فعالیت کاربر :</label>
                        <select name="suspension">
                            <option value="0" selected>فعال</option>
                            <option value="1">تعلیق / غیرفعال</option>
                        </select>
                        <div class="alert" id="validation-suspension"></div>
                    </div>
                    <button class="button" name="createPost" type="submit">ارسال اطلاعات</button>
                </div>
                <div class="allCreatePostDetails">
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            فیلد های اختصاصی
                        </div>
                        <div class="allCreatePostDetailItems">
                            <?php $__currentLoopData = \App\Models\Field::where('status' , 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="allCreatePostDetailItem2">
                                    <label>
                                        <?php echo e($item->name); ?>

                                        <?php if($item->required_status): ?><span>*</span><?php endif; ?>:
                                    </label>
                                    <?php if($item->type == 0): ?>
                                        <input type="text" name="field<?php echo e($item->id); ?>" <?php echo e($item->disable_status == 1 ? 'disabled' : ''); ?> value="<?php echo e($item->value); ?>" placeholder="<?php echo e($item->name); ?> را وارد کنید">
                                    <?php elseif($item->type == 1): ?>
                                        <textarea name="field<?php echo e($item->id); ?>" <?php echo e($item->disable_status == 1 ? 'disabled' : ''); ?> placeholder="<?php echo e($item->name); ?> را وارد کنید"><?php echo e($item->value); ?></textarea>
                                    <?php elseif($item->type == 2): ?>
                                        <input type="number" name="field<?php echo e($item->id); ?>" <?php echo e($item->disable_status == 1 ? 'disabled' : ''); ?> value="<?php echo e($item->value); ?>" placeholder="<?php echo e($item->name); ?> را وارد کنید">
                                    <?php elseif($item->type == 3): ?>
                                        <input type="email" name="field<?php echo e($item->id); ?>" <?php echo e($item->disable_status == 1 ? 'disabled' : ''); ?> value="<?php echo e($item->value); ?>" placeholder="<?php echo e($item->name); ?> را وارد کنید">
                                    <?php elseif($item->type == 4): ?>
                                        <input type="color" name="field<?php echo e($item->id); ?>" <?php echo e($item->disable_status == 1 ? 'disabled' : ''); ?> value="<?php echo e($item->value); ?>" placeholder="<?php echo e($item->name); ?> را وارد کنید">
                                    <?php elseif($item->type == 5): ?>
                                        <input type="checkbox" name="field<?php echo e($item->id); ?>" <?php echo e($item->disable_status == 1 ? 'disabled' : ''); ?> value="<?php echo e($item->value); ?>" placeholder="<?php echo e($item->name); ?> را وارد کنید">
                                    <?php else: ?>
                                        <select name="field<?php echo e($item->id); ?>" <?php echo e($item->disable_status == 1 ? 'disabled' : ''); ?>>
                                            <?php $__currentLoopData = explode(',',$item->choice); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($val); ?>" <?php echo e($item->value == $val ? 'selected' : null); ?>><?php echo e($val); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php endif; ?>
                                    <?php $__errorArgs = ['field'.$item->id];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert"><?php echo e($item->name); ?> اجباری است</div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            تاکسونامی
                        </div>
                        <div class="allCreatePostDetailItems">
                            <div class="allCreatePostDetailItem">
                                <label>مقام :</label>
                                <select class="js-example-basic-single" name="role">
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->name); ?>"><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>دسترسی ویژه :</label>
                                <select class="permissions-multiple" name="permissions[]" multiple="multiple">
                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($permission->name); ?>"><?php echo e($permission->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            $('.permissions-multiple').select2({
                placeholder: 'دسترسی را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });
            $('.js-example-basic-single').select2({
                placeholder: 'مقام را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/select2.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('links'); ?>
    <link rel="stylesheet" href="/css/select2.min.css"/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/user/create.blade.php ENDPATH**/ ?>