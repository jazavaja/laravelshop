@extends('home.master')

@section('title' , ' - ' . $page->title)
@section('content')
    <main class="allPageIndex width">
        <h1>{{$page->title}}</h1>
        @if($page->lat)
            <div class="pageContainer">
                <div class="description">
                    {!! $page->body !!}
                </div>
                <div id="map4"></div>
            </div>
        @else
            <div class="description">
                {!! $page->body !!}
            </div>
        @endif
    </main>
@endsection

@section('script1')
    <script>
        $(document).ready(function (){
            var page = {!! json_encode($page, JSON_HEX_TAG) !!};
            var app = new Mapp({
                element: '#map4',
                presets: {
                    latlng: {
                        lat: page.lat,
                        lng: page.longitude,
                    },
                    zoom: 15,
                },
                apiKey: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZiMjA2ZWZiNDU2Mjc2MjU3ODM0ZDkwNjFmY2JhNjlmYzYxYWUzMWMxYjM5MjNlM2Y0NWQ0NGFkZDc5NTI2ZmY4MmJhYjFiZDk3Njk0NWFjIn0.eyJhdWQiOiIxNjMzMCIsImp0aSI6IjZiMjA2ZWZiNDU2Mjc2MjU3ODM0ZDkwNjFmY2JhNjlmYzYxYWUzMWMxYjM5MjNlM2Y0NWQ0NGFkZDc5NTI2ZmY4MmJhYjFiZDk3Njk0NWFjIiwiaWF0IjoxNjU1NzI3MzY3LCJuYmYiOjE2NTU3MjczNjcsImV4cCI6MTY1ODMxOTM2Nywic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.DV3MBEAZ_ovI_AGx-E4ktM3yRwHuvfOeFRw2SciDiKbWxzUVJacX0TjCrHoA0-A-wgtmCV0ZbldIwYTpPQCJOAcreZQFs2IuSqSpqB9RguH-cho9JFRVMNI_te3ZLpgxHtUTxlXHSN6ol7QiMgr5DZ1VL8M01-dAJhmX2PSQhCPCiMh-T7XlVFkTHQJhKomh7jxPc6ho58YcGm2yGW7k-I5r5w60GkWZzr9iogSQ8WlJupwM_Xo7r0pmeP8wWG2mULrBu--vtQFby9EadQJ9n86Hv0Fis9KRYZTY7li-k7awxdQGv3964o2O8suEpKsIoQwDEDOhPXnA1r4Np3gUkQ'
            });
            app.addLayers();
            var marker = app.addMarker({
                latlng: {
                    lat: page.lat,
                    lng: page.longitude,
                },
                zoom: 15,
                draggable: false,
                popup: false
            });
        })
    </script>
@endsection

@section('jsScript')
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">
@endsection

@section('jsBody')
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>
@endsection
