@if($image->logo)
    <div class="card mb-5 p-4" style="border: 6px solid rgba(0, 0, 0, 0.05);background-color: inherit;">
        <img src="{{static_asset($image->logo)}}" class="card-img-top" style="border-radius: 5px;" alt="...">
    </div>
@endif