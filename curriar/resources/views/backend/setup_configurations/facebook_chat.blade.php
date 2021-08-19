@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Facebook Chat Setting')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="kt_form_1" action="{{ route('facebook_chat.update') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-from-label">{{translate('Facebook Chat')}}</label>
                            </div>
                            <div class="col-md-7">
                                <label class="mb-0 aiz-switch checkbox aiz-switch-success">
                                    <input value="1" name="facebook_chat" type="checkbox" @if (\App\BusinessSetting::where('type', 'facebook_chat')->first()->value == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="FACEBOOK_PAGE_ID">
                            <div class="col-md-3">
                                <label class="col-from-label">{{translate('Facebook Page ID')}}</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="FACEBOOK_PAGE_ID" value="{{  env('FACEBOOK_PAGE_ID') }}" placeholder="{{ translate('Facebook Page ID') }}">
                            </div>
                        </div>
                        <div class="mb-0 text-right form-group">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-gray-light">
              <div class="card-header">
                  <h5 class="mb-0 h6">{{ translate('Please be carefull when you are configuring Facebook chat. For incorrect configuration you will not get messenger icon on your user-end site.') }}</h5>
              </div>
                <div class="card-body">
                    <ul class="list-group mar-no">
                        <li class="list-group-item text-dark">1. {{ translate('Login into your facebook page') }}</li>
                        <li class="list-group-item text-dark">2. {{ translate('Find the About option of your facebook page') }}.</li>
                        <li class="list-group-item text-dark">3. {{ translate('At the very bottom, you can find the \“Facebook Page ID\”') }}.</li>
                        <li class="list-group-item text-dark">4. {{ translate('Go to Settings of your page and find the option of \"Advance Messaging\"') }}.</li>
                        <li class="list-group-item text-dark">5. {{ translate('Scroll down that page and you will get \"white listed domain\"') }}.</li>
                        <li class="list-group-item text-dark">6. {{ translate('Set your website domain name') }}.</li>
                    </ul>
                </div>
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
                    "FACEBOOK_PAGE_ID": {
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
