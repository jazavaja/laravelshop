@extends('admin.master')

@section('tab',36)
@section('content')
    <div class="allBarcodePanel">
        <div class="title">
            <div class="item" id="{{request()->show == 0 ? 'activeB' : ''}}" data-num="0">متن</div>
            <div class="item" id="{{request()->show == 1 ? 'activeB' : ''}}" data-num="1">آدرس</div>
            <div class="item" id="{{request()->show == 2 ? 'activeB' : ''}}" data-num="2">تماس</div>
            <div class="item" id="{{request()->show == 3 ? 'activeB' : ''}}" data-num="3">پیامک</div>
            <div class="item" id="{{request()->show == 4 ? 'activeB' : ''}}" data-num="4">واتساپ</div>
            <div class="item" id="{{request()->show == 5 ? 'activeB' : ''}}" data-num="5">موقعیت مکانی</div>
            <div class="item" id="{{request()->show == 6 ? 'activeB' : ''}}" data-num="6">ایمیل</div>
            <div class="item" id="{{request()->show == 7 ? 'activeB' : ''}}" data-num="7">فیس تایم</div>
        </div>
        <div class="content">
            <div>
                <div class="right">
                    <div class="item show1" style="display: none">
                        <label>آدرس صفحه</label>
                        <input name="url" placeholder="لینک را وارد کنید">
                    </div>
                    <div class="item show2 show3 show4 show7" style="display: none">
                        <label>شماره تماس</label>
                        <input name="phone" placeholder="شماره را وارد کنید">
                    </div>
                    <div class="item show5" style="display: none">
                        <label>lat</label>
                        <input name="lat" placeholder="lat خود را وارد کنید">
                    </div>
                    <div class="item show5" style="display: none">
                        <label>lng</label>
                        <input name="lng" placeholder="lng خود را وارد کنید">
                    </div>
                    <div class="item show6" style="display: none">
                        <label>ایمیل</label>
                        <input name="email" type="email" placeholder="ایمیل خود را وارد کنید">
                    </div>
                    <div class="item show0 show4">
                        <label>متن</label>
                        <textarea name="body" placeholder="متن خود را وارد کنید"></textarea>
                    </div>
                    <button>ساخت کیوآر</button>
                </div>
            </div>
            <div class="left">
                <div class="pics">
                    <div class="pic" id="printMe1">
                        @if(request()->show == '')
                            <img src="/img/qr_code.svg" alt="">
                        @elseif(request()->show == 0 || request()->show == 1)
                            {!! DNS2D::getBarcodeHTML(request()->body, 'QRCODE',8,8) !!}
                        @elseif(request()->show == 2)
                            {!! DNS2D::getBarcodeHTML('tel:'.request()->phone, 'QRCODE',8,8) !!}
                        @elseif(request()->show == 3)
                            {!! DNS2D::getBarcodeHTML('sms:'.request()->phone, 'QRCODE',8,8) !!}
                        @elseif(request()->show == 4)
                            {!! DNS2D::getBarcodeHTML('https://wa.me/'.request()->phone.'?text='.request()->body, 'QRCODE',8,8) !!}
                        @elseif(request()->show == 5)
                            {!! DNS2D::getBarcodeHTML('https://www.google.com/maps/@'.request()->lat.','.request()->lng.',13.63z?entry=ttu', 'QRCODE',8,8) !!}
                        @elseif(request()->show == 6)
                            {!! DNS2D::getBarcodeHTML('mailto:'.request()->email, 'QRCODE',8,8) !!}
                        @else
                            {!! DNS2D::getBarcodeHTML('facetime:'.request()->phone, 'QRCODE',8,8) !!}
                        @endif
                    </div>
                </div>
                <div class="download">
                    <div class="button download1">دانلود</div>
                    <div class="button print1">چاپ</div>
                    <p>میتوانید از طریق دکمه های بالا اقدام به دریافت کیوآر خود کنید</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var show1 = {!! json_encode($show1, JSON_HEX_TAG) !!};
            $('.allBarcodePanel .content .right .item').hide();
            $('.allBarcodePanel .content .right .show'+show1).show();

            $('.allBarcodePanel .title').on('click' , '.item' ,function(){
                $('.allBarcodePanel .title .item').attr('id' , '');
                $(this).attr('id' , 'activeB');
                $('.allBarcodePanel .content .right .item').hide();
                $('.allBarcodePanel .content .right .show'+$(this).attr('data-num')).show();
            })
            $('.allBarcodePanel .right').on('click' , 'button' ,function(){
                var show = $(".allBarcodePanel #activeB").attr('data-num');
                var url = $("input[name='url']").val();
                var phone = $("input[name='phone']").val();
                var lng = $("input[name='lng']").val();
                var lat = $("input[name='lat']").val();
                var email = $("input[name='email']").val();
                var body = $("textarea[name='body']").val();
                if(show == 0){
                    window.location.href = '/admin/barcode?show='+show+'&body='+body
                }
                if(show == 1){
                    window.location.href = '/admin/barcode?show='+show+'&body='+url
                }
                if(show == 2 || show == 3){
                    window.location.href = '/admin/barcode?show='+show+'&phone='+phone
                }
                if(show == 4){
                    window.location.href = '/admin/barcode?show=4&phone='+phone+'&body='+body
                }
                if(show == 5){
                    window.location.href = '/admin/barcode?show=5&lng='+lng+'&lat='+lat
                }
                if(show == 6){
                    window.location.href = '/admin/barcode?show=6&email='+email
                }
                if(show == 7){
                    window.location.href = '/admin/barcode?show=7&phone='+phone
                }
            })
            $('.allBarcodePanel .content .print1').click(function() {
                var divToPrint=document.getElementById('printMe1');
                var newWin=window.open('','Print-Window');
                newWin.document.open();
                newWin.document.write('<html><head><link rel="stylesheet" href="/css/admin.css"/></head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                newWin.document.close();
            });
            function getClippedRegion(image, x, y, width, height) {
                var canvas = document.createElement("canvas"),
                    ctx = canvas.getContext("2d");

                canvas.width = width;
                canvas.height = height;

                //                   source region         dest. region
                ctx.drawImage(image, x, y, width, height, 0, 0, width, height);

                return {
                    // Those are some pdfMake params
                    image: canvas.toDataURL(),
                    width: 500
                };
            }

            $(".allBarcodePanel .content").on("click", ".download1", function () {
                html2canvas($(".allBarcodePanel .content #printMe1")[0], {
                    onrendered: function (canvas) {
                        // split the canvas produced by html2canvas into several, based on desired PDF page height
                        let splitAt = 775; // A page height which fits for "LETTER" pageSize...

                        let images = [];
                        let y = 0;
                        while (canvas.height > y) {
                            images.push(getClippedRegion(canvas, 0, y, canvas.width, splitAt));
                            y += splitAt;
                        }

                        // PDF creation using pdfMake
                        var docDefinition = {
                            content: images,
                            pageSize: "LETTER"
                        };
                        pdfMake.createPdf(docDefinition).download('qr'+".pdf");
                    }
                });
            });
        })
    </script>
@endsection

@section('mapLink')
    <script type="text/javascript" src="/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="/js/html2canvas.min.js"></script>
@endsection
