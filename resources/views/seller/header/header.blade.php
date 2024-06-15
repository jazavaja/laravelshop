<div class="allHeaderPanel">
    <div class="right">
        <h2>{{__('messages.seller_panel')}}</h2>
    </div>
    <div class="left">
        <div class="user">
            <div class="pic" id="userPic" aria-haspopup="true">
                @if(auth()->user()->profile)
                    <img src="{{auth()->user()->profile}}" alt="{{auth()->user()->name}}">
                @else
                    <img src="/img/user.png" alt="{{auth()->user()->name}}">
                @endif
            </div>
            <ul id="showUser">
                <li>
                    <div class="picUser">
                        @if(auth()->user()->profile)
                            <img src="{{auth()->user()->profile}}" alt="{{auth()->user()->name}}">
                        @else
                            <img src="/img/user.png" alt="{{auth()->user()->name}}">
                        @endif
                    </div>
                    <div class="infoUser">
                        <span>{{auth()->user()->name}}</span>
                    </div>
                </li>
                <li>
                    <a href="/profile">
                        {{__('messages.panel_user')}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#showUser').hide();
            $('#userPic').click(function (){
                $('#showUser').toggle(50);
            })
        })
    </script>
@endsection
