@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('static/mobile/less/goods.css') }}?ver={{ config('app.asset_version') }}">
    <style>
        .countdown .bloc-time:after{
            color: #000;
            font-weight: 500;
        }
        .red-pan{
            color: #d72525;
        }
        .countdown .figure > span{
            font-size: 1.8rem;
            line-height: 1.8rem;
        }
        .countdown .figure {

            height: 2rem;
            width: 2rem;

        }
        .order-logs .swiper-container{
            z-index: 0;
        }
    </style>
@stop


@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>
        <li><a href="{{ url('product') }}">線上訂購</a></li>
        <li class="active">{{ \Illuminate\Support\Str::limit($product->name,20) }}</li>
    </ul>
@stop

@section('script')
    @parent
    <script>
        $('.thumbnail .item').click(function(){
            var src = $(this).find('img').attr('src');
            $('.cover-wrap').find('img').attr('src',src);
            $(this).addClass('active').siblings().removeClass('active');
        });
    </script>
    <script type="text/javascript">
        // Create Countdown
        var Countdown = {

            // Backbone-like structure
            $el: $('.goods-countdown'),

            // Params
            countdown_interval: null,
            total_seconds     : 0,

            // Initialize the countdown
            init: function() {

                // DOM
                this.$ = {
                    hours  : this.$el.find('.bloc-time.hours .figure'),
                    minutes: this.$el.find('.bloc-time.min .figure'),
                    seconds: this.$el.find('.bloc-time.sec .figure')
                };

                // Init countdown values
                this.values = {
                    hours  : this.$.hours.parent().attr('data-init-value'),
                    minutes: this.$.minutes.parent().attr('data-init-value'),
                    seconds: this.$.seconds.parent().attr('data-init-value'),
                };

                // Initialize total seconds
                this.total_seconds = this.values.hours * 60 * 60 + (this.values.minutes * 60) + this.values.seconds;

                // Animate countdown to the end
                this.count();
            },

            count: function() {

                var that    = this,
                    $hour_1 = this.$.hours.eq(0),
                    $hour_2 = this.$.hours.eq(1),
                    $min_1  = this.$.minutes.eq(0),
                    $min_2  = this.$.minutes.eq(1),
                    $sec_1  = this.$.seconds.eq(0),
                    $sec_2  = this.$.seconds.eq(1);

                this.countdown_interval = setInterval(function() {

                    if(that.total_seconds > 0) {

                        --that.values.seconds;

                        if(that.values.minutes >= 0 && that.values.seconds < 0) {

                            that.values.seconds = 59;
                            --that.values.minutes;
                        }

                        if(that.values.hours >= 0 && that.values.minutes < 0) {

                            that.values.minutes = 59;
                            --that.values.hours;
                        }

                        // Update DOM values
                        // Hours
                        that.checkHour(that.values.hours, $hour_1, $hour_2);

                        // Minutes
                        that.checkHour(that.values.minutes, $min_1, $min_2);

                        // Seconds
                        that.checkHour(that.values.seconds, $sec_1, $sec_2);

                        --that.total_seconds;
                    }
                    else {
                        clearInterval(that.countdown_interval);
                    }
                }, 1000);
            },

            animateFigure: function($el, value) {

                var that         = this,
                    $top         = $el.find('.top'),
                    $bottom      = $el.find('.bottom'),
                    $back_top    = $el.find('.top-back'),
                    $back_bottom = $el.find('.bottom-back');

                // Before we begin, change the back value
                $back_top.find('span').html(value);

                // Also change the back bottom value
                $back_bottom.find('span').html(value);

                // Then animate
                TweenMax.to($top, 0.8, {
                    rotationX           : '-180deg',
                    transformPerspective: 300,
                    ease                : Quart.easeOut,
                    onComplete          : function() {

                        $top.html(value);

                        $bottom.html(value);

                        TweenMax.set($top, { rotationX: 0 });
                    }
                });

                TweenMax.to($back_top, 0.8, {
                    rotationX           : 0,
                    transformPerspective: 300,
                    ease                : Quart.easeOut,
                    clearProps          : 'all'
                });
            },

            checkHour: function(value, $el_1, $el_2) {

                var val_1       = value.toString().charAt(0),
                    val_2       = value.toString().charAt(1),
                    fig_1_value = $el_1.find('.top').html(),
                    fig_2_value = $el_2.find('.top').html();

                if(value >= 10) {

                    // Animate only if the figure has changed
                    if(fig_1_value !== val_1) this.animateFigure($el_1, val_1);
                    if(fig_2_value !== val_2) this.animateFigure($el_2, val_2);
                }
                else {

                    // If we are under 10, replace first figure with 0
                    if(fig_1_value !== '0') this.animateFigure($el_1, 0);
                    if(fig_2_value !== val_1) this.animateFigure($el_2, val_1);
                }
            }
        };

        // Let's go !
        Countdown.init();
    </script>
    <script>
        function makeOrderLogs(){
            var order_log_time = parseInt(localStorage.getItem("order_log_time"))+10;
            var current_time = Date.parse(new Date())/1000;


            var swiper_html = '';
            if(order_log_time>current_time){

                swiper_html += '<div class="swiper-slide"><p class="ol"><span class="nick">'+localStorage.getItem("order_log_nickname")+'</span><span class="time">剛剛</span></p></div>';
            }
            for(var i=0;i<10;i++){
                var str = "買家09****"+getRandomNum()+"已下單";
                var time = "剛剛";
                //order_logs.push({'nickname':str,'time':time});

                swiper_html += '<div class="swiper-slide"><p class="ol"><span class="nick">'+str+'</span><span class="time">'+time+'</span></p></div>';
            }
            $('#order-logs-swiper').find('.swiper-wrapper').html(swiper_html);


        }
        makeOrderLogs();
        function getRandomNum(){
            var randomNum = Math.random()

            var checkCode = randomNum*9000
            checkCode +=1000;
            return parseInt(checkCode)
        }

        function getRandomInt(min,max){
            return Math.floor(Math.random()*(max-min+1))+min;
        }

        var is_run = false;
        setInterval(function(){
            var time = getRandomInt(8,25)*1000;


            if(!is_run){
                is_run = true;

                setTimeout(function(){
                    localStorage.removeItem("order_log_time");
                    $('#order-logs-next').click();
                    is_run=false;

                },time)
            }


        },1000)


        var current_order_buy_num = parseInt(localStorage.getItem("order_buy_num"));
        if(current_order_buy_num){
            $('#buy_num').text(current_order_buy_num);
        }


        var mySwiper = new Swiper('#order-logs-swiper', {
            autoplay: false,
            loop:true,
            simulateTouch : false,
            allowTouchMove: false,
            direction: 'vertical',
            observer: true,
            navigation: {
                nextEl: '#order-logs-next',
            },
            on: {
                slideChangeTransitionStart: function(swiper){
                    var str = $('#order-logs-swiper .swiper-slide').eq(this.activeIndex).find('.nick').text();
                    localStorage.setItem("order_log_nickname",str);

                    var order_buy_num = parseInt(localStorage.getItem("order_buy_num"));
                    if(!order_buy_num){
                        order_buy_num = parseInt($('#buy_num').text());

                    }


                    var order_log_time = parseInt(localStorage.getItem("order_log_time"))+10;
                    var current_log_time = Date.parse(new Date())/1000;
                    if(!order_log_time || current_log_time>order_log_time){
                        localStorage.setItem("order_log_time",Date.parse(new Date())/1000);
                        localStorage.setItem("order_buy_num",order_buy_num+1);

                        $('#buy_num').text(order_buy_num+1);
                    }





                },
            },
        })
    </script>
@stop

@section('footer-menu')
@stop

@section('content')
    <section class="goods-section">
        <div class="body">

            <div class="card" style="margin-bottom: 1rem">
                <div class="main">
                    <div class="goods">
                        <div class="atlas">
                            <div class="cover-wrap">
                                <img src="{{ asset_upload($product->img) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="thumbnail">
                                <div class="item active"><img src="{{ asset_upload($product->img) }}" alt="{{ $product->name }}"></div>
                                @foreach(array_values($goods_thumbnail) as $key=>$item)
                                    @if($key<1)
                                        <div class="item"><img src="{{ asset_upload(array_get($item,'img')) }}" alt="{{ $product->name }}"></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="info">
                            <div class="name-wrap">
                                @if($product->price >= app('cache.config')->get('freight_where'))
                                    <span class="label">免運</span>
                                @endif
                                <h1 class="title">{{ $product->name }}</h1>
                            </div>

                            <div class="prices">
                                @if($product->market_price > $product->price)
                                    <p class="market"><span>組合價NT$ {{ number_format(round($product->market_price)) }}</span></p>
                                @endif
                                <p class="now"><span class="lab">限時下殺</span><span class="sp">NT$ {{ number_format(round($product->price)) }}</span></p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="g-tips">
                <p class="text">回饋福利活動剩餘</p>
                @php
                    $h = str_pad(24-date('H'),2,'0',STR_PAD_LEFT);
                    $i = str_pad(60-date('i'),2,'0',STR_PAD_LEFT);
                    $s = str_pad(60-date('s'),2,'0',STR_PAD_LEFT);
                @endphp
                <div class="countdown goods-countdown">
                    <div class="bloc-time hours" data-init-value="{{ (int)$h }}">


                        <div class="figure hours hours-1">
                            <span class="top" style="transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);">{{ substr($h,0,1) }}</span>
                            <span class="top-back">
                      <span>{{ substr($h,0,1) }}</span>
                    </span>
                            <span class="bottom">{{ substr($h,0,1) }}</span>
                            <span class="bottom-back">
                      <span>{{ substr($h,0,1) }}</span>
                    </span>
                        </div>

                        <div class="figure hours hours-2">
                            <span class="top" style="transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);">{{ substr($h,-1) }}</span>
                            <span class="top-back">
                      <span>{{ substr($h,-1) }}</span>
                    </span>
                            <span class="bottom">{{ substr($h,-1) }}</span>
                            <span class="bottom-back">
                      <span>{{ substr($h,-1) }}</span>
                    </span>
                        </div>
                    </div>

                    <div class="bloc-time min" data-init-value="{{ (int)$i }}">


                        <div class="figure min min-1">
                            <span class="top">{{ substr($i,0,1) }}</span>
                            <span class="top-back">
                      <span>{{ substr($i,0,1) }}</span>
                    </span>
                            <span class="bottom">{{ substr($i,0,1) }}</span>
                            <span class="bottom-back">
                      <span>{{ substr($i,0,1) }}</span>
                    </span>
                        </div>

                        <div class="figure min min-2">
                            <span class="top">{{ substr($i,-1) }}</span>
                            <span class="top-back">
                      <span>{{ substr($i,-1) }}</span>
                    </span>
                            <span class="bottom">{{ substr($i,-1) }}</span>
                            <span class="bottom-back">
                      <span>{{ substr($i,-1) }}</span>
                    </span>
                        </div>
                    </div>

                    <div class="bloc-time sec" data-init-value="{{ (int)$s }}">
                        <div class="figure sec sec-1">
                            <span class="top">{{ substr($s,0,1) }}</span>
                            <span class="top-back">
                      <span>{{ substr($s,0,1) }}</span>
                    </span>
                            <span class="bottom">{{ substr($s,0,1) }}</span>
                            <span class="bottom-back">
                      <span>{{ substr($s,0,1) }}</span>
                    </span>
                        </div>

                        <div class="figure sec sec-2">
                            <span class="top">{{ substr($s,-1) }}</span>
                            <span class="top-back">
                      <span>{{ substr($s,-1) }}</span>
                    </span>
                            <span class="bottom">{{ substr($s,-1) }}</span>
                            <span class="bottom-back">
                      <span>{{ substr($s,-1) }}</span>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="main">
                    <div class="main">
                        <div class="goods">

                            <div class="info">

                                @if($product->attr)
                                    <div class="attrs">
                                        @foreach($product->attr as $attr)
                                            <dl>
                                                <dt>{{ $attr->name }}：</dt>
                                                <dd>{{ $attr->value }}</dd>
                                            </dl>
                                        @endforeach
                                    </div>
                                @endif


                                <p class="prescription">下單成功後最慢<span class="red-pan">3個工作日</span>內出貨</p>

                                <div class="sales">
                                    <div class="panic">
                                        <span class="s1">已搶購</span>
                                        <span class="s2"><em class="red-pan" style="font-style: normal" id="buy_num">713</em>份</span>
                                    </div>
                                    <div class="order-logs">
                                        <div class="swiper-container" id="order-logs-swiper" style="z-index: 0">
                                            <div class="swiper-wrapper">

                                            </div>
                                        </div>

                                    </div>
                                    <div style="display: none">
                                        <div class="swiper-button-prev" id="order-logs-prev"></div>
                                        <div class="swiper-button-next" id="order-logs-next"></div>
                                    </div>
                                </div>

                                <div class="ensures">
                                    <div class="icons">
                                        <span class="ioc"><i class="iconfont">&#xeb67;</i></span>
                                        <span>官方授權</span>
                                    </div>
                                    <div class="icons">
                                        <span class="ioc"><i class="iconfont">&#xe624;</i></span>
                                        <span>免費換貨</span>
                                    </div>
                                    <div class="icons">
                                        <span class="ioc"><i class="iconfont">&#xe88c;</i></span>
                                        <span>安全結帳</span>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="main">
                    <div class="delivery">
                        <p class="title">配送與付款</p>
                        <div class="content">
                            <div class="col">
                                <p class="label">配送資訊</p>
                                <div class="enu">
                                    @foreach($goods_delivery as $val)
                                        <p>{{ array_get($val,'name') }}：{{ array_get($val,'value') }}</p>
                                    @endforeach

                                </div>
                            </div>
                            <div class="col">
                                <p class="label">付款資訊</p>
                                <div class="enu">
                                    @foreach($goods_payment as $val)
                                        <p>{{ array_get($val,'name') }}：{{ array_get($val,'value') }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($discount && !$discount->isEmpty())
                <div class="card">
                    <div class="main">
                        <div class="programme">
                            <p class="title">更多優惠方案</p>
                            <div class="content">
                                <div class="goods-discount">
                                    @foreach($discount as $item)
                                        <div class="item">
                                            <div class="info">
                                                <p class="title">{{ $item->name }}</p>
                                                <a class="choice" href="{{ url('product/'.$item->id) }}">選擇該方案</a>
                                            </div>
                                            <div class="prices">
                                                <div class="le">
                                                    <p class="p1">組合價</p>
                                                    <p class="p2">NT$ {{ number_format(round($item->market_price)) }}</p>
                                                </div>
                                                <div class="le">
                                                    <p class="p1">限時下殺優惠價</p>
                                                    <p class="p2">NT${{ number_format(round($item->price)) }}</p>
                                                </div>
                                                <div class="le">
                                                    <p class="p1">平均每盒</p>
                                                    <p class="p2">NT${{ number_format(round($item->price/$item->quantity)) }}</p>
                                                </div>
                                            </div>


                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <div class="card">
                <div class="main">
                    <div class="comments">
                        <p class="title">買家留言</p>
                        <div class="content">
                            <ul class="enumeration">
                                @foreach($goods_comments as $val)

                                    <li>
                                        <p class="info">
                                            <span class="nickname">{{ array_get($val,'name') }}</span>
                                            <span class="date">{{ array_get($val,'date',date('Y-m-d')) }}</span>
                                        </p>

                                        <p class="message">
                                            {{ array_get($val,'value') }}
                                        </p>
                                    </li>
                                @endforeach



                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="main">
                    <div class="final">
                        <div class="content">
                            <div class="instructions">
                                <p class="title">藥品說明</p>
                                <div class="present">
                                    @foreach($goods_instructions as $val)

                                        <div class="ls">
                                            <span class="s1">{{ array_get($val,'name') }}</span>
                                            <span class="s2">{{ array_get($val,'value') }}</span>
                                        </div>
                                    @endforeach




                                </div>
                            </div>

                            <div class="after-sale">
                                <p class="title">售后服务</p>
                                <div class="text">

                                </div>
                            </div>

                            <div class="gallery">
                                <img src="{{ asset_upload(app('cache.config')->get('m_goods_conceal_img')) }}" alt="隐秘配送">
                                {{--<img src="{{ asset_upload(app('cache.config')->get('goods_appreciate_img')) }}" alt="鉴赏期">--}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="footer-shopping">
        <div class="p-row">
            <p class="lab">限時下殺價</p>
            <p class="price">NT$ {{ number_format(round($product->price)) }}</p>
        </div>
        <div class="b-row">
            <a class="go-shop" href="{{ url('checkout/'.$product->id) }}">立即購買</a>
        </div>
    </section>
@endsection
