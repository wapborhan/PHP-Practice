@if($text->title || $text->description)
  <div class="card mb-5 p-4" style="border: 6px solid rgba(0, 0, 0, 0.05);background-color: inherit;">
      <div class="footer-about-us-inner">
        @if($text->title)
          <h5 class="card-title">{!!$text->title!!}</h5>
        @endif
        <p style="text-align: center;">
          {!!$text->description!!}
        </p>
    </div>
  </div>
@endif