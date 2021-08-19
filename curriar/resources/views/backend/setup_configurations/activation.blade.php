@extends('backend.layouts.app')


@section('subheader')
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">{{ translate('Features Activation') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Features Activation') }}</a>
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

<h4 class="text-center text-muted">{{translate('HTTPS Activation')}}</h4>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
            	<h5 class="mb-0 text-center h6">{{translate('HTTPS Activation')}}</h5>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success">
                    <input data-switch="true" onchange="updateSettings(this, 'FORCE_HTTPS')" type="checkbox" @if(env('FORCE_HTTPS') == 'On') checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
</div>

<h4 class="mt-4 text-center text-muted">{{translate('Maintenance Mode')}}</h4>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Maintenance Mode Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success">
                    <input data-switch="true" onchange="updateSettings(this, 'maintenance_mode')" type="checkbox" @if(\App\BusinessSetting::where('type', 'maintenance_mode')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
</div>

{{-- <h4 class="mt-4 text-center text-muted">{{translate('Classified Product Activate')}}</h4>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Classified Product')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success">
                    <input data-switch="true" onchange="updateSettings(this, 'classified_product')" type="checkbox" @if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
</div> --}}

<h4 class="mt-4 text-center text-muted">{{translate('Business Related')}}</h4>
<div class="row">
    {{-- <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Wallet System Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success">
                    <input data-switch="true" onchange="updateSettings(this, 'wallet_system')" type="checkbox" @if(\App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div> --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Email Verification')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success">
                    <input data-switch="true" onchange="updateSettings(this, 'email_verification')" type="checkbox" @if(\App\BusinessSetting::where('type', 'email_verification')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    You need to configure SMTP correctly to enable this feature. <a href="{{ route('email_settings.index') }}">Configure Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<h4 class="mt-4 text-center text-muted">{{translate('Payment Related')}}</h4>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="text-center card-header bord-btm">
                <h3 class="mb-0 text-center h6">{{translate('Paypal Payment Activation')}}</h3>
            </div>
            <div class="card-body">
                <div class="clearfix">
                    <img class="float-left" src="{{ static_asset('assets/img/cards/paypal.png') }}" height="30">

                    <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'paypal_payment')" type="checkbox" @if(\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="text-center alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{ translate('You need to configure Paypal correctly to enable this feature') }}.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Stripe Payment Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <div class="clearfix">
                    <img   class="float-left" src="{{ static_asset('assets/img/cards/stripe.png') }}" height="30">

                    {{-- <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'stripe_payment')" type="checkbox" @if(\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>  --}}
                </div>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{-- {{ translate('You need to configure Paypal correctly to enable this feature') }}. --}}
                    {{ translate('Coming Soon') }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('SSlCommerz Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <div class="clearfix">
                    <img class="float-left" src="{{ static_asset('assets/img/cards/sslcommerz.png') }}" height="30">

                     <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'sslcommerz_payment')" type="checkbox" @if(\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{-- {{ translate('You need to configure Paypal correctly to enable this feature') }}. --}}
                    {{ translate('Coming Soon') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Instamojo Payment Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <div class="clearfix">
                    <img class="float-left" src="{{ static_asset('assets/img/cards/instamojo.png') }}" height="30">

                    {{--  <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'instamojo_payment')" type="checkbox" @if(\App\BusinessSetting::where('type', 'instamojo_payment')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>  --}}
                </div>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{-- {{ translate('You need to configure Instamojo Payment correctly to enable this feature') }}. --}}
                    {{ translate('Coming Soon') }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Razor Pay Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <div class="clearfix">
                    <img class="float-left" src="{{ static_asset('assets/img/cards/rozarpay.png') }}" height="30">

                    {{--  <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'razorpay')" type="checkbox" @if(\App\BusinessSetting::where('type', 'razorpay')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>  --}}
                </div>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{-- {{ translate('You need to configure Razor correctly to enable this feature') }}. --}}
                    {{ translate('Coming Soon') }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('PayStack Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <div class="clearfix">
                    <img class="float-left" src="{{ static_asset('assets/img/cards/paystack.png') }}" height="30">

                    {{--  <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'paystack')" type="checkbox" @if(\App\BusinessSetting::where('type', 'paystack')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>  --}}
                </div>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{-- {{ translate('You need to configure PayStack correctly to enable this feature')  }}. --}}
                    {{ translate('Coming Soon') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('VoguePay Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <div class="clearfix">
                    <img class="float-left" src="{{ static_asset('assets/img/cards/vogue.png') }}" height="30">

                    {{--  <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'voguepay')" type="checkbox" @if(\App\BusinessSetting::where('type', 'voguepay')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>  --}}
                </div>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{-- {{ translate('You need to configure VoguePay correctly to enable this feature') }}. --}}
                    {{ translate('Coming Soon') }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Payhere Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <div class="clearfix">
                    <img class="float-left" src="{{ static_asset('assets/img/cards/payhere.png') }}" height="30">

                    {{--  <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'payhere')" type="checkbox" @if(\App\BusinessSetting::where('type', 'payhere')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>  --}}
                </div>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{-- {{ translate('You need to configure VoguePay correctly to enable this feature') }}. --}}
                    {{ translate('Coming Soon') }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Ngenius Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <div class="clearfix">
                    <img class="float-left" src="{{ static_asset('assets/img/cards/ngenius.png') }}" height="30">

                    {{--  <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'ngenius')" type="checkbox" @if(\App\BusinessSetting::where('type', 'ngenius')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>  --}}
                </div>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{-- {{ translate('You need to configure Ngenius correctly to enable this feature') }}. --}}
                    {{ translate('Coming Soon') }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Iyzico Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <div class="clearfix">
                    <img class="float-left" src="{{ static_asset('assets/img/cards/iyzico.png') }}" height="30">

                    {{--  <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'iyzico')" type="checkbox" @if(\App\BusinessSetting::where('type', 'iyzico')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>  --}}
                </div>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{-- {{ translate('You need to configure iyzico correctly to enable this feature') }}. --}}
                    {{ translate('Coming Soon') }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Cash Payment Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <div class="clearfix">
                    <img class="float-left" src="{{ static_asset('assets/img/cards/cod.png') }}" height="30">

                    <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'cash_payment')" type="checkbox" @if(\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Monthly Payment Activation')}}</h3>
            </div>
            <div class="text-center card-body">
                <div class="clearfix">
                    <img class="float-left" src="{{ static_asset('assets/img/cards/cod.png') }}" height="30">

                    <label class="float-right mb-0 aiz-switch aiz-switch-success">
                        <input data-switch="true" onchange="updateSettings(this, 'monthly_payment')" type="checkbox" @if(\App\BusinessSetting::where('type', 'monthly_payment')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<h4 class="mt-4 text-center text-muted">{{translate('Social Media Login')}}</h4>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Facebook login')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success ">
                    <input data-switch="true" onchange="updateSettings(this, 'facebook_login')" type="checkbox" @if(\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{ translate('You need to configure Facebook Client correctly to enable this feature') }}. <a href="{{ route('social_login.index') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Google login')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success ">
                    <input data-switch="true" onchange="updateSettings(this, 'google_login')" type="checkbox" @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{ translate('You need to configure Google Client correctly to enable this feature') }}. <a href="{{ route('social_login.index') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Twitter login')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success ">
                    <input data-switch="true" onchange="updateSettings(this, 'twitter_login')" type="checkbox" @if(\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{ translate('You need to configure Twitter Client correctly to enable this feature') }}. <a href="{{ route('social_login.index') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<h4 class="mt-4 text-center text-muted">{{translate('SMS Gateways')}}</h4>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Nexmo SMS')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success ">
                    <input data-switch="true" onchange="updateSettings(this, 'nexmo')" type="checkbox" @if(\App\BusinessSetting::where('type', 'nexmo')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{ translate('You need to configure Nexmo Client correctly to enable this feature') }}. <a href="{{ route('sms_gateways.index') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Twilio SMS')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success ">
                    <input data-switch="true" onchange="updateSettings(this, 'twillo')" type="checkbox" @if(\App\BusinessSetting::where('type', 'twillo')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{ translate('You need to configure Twilio Client correctly to enable this feature') }}. <a href="{{ route('sms_gateways.index') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('SMSPro (ebernate)')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success ">
                    <input data-switch="true" onchange="updateSettings(this, 'ebernate')" type="checkbox" @if(\App\BusinessSetting::where('type', 'ebernate')->first()->value == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{ translate('You need to configure SMSPro (ebernate) Client correctly to enable this feature') }}. <a href="{{ route('sms_gateways.index') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('SSL Wireless')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success ">
                    <input data-switch="true" onchange="updateSettings(this, 'ssl_wireless')" type="checkbox" @if(\App\BusinessSetting::where('type', 'ssl_wireless')->first()->value ?? 0 == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{ translate('You need to configure SSL Wireless correctly to enable this feature') }}. <a href="{{ route('sms_gateways.index') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('Fast2SMS')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success ">
                    <input data-switch="true" onchange="updateSettings(this, 'fast2sms')" type="checkbox" @if(\App\BusinessSetting::where('type', 'fast2sms')->first()->value ?? 0 == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{ translate('You need to configure Fast2SMS correctly to enable this feature') }}. <a href="{{ route('sms_gateways.index') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 text-center h6">{{translate('MIMO')}}</h3>
            </div>
            <div class="text-center card-body">
                <label class="mb-0 aiz-switch aiz-switch-success ">
                    <input data-switch="true" onchange="updateSettings(this, 'mimo')" type="checkbox" @if(\App\BusinessSetting::where('type', 'mimo')->first()->value ?? 0 == 1) checked @endif data-on-text="{{translate('Enabled')}}" data-handle-width="100" data-off-text="{{translate('Disabled')}}" data-on-color="success" />
                    <span class="slider round"></span>
                </label>
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    {{ translate('You need to configure MIMO correctly to enable this feature') }}. <a href="{{ route('sms_gateways.index') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function updateSettings(el, type){
            if($(el).is(':checked')){
                var value = 1;
            }
            else{
                var value = 0;
            }
            $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', 'Settings updated successfully');
                }
                else{
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
        // Class definition

        var KTBootstrapSwitch = function() {

        // Private functions
        var demos = function() {
        // minimum setup
        $('[data-switch=true]').bootstrapSwitch();
        };

        return {
        // public functions
        init: function() {
        demos();
        },
        };
        }();

        jQuery(document).ready(function() {
        KTBootstrapSwitch.init();
        });
    </script>
@endsection
