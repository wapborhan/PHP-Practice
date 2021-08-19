@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="mb-3 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{translate('Google reCAPTCHA Setting')}}</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="kt_form_1" action="{{ route('google_recaptcha.update') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="control-label">{{translate('Google reCAPTCHA')}}</label>
                            </div>
                            <div class="col-md-8">
                                <label class="mb-0 aiz-switch checkbox aiz-switch-success">
                                    <input value="1" name="google_recaptcha"  id="google_recaptcha" type="checkbox" @if (\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="CAPTCHA_KEY">
                            <div class="col-md-4">
                                <label class="control-label">{{translate('Site KEY')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="CAPTCHA_KEY" value="{{  env('CAPTCHA_KEY') }}" placeholder="{{ translate('Site KEY') }}">
                            </div>
                        </div>
                        <div class="mb-0 text-right form-group">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{translate('Google Map Setting')}}</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="kt_form_2" action="{{ route('google_map.update') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="control-label">{{translate('Google Map')}}</label>
                            </div>
                            <div class="col-md-8">
                                <label class="mb-0 aiz-switch checkbox aiz-switch-success">
                                    <input value="1" name="google_map" id="google_map" type="checkbox" @if (\App\BusinessSetting::where('type', 'google_map')->first()->value == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="control-label">{{translate('Google Map KEY')}}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MAP_KEY" value="{{\App\BusinessSetting::where('type', 'google_map')->first()->key}}" placeholder="{{ translate('Google Map KEY') }}">
                            </div>
                        </div>
                        <div class="mb-0 text-right form-group">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
