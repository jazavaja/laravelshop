<div class="allFastSearch width">
    <div class="titleFastSearch">{{__('messages.help_search')}}</div>
    <div class="taxChoice firstTax">
        <h4>{{__('messages.help_cat')}}</h4>
        <div class="buttons">
            <button class="cancelCat">{{__('messages.no')}}</button>
            <button class="choiceCat" disabled>{{__('messages.select_cat')}}</button>
        </div>
        <div class="categories">
            @foreach($categories as $item)
                <div class="cat" data="{{$item->id}}">{{$item->name}}</div>
            @endforeach
        </div>
    </div>
    <div class="taxChoice secTax" style="display:none;">
        <h4>{{__('messages.help_brand')}}</h4>
        <div class="buttons">
            <button class="cancelCat">{{__('messages.no')}}</button>
            <button class="choiceCat" disabled>{{__('messages.select_brand')}}</button>
        </div>
        <div class="categories">
            @foreach($brandIndex as $item)
                <div class="brand" data="{{$item->id}}">{{$item->name}}</div>
            @endforeach
        </div>
    </div>
    <div class="taxChoice thirdTax" style="display:none;">
        <h4>{{__('messages.help_property')}}</h4>
        <div class="buttons">
            <button class="choiceCat">{{__('messages.search_product')}}</button>
        </div>
        <div class="categories">
            <div class="brand active" data="0">{{__('messages.order_new')}}</div>
            <div class="brand" data="1">{{__('messages.order_cheap')}}</div>
            <div class="brand" data="2">{{__('messages.order_expensive')}}</div>
            <div class="brand" data="3">{{__('messages.order_sell')}}</div>
            <div class="brand" data="4">{{__('messages.order_like')}}</div>
            <div class="brand" data="5">{{__('messages.order_off')}}</div>
            <div class="brand" data="6">{{__('messages.order_suggest')}}</div>
            <div class="brand" data="7">{{__('messages.order_exist')}}</div>
        </div>
    </div>
    <div class="productShow" style="display:none;">
        <div class="rightProduct">
            <h3>{{__('messages.suggest_buy')}}</h3>
            <a href="/" class="productItem">
                <figure class="productPic">
                    <img src="" alt="">
                </figure>
                <h4></h4>
                <div class="price">
                    <s>0</s>
                    <h5>0</h5>
                </div>
                <div class="buttons options">
                    <div name="quickBuy">{{__('messages.buy_fast')}}</div>
                    <div name="addCart">{{__('messages.add_cart')}}</div>
                </div>
            </a>
        </div>
        <div class="leftProduct">
            <h3>{{__('messages.help_product')}}</h3>
            <div class="slider-fastSearch owl-carousel owl-theme"></div>
        </div>
    </div>
</div>
