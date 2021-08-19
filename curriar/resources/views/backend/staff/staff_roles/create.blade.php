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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Add Role') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('roles.index')}}" class="text-muted">{{ translate('Roles')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Add Role') }}</a>
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
        <div class="col-md-12 mx-auto">

            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ translate('Add Role') }}</h3>
                    </div>
                </div>

                <form class="form" action="{{ route('roles.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
         
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{translate('Name')}} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control">
                            </div>
                        </div>

                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header card-header-tabs-line">
                                <div class="card-title">
                                    <h3 class="card-label">{{ translate('Permissions') }}</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-12 checkbox-list">
                                        @foreach(\File::files(base_path('resources/views/backend/permissions/')) as $path)
                                            @include('backend.permissions.'.str_replace('.blade','',pathinfo($path)['filename']))
                                        @endforeach

                                        <label class="checkbox">
                                            <input type="checkbox" name="permissions[]" value="10" />
                                            <span></span>{{ translate('Reports') }}
                                        </label>
                                        
                                        <label class="checkbox">
                                            <input type="checkbox" name="permissions[]" value="12" />
                                            <span></span>{{ translate('Support') }}
                                        </label>
                                        
                                        <label class="checkbox">
                                            <input type="checkbox" name="permissions[]" value="13" />
                                            <span></span>{{ translate('Website Setup') }}
                                        </label>
                                        
                                        <label class="checkbox">
                                            <input type="checkbox" name="permissions[]" value="14" />
                                            <span></span>{{ translate('Setup & Configurations') }}
                                        </label>
                                        
                                        <label class="checkbox">
                                            <input type="checkbox" name="permissions[]" value="20" />
                                            <span></span>{{ translate('Staffs') }}
                                        </label>
                                        
                                        <label class="checkbox">
                                            <input type="checkbox" name="permissions[]" value="21" />
                                            <span></span>{{ translate('Addon Manager') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {
                    "name": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "permissions[]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    }
                },
                

                plugins: {
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    icon: new FormValidation.plugins.Icon({
                        valid: 'fa fa-check',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh',
                    }),
                }
            }
        );
    });
</script>
@endsection