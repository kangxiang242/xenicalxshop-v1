@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/product.css') }}?ver={{ config('app.asset_version') }}"/>


@stop

@section('script')
    @parent
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>
        <li class="active">訂購專區</li>
    </ul>
@stop

@section('content')

<section class="product-section">

    <div class="wrap">
        <h1 class="title p-title">訂購專區</h1>
        <div class="main">

            @foreach($products as $key=>$goods)

                <div class="goods" onclick="window.location.href='{{ url('product/'.$goods->id) }}'">

                    <div class="info scale-effect" >
                        <div class="goods-img"><a href="{{ url('product/'.$goods->id) }}"><img src="{{ asset('uploads/'.$goods->img) }}" alt="{{ $goods->name }}"></a></div>
                        <div class="boa">
                            <p class="title"><a href="{{ url('product/'.$goods->id) }}">{{ $goods->name }}</a></p>
                            <p class="brief">{!! $goods->label !!}</p>
                            <div class="price">
                                <p class="market">NT$ {{ number_format(round($goods->market_price)) }}</p>
                                <p class="now">NT$ {{ number_format(round($goods->price)) }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach



        </div>

    </div>
</section>
@endsection
