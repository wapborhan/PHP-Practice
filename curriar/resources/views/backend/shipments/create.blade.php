@extends('backend.layouts.app')

@section('sub_title'){{translate('Create Shipment')}}@endsection


@section('subheader')
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">{{ translate('Create Shipment') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.shipments.index')}}" class="text-muted">{{translate('Shipments')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Create Shipment') }}</a>
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

@section('sub_title'){{translate('Create New Shipment')}}@endsection
@php
    $auth_user = Auth::user();

    $user_type = Auth::user()->user_type;
    $staff_permission = json_decode(Auth::user()->staff->role->permissions ?? "[]");
    $countries = \App\Country::where('covered',1)->get();
    $packages = \App\Package::all();
    $deliveryTimes = \App\DeliveryTime::all();

    $is_def_mile_or_fees = \App\ShipmentSetting::getVal('is_def_mile_or_fees');
    // is_def_mile_or_fees if result 1 for mile if result 2 for fees

    if(!$is_def_mile_or_fees){
        $is_def_mile_or_fees = 0;
    }
    $checked_google_map = \App\BusinessSetting::where('type', 'google_map')->first();

    if($user_type == 'customer')
    {
        $user_client = Auth::user()->userClient->client_id;
    }
@endphp
<style>
    label {
        font-weight: bold !important;
    }

    .select2-container {
        display: block !important;
    }
</style>
<div class="mx-auto col-lg-12">
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Shipment Info')}}</h5>
        </div>

        @if($user_type == 'admin' || in_array('1105', $staff_permission) )
            @if( \App\ShipmentSetting::getVal('def_shipping_cost') == null)
            <div class="row">
                <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                    {{translate('Please Configure Shipping rates in creation will be zero without configuration')}},
                    <a class="alert-link" href="{{ route('admin.shipments.settings.fees') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
            @endif
            @if(count($countries) == 0 || \App\State::where('covered', 1)->count() == 0)
            <div class="row">
                <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                    {{translate('Please Configure Your covered countries and cities')}},
                    <a class="alert-link" href="{{ route('admin.shipments.covered_countries') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
            @endif
            @if(\App\Area::count() == 0)
            <div class="row">
                <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                    {{translate('Please Add areas before creating your first shipment')}},
                    <a class="alert-link" href="{{ route('admin.areas.create') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
            @endif
            @if(count($packages) == 0)
            <div class="row">
                <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                    {{translate('Please Add package types before creating your first shipment')}},
                    <a class="alert-link" href="{{ route('admin.packages.create') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
            @endif
            @if($branchs->count() == 0)
            <div class="row">
                <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                    {{translate('Please Add branches before creating your first shipment')}},
                    <a class="alert-link" href="{{ route('admin.branchs.index') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
            @endif

            @if($clients->count() == 0)
            <div class="row">
                <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                    {{translate('Please Add clients before creating your first shipment')}},
                    <a class="alert-link" href="{{ route('admin.clients.index') }}">{{ translate('Configure Now') }}</a>
                </div>
            </div>
            @endif
        @else
            @if( \App\ShipmentSetting::getVal('def_shipping_cost') == null || count($countries) == 0 || \App\State::where('covered', 1)->count() == 0 || \App\Area::count() == 0 || count($packages) == 0 || $branchs->count() == 0 || $clients->count() == 0)
                <div class="row">
                    <div class="text-center alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                        {{translate('Please ask your administrator to configure shipment settings first, before you can create a new shipment!')}}
                    </div>
                </div>
            @endif
        @endif

        <form class="form-horizontal" action="{{ route('admin.shipments.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="form-group row">
                            <label class="col-2 col-form-label">{{translate('Shipment Type')}}</label>
                            <div class="col-9 col-form-label">
                                <div class="radio-inline">
                                    <label class="radio radio-success btn btn-default">
                                        <input @if(\App\ShipmentSetting::getVal('def_shipment_type')=='1' ) checked @endif type="radio" name="Shipment[type]" checked="checked" value="1" />
                                        <span></span>
                                        {{translate("Pickup (For door to door delivery)")}}
                                    </label>
                                    <label class="radio radio-success btn btn-default">
                                        <input @if(\App\ShipmentSetting::getVal('def_shipment_type')=='2' ) checked @endif type="radio" name="Shipment[type]" value="2" />
                                        <span></span>
                                        {{translate("Drop off (For delivery package from branch directly)")}}
                                    </label>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Branch')}}:</label>
                                    <select class="form-control kt-select2 select-branch" name="Shipment[branch_id]">
                                        <option></option>
                                        @foreach($branchs as $branch)
                                        <option @if(\App\ShipmentSetting::getVal('def_branch')==$branch->id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(\App\ShipmentSetting::getVal('is_date_required') == '1' || \App\ShipmentSetting::getVal('is_date_required') == null)
                                <div class="form-group">
                                    <label>{{translate('Shipping Date')}}:</label>
                                    <div class="input-group date">
                                        @php
                                            $defult_shipping_date = \App\ShipmentSetting::getVal('def_shipping_date');
                                            if($defult_shipping_date == null )
                                            {
                                                $shipping_data = \Carbon\Carbon::now()->addDays(0);
                                            }else{
                                                $shipping_data = \Carbon\Carbon::now()->addDays($defult_shipping_date);
                                            }

                                        @endphp
                                        <input type="text" placeholder="{{translate('Shipping Date')}}" value="{{ $shipping_data->toDateString() }}" name="Shipment[shipping_date]" autocomplete="off" class="form-control" id="kt_datepicker_3" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group client-select">
                                    <label>{{translate('Client/Sender')}}:</label>
                                    @if($auth_user->user_type == "customer")
                                        <input type="text" placeholder="" class="form-control" name="" value="{{$auth_user->name}}" disabled>
                                        <input type="hidden" name="Shipment[client_id]" value="{{$auth_user->userClient->id}}">
                                    @else
                                        <select class="form-control kt-select2 select-client" id="client-id" onchange="selectIsTriggered()" name="Shipment[client_id]">
                                            <option></option>
                                            @foreach($clients as $client)
                                            <option value="{{$client->id}}" data-phone="{{$client->responsible_mobile}}">{{$client->name}}</option>
                                            @endforeach

                                        </select>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Client Phone')}}:</label>
                                    <input placeholder="{{translate('Client Phone')}}" name="Shipment[client_phone]" id="client_phone" class="form-control" id="" />

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{translate('Client Address')}}:</label>
                                    <select id="client-addressess" name="Shipment[client_address]" class="form-control select-address">
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>

                            <div class="p-3 mb-4 col-md-12" id="show_address_div" style="border: 1px solid #e4e6ef; display:none">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{translate('Country')}}:</label>
                                                <select id="change-country-client-address" name="country_id" class="form-control select-country">
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
                                                <select id="change-state-client-address" name="state_id" class="form-control select-state">
                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label>{{translate('Area')}}:</label>
                                        <select name="area_id" style="display: block !important;" class="form-control select-area">
                                            <option value=""></option>

                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>{{translate('Address')}}:</label>
                                        <input type="text" placeholder="{{translate('Address')}}" name="client_address" class="form-control" required/>
                                    </div>
                                    @if($checked_google_map->value == 1 )
                                        <div class="location-client">
                                            <label>{{translate('Location')}}:</label>
                                            <input type="text" class="form-control address-client " placeholder="{{translate('Location')}}" name="client_street_address_map"  rel="client" value="" />
                                            <input type="hidden" class="form-control lat" data-client="lat" name="client_lat" />
                                            <input type="hidden" class="form-control lng" data-client="lng" name="client_lng" />
                                            <input type="hidden" class="form-control url" data-client="url" name="client_url" />

                                            <div class="mt-2 col-sm-12 map_canvas map-client" style="width:100%;height:300px;"></div>
                                            <span class="form-text text-muted">{{'Change the pin to select the right location'}}</span>
                                        </div>
                                    @endif
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-primary" onclick="AddNewClientAddress()">{{translate('Save')}}</button>
                                        <button type="button" class="btn btn-secondary" onclick="closeAddressDiv()">{{translate('Close')}}</button>
                                    </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Receiver Name')}}:</label>
                                    <input type="text" placeholder="{{translate('Receiver Name')}}" name="Shipment[reciver_name]" class="form-control" />

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Receiver Phone')}}:</label>
                                    <input type="text" placeholder="{{translate('Receiver Phone')}}" name="Shipment[reciver_phone]" class="form-control" />

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{translate('Receiver Address')}}:</label>
                                    <input type="text" placeholder="{{translate('Receiver Address')}}" name="Shipment[reciver_address]" class="form-control" />

                                </div>
                            </div>

                            @if($checked_google_map->value == 1 )
                                <div class="col-md-12">
                                    <div class="location-receiver">
                                        <label>{{translate('Receiver Location')}}:</label>
                                        <input type="text" class="form-control address-receiver " placeholder="{{translate('Receiver Location')}}" name="Shipment[reciver_street_address_map]"  rel="receiver" value="" />
                                        <input type="hidden" class="form-control lat" data-receiver="lat" name="Shipment[reciver_lat]" />
                                        <input type="hidden" class="form-control lng" data-receiver="lng" name="Shipment[reciver_lng]" />
                                        <input type="hidden" class="form-control url" data-receiver="url" name="Shipment[reciver_url]" />

                                        <div class="mt-2 col-sm-12 map_canvas map-receiver" style="width:100%;height:300px;"></div>
                                        <span class="form-text text-muted">{{'Change the pin to select the right location'}}</span>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('From Country')}}:</label>
                                    <select id="change-country" name="Shipment[from_country_id]" class="form-control select-country">
                                        <option value=""></option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('To Country')}}:</label>
                                    <select id="change-country-to" name="Shipment[to_country_id]" class="form-control select-country">
                                        <option value=""></option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('From Region')}}:</label>
                                    <select id="change-state-from" name="Shipment[from_state_id]" class="form-control select-state">
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('To Region')}}:</label>
                                    <select id="change-state-to" name="Shipment[to_state_id]" class="form-control select-state">
                                        <option value=""></option>

                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('From Area')}}:</label>
                                    <select name="Shipment[from_area_id]" id="from_area_id" class="form-control select-area">
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('To Area')}}:</label>
                                    <select name="Shipment[to_area_id]" class="form-control select-area">
                                        <option value=""></option>

                                    </select>
                                </div>

                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Payment Type')}}:</label>
                                    <select class="form-control kt-select2 payment-type" id="payment_type" name="Shipment[payment_type]">
                                        <option @if(\App\ShipmentSetting::getVal('def_payment_type')=='1' ) selected @endif value="1">{{translate('Postpaid')}}</option>
                                        <option @if(\App\ShipmentSetting::getVal('def_payment_type')=='2' ) selected @endif value="2">{{translate('Prepaid')}}</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Payment Method')}}:</label>
                                    <select class="form-control kt-select2 payment-method" id="payment_method_id" name="Shipment[payment_method_id]">
                                        @forelse (\App\BusinessSetting::where("key","payment_gateway")->where("value","1")->get() as $gateway)
                                            <option value="{{$gateway->id}}" @if($gateway->id == 11) selected @endif>{{$gateway->name}}</option>
                                        @empty
                                            <option value="11">{{translate('Cash')}}</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Attachments')}}:</label>

                                    <div class="input-group " data-toggle="aizuploader" data-type="image" data-multiple="true">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="Shipment[attachments_before_shipping]" class="selected-files" value="{{old('Shipment[attachments_before_shipping]')}}" max="3">
                                    </div>
                                    <div class="file-preview">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Attachments After Shipping')}}:</label>

                                    <div class="input-group " data-toggle="aizuploader" data-type="image" data-multiple="true">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="Shipment[attachments_after_shipping]" class="selected-files" value="{{old('Shipment[attachments_after_shipping]')}}" max="3">
                                    </div>
                                    <div class="file-preview">
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <hr>

                        <div id="kt_repeater_1">
                            <div class="row" id="kt_repeater_1">
                                <h2 class="text-left">{{translate('Package Info')}}:</h2>
                                <div data-repeater-list="Package" class="col-lg-12">
                                    <div data-repeater-item class="row align-items-center" style="margin-top: 15px;padding-bottom: 15px;padding-top: 15px;border-top:1px solid #ccc;border-bottom:1px solid #ccc;">



                                        <div class="col-md-3">

                                            <label>{{translate('Package Type')}}:</label>
                                            <select class="form-control kt-select2 package-type-select" name="package_id">
                                                <option></option>
                                                @foreach($packages as $package)
                                                <option @if(\App\ShipmentSetting::getVal('def_package_type')==$package->id) selected @endif value="{{$package->id}}">{{$package->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="mb-2 d-md-none"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>{{translate('description')}}:</label>
                                            <input type="text" placeholder="{{translate('description')}}" class="form-control" name="description">
                                            <div class="mb-2 d-md-none"></div>
                                        </div>
                                        <div class="col-md-3">

                                            <label>{{translate('Quantity')}}:</label>

                                            <input class="kt_touchspin_qty" placeholder="{{translate('Quantity')}}" type="number" min="1" name="qty" class="form-control" value="1" />
                                            <div class="mb-2 d-md-none"></div>

                                        </div>

                                        <div class="col-md-3">

                                            <label>{{translate('Weight')}}:</label>

                                            <input type="number" min="1" placeholder="{{translate('Weight')}}" name="weight" class="form-control weight-listener kt_touchspin_weight" onchange="calcTotalWeight()" value="1" />
                                            <div class="mb-2 d-md-none"></div>

                                        </div>


                                        <div class="col-md-12" style="margin-top: 10px;">
                                            <label>{{translate('Dimensions [Length x Width x Height] (cm):')}}:</label>
                                        </div>
                                        <div class="col-md-2">

                                            <input class="dimensions_r" type="number" min="1" class="form-control" placeholder="{{translate('Length')}}" name="length" value="1" />

                                        </div>
                                        <div class="col-md-2">

                                            <input class="dimensions_r" type="number" min="1" class="form-control" placeholder="{{translate('Width')}}" name="width" value="1" />

                                        </div>
                                        <div class="col-md-2">

                                            <input class="dimensions_r" type="number" min="1" class="form-control " placeholder="{{translate('Height')}}" name="height" value="1" />

                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">

                                                <div>
                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger delete_item">
                                                        <i class="la la-trash-o"></i>{{translate('Delete')}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="">
                                    <label class="text-right col-form-label">{{translate('Add')}}</label>
                                    <div>
                                        <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                                            <i class="la la-plus"></i>{{translate('Add')}}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Amount to be Collected')}}:</label>
                                        <input id="kt_touchspin_3" placeholder="{{translate('Amount to be Collected')}}" type="text" min="0" class="form-control" value="0" name="Shipment[amount_to_be_collected]" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Delivery Time')}}:</label>
                                        <select class="form-control kt-select2 delivery-time" id="delivery_time" name="Shipment[delivery_time]">
                                            @foreach($deliveryTimes as $deliveryTime)
                                                <option value="{{$deliveryTime->name}}">{{translate($deliveryTime->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Total Weight')}}:</label>
                                        <input id="kt_touchspin_4" placeholder="{{translate('Total Weight')}}" type="text" min="1" class="form-control total-weight" value="1" name="Shipment[total_weight]" />
                                    </div>
                                </div>

                            </div>




                        </div>

                    </div>



                    {!! hookView('shipment_addon',$currentView) !!}

                    <div class="mb-0 text-right form-group">
                        <button type="button" class="btn btn-sm btn-primary" onclick="get_estimation_cost()">{{translate('Save')}}</button>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-primary d-none" data-toggle="modal" data-target="#exampleModalCenter" id="modal_open">
                            {{translate('Save')}}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{translate('Estimation Cost')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="text-left modal-body">
                                        <div class="row">
                                            @if($is_def_mile_or_fees=='2')
                                                <div class="col-6">{{translate('Shipping Cost')}} :</div>
                                                <div class="col-6" id="shipping_cost"></div>
                                            @elseif($is_def_mile_or_fees=='1')
                                                <div class="col-6">{{translate('Mile Cost')}} :</div>
                                                <div class="col-6" id="mile_cost"></div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-6">{{translate('Tax & Duty')}} :</div>
                                            <div class="col-6" id="tax_duty"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">{{translate('Insurance')}} :</div>
                                            <div class="col-6" id="insurance"></div>
                                        </div>
                                        <div class="row">
                                            @if(\App\ShipmentSetting::getVal('is_def_mile_or_fees')=='2')
                                                <div class="col-6">{{translate('Return Cost')}} :</div>
                                                <div class="col-6" id="return_cost"></div>
                                            @elseif(\App\ShipmentSetting::getVal('is_def_mile_or_fees')=='1')
                                                <div class="col-6">{{translate('Return Mile Cost')}} :</div>
                                                <div class="col-6" id="return_mile_cost"></div>
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6">{{translate('TOTAL COST')}} :</div>
                                            <div class="col-6" id="total_cost"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate('Close')}}</button>
                                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    // Map Address For Receiver
    $('.address-receiver').each(function(){
        var address = $(this);
        address.geocomplete({
            map: ".map_canvas.map-receiver",
            mapOptions: {
                zoom: 8,
                center: { lat: -34.397, lng: 150.644 },
            },
            markerOptions: {
                draggable: true
            },
            details: ".location-receiver",
            detailsAttribute: 'data-receiver',
            autoselect: true,
            restoreValueAfterBlur: true,
        });
        address.bind("geocode:dragged", function(event, latLng){
            $("input[data-receiver=lat]").val(latLng.lat());
            $("input[data-receiver=lng]").val(latLng.lng());
        });
    });

    // Map Address For Client
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

    {{-- function haversine_distance() {
      var R = 3958.8; // Radius of the Earth in miles
      var rlat1 = $("input[data-client=lat]").val() * (Math.PI/180); // Convert degrees to radians
      var rlat2 = $("input[data-receiver=lat]").val() * (Math.PI/180); // Convert degrees to radians
      var difflat = rlat2-rlat1; // Radian difference (latitudes)
      var difflon = ($("input[data-receiver=lng]").val()-$("input[data-client=lng]").val()) * (Math.PI/180); // Radian difference (longitudes)

      var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
      return d;

      var distance = haversine_distance();
      console.log(distance);
    } --}}

    // Get Addressess After Select Client
    function selectIsTriggered()
    {
         getAdressess(document.getElementById("client-id").value);
    }

    // Ajax Get Address With Cliet Id
    function getAdressess(client_id)
    {
        var id = client_id;

        $.get("{{route('admin.shipments.get-addressess-ajax')}}?client_id=" + id, function(data) {
            if(data.length != 0){
                $('select[name ="Shipment[client_address]"]').empty();
                $('select[name ="Shipment[client_address]"]').append('<option value=""></option>');
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    $('select[name ="Shipment[client_address]"]').append('<option value="' + element['id'] + '">' + element['address'] + '</option>');
                }

                $('.select-address').select2({
                    placeholder: "Choose Address",
                })
                @if($user_type == 'admin' || $user_type == 'customer' || in_array('1005', $staff_permission) )
                    .on('select2:open', () => {

                        $('.toRemoveLi').remove();

                        $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;' class='toRemoveLi'><a style="width: 100%" onclick="openAddressDiv()"
                            class="btn btn-primary" >+ {{translate('Add New Address')}}</a>
                            </li>`);
                    });
                @endif
            }else{
                $('select[name ="Shipment[client_address]"]').empty();
                $('.select-address').select2({
                    placeholder: "No Addressess Found",
                })
                @if($user_type == 'admin' || $user_type == 'customer' || in_array('1005', $staff_permission) )
                    .on('select2:open', () => {

                        $('.toRemoveLi').remove();

                        $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;' class='toRemoveLi'><a style="width: 100%" onclick="openAddressDiv()"
                            class="btn btn-primary" >+ {{translate('Add New Address')}}</a>
                            </li>`);
                    });
                @endif
            }
        });
    }

    // Ajax Get Address With Client logged in
    @if($user_type == 'customer')
        getAdressess({{$user_client}});
    @endif


    $('#client-addressess').change(function() {
        var id = $(this).val();
        $.get("{{route('client.get.one.address')}}?address_id=" + id, function(data) {
            $("#change-country").val(data[0]['country_id']).change();
            setTimeout(function(){
                $("#change-state-from").val(data[0]['state_id']).change();
                if(data[0]['area_id'] != null || data[0]['area_id'] != ""){
                    setTimeout(function(){
                        $("#from_area_id").val(data[0]['area_id']).change();
                     }, 800);
                }
             }, 800);
        });
    });

    // Ajax Add New Address For Client
    function AddNewClientAddress()
    {
        @if($user_type == 'customer')
            var id                    = {{$user_client}};
        @else
            var id                    = document.getElementById("client-id").value;
        @endif
        var address                   = document.getElementsByName("client_address")[0].value;
        var country = $('select[name ="country_id"]').val();
        var state = $('select[name ="state_id"]').val();
        var area = $('select[name ="area_id"]').val();

        @if($checked_google_map->value == 1)
            var client_street_address_map = document.getElementsByName("client_street_address_map")[0].value;
            var client_lat                = document.getElementsByName("client_lat")[0].value;
            var client_lng                = document.getElementsByName("client_lng")[0].value;
            var client_url                = document.getElementsByName("client_url")[0].value;
            if(address != "" || country != "" || state != "" )
            {
                $.post( "{{route('client.add.new.address')}}",
                {
                    client_id: parseInt(id),
                    address: address,
                    client_street_address_map: client_street_address_map,
                    client_lat: client_lat,
                    client_lng: client_lng,
                    client_url: client_url,
                    country: country,
                    state: state,
                    area: area
                } , function(data){
                    $('select[name ="Shipment[client_address]"]').empty();
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];
                        $('select[name ="Shipment[client_address]"]').append('<option value="' + element['address'] + '">' + element['address'] + '</option>');
                    }
                    document.getElementsByName("client_address")[0].value            = "";
                    document.getElementsByName("client_street_address_map")[0].value = "";
                });
            }
        @else
            if(address != "" || country != "" || state != "" )
            {
                $.post( "{{route('client.add.new.address')}}",
                {
                    client_id: parseInt(id),
                    address: address,
                    country: country,
                    state: state,
                    area: area
                } , function(data){
                    $('select[name ="Shipment[client_address]"]').empty();
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];
                        $('select[name ="Shipment[client_address]"]').append('<option value="' + element['address'] + '">' + element['address'] + '</option>');
                    }
                    document.getElementsByName("client_address")[0].value            = "";
                    var country = $('select[name ="country_id"]').val();
                    var state = $('select[name ="state_id"]').val();
                    var area = $('select[name ="area_id"]').val();
                });
            }
        @endif
    }

    function openAddressDiv()
    {
        $( "#show_address_div" ).slideDown( "slow", function() {
            // Animation complete.
        });
    }
    function closeAddressDiv()
    {
        $( "#show_address_div" ).slideUp( "slow", function() {
            // Animation complete.
        });
    }

    var inputs = document.getElementsByTagName('input');

    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type.toLowerCase() == 'number') {
            inputs[i].onkeydown = function(e) {
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8)) {
                    return false;
                }
            }
        }
    }

    $('.select-client').select2({
            placeholder: "Select Client",
        })
    @if($user_type == 'admin' || in_array('1005', $staff_permission) )
        .on('select2:open', () => {
            $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.clients.create')}}?redirect=admin.shipments.create"
                class="btn btn-primary" >+ {{translate('Add New Client')}}</a>
                </li>`);
        });
    @endif

    $('.select-client').change(function(){
        var client_phone = $(this).find(':selected').data('phone');
        document.getElementById("client_phone").value = client_phone;
    })

    $('.payment-method').select2({
        placeholder: "Payment Method",
    });

    $('.payment-type').select2({
        placeholder: "Payment Type",
    });



    $('.delivery-time').select2({
        placeholder: "Delivery Time",
    });

    $('.select-branch').select2({
            placeholder: "Select Branch",
    })
    @if($user_type == 'admin' || in_array('1006', $staff_permission) )
        .on('select2:open', () => {
            $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.branchs.create')}}?redirect=admin.shipments.create"
                class="btn btn-primary" >+ {{translate('Add New Branch')}}</a>
                </li>`);
        });
    @endif


    $('#change-country-client-address').change(function() {
        var id = $(this).val();
        $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
            $('select[name ="state_id"]').empty();
            $('select[name ="state_id"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
                const element = data[index];

                $('select[name ="state_id"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    $('#change-country').change(function() {
        var id = $(this).val();
        $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
            $('select[name ="Shipment[from_state_id]"]').empty();
            $('select[name ="Shipment[from_state_id]"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
                const element = data[index];

                $('select[name ="Shipment[from_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });

    $('#change-country-to').change(function() {
        var id = $(this).val();

        $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
            $('select[name ="Shipment[to_state_id]"]').empty();
            $('select[name ="Shipment[to_state_id]"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Shipment[to_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });

    $('#change-state-client-address').change(function() {
        var id = $(this).val();

        $.get("{{route('admin.shipments.get-areas-ajax')}}?state_id=" + id, function(data) {
            $('select[name ="area_id"]').empty();
            $('select[name ="area_id"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="area_id"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    $('#change-state-from').change(function() {
        var id = $(this).val();

        $.get("{{route('admin.shipments.get-areas-ajax')}}?state_id=" + id, function(data) {
            $('select[name ="Shipment[from_area_id]"]').empty();
            $('select[name ="Shipment[from_area_id]"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Shipment[from_area_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    $('#change-state-to').change(function() {
        var id = $(this).val();

        $.get("{{route('admin.shipments.get-areas-ajax')}}?state_id=" + id, function(data) {
            $('select[name ="Shipment[to_area_id]"]').empty();
            $('select[name ="Shipment[to_area_id]"]').append('<option value=""></option>');
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Shipment[to_area_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });

    function get_estimation_cost() {
        var total_weight = document.getElementById('kt_touchspin_4').value;
        var select_packages = document.getElementsByClassName('package-type-select');

        var from_country_id = document.getElementsByName("Shipment[from_country_id]")[0].value;
        var to_country_id = document.getElementsByName("Shipment[to_country_id]")[0].value;
        var from_state_id = document.getElementsByName("Shipment[from_state_id]")[0].value;
        var to_state_id = document.getElementsByName("Shipment[to_state_id]")[0].value;
        var from_area_id = document.getElementsByName("Shipment[from_area_id]")[0].value;
        var to_area_id = document.getElementsByName("Shipment[to_area_id]")[0].value;

        var package_ids = [];
        for (let index = 0; index < select_packages.length; index++) {
            if(select_packages[index].value){
                package_ids[index] = new Object();
                package_ids[index]["package_id"] = select_packages[index].value;
            }else{
                AIZ.plugins.notify('danger', '{{ translate('Please select package type') }} ' + (index+1));
                return 0;
            }
        }
        var request_data = { _token : '{{ csrf_token() }}',
                                package_ids : package_ids,
                                total_weight : total_weight,
                                from_country_id : from_country_id,
                                to_country_id : to_country_id,
                                from_state_id : from_state_id,
                                to_state_id : to_state_id,
                                from_area_id : from_area_id,
                                to_area_id : to_area_id,
                            };
        $.post('{{ route('admin.shipments.get-estimation-cost') }}', request_data, function(response){
            
            if({{$is_def_mile_or_fees}} =='2')
            {
                document.getElementById("shipping_cost").innerHTML = response.shipping_cost;
                document.getElementById("return_cost").innerHTML = response.return_cost;
            }else if({{$is_def_mile_or_fees}} =='1')
            {
                document.getElementById("mile_cost").innerHTML = response.shipping_cost;
                document.getElementById("return_mile_cost").innerHTML = response.return_cost;
            }
            document.getElementById("tax_duty").innerHTML = response.tax;
            document.getElementById("insurance").innerHTML = response.insurance;
            document.getElementById("total_cost").innerHTML = response.total_cost;
            document.getElementById('modal_open').click();
            console.log(response);
        });
    }

    function calcTotalWeight() {
        console.log('sds');
        var elements = $('.weight-listener');
        var sumWeight = 0;
        elements.map(function() {
            sumWeight += parseInt($(this).val());
            console.log(sumWeight);
        }).get();
        $('.total-weight').val(sumWeight);
    }
    $(document).ready(function() {

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

        $('.select-address').select2({
            placeholder: "Select Client First",
        })

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

        $('.select-country').trigger('change');
        $('.select-state').trigger('change');

        $('#kt_datepicker_3').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            startDate: new Date(),
        });
        $( document ).ready(function() {
            $('.package-type-select').select2({
                placeholder: "Package Type",
                language: {
                noResults: function() {
                    @if($user_type == 'admin' || in_array('1105', $staff_permission) )
                        return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.packages.create')}}?redirect=admin.shipments.create"
                        class="btn btn-primary" >Manage {{translate('Packages')}}</a>
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
        });


        //Package Types Repeater

        $('#kt_repeater_1').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();

                $('.package-type-select').select2({
                    placeholder: "Package Type",
                    language: {
                    noResults: function() {
                        @if($user_type == 'admin' || in_array('1105', $staff_permission) )
                            return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.packages.create')}}?redirect=admin.shipments.create"
                            class="btn btn-primary" >Manage {{translate('Packages')}}</a>
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

                $('.dimensions_r').TouchSpin({
                    buttondown_class: 'btn btn-secondary',
                    buttonup_class: 'btn btn-secondary',

                    min: 1,
                    max: 1000000000,
                    stepinterval: 50,
                    maxboostedstep: 10000000,
                    initval: 1,
                });

                $('.kt_touchspin_weight').TouchSpin({
                    buttondown_class: 'btn btn-secondary',
                    buttonup_class: 'btn btn-secondary',

                    min: 1,
                    max: 1000000000,
                    stepinterval: 50,
                    maxboostedstep: 10000000,
                    initval: 1,
                    prefix: 'Kg'
                });
                $('.kt_touchspin_qty').TouchSpin({
                    buttondown_class: 'btn btn-secondary',
                    buttonup_class: 'btn btn-secondary',

                    min: 1,
                    max: 1000000000,
                    stepinterval: 50,
                    maxboostedstep: 10000000,
                    initval: 1,
                });
                calcTotalWeight();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });


        $('body').on('click', '.delete_item', function(){
            $('.total-weight').val("{{translate('Calculated...')}}");
            setTimeout(function(){ calcTotalWeight(); }, 500);
        });
        $('#kt_touchspin_2, #kt_touchspin_2_2').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '%'
        });
        $('#kt_touchspin_3').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 0,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '{{currency_symbol()}}'
        });
        $('#kt_touchspin_4').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 1,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            initval: 1,
            prefix: 'Kg'
        });
        $('.kt_touchspin_weight').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 1,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            initval: 1,
            prefix: 'Kg'
        });
        $('.kt_touchspin_qty').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 1,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            initval: 1,
        });
        $('.dimensions_r').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 1,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            initval: 1,
        });


        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {
                    "Shipment[type]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[shipping_date]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[branch_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[client_id]": {
                        validators: {
                            callback: {
                                message: '{{translate("This is required!")}}',
                                callback: function(input) {
                                    // Get the selected options
                                    if ((input.value !== "")) {
                                        $('.client-select').removeClass('has-errors');
                                    } else {
                                        $('.client-select').addClass('has-errors');
                                    }
                                    return (input.value !== "");
                                }
                            }
                        }
                    },
                    "Shipment[client_address]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[client_phone]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[payment_type]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[payment_method_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[tax]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[insurance]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[shipping_cost]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[delivery_time]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[delivery_time]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[total_weight]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[from_country_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[to_country_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[reciver_name]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[reciver_phone]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[reciver_address]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Package[0][package_id]": {
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
                        valid: '',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh',
                    }),
                }
            }
        );
    });
</script>
@endsection
