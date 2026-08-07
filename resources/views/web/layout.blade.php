<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <meta http-equiv="content-language" content="zh-tw">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(isset($layout['seo']))
    <title>{{ isset($layout['seo'])?$layout['seo']->title:"" }}</title>
    @else
    @hasSection('title')
    <title>@yield('title')</title>
    @else
    <title>{{ isset($layout['seo'])?$layout['seo']->title:"" }}</title>
    @endif
    @endif

    @hasSection('keywords')
    <meta name="keywords" content="@yield('keywords')"/>
    @else
    <meta name="keywords" content="{{ isset($layout['seo'])?$layout['seo']->key_word:"" }}"/>
    @endif

    @hasSection('description')
    <meta name="description" content="@yield('description')"/>
    @else
    <meta name="description" content="{{ isset($layout['seo'])?$layout['seo']->description:"" }}"/>
    @endif
    <link rel="canonical" href="{{ config('app.url') }}/{{ trim(request()->path(),'/') }}">
    <link rel="alternate" hreflang="zh-TW" href="{{ config('app.url') }}/{{ trim(request()->path(),'/') }}" />
    <link rel="alternate" media="only screen and (max-width: 640px)" href="{{ env('APP_M_URL') }}/{{ trim(request()->path(),'/') }}">
    <link rel="shortcut icon" href="{{ \App\Services\ConfigService::get('favicon')?asset('uploads/'.\App\Services\ConfigService::get('favicon')):'/favicon.ico' }}">
    @section('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('static/css/style.css') }}?ver={{ config('app.asset_version') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('static/css/common.css') }}?ver={{ config('app.asset_version') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('static/less/global.css') }}?ver={{ config('app.asset_version') }}"/>
        <link rel="stylesheet" href="{{ asset('static/font_3122894_o33hqrxtwf/iconfont.css') }}?ver={{ config('app.asset_version') }}">
        <link rel="stylesheet" href="{{ asset('static/swiper4/swiper.min.css') }}?ver={{ config('app.asset_version') }}">
        <link rel="stylesheet" href="{{ asset('static/less/section.css') }}?ver={{ config('app.asset_version') }}">
  {{--      <link rel="stylesheet" type="text/css" href="{{ asset('static/wow/animate.min.css') }}?ver={{ config('app.asset_version') }}"/>--}}
        <link rel="stylesheet" href="{{ asset('static/jcountdown/style.css') }}?ver={{ config('app.asset_version') }}">
        <link rel="stylesheet" href="{{ asset('static/less/customer-service.css') }}?ver={{ config('app.asset_version') }}">
    @show


    <script src="{{ asset('static/js/jquery.min.js') }}?ver={{ config('app.asset_version') }}"></script>
{{--    <script src="{{ asset('static/wow/wow.min.js') }}?ver={{ config('app.asset_version') }}"></script>--}}
    <script src="{{ asset('static/jquery_lazyload/jquery.lazyload.min.js') }}?ver={{ config('app.asset_version') }}"></script>

    <script>
/*        new WOW({
            offset:150,
        }).init();*/
    </script>

    <script>
        var is_ajax_get_cart = 0;
        var flash_data = '{!! session()->get('flash') !!}';

        if(flash_data){
            flash_data = JSON.parse('{!! session()->get('flash') !!}');

        }else{
            flash_data = false;
        }

        var province = [];

        var free_shipping_where = parseInt("{{ \App\Services\ConfigService::get('freight_where',0) }}");
        var free_shipping_freight = parseInt("{{ \App\Services\ConfigService::get('freight',0) }}");

    </script>
</head>
<body>

@section('header')
<header>
    <div class="wrapper">
        <div class="logo-sec">
            <a href="{{ url('/') }}">
                <img width="200" src="{{ asset('static/img/logo.jpg') }}?ver={{ config('app.asset_version') }}" alt="全球領先健康減肥藥">
                {{--<div class="logo-wrap hover-logo">
                    <div class="place">
                        <div class="compose">
                            <img class="fra-1" src="{{ asset('static/img/lg/fra-1.png') }}" alt="logo">
                            <img class="fra-2" src="{{ asset('static/img/lg/fra-2.png') }}" alt="logo">
                            <img class="fra-3"  src="{{ asset('static/img/lg/fra-3.png') }}" alt="logo">
                        </div>
                        <div class="intact">
                            <img class="xenical-logo" src="{{ asset('static/img/lg/xenical-1.png') }}" alt="xenical">
                            <p class="text">全球領先健康減肥藥</p>
                        </div>

                    </div>
                </div>--}}
            </a>
        </div>
        <div class="nav-sec">
            <ul class="base">
                <li><a href="{{ url('/') }}">首頁</a></li>
                <li><a href="{{ url('product') }}">訂購專區</a></li>
                <li><a href="{{ url('about') }}">用法介紹</a></li>
                <li><a href="{{ url('faq') }}">常見Q&A</a></li>
                <li><a href="{{ url('news') }}">瘦身部落格</a></li>

            </ul>

        </div>
    </div>
    <div class="tips">
        <p class="text">{{ app('cache.config')->get('countdown_text') }}</p>
        @php
            $h = str_pad(24-date('H'),2,'0',STR_PAD_LEFT);
            $i = str_pad(60-date('i'),2,'0',STR_PAD_LEFT);
            $s = str_pad(60-date('s'),2,'0',STR_PAD_LEFT);
        @endphp
        <div class="countdown">
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
</header>
@show


@section('banners')
    @if($layout['banners'] && !$layout['banners']->isEmpty())
        <section class="banner-section">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($layout['banners'] as $item)
                        @if($item->img)
                            <div class="swiper-slide">
                                <a href="{{ $item->href?url($item->href):"javascript:;" }}"><img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->alt }}"></a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @yield('embed-banner')
        </section>
    @endif
@show

@section('breadcrumb')

@show


@yield('content')



<footer>
    <div class="ft-main">
        <div class="ft-left">
            <div class="logo-box">
                <div class="row">
                    <img width="200" src="{{ asset('static/img/logo.jpg') }}" alt="全球領先健康減肥藥">
                </div>
            </div>
            <div class="conceal">
                <div class="row">
                    <div class="co-item">
                        <div class="icon-box"><i class="iconfont" style="font-size: 24px">&#xebb9;</i></div>
                        <p>絕對隱密</p>
                    </div>
                    <div class="co-item">
                        <div class="icon-box"><i class="iconfont" style="font-size: 18px">&#xe60f;</i></div>
                        <p>台灣出貨</p>
                    </div>
                    <div class="co-item">
                        <div class="icon-box"><i class="iconfont" style="font-size: 18px">&#xeb67;</i></div>
                        <p>官方授權</p>
                    </div>
                    <div class="co-item">
                        <div class="icon-box"><i class="iconfont" style="font-size: 22px">&#xe624;</i></div>
                        <p>免費換貨</p>
                    </div>
                </div>
                <div class="row">
                    <div class="co-item">
                        <div class="icon-box"><i class="iconfont" style="font-size: 18px">&#xe610;</i></div>
                        <p>隱私保護</p>
                    </div>
                    <div class="co-item">
                        <div class="icon-box"><i class="iconfont" style="font-size: 22px">&#xe60d;</i></div>
                        <p>當天出貨</p>
                    </div>
                    <div class="co-item">
                        <div class="icon-box"><i class="iconfont" style="font-size: 22px">&#xe63f;</i></div>
                        <p>鄉民推薦</p>
                    </div>
                    <div class="co-item">
                        <div class="icon-box"><i class="iconfont" style="font-size: 22px">&#xe88c;</i></div>
                        <p>安全結帳</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ft-right">
            <div class="foot-nav">
                <div class="row">
                    <p class="nav-title">Sale</p>
                    <ul>
                        <li>
                            <a href="{{ url('product') }}">訂購專區</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <p class="nav-title">About</p>
                    <ul>
                        <li>
                            <a href="{{ url('about') }}">用法介紹</a>
                        </li>
                        <li>
                            <a href="{{ url('faq') }}">常見Q&A</a>
                        </li>

                    </ul>
                </div>
                <div class="row">
                    <p class="nav-title">Service</p>
                    <ul>
                        <li>
                            <a href="{{ url('check') }}">訂單查詢</a>
                        </li>
                        <li>
                            <a href="{{ url('message') }}">聯繫客服</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <p class="nav-title">Articles</p>
                    <ul>
                        <li>
                            <a href="{{ url('news') }}">瘦身部落格</a>
                        </li>
                    </ul>
                </div>
            </div>
            <p class="copyright">{!! app('cache.config')->get('copyright') !!}</p>
        </div>
    </div>
    {{--<div class="description">
        <div class="text">
            本網站已依台灣網站內容分級規定處理<br>
            本站依台灣'電腦網際網路分級辦法'為限制級，限定為年滿18歲且已具有完整行為能力之網友，未滿18歲謝絕進入瀏覽，且願接受本站內影音內容及各項條款。<br>
            若您未滿18歲 請勿遊覽此區域 請立即離開 否則後果自行負責。<br>
            This website has been dealt with in accordance with the Taiwan website content classification regulations,<br>
            This website is restricted according to Taiwan's 'Computer Internet Classification Method', which is limited to netizens who are over 18 years old and have full behavioral capacity.<br>
            Those under 18 years old are not allowed to browse or purchase, and are willing to accept the video and audio content on this site. and various terms.<br>
            If you are under the age of 18, please do not visit this website, please leave immediately, otherwise you will be responsible for the consequences.<br>
        </div>
        <div class="partner">
            <div class="icon"><img style="width: 26px" src="{{ asset('static/img/7-11.png') }}" alt="7-11"></div>
            <div class="icon"><img style="width: 90px" src="{{ asset('static/img/lalamove.png') }}" alt="lalamove"></div>
            <div class="icon"><img style="width: 122px" src="{{ asset('static/img/heimao.png') }}" alt="黑猫宅急便"></div>
            <div class="icon"><img style="width: 108px" src="{{ asset('static/img/hct.png') }}" alt="新竹物流"></div>
            <div class="icon"><img style="width: 52px" src="{{ asset('static/img/ssl.png') }}" alt="ssl"></div>
        </div>
    </div>--}}


</footer>

@section('customer-service')
<x-customer-service></x-customer-service>
@show

</body>

@section('script')
<script src="{{ asset('static/js/customer-service.js') }}?ver={{ config('app.asset_version') }}"></script>
<script src="{{ asset('static/js/less.min.js') }}?ver={{ config('app.asset_version') }}"></script>
<script src="{{ asset('static/swiper4/swiper.min.js') }}?ver={{ config('app.asset_version') }}"></script>
<script src="{{ asset('static/js/jquery.cookie.js') }}?ver={{ config('app.asset_version') }}"></script>
<script src="{{ asset('static/js/cart.js') }}?ver={{ config('app.asset_version') }}"></script>
<script src="{{ asset('static/js/xie.js') }}?ver={{ config('app.asset_version') }}"></script>
<script src="{{ asset('static/jcountdown/TweenMax.min.js') }}?ver={{ config('app.asset_version') }}"></script>
{!! \App\Services\ConfigService::get('google_ga') !!}
@show
<script>
    $(function(){
        setTimeout(function(){
            $('body').removeClass('-loading');
        },2000);
    })
</script>
<script>
    $('#back-top').click(function (event) {
        event.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 500);
    })
</script>
<script type="text/javascript" charset="utf-8">
    $(function() {
        $("img.lazy").lazyload({effect: "fadeIn",placeholder:'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAACCAYAAABytg0kAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAHYcAAB2HAY/l8WUAAAASSURBVBhXY/g/2+4/CEMZdv8BZwgLXT+0H34AAAAASUVORK5CYII='});
    });
</script>

<script type="text/javascript">
    // Create Countdown
    var Countdown = {

        // Backbone-like structure
        $el: $('.countdown'),

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
</html>
