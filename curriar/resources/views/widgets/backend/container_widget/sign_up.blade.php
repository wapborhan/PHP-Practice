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
                <label>{{ translate('Title') }}</label>
                <input type="text" class="form-control" placeholder="{{translate('title')}}" name="title" value="{{$sign_up->title}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Subtitle') }}</label>
                <input type="text" class="form-control" placeholder="{{translate('subtitle')}}" name="subtitle" value="{{$sign_up->subtitle}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Description') }}</label>
                <input type="text" class="form-control" placeholder="{{translate('description')}}" name="description" value="{{$sign_up->description}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Hits') }}</label>
                <input type="text" class="form-control" placeholder="{{translate('hits')}}" name="hits" value="{{$sign_up->hits}}" onchange="submit_update(this)"/>
            </div>
        </div>
        {{-- <div class="card-footer text-center">
            <button type="submit" class="btn btn-success">{{ translate('Submit') }}</button>
        </div> --}}
    </form>
</div>
    