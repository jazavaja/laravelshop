@extends('home.master')

@section('title' , __('messages.seller') . ' - ')
@section('content')
    <div class="allBecomeSeller width">
        <div class="allBecomeSellerTop">
            <div class="allBecomeSellerLevels">
                <div class="allBecomeSellerLevel" title="{{__('messages.seller_status1')}}">
                    <div class="allBecomeSellerLevelBar"></div>
                    <div class="allBecomeSellerLevelCircleActive">
                        <svg class="icon">
                            <use xlink:href="#contact-info"></use>
                        </svg>
                    </div>
                </div>
                <div class="allBecomeSellerLevel" title="{{__('messages.seller_status2')}}">
                    <div class="allBecomeSellerLevelBar"></div>
                    <div class="allBecomeSellerLevelCircle">
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
            <h4>{{__('messages.seller_info')}}</h4>
            <p>{{__('messages.seller_info2')}}</p>
        </div>
        <form method="post" action="/become-seller" class="allBecomeUserInfo">
            @csrf
            <div class="allBecomeTip">
                <span>{{__('messages.login_attention')}} :</span>
                <p>{{__('messages.seller_fill_info')}}</p>
            </div>
            <div class="sellerType">
                <h3>{{__('messages.seller_type1')}}</h3>
                <select name="seller">
                    <option value="1" selected>{{__('messages.seller_type2')}}</option>
                    <option value="2">{{__('messages.seller_type3')}}</option>
                </select>
                @error('seller')
                <div class="alert">{{__('messages.seller_necessary')}}</div>
                @enderror
                <p id="sellerText1">{{__('messages.seller_info3')}}</p>
                <p id="sellerText2">{{__('messages.seller_info4')}}</p>
            </div>
            <div class="personInfoSeller" id="seller1">
                <h3>{{__('messages.seller_info')}}</h3>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_name')}}</h4>
                        <input type="text" placeholder="{{__('messages.seller_name')}}" name="firstName">
                        @error('firstName')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_natural')}}</h4>
                        <input type="text" placeholder="{{__('messages.seller_natural')}}" name="code">
                        @error('code')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_gender1')}}</h4>
                        <select name="gender">
                            <option value="0" selected>{{__('messages.seller_gender2')}}</option>
                            <option value="1">{{__('messages.seller_gender3')}}</option>
                        </select>
                        @error('gender')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="personInfoSeller" id="seller2">
                <h3>{{__('messages.seller_company')}}</h3>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_company_name')}}</h4>
                        <input type="text" placeholder="{{__('messages.seller_company_name')}}" name="companyName">
                        @error('companyName')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_company_type')}}</h4>
                        <select name="type">
                            <option value="0">{{__('messages.seller_company_type1')}}</option>
                            <option value="1">{{__('messages.seller_company_type2')}}</option>
                            <option value="2">{{__('messages.seller_company_type3')}}</option>
                            <option value="3">{{__('messages.seller_company_type4')}}</option>
                            <option value="4">{{__('messages.seller_company_type5')}}</option>
                        </select>
                        @error('type')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_company_registration')}}</h4>
                        <input type="text" placeholder="{{__('messages.seller_company_registration')}}" name="registrationNumber">
                        @error('registrationNumber')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_company_natural')}}</h4>
                        <input type="text" placeholder="{{__('messages.seller_company_natural')}}" name="nationalID">
                        @error('nationalID')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_company_economic')}}</h4>
                        <input type="text" placeholder="{{__('messages.seller_company_economic')}}" name="economicCode">
                        @error('economicCode')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_company_sig')}}</h4>
                        <input type="text" placeholder="{{__('messages.seller_company_sig')}}" name="signatureOwners">
                        @error('signatureOwners')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>{{__('messages.address')}}</h4>
                        <input type="text" placeholder="{{__('messages.address')}}" name="residenceAddress">
                    </div>
                </div>
            </div>
            <div class="contactSeller">
                <h3>{{__('messages.seller_call')}}</h3>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>{{__('messages.address')}}</h4>
                        <input type="text" placeholder="{{__('messages.address')}}" name="residenceAddress">
                        @error('residenceAddress')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                </div>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_post')}}</h4>
                        <input type="text" placeholder="{{__('messages.seller_post')}}" name="post">
                        @error('post')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_phone')}}</h4>
                        <input type="text" placeholder="{{__('messages.seller_phone')}}" name="landlinePhone" value="{{auth()->user()->landlinePhone}}">
                        @error('landlinePhone')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="contactSeller">
                <h3>{{__('messages.seller_business')}}</h3>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_user')}}</h4>
                        <input type="text" placeholder="{{__('messages.seller_user')}}" value="{{auth()->user()->name}}" name="name">
                        @error('name')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_category')}} :</h4>
                        <select name="category">
                            @foreach($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                    <div class="personInfoItem">
                        <h4>{{__('messages.seller_card')}}</h4>
                        <input type="text" placeholder="{{__('messages.seller_card')}}" value="{{auth()->user()->shaba}}" name="shaba">
                        @error('shaba')
                        <div class="alert">{{__('messages.seller_necessary')}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button>{{__('messages.submit')}}</button>
            </div>
        </form>
    </div>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            $('#seller2').hide();
            $('#sellerText2').hide();
            $(".allBecomeSeller select[name='seller']").on('change',function(){
                $('#seller1').hide();
                $('#seller2').hide();
                $('#sellerText2').hide();
                $('#sellerText1').hide();
                if($(this).val() == 1){
                    $('#seller1').show();
                    $('#sellerText1').show();
                }else{
                    $('#seller2').show();
                    $('#sellerText2').show();
                }
            });
        })
    </script>
@endsection
