<section class="homeTopAdvertise width">
    <div class="advertiseSlider">
        <div class="slider owl-carousel owl-theme">
            @foreach (json_decode($data['ads2']) as $item)
                <figure>
                    <a href="{{$item->address}}" id="{{$item->address}}">
                        <img lazy="loading" src="{{$item->image}}" alt="{{$item->address}}">
                    </a>
                </figure>
            @endforeach
        </div>
    </div>
    <div class="advertiseItems">
        @foreach (json_decode($data['ads3']) as $item)
            <figure class="advertiseItem">
                <a href="{{$item->address}}" id="{{$item->address}}">
                    <img lazy="loading" src="{{$item->image}}" alt="{{$item->address}}">
                </a>
            </figure>
        @endforeach
    </div>
</section>
