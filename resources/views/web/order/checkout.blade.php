@extends('web.layout')
@php
    $freight_where = \App\Services\ConfigService::get('freight_where',0);
    $freight_price = \App\Services\ConfigService::get('freight',0);

    $delivery_type_all = \App\Services\ConfigService::get('delivery_type',[]);
    if($delivery_type_all){
        $delivery_type_all = json_decode(\App\Services\ConfigService::get('delivery_type',[]),true);
    }
@endphp
@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/checkout.css') }}"/>
    <style>
        footer{
            display: none;
        }
    </style>
@stop

@section('header')
@stop
@section('customer-service')
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.contip.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/sweetalert2.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/relx.js') }}"></script>
    <script src="{{ asset('static/js/api.js') }}"></script>
    <script src="{{ asset('static/js/xarea.js') }}"></script>
    <script>
        $(".form-input").focus(function(){
            if(!$(this).hasClass(focus)){
                $(this).addClass('focus');
            }

        })
        $(".form-input").blur(function(){
            if(!$(this).val()){
                $(this).removeClass('focus');
            }
        });
        $('.label').click(function(){
            $(this).prev().focus();
        })
    </script>
    <script type="text/html" id="store-template">

    </script>
@stop


@section('content')
    <form onsubmit="return orderStore();" method="POST" action="{{ url('order') }}" id="order-form">
        {{ csrf_field() }}
        <input type="hidden" value="{{ request()->keyt }}" name="keyt">
        <input type="hidden" value="{{ $form_token }}" name="form_token">
        <input type="hidden" value="{{ $goods->id }}" name="goods_id">
        <div class="flex-column">
            <div class="info-side clearfix">
                <div class="information-main">
                    <div class="header">
                        <div class="c-logo"><a href="{{ url('/') }}"><img width="230" src="{{ asset('static/img/logo.jpg') }}" alt="logo"></a></div>
                        <p class="title" style="margin-left: 88px">安全結帳 <i class="iconfont">&#xe88c;</i></p>
                    </div>
                    <div class="step">
                        <div class="list">
                            <div class="num">1</div>
                            <p class="text">填寫收貨訊息</p>
                            <div class="link">
                                <div class="line"></div>
                                <i class="iconfont"> >> </i>
                            </div>
                        </div>

                        <div class="list">
                            <div class="num">2</div>
                            <p class="text">填寫配送訊息</p>
                            <div class="link">
                                <div class="line"></div>
                                <i class="iconfont"> >> </i>
                            </div>
                        </div>

                        <div class="list">
                            <div class="num">3</div>
                            <p class="text">提交訂單</p>
                        </div>
                    </div>

                    <div class="entering">
                        <div class="card">
                            <div class="c-line"></div>
                            <div class="head">
                                <span class="num">1</span>
                                <span class="title">收貨訊息</span>
                            </div>
                            <div class="body">

                                <div class="form-row">
                                    <div class="input-text">
                                        <input type="text" class="form-input" name="name">
                                        <span class="label">姓名</span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="input-text">
                                        <input type="text" class="form-input" name="phone" placeholder="">
                                        <span class="label">電話</span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="input-text">
                                        <input type="text" class="form-input" name="email" placeholder="">
                                        <span class="label">電子郵箱</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="head">
                                <span class="num">2</span>
                                <span class="title">配送訊息</span>
                            </div>
                            <div class="body">

                                <div class="form-row">
                                    <div class="toge">
                                        <label class="label-title">配送方式：</label>
                                        <div class="delivery-choice">
                                            @if(in_array(2,$delivery_type_all))
                                                <div class="delivery-item">
                                                    <input id="delivery-1" type="radio" value="1" name="order_type" checked>
                                                    <label for="delivery-1">
                                                        <p>超商7-11 取貨付款</p>
                                                    </label>
                                                </div>
                                            @endif

                                            <div class="delivery-item">
                                                <input id="delivery-0" type="radio" value="0" name="order_type">
                                                <label for="delivery-0">
                                                    <p>黑貓宅配 貨到付款</p>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="toge">
                                        <label class="label-title">配送地區：</label>
                                        <div class="address-choice" style="display: flex">
                                            <div id="load-1" style="position: relative">
                                                <select name="city" id="city">
                                                    <option value="city">選擇縣市</option>
                                                </select>
                                            </div>

                                            <div id="load-2" style="position: relative">
                                                <select name="county" id="county">
                                                    <option value="county">選擇地區</option>
                                                </select>
                                            </div>

                                            <div id="load-3" style="position: relative">
                                                <select name="street" id="street">
                                                    <option value="street">選擇路段</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-row" id="form-store-row">
                                    <div class="toge">
                                        <label class="label-title" style="opacity: 0">選擇門市：</label>
                                        <div class="store-choice">
                                            <div class="store-main" id="show-store-shop">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row" id="form-address-row">
                                    <div class="toge">
                                        <label class="label-title" style="opacity: 0">詳細地址：</label>
                                        <div class="input-text">
                                            <input type="text" class="form-input" name="address" placeholder="">
                                            <span class="label">詳細地址</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row" id="form-time-row">
                                    <div class="toge">
                                        <label class="label-title">配送時間：</label>
                                        <div class="delivery-choice">
                                            <select name="delivery_time">
                                                <option selected value="1">09:00~12:00</option>
                                                <option value="2">12:00~17:00</option>
                                                <option value="3">17:00~20:00</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="input-text">
                                        <input type="text" class="form-input" name="remarks" placeholder="">
                                        <span class="label">訂單備注</span>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="census-side clearfix">




                <div class="amount-main">

                    <div class="count">
                        <p class="count-title">訂單詳情</p>
                        <div class="tip-container">
                            <div class="triangle">
                                <i class="iconfont left">&#xe616;</i>
                                <i class="iconfont superior">&#xe760;</i>
                            </div>

                        </div>
                    </div>
                    <div class="subtotal">
                        <div class="list">
                            <div class="title">
                                <p class="p1">{{ $goods->name  }}</p>
                            </div>
                            <div class="price">
                                <p class="red">NT$ {{ number_format(round($goods->price)) }}</p>
                                @if($goods->market_price>$goods->price)
                                <p class="ash">NT$ {{ number_format(round($goods->market_price)) }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="list">
                            <div class="title">
                                <p class="p1">{{ $goods->price>=$freight_where?'免運費':'運費：' }}</p>
                                @if($freight_where>0)
                                <p class="p2" >消費滿NT${{ number_format($freight_where) }}，享受免費配送服務</p>
                                @endif
                            </div>
                            <div class="price">

                                <p class="red">NT${{ number_format($goods->price>=$freight_where?0:$freight_price) }}</p>

                            </div>
                        </div>
                    </div>
                    <div class="total">
                        <div class="title">
                            <p class="p1">訂單支付金額：</p>
                            @if($goods->market_price>$goods->price)
                                <p class="p2" style="color: #FF4C4C">已為您優惠</p>
                            @endif
                        </div>
                        <div class="price">
                            <p class="red">NT$ {{ number_format(round($goods->price>=$freight_where?$goods->price:$goods->price+$freight_price)) }}</p>
                            @if($goods->market_price>$goods->price)
                            <p class="ash">NT$ {{ number_format(round($goods->market_price-$goods->price)) }}</p>
                            @endif
                        </div>
                    </div>

                    {{--<div class="icons">
                        <div class="column">
                            <div class="item">
                                <p class="icon"><i class="iconfont" style="font-size: 24px">&#xebb9;</i></p>
                                <p class="text">絕對隱密</p>
                            </div>
                            <div class="item">
                                <p class="icon"><i class="iconfont" style="font-size: 18px">&#xe60f;</i></p>
                                <p class="text">台灣發貨</p>
                            </div>
                            <div class="item">
                                <p class="icon"><i class="iconfont" style="font-size: 18px">&#xeb67;</i></p>
                                <p class="text">官方授權</p>
                            </div>
                            <div class="item">
                                <p class="icon"><i class="iconfont" style="font-size: 22px">&#xe624;</i></p>
                                <p class="text">免費換貨</p>
                            </div>
                        </div>
                        <div class="column">
                            <div class="item">
                                <p class="icon"><i class="iconfont" style="font-size: 18px">&#xe610;</i></p>
                                <p class="text">隱私保護</p>
                            </div>
                            <div class="item">
                                <p class="icon"><i class="iconfont" style="font-size: 22px">&#xe60d;</i></p>
                                <p class="text">當天發貨</p>
                            </div>
                            <div class="item">
                                <p class="icon"><i class="iconfont" style="font-size: 22px">&#xe63f;</i></p>
                                <p class="text">鄉民推薦</p>
                            </div>
                            <div class="item">
                                <p class="icon"><i class="iconfont" style="font-size: 22px">&#xe88c;</i></p>
                                <p class="text">安全結帳</p>
                            </div>
                        </div>
                    </div>--}}

                    <div class="btn-main">
                        <button class="btn form-btn">提交訂單</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection




