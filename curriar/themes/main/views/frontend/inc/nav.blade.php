<!-- header -->
<header class="site-header" id="header">
    <nav class="navbar navbar-expand-lg transparent-bg @if(setting()->get('main_header_stikcy_'.app()->getLocale())) static-nav @endif">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="@if(setting()->get('main_header_logo_'.app()->getLocale()) && setting()->get('main_header_logo_'.app()->getLocale()) != '') {{asset('/storage/app/public/'. setting()->get('main_header_logo_'.app()->getLocale()) )}} @else {{ static_asset('themes/main/frontend/logistic/images/logo-transparent.svg')}} @endif" alt="logo" class="logo-default">
                <img src="@if(setting()->get('sticky_header_logo_'.app()->getLocale()) && setting()->get('sticky_header_logo_'.app()->getLocale()) != '') {{asset('/storage/app/public/'. setting()->get('sticky_header_logo_'.app()->getLocale()) )}} @else {{ static_asset('themes/main/frontend/logistic/images/logo.svg')}} @endif" alt="logo" class="logo-scrolled">
            </a>
            <div class="collapse navbar-collapse">
                @if(isset($navbar_menu))
                    <ul class="navbar-nav">
                        @forelse ($navbar_menu->items as $item)
                            @include('frontend.inc.nav_links',['item' => $item])
                        @empty
                        @endforelse
                        @if(\App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.shipments.track') }}">{{translate('Tracking')}}</a>
                            </li>

                            @if(\App\ShipmentSetting::getVal('is_shipping_calc_required')=='1' )
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('shipment-calc') }}">{{translate('Shipment Calc')}}</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                @endif
                @if(null !==setting()->get('main_header_language_'.app()->getLocale()) && setting()->get('main_header_language_'.app()->getLocale()))
                    <style>
                        .drop-container:hover #lang-change .dropdown-menu{
                            transform: inherit !important;
                            visibility: visible !important;
                        }
                        .drop-container #lang-change .dropdown-menu .flag-img{
                            max-width: 15px;
                        }
                    </style>
                    <div class="drop-container">
                        <div class="dropdown" id="lang-change">

                            @php
                                if(Session::has('locale')){
                                    $locale = Session::get('locale', Config::get('app.locale'));
                                }
                                else{
                                    $locale = env('DEFAULT_LANGUAGE');
                                }
                                $language_now = \App\Language::where('code', $locale)->first();
                            @endphp

                            <a class="btn btn-countries dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="img-holder">
                                    <img class="flag-img" style="width: 26px;height: 20px;" src="{{uploaded_asset($language_now->icon)}}" alt="{{ $language_now->name }}">
                                </span>
                            </a>

                            <div
                            @if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
                                class="dropdown-menu dropdown-menu-left"
                            @else
                                class="dropdown-menu dropdown-menu-right"
                            @endif
                            >
                            @foreach (\App\Language::all() as $key => $language)
                                <a class="dropdown-item navi-link " href="javascript:void(0)" data-flag="{{ $language->code }}">
                                    <span class="mr-3 img-holder symbol symbol-20">
                                        <img class="mr-3 flag-img" src="{{uploaded_asset($language->icon)}}" alt="{{ $language->name }}">
                                    </span>
                                    <span class="navi-text">{{ $language->name }}</span>
                                </a>
                            @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if(isset($navbar_menu) && !empty($navbar_menu->items->toArray()))
            <!--side menu open button-->
            <a href="javascript:void(0)" class="d-inline-block sidemenu_btn" id="sidemenu_toggle">
                <span></span> <span></span> <span></span>
            </a>
        @endif
    </nav>
    <!-- side menu -->
    <div class="opacity-0 side-menu bg-yellow">
        <div class="overlay"></div>
        <div class="inner-wrapper">
            <span class="btn-close" id="btn_sideNavClose"><i></i><i></i></span>
            <nav class="side-nav w-100">
                <ul class="navbar-nav">
                    @foreach ($sidebar_menu->items ?? [] as $item)
                        <li class="nav-item">
                            <a class="nav-link @if(count($item->child) > 0)collapsePagesSideMenu @endif" @if(count($item->child) > 0)data-toggle="collapse" @endif href="@if(count($item->child) > 0) #sideNavPages{{$item->id}} @else {{$item->link}} @endif"> {{$item->label}} @if(count($item->child) > 0) <i class="fas fa-chevron-down"></i> @endif </a>
                            @if(count($item->child) > 0)
                                <div id="sideNavPages{{$item->id}}" class="collapse sideNavPages">
                                    <ul class="mt-2 navbar-nav">
                                        @foreach ($item->child as $child)
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{$item->link}}">{{$item->label}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
            <div class="side-footer w-100">
                <ul class="social-icons-simple white top40">
                    @if(isset($dark_social_links_name) && is_array($main_social_links_name))
                        @foreach ($main_social_links_name as $key => $social_link_name)
                            @if($social_link_name || $main_social_links_icon[$key])
                                <li><a href="{{$main_social_links_name[$key]}}" class=""><i
                                            class="{{$main_social_links_icon[$key]}}"></i> </a></li>
                            @endif
                        @endforeach
                    @endif
                </ul>
                <p class="whitecolor">{{setting()->get('main_footer_copy_right_'.app()->getLocale())}}</p>
            </div>
        </div>
    </div>
    <div id="close_side_menu" class="tooltip"></div>
    <!-- End side menu -->
</header>
<!-- header -->
