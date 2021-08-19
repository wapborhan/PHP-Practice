<div class="card-collapsed widget" data-card="true" id="widget-{{$container_widget->id}}" data-widget-id="{{$container_widget->widget_id}}" data-container-widget-id="{{$container_widget->id}}">
    <div class="widget-sidebar-container card-header">
        <div>
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
        <div class="card-body">
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
                <input type="text" class="form-control" placeholder="Title" name="title" value="{{isset($business->title) ? $business->title : ''}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group ">
                <label for="description">{{translate('description')}}</label>
                <input type="text" name="description" placeholder="description" value="{{($business->description  ?? '')}}" class="form-control " onchange="submit_update(this)">
            </div>
            <div class="form-group">
                <label>{{ translate('Label 1') }}</label>
                <input type="text" class="form-control" placeholder="Label 1" name="label_1" value="{{isset($business->label_1) ? $business->label_1 : ''}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Value 1') }}</label>
                <input type="text" class="form-control" placeholder="company phone" name="value_1" value="{{isset($business->value_1) ? $business->value_1 : ''}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Label 2') }}</label>
                <input type="text" class="form-control" placeholder="Label 2" name="label_2" value="{{isset($business->label_2) ? $business->label_2 : ''}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Value 2') }}</label>
                <input type="text" class="form-control" placeholder="Value 2" name="value_2" value="{{isset($business->value_2) ? $business->value_2 : ''}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Label 3') }}</label>
                <input type="text" class="form-control" placeholder="Label 3" name="label_3" value="{{isset($business->label_3) ? $business->label_3 : ''}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Value 3') }}</label>
                <input type="text" class="form-control" placeholder="Value 3" name="value_3" value="{{isset($business->value_3) ? $business->value_3 : ''}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Label 4') }}</label>
                <input type="text" class="form-control" placeholder="Label 4" name="label_4" value="{{isset($business->label_4) ? $business->label_4 : ''}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Value 4') }}</label>
                <input type="text" class="form-control" placeholder="Value 4" name="value_4" value="{{isset($business->value_4) ? $business->value_4 : ''}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Label 5') }}</label>
                <input type="text" class="form-control" placeholder="Label 5" name="label_5" value="{{isset($business->label_5) ? $business->label_5 : ''}}" onchange="submit_update(this)"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Value 5') }}</label>
                <input type="text" class="form-control" placeholder="Value 5" name="value_5" value="{{isset($business->value_5) ? $business->value_5 : ''}}" onchange="submit_update(this)"/>
            </div>
        </div>
        {{-- <div class="card-footer text-center">
            <button type="button" class="btn btn-success">{{ translate('Submit') }}</button>
        </div> --}}
    </form>
</div>
    