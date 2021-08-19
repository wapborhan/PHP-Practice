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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Install/Update Addon')}}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('addons.index')}}" class="text-muted">{{ translate('Installed Addon')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Install/Update Addon')}}</a>
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

<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{ translate('Install/Update Addon')}}</h3>
            </div>
            <!--begin::Form-->
            <form class="form" action="{{ route('addons.store') }}" id="addons_srore" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="addon_zip">{{ translate('Zip File')}}</label>
                        <div class="custom-file">
                            <label class="custom-file-label">
                                <input type="file" id="addon_zip" name="addon_zip"  class="custom-file-input">
                                <span class="custom-file-name">{{ translate('Choose file') }}</span>
                            </label>
                        </div>
                        <span class="form-text text-muted">{{translate('Please upload the zip folder which includes the addon files you will need to install or update.')}}</span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">{{translate('Install/Update')}}</button>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection
