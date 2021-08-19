<div class="bdaia-footer bd-footer-dark">
    <div class="bdaia-footer-widgets">
        <div class="bd-container">
            @php
                $item_number = setting()->get('news_footer_item_number_'.app()->getLocale()) ?? 0;
                if($item_number == 1){
                    $style = "one";
                }elseif ($item_number == 2) {
                    $style = "two";
                }elseif ($item_number == 3) {
                    $style = "three";
                }else{
                    $style = "four";
                }
            @endphp
            <div class="bdaia-footer-widgets-area footer-col-{{$style}}">
                @foreach ($footer_containers as $footer_container)
                    <div class="footer-widget-inner">
                        @forelse ($footer_container->container_widget_with_lang ?? [] as $container_widget)
                            @widget('frontendWidget',['container_widget'=>$container_widget])
                        @empty
                            
                        @endforelse
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bd-footer-top-area">
        <div class="bd-container">
            <div class="bdaia-row">
                @forelse ($second_footer->container_widget_with_lang ?? [] as $container_widget)
                    <div class="footer-col4">
                        @widget('frontendWidget',['container_widget'=>$container_widget])
                    </div>
                @empty
                    
                @endforelse
                {{-- <div class="footer-col4">
                    <div class="footer-logo-inner">
                        <img src="{{ static_asset('themes/news/frontend/assets/images/demo/footer-logo.svg')}}" alt="" />
                    </div>
                </div>
                <div class="footer-col4">
                    <div class="footer-about-us-inner">
                        <p style="text-align: center;">
                            Kolyoum is a Wordpess theme for Magazine and Blog. We pack in here just the things you need to start a News/Review/Blog and this come with a very reasonable price.
                        </p>
                    </div>
                </div>
                <div class="footer-col4">
                    <div class="widget-social-links bdaia-social-io-colored">
                        <div class="bdaia-social-io bdaia-social-io-size-35">
                            <a class="none bdaia-io-url-facebook" title="Facebook" href="#" target="_blank"><span class="bdaia-io bdaia-io-facebook"></span></a>
                            <a class="none bdaia-io-url-twitter" title="Twitter" href="#" target="_blank"><span class="bdaia-io bdaia-io-twitter"></span></a>
                            <a class="none bdaia-io-url-google-plus" title="Google+" href="#" target="_blank"><span class="bdaia-io bdaia-io-googleplus"></span></a>
                            <a class="none bdaia-io-url-dribbble" title="Dribbble" href="#" target="_blank"><span class="bdaia-io bdaia-io-dribbble"></span></a>
                            <a class="none bdaia-io-url-youtube" title="Youtube" href="#" target="_blank"><span class="bdaia-io bdaia-io-youtube"></span></a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="bdaia-footer-area bd-footer-dark">
        <div class="bd-container">
            <div class="bdaia-footer-area-l">
                <span class="copyright">{!! setting()->get('news_footer_copy_right_'.app()->getLocale()) ?? "© Copyright 2021 - Kolyoum News Theme by Algoriza" !!}</span>
            </div>
            <div class="bdaia-footer-area-r">
                <div class="bd-footer-menu">
                    <div class="menu-footer-menu-container">
                        <ul id="menu-footer-menu" class="footer-bottom-menu">
                            @if(isset($footer_menu))
                                @forelse ($footer_menu->items as $item)
                                    {{-- @if(count($item->child) > 0)
                                        {{$item->label}} has {{count($item->child)}} child <br> 
                                    @endif --}}
                                    <li id="menu-item-{{$loop->iteration}}" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-85"><a href="{{$item->link}}">{{$item->label}}</a></li>
                                @empty
                                    
                                @endforelse
                            @endif
                            {{-- <li id="menu-item-83" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-83"><a href="#">Advertisement</a></li>
                            <li id="menu-item-84" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-84"><a href="#">Privacy</a></li>
                            <li id="menu-item-86" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-86"><a href="#">Contact</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>