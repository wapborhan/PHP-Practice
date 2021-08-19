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
                <div class="form-group ">
                    <label for="description">{{ translate('About description') }}</label>
                <textarea name="description" placeholder="description" class="form-control " onchange="submit_update(this)">{{($about->description  ? $about->description : '')}}</textarea>
                </div>
                <div class="form-group ">
                    <label for="logo">{{ translate('Logo') }}</label>
                    <div class="col" style="margin-bottom: 60px;">
                        <input type="file" name="logo" placeholder="{{ translate('Choose logo') }}..." class="custom-file-input" onchange="submit_update(this)">
                        <label class="custom-file-label" for="logo">{{ translate('Choose logo') }}...</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ translate('Email') }}</label>
                    <input type="text" class="form-control" placeholder="{{translate('company email')}}" name="email" value="{{$widget->email}}" onchange="submit_update(this)"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Phone') }}</label>
                    <input type="text" class="form-control" placeholder="{{translate('company phone')}}" name="phone" value="{{$widget->phone}}" onchange="submit_update(this)"/>
                </div>
            </div>
            {{-- <div class="text-center card-footer">
                <button type="submit" class="btn btn-success">{{ translate('Submit') }}</button>
            </div> --}}
        </form>
</div>

