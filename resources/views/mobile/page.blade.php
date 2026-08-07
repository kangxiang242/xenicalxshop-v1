@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/page.css') }}?ver={{ config('app.asset_version') }}"/>
    <style>
        body{
            background-color: #f0f0f0;
        }
    </style>
@stop

@section('script')
    @parent
    <script>
        document.domain = "{{ getMainDomain() }}";
        function setIframeHeight(iframe) {
            if (iframe) {
                var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
                if (iframeWin.document.body) {
                    iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
                }}
        };
        window.onload = function () {
            setIframeHeight(document.getElementById('external-frame'));
        };
    </script>


@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>
        <li class="active">{{ $title }}</li>
    </ul>
@stop

@section('content')

    <section class="page-container">
        <div class="page-main">
            <h1 class="title">{{ $title }}</h1>
            <div class="page-body">
                @if(isset($html_code) && $html_code)
                    <iframe  id="external-frame" width="100%" style="min-height: 100vh" src="{{ asset_upload('article_html/'.str_replace('.zip','',$html_code).'/index.html') }}"  frameborder="0" scrolling="no" onload="setIframeHeight(this)"></iframe>
                @else
                    {!! $content !!}
                @endif
            </div>
        </div>
    </section>

@endsection
