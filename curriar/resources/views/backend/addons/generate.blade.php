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
    <div class="col-lg-12 mx-auto">
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{ translate('Generate Addon')}}</h3>
            </div>
            <!--begin::Form-->
            <form class="form" action="{{ route('addons.generate.store') }}" id="addons_generate_store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="addon_zip">{{ translate('Addon Unique Identfier')}}</label>
                            <div>
                                <input class="form-control" placeholder="{{ translate('Addon Unique Identfier')}}" type="text" name="unique_identifier" />
                            </div>
                            <span class="form-text text-muted">{{translate('Example: example_identfier *without spaces*')}}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="addon_zip">{{ translate('Addon Title')}}</label>
                            <div>
                                <input class="form-control" placeholder="{{ translate('Addon Title')}}" type="text" name="title" />
                            </div>
                            <span class="form-text text-muted">{{translate('Example: Example Addon')}}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="addon_zip">{{ translate('Addon Version')}}</label>
                            <div>
                                <input class="form-control" placeholder="{{ translate('Addon Version')}}" type="number" name="version" />
                            </div>
                            <span class="form-text text-muted">{{translate('Example: 0.1')}}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="addon_zip">{{ translate('Minimum Item Version')}}</label>
                            <div>
                                <input class="form-control" placeholder="{{ translate('Minimum Item Version')}}" type="number" name="minimum_item_version" />
                            </div>
                            <span class="form-text text-muted">{{translate('Example: 3.4')}}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="addon_zip">{{ translate('Required Addons')}}</label>
                            <div>
                                <input class="form-control" placeholder="{{ translate('Required Addons')}}" type="text" name="required_addons" />
                            </div>
                            <span class="form-text text-muted">{{translate('Example: client_addon')}}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="addon_zip">{{ translate('Controller Resource Name')}}</label>
                            <div>
                                <input class="form-control" placeholder="{{ translate('Controller Resource Name')}}" type="text" name="controller_file_name" />
                            </div>
                            <span class="form-text text-muted">{{translate('Example: ExampleController *without spaces*')}}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="addon_zip">{{ translate('Backend Views Folder Name')}}</label>
                            <div>
                                <input class="form-control" placeholder="{{ translate('Backend Views Folder Name')}}" type="text" name="view_folder_name" />
                            </div>
                            <span class="form-text text-muted">{{translate('Example: excels')}}</span>
                        </div>

                        <div class="form-group col-md-12" id="kt_repeater_1">
                            <label for="addon_zip">{{ translate('View Files')}}</label>
                            <div class="row">
                                <div data-repeater-list="views"  class="row col-lg-12">
                                   
                                        <div data-repeater-item class="form-group align-items-center col-lg-6">
                                            <div class="row">
                                                <div class="col-md-8">
                                                
                                                    <input value="add.blade.php" type="text" class="form-control" name="view_file_name" placeholder="Enter view file name" />
                                                    <div class="d-md-none mb-2"></div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                                        <i class="la la-trash-o"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-repeater-item class="form-group align-items-center col-lg-6">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    
                                                    <input value="edit.blade.php" name="view_file_name" type="text" class="form-control" placeholder="Enter view file name" />
                                                    
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                                        <i class="la la-trash-o"></i>Delete
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div data-repeater-item class="form-group align-items-center col-lg-6">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input value="show.blade.php" name="view_file_name" type="text" class="form-control" placeholder="" />
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                                        <i class="la la-trash-o"></i>Delete
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div data-repeater-item class="form-group align-items-center col-lg-6">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input value="index.blade.php" name="view_file_name" type="text" class="form-control" placeholder="" />
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                                        <i class="la la-trash-o"></i>Delete
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                            <div class=" row">
                               
                                <div class="col-lg-4">
                                    <a href="javascript:;" data-repeater-create="" class="btn btn-lg font-weight-bolder btn-light-primary">
                                        <i class="la la-plus"></i>Add
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-md-6">
                            <label for="addon_zip">{{ translate('Database Model Filename')}}</label>
                            <div>
                                <input class="form-control" placeholder="{{ translate('Database Model Filename')}}" type="text" name="model_file_name" />
                            </div>
                            <span class="form-text text-muted">{{translate('Example: Example')}}</span>
                        </div>
                        <div class=" col-md-6">
                            <label for="addon_zip">{{ translate('Routes File name')}}</label>
                            <div>
                                <input class="form-control" placeholder="{{ translate('Routes File name')}}" type="text" name="route_file_name" />
                            </div>
                            <span class="form-text text-muted">{{translate('Example: examples.php')}}</span>
                        </div>
                    </div>


                </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">{{translate('Generate')}}</button>
        </div>
        </form>
        <!--end::Form-->
    </div>
</div>

@endsection

@section('script')
    <script>
        $('#kt_repeater_1').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $(document).ready(function() {
            FormValidation.formValidation(
                document.getElementById('addons_generate_store'), {
                    fields: {
                        "unique_identifier": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
                                }
                            }
                        },
                        "title": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
                                }
                            }
                        },
                        "version": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
                                }
                            }
                        },
                        "minimum_item_version": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
                                }
                            }
                        },
                        "required_addons": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
                                }
                            }
                        },
                        "controller_file_name": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
                                }
                            }
                        },
                        "view_folder_name": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
                                }
                            }
                        },

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
                            // valid: 'fa fa-check',
                            // invalid: 'fa fa-times',
                            validating: 'fa fa-refresh',
                        }),
                    }
                }
            );
        });
    </script>
@endsection