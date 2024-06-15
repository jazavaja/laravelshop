<div class="allFloatBtn">
    <nav class="social">
        <ul>
            @foreach(\App\Models\FloatAccess::get() as $item)
                <li>
                    <a href="{{$item->link}}">
                        @if($item->icon == 6)
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#home2"></use>
                                </svg>
                            </i>
                        @endif
                        @if($item->icon == 5)
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#tag"></use>
                                </svg>
                            </i>
                        @endif
                        @if($item->icon == 4)
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#tag"></use>
                                </svg>
                            </i>
                        @endif
                        @if($item->icon == 1)
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#whatsapp"></use>
                                </svg>
                            </i>
                        @endif
                        @if($item->icon == 2)
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#telegram"></use>
                                </svg>
                            </i>
                        @endif
                        @if($item->icon == 3)
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#phone-call"></use>
                                </svg>
                            </i>
                        @endif
                        @if($item->icon == 0)
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </i>
                        @endif
                        {{$item->title}}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>
