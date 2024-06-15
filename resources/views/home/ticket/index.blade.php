@extends('home.master')

@section('title' , __('messages.request_product') . ' - ')
@section('content')
    <main class="allTicketIndex width">
        @if (\Session::has('success'))
            <div class="success">
                {!! \Session::get('success') !!}
            </div>
        @endif
        <section class="tickets">
            <h3>{{__('messages.request_product')}}</h3>
            <form method="post" action="/request-product">
                @csrf
                <div class="item">
                    <label for="title">{{__('messages.request_url')}}*</label>
                    <input type="text" name="title" required id="title" placeholder="{{__('messages.request_url')}}">
                </div>
                <div class="items">
                    <div class="item">
                        <label for="status">{{__('messages.request_count')}}*</label>
                        <input type="number" maxlength="3" max="999" min="1" name="status" required id="status" placeholder="{{__('messages.request_count')}}">
                    </div>
                    <div class="item">
                        <label for="answer">{{__('messages.number_address')}}</label>
                        <input type="number" name="answer" required id="answer" placeholder="{{__('messages.number_address')}}">
                    </div>
                </div>
                <div class="item">
                    <label for="body">{{__('messages.body')}}*</label>
                    <textarea name="body" id="body" required placeholder="{{__('messages.body')}}"></textarea>
                </div>
                <div class="ticketButtons">
                    <button>{{__('messages.send_submit')}}</button>
                </div>
            </form>
        </section>
    </main>
@endsection

@section('script1')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var req_field11 = {!! json_encode(__('messages.req_field'), JSON_HEX_TAG) !!};
            var elements = document.getElementsByTagName("INPUT");
            for (var i = 0; i < elements.length; i++) {
                elements[i].oninvalid = function(e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity(req_field1);
                    }
                };
                elements[i].oninput = function(e) {
                    e.target.setCustomValidity("");
                };
            }
            var elements2 = document.getElementsByTagName("TEXTAREA");
            for (i = 0; i < elements2.length; i++) {
                elements2[i].oninvalid = function(e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity(req_field1);
                    }
                };
                elements[i].oninput = function(e) {
                    e.target.setCustomValidity("");
                };
            }
        })
    </script>
@endsection
