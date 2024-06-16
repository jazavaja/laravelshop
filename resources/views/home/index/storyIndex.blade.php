<div class="allStoryContainer width">
    <div class="allStoryIndex">
        <div class="titleStory">{{$data['title']}}</div>
        <div class="storyItems">
            @foreach($data['post'] as $item)
                <a class="storyItem" href="#{{$item->id}}" id="{{$item->id}}">
                    @if(in_array($item->id, $storySeen))
                        <div class="storyPic unActive">
                            <img src="{{$item->cover}}" alt="{{$item->id}}">
                        </div>
                    @else
                        <div class="storyPic">
                            <img src="{{$item->cover}}" alt="{{$item->id}}">
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
        <div class="storyFixed" style="display:none;">
            <div class="storyShow" style="display:none;">
                <div class="slider-story owl-carousel owl-theme">
                    @foreach($data['post'] as $item)
                        <div class="storyItem" data-hash="{{$item->id}}">
                            @if($item->type == 0)
                                <img src="{{$item->image}}" alt="{{$item->id}}">
                            @else
                                <video controls>
                                    <source src="{{$item->image}}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="downStory">
        <div class="data">
            <i class="downData">
                <svg class="icon">
                    <use xlink:href="#down"></use>
                </svg>
            </i>
            <i>
                <svg class="icon">
                    <use xlink:href="#shape3"></use>
                </svg>
            </i>
        </div>
    </div>
</div>
