@extends('backend.layouts.app')

@section('content')

<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Staff Information')}}</h5>
        </div>

        <form class="form-horizontal" id="staffs_store" action="{{ route('staffs.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">{{translate('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="email">{{translate('Email')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Email')}}" id="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="mobile">{{translate('Phone')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Phone')}}" id="mobile" name="mobile" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="password">{{translate('Password')}}</label>
                    <div class="col-sm-9">
                        <input type="password" placeholder="{{translate('Password')}}" id="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">{{translate('Role')}}</label>
                    <div class="col-sm-9">
                        <select name="role_id" required class=" role_id form-control kt-select2">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->getTranslation('name')}}</option>
                            @endforeach
                        </select>
                    </div>
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
            document.getElementById('staffs_store'), {
                fields: {
                    "name": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "email": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            },
                            emailAddress:{
                                message: '{{translate("This is should be valid email!")}}'
                            },
                            remote: {
                                data: {
                                    type: 'email',
                                },
                                message: 'The email is already exist',
                                method: 'GET',
                                url: '{{ route("user.checkEmail") }}',
                            }
                        }
                    },
                    "password": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "mobile": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            },
                            numeric: {
                                message: 'This is should be valid phone'
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

    $('.role_id').select2({
          placeholder: 'Select Role',
          language: {
            noResults: function() {
              return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('roles.create')}}?redirect=admin.staffs"
            class="btn btn-primary" >Manage {{translate('Roles')}}</a>
            </li>`;
            },
          },
          escapeMarkup: function(markup) {
            return markup;
          },
        });
</script>
@endsection
