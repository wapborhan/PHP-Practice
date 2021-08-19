@if($business->description || $business->title)
  <div class="footer_panel padding_bottom_half bottom20">
      <h3 class="whitecolor bottom25">{{$business->title}}</h3>
      <p class="whitecolor bottom25">{!!$business->description!!}</p>
      <ul class="hours_links whitecolor">
        @if(isset($business->label_1) && isset($business->value_1))
          <li><span>{{$business->label_1}}:</span> <span>{{$business->value_1}}</span></li>
        @endif
        @if(isset($business->label_2) && isset($business->value_2))
          <li><span>{{$business->label_2}}:</span> <span>{{$business->value_2}}</span></li>
        @endif
        @if(isset($business->label_3) && isset($business->value_3))
          <li><span>{{$business->label_3}}:</span> <span>{{$business->value_3}}</span></li>
        @endif
        @if(isset($business->label_4) && isset($business->value_4))
          <li><span>{{$business->label_4}}:</span> <span>{{$business->value_4}}</span></li>
        @endif
        @if(isset($business->label_5) && isset($business->value_5))
          <li><span>{{$business->label_5}}:</span> <span>{{$business->value_5}}</span></li>
        @endif
      </ul>
  </div>
@endif