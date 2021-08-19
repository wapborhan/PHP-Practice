@php
    $social_links_name = json_decode( setting()->get($active_theme->name.'_social_links_name_'.app()->getLocale()) );
    $social_links_icon = json_decode(  setting()->get($active_theme->name.'_social_links_icon_'.app()->getLocale()) );
    $social_links_count = json_decode(  setting()->get($active_theme->name.'_social_links_count_'.app()->getLocale()) );
@endphp
@if(is_array($social_links_name))
    <div id="bdaia-widget-counter-2" class="content-only widget bdaia-widget bdaia-widget-counter">
        @if($social->front_title)
            <div class="widget-box-title widget-box-title-s4"><h3>{{$social->front_title}}</h3></div>
        @else
            <div class="mt-5"></div>
        @endif
        <div class="widget-social-links bdaia-social-io-colored">
            <div class="bdaia-social-io bdaia-social-io-size-35">
                @foreach ($social_links_name as $key => $social_link_name)
                    @if($social_link_name || $social_links_name[$key])
                        @if(str_starts_with($social_links_name[$key], 'http'))
                            <a class="none bdaia-io-url-facebook" title="Facebook" href="{{$social_links_name[$key]}}" target="_blank"><i class="social-icon {{$social_links_icon[$key]}}"></i></a>
                        @else
                            <a class="none bdaia-io-url-facebook" title="Facebook" href="http://{{$social_links_name[$key]}}" target="_blank"><i class="social-icon {{$social_links_icon[$key]}}"></i></a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif