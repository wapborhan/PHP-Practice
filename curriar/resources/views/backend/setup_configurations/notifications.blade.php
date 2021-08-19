@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">{{translate('Notifications Setting')}}</h3>
                </div>
                <!--begin::Form-->
                <form class="form-horizontal" id="kt_form_1" method="POST">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bolder">{{translate('New Regsiteration')}}</label>
                            @php
                                $notify = json_decode(\App\BusinessSetting::where('type', 'notifications')->where('key','new_registeration')->first()->value, true);
                            @endphp
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <label class="checkbox checkbox-inline checkbox-success">
                                            <input type="checkbox" onchange="updateSettings(this, 'new_registeration', 'administrators')" <?php if(isset($notify['administrators'])) echo "checked";?> /><span></span>
                                        </label>
                                    </span>
                                    <span class="input-group-text font-weight-bolder">{{translate('System administrators')}}</span>
                                </div>
                                <select class="form-control selectpicker" id="new_registeration_administrators" <?php if(!isset($notify['administrators'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'new_registeration', 'administrators', false)" >
                                    @foreach(\App\User::where('user_type', 'admin')->get() as $user)
                                        <option value="{{$user->id}}" <?php if(isset($notify['administrators']) && in_array($user->id, $notify['administrators'])) echo "selected";?>>{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <label class="checkbox checkbox-inline checkbox-success">
                                            <input type="checkbox" onchange="updateSettings(this, 'new_registeration', 'roles')" <?php if(isset($notify['roles'])) echo "checked";?> /><span></span>
                                        </label>
                                    </span>
                                    <span class="input-group-text font-weight-bolder">{{translate('Employees roles')}}</span>
                                </div>
                                <select class="form-control selectpicker" id="new_registeration_roles" <?php if(!isset($notify['roles'])) echo "disabled";?> data-live-search="true" multiple="multiple" data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'new_registeration', 'roles', false)">
                                    @foreach(\App\Role::get() as $role)
                                        <option value="{{$role->id}}" <?php if(isset($notify['roles']) && in_array($role->id, $notify['roles'])) echo "selected";?>>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <label class="checkbox checkbox-inline checkbox-success">
                                            <input type="checkbox" onchange="updateSettings(this, 'new_registeration', 'employees')" <?php if(isset($notify['employees'])) echo "checked";?> /><span></span>
                                        </label>
                                    </span>
                                    <span class="input-group-text font-weight-bolder">{{translate('Employees')}}</span>
                                </div>
                                <select class="form-control selectpicker" id="new_registeration_employees" <?php if(!isset($notify['employees'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true"  data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'new_registeration', 'employees', false)">
                                    @foreach(\App\User::where('user_type', 'staff')->get() as $user)
                                        <option value="{{$user->id}}" <?php if(isset($notify['employees']) && in_array($user->id, $notify['employees'])) echo "selected";?> >{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{translate('Which one will receive a notification when a new user registered?')}}</span>
                        </div>

                        @if (\App\Addon::where('activated', 1)->count() > 0)
                            @foreach(\File::files(base_path('resources/views/backend/inc/addons/notifications')) as $path)
                                @include('backend.inc.addons.notifications.'.str_replace('.blade','',pathinfo($path)['filename']))
                            @endforeach
                        @endif

                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
        <div class="col-md-4">
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

    function updateSettings(el, type, key, checkbox = true){
        if(checkbox){
            if($(el).is(':checked')){
                var value = 1;
                $('#'+type+'_'+key).prop('disabled', false);
            }
            else{
                var value = 0;
                $('#'+type+'_'+key).val('');
                $('#'+type+'_'+key).prop('disabled', 'disabled');
            }
            $('#'+type+'_'+key).selectpicker('refresh');
        }else{
            var value = $(el).val();
            if($(el).is(':checkbox')){
                if($(el).is(':checked')){
                    var value = true;
                }else{
                    var value = false;
                }
            }
            $.post('{{ route('business_settings.update.notifications') }}', {_token:'{{ csrf_token() }}', type:'notifications', key:type, role:key, value:value}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', 'Settings updated successfully');
                }
                else{
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
    }

    $(document).ready(function() {

        $('[data-switch=true]').bootstrapSwitch();

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
