@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('Edit Cost')}}</h1>
        </div>

    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Edit Cost')}}</h5>
    </div>
    <div class="card-body">

        <form class="form-horizontal" action="{{ route('admin.costs.update',['cost'=>$cost->id]) }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('From Country')}}:</label>
                        <select id="change-country" name="Cost[from_country_id]" class="form-control select-country">
                            <option value=""></option>
                            @foreach(\App\Country::all() as $country)
                            <option @if($cost->from_country_id == $country->id) selected @endif value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('To Country')}}:</label>
                        @if( \App\ShipmentSetting::getVal('fees_type')  == 2)
                        <select disabled class="form-control select-country  select-country-to">
                            <option value="" id="to_country_text"></option>

                        </select>
                        @elseif( \App\ShipmentSetting::getVal('fees_type')  == 4)
                        <select id="change-country-to" name="Cost[to_country_id]" class="form-control select-country">
                            <option value=""></option>
                            @foreach(\App\Country::all() as $country)
                            <option @if($cost->to_country_id == $country->id) selected @endif value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('From Region')}}:</label>
                        <select name="Cost[from_state_id]" class="form-control select-state">
                           
                            @foreach(\App\State::where('country_id',$cost->from_country_id)->get() as $state)
                            <option @if($cost->from_state_id == $state->id) selected @endif value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('To Region')}}:</label>
                        <select name="Cost[to_state_id]" class="form-control select-state">
                            
                            @foreach(\App\State::where('country_id',$cost->to_country_id)->get() as $state)
                            <option @if($cost->to_state_id == $state->id) selected @endif value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>{{translate('Shipping Cost')}}:</label>
                    <input type="number" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{$cost->shipping_cost}}" name="Cost[shipping_cost]">
                </div>
                <div class="form-group col-md-4">
                    <label>{{translate('Tax')}}:</label>
                    <input type="number" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{$cost->tax}}" name="Cost[tax]">
                </div>

            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>{{translate('Insurance')}}:</label>
                    <input type="number" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{$cost->insurance}}" name="Cost[insurance]">
                </div>
                <div class="form-group col-md-4">
                    <label>{{translate('Returned Shipment Cost')}}:</label>
                    <input type="number" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{$cost->return_cost}}" name="Cost[return_cost]">
                </div>
                <div class="form-group mb-0 text-left col-md-4">
                    <label>{{translate('Save')}}:</label>
                    <div>
                        <button type="submit" class="btn btn-md btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>

@endsection

@section('script')
<script>
    $('.select-country').select2({
        placeholder: "Select a country"
    });

    $('.select-state').select2({
        placeholder: "Select a state"
    });
    @if( \App\ShipmentSetting::getVal('fees_type')  == 2)
    $('#change-country').change(function() {
        var id = $(this).val();

        $('.select-country-to').select2({
            placeholder: $(this).find(":selected").text(),
        });

        console.log(id);
        $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Cost[from_state_id]"]').empty();
            $('select[name ="Cost[to_state_id]"]').empty();
            for (let index = 0; index < data.length; index++) {
                const element = data[index];

                $('select[name ="Cost[from_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
                $('select[name ="Cost[to_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    @elseif( \App\ShipmentSetting::getVal('fees_type')  == 4)
    $('#change-country').change(function() {
        var id = $(this).val();


        
        $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Cost[from_state_id]"]').empty();
           
            for (let index = 0; index < data.length; index++) {
                const element = data[index];

                $('select[name ="Cost[from_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    $('#change-country-to').change(function() {
        var id = $(this).val();

      

        
        $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Cost[to_state_id]"]').empty();
           
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Cost[to_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    @endif
    $(document).ready(function() {
        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {
                    "Cost[from_country_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[to_state_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[from_state_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[shipping_cost]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[return_cost]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[tax]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[insurance]": {
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