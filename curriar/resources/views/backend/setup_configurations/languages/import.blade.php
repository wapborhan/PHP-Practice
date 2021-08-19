@extends('backend.layouts.app')

@section('sub_title'){{translate('Import CSV')}}@endsection


@section('subheader')
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">{{ translate('Import CSV') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('languages.index')}}" class="text-muted">{{translate('Languages')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Import CSV') }}</a>
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

    <div class="col-lg-6 mx-auto">
        <div class="alert alert-danger" role="alert">
            {{translate('Please: Be sure that you got a backup from the translation table before you proceed in this action, and the file you are trying to import is already downloaded from the previous page')}}.
        </div>

        <div class="mt-2 mb-3 text-left aiz-titlebar">
            <div class="align-items-center">
                <div class="text-md-right">
                    <a href="{{ route('languages.export') }}" class="btn btn-circle btn-info">
                        <span>{{translate('Download Translations CSV File')}}</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Language CSV Import')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" id="kt_form_1" action="{{ route('languages.import_parse') }}" method="POST" enctype="multipart/form-data">
                	@csrf

                    <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                        <label for="csv_file" class="col-md-4 control-label">{{translate('CSV file to import')}}</label>

                        <div class="col-md-6">
                            <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                            @if ($errors->has('csv_file'))
                                <span class="help-block">
                                <strong>{{ $errors->first('csv_file') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Parse CSV')}}</button>
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
                        "csv_file": {
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