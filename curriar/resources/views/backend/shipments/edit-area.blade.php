@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('Areas')}}</h1>
        </div>

    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Edit Area')}}</h5>
    </div>
    <div class="card-body">

        <form class="form-horizontal" action="{{ route('admin.areas.update',['area'=>$area->id]) }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('From Country')}}:</label>
                        <select id="change-country"  class="form-control select-country" name="country">
                            <option value=""></option>
                            @foreach(\App\Country::all() as $country)
                            <option @if($area->state->country->id == $country->id) selected @endif value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('From Region')}}:</label>
                        <select name="Area[state_id]" class="form-control select-state">
                            <option value=""></option>
                            @foreach(\App\State::where('country_id',$area->state->country->id)->get() as $state)
                            <option @if($area->state_id == $state->id) selected @endif value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
              

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('Area')}}:</label>
                        <input type="text" class="form-control" value="{{$area->name}}" name="Area[name]">
                    </div>
                </div>
              

            </div>
          
            <div class="row">
              
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

{!! hookView('shipment_addon',$currentView) !!}

@endsection

@section('modal')
@include('modals.delete_modal')
@endsection

@section('script')
<script>
    $('.select-country').select2({
        placeholder: "Select a country"
    });
    $('.select-state').select2({
        placeholder: "Select a state"
    });
    $('#change-country').change(function() {
        var id = $(this).val();

        $('.select-country-to').select2({
            placeholder: $(this).find(":selected").text(),
        });

        console.log(id);
        $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Area[state_id]"]').empty();
            
            for (let index = 0; index < data.length; index++) {
                const element = data[index];

                $('select[name ="Area[state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
                
            }


        });
    });
    $(document).ready(function() {
        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {
                    "Area[state_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Area[name]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "country": {
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
</script>
@endsection