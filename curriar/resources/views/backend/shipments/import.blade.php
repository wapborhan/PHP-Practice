@extends('backend.layouts.app')

@section('sub_title'){{translate('Import CSV')}}@endsection


@section('subheader')
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">{{ translate('Import CSV') }}</h5>
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
                            <a href="#" class="text-muted">{{ translate('Import CSV') }}</a>
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
    $branchs   = \App\Branch::where('is_archived', 0)->get();
    $paymentsGateway = \App\BusinessSetting::where("key","payment_gateway")->where("value","1")->get();

@endphp
@section('content')

    <div class="col-lg-12 mb-5 mx-auto">

        <div class="alert alert-danger" role="alert">
            {{translate('Please: Be sure shipments have right client and branch')}}.
        </div>

        <div class="card">
            <div class="card-header">
                <h5 style="display: inline;">{{translate('Shipment CSV Import')}}</h5>

                <a href="{{ static_asset('import_shipment.csv') }}" target="_blank" style="float: right;" class="btn btn-sm btn-primary">{{translate('Download CSV')}}</a>

            </div>
            <div class="card-body">
                <form class="form-horizontal" id="kt_form_1" action="{{ route('admin.shipments.import_parse') }}" method="POST" enctype="multipart/form-data">
                	@csrf

                    <div class="form-group">
                        <label>{{translate('Columns')}}:</label>
                        <select class="form-control selectpicker" name="columns[]" multiple required>
                            <option value="type" selected>type</option>
                            <option value="branch_id" selected>branch_id</option>
                            <option value="shipping_date" selected>shipping_date</option>
                            <option value="client_phone" selected>client_phone</option>
                            <option value="client_address" selected>client_address</option>
                            <option value="reciver_name" selected>reciver_name</option>
                            <option value="reciver_phone" selected>reciver_phone</option>
                            <option value="reciver_address" selected>reciver_address</option>
                            <option value="from_country_id" selected>from_country_id</option>
                            <option value="to_country_id" selected>to_country_id</option>
                            <option value="from_state_id" selected>from_state_id</option>
                            <option value="to_state_id" selected>to_state_id</option>
                            <option value="from_area_id" selected>from_area_id</option>
                            <option value="to_area_id" selected>to_area_id</option>
                            <option value="payment_type" selected>payment_type</option>
                            <option value="payment_method_id" selected>payment_method_id</option>
                            <option value="attachments_before_shipping" selected>attachments_before_shipping</option>
                            <option value="package_id" selected>package_id</option>

                            <option value="description" selected>description</option>
                            <option value="qty" selected>qty</option>
                            <option value="weight" selected>weight</option>
                            <option value="length" selected>length</option>
                            <option value="width" selected>width</option>
                            <option value="height" selected>height</option>

                            <option value="amount_to_be_collected" selected>amount_to_be_collected</option>
                        </select>

                        @if ($errors->has('columns'))
                            <span class="help-block">
                                <strong>{{ $errors->first('columns') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('shipments_file') ? ' has-error' : '' }}">
                        <label for="shipments_file" class="col-md-12 control-label">{{translate('CSV file to import')}}</label>

                        <div class="col-md-12">
                            <input id="shipments_file" type="file" class="form-control" name="shipments_file" required>

                            @if ($errors->has('shipments_file'))
                                <span class="help-block">
                                <strong>{{ $errors->first('shipments_file') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Parse CSV')}}</button>
                    </div>
                </form>
            </div>
        </div>


    </div>

    <div class="col-lg-12 table-responsive table-custom-container mb-4">
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
                    <td>{{translate('type')}}</td>
                    <td>
                        <span class="badge badge-danger">{{translate('Required')}}</span>
                    </td>
                    <td>{{translate('Pickup = 1 / Drop off = 2')}}</td>
                    <td>{{translate('1 / 2')}}</td>
                </tr>
                <tr>
                    <td>{{translate('branch_id')}}</td>
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
                    <td>{{translate('shipping_date')}}</td>
                    <td>
                        <span class="badge badge-danger">{{translate('Required')}}</span>
                    </td>
                    <td>{{translate('YYYY/MM/DD')}}</td>
                    <td>{{translate('2021/01/22')}}</td>
                </tr>
                <tr>
                    <td>{{translate('client_phone')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>{{translate('Default is your phone')}}</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>{{translate('client_address')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>{{translate('Default is your address')}}</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>{{translate('reciver_name')}}</td>
                    <td>
                        <span class="badge badge-danger">{{translate('Required')}}</span>
                    </td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>{{translate('reciver_phone')}}</td>
                    <td>
                        <span class="badge badge-danger">{{translate('Required')}}</span>
                    </td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>{{translate('reciver_address')}}</td>
                    <td>
                        <span class="badge badge-danger">{{translate('Required')}}</span>
                    </td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>{{translate('from_country_id')}}</td>
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
                    <td>{{translate('to_country_id')}}</td>
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
                    <td>{{translate('from_state_id')}}</td>
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
                    <td>{{translate('to_state_id')}}</td>
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
                    <td>{{translate('from_area_id')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>{{translate('to_area_id')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>{{translate('payment_type')}}</td>
                    <td>
                        <span class="badge badge-danger">{{translate('Required')}}</span>
                    </td>
                    <td>{{translate('Postpaid = 1 / Prepaid = 2')}}</td>
                    <td>1 / 2</td>
                </tr>
                <tr>
                    <td>{{translate('payment_method_id')}}</td>
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
                    <td>{{translate('attachments_before_shipping')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>{{translate('package_id')}}</td>
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
                    <td>{{translate('description')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>{{translate('qty')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>{{translate('Default is 1')}}</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>{{translate('weight')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>{{translate('Default is 1')}}</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>{{translate('length')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>{{translate('Default is 1')}}</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>{{translate('width')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>{{translate('Default is 1')}}</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>{{translate('height')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>{{translate('Default is 1')}}</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>{{translate('amount_to_be_collected')}}</td>
                    <td>
                        <span class="badge badge-info">{{translate('Optional')}}</span>
                    </td>
                    <td>{{translate('Default is 0')}}</td>
                    <td>0</td>
                </tr>
            </tbody>
            </table>
    </div>



@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            FormValidation.formValidation(
                document.getElementById('kt_form_1'), {
                    fields: {
                        "shipments_file": {
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
