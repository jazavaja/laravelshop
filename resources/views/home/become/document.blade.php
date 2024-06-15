@extends('home.master')

@section('title' , __('messages.seller') . ' - ')
@section('content')
    <div class="allBecomeSeller width">
        <div class="allBecomeSellerTop">
            <div class="allBecomeSellerLevels">
                <div class="allBecomeSellerLevel" title="{{__('messages.seller_status1')}}">
                    <div class="allBecomeSellerLevelBarActive"></div>
                    <div class="allBecomeSellerLevelCircleActives">
                        <svg class="icon">
                            <use xlink:href="#contact-info"></use>
                        </svg>
                    </div>
                </div>
                <div class="allBecomeSellerLevel" title="{{__('messages.seller_status2')}}">
                    <div class="allBecomeSellerLevelBar"></div>
                    <div class="allBecomeSellerLevelCircleActives">
                        <svg class="icon">
                            <use xlink:href="#uploadDocuments"></use>
                        </svg>
                    </div>
                </div>
                <div class="allBecomeSellerLevel" title="{{__('messages.seller_status3')}}">
                    <div class="allBecomeSellerLevelBar"></div>
                    <div class="allBecomeSellerLevelCircle">
                        <svg class="icon">
                            <use xlink:href="#checkDocuments"></use>
                        </svg>
                    </div>
                </div>
                <div class="allBecomeSellerLevel" title="{{__('messages.seller_status4')}}">
                    <div class="allBecomeSellerLevelCircle">
                        <svg class="icon">
                            <use xlink:href="#welcomeSeller"></use>
                        </svg>
                    </div>
                </div>
            </div>
            <h4>{{__('messages.seller_doc')}}</h4>
            <p>{{__('messages.seller_doc2')}}</p>
        </div>
        @if (\Session::has('success'))
            <div class="success">
                {!! \Session::get('success') !!}
            </div>
        @endif
        <form method="post" action="/send-document" enctype="multipart/form-data" class="uploadDocument">
            @csrf
            <h3>{{__('messages.seller_pic_natural')}}</h3>
            <ul>
                <li>{{__('messages.seller_pic_natural1')}}</li>
                <li>{{__('messages.seller_pic_natural2')}}</li>
                <li>{{__('messages.seller_pic_natural3')}}</li>
            </ul>
            <div class="sendFileItem">
                <div class="sendImage">
                    <input type="file" id="post_cover" class="dropify" name="frontImage"/>
                </div>
            </div>
            <div class="sendFileItem">
                <div class="sendImage">
                    <input type="file" id="post_cover" class="dropify2" name="backImage"/>
                </div>
            </div>
            <div class="buttons">
                <button type="submit" id="upload-image-form">{{__('submit')}}</button>
            </div>
        </form>
    </div>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            var seller_front1 = {!! json_encode(__('messages.seller_front'), JSON_HEX_TAG) !!};
            var seller_back1 = {!! json_encode(__('messages.seller_back'), JSON_HEX_TAG) !!};
            var delete_pic1 = {!! json_encode(__('messages.delete_pic'), JSON_HEX_TAG) !!};
            var seller_front2 = {!! json_encode(__('messages.seller_front2'), JSON_HEX_TAG) !!};
            var delete_pic2 = {!! json_encode(__('messages.delete_pic2'), JSON_HEX_TAG) !!};
            $('.dropify').dropify({
                messages: {
                    default: seller_front1,
                    replace: seller_front2,
                    remove: delete_pic1,
                    error: delete_pic2,
                }
            });
            $('.dropify2').dropify({
                messages: {
                    default: seller_back1,
                    replace: seller_front2,
                    remove: delete_pic1,
                    error: delete_pic2,
                }
            });
        })
    </script>
@endsection

@section('jsScript')
    <link rel="stylesheet" href="/css/dropify.min.css"/>
    <script src="/js/dropify.min.js"></script>
@endsection
