@extends('backend.layouts.app')

@section('content')

<div class="mx-auto col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Branch Information')}}</h5>
        </div>

        <form class="form-horizontal" action="{{ route('admin.branchs.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            {!!redirect_input()!!}
            <div class="card-body">
                <div class="form-group">
                    <label>{{translate('Branch Name')}}:</label>
                    <input type="text" id="name" class="form-control" placeholder="{{translate('Branch Name')}}" name="Branch[name]">
                </div>
                <div class="form-group">
                    <label>{{translate('Email')}}:</label>
                    <input id="email-field" type="text" class="form-control" placeholder="{{translate('Email')}}" name="Branch[email]">
                </div>




                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{translate('Profile Picture')}}:</label>

                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="img" class="selected-files" value="{{old('featured_image')}}">
                            </div>
                            <div class="file-preview">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>الفرع المسؤول:</label>
                        <select class="form-control kt-select2" id="select-responsible-branch" name="Branch[responsible_branch_id]">
                            <option></option>
                           
                           
                        </select>
                    </div>
                </div>
            </div> -->



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Password')}}:</label>
                            <input type="password" class="form-control" id="password" placeholder="{{translate('Password')}}" name="User[password]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Confirm Password')}}:</label>
                            <input type="password" class="form-control" placeholder="{{translate('Confirm Password')}}" name="User[confirm_password]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Owner Name')}}:</label>
                            <input type="text" class="form-control" id="owner_name" placeholder="{{translate('Owner Name')}}" name="Branch[responsible_name]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Owner Phone')}}:</label>
                            <input type="text" class="form-control" placeholder="{{translate('Owner Phone')}}" name="Branch[responsible_mobile]">
                        </div>
                    </div>
                </div>
               

                <div class="form-group">
                    <label>{{translate('Owner National ID')}}:</label>
                    <input type="text" class="form-control" placeholder="{{translate('Owner National ID')}}" name="Branch[national_id]">
                </div>

                
                
                {!! hookView('spot-cargo-shipment-branch-addon',$currentView) !!}               

                <div class="mb-0 text-right form-group">
                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {
                    "Branch[name]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Branch[email]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            },
                            emailAddress:{
                                message: '{{translate("This is should be valid email!")}}'
                            },
                            remote: {
                                data: {
                                    type: 'Branch',
                                },
                                message: 'The email is already exist',
                                method: 'GET',
                                url: '{{ route("user.checkEmail") }}',
                            }
                        }
                    },
                    "User[password]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "User[confirm_password]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            },
                            identical: {
                                compare: function() {
                                    return  document.getElementById('kt_form_1').querySelector('[name="User[password]"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                    "Branch[responsible_name]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Branch[responsible_mobile]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Branch[national_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            },
                            numeric: {
                                message: 'This is should be valid national id'
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
