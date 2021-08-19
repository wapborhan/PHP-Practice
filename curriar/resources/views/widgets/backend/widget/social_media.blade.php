<div class="margin-left-right-10 card-collapsed widget" data-card="true" id="widget-{{$widget->id}}" data-widget-id="{{$widget->id}}" style="width: 44.5%;">
    <div class="widget-header card-header">
        <div class="widget-subheader"> 
            <img class="widget-icon" src="{{ static_asset('assets/img/combined-shape.svg') }}" alt="Latest News">
            <h3 class="widget-title">{{$widget->title}}</h3>  
        </div>
        <div class="card-toolbar">
            <a href="#" class="mr-2 btn btn-xs btn-icon btn-danger confirm-delete" data-href="{{ route('website.widget.container.destroy', '')}}" title="{{ translate('Delete') }}" style="display: none">
                <i class="las la-trash"></i>
            </a>
            <a href="#" class="toggle" onclick="rotate_icon_container(this)" data-card-tool="toggle" style="display: none">
                <i class="fas fa-sort-down"></i>
            </a>
        </div>
    </div>
    <form class="form" style="display:none;" action="{{ route('website.widget.container.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="" class="id">
        <div class="p-2 card-body">
            <div class="form-group">
                <label>{{ translate('Select Language') }}</label>
                <select class="form-control" name="lang" onchange="submit_update(this)">
                    <option data-tokens="all" value="all" selected>{{ translate('All Languages') }}</option>
                    @foreach ($langs as $lang)
                        <option data-tokens="{{$lang->name}}" value="{{$lang->code}}">{{$lang->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>{{ translate('Front title') }}</label>
                <input type="text" class="form-control" placeholder="{{translate('front title')}}" name="front_title" value="{{$social->front_title}}" onchange="submit_update(this)"/>
            </div>
        </div>
        {{-- <div class="text-center card-footer">
            <button type="submit" class="btn btn-success">{{ translate('Submit') }}</button>
        </div> --}}
    </form>
</div>