@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('static/mobile/less/product.css') }}?ver={{ config('app.asset_version') }}">
@stop


@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>

        <li class="active">線上訂購</li>
    </ul>
@stop

@section('embed-banner')
{{--    <div class="embed-banner">
        <h1 class="embed-title">{!! app('cache.config')->get('page_product_title') !!}</h1>
        <div class="embed-desc">{!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_product_desc')) !!}</div>
    </div>--}}
@stop

@section('content')
    <section class="product-section">

        <div class="wrap">
            <h1 class="title">訂購專區</h1>
            <div class="main">
                @foreach($products as $key=>$goods)

                    <div class="goods">
                        <div class="adv-img">
                            @if($goods->m_market_img)
                                <img src="{{ asset_upload($goods->m_market_img) }}" alt="{{ $goods->name }}">
                            @endif
                        </div>
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
@endsection
