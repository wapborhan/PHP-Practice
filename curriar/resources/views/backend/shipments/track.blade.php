@extends('backend.layouts.blank')


@section('sub_title'){{translate('Track your shipment')}}@endsection


@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="alert alert-custom alert-white  gutter-b mb-0 pb-0" role="alert">
                <div class="alert-text">
                    <!--begin::Logo-->
                    <p class="d-block py-20 text-center">
                        <a href="{{ route('home') }}">
                            @if(get_setting('system_logo_white') != null)
                                <img src="{{ uploaded_asset(get_setting('system_logo_white')) }}" alt="{{ get_setting('site_name') }}" style="max-width:150px">
                            @else
                                <img src="{{ static_asset('assets/img/logo.svg') }}" alt="{{ get_setting('site_name') }}" style="max-width:150px">
                            @endif
                        </a>
                    </p>
                    <p class="mt-50 text-center"><a href="{{ route('home') }}">{{translate('BACK TO HOME')}}</a></p>
                    <p class="mt-50 text-center"><span class="label label-inline label-pill label-danger label-rounded mr-2">NOTE:</span>{{translate('For inquiries about your shipments, please contact us from')}} <a href="#">{{translate('here')}}</a>.</p>
                </div>
            </div>
            <div class="card-header">
                <div class="card-title">
                    <h5 class="card-label  text-center">{{translate('Track your shipment')}}</h5>
                </div>
            </div>
            <!--begin::Form-->
            <form class="form" action="{{route('admin.shipments.tracking')}}" method="GET">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3"></div>
                        <div class="col-xl-6">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>{{translate('Enter your tracking code')}}</label>
                                <input type="text" class="form-control form-control-solid form-control-lg" name="code" placeholder="{{translate('Example: SH00001')}}">
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="col-xl-3"></div>
                    </div>
                </div>
                <!--begin::Actions-->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-xl-3"></div>
                        <div class="col-xl-6">
                            <button type="submit" class="btn btn-primary font-weight-bold mr-2">{{translate('Search')}}</button>
                        </div>
                        <div class="col-xl-3"></div>
                    </div>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>

@endsection