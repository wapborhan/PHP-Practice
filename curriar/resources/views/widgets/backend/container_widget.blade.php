
<div class="card card-custom card-fit card-border card-collapsed widget mb-2" data-card="true" id="widget-{{$config['container_widget']->id}}" data-widget-id="{{$config['container_widget']->widget_id}}" data-container-widget-id="{{$config['container_widget']->id}}">
    <div class="card-header p-2">
        <div class="card-title">
            <h3 class="card-label">{{$config['container_widget']->title}}</h3>
        </div>
        <div class="card-toolbar">
            <a href="#" class="btn btn-xs btn-icon btn-danger mr-2 confirm-delete" data-href="{{ route('website.widget.container.destroy', $config['container_widget']->id)}}" title="{{ translate('Delete') }}" style="">
                <i class="las la-trash"></i>
            </a>
            <a href="#" class="btn btn-xs btn-icon btn-success toggle" data-card-tool="toggle" style="">
                <i class="flaticon2-gear"></i>
            </a>
        </div>
    </div>
    <form class="form" action="{{ route('website.widget.container.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$config['container_widget']->id}}">
        <div class="card-body p-2">
            @if(in_array( $config['container_widget']->type , ['about','contact_info','html','text']))
                {!! json_decode($config['container_widget']->object)->form !!}
            @else
                <div class="form-group">
                    <label>{{ translate('Title') }}</label>
                    <input type="text" class="form-control" placeholder="{{translate('title')}}" name="title" value="{{$config['container_widget']->title}}"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Link') }}</label>
                    <input type="text" class="form-control" placeholder="{{translate('link')}}" name="link" value="{{$config['container_widget']->link}}"/>
                </div>
                <div class="form-group">
                    <label>{{ translate('Class') }}</label>
                    <input type="text" class="form-control" placeholder="{{translate('class')}}" name="class" value="{{$config['container_widget']->class}}"/>
                </div>
            @endif
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-success">{{ translate('Submit') }}</button>
            {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
        </div>
    </form>
</div>
    