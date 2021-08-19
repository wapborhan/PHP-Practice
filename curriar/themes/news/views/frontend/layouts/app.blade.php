<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">
    <link rel="icon" href="@if(setting()->get('news_site_icon_'.app()->getLocale())) {{asset('/storage/app/public/'. setting()->get('news_site_icon_'.app()->getLocale()) )}} @else {{static_asset('assets/dashboard/media/logos/favicon.ico')}} @endif">
    <title>@yield('meta_title', ( setting()->get('news_app_name_'.app()->getLocale()) ?? 'Spotlayer') .' | '. ( setting()->get('news_site_motto_'.app()->getLocale()) ?? '') )</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">

    @yield('meta')

  
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
    <meta itemprop="description" content="{{ get_setting('meta_description') }}">
    <meta itemprop="image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="{{ get_setting('meta_description') }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ uploaded_asset(get_setting('meta_image')) }}" />
    <meta property="og:description" content="{{ get_setting('meta_description') }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aclonica|Allan|Annie+Use+Your+Telescope|Anonymous+Pro|Allerta+Stencil|Allerta|Amaranth|Anton|Archivo|Architects+Daughter|Arimo|Artifika|Arvo|Asset|Astloch|Bangers|Bentham|Bevan|Bigshot+One|Bowlby+One|Bowlby+One+SC|Brawler|Buda%3A300|Cabin|Calligraffitti|Candal|Cantarell|Cardo|Carter+One|Caudex|Cedarville+Cursive|Cherry+Cream+Soda|Chewy|Coda|Coming+Soon|Copse|Corben%3A700|Cousine|Covered+By+Your+Grace|Crafty+Girls|Crimson+Text|Crushed|Cuprum|Damion|Dancing+Script|Dawning+of+a+New+Day|DM+Sans|Didact+Gothic|Droid+Sans|Droid+Sans+Mono|Droid+Serif|EB+Garamond|Expletus+Sans|Fontdiner+Swanky|Forum|Francois+One|Geo|Give+You+Glory|Goblin+One|Goudy+Bookletter+1911|Gravitas+One|Gruppo|Hammersmith+One|Holtwood+One+SC|Homemade+Apple|Inconsolata|Indie+Flower|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Irish+Grover|Irish+Growler|Istok+Web|Josefin+Sans|Josefin+Slab|Judson|Jura|Jura%3A500|Jura%3A600|Just+Another+Hand|Just+Me+Again+Down+Here|Kameron|Kenia|Kranky|Kreon|Kristi|La+Belle+Aurore|Lato%3A100|Lato%3A100italic|Lato%3A300|Lato|Lato%3Abold|Lato%3A900|League+Script|Lekton|Limelight|Lobster|Lobster+Two|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Luckiest+Guy|Maiden+Orange|Mako|Maven+Pro|Maven+Pro%3A500|Maven+Pro%3A700|Maven+Pro%3A900|Meddon|MedievalSharp|Megrim|Merriweather|Metrophobic|Michroma|Miltonian+Tattoo|Miltonian|Modern+Antiqua|Monofett|Molengo|Montserrat|Mountains+of+Christmas|Muli%3A300|Muli|Neucha|Neuton|News+Cycle|Nixie+One|Nobile|Noto+Sans|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Nunito%3Alight|Nunito|Nunito+Sans|OFL+Sorts+Mill+Goudy+TT|Old+Standard+TT|Open+Sans%3A300|Open+Sans|Open+Sans%3A600|Open+Sans%3A800|Open+Sans+Condensed%3A300|Orbitron|Orbitron%3A500|Orbitron%3A700|Orbitron%3A900|Oswald|Over+the+Rainbow|Reenie+Beanie|Pacifico|Patrick+Hand|Paytone+One|Permanent+Marker|Philosopher|Play|Playfair+Display|Podkova|Poppins|PT+Sans|PT+Sans+Narrow|PT+Sans+Narrow%3Aregular%2Cbold|PT+Serif|PT+Serif+Caption|Puritan|Quattrocento|Quattrocento+Sans|Radley|Raleway|Raleway%3A100|Redressed|Rock+Salt|Rokkitt|Roboto|Roboto+Condensed|Roboto+Slab|Ruslan+Display|Schoolbell|Shadows+Into+Light|Shanti|Sigmar+One|Six+Caps|Slackey|Smythe|Sniglet%3A800|Special+Elite|Stardos+Stencil|Sue+Ellen+Francisco|Sunshiney|Swanky+and+Moo+Moo|Syncopate|Tajawal|Tangerine|Tenor+Sans|Terminal+Dosis+Light|The+Girl+Next+Door|Tinos|Ubuntu|Ultra|Unkempt|UnifrakturCook%3Abold|UnifrakturMaguntia|Varela|Varela+Round|Vibur|Vollkorn|VT323|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Wire+One|Work+Sans|Yanone+Kaffeesatz|Yanone+Kaffeesatz%3A300|Yanone+Kaffeesatz%3A400|Yanone+Kaffeesatz%3A700|Yeseva+One|Zeyada" rel="stylesheet" type="text/css">

    <!-- CSS Files -->
   
    @if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <link rel="stylesheet" href="">
    @endif
   
    <link rel="stylesheet" href="{{ static_asset('themes/main/frontend/vendor/css/bundle.min.css')}}">
    <link rel="stylesheet" id="kolyoum-default-css" href="{{ static_asset('themes/news/frontend/assets/css/style.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="wooohoo-ilightbox-skin-css" href="{{ static_asset('themes/news/frontend/assets/css/ilightbox/dark-skin/skin.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="wooohoo-ilightbox-skin-black-css" href="{{ static_asset('themes/news/frontend/assets/css/ilightbox/metro-black-skin/skin.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="bdaia-woocommerce-css" href="{{ static_asset('themes/news/frontend/assets/css/woocommerce.css')}}" type="text/css" media="all" />
    <script type="text/javascript" src="{{ static_asset('themes/news/frontend/assets/js/jquery/jquery.js')}}"></script>
    <script type="text/javascript" src="{{ static_asset('themes/news/frontend/assets/js/jquery/jquery-migrate.min.js')}}"></script>
    <script type="text/javascript" src="{{ static_asset('themes/news/frontend/assets/js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{ static_asset('themes/news/frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <style type='text/css'>
        @media only screen and (max-width: 900px) {
            .bd-push-menu-open aside.bd-push-menu,
            aside.bd-push-menu.light-skin {
                background: #fe4f2d;
                background: -webkit-linear-gradient(176deg, #cf109f, #fe4f2d);
                background: linear-gradient(176deg, #cf109f, #fe4f2d);
            }
        }

        @media only screen and (max-width: 900px) {
            div.bd-push-menu-inner::before {
                background-image: url("{{ static_asset('themes/news/frontend/assets/images/dsfdsfsddfsfd.jpg')}}") !important;
                background-repeat: no-repeat;
                background-attachment: scroll;
                background-position: center;
                background-position: center;
            }
        }

        div.bdaia-footer,
        div.bdaia-footer.bd-footer-light {
            background: #111026;
            background: -webkit-linear-gradient(176deg, #111026, #111026);
            background: linear-gradient(176deg, #111026, #111026);
        }

        div.bdaia-footer::before {
            background-image: url("{{ static_asset('themes/news/frontend/assets/images/footer-background.svg')}}") !important;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-position: center top;
        }

        .bd-cat-10 {
            background: #e5b22b !important;
            color: #FFF !important;
        }

        .bd-cat-10::after {
            border-top-color: #e5b22b !important
        }

        .bd-cat-13 {
            background: #39a657 !important;
            color: #FFF !important;
        }

        .bd-cat-13::after {
            border-top-color: #39a657 !important
        }

        .bd-cat-8 {
            background: #6b45e0 !important;
            color: #FFF !important;
        }

        .bd-cat-8::after {
            border-top-color: #6b45e0 !important
        }

        .bd-cat-12 {
            background: #e81055 !important;
            color: #FFF !important;
        }

        .bd-cat-12::after {
            border-top-color: #e81055 !important
        }

        .bdaia-header-default .topbar:not(.topbar-light) {
            background: #fb8332
        }

        .bdaia-header-default .topbar:not(.topbar-light) {
            background: linear-gradient(176deg, #fb8332 0, #b31919 100%);
        }

        .bdaia-header-default .header-container {
            border-bottom: 0 none;
        }

        ul.bd-components>li.bd-alert-posts {
            padding-right: 0;
        }

        .bdaia-header-default .header-container .bd-container {
            background: url({{ static_asset('themes/news/frontend/assets/images/top-shadow.png')}}) no-repeat top;
        }

        .bdaia-header-default .topbar.topbar-gradient .breaking-title {
            background-color: rgba(0, 0, 0, .75);
            border-radius: 2px;
        }

        .inner-wrapper {
            background-color: #FFF;
        }

        .article-meta-info .bd-alignleft .meta-item:last-child {
            margin-right: 0;
        }

        .article-meta-info .bd-alignright .meta-item:first-child {
            margin-left: 0;
        }

        .articles-box-dark.articles-box.articles-box-block625 .articles-box-items>li:first-child {
            border-bottom: 1px solid rgba(255, 255, 255, .1);
        }

        .articles-box.articles-box-block614 .articles-box-items>li .article-details h3 {
            padding: 0;
            font-size: 19px;
            line-height: 1.33;
            font-weight: normal;
        }
        .list-down-btn
        {
            float: right;
            color: black !important;
            margin-top: 2px;
            background-color: inherit !important;
        }
        .list-down-btn:hover
        {
            color: black !important;
            background-color: inherit !important;
        }
        .list-group-collapse
        {
            overflow: hidden;
        }
        .list-group-collapse li  ul {
            margin-left: -15px;
            margin-right: -15px;
            margin-bottom: -11px;
            border-radius: 0px;
        }
        .list-group-collapse li ul
        {
            border-radius: 0px !important;
            margin-top: 8px;
        }
        .list-group-collapse li  ul li {
            border-radius: 0px !important;
            border-left: none;
            border-right: none;
            padding-left: 32px;
        }
        .hide-list{
            display: none;
        }
        .social-icon{
            color: #FFF !important;
            float: left;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            font-size: 21px;
            margin: inherit;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            border-radius: 100%;
            text-shadow: 0 2px 1px rgb(0 0 0 / 11%);
            color: #FFF;
            display: inline-block;
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            letter-spacing: 0;
            -webkit-font-feature-settings: "liga";
            -moz-font-feature-settings: "liga=1";
            -moz-font-feature-settings: "liga";
            -ms-font-feature-settings: "liga" 1;
            -o-font-feature-settings: "liga";
            font-feature-settings: "liga";
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: auto;
            background: #111028;
        }
        .footer-col4{
            float: left;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
            width: 33.3%;
        }
    </style>
    
    <script>
        var AIZ = AIZ || {};
    </script>
    @yield('style')
</head>
<body
        class="home page-template-default page wp-embed-responsive theme-kolyoum sidebar-right has-sidebar of-new-article has-lazy-load"
        itemscope="itemscope"
        itemtype="https://schema.org/WebPage"
>
@if(\App\Addon::where('unique_identifier','spot-blog-addon')->where('activated', 1)->count() > 0)
    <div class="page-outer bdaia-header-default sticky-nav-on">
        <div id="page">
            <div class="inner-wrapper">
                <div id="warp" class="clearfix">
                    @include('frontend.inc.nav')    
                    
                    @yield('content')
                    
                    @include('frontend.inc.footer')
                </div>
            </div>
        </div>
    </div>

    @include('frontend.inc.aside')
    
    <div class="gotop" title="Go Top"><span class="bdaia-io bdaia-io-ion-android-arrow-up"></span></div>
    
    
    @yield('modal')
  

    <script>
        WebFontConfig = {
            google: {
                families: ["Poppins:regular,500,600,700:latin", "Roboto:100,300,400,500,700,900:latin", "Open+Sans:400,600,700,800:latin"],
            },
        };
        (function () {
            var wf = document.createElement("script");
            wf.src = "//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
            wf.type = "text/javascript";
            wf.async = "true";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    <script type="text/javascript" src="{{ static_asset('themes/news/frontend/assets/js/functions.js')}}"></script>
    <script type="text/javascript" src="{{ static_asset('themes/news/frontend/assets/js/sliders.js')}}"></script>
    <script>
        @foreach (session('flash_notification', collect())->toArray() as $message)
            AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
        @endforeach
        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
    </script>

    @yield('script')

@else
    <div class="container" style="padding-top: 150px;">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">{{translate('Home Page not have content')}}!</h4>
            <hr>
            <p>           
                {{translate('Please install blog addon')}}          
                <a href="{{route('addons.index')}}"
                        style="border-bottom: 1px solid;"
                        target="_blank">{{translate('Here')}}</a>
            </p>
        </div>
    </div>
@endif
    
</body>
</html>
