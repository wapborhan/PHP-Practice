@php
    $checked_google_map = \App\BusinessSetting::where('type', 'google_map')->first();
    $is_def_mile_or_fees = \App\ShipmentSetting::getVal('is_def_mile_or_fees');
    $countries = \App\Country::where('covered',1)->get();
    $user_type = Auth::user()->user_type;
@endphp

@extends('backend.layouts.app')

@section('content')

<div class="mx-auto col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Customer Information')}}</h5>
        </div>

        <form class="form-horizontal" action="{{ route('admin.clients.update',['client'=>$client->id]) }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">
                <div class="form-group">
                    <label>{{translate('Commercial Name')}}:</label>
                    <input type="text" id="name" class="form-control" value="{{$client->name}}" placeholder="{{translate('Here')}}" name="Client[name]">
                </div>
                <div class="form-group">
                    <label>{{translate('Email')}}:</label>
                    <input id="email-field" type="text" class="form-control" value="{{$client->email}}" placeholder="{{translate('Here')}}" name="Client[email]">
                </div>




                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{translate('Profile Picture')}}:</label>

                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="img" class="selected-files" value="{{$client->img}}">
                            </div>
                            <div class="file-preview">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>الفرع المسؤول:</label>
                        <select class="form-control kt-select2" id="select-responsible-branch" name="Client[responsible_branch_id]">
                            <option></option>


                        </select>
                    </div>
                </div>
            </div> -->



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Password')}}:</label>
                            <input type="password" class="form-control" id="password" placeholder="{{translate('Here')}}" name="User[password]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Confirm Password')}}:</label>
                            <input type="password" class="form-control" placeholder="{{translate('Here')}}" name="User[confirm_password]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Owner Name')}}:</label>
                            <input type="text" class="form-control" id="owner_name" value="{{$client->responsible_name}}" placeholder="{{translate('Here')}}" name="Client[responsible_name]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Owner Phone')}}:</label>
                            <input type="text" class="form-control" placeholder="{{translate('Here')}}" value="{{$client->responsible_mobile}}" name="Client[responsible_mobile]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Followup Name')}} :</label>
                            <input type="text" class="form-control" id="followup_name" placeholder="{{translate('Here')}}" value="{{$client->follow_up_name}}" name="Client[follow_up_name]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Followup Phone')}}:</label>
                            <input type="text" class="form-control" placeholder="{{translate('Here')}}" value="{{$client->follow_up_mobile}}" name="Client[follow_up_mobile]">
                        </div>
                    </div>
                </div>

                <div class="form-group" id="kt_repeater_1">
                    <div data-repeater-list="address">

                        @foreach($client->addressess as $address)
                            <div data-repeater-item class="data-repeater-item-count">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{translate('Country')}}:</label>
                                            <select name="country_id" class="change-country-client-address form-control select-country">
                                                <option value=""></option>
                                                @foreach($countries as $country)
                                                <option value="{{$country->id}}" @if($country->id == $address->country_id ) selected @endif >{{$country->name}}</option>

                                                    @php
                                                        if($country->id == $address->country_id )
                                                        $states = \App\State::where('country_id',$address->country_id)->get();
                                                    @endphp
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{translate('Region')}}:</label>
                                            <select  name="state_id" class="change-state-client-address form-control select-state">
                                                <option value=""></option>
                                                @foreach($states as $state)
                                                <option value="{{$state->id}}" @if($state->id == $address->state_id ) selected @endif >{{$state->name}}</option>

                                                    @php
                                                        if($state->id == $address->state_id )
                                                        $areas = \App\Area::where('state_id',$address->state_id)->get();
                                                    @endphp
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{translate('Area')}}:</label>
                                            <select name="area_id" style="display: block !important;" class="change-area-client-address form-control select-area">
                                                <option value=""></option>
                                                @foreach($areas as $area)
                                                <option value="{{$area->id}}" @if($area->id == $address->area_id ) selected @endif >{{$area->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <label>{{translate('Address')}}:</label>
                                <input type="text" class="form-control" value="{{$address->address}}" required placeholder="{{translate('Address')}}" name="Client[address]">
                                <input type="hidden" value="{{$address->id}}" name='Client[addressess_id]'>

                                @if($checked_google_map->value == 1 )
                                    <div class="location-client location-client-{{$address->id}} mt-2">
                                        <label>{{translate('Location')}}:</label>
                                        <input type="text" value="{{$address->client_street_address_map}}" class="form-control address address-client-{{$address->id}} " placeholder="{{translate('Location')}}" name="Client[client_street_address_map]"  rel="client" value="" />
                                        <input type="hidden" value="{{$address->client_lat}}" class="form-control lat" data-client="lat" name="Client[client_lat]" />
                                        <input type="hidden" value="{{$address->client_lng}}" class="form-control lng" data-client="lng" name="Client[client_lng]" />
                                        <input type="hidden" value="{{$address->client_url}}" class="form-control url" data-client="url" name="Client[client_url]" />

                                        <div class="mt-2 col-sm-12 map_canvas map_canvas_{{$address->id}} map-client map-client_{{$address->id}}" style="width:100%;height:300px;"></div>
                                        <span class="form-text text-muted">{{'Change the pin to select the right location'}}</span>
                                    </div>
                                @endif

                                <div class="mt-3 mb-3 row">
                                    <div class="col-md-12">
                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger delete_item">
                                            <i class="la la-trash-o"></i>{{translate('Delete')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <div>
                                <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                                    <i class="la la-plus"></i>{{translate('Add Another Address')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>{{translate('National ID')}}:</label>
                    <input type="text" class="form-control" placeholder="{{translate('Here')}}" value="{{$client->national_id}}" name="Client[national_id]">
                </div>

                <div class="form-group">
                    <label>{{translate('Customer Source')}}:</label>
                    <select class="form-control kt-select2" id="select-how" name="Client[how_know_us]">
                        <option></option>
                        <option  <?php if(isset($client->how_know_us) && $client->how_know_us == "Facebook"){echo "selected";} ?>  value="Facebook">{{translate('Facebook')}}</option>
                        <option  <?php if(isset($client->how_know_us) && $client->how_know_us == "Website"){echo "selected";} ?> value="Website">{{translate('ًWebsite')}}</option>
                        <option <?php if(isset($client->how_know_us) && $client->how_know_us == "Friend"){echo "selected";} ?>  value="Friend">{{translate('Friend')}}</option>
                        <option <?php if(isset($client->how_know_us) && $client->how_know_us == "Sales Team"){echo "selected";} ?>  value="Sales Team">{{translate('Sales Team')}}</option>
                        <option <?php if(isset($client->how_know_us) && $client->how_know_us == "Google"){echo "selected";} ?>  value="Google">{{translate('Google')}}</option>

                    </select>
                </div>

                <div class="mt-5 card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Missions Costs')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{translate('Custom Pickup Cost')}}({{currency_symbol()}}):</label>
                                    <input type="number" min="0" value="{{$client->pickup_cost}}" class="form-control" placeholder="{{translate('Here')}}" name="Client[pickup_cost]">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{translate('Custom Supply Cost')}}({{currency_symbol()}}):</label>
                                    <input type="number" min="0" value="{{$client->supply_cost}}" class="form-control" placeholder="{{translate('Here')}}" name="Client[supply_cost]">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-5 card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">
                                {{translate('Default Costs For The First kg')}}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">


                                <div class="row">

                                    @if($is_def_mile_or_fees == 1)
                                        <div class="def_mile_costs form-group col-md-4">
                                            <label>{{translate('Default Mile Cost')}}({{currency_symbol()}}):</label>
                                            <input type="number" min="0" class="form-control" placeholder="{{translate('Default Mile Cost')}}" value="{{$client->def_mile_cost}}" name="Client[def_mile_cost]">
                                        </div>
                                    @elseif($is_def_mile_or_fees == 2)
                                        <div class="def_shiping_costs form-group col-md-4">
                                            <label>{{translate('Default Shipping Cost')}}({{currency_symbol()}}):</label>
                                            <input type="number" min="0" class="form-control" placeholder="{{translate('Default Shipping Cost')}}" value="{{$client->def_shipping_cost}}" name="Client[def_shipping_cost]">
                                        </div>
                                    @endif


                                    <div class="form-group col-md-4">
                                        <label>{{translate('Default Tax')}}%:</label>
                                        <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Default Tax')}}" value="{{$client->def_tax}}" name="Client[def_tax]">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>{{translate('Default Insurance')}}({{currency_symbol()}}):</label>
                                        <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Default Insurance')}}" value="{{$client->def_insurance}}" name="Client[def_insurance]">
                                    </div>

                                    @if($is_def_mile_or_fees == 1)
                                        <div class="def_mile_costs form-group col-md-4">
                                            <label>{{translate('Default Returned Mile Cost')}}({{currency_symbol()}}):</label>
                                            <input type="number" min="0" class="form-control" placeholder="{{translate('Default Returned Mile Cost')}}" value="{{$client->def_return_cost}}" name="Client[def_return_mile_cost]">
                                        </div>
                                    @elseif($is_def_mile_or_fees == 2)
                                        <div class="def_shiping_costs form-group col-md-4">
                                            <label>{{translate('Default Returned Shipment Cost')}}({{currency_symbol()}}):</label>
                                            <input type="number" min="0" class="form-control" placeholder="{{translate('Default Returned Shipment Cost')}}" value="{{$client->def_return_mile_cost}}" name="Client[def_return_cost]">
                                        </div>
                                    @endif
                                </div>
                                <hr>


                            </div>

                        </div>
                    </div>
                </div>
                <div class="mt-5 card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Extra Costs For Kg')}}</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            @if($is_def_mile_or_fees == 2)
                                <div class="def_shiping_costs form-group col-md-4">
                                    <label>{{translate('Fixed Shipping Cost/Kg')}}:</label>
                                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Shipping Cost/Kg')}}" value="{{$client->def_shipping_cost_gram}}" name="Client[def_shipping_cost_gram]">
                                </div>
                            @elseif($is_def_mile_or_fees == 1)
                                <div class="def_mile_costs form-group col-md-4">
                                    <label>{{translate('Fixed Mile Cost/Kg')}}:</label>
                                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Mile Cost/Kg')}}" value="{{$client->def_mile_cost_gram}}" name="Client[def_mile_cost_gram]">
                                </div>
                            @endif

                            <div class="form-group col-md-4">
                                <label>{{translate('Fixed Tax/Kg')}}%:</label>
                                <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Tax/Kg')}}" value="{{$client->def_tax_gram}}" name="Client[def_tax_gram]">
                            </div>
                            <div class="form-group col-md-4">
                                <label>{{translate('Fixed Insurance/Kg')}}:</label>
                                <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Insurance/Kg')}}" value="{{$client->def_insurance_gram}}" name="Client[def_insurance_gram]">
                            </div>

                            @if($is_def_mile_or_fees == 2)
                                <div class="def_shiping_costs form-group col-md-4">
                                    <label>{{translate('Fixed Returned Shipment Cost/Kg')}}:</label>
                                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Returned Shipment Cost/Kg')}}" value="{{$client->def_return_cost_gram}}" name="Client[def_return_cost_gram]">
                                </div>
                            @elseif($is_def_mile_or_fees == 1)
                                <div class="def_mile_costs form-group col-md-4">
                                    <label>{{translate('Fixed Returned Mile Cost/Kg')}}:</label>
                                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Returned Mile Cost/Kg')}}" value="{{$client->def_return_mile_cost_gram}}" name="Client[def_return_mile_cost_gram]">
                                </div>
                            @endif

                        </div>

                    </div>
                </div>

                <div class="mt-5 card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Extra Fees for Package Types')}}</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if($client->packages)
                                <table class="table mb-0 aiz-table">
                                    <thead>
                                        <tr>
                                            <th>{{translate('Name')}}</th>
                                            <th>{{translate('Extra Cost')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($client->packages as $key => $package)

                                            <tr>
                                                <td>{{$package->package_name}} ({{currency_symbol()}}):</td>

                                                <td>

                                                    <input type="number" min="0" name="package_extra[]" class="form-control" id="" value="{{$package->package_cost}}" />
                                                    <input type="hidden" name="package_id[]" value="{{$package->package_id}}">

                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                                    {{translate('Please Configure Package Types')}},
                                    <a class="alert-link" href="{{ route('admin.packages.index') }}">{{ translate('Configure Now') }}</a>
                                </div>
                            @endif



                        </div>
                </div>

                <div class="mb-0 text-right form-group">
                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection

@section('script')
<script src="{{ static_asset('assets/dashboard/js/geocomplete/jquery.geocomplete.js') }}"></script>
<script src="//maps.googleapis.com/maps/api/js?libraries=places&key={{$checked_google_map->key}}"></script>

<script type="text/javascript">

    @foreach($client->addressess as $key => $address)
        $('.address-client-{{$address->id}}').each(function(){
            var address = $(this);

            var lat = '{{$address->client_lat}}';
            lat = parseFloat(lat);
            var lng = '{{$address->client_lng}}';
            lng = parseFloat(lng);

            address.geocomplete({
                map: ".map_canvas_{{$address->id}}.map-client_{{$address->id}}",
                mapOptions: {
                    zoom: 8,
                    center: { lat: lat, lng: lng },

                },
                markerOptions: {
                    draggable: true
                },
                details: ".location-client-{{$address->id}}",
                detailsAttribute: 'data-client',
                autoselect: true,
                restoreValueAfterBlur: true,
            });
            address.bind("geocode:dragged", function(event, latLng){
                $("input[data-client=lat]").val(latLng.lat());
                $("input[data-client=lng]").val(latLng.lng());
            });
        });
    @endforeach

    //Address Types Repeater
    $('#kt_repeater_1').repeater({
        initEmpty: false,

        show: function() {


            var repeater_item = $(this);

            var map_canvas  = repeater_item.find(".map_canvas.map-client");
            var map_data    = repeater_item.find(".location-client");
            repeater_item.find(".address").geocomplete({
                map: map_canvas,
                mapOptions: {
                    zoom: 18,
                    center: { lat: -34.397, lng: 150.644 },
                },
                markerOptions: {
                    draggable: true
                },
                details: map_data,
                detailsAttribute: "data-client",
                autoselect: true,
                restoreValueAfterBlur: true,
            });
            repeater_item.find(".address").bind("geocode:dragged", function(event, latLng){
                repeater_item.find("input[data-client=lat]").val(latLng.lat());
                repeater_item.find("input[data-client=lng]").val(latLng.lng());
            });

            $(this).slideDown();
            changeCountry();
            changeState();
            selectPlaceholder();
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        },

        isFirstItemUndeletable: true,
        required: true,

    });

    function changeCountry()
    {
        $('.change-country-client-address').change(function() {
            var id = $(this).parent().find( ".change-country-client-address" ).val();
            var row = $(this).closest(".row");
            var state_input = row.find(".change-state-client-address");
            var state_name  = state_input.attr("name");

            $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
                $('select[name ="'+state_name+'"]').empty();

                $('select[name ="'+state_name+'"]').append('<option value=""></option>');
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    $('select[name ="'+state_name+'"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
                }


            });
        });
    }
    changeCountry();

    function changeState()
    {
        $('.change-state-client-address').change(function() {

            var id = $(this).parent().find( ".change-state-client-address" ).val();
            var row = $(this).closest(".row");
            var area_input = row.find(".change-area-client-address");
            var area_name  = area_input.attr("name");
            $.get("{{route('admin.shipments.get-areas-ajax')}}?state_id=" + id, function(data) {
                $('select[name ="'+area_name+'"]').empty();
                $('select[name ="'+area_name+'"]').append('<option value=""></option>');
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    $('select[name ="'+area_name+'"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
                }
            });
        });
    }
    changeState();


    function selectPlaceholder()
    {
        $('.select-area').select2({
            placeholder: "Select Area",
            language: {
            noResults: function() {
                @if($user_type == 'admin' || in_array('1105', $staff_permission) )
                    return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.areas.create')}}?redirect=admin.shipments.create"
                    class="btn btn-primary" >Manage {{translate('Areas')}}</a>
                    </li>`;
                @else
                    return ``;
                @endif
            },
            },
            escapeMarkup: function(markup) {
            return markup;
            },
        });
        $('.select-country').select2({
            placeholder: "Select country",
            language: {
            noResults: function() {
                @if($user_type == 'admin' || in_array('1105', $staff_permission) )
                    return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.shipments.covered_countries')}}?redirect=admin.shipments.create"
                    class="btn btn-primary" >Manage {{translate('Countries')}}</a>
                    </li>`;
                @else
                    return ``;
                @endif
            },
            },
            escapeMarkup: function(markup) {
            return markup;
            },
        });
        $('.select-state').select2({
            placeholder: "Select state",
            language: {
            noResults: function() {
                @if($user_type == 'admin' || in_array('1105', $staff_permission) )
                    return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.shipments.covered_countries')}}?redirect=admin.shipments.create"
                    class="btn btn-primary" >Manage {{translate('States')}}</a>
                    </li>`;
                @else
                    return ``;
                @endif
            },
            },
            escapeMarkup: function(markup) {
            return markup;
            },
        });
    }
    selectPlaceholder();



    $(document).ready(function() {
        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {
                    "Client[name]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Client[email]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "User[confirm_password]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            },
                            identical: {
                                compare: function() {
                                    return  document.getElementById('kt_form_1').querySelector('[name="User[password]"]').value;
                                },
                                message: 'The password and its confirm are not the same'
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
