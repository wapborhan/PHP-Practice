<div class="card-collapsed widget" data-card="true" id="widget-{{$container_widget->id}}" data-widget-id="{{$container_widget->widget_id}}" data-container-widget-id="{{$container_widget->id}}">
    <div class="widget-sidebar-container card-header">
        <div class="">
            <P>[{{$container_widget->id}}] {{$container_widget->title}}</P>
            <h3>{{$container_widget->description ?? $container_widget->description}}</h3>
        </div>
        <div class="card-toolbar">
            <a href="#" class="btn btn-xs btn-icon btn-danger mr-2 confirm-delete" style="display:none;" data-href="{{ route('website.widget.container.destroy', $container_widget->id)}}" title="{{ translate('Delete') }}" style="">
                <i class="las la-trash"></i>
            </a>
            <a href="#" class="toggle" onclick="rotate_icon_container(this , {{$container_widget->id}} )" data-card-tool="toggle" style="">
                <i class="fas fa-sort-down"></i>
            </a>
        </div>
    </div>
    <form class="form" style="display:none;" action="{{ route('website.widget.container.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$container_widget->id}}">
        <div class="card-body p-2">
            <div class="form-group">
                <label>{{ translate('Select Language') }}</label>
                <select class="form-control" name="lang" onchange="submit_update(this)">
                    <option data-tokens="all" value="all" @if($container_widget->lang == 'all') selected @endif>{{ translate('All Languages') }}</option>
                    @foreach ($langs as $lang)
                        <option data-tokens="{{$lang->name}}" value="{{$lang->code}}" @if($container_widget->lang == $lang->code) selected @endif>{{$lang->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="logo" class="">{{ translate('Logo') }}</label>
                <div class="col" style="margin-bottom: 60px;">
                    <input type="file" name="logo" placeholder="{{translate('Choose logo')}}..." class="custom-file-input" onchange="submit_update(this)">
                    <label class="custom-file-label" for="logo">{{translate('Choose logo')}}...</label>
                </div>
                @if($image->logo)
                    <label class="checkbox checkbox-danger" style="float:right; font-size: 0.8rem">
                        <input type="checkbox" name="remove_logo" onchange="submit_update(this)">
                        <span class="mr-2"></span>
                        {{ translate('Remove') }}
                    </label>
                    <a href="{{static_asset($image->logo)}}" target="_blank" class="image-link">
                        <img src="{{static_asset($image->logo)}}" alt="{{ $container_widget->title }}" class="image-preview" style="max-height: 50px;"/>
                    </a>
                @endif
            </div>
        </div>
        {{-- <div class="card-footer text-center">
            <button type="submit" class="btn btn-success">{{ translate('Submit') }}</button>
        </div> --}}
    </form>
</div>
    