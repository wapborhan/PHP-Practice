@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Choose default SMS Gatway')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="DEFAULT_SMS_GATEWAY">
                        <label>{{translate('Set as a Default sms gateway')}}</label>
                        <div class="radio-list">

                            @if(\App\Models\BusinessSetting::whereType('nexmo')->first()->value == 1 )
                                <label class="radio">
                                    <input type="radio" class="form-control" name="DEFAULT_SMS_GATEWAY" value="nexmo" {{  env('DEFAULT_SMS_GATEWAY') == 'nexmo' ?  'checked' : ''}} required>
                                    <span></span> &nbsp;&nbsp;
                                    Nexmo
                                </label>
                            @endif
                            @if(\App\Models\BusinessSetting::whereType('ebernate')->first()->value == 1 )
                                <label class="radio">
                                    <input type="radio" class="form-control" name="DEFAULT_SMS_GATEWAY" value="ebernate" {{  env('DEFAULT_SMS_GATEWAY') == 'ebernate' ?  'checked' : ''}} required>
                                    <span></span> &nbsp;&nbsp;
                                    SMSPRO (ebernate)
                                </label>
                            @endif
                            @if(\App\Models\BusinessSetting::whereType('twillo')->first()->value == 1 )
                                <label class="radio">
                                    <input type="radio" class="form-control" name="DEFAULT_SMS_GATEWAY" value="twillo" {{  env('DEFAULT_SMS_GATEWAY') == 'twillo' ?  'checked' : ''}} required>
                                    <span></span> &nbsp;&nbsp;
                                    Twilio
                                </label>
                            @endif
                            @if(\App\Models\BusinessSetting::whereType('ssl_wireless')->first()->value == 1 )
                                <label class="radio">
                                    <input type="radio" class="form-control" name="DEFAULT_SMS_GATEWAY" value="ssl_wireless" {{  env('DEFAULT_SMS_GATEWAY') == 'ssl_wireless' ?  'checked' : ''}} required>
                                    <span></span> &nbsp;&nbsp;
                                    SSL Wireless
                                </label>
                            @endif
                            @if(\App\Models\BusinessSetting::whereType('fast2sms')->first()->value == 1 )
                                <label class="radio">
                                    <input type="radio" class="form-control" name="DEFAULT_SMS_GATEWAY" value="fast2sms" {{  env('DEFAULT_SMS_GATEWAY') == 'fast2sms' ?  'checked' : ''}} required>
                                    <span></span> &nbsp;&nbsp;
                                    Fast2SMS
                                </label>
                            @endif
                            @if(\App\Models\BusinessSetting::whereType('mimo')->first()->value == 1 )
                                <label class="radio">
                                    <input type="radio" class="form-control" name="DEFAULT_SMS_GATEWAY" value="mimo" {{  env('DEFAULT_SMS_GATEWAY') == 'mimo' ?  'checked' : ''}} required>
                                    <span></span> &nbsp;&nbsp;
                                    MIMO
                                </label>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>

        @if(\App\Models\BusinessSetting::whereType('nexmo')->first()->value == 1 )
            <div class="card mt-8 ">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Nexmo')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="VALID_NEXMO_NUMBER">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('Nexmo Valid Number')}}</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="VALID_NEXMO_NUMBER" value="{{  env('VALID_NEXMO_NUMBER') }}" placeholder="{{ translate('Nexmo Valid Number') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NEXMO_KEY">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('Nexmo Key')}}</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="NEXMO_KEY" value="{{  env('NEXMO_KEY') }}" placeholder="{{ translate('Nexmo Key') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="NEXMO_SECRET">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('Nexmo Secret')}}</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="NEXMO_SECRET" value="{{  env('NEXMO_SECRET') }}" placeholder="{{ translate('Nexmo Secret') }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        @if(\App\Models\BusinessSetting::whereType('twillo')->first()->value == 1 )
            <div class="card mt-8">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Twilio')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="VALID_TWILLO_NUMBER">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('Twilio Valid Number')}}</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="VALID_TWILLO_NUMBER" value="{{ env('VALID_TWILLO_NUMBER') }}" placeholder="{{ translate('Twilio Username') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="TWILIO_SID">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('Twilio SID')}}</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="TWILIO_SID" value="{{ env('TWILIO_SID') }}" placeholder="{{ translate('Twilio SID') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="TWILIO_AUTH_TOKEN">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('Twilio Auth Token')}}</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="TWILIO_AUTH_TOKEN" value="{{ env('TWILIO_AUTH_TOKEN') }}" placeholder="{{ translate('Twilio Auth Token') }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        @if(\App\Models\BusinessSetting::whereType('ebernate')->first()->value == 1 )
            <div class="card  mt-8 gutter-b">
                <div class="card-header">
                <h5 class="mb-0 h6">{{translate('SMSPro (ebernate)')}}</h5>
            </div>
                <div class="card-body">
                    {{--                https://smspro.ebernate.com/passerelle/?numero=xxxxxxxxxx&sms=oui&clefs=Rrb6H3wRCQvpOIYZNcUIU4xyzI9sy5Mm&multimedia=non&langue=fr&message=yyyyyyyy--}}
                    <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="SMSPOH_ENDPOINT">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('SMSPRO Endpoint')}}</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="SMSPOH_ENDPOINT" value="{{  env('SMSPOH_ENDPOINT') }}" placeholder="{{ translate('SMSPRO Endpoint') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="SMSPRO_CLEFS">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('SMSPRO Clefs')}}</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="SMSPRO_CLEFS" value="{{  env('SMSPRO_CLEFS') }}" placeholder="{{ translate('SMSPRO Clefs') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="SMSPRO_MULTIMEDIA">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('SMSPRO multimedia')}}</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="SMSPRO_MULTIMEDIA" value="{{  env('SMSPRO_MULTIMEDIA') }}" placeholder="{{ translate('SMSPRO multimedia') }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
    <div class="col-md-6">

        
        @if(\App\Models\BusinessSetting::whereType('ssl_wireless')->first()->value == 1 )
            <div class="card ">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('SSL Wireless Credential')}}</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                            <input type="hidden" name="otp_method" value="ssl_wireless">
                            @csrf
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="SSL_SMS_API_TOKEN">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{translate('SSL SMS API TOKEN')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="SSL_SMS_API_TOKEN" value="{{  env('SSL_SMS_API_TOKEN') }}" placeholder="SSL SMS API TOKEN" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="SSL_SMS_SID">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{translate('SSL SMS SID')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="SSL_SMS_SID" value="{{  env('SSL_SMS_SID') }}" placeholder="SSL SMS SID" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="SSL_SMS_URL">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{translate('SSL SMS URL')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="SSL_SMS_URL" value="{{  env('SSL_SMS_URL') }}" placeholder="SSL SMS URL" >
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
        @endif

        @if(\App\Models\BusinessSetting::whereType('fast2sms')->first()->value == 1 )
            <div class="card mt-8 ">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Fast2SMS Credential')}}</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                            <input type="hidden" name="otp_method" value="fast2sms">
                            @csrf
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="AUTH_KEY">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{translate('AUTH KEY')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="AUTH_KEY" value="{{  env('AUTH_KEY') }}" placeholder="AUTH KEY" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="ROUTE">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{translate('ROUTE')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control aiz-selectpicker" name="ROUTE" required>
                                        <option value="p" @if (env('ROUTE') == "p") selected @endif>{{translate('Promotional Use')}}</option>
                                        <option value="t" @if (env('ROUTE') == "t") selected @endif>{{translate('Transactional Use')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="LANGUAGE">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{translate('LANGUAGE')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control aiz-selectpicker" name="LANGUAGE" required>
                                        <option value="english" @if (env('LANGUAGE') == "english") selected @endif>English</option>
                                        <option value="unicode" @if (env('LANGUAGE') == "unicode") selected @endif>Unicode</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="SENDER_ID">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{translate('SENDER ID')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="SENDER_ID" value="{{  env('SENDER_ID') }}" placeholder="6 digit SENDER ID" >
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
        @endif
        @if(\App\Models\BusinessSetting::whereType('mimo')->first()->value == 1 )
            <div class="card mt-8 ">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('MIMO Credential')}}</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                            <input type="hidden" name="otp_method" value="mimo">
                            @csrf
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MIMO_USERNAME">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{translate('MIMO_USERNAME')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MIMO_USERNAME" value="{{  env('MIMO_USERNAME') }}" placeholder="MIMO_USERNAME" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MIMO_PASSWORD">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{translate('MIMO_PASSWORD')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MIMO_PASSWORD" value="{{  env('MIMO_PASSWORD') }}" placeholder="MIMO_PASSWORD" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MIMO_SENDER_ID">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{translate('MIMO_SENDER_ID')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MIMO_SENDER_ID" value="{{  env('MIMO_SENDER_ID') }}" placeholder="MIMO_SENDER_ID" required>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
        @endif
    </div>
</div>
<div class="divider-center"></div>
@endsection
