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
    <link rel="icon" href="@if(setting()->get('main_site_icon_'.app()->getLocale())) {{asset('/storage/app/public/'. setting()->get('main_site_icon_'.app()->getLocale()) )}} @else {{static_asset('assets/dashboard/media/logos/favicon.ico')}} @endif">
	@if(setting()->get('main_app_name_'.app()->getLocale()))
		<title>@if(View::hasSection('meta_title')) @yield('meta_title') | @endif {{setting()->get('main_app_name_'.app()->getLocale() )}}</title>
	@else
		<title>@if(View::hasSection('meta_title')) @yield('meta_title') | @endif {{ translate('Spotlayer Framework') }}</title>
	@endif

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


    <!-- Favicon -->
    <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aclonica|Allan|Annie+Use+Your+Telescope|Anonymous+Pro|Allerta+Stencil|Allerta|Amaranth|Anton|Archivo|Architects+Daughter|Arimo|Artifika|Arvo|Asset|Astloch|Bangers|Bentham|Bevan|Bigshot+One|Bowlby+One|Bowlby+One+SC|Brawler|Buda%3A300|Cabin|Calligraffitti|Candal|Cantarell|Cardo|Carter+One|Caudex|Cedarville+Cursive|Cherry+Cream+Soda|Chewy|Coda|Coming+Soon|Copse|Corben%3A700|Cousine|Covered+By+Your+Grace|Crafty+Girls|Crimson+Text|Crushed|Cuprum|Damion|Dancing+Script|Dawning+of+a+New+Day|DM+Sans|Didact+Gothic|Droid+Sans|Droid+Sans+Mono|Droid+Serif|EB+Garamond|Expletus+Sans|Fontdiner+Swanky|Forum|Francois+One|Geo|Give+You+Glory|Goblin+One|Goudy+Bookletter+1911|Gravitas+One|Gruppo|Hammersmith+One|Holtwood+One+SC|Homemade+Apple|Inconsolata|Indie+Flower|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Irish+Grover|Irish+Growler|Istok+Web|Josefin+Sans|Josefin+Slab|Judson|Jura|Jura%3A500|Jura%3A600|Just+Another+Hand|Just+Me+Again+Down+Here|Kameron|Kenia|Kranky|Kreon|Kristi|La+Belle+Aurore|Lato%3A100|Lato%3A100italic|Lato%3A300|Lato|Lato%3Abold|Lato%3A900|League+Script|Lekton|Limelight|Lobster|Lobster+Two|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Luckiest+Guy|Maiden+Orange|Mako|Maven+Pro|Maven+Pro%3A500|Maven+Pro%3A700|Maven+Pro%3A900|Meddon|MedievalSharp|Megrim|Merriweather|Metrophobic|Michroma|Miltonian+Tattoo|Miltonian|Modern+Antiqua|Monofett|Molengo|Montserrat|Mountains+of+Christmas|Muli%3A300|Muli|Neucha|Neuton|News+Cycle|Nixie+One|Nobile|Noto+Sans|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Nunito%3Alight|Nunito|Nunito+Sans|OFL+Sorts+Mill+Goudy+TT|Old+Standard+TT|Open+Sans%3A300|Open+Sans|Open+Sans%3A600|Open+Sans%3A800|Open+Sans+Condensed%3A300|Orbitron|Orbitron%3A500|Orbitron%3A700|Orbitron%3A900|Oswald|Over+the+Rainbow|Reenie+Beanie|Pacifico|Patrick+Hand|Paytone+One|Permanent+Marker|Philosopher|Play|Playfair+Display|Podkova|Poppins|PT+Sans|PT+Sans+Narrow|PT+Sans+Narrow%3Aregular%2Cbold|PT+Serif|PT+Serif+Caption|Puritan|Quattrocento|Quattrocento+Sans|Radley|Raleway|Raleway%3A100|Redressed|Rock+Salt|Rokkitt|Roboto|Roboto+Condensed|Roboto+Slab|Ruslan+Display|Schoolbell|Shadows+Into+Light|Shanti|Sigmar+One|Six+Caps|Slackey|Smythe|Sniglet%3A800|Special+Elite|Stardos+Stencil|Sue+Ellen+Francisco|Sunshiney|Swanky+and+Moo+Moo|Syncopate|Tajawal|Tangerine|Tenor+Sans|Terminal+Dosis+Light|The+Girl+Next+Door|Tinos|Ubuntu|Ultra|Unkempt|UnifrakturCook%3Abold|UnifrakturMaguntia|Varela|Varela+Round|Vibur|Vollkorn|VT323|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Wire+One|Work+Sans|Yanone+Kaffeesatz|Yanone+Kaffeesatz%3A300|Yanone+Kaffeesatz%3A400|Yanone+Kaffeesatz%3A700|Yeseva+One|Zeyada" rel="stylesheet" type="text/css">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('vendor/van-ons/laraberg/public/css/laraberg.css')}}">

   
    
    <link rel="stylesheet" href="{{ static_asset('themes/main/frontend/vendor/css/bundle.min.css')}}">
    <link rel="stylesheet" href="{{ static_asset('themes/main/frontend/vendor/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ static_asset('themes/main/frontend/vendor/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{ static_asset('themes/main/frontend/vendor/css/cubeportfolio.min.css')}}">
    <link rel="stylesheet" href="{{ static_asset('themes/main/frontend/vendor/css/tooltipster.min.css')}}">
    <link rel="stylesheet" href="{{ static_asset('themes/main/frontend/vendor/css/revolution-settings.min.css')}}">
    <link rel="stylesheet" href="{{ static_asset('themes/main/frontend/logistic/css/revolution/navigation.css')}}">
    @if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
		
		<link href="https://fonts.googleapis.com/css2?family=Cairo" rel="stylesheet">
        <link rel="stylesheet" href="{{ static_asset('themes/main/frontend/logistic/css/style-rtl.css')}}">
    @else
        <link rel="stylesheet" href="{{ static_asset('themes/main/frontend/logistic/css/style.css')}}">
    @endif

    <script>
        var AIZ = AIZ || {};
    </script>

    <style>
        body{
            /* font-family: 'Open Sans', sans-serif; */
            font-family: "{{ setting()->get('primary_font_'.app()->getLocale()) ?? 'Open Sans' }}";
            font-weight: 400;
        }
        :root{
            --primary: {{ get_setting('base_color', '#e62d04') }};
            --hov-primary: {{ get_setting('base_hov_color', '#c52907') }};
            --soft-primary: {{ hex2rgba(get_setting('base_color','#e62d04'),.15) }};
        }
    </style>

@if (\App\BusinessSetting::where('type', 'google_analytics')->first()->value == 1)
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('TRACKING_ID') }}"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ env('TRACKING_ID') }}');
    </script>
@endif

@if (\App\BusinessSetting::where('type', 'facebook_pixel')->first()->value == 1)
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ env('FACEBOOK_PIXEL_ID') }}');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ env('FACEBOOK_PIXEL_ID') }}/&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
@endif

</head>
<body>

    @if(!get_setting('home_slider_status') && !get_setting('home_banner1_status') && !get_setting('home_section1_status') && !get_setting('home_process_status') && !get_setting('home_msection_status') && !get_setting('home_statistics_status') && !get_setting('home_team_status') && !get_setting('home_clients_status') && !get_setting('home_testimonials_status'))
        
        <div class="container" style="padding-top: 150px;">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">{{translate('Home Page not have content')}}!</h4>
                <hr>
                <p>           
                    {{translate('Please set home page design')}}          
                    <a href="{{route('custom-pages.edit',["id"=>'home', 'lang'=>env('DEFAULT_LANGUAGE'), 'page'=>'home'])}}"
                            style="border-bottom: 1px solid;"
                            target="_blank">{{translate('Here')}}</a>
                </p>
            </div>
        </div>
        
    @else
        <!--PreLoader-->
        <div class="loader">
            <div class="loader-spinner"></div>
        </div>
        <!--PreLoader Ends-->

        @php
            $main_social_links_name = json_decode( setting()->get('main_social_links_name_'.app()->getLocale()) );
            $main_social_links_icon = json_decode(  setting()->get('main_social_links_icon_'.app()->getLocale()) );
        @endphp
            
            @include('frontend.inc.nav')    

            @if (get_setting('main_maintenance') == 'on')
                @yield('maintenance')
            @else
                @yield('content')
            @endif

            @include('frontend.inc.footer')

        

            @if (get_setting('show_cookies_agreement') == 'on')
                <div class="aiz-cookie-alert shadow-xl">
                    <div class="p-3 bg-dark rounded">
                        <div class="text-white mb-3">
                            @php
                                echo get_setting('cookies_agreement_text');
                            @endphp
                        </div>
                        <button class="btn btn-primary aiz-cookie-accepet">
                            {{ translate('Ok. I Understood') }}
                        </button>
                    </div>
                </div>
            @endif

            @include('frontend.partials.modal')

            <div class="modal fade" id="addToCart">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
                    <div class="modal-content position-relative">
                        <div class="c-preloader text-center p-3">
                            <i class="las la-spinner la-spin la-3x"></i>
                        </div>
                        <button type="button" class="close absolute-top-right btn-icon close z-1" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="la-2x">&times;</span>
                        </button>
                        <div id="addToCart-modal-body">

                        </div>
                    </div>
                </div>
            </div>

            @yield('modal')

        
            <script src="{{ static_asset('themes/main/frontend/vendor/js/bundle.min.js')}}"></script>
        <!--to view items on reach-->
        <script src="{{ static_asset('themes/main/frontend/vendor/js/jquery.appear.js')}}"></script>
        <!--Owl Slider-->
        <script src="{{ static_asset('themes/main/frontend/vendor/js/owl.carousel.min.js')}}"></script>
        <!--Parallax Background-->
        <script src="{{ static_asset('themes/main/frontend/vendor/js/parallaxie.min.js')}}"></script>
        <!--Cubefolio Gallery-->
        <script src="{{ static_asset('themes/main/frontend/vendor/js/jquery.cubeportfolio.min.js')}}"></script>
        <!--Fancybox js-->
        <script src="{{ static_asset('themes/main/frontend/vendor/js/jquery.fancybox.min.js')}}"></script>
        <!--wow js-->
        <script src="{{ static_asset('themes/main/frontend/vendor/js/wow.min.js')}}"></script>
        <!--number counters-->
        <script src="{{ static_asset('themes/main/frontend/vendor/js/jquery-countTo.js')}}"></script>
        <!--tooltip js-->
        <script src="{{ static_asset('themes/main/frontend/vendor/js/tooltipster.min.js')}}"></script>
        <!--Revolution SLider-->
        <script src="{{ static_asset('themes/main/frontend/vendor/js/jquery.themepunch.tools.min.js')}}"></script>
        <script src="{{ static_asset('themes/main/frontend/vendor/js/jquery.themepunch.revolution.min.js')}}"></script>
        <!-- SLIDER REVOLUTION 5.0 EXTENSIONS -->
        <script src="{{ static_asset('themes/main/frontend/vendor/js/extensions/revolution.extension.actions.min.js')}}"></script>
        <script src="{{ static_asset('themes/main/frontend/vendor/js/extensions/revolution.extension.carousel.min.js')}}"></script>
        <script src="{{ static_asset('themes/main/frontend/vendor/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
        <script src="{{ static_asset('themes/main/frontend/vendor/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
        <script src="{{ static_asset('themes/main/frontend/vendor/js/extensions/revolution.extension.migration.min.js')}}"></script>
        <script src="{{ static_asset('themes/main/frontend/vendor/js/extensions/revolution.extension.navigation.min.js')}}"></script>
        <script src="{{ static_asset('themes/main/frontend/vendor/js/extensions/revolution.extension.parallax.min.js')}}"></script>
        <script src="{{ static_asset('themes/main/frontend/vendor/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
        <script src="{{ static_asset('themes/main/frontend/vendor/js/extensions/revolution.extension.video.min.js')}}"></script>
        <!--custom functions and script-->
        <script src="{{ static_asset('themes/main/frontend/logistic/js/functions.js')}}"></script>

        <!--React js-->
        <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
        <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>

        <!--Laraberg js-->
        <script src="{{ asset('vendor/van-ons/laraberg/public/js/laraberg.js') }}"></script>


        <script src="{{ static_asset('assets/js/aiz-core.js') }}" ></script>
        
            @if (get_setting('facebook_chat') == 1)
                <script type="text/javascript">
                    window.fbAsyncInit = function() {
                        FB.init({
                        xfbml            : true,
                        version          : 'v3.3'
                        });
                    };

                    (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                    fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
                <div id="fb-root"></div>
                <!-- Your customer chat code -->
                <div class="fb-customerchat"
                attribution=setup_tool
                page_id="{{ env('FACEBOOK_PAGE_ID') }}">
                </div>
            @endif

            <script>
                @foreach (session('flash_notification', collect())->toArray() as $message)
                    AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
                @endforeach
            </script>


            <script>

                $(document).ready(function() {
                
                    if ($('#lang-change').length > 0) {
                        $('#lang-change .dropdown-menu a').each(function() {
                            $(this).on('click', function(e){
                                e.preventDefault();
                                var $this = $(this);
                                var locale = $this.data('flag');
                                $.post('{{ route('language.change') }}',{_token: AIZ.data.csrf, locale:locale}, function(data){
                                    location.reload();
                                });

                            });
                        });
                    }

                    
                });

                $('#search').on('keyup', function(){
                    search();
                });

                $('#search').on('focus', function(){
                    search();
                });

                function search(){
                    var searchKey = $('#search').val();
                    if(searchKey.length > 0){
                        $('body').addClass("typed-search-box-shown");

                        $('.typed-search-box').removeClass('d-none');
                        $('.search-preloader').removeClass('d-none');
                        $.post('{{ route('search.ajax') }}', { _token: AIZ.data.csrf, search:searchKey}, function(data){
                            if(data == '0'){
                                // $('.typed-search-box').addClass('d-none');
                                $('#search-content').html(null);
                                $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+searchKey+'"</strong>');
                                $('.search-preloader').addClass('d-none');

                            }
                            else{
                                $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                                $('#search-content').html(data);
                                $('.search-preloader').addClass('d-none');
                            }
                        });
                    }
                    else {
                        $('.typed-search-box').addClass('d-none');
                        $('body').removeClass("typed-search-box-shown");
                    }
                }

        

            </script>

            @yield('script')

    @endif
</body>
</html>
