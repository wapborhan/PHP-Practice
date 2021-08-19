@extends('backend.layouts.app')

@section('sub_title'){{translate('Create Shipment By API')}}@endsection


@section('subheader')
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">{{ translate('Create Shipment By API') }}</h5>
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
                            <a href="#" class="text-muted">{{ translate('Create Shipment By API') }}</a>
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


<style type="text/css">
	.card-header {
        background-color: #fcfcfc !important;
        padding:0px !important;
    }

    .btn-link {
        color: #2b2b2b !important;
    }
    .card-body{
        padding: 1.25rem !important;
    }

    label {
        display: inline-block !important;
        margin-bottom: .5rem !important;
    }

    .gray{
        background-color: #f7f7f7 !important;
    }

    .badge-info {
        color: hsla(188, 60%, 30%, 1) !important;
        background-color: #bbeff7 !important;
    }
    .badge-danger {
        color: hsla(354, 70%, 35%, 1) !important;
        background-color: hsla(354, 70%, 85%, 1) !important;
    }

    table {
        border: 2px solid #f2f2f2 !important;
    }

    th{
        font-size: 1.2rem !important;
        padding: 1.6rem !important;
    }

    td{
        font-size: 78% !important;
        padding: 1.6rem !important;
    }

    tr:hover td {
        background-color: #f7f7f7 !important ;    
    }
    p{
        cursor: pointer;
    }

</style>
@php
    $countries = \App\Country::where('covered',1)->get();
    $states    = \App\State::where('covered',1)->get();
    $packages  = \App\Package::all();
    $paymentsGateway = \App\BusinessSetting::where("key","payment_gateway")->where("value","1")->get();
@endphp
@section('content')
    <div id="accordion">
        <div class="card">
            <div class="card-header bg-gray-50 p-2" id="headingOne">
                <h5 class="mb-0">
                    <button style="font-weight: 600;" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        {{translate('Add a new shipment')}}
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label>{{translate('Endpoint')}}</label>
                        <div class="card gray border-0">
                            <div class="card-body gray border-0">
                                <span class="badge badge-info mr-3">Post</span>
                                <span id="base_url" class="text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-custom-container mb-4">
                        <table class="table table-hover ">
                            <thead style="background-color: #f7f7f7;">
                                <tr>
                                    <th scope="col">{{translate('Parameters')}}</th>
                                    <th scope="col">{{translate('Details')}}</th>
                                    <th scope="col">{{translate('Description')}}</th>
                                    <th scope="col">{{translate('Value')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{translate('auth-token')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>
                                        <b>{{translate('NOTE')}}:</b> {{translate('Send it in the header')}}
                                        <p>    
                                            <u><b onClick="generate_token()">{{translate('Click To ReGenerate auth-token')}}</b></u>
                                        </p>
                                    </td>
                                    <td>
                                        <div style="width:270px" title="{{translate('Copy')}}">
                                            <p style="display: inline; padding-right:3px" onClick="copy()" id="auth-token">{{Auth::user()->api_token}}</p><b style="cursor: pointer;" onClick="copy()" id="copy">{{translate('Copy')}}</b>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[type]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>{{translate('Pickup = 1 / Drop off = 2')}}</td>
                                    <td>{{translate('1 / 2')}}</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[branch_id]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#branchs">    
                                            <u><b>{{translate('Click To Get The ID')}}</b></u>
                                        </p>

                                        <!-- The Modal -->
                                        <div class="modal" id="branchs">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{translate('Branchs')}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{translate('Name')}}</th>
                                                                    <th scope="col">{{translate('Value')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($branchs as $branch)
                                                                <tr>
                                                                    <td>{{$branch->name}}</td>
                                                                    <td>{{$branch->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{translate('Noting found')}}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach($branchs as $branch)
                                            {{$branch->id}} /
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[shipping_date]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>{{translate('YYYY/MM/DD')}}</td>
                                    <td>{{translate('2021/01/22')}}</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[client_phone]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>{{translate('Default is your phone')}}</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[client_address]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>{{translate('Default is your address')}}</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[reciver_name]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[reciver_phone]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[reciver_address]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[from_country_id]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#countries">    
                                            <u><b>{{translate('Click To Get The ID')}}</b></u>
                                        </p>
                                        
                                        <!-- The Modal -->
                                        <div class="modal" id="countries">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{translate('Countries')}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{translate('Name')}}</th>
                                                                    <th scope="col">{{translate('Value')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($countries as $countrie)
                                                                <tr>
                                                                    <td>{{$countrie->name}}</td>
                                                                    <td>{{$countrie->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{translate('Noting found')}}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{translate('ID')}} ({{translate('Example')}}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[to_country_id]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#countries">    
                                            <u><b>{{translate('Click To Get The ID')}}</b></u>
                                        </p>
                                    </td>
                                    <td>
                                        {{translate('ID')}} ({{translate('Example')}}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[from_state_id]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#states">    
                                            <u><b>{{translate('Click To Get The ID')}}</b></u>
                                        </p>
                                        
                                        <!-- The Modal -->
                                        <div class="modal" id="states">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{translate('States')}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{translate('Name')}}</th>
                                                                    <th scope="col">{{translate('Value')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($states as $state)
                                                                <tr>
                                                                    <td>{{$state->name}}</td>
                                                                    <td>{{$state->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{translate('Noting found')}}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{translate('ID')}} ({{translate('Example')}}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[to_state_id]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#states">    
                                            <u><b>{{translate('Click To Get The ID')}}</b></u>
                                        </p>
                                    </td>
                                    <td>
                                    {{translate('ID')}} ({{translate('Example')}}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[from_area_id]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[to_area_id]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[payment_type]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>{{translate('Postpaid = 1 / Prepaid = 2')}}</td>
                                    <td>1 / 2</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[payment_method_id]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#payments">    
                                            <u><b>{{translate('Click To Get The ID')}}</b></u>
                                        </p>
                                        
                                        <!-- The Modal -->
                                        <div class="modal" id="payments">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{translate('Payment Method')}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{translate('Name')}}</th>
                                                                    <th scope="col">{{translate('Value')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($paymentsGateway as $payment)
                                                                <tr>
                                                                    <td>{{$payment->name}}</td>
                                                                    <td>{{$payment->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{translate('Noting found')}}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{translate('ID')}} ({{translate('Example')}}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[attachments_before_shipping]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Package[package_index][package_id]')}}</td>
                                    <td>
                                        <span class="badge badge-danger">{{translate('Required')}}</span>
                                    </td>
                                    <td>
                                        <p data-toggle="modal" data-target="#packages">    
                                            <u><b>{{translate('Click To Get The ID')}}</b></u>
                                        </p>
                                        
                                        <!-- The Modal -->
                                        <div class="modal" id="packages">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{translate('Packages')}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{translate('Name')}}</th>
                                                                    <th scope="col">{{translate('Value')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($packages as $package)
                                                                <tr>
                                                                    <td>{{$package->name}}</td>
                                                                    <td>{{$package->id}}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="2">{{translate('Noting found')}}!</td>
                                                                </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{translate('ID')}} ({{translate('Example')}}: 1)
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{translate('Package[package_index][description]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Package[package_index][qty]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>{{translate('Default is 1')}}</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Package[package_index][weight]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>{{translate('Default is 1')}}</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Package[package_index][length]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>{{translate('Default is 1')}}</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Package[package_index][width]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>{{translate('Default is 1')}}</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Package[package_index][height]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>{{translate('Default is 1')}}</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>{{translate('Shipment[amount_to_be_collected]')}}</td>
                                    <td>
                                        <span class="badge badge-info">{{translate('Optional')}}</span>
                                    </td>
                                    <td>{{translate('Default is 0')}}</td>
                                    <td>0</td>
                                </tr>
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    var base_url = window.location.origin;
    base_url = base_url + '/api/admin/shipments/create';
    document.getElementById("base_url").textContent = base_url ;

    function generate_token()
    {
        document.getElementById("auth-token").textContent = "{{translate('Generating...')}}"
        $.get("{{route('admin.shipments.generate-token')}}", function(data) {
            document.getElementById("auth-token").textContent = data;
            copy();
        });   
    }

    function copy() {
        document.getElementById("copy").textContent = "{{translate('copied')}}";
        var r = document.createRange();
        r.selectNode(document.getElementById("auth-token"));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(r);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();  
        setTimeout(function(){
            document.getElementById("copy").textContent = "{{translate('Copy')}}";
        }, 800);
    }

</script>
@endsection