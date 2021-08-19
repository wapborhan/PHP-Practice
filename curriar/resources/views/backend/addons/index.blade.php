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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Installed Addon')}}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Installed Addon')}}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="{{ route('addons.create')}}" class="btn btn-light-primary font-weight-bolder">
                    {{ translate('Install/Update Addon')}}
                    <span class="svg-icon">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Files/File-plus.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                </a>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection

@section('content')
    <div class="row">
        @forelse(\App\Addon::all() as $key => $addon)
            <div class="col-xl-12">
                <!--begin::Engage Widget 7-->
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-body d-flex p-0">
                        <div class="flex-grow-1 p-12 card-rounded bgi-no-repeat d-flex flex-column justify-content-center align-items-start" style="background-color: #FFF4DE; background-position: right bottom; background-size: auto 100%; background-image: url({{ static_asset($addon->image) }})">
                            <h4 class="text-danger font-weight-bolder m-0">{{ ucfirst($addon->name) }}</h4>
                            <p class="text-dark-50 my-5 font-size-xl font-weight-bold"><small>{{ translate('Version')}}: </small>{{ $addon->version }}</p>
                            <input class="py-2 px-6" onchange="updateStatus(this, {{ $addon->id }})" @if($addon->activated) checked @endif data-switch="true" type="checkbox" data-on-color="success" data-off-color="danger" />
                            
                            <a style="margin-top:6px"  href="{{route('addons.delete.view',['id'=>$addon->id])}}" class="kt_sweetalert_demo_9 btn btn-danger font-weight-bold py-2 px-6"> Remove </a>
                        </div>
                    </div>
                </div>
                <!--end::Engage Widget 7-->
            </div>
        @empty
            <div class="col-xl-12">
                <!--begin::Engage Widget 7-->
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-body d-flex p-0">
                        <div class="flex-grow-1 p-12 card-rounded bgi-no-repeat d-flex flex-column justify-content-center align-items-start" style="background-color: #FFF4DE; background-position: right bottom; background-size: auto 100%; background-image: url({{ static_asset('assets/img/nothing.svg') }})">
                            <h4 class="text-danger font-weight-bolder m-0">{{ translate('No Addon Installed')}}</h4>
                        </div>
                    </div>
                </div>
                <!--end::Engage Widget 7-->
            </div>
        @endforelse
    </div>
   
    @if(getConfigValue('is_dev') == 'true')
    <a style="margin-top:6px"  href="{{route('addons.reset')}}" class="kt_sweetalert_demo_9 btn btn-danger font-weight-bold py-2 px-6"><i class="la la-refresh"></i> {{translate('Reset')}}</a>
    <a style="margin-top:6px"  href="{{route('addons.generate')}}" class="btn btn-success font-weight-bold py-2 px-6"><i class="fa fa-plus"></i>{{translate('Generate New Addon')}}</a>
    <a style="margin-top:6px"  href="{{route('addons.generate.installable')}}" class="btn btn-success font-weight-bold py-2 px-6"><i class="fa fa-plus" aria-hidden="true"></i>{{translate('Generate Installable File')}}</a>
    @endif
   
    
  
    
@endsection

@section('script')
    <script type="text/javascript">
        $('[data-switch=true]').bootstrapSwitch();
        function updateStatus(el, id){
            if($(el).is(':checked')){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('addons.activation') }}', {_token:'{{ csrf_token() }}', id:id, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Status updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
                location.reload();
            });
        }
        
        function goAlert(element)
        {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then(function(result,) {
                if (result.value) {
                    window.location = element.attr('href');
                    // result.dismiss can be "cancel", "overlay",
                    // "close", and "timer"
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelled",
                        "Your imaginary file is safe :)",
                        "error"
                    )
                }
            });
        }
        $(".kt_sweetalert_demo_9").click(function(e) {
            e.preventDefault();
            goAlert($(this)); 
        });
        
    </script>
@endsection
