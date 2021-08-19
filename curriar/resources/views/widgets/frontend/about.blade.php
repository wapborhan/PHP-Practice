@if($about->description || $about->logo)
  <div class="footer_panel">
      <a href="{{url('/')}}" class="footer_logo bottom25"><img src="{{static_asset($about->logo)}}" alt="MegaOne"></a>
      <p class="whitecolor bottom25">{!!$about->description!!}.</p>
      <div class="d-table w-100 address-item whitecolor bottom25">
          <span class="d-table-cell align-middle"><i class="fas fa-mobile-alt"></i></span>
          @if(isset($about->phone) || isset($about->email))
            <p class="d-table-cell align-middle bottom0">
                {{$about->phone}} <a class="d-block" href="mailto:{{$about->email}}">{{$about->email}}</a>
            </p>
          @endif
      </div>

      @php
          $main_social_links_name = json_decode( setting()->get('main_social_links_name_'.app()->getLocale()) );
          $main_social_links_icon = json_decode(  setting()->get('main_social_links_icon_'.app()->getLocale()) );
      @endphp

      @if(is_array($main_social_links_name))
        <div class="footer-social">
          <ul class="list-unstyled text-white">
            @foreach ($main_social_links_name as $key => $social_link_name)
                <li><a class="wow fadeInUp @php echo str_replace('fa-', '', str_replace('-square', '', $main_social_links_icon[$key])); @endphp" href="{{$social_link_name}}"><i class="{{$main_social_links_icon[$key]}}"></i></a></li>
            @endforeach
          </ul>
        </div>
      @endif
  </div>
@endif