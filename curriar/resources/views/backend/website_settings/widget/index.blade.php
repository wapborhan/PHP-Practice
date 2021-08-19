@extends('backend.layouts.app')

@section('style')
    <link href="{{asset('public/assets/dragula/dragula.css')}}" rel="stylesheet">
    <style>
        .widgets
        {
            margin: 40px 136px 30.5px 40px;
            font-stretch: normal;
            font-style: normal;
            line-height: normal;
            letter-spacing: normal;
            font-weight: normal;
        }
        .widgets-header-title
        {
            font-size: 23px;
            font-weight: 300;
            color: #222222;
            margin-bottom: 31.5px;
        }
        .available-widgets
        {
            display:flex;
        }
        .available-widgets .available-widgets-icon
        {
            width: 21px;
            height: 21px;
            object-fit: contain;
        }
        .available-widgets .available-widgets-title
        {
            height: 19px;
            margin: 0px 0px 8.5px 10px;
            font-size: 16px;
            font-weight: bold;
            color: #222222;
        }
        .available-widgets-content
        {
            margin: 7.5px 0px 31px 0px;
            font-size: 13px;
            color: #6c757d;
        }
        .widget-header
        {
            padding: 13px 10px 14px 11px;
            border-radius: 4px;
            border: solid 1px rgba(34, 34, 34, 0.2);
            background-color: #ffffff;
            margin-bottom:20px;
        }
        .widget-subheader
        {
            display:flex;
        }
        .widget-subheader img
        {
            width: 16px;
            height: 16px;
            object-fit: contain;
            opacity: 30%
        }
        .widget-subheader h3
        {
            margin: 0 0 0 10px;
            object-fit: contain;
            font-size: 14px;
            color: #222222;
            font-weight: bold;
        }
        .widget-sidebar .widget-sidebar-dev
        {
            display:flex;
            justify-content: space-between;
            padding: 18px 20px 21px 19px;
            border: solid 1px #c3c4c7;
            background-color: rgba(108, 117, 125, 0.05);
            margin: 10px 0 0px 0px;
            border-radius: 4px;
        }
        .widget-sidebar-dev-title{
            height:auto;
        }
        .widget-sidebar-dev-title P
        {
            margin: 0px 0px 10px 1px;
            font-size: 14px;
            font-weight: bold;
            color: #222222;
            margin-bottom: 0px !important;
        }
        .widget-sidebar-dev-title h3
        {
            margin: 10px 0px 0px 1px;
            font-size: 12px;
            line-height: 1.33;
            letter-spacing: normal;
            color: #6c757d;
        }
        .widget-sidebar-dev-content a
        {
            float:right;
            width: 9px;
            height: 5px;
            object-fit: contain;
        }
        .container-form
        {
            padding: 0px 21px;
            background-color: rgba(108, 117, 125, 0.05);
            border: solid 1px #c3c4c7;
            border-top:none;
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .margin-bottom-27
        {
            margin-bottom:27px;
        }
        .margin-left-20
        {
            margin-left:20px;
        }
        .margin-right-10
        {
            margin-right:10px !important;
        }
        .margin-left-right-10
        {
            margin-left: 10px;
            margin-right: 10px;
        }
        .col-lg-6
        {
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
        .col-lg-12
        {
            padding-right: 10px!important;
            padding-left: 0px!important;
        }
        .widget
        {
            margin-bottom:10px;
        }
        .widget-sidebar-container
        {
            width:100%;
            display:flex;
            justify-content: space-between;
            padding: 13px 15px 5px;
            border: solid 1px #c3c4c7;
            background-color: rgba(108, 117, 125, 0.05);
            margin: 0px 0px 0px 0px;
            border-radius: 4px;
        }
        .widget-sidebar-container p
        {
            font-size: 12px;
            font-weight: 500;
            color: #646970;
            margin: 0px 0px 5px 0px !important;
        }
        .widget-sidebar-container h3
        {
            font-size: 14px;
            font-weight: bold;
            color: #1d2327;
        }
        .widget-sidebar-container a
        {
            float:right;
            width: 9px;
            height: 5px;
            object-fit: contain;
        }
        .card-body
        {
            padding:15px 16px !important;
            background-color:#fff !important;
            border: solid 1px #c3c4c7 !important;
            border-top:none !important;
            border-bottom-left-radius: 4px !important;
            border-bottom-right-radius: 4px !important;
        }
        @media (min-width: 992px) and (max-width: 1305px){
            .widget {
                width:100% !important;
            }
            .widget-sidebar .widget-sidebar-dev {
                width: 130%;
            }
        }
        @media (min-width: 751px) and (max-width: 991px){
            .widget {
                width:46% !important;
            }
        }
        @media (min-width: 701px) and (max-width: 750px){
            .widget {
                width:100% !important;
            }
        }
        @media (min-width: 599px) and (max-width: 700px) {
            .widget {
                width:45% !important;
            }
        }
        @media (min-width: 300px) and (max-width: 600px) {
            .widget {
                width:100% !important;
            }
        }
    </style>
@endsection


@section('subheader')
    <div class="widgets">
        <h5 class="widgets-header-title">{{ translate('Widgets') }}</h5>
        <div class="row">
            <div class="col-lg-5">
                <div class="available-widgets">
                    <img class="available-widgets-icon" src="{{ static_asset('assets/img/widgets-icon.svg') }}" alt="Latest News">
                    <h3 class="available-widgets-title">Available Widgets</h3>
                </div>
                <p class="available-widgets-content" >
                    To activate a widget drag it to a sidebar or click on it. To deactivate a widget and delete its settings, darg it back.
                </p>
                <div class="row" id="source">
                    @forelse ($widgets as $widget)
                        @widget('backendWidget',['container_widget'=>$widget,'type'=>'widget'])
                    @empty

                    @endforelse
                </div>
            </div>
            <div class="col-lg-7">
                <div class="available-widgets margin-left-20 margin-bottom-27">
                    <img class="available-widgets-icon" src="{{ static_asset('assets/img/sidebar.svg') }}" alt="Latest News">
                    <h3 class="available-widgets-title">Sidebar</h3>
                </div>
                <div class="row widget-sidebar margin-left-20">
                    <div class="col-lg-6">
                        @forelse ($containers as $container)
                            @if($loop->index % 2 == 0)
                                <div class="widget-sidebar-dev margin-right-10 widget-sidebar-dev-header" id="header-{{$container->id}}" style="min-height: 85px;">
                                    <div class="widget-sidebar-dev-title">
                                        <P>[{{$container->id}}] {{$container->title}}</P>
                                        <h3>{{$container->description ?? $container->description}}</h3>
                                    </div>
                                    <div class="widget-sidebar-dev-content">
                                        <a href="#" data-toggle="collapse" data-target="#collapse-{{$container->id}}"
                                            aria-expanded="true" aria-controls="collapse-{{$container->id}}" onclick="rotate_icon(this , {{$container->id}})">
                                            <i class="fas fa-sort-down"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="rounded-bottom dragula-container ng-isolate-scope col-lg-12 collapse" id="collapse-{{$container->id}}" aria-labelledby="header-{{$container->id}}">
                                    <div class="dragula-container ng-isolate-scope ">
                                        <div class="container-form" id="container-{{$container->id}}" data-container-id="{{$container->id}}" style="min-height: 300px;">
                                            @forelse ($container->container_widget as $container_widget)
                                                @widget('backendWidget',['container_widget'=>$container_widget,'type'=>'container_widget'])
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                        @empty

                        @endforelse
                    </div>
                    <div class="col-lg-6">
                        @forelse ($containers as $container)
                            @if($loop->index % 2 != 0)
                                <div class="widget-sidebar-dev margin-right-10 widget-sidebar-dev-header" id="header-{{$container->id}}" style="min-height: 85px;">
                                    <div class="widget-sidebar-dev-title">
                                        <P>[{{$container->id}}] {{$container->title}}</P>
                                        <h3>{{$container->description ?? $container->description}}</h3>
                                    </div>
                                    <div class="widget-sidebar-dev-content">
                                        <a href="#" data-toggle="collapse" data-target="#collapse-{{$container->id}}"
                                            aria-expanded="true" aria-controls="collapse-{{$container->id}}" onclick="rotate_icon(this , {{$container->id}})">
                                            <i class="fas fa-sort-down"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="rounded-bottom dragula-container ng-isolate-scope col-lg-12 collapse" id="collapse-{{$container->id}}" aria-labelledby="header-{{$container->id}}">
                                    <div class="dragula-container ng-isolate-scope ">
                                        <div class="container-form" id="container-{{$container->id}}" data-container-id="{{$container->id}}" style="min-height: 300px;">
                                            @forelse ($container->container_widget as $container_widget)
                                                @widget('backendWidget',['container_widget'=>$container_widget,'type'=>'container_widget'])
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('modals.add_widget_modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script src="{{asset('public/assets/dragula/dragula.js')}}" type="text/javascript"></script>
    <script>
        function rotate_icon(href , id) {
            var icon = href.getElementsByClassName('fas')[0];
            icon.classList.toggle("fa-rotate-180");
            if(document.getElementById('header-'+ id).style.borderBottom == 'none' )
            {
                document.getElementById('header-'+ id).style.borderBottomLeftRadius="4px";
                document.getElementById('header-'+ id).style.borderBottomRightRadius="4px";
                document.getElementById('header-'+ id).style.borderBottom="solid 1px #c3c4c7";
            }
            else
            {
                document.getElementById('header-'+ id).style.borderBottom="none";
                document.getElementById('header-'+ id).style.borderBottomLeftRadius="0px";
                document.getElementById('header-'+ id).style.borderBottomRightRadius="0px";
            }
        }
        function rotate_icon_container(href , id) {
            var icon = href.getElementsByClassName('fas')[0];
            icon.classList.toggle("fa-rotate-180");
        }
        'use strict';
        var containers = [
            document.getElementById('source'),
            @forelse ($containers as $container)
                document.getElementById('container-{{$container->id}}'),
            @empty
            @endforelse
        ];
        dragula(containers, {
            copy: function (el, source) {
                return source.id === 'source';
            },
            accepts: function (el, target, source) {
                return target.id !== 'source';
            }
        }).on('drop', function (el, container, source) {

            @if (env('DEMO_MODE') == 'On')
                alert("{{translate('This action is disabled in demo mode')}}");
                el.remove();
                return ;
            @endif
            if(container){
                el.classList.remove("margin-left-right-10");
                el.style.width = "100%";
                var cardHeader = el.getElementsByClassName('card-header')[0];
                cardHeader.classList.remove("widget-header");
                cardHeader.classList.add("widget-sidebar-container");
                var container_devs = container.getElementsByClassName('widget');
                var container_widgets_order = [];
                for (let index = 0; index < container_devs.length; index++) {
                    if(container_devs[index].dataset.containerWidgetId){
                        container_widgets_order.push(container_devs[index].dataset.containerWidgetId);
                    }else{
                        container_widgets_order.push('0');
                    }
                }
                $.ajax({
                url:'{{ route("website.widget.clone") }}',
                type:'POST',
                data:  { _token: AIZ.data.csrf, container_widgets:container_widgets_order, container_id:container.dataset.containerId, widget_id:el.dataset.widgetId, source:source.dataset.containerId},
                dataTy:'json',
                success:function(response){
                    if(source.id == 'source'){
                        console.log(response);
                        var subHeader = el.getElementsByClassName('widget-subheader')[0];
                        subHeader.innerHTML = `
                            <P>[`+ response.id+`] `+ response.title+`</P>
                            <h3>`+(response.description ? response.description : '')+`</h3>
                        `;
                        subHeader.classList.remove("widget-subheader");
                        el.dataset.containerWidgetId = response.id;
                        var btn_delete = el.getElementsByClassName('confirm-delete')[0];
                        // btn_delete.style.display = "";
                        btn_delete.dataset.href += "/" + response.id + " ";
                        $(btn_delete).click(function (e) {
                            e.preventDefault();
                            $("#delete-modal").modal("show");
                            $("#delete-link").attr("href", btn_delete.dataset.href);
                        });
                        var btn_toggle = el.getElementsByClassName('toggle')[0];
                        btn_toggle.style.display = "";
                        KTApp.init(KTAppSettings);
                        var id_input = el.getElementsByClassName('id')[0];
                        id_input.value = response.id;
                    }
                },
                error: function(returnval) {
                    // console.log(returnval);
                }
            });
            }
        }).on('cancel', function (el, container, source) {
            if(source.id !== 'source'){
                var btn_delete = el.getElementsByClassName('confirm-delete')[0];
                btn_delete.click();
            }
        });;
        async function submit_update(input) {
            var form = input.form;
            let formData = new FormData(form);
            $.ajax({
                url:form.action,
                type:'POST',
                data:  formData,
                // dataTy:'json',
                processData: false,
                contentType: false,
                success:function(response){
                    // console.log(response);
                    AIZ.plugins.notify('success', 'Widget has been updated successfully');
                    if(input.type == "file"){
                        display_img(input);
                    }else if(input.type == "checkbox"){
                        var form_group = input.parentNode.parentNode;
                        var checkbox = form_group.getElementsByClassName('checkbox-danger')[0];
                        var image_link = form_group.getElementsByClassName('image-link')[0];
                        form_group.removeChild(checkbox);
                        form_group.removeChild(image_link);
                    }
                },
                error: function(returnval) {
                    var errors = JSON.parse(returnval.responseText)['errors'];
                    for (const [key, value] of Object.entries(errors)) {
                        AIZ.plugins.notify('warning', value);
                    }
                }
            });
        }
        function display_img(input) {
            var form_group = input.parentNode.parentNode;
            var checkbox = form_group.getElementsByClassName('checkbox-danger')[0];
            if(checkbox){
                var image_link = form_group.getElementsByClassName('image-link')[0];
                var image_preview = form_group.getElementsByClassName('image-preview')[0];
	            image_link.href = URL.createObjectURL(input.files[0]);
	            image_preview.src = URL.createObjectURL(input.files[0]);
            }else{
                var image_style = get_image_style();
                form_group.innerHTML += image_style;
                var image_link = form_group.getElementsByClassName('image-link')[0];
                var image_preview = form_group.getElementsByClassName('image-preview')[0];
	            image_link.href = URL.createObjectURL(input.files[0]);
	            image_preview.src = URL.createObjectURL(input.files[0]);
            }
            input.value = null;
            var label = form_group.getElementsByClassName('custom-file-label')[0];
            label.innerHTML = "{{translate('Choose logo')}}...";
        }
        function get_image_style() {
            var style = `<label class="checkbox checkbox-danger" style="float:right; font-size: 0.8rem">
                        <input type="checkbox" name="remove_logo" onchange="submit_update(this)">
                        <span class="mr-2"></span>
                        {{ translate('Remove') }}
                    </label>
                    <a href="#" target="_blank" class="image-link">
                        <img src="#" class="image-preview" style="max-height: 50px;"/>
                    </a>`;
            return style;
        }
    </script>
@endsection
