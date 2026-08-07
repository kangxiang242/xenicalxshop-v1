@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('static/mobile/less/index.css') }}?ver={{ config('app.asset_version') }}">
    <link rel="stylesheet" href="{{ asset('static/mobile/less/product.css') }}?ver={{ config('app.asset_version') }}">
@stop

@section('script')
    @parent


@stop

@section('content')
    <section class="ad-section">
        <div class="full-banner" style="@if(app('cache.config')->get('home_page_banner_m')) background-image: url({{ asset_upload(app('cache.config')->get('home_page_banner_m')) }}) @endif "></div>
        <div class="major">

            <div class="spread">
                <div class="adv a1">
                    <img src="{{ asset_upload(app('cache.config')->get('home_adv_1')) }}" alt="歐洲原廠">
                </div>
                <div class="adv a2" >
                    <img src="{{ asset_upload(app('cache.config')->get('home_adv_2')) }}" alt="隱密包裝">
                </div>
                {{--<div class="adv a3">
                    <img src="{{ asset_upload(app('cache.config')->get('home_adv_3')) }}" alt="運費全免">
                </div>--}}
            </div>
        </div>
        <section class="about-section">
            <div class="about">
                <div class="row ab-main"  >
                    <h1 class="ab-title">{!! app('cache.config')->get('home_about_title') !!}</h1>

                    <div class="text">
                        {!! app('cache.config')->get('home_about') !!}
                    </div>
                </div>
            </div>
        </section>
    </section>



    <section class="product-section">

        <div class="wrap">
            <h1 class="title p-title">訂購專區</h1>
            <div class="main">
                @foreach($products as $key=>$goods)

                    <div class="goods">

                        <div class="info" >
                            <div class="goods-img"><a href="{{ url('product/'.$goods->id) }}"><img src="{{ asset('uploads/'.$goods->img) }}" alt="{{ $goods->name }}"></a></div>
                            <div class="boa">
                                <p class="title"><a href="{{ url('product/'.$goods->id) }}">{{ $goods->name }}</a></p>
                                <p class="brief">{!! $goods->label !!}</p>
                                <div class="price">
                                    <p class="market">NT$ {{ number_format(round($goods->market_price)) }}</p>
                                    <p class="now">NT$ {{ number_format(round($goods->price)) }}</p>
                                </div>
                                <a class="go-btn" href="{{ url('product/'.$goods->id) }}"><i class="iconfont">&#xe775;</i></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>


    <section class="suit" style="@if(app('cache.config')->get('for_people_image_m')) background-image: url({{ asset_upload(app('cache.config')->get('for_people_image_m')) }}) @endif ">
        <div class="wrapper">
            <div class="suit-head" >
                <h2 class="title">品牌承诺</h2>
            </div>
            <div class="suit-content">
                @php
                    $people_key=0;
                    $icons = [
                        [
                            'icon'=>'&#xe614;',
                            'style'=>'font-size:50px'
                        ],
                        [
                            'icon'=>'&#xe739;',
                            'style'=>'font-size:50px; transform: rotateY(180deg);'
                        ],
                        [
                            'icon'=>'&#xe699;',
                            'style'=>'font-size:50px'
                        ],
                        [
                            'icon'=>'&#xe6b8;',
                            'style'=>'font-size:50px'
                        ],
                        [
                            'icon'=>'&#xe637;',
                            'style'=>'font-size:50px'
                        ],
                        [
                            'icon'=>'&#xe6de;',
                            'style'=>'font-size:50px'
                        ],
                    ];
                @endphp
                @foreach($for_people as $key=>$item)
                    <div class="item">
                        <div class="box">
                            <p class="ico"><i class="iconfont" style="{!! \Illuminate\Support\Arr::get($icons,$people_key.'.style') !!}">{!! \Illuminate\Support\Arr::get($icons,$people_key.'.icon') !!}</i></p>
                            <p class="text">{{ $item->text }}</p>
                            @if(isset($item->desc))
                                <p class="desc">{{ $item->desc }}</p>
                            @endif
                        </div>
                    </div>
                    @php
                        $people_key++;
                    @endphp
                @endforeach
            </div>
        </div>
    </section>


    <section class="news-section">
        <h2 class="title">瘦身部落格</h2>
        <div class="news-main clearfix">
            @foreach($news as $item)
                <div class="item">
                    <div class="img-wrapper"><a href="{{ url($item->cate->uri.'/'.$item->id) }}" title="{{ $item->title }}"><img
                                src="{{ asset_upload($item->img) }}" alt="{{ $item->title }}"></a></div>
                    <div class="info">
                        <p class="n-title"><a href="{{ url($item->cate->uri.'/'.$item->id) }}" title="{{ $item->title }}">{{ $item->title }}</a></p>
                        <div class="stars">
                            @for($i=1;$i<=5;$i++)
                                @if($item->stars >= $i)
                                    <i class="iconfont">&#xe9a1;</i>
                                @elseif($i>$item->stars && $item->stars>$i-1)
                                    <i class="iconfont">&#xe9a3;</i>
                                @else
                                    <i class="iconfont">&#xe9a2;</i>
                                @endif
                            @endfor
                        </div>
                        <p class="desc">
                            {{ \Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),110) }}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
    @if(app('cache.config')->get('promote_image'))
        <div class="fraud-section">
            <div class="fraud-main">

                <img width="100%" src="{{ asset_upload(app('cache.config')->get('m_promote_image')) }}" alt="隱私包裝">

            </div>
        </div>
    @endif
@endsection
