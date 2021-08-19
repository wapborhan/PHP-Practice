@extends('backend.layouts.app')

@section('content')

<div class="col-lg-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Driver Information')}}</h5>
        </div>

        <form class="form-horizontal" action="{{ route('admin.captains.update',['captain'=>$captain->id]) }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">
                <div class="form-group">
                    <label>{{translate('Driver Name')}}:</label>
                    <input type="text" id="name" class="form-control" value="{{$captain->name}}" placeholder="{{translate('Here')}}" name="Captain[name]">
                </div>
                <div class="form-group">
                    <label>{{translate('Email')}}:</label>
                    <input id="email-field" type="text" class="form-control" value="{{$captain->email}}" placeholder="{{translate('Here')}}" name="Captain[email]">
                </div>




                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Profile Picture')}}:</label>

                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="img" class="selected-files" value="{{$captain->img}}">
                            </div>
                            <div class="file-preview">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Missions Type')}}:</label>
                            <select class="form-control kt-select2" id="select-responsible-branch" name="Captain[type]">
                                <option @if($captain->type == 3) selected @endif value="3">{{translate('Pickup & Delivery')}}</option>
                                <option @if($captain->type == 1) selected @endif value="1">{{translate('Pickup')}}</option>
                                <option @if($captain->type == 2) selected @endif value="2">{{translate('Delivery')}}</option>
                                
                            </select>
                        </div>
                    </div>
                </div>


           



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Password')}}:</label>
                            <input type="password" class="form-control" id="password" placeholder="{{translate('Here')}}" name="User[password]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Confirm Password')}}:</label>
                            <input type="password" class="form-control" placeholder="{{translate('Here')}}" name="User[confirm_password]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Owner Name')}}:</label>
                            <input type="text" class="form-control" id="owner_name" value="{{$captain->responsible_name}}" placeholder="{{translate('Here')}}" name="Captain[responsible_name]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Owner Phone')}}:</label>
                            <input type="text" class="form-control" placeholder="{{translate('Here')}}" value="{{$captain->responsible_mobile}}" name="Captain[responsible_mobile]">
                        </div>
                    </div>
                </div>
           

                <div class="form-group">
                    <label>{{translate('National ID')}}:</label>
                    <input type="text" class="form-control" placeholder="{{translate('Here')}}" value="{{$captain->national_id}}" name="Captain[national_id]">
                </div>

                <div class="form-group">
                    <label>{{translate('Branch')}}:</label>
                    <select class="form-control kt-select2" id="select-how" name="Captain[branch_id]">
                        <option></option>
                        @foreach($branchs as $branch)
                        <option @if($captain->branch_id == $branch->id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group mb-0 text-right">
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
                    "Captain[name]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Captain[branch_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("Captain Branch is required!")}}'
                            }
                        }
                    },
                    "Captain[email]": {
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