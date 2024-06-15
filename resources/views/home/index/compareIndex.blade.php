<div class="allCompareIndex width">
    <div class="title">
        <h3>{{$data['title']}}</h3>
    </div>
    <div class="slider-compare">
        @foreach(\App\Models\CompareProduct::latest()->where('language' , request()->cookie('language')??'fa')->get() as $item)
            <div class="compareItem">
                <figure style="--fraction: 50%">
                    <div class="before">{{$item->text1}}</div>
                    <div class="after">{{$item->text2}}</div>
                    <img src="{{$item->image1}}" alt="{{$item->text1}}">
                    <img src="{{$item->image2}}" alt="{{$item->text2}}">
                    <input
                            type="range"
                            oninput="this.parentNode.style.setProperty('--fraction', this.value + '%')"
                            min="0"
                            max="100"
                            step="0.1"
                            value="50"
                    />
                </figure>
                <a href="{{$item->link}}" class="detail">{{$item->title}}</a>
            </div>
        @endforeach
    </div>
</div>
