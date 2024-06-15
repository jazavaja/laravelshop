<?php $__env->startSection('tab',5); ?>
<?php $__env->startSection('content'); ?>
    <div class="allCreatePost">
        <div class="allCreatePost">
            <div class="allPostPanelTop">
                <h1>افزودن بلاگ</h1>
                <div class="allPostTitle">
                    <a href="/admin">داشبورد</a>
                    <span>/</span>
                    <a href="/admin/blog">همه بلاگ ها</a>
                    <span>/</span>
                    <a href="/admin/blog/create">افزودن بلاگ</a>
                </div>
            </div>
            <div class="allCreatePostData">
                <div class="allCreatePostSubject">
                    <div class="allCreatePostItem">
                        <label>عنوان سئو :</label>
                        <input type="text" name="titleSeo" placeholder="عنوان را وارد کنید">
                        <div id="validation-titleSeo"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>توضیحات سئو :</label>
                        <textarea name="bodySeo" placeholder="توضیحات را وارد کنید"></textarea>
                        <div id="validation-bodySeo"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>کلمات کلیدی :</label>
                        <input type="text" name="keywordSeo" placeholder="با , جدا کنید">
                        <div id="validation-keywordSeo"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>alt تصویر :</label>
                        <input type="text" name="imageAlt" placeholder="عنوان را وارد کنید">
                        <div id="validation-imageAlt"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>توضیحات :</label>
                        <textarea name="body" class="editor"></textarea>
                    </div>
                    <div class="addImageButton">برای افزودن تصویر کلیک کنید</div>
                    <div class="sendGallery">
                        <div class="getImageItem">
                            <span id="imageTooltip">تصاویر خود را وارد کنید</span>
                        </div>
                    </div>
                    <button class="button" name="createPost" type="submit">ارسال اطلاعات</button>
                </div>
                <div class="allCreatePostDetails">
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            فیلد های اختصاصی
                        </div>
                        <div class="allCreatePostDetailItems">
                            <?php $__currentLoopData = \App\Models\Field::where('status' , 2)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            جزییات
                        </div>
                        <div class="allCreatePostDetailItems">
                            <div class="allCreatePostDetailItem">
                                <label>عنوان* :</label>
                                <input type="text" name="title" placeholder="عنوان را وارد کنید">
                                <div id="validation-title"></div>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>زبان* :</label>
                                <select name="language">
                                    <option value="fa" selected>فارسی</option>
                                    <option value="en">انگلیسی</option>
                                    <option value="ar">عربی</option>
                                    <option value="tr">ترکی</option>
                                </select>
                                <div id="validation-language"></div>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>ویدئو :</label>
                                <input type="text" name="video" placeholder="لینک را وارد کنید">
                                <div id="validation-video"></div>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>پیوند(slug) :</label>
                                <input type="text" name="slug" placeholder="پیوند را وارد کنید">
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>مدت زمان مطالعه* :</label>
                                <input type="text" name="time" placeholder="به دقیقه وارد کنید">
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>وضعیت* :</label>
                                <select name="status" id="status">
                                    <option value="0">پیشنویس</option>
                                    <option value="1" selected>منتشر شده</option>
                                </select>
                                <div id="validation-status"></div>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label for="s1d" class="allCreatePostDetailItemData">
                                    پیشنهاد
                                    <input id="s1d" type="checkbox" name="suggest" class="switch" >
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            تاکسونامی
                        </div>
                        <div class="allCreatePostDetailItems">
                            <div class="allCreatePostDetailItem">
                                <label>دسته بندی :</label>
                                <select class="cats-multiple" name="cats" multiple="multiple">
                                    <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>برچسب :</label>
                                <select class="tags-multiple" name="tags" multiple="multiple">
                                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="filemanager">
            <?php echo $__env->make('admin.filemanager', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            $('.filemanager').hide();
            $('.addImageButton').click(function(){
                $('.filemanager').show();
            });
            $('.tags-multiple').select2({
                placeholder: 'برچسب را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });
            $('.cats-multiple').select2({
                placeholder: 'دسته بندی را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });
            $( 'textarea.editor' ).ckeditor();
            $("button[name='createPost']").click(function(event){
                $("button[name='createPost']").text('صبر کنید ...');
                var title = $(".allCreatePostDetailItems input[name='title']").val();
                var slug = $("input[name='slug']").val();
                var status = $("select[name='status']").val();
                var language = $("select[name='language']").val();
                var body = $(".allCreatePostItem textarea[name='body']").val();
                var suggest = $("input[name='suggest']").is(":checked");
                var titleSeo = $("input[name='titleSeo']").val();
                var video = $("input[name='video']").val();
                var time = $("input[name='time']").val();
                var bodySeo = $("textarea[name='bodySeo']").val();
                var keywordSeo = $("input[name='keywordSeo']").val();
                var imageAlt = $("input[name='imageAlt']").val();
                var tags = [];
                var cats = [];
                var image = [];
                $(".getImagePic").each(function(){
                    image= this.lastElementChild.src;
                });
                $("select[name='cats'] :selected").each(function(){
                    cats.push($(this).val());
                });
                $("select[name='tags'] :selected").each(function(){
                    tags.push($(this).val());
                });

                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    title:title,
                    slug:slug,
                    status:status,
                    language:language,
                    suggest:suggest,
                    time:time,
                    body:body,
                    titleSeo:titleSeo,
                    video:video,
                    bodySeo:bodySeo,
                    keywordSeo:keywordSeo,
                    imageAlt:imageAlt,
                    cats:JSON.stringify(cats),
                    tags:JSON.stringify(tags),
                    image: image,
                };
                $(".allCreatePostDetailItem2").each(function(){
                    form[$($(this)[0]['children'][1]).attr('name')] = $($(this)[0]['children'][1]).val()
                });

                $.ajax({
                    url: "/admin/blog/create",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $.toast({
                            text: "بلاگ اضافه شد", // Text that is to be shown in the toast
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
                        window.location.href="/admin/blog";
                    },
                    error: function (xhr) {
                        $("button[name='createPost']").text('ارسال اطلاعات');
                        $.toast({
                            text: "فیلد های ستاره دار را پر کنید", // Text that is to be shown in the toast
                            heading: 'دقت کنید', // Optional heading to be shown on the toast
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
                        $.each(xhr.responseJSON.errors, function(key,value) {
                            $('#validation-' + key).append('<div class="alert alert-danger">'+value+'</div');
                        });
                    }
                });
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/jquery.toast.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/editor/ckeditor.js"></script>
    <script src="/js/editor/adapters/jquery.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('links'); ?>
    <link rel="stylesheet" href="/css/select2.min.css"/>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/blog/create.blade.php ENDPATH**/ ?>