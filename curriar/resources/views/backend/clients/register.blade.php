@extends('backend.layouts.blank')

@section('content')

    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ static_asset('assets/dashboard/media/bg/bg-3.jpg') }}');">
                

                    <div class="container p-5">
                        <div class="row">
                            <div class="mx-auto col-lg-6 col-xl-6">
                                <!--begin::Login Header-->
                                <div class="mb-5 d-flex flex-center">
                                    <a href="#">
                                        @if(get_setting('system_logo_black') != null)
                                            <img src="{{ uploaded_asset(get_setting('system_logo_black')) }}" alt="{{ get_setting('site_name') }}" class="max-h-75px" style="width:100%">
                                        @else
                                            <img src="{{ static_asset('assets/img/logo.svg') }}" alt="{{ get_setting('site_name') }}" class="max-h-75px">
                                        @endif
                                    </a>
                                </div>
                                <!--end::Login Header-->
                                <div class="mb-5 text-center">
                                    <h3>{{ translate('Welcome to') }} @if(get_setting('site_name')) {{ get_setting('site_name') }} @else {{ translate('Spotlayer Framework') }}  @endif</h3>
								<div class="text-muted font-weight-bold">{{ translate('Create a New Account') }}</div>
                                </div>
                                <div class="text-left card">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('client.save') }}">
                                            @csrf

                                            <div class="form-group">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autofocus placeholder="{{ translate('Full Name') }}">

                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="{{ translate('password') }}">

                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  placeholder="{{ translate('Confrim Password') }}">
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="{{ translate('Email') }}">

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}"  placeholder="{{ translate('Phone Number') }}">

                                                @if ($errors->has('mobile'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('mobile') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="mb-3 text-left checkbox pad-btm">
                                                <label class="checkbox checkbox-success">
                                                    <input id="condotion_agreement" name="condotion_agreement" type="checkbox" class="sh-check"  />
                                                    <span class="mr-3"></span> {{translate('I agree with the Terms and Conditions')}}
                                                </label>
                                                <div>
                                                    @if ($errors->has('condotion_agreement'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('condotion_agreement') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                {{ translate('Register') }}
                                            </button>
                                        </form>
                                        <div class="mt-3">
                                            {{translate('Already have an account')}} ? <a href="{{route('login')}}" class="btn-link mar-rgt text-bold">{{translate('Sign In')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->



@endsection


@section('script')
    <!-- <script type="text/javascript">

    

        $(document).ready(function() {
            const form = document.getElementById('kt_login'); 
            FormValidation.formValidation(
                form, {
                    fields: {
                        "name": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
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
                        "password_confirmation": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
                                },
                                identical: {
                                    compare: function() {
                                        return  document.getElementById('kt_login').querySelector('[name="password"]').value;
                                    },
                                    message: 'The password and its confirm are not the same'
                                }
                            }
                        },
                        "email": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
                                },
                                emailAddress: {
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
                        "responsible_mobile": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
                                }
                            }
                        },
                        "demo-form-checkbox": {
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
    </script> -->


@endsection
