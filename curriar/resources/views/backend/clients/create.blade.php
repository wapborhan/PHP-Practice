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

        <form class="form-horizontal" action="{{ route('admin.clients.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            {!!redirect_input()!!}
            <div class="card-body">
                <div class="form-group">
                    <label>{{translate('Commercial Name')}}:</label>
                    <input type="text" id="name" class="form-control" placeholder="{{translate('Commercial Name')}}" name="Client[name]">
                </div>
                <div class="form-group">
                    <label>{{translate('Email')}}:</label>
                    <input id="email-field" type="text" class="form-control" placeholder="{{translate('Email')}}" name="Client[email]">
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
                                <input type="hidden" name="img" class="selected-files" value="{{old('featured_image')}}">
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
                            <input type="password" class="form-control" id="password" placeholder="{{translate('Password')}}" name="User[password]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Confirm Password')}}:</label>
                            <input type="password" class="form-control" placeholder="{{translate('Confirm Password')}}" name="User[confirm_password]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Owner Name')}}:</label>
                            <input type="text" class="form-control" id="owner_name" placeholder="{{translate('Owner Name')}}" name="Client[responsible_name]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Owner Phone')}}:</label>
                            <input type="text" class="form-control" placeholder="{{translate('Owner Phone')}}" name="Client[responsible_mobile]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Followup Name')}} :</label>
                            <input type="text" class="form-control" id="followup_name" placeholder="{{translate('Followup Name')}}" name="Client[follow_up_name]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Followup Phone')}}:</label>
                            <input type="text" class="form-control" placeholder="{{translate('Followup Phone')}}" name="Client[follow_up_mobile]">
                        </div>
                    </div>
                </div>

                <div class="form-group" id="kt_repeater_1">
                    <div data-repeater-list="address">
                        
                        <div data-repeater-item class="data-repeater-item-count">

                            <div class="row">       
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Country')}}:</label>
                                        <select name="country_id" class="change-country-client-address form-control select-country">
                                            <option value=""></option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Region')}}:</label>
                                        <select  name="state_id" class="change-state-client-address form-control select-state">
                                            <option value=""></option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Area')}}:</label>
                                        <select name="area_id" style="display: block !important;" class="change-area-client-address form-control select-area">
                                            <option value=""></option>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            

                            <label>{{translate('Address')}}:</label>
                            <input type="text" class="form-control" placeholder="{{translate('Address')}}" required name="address">
                            
                            @if($checked_google_map->value == 1 )       
                                <div class="mt-2 location-client">
                                    <label>{{translate('Location')}}:</label>
                                    <input type="text" class="form-control address address-client " name="client_street_address_map" placeholder="{{translate('Client Location')}}" name="client[street_address_map]"  rel="client" value="" />
                                    <input type="hidden" class="form-control lat" data-client="lat" name="client_lat" />
                                    <input type="hidden" class="form-control lng" data-client="lng" name="client_lng" />
                                    <input type="hidden" class="form-control url" data-client="url" name="client_url" />

                                    <div class="mt-2 col-sm-12 map_canvas map-client" style="width:100%;height:300px;"></div>
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
                    <input type="text" class="form-control" placeholder="{{translate('National ID')}}" name="Client[national_id]">
                </div>

                <div class="form-group">
                    <label>{{translate('Customer Source')}}:</label>
                    <select class="form-control kt-select2 how-know-us" id="select-how" name="Client[how_know_us]">
                        <option></option>
                        <option value="Facebook">{{translate('Facebook')}}</option>
                        <option value="Website">{{translate('ًWebsite')}}</option>
                        <option value="Friend">{{translate('Friend')}}</option>
                        <option value="Sales Team">{{translate('Sales Team')}}</option>
                        <option value="Google">{{translate('Google')}}</option>

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
                                    <input type="number" min="0" value="{{(\App\ShipmentSetting::getVal('def_pickup_cost'))}}" class="form-control" placeholder="{{translate('Here')}}" name="Client[pickup_cost]">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{translate('Custom Supply Cost')}}({{currency_symbol()}}):</label>
                                    <input type="number" min="0" value="{{(\App\ShipmentSetting::getVal('def_supply_cost'))}}" class="form-control" placeholder="{{translate('Here')}}" name="Client[supply_cost]">
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
                                            <input type="number" min="0" class="form-control" placeholder="{{translate('Default Mile Cost')}}" value="{{\App\ShipmentSetting::getVal('def_mile_cost')}}" name="Client[def_mile_cost]">
                                        </div>
                                    @elseif($is_def_mile_or_fees == 2)
                                        <div class="def_shiping_costs form-group col-md-4">
                                            <label>{{translate('Default Shipping Cost')}}({{currency_symbol()}}):</label>
                                            <input type="number" min="0" class="form-control" placeholder="{{translate('Default Shipping Cost')}}" value="{{\App\ShipmentSetting::getVal('def_shipping_cost')}}" name="Client[def_shipping_cost]">
                                        </div>
                                    @endif
                                    

                                    <div class="form-group col-md-4">
                                        <label>{{translate('Default Tax')}}%:</label>
                                        <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Default Tax')}}" value="{{\App\ShipmentSetting::getVal('def_tax')}}" name="Client[def_tax]">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>{{translate('Default Insurance')}}({{currency_symbol()}}):</label>
                                        <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Default Insurance')}}" value="{{\App\ShipmentSetting::getVal('def_insurance')}}" name="Client[def_insurance]">
                                    </div>

                                    @if($is_def_mile_or_fees == 1)
                                        <div class="def_mile_costs form-group col-md-4">
                                            <label>{{translate('Default Returned Mile Cost')}}({{currency_symbol()}}):</label>
                                            <input type="number" min="0" class="form-control" placeholder="{{translate('Default Returned Mile Cost')}}" value="{{\App\ShipmentSetting::getVal('def_return_mile_cost')}}" name="Client[def_return_mile_cost]">
                                        </div>
                                    @elseif($is_def_mile_or_fees == 2)
                                        <div class="def_shiping_costs form-group col-md-4">
                                            <label>{{translate('Default Returned Shipment Cost')}}({{currency_symbol()}}):</label>
                                            <input type="number" min="0" class="form-control" placeholder="{{translate('Default Returned Shipment Cost')}}" value="{{\App\ShipmentSetting::getVal('def_return_cost')}}" name="Client[def_return_cost]">
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
                                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Shipping Cost/Kg')}}" value="{{\App\ShipmentSetting::getVal('def_shipping_cost_gram')}}" name="Client[def_shipping_cost_gram]">
                                </div>
                            @elseif($is_def_mile_or_fees == 1)
                                <div class="def_mile_costs form-group col-md-4">
                                    <label>{{translate('Fixed Mile Cost/Kg')}}:</label>
                                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Mile Cost/Kg')}}" value="{{\App\ShipmentSetting::getVal('def_mile_cost_gram')}}" name="Client[def_mile_cost_gram]">
                                </div>
                            @endif

                            <div class="form-group col-md-4">
                                <label>{{translate('Fixed Tax/Kg')}}%:</label>
                                <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Tax/Kg')}}" value="{{\App\ShipmentSetting::getVal('def_tax_gram')}}" name="Client[def_tax_gram]">
                            </div>
                            <div class="form-group col-md-4">
                                <label>{{translate('Fixed Insurance/Kg')}}:</label>
                                <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Insurance/Kg')}}" value="{{\App\ShipmentSetting::getVal('def_insurance_gram')}}" name="Client[def_insurance_gram]">
                            </div>

                            @if($is_def_mile_or_fees == 2)
                                <div class="def_shiping_costs form-group col-md-4">
                                    <label>{{translate('Fixed Returned Shipment Cost/Kg')}}:</label>
                                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Returned Shipment Cost/Kg')}}" value="{{\App\ShipmentSetting::getVal('def_return_cost_gram')}}" name="Client[def_return_cost_gram]">
                                </div>
                            @elseif($is_def_mile_or_fees == 1)
                                <div class="def_mile_costs form-group col-md-4">
                                    <label>{{translate('Fixed Returned Mile Cost/Kg')}}:</label>
                                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Fixed Returned Mile Cost/Kg')}}" value="{{\App\ShipmentSetting::getVal('def_return_mile_cost_gram')}}" name="Client[def_return_mile_cost_gram]">
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
                            @if(count($packages = \App\Package::all()))
                                <table class="table mb-0 aiz-table">
                                    <thead>
                                        <tr>
                                            <th>{{translate('Name')}}</th>
                                            <th>{{translate('Extra Cost')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($packages as $key => $package)

                                            <tr>
                                                <td>{{$package->name}} ({{currency_symbol()}}):</td>


                                                <td>

                                                    <input type="number" min="0" name="package_extra[]" class="form-control" id="" value="{{$package->cost}}" />
                                                    <input type="hidden" name="package_id[]" value="{{$package->id}}">

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

    $('.address-client').each(function(){
        var address = $(this);
        address.geocomplete({
            map: ".map_canvas.map-client",
            mapOptions: {
                zoom: 8,
                center: { lat: -34.397, lng: 150.644 },
            },
            markerOptions: {
                draggable: true
            },
            details: ".location-client",
            detailsAttribute: 'data-client',
            autoselect: true,
            restoreValueAfterBlur: true,
        });
        address.bind("geocode:dragged", function(event, latLng){
            $("input[data-client=lat]").val(latLng.lat());
            $("input[data-client=lng]").val(latLng.lng());
        });
    });

    $('.how-know-us').select2({
        placeholder: "Client Source",
    });

    //Address Types Repeater

    $('#kt_repeater_1').repeater({
        initEmpty: false,

        show: function() {
            var repeater_item = $(this);

            @if($checked_google_map->value == 1)
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
            @endif

            
            $(this).slideDown();

            changeCountry();
            changeState();
            selectPlaceholder();
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        },

        isFirstItemUndeletable: true
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
                            },
                            emailAddress: {
                                message: '{{translate("This is should be valid email!")}}'
                            },
                            remote: {
                                data: {
                                    type: 'Client',
                                },
                                message: 'The email is already exist',
                                method: 'GET',
                                url: '{{ route("user.checkEmail") }}',
                            }
                        }
                    },
                    "User[password]": {
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
                    },
                    "Client[responsible_name]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Client[responsible_mobile]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "address": {
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
