<!--Site Footer Here-->
<footer id="site-footer" class=" bgprimary padding_top">
    <div class="container">
        <div class="row">
            @php
                $item_number = setting()->get('main_footer_item_number_'.app()->getLocale()) ?? 0;
                if($item_number == 1){
                    $style = "col-lg-12";
                }elseif ($item_number == 2) {
                    $style = "col-lg-6";
                }elseif ($item_number == 3) {
                    $style = "col-lg-4";
                }else{
                    $style = "col-lg-3";
                }
            @endphp
            @if(isset($footer_containers))
                @foreach ($footer_containers as $footer_container)
                    <div class="{{$style}} col-md-6 col-sm-6">
                        @forelse ($footer_container->container_widget_with_lang ?? [] as $container_widget)
                                @widget('frontendWidget',['container_widget'=>$container_widget])
                        @empty
                            
                        @endforelse
                    </div>
                @endforeach
            @endif

            {{-- <div class="{{$style}} col-md-6 col-sm-6">
                <div class="footer_panel padding_bottom_half bottom20">
                    <a href="index-logistic.html" class="footer_logo bottom25"><img src="@if(setting()->get('main_footer_logo_'.app()->getLocale())) {{asset('/storage/app/public/'. setting()->get('main_footer_logo_'.app()->getLocale()) )}} @else {{ static_asset('themes/dark/frontend/logistic/images/logo-transparent.svg')}} @endif" alt="{{setting()->get('main_app_name_'.app()->getLocale())}}"></a>
                    <p class="whitecolor bottom25">{{setting()->get('main_footer_about_description_'.app()->getLocale())}}</p>
                    <div class="d-table w-100 address-item whitecolor bottom25">
                        <span class="d-table-cell align-middle"><i class="fas fa-mobile-alt"></i></span>
                        <p class="d-table-cell align-middle bottom0">
                            {{setting()->get('main_footer_contact_phone_'.app()->getLocale())}} <a class="d-block" href="mailto:web@support.com">{{setting()->get('main_footer_contact_email_'.app()->getLocale())}}</a>
                        </p>
                    </div>
                    <ul class="social-icons white wow fadeInUp" data-wow-delay="300ms">
                        @if(isset($dark_social_links_name) && is_array($main_social_links_name))
                            @foreach ($main_social_links_name as $key => $social_link_name)
                                @if($social_link_name || $main_social_links_icon[$key])
                                    <li><a href="{{$main_social_links_name[$key]}}" target="_blank" class=""><i class="{{$main_social_links_icon[$key]}}"></i> </a> </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="{{$style}} col-md-6 col-sm-6">
                <div class="footer_panel padding_bottom_half bottom20">
                    <h3 class="whitecolor bottom25">Latest News</h3>
                    <ul class="latest_news whitecolor">
                        <li> <a href="#.">Aenean tristique justo et... </a> <span class="date defaultcolor">15 March 2019</span> </li>
                        <li> <a href="#.">Phasellus dapibus dictum augue... </a> <span class="date defaultcolor">15 March 2019</span> </li>
                        <li> <a href="#.">Mauris blandit vitae. Praesent non... </a> <span class="date defaultcolor">15 March 2019</span> </li>
                    </ul>
                </div>
            </div>
            <div class="{{$style}} col-md-6 col-sm-6">
                <div class="footer_panel padding_bottom_half bottom20 pl-0 pl-lg-5">
                    <h3 class="whitecolor bottom25">Our Services</h3>
                    @php
                        $footer_menu = Menu::getByName('footer_menu'); //return array
                    @endphp
                    @if($footer_menu)
                    <ul class="links">
                        @foreach($footer_menu as $menu)
                        <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                        @endforeach
                    </ul>
                    @endif

                </div>
            </div>
            <div class="{{$style}} col-md-6 col-sm-6">
                <div class="footer_panel padding_bottom_half bottom20">
                    <h3 class="whitecolor bottom25">Business hours</h3>
                    <p class="whitecolor bottom25">Our support available to help you 24 hours a day, seven days week</p>
                    <ul class="hours_links whitecolor">
                        <li><span>Monday-Saturday:</span> <span>8.00-18.00</span></li>
                        <li><span>Friday:</span> <span>09:00-21:00</span></li>
                        <li><span>Sunday:</span> <span>09:00-20:00</span></li>
                        <li><span>Calendar Events:</span> <span>24-Hour Shift</span></li>
                    </ul>
                </div>
            </div> --}}
        </div>
        <div class="py-4 d-flex flex-lg-column" style="color: white">
            <!--begin::Container-->
            <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!--begin::Copyright-->
                <div class="order-2 order-md-1">
                    {{-- <a href="{{url('/')}}">{!! setting()->get('main_footer_copy_right_'.app()->getLocale()) ?? '' !!}</a> --}}
                    @if(isset($footer_menu))
                        @forelse ($footer_menu->items as $item)
                            {{-- @if(count($item->child) > 0)
                                {{$item->label}} has {{count($item->child)}} child <br> 
                            @endif --}}
                            <a class="mr-2" href="{{$item->link}}">{{$item->label}}</a>
                            @if(!$loop->last)
                                |
                            @endif
                        @empty
                            
                        @endforelse
                    @endif
                </div>
                <!--end::Copyright-->
                <!--begin::Nav-->
                <div class="nav nav-dark">
                    @if(setting()->get('main_footer_copy_right_'.app()->getLocale()))
                        {{setting()->get('main_footer_copy_right_'.app()->getLocale())}} 
                    @else
                        Copyright © {{date('Y')}} All rights reserved.
                    @endif
                </div>
                <!--end::Nav-->
            </div>
            <!--end::Container-->
        </div>
    </div>
</footer>
<!--Footer ends-->
