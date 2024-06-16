<div class="allSideBar">
    <div class="logoHeaderPanel">
        <a href="/">
            <img src="{{$logo}}">
        </a>
    </div>
    <div class="allSideBarItem">
        <div class="allSideBarIconsText">
            <div class="active" id="showList1">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <span class="shape3"></span>
                <span class="shape4"></span>
                <i>
                    <svg class="icon">
                        <use xlink:href="#home"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">{{__('messages.dashboard')}}</span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList1">
                <i>
                    <svg class="icon">
                        <use xlink:href="#home"></use>
                    </svg>
                </i>
                {{__('messages.dashboard')}}
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
            <ul id="showList1" class="active">
                <li>
                    <a href="/">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.home')}}
                    </a>
                </li>
                <li>
                    <a href="/seller/dashboard">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.home')}}
                    </a>
                </li>
            </ul>
        </div>
        <a class="allSideBarIconsText" href="/seller/gallery">
            <div class="active" id="showList2">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <span class="shape3"></span>
                <span class="shape4"></span>
                <i>
                    <svg class="icon">
                        <use xlink:href="#gallery"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">{{__('messages.gallery')}}</span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList2">
                <i>
                    <svg class="icon">
                        <use xlink:href="#gallery"></use>
                    </svg>
                </i>
                {{__('messages.gallery')}}
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
        </a>
        <div class="allSideBarIconsText">
            <div class="active" id="showList3">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <span class="shape3"></span>
                <span class="shape4"></span>
                <i>
                    <svg class="icon">
                        <use xlink:href="#post"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">{{__('messages.all_product')}}</span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList3">
                <i>
                    <svg class="icon">
                        <use xlink:href="#post"></use>
                    </svg>
                </i>
                {{__('messages.all_product')}}
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
            <ul id="showList3" class="active">
                <li>
                    <a href="/seller/product">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.all_product')}}
                    </a>
                </li>
                <li>
                    <a href="/seller/product/create">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.add_product')}}
                    </a>
                </li>
            </ul>
        </div>
        <a href="/seller/my-products" class="allSideBarIconsText">
            <div class="active" id="showList7">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <span class="shape3"></span>
                <span class="shape4"></span>
                <i>
                    <svg class="icon">
                        <use xlink:href="#post"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">{{__('messages.my_product')}}</span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList7">
                <i>
                    <svg class="icon">
                        <use xlink:href="#post"></use>
                    </svg>
                </i>
                {{__('messages.my_product')}}
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
        </a>
        <div class="allSideBarIconsText">
            <div class="active" id="showList4">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <span class="shape3"></span>
                <span class="shape4"></span>
                <i>
                    <svg class="icon">
                        <use xlink:href="#pay"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">{{__('messages.all_order1')}}</span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList4">
                <i>
                    <svg class="icon">
                        <use xlink:href="#pay"></use>
                    </svg>
                </i>
                {{__('messages.all_order1')}}
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
            <ul id="showList4" class="active">
                <li>
                    <a href="/seller/pay">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.all_order1')}}
                    </a>
                </li>
                <li>
                    <a href="/seller/pay?delivery=0">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.all_order2')}}
                    </a>
                </li>
                <li>
                    <a href="/seller/pay?delivery=1">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.all_order3')}}
                    </a>
                </li>
                <li>
                    <a href="/seller/pay?delivery=2">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.all_order4')}}
                    </a>
                </li>
                <li>
                    <a href="/seller/pay?delivery=3">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.all_order5')}}
                    </a>
                </li>
                <li>
                    <a href="/seller/pay?delivery=4">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.all_order6')}}
                    </a>
                </li>
            </ul>
        </div>
        <div class="allSideBarIconsText">
            <div class="active" id="showList5">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <span class="shape3"></span>
                <span class="shape4"></span>
                <i>
                    <svg class="icon">
                        <use xlink:href="#car"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">{{__('messages.count_status')}}</span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList5">
                <i>
                    <svg class="icon">
                        <use xlink:href="#car"></use>
                    </svg>
                </i>
                {{__('messages.count_status')}}
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
            <ul id="showList5" class="active">
                <li>
                    <a href="/seller/inventory">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.inv_product')}}
                    </a>
                </li>
                <li>
                    <a href="/seller/empty">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        {{__('messages.empty_product')}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@section('scripts2')
    <script>
        $(document).ready(function(){
            var tab = '{!! app()->view->getSections()['tab'] !!}';
            $('.allSideBarIconsText>.active').hide();
            if(tab == 0){
                $('.allSideBarIconsText>#showList1').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 1){
                $('.allSideBarIconsText>#showList2').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 2){
                $('.allSideBarIconsText>#showList3').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 3){
                $('.allSideBarIconsText>#showList4').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 4){
                $('.allSideBarIconsText>#showList5').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 5){
                $('.allSideBarIconsText>#showList6').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 6){
                $('.allSideBarIconsText>#showList7').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 7){
                $('.allSideBarIconsText>#showList8').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            $('.allSideBarIconsText>#showList1').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList1').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList2').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList2').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList3').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList3').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList4').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList4').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList5').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList5').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList6').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList6').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
        })
    </script>
@endsection
