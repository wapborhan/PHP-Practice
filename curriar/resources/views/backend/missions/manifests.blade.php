@extends('backend.layouts.app')

@section('content')
<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">
                {{translate('Manifests')}}
            </h3>
        </div>
       
    </div>

    <div class="card-body">
    <form action="{{route('admin.missions.get.manifest')}}" id="kt_form_1" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    @php
                        if(Auth::user()->user_type == 'branch'){
                            $manifest_captains = \App\Captain::where('branch_id',Auth::user()->userBranch->branch_id)->get();
                        }else{
                            $manifest_captains = \App\Captain::all();
                        }
                    @endphp
                    
                    <label>{{translate('Driver')}}:</label>
                    <select name="captain_id" class="captain_name" class="form-control">
                        @foreach($manifest_captains as $captain)
                        <option value="{{$captain->id}}">{{$captain->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{translate('Manifest Date')}}:</label>
                <div class="form-group">
                    <input type="text" placeholder="{{translate('Manifest Date')}}" name="manifest_date" autocomplete="off" class="form-control" id="kt_datepicker_3" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                 <label>{{translate('Get Manifest')}}:</label>
                  <button type="submit" class="btn btn-primary" style="display:block">{{translate('Get Manifest')}}</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
@section('modal')
@include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        $('.captain_name').select2({
            width: '100%',
            placeholder: "Select Captain",
        });
        $('#kt_datepicker_3').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            startDate: new Date(),
        });

        $(document).ready(function() {
            FormValidation.formValidation(
                document.getElementById('kt_form_1'), {
                    fields: {
                        "manifest_date": {
                            validators: {
                                notEmpty: {
                                    message: '{{translate("This is required!")}}'
                                }
                            }
                        },
                        "captain_name": {
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