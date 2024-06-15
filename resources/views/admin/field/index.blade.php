@extends('admin.master')

@section('tab' , 31)
@section('content')
    <div class="allCost">
        @if (\Session::has('message'))
            <div class="success">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="costIndex">
            <div class="addCost">افزودن فیلد های سفارشی</div>
        </div>
        <div class="allTables">
            <div class="allData">
                <table class="grid5">
                    <tr>
                        <th>نام</th>
                        <th>نوع</th>
                        <th>متعلق</th>
                        <th>زمان</th>
                        <th>عملیات</th>
                    </tr>
                    @foreach($fields as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>
                                @if($item->type == 0)
                                    <span>Input</span>
                                @elseif($item->type == 1)
                                    <span>Textarea</span>
                                @elseif($item->type == 2)
                                    <span>Number</span>
                                @elseif($item->type == 3)
                                    <span>Email</span>
                                @elseif($item->type == 4)
                                    <span>ColorPicker</span>
                                @elseif($item->type == 5)
                                    <span>Checkbox</span>
                                @else
                                    <span>Select</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status == 0)
                                    <span>کاربران</span>
                                @elseif($item->status == 1)
                                    <span>محصولات</span>
                                @elseif($item->status == 2)
                                    <span>بلاگ</span>
                                @endif
                            </td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                <div class="buttons">
                                    <button id="{{$item->id}}" class="editButton">ویرایش</button>
                                    <button id="{{$item->id}}" class="deleteButton">حذف</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $fields->links('admin.paginate') }}
            </div>
            <div class="addField" style="display:none;">
                <form action="/admin/field" class="createFilled" method="post">
                    @csrf
                    <div class="allCreatePostSubject">
                        <div class="allCreatePostItem">
                            <label>نام *</label>
                            <input type="text" name="name" placeholder="نام را وارد کنید">
                            @error('name')
                            <div class="alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem">
                            <label>مقدار پیشفرض</label>
                            <input type="text" name="value" placeholder="توضیحات را وارد کنید">
                            @error('value')
                            <div class="alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="allCreatePostItem choice">
                            <label>گذینه ها (با , جدا کنید.)</label>
                            <input type="text" name="choice" placeholder="مثال : یک,دو">
                            @error('choice')
                            <div class="alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="button" type="submit">ثبت اطلاعات</button>
                    </div>
                    <div class="allCreatePostDetails">
                        <div class="allCreatePostDetail">
                            <div class="allCreatePostDetailItemsTitle">
                                جزئیات
                            </div>
                            <div class="allCreatePostDetailItems">
                                <div class="allCreatePostDetailItem">
                                    <label>فیلد متعلق است به</label>
                                    <select name="status">
                                        <option value="0" selected>کاربران</option>
                                        <option value="1">محصولات</option>
                                        <option value="2">بلاگ</option>
                                    </select>
                                </div>
                                <div class="allCreatePostDetailItem">
                                    <label>نوع</label>
                                    <select name="type">
                                        <option value="0" selected>Input</option>
                                        <option value="1">Textarea</option>
                                        <option value="2">Number</option>
                                        <option value="3">Email</option>
                                        <option value="4">ColorPicker</option>
                                        <option value="5">Checkbox</option>
                                        <option value="6">Select</option>
                                    </select>
                                </div>
                                <label for="s6d" class="costCheck">
                                    غیرفعال
                                    <input id="s6d" type="checkbox" class="switch" name="disable_status">
                                </label>
                                <label for="s7d" class="costCheck">
                                    اجباری
                                    <input id="s7d" type="checkbox" class="switch" name="required_status">
                                </label>
                                <label for="s8d" class="costCheck">
                                    نمایش به کاربر
                                    <input id="s8d" type="checkbox" class="switch" name="show_status">
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف فیلد مطمئن هستید؟</div>
                <p>با حذف فیلد اطلاعات فیلد به طور کامل حذف میشوند</p>
                <div class="buttonsPop">
                    <form method="POST" action="" id="deletePost">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit">حذف شود</button>
                    </form>
                    <button id="cancelDelete">منصرف شدم</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var post = 0;
            $('.popUp').hide();
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.buttons').on('click' , '.deleteButton' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/field/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    task:post,
                };
                $.ajax({
                    url: '/admin/field/' + post+'/edit',
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.allData').toggle();
                        $('.addField').toggle();
                        $('.createFilled').attr('action' , '/admin/field/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $("input[name='name']").val(data.name);
                        $("input[name='value']").val(data.value);
                        $("input[name='choice']").val(data.choice);
                        $("select[name='status']").val(data.status);
                        $("select[name='type']").val(data.type);
                        if(data.type == 6){
                            $('.choice').show();
                        }else{
                            $('.choice').hide();
                        }
                        if(data.required_status == 1){
                            $("input[name='required_status']").prop("checked", true );
                        }else{
                            $("input[name='required_status']").prop("checked", false );
                        }
                        if(data.disable_status == 1){
                            $("input[name='disable_status']").prop("checked", true );
                        }else{
                            $("input[name='disable_status']").prop("checked", false );
                        }
                        if(data.show_status == 1){
                            $("input[name='show_status']").prop("checked", true );
                        }else{
                            $("input[name='show_status']").prop("checked", false );
                        }
                    },
                });
            })
            $("select[name='type']").change(function (){
                $('.choice').hide();
                if(this.value == 6){
                    $('.choice').show();
                }
            })
            $('.addCost').click(function (){
                $('.allData').toggle();
                $('.addField').toggle();
                $("select[name='type']").val(0);
                $('.choice').hide();
                post = 0;
                $('.createFilled').attr('action' , '/admin/field');
                $(".createFilled input[name='_method']").remove();
                $("input[name='name']").val('');
                $("input[name='value']").val('');
                $("input[name='choice']").val('');
                $("select[name='status']").val(0);
                $("select[name='type']").val(0);
                if($('.addCost').text() == 'افزودن فیلد های سفارشی'){
                    $('.addCost').text('مشاهده همه فیلد های سفارشی');
                }else{
                    $('.addCost').text('افزودن فیلد های سفارشی');
                }
            })
        })
    </script>
@endsection


@section('links')
    <script src="/js/persian-date.min.js"></script>
    <link rel="stylesheet" href="/css/persian-datepicker.min.css"/>
    <script src="/js/persian-datepicker.min.js"></script>
    <link rel="stylesheet" href="/css/select2.min.css"/>
    <script src="/js/select2.min.js"></script>
@endsection
