@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-4">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <h3 class="heading heading-4 strong-500">
                                    {{__('Phone Verification')}}
                                </h3>
                                <p>Verification code has been sent. Please wait a few minutes.</p>
                                <a href="{{ route('verification.phone.resend') }}">{{__('Resend Code')}}</a>
                            </div>
                            <div class="px-5 py-lg-5">
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg">
                                        <form class="form-default" role="form" action="{{ route('verification.submit') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                            <!-- <label>{{ __('name') }}</label> -->
                                                <div class="input-group input-group--style-1">
                                                    <input type="text" class="form-control" name="verification_code">
                                                    <span class="input-group-addon">
                                                        <i class="text-md la la-key"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-12 text-right">
                                                    <button type="submit" class="btn btn-styled btn-base-1 w-100 btn-md">{{ __('Verify') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
