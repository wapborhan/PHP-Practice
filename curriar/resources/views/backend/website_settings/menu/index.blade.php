@extends('backend.layouts.app')

@section('subheader')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Menus') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Menus') }}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Menu::render() !!}
        </div>
    </div>

@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {!! Menu::scripts() !!}
    <script>
        var pages = @json($pages);
        var current_url = "{{ route('home') }}";
        function select_page(select){
            var input_url = document.getElementById('custom-menu-item-url-pages');
            var input_label = document.getElementById('custom-menu-item-name-pages');
            var page = pages.find(o => o.title === select.value);
            if(page){
                input_url.value = current_url + '/' + page.slug;
                input_label.value = page.title;
            }else{
                input_url.value = '';
                input_label.value = '';
            }
        }

        @isset($categories)
            var categories = @json($categories);
            var current_url = "{{ route('home') }}";
            function select_category(select){
                var input_url = document.getElementById('custom-menu-item-url-categories');
                var input_label = document.getElementById('custom-menu-item-name-categories');
                var category = categories.find(o => o.title === select.value);
                if(category){
                    input_url.value = current_url + '/' + category.slug;
                    input_label.value = category.title;
                }else{
                    input_url.value = '';
                    input_label.value = '';
                }
            }
        @endisset
    </script>
@endsection
