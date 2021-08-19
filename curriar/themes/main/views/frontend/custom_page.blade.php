@extends('frontend.layouts.app')

@section('meta_title'){{ $page->getTranslation('title') }}@stop

@section('meta_description'){{ $page->meta_description }}@stop

@section('meta_keywords'){{ $page->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $page->meta_title }}">
    <meta itemprop="description" content="{{ $page->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($page->meta_image) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="page">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $page->meta_title }}">
    <meta name="twitter:description" content="{{ $page->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($page->meta_image) }}">

    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $page->meta_title }}" />
    <meta property="og:type" content="page" />

    <meta property="og:image" content="{{ uploaded_asset($page->meta_image) }}" />
    <meta property="og:description" content="{{ $page->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />

@endsection

@section('content')
    <!--Page Header-->
    <section id="main-banner-page" class="position-relative page-header about-header @if(setting()->get('internal_pages_header_'.app()->getLocale())) parallax @endif section-nav-smooth" @if(setting()->get('internal_pages_header_'.app()->getLocale())) style="background-image: url({{asset('/storage/app/public/'. setting()->get('internal_pages_header_'.app()->getLocale()) )}})" @endif>
        <div class="overlay overlay-dark opacity-6"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="page-titles whitecolor text-center padding_top padding_bottom">
                        <h2 class="font-bold">{{ $page->getTranslation('title') }}</h2>
                    </div>
                </div>
            </div>
            <div class="gradient-bg title-wrap">
                <div class="row">
                    <div class="col-lg-12 col-md-12 whitecolor">
                        <h3 class="float-left">{{ $page->getTranslation('title') }}</h3>
                        <ul class="breadcrumb top10 bottom10 float-right">
                            <li class="breadcrumb-item hover-light"><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                            <li class="breadcrumb-item hover-light">{{ $page->getTranslation('title') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header ends -->


    <section class="bglight padding_top padding_bottom_half">
        <div class="container">
            <div class="row">
                <div class="col-12 p-4 bg-white rounded shadow-sm overflow-hidden">
                    @php echo $page->getTranslation('content'); @endphp
                </div>
            </div>
        </div>
    </section>
@endsection
