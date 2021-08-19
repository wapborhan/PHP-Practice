<div class="margin-left-right-10 card-collapsed widget" data-card="true" id="widget-{{$widget->id}}" data-widget-id="{{$widget->id}}" style="width: 44.5%;">
        <div class="widget-header card-header">
            <div class="widget-subheader"> 
                <img src="{{ static_asset('assets/img/combined-shape.svg') }}" alt="Latest News">
                <h3>{{$widget->title}}</h3>  
            </div>
            <div class="card-toolbar">
                <a href="#" class="mr-2 btn btn-xs btn-icon btn-danger confirm-delete" data-href="{{ route('website.widget.container.destroy', '')}}" title="{{ translate('Delete') }}" style="display: none">
                    <i class="las la-trash"></i>
                </a>
                <a href="#" onclick="rotate_icon_container(this)" class="toggle" data-card-tool="toggle" style="display: none">
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
                    <label>{{ translate('Title') }}</label>
                    <input type="text" class="form-control" placeholder="Title" name="title" value="{{isset($business->title) ? $business->title : ''}}" onchange="submit_update(this)"/>
                </div>
                <div class="form-group ">
                    <label for="description">{{ translate('Description') }}</label>
                    <input type="text" name="description" placeholder="{{translate('Description')}}" value="" class="form-control " value="{{$business->description}}" onchange="submit_update(this)">
                </div>
                <div class="form-group">
                    <label>{{ translate('Label 1') }}</label>
                    <input type="text" class="form-control" placeholder="Label 1" name="label_1" value="{{isset($widget->label_1) ? $widget->label_1 : ''}}" onchange="submit_update(this)"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Value 1') }}</label>
                    <input type="text" class="form-control" placeholder="company phone" name="value_1" value="{{isset($widget->value_1) ? $widget->value_1 : ''}}" onchange="submit_update(this)"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Label 2') }}</label>
                    <input type="text" class="form-control" placeholder="Label 2" name="label_2" value="{{isset($widget->label_2) ? $widget->label_2 : ''}}" onchange="submit_update(this)"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Value 2') }}</label>
                    <input type="text" class="form-control" placeholder="Value 2" name="value_2" value="{{isset($widget->value_2) ? $widget->value_2 : ''}}" onchange="submit_update(this)"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Label 3') }}</label>
                    <input type="text" class="form-control" placeholder="Label 3" name="label_3" value="{{isset($widget->label_3) ? $widget->label_3 : ''}}" onchange="submit_update(this)"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Value 3') }}</label>
                    <input type="text" class="form-control" placeholder="Value 3" name="value_3" value="{{isset($widget->value_3) ? $widget->value_3 : ''}}" onchange="submit_update(this)"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Label 4') }}</label>
                    <input type="text" class="form-control" placeholder="Label 4" name="label_4" value="{{isset($widget->label_4) ? $widget->label_4 : ''}}" onchange="submit_update(this)"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Value 4') }}</label>
                    <input type="text" class="form-control" placeholder="Value 4" name="value_4" value="{{isset($widget->value_4) ? $widget->value_4 : ''}}" onchange="submit_update(this)"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Label 5') }}</label>
                    <input type="text" class="form-control" placeholder="Label 5" name="label_5" value="{{isset($widget->label_5) ? $widget->label_5 : ''}}" onchange="submit_update(this)"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Value 5') }}</label>
                    <input type="text" class="form-control" placeholder="Value 5" name="value_5" value="{{isset($widget->value_5) ? $widget->value_5 : ''}}" onchange="submit_update(this)"/>
                </div>
            </div>
            {{-- <div class="text-center card-footer">
                <button type="submit" class="btn btn-success">{{ translate('Submit') }}</button>
            </div> --}}
        </form>
</div>

