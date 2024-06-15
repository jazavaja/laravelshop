<div class="allProfileList">
    <div class="allUserIndexList">
        <div class="allUserIndexListsUser">
            <div class="allUserIndexListsUserPic">
                <div class="pic">
                    @if(auth()->user()->profile)
                        <img src="{{auth()->user()->profile}}" alt="{{auth()->user()->name}}">
                    @else
                        <img src="/img/user.png" alt="{{auth()->user()->name}}">
                    @endif
                </div>
            </div>
            <div class="allUserIndexListsUserItem">
                <div class="allUserIndexListsUserName">{{ auth()->user()->name }}</div>
            </div>
            <h4> {{__('messages.identification_code')}} : {{auth()->user()->referral}}</h4>
            <h4> {{__('messages.my_score')}} : {{$scores}}</h4>
        </div>
        <div class="allUserIndexListItems">
            <a href="/profile/personal-info">{{__('messages.user_edit')}}</a>
            <a href="/logout">{{__('messages.exit_user')}}</a>
        </div>
    </div>
    <div class="walletData">
        <i>
            <svg class="icon">
                <use xlink:href="#wallet"></use>
            </svg>
        </i>
        <h3>{{number_format($wallet)}} <span>{{__('messages.arz')}}</span></h3>
        <a href="/charge">{{__('messages.charge1')}}</a>
    </div>
    @if($checkSeller == 1)
        <a class="becomeList" href="/seller/dashboard">
            <h4>
                <i>
                    <svg class="icon">
                        <use xlink:href="#seller"></use>
                    </svg>
                </i>
                {{__('messages.seller_panel')}}
            </h4>
            <div class="pic"></div>
        </a>
    @else
        <a class="becomeList" href="/become-seller">
            <h4>
                <i>
                    <svg class="icon">
                        <use xlink:href="#seller"></use>
                    </svg>
                </i>
                {{__('messages.seller')}}
            </h4>
            <div class="pic"></div>
        </a>
    @endif
    <div class="allUserIndexListsItems">
        <div class="allUserIndexListsItem">
            <a href="/profile/subcategory">{{__('messages.sub1')}}</a>
            @if($tab == 6)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/pay">{{__('messages.order_user')}}</a>
            @if($tab == 1)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/like">{{__('messages.like_user')}}</a>
            @if($tab == 2)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/convert">{{__('messages.change_score')}}</a>
            @if($tab == 7)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/bookmark">{{__('messages.bookmark_user')}}</a>
            @if($tab == 3)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/comment">{{__('messages.comments')}}</a>
            @if($tab == 4)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/ticket">{{__('messages.ticket1')}}</a>
            @if($tab == 5)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile/counseling">{{__('messages.counseling')}}</a>
            @if($tab == 6)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
        <div class="allUserIndexListsItem">
            <a href="/profile">{{__('messages.dashboard')}}</a>
            @if($tab == 0)
                <i>
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            @endif
        </div>
    </div>
</div>
