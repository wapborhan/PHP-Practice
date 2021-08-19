@extends('backend.layouts.app')

@section('content')
<style>
    label {
        font-weight: bold !important;
    }
</style>
<div class="mx-auto col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Shipping General Settings')}}</h5>
        </div>

        <form class="form-horizontal" action="{{ route('admin.shipments.settings.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf


            <div class="card-body">
                <div class="mt-3 form-group row">

                    <div class="col-lg-3">
                        <div class="form-group row">
                            <label class=" col-form-label">{{translate('Enable Shippment Calc In Website')}}</label>
                            <div class="col-12 col-form-label">
                                <div class="radio-inline">
                                    <label class="radio radio-success">

                                        <input name="Setting[is_shipping_calc_required]" @if(\App\ShipmentSetting::getVal('is_shipping_calc_required')=='1' || \App\ShipmentSetting::getVal('is_shipping_calc_required')==null) checked @endif value="1" type="radio" class="form-control" />
                                        <span></span>
                                        {{translate('Yes')}}
                                    </label>
                                    <label class="radio radio-danger">
                                        <input name="Setting[is_shipping_calc_required]" @if(\App\ShipmentSetting::getVal('is_shipping_calc_required')=='0' ) checked @endif value="0" type="radio" class="form-control" />
                                        <span></span>
                                        {{translate('No')}}
                                    </label>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-3 form-group row">

                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right">{{translate('Default Count for dashboard Latest shipment widget')}}:</label>

                            <select  class="form-control kt-select2 latest_shipment_count"  name="Setting[latest_shipment_count]">
                                <option @if(\App\ShipmentSetting::getVal('latest_shipment_count')== '5') selected @endif  value="5">5</option>
                                <option @if(\App\ShipmentSetting::getVal('latest_shipment_count')== '10' || \App\ShipmentSetting::getVal('latest_shipment_count') == null) selected @endif  value="10">10</option>
                                <option @if(\App\ShipmentSetting::getVal('latest_shipment_count')== '15') selected @endif  value="15">15</option>
                                <option @if(\App\ShipmentSetting::getVal('latest_shipment_count')== '20') selected @endif  value="20">20</option>
                                <option @if(\App\ShipmentSetting::getVal('latest_shipment_count')== '30') selected @endif  value="30">30</option>
                                <option @if(\App\ShipmentSetting::getVal('latest_shipment_count')== '50') selected @endif  value="50">50</option>
                                <option @if(\App\ShipmentSetting::getVal('latest_shipment_count')== '100') selected @endif  value="100">100</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="my-10 separator separator-dashed"></div>

                <div class="mt-3 form-group row">

                    <div class="col-lg-3">
                        <div class="form-group row">
                            <label class=" col-form-label">{{translate('Enable Shipping date')}}</label>
                            <div class="col-12 col-form-label">
                                <div class="radio-inline">
                                    <label class="radio radio-success">

                                        <input name="Setting[is_date_required]" @if(\App\ShipmentSetting::getVal('is_date_required')=='1' || \App\ShipmentSetting::getVal('is_date_required')==null) checked @endif value="1" type="radio" class="form-control" />
                                        <span></span>
                                        {{translate('Yes')}}
                                    </label>
                                    <label class="radio radio-danger">
                                        <input name="Setting[is_date_required]" @if(\App\ShipmentSetting::getVal('is_date_required')=='0' ) checked @endif value="0" type="radio" class="form-control" />
                                        <span></span>
                                        {{translate('No')}}
                                    </label>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class="col-form-label text-lg-right">{{translate('Defult Shipping date')}}:</label>

                        <select  class="form-control kt-select2 def_shipping_date"  name="Setting[def_shipping_date]">
                            <option>{{translate('Choose')}}</option>
                            <option @if(\App\ShipmentSetting::getVal('def_shipping_date') == 0 ) selected @endif  value="0">{{translate('Same day')}}</option>
                            <option @if(\App\ShipmentSetting::getVal('def_shipping_date')== 1 ) selected @endif  value="1">{{translate('Next day')}}</option>
                            @for ($i = 2; $i <= 30; $i++)
                                <option @if(\App\ShipmentSetting::getVal('def_shipping_date')== $i ) selected @endif  value="{{ $i }}">{{translate('After '.$i.' days')}}</option>
                            @endfor
                        </select>

                    </div>

                </div>

                <div class="my-10 separator separator-dashed"></div>

                <div class="form-group row">

                    <div class="col-lg-6">
                        <label class="col-form-label text-lg-right">{{translate('Shipment Prefix')}}:</label>
                        <input type="text" class="form-control" @if (\App\ShipmentSetting::getVal('shipment_prefix') == null ) value="SH" @else value="{{\App\ShipmentSetting::getVal('shipment_prefix')}}" @endif name="Setting[shipment_prefix]" />
                    </div>
                    <div class="col-lg-6">
                        <label class="col-form-label text-lg-right">{{translate('Shipment Number of digits in the tracking')}}:</label>
                        <input type="text" class="form-control" @if (\App\ShipmentSetting::getVal('shipment_code_count') == null ) value="5" @else  value="{{\App\ShipmentSetting::getVal('shipment_code_count')}}" @endif name="Setting[shipment_code_count]" />
                    </div>

                </div>

                <div class="my-10 separator separator-dashed"></div>

                <div class="form-group row">

                    <div class="col-lg-6">
                        <label class="col-form-label text-lg-right">{{translate('Mission Prefix')}}:</label>
                        <input type="text" class="form-control" @if (\App\ShipmentSetting::getVal('mission_prefix') == null ) value="MI" @else value="{{\App\ShipmentSetting::getVal('mission_prefix')}}" @endif name="Setting[mission_prefix]" />
                    </div>
                    <div class="col-lg-6">
                        <label class="col-form-label text-lg-right">{{translate('Mission Number of digits in the tracking')}}:</label>
                        <input type="text" class="form-control" @if (\App\ShipmentSetting::getVal('mission_code_count') == null ) value="7" @else value="{{\App\ShipmentSetting::getVal('mission_code_count')}}" @endif name="Setting[mission_code_count]" />
                    </div>

                </div>

                <div class="my-10 separator separator-dashed"></div>

                <div class="form-group row">

                    <label class="col-2 col-form-label">{{translate('Default Shipment Type')}}</label>
                    <div class="col-9 col-form-label">
                        <div class="radio-inline">
                            <label class="radio radio-success btn btn-default">
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_type')=='1' ) checked @endif type="radio" name="Setting[def_shipment_type]" checked="checked" value="1" />
                                <span></span>
                                {{translate("Pickup (For door to door delivery)")}}
                            </label>
                            <label class="radio radio-success btn btn-default">
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_type')=='2' ) checked @endif type="radio" name="Setting[def_shipment_type]" value="2" />
                                <span></span>
                                {{translate("Drop off (For delivery package from branch directly)")}}
                            </label>
                        </div>

                    </div>

                </div>

                <div class="my-10 separator separator-dashed"></div>

                <div class="form-group row">

                    <label class="col-2 col-form-label">{{translate('Default Shipment Code Number Type')}}</label>
                    <div class="col-9 col-form-label">
                        <div class="radio-inline">
                            <label class="radio radio-success btn btn-default">
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_code_type')=='sequential' ) checked @endif type="radio" name="Setting[def_shipment_code_type]" checked="checked" value="sequential" />
                                <span></span>
                                {{translate("Sequential")}}
                            </label>
                            <label class="radio radio-success btn btn-default"> 
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_code_type')=='random' ) checked @endif type="radio" name="Setting[def_shipment_code_type]" value="random" />
                                <span></span>
                                {{translate("Random (Recommended, for security)")}}
                            </label>
                        </div>

                    </div>

                </div>

                <div class="my-10 separator separator-dashed"></div>

                <div class="form-group row">

                    <label class="col-2 col-form-label">{{translate('Receiving Mission Confirmation Type')}}</label>
                    <div class="col-9 col-form-label">
                        <div class="radio-inline">
                            <label class="radio radio-success btn btn-default">
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_conf_type')=='seg' ) checked @endif type="radio" name="Setting[def_shipment_conf_type]" value="seg" />
                                <span></span>
                            {{translate('Customer Signature')}}
                            </label>
                            <label class="radio radio-success btn btn-default">
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_conf_type')=='otp' ) checked @endif type="radio" name="Setting[def_shipment_conf_type]" value="otp" />
                                <span></span>
                                {{translate('OTP')}}
                            </label>
                            <label class="radio radio-success btn btn-default">
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_conf_type')=='none' ) checked @endif type="radio" name="Setting[def_shipment_conf_type]" value="none" />
                                <span></span>
                                {{translate('Without Confirmation')}}
                            </label>
                        </div>

                    </div>

                </div>


                <div class="my-10 separator separator-dashed"></div>

                <div class="form-group row">

                    <div class="col-lg-3">
                        <label class="col-form-label text-lg-right">{{translate('Default Package Type')}}:</label>
                        <select  class="form-control kt-select2 def_package_type" id="select-how" name="Setting[def_package_type]">
                            @foreach(\App\Package::all() as $package)
                            <option @if(\App\ShipmentSetting::getVal('def_package_type')== $package->id) selected @endif  value="{{$package->id}}">{{$package->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="col-form-label text-lg-right">{{translate('Default Branch')}}:</label>
                        <select class="form-control kt-select2 def_branch" name="Setting[def_branch]">
                            @foreach(\App\Branch::where('is_archived',0)->get() as $branch)
                            <option @if(\App\ShipmentSetting::getVal('def_branch')== $branch->id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">

                            <label class="col-form-label text-lg-right">{{translate('Default Payment Type')}}:</label>
                            <select class="form-control kt-select2 def_payment_type" name="Setting[def_payment_type]">


                                <option @if(\App\ShipmentSetting::getVal('def_payment_type')== '1') selected @endif value="1">{{translate('Postpaid')}}</option>
                                <option @if(\App\ShipmentSetting::getVal('def_payment_type')== '2') selected @endif  value="2">{{translate('Prepaid')}}</option>


                            </select>


                    </div>
                    <div class="col-md-3">

                            <label class="col-form-label text-lg-right">{{translate('Default Payment Method')}}:</label>
                            <select class="form-control kt-select2 def_payment_method" name="Setting[def_payment_method]">
                                <option @if(\App\ShipmentSetting::getVal('def_payment_method')== '1') selected @endif  value="1">{{translate('Cash')}}</option>
                                <option @if(\App\ShipmentSetting::getVal('def_payment_method')== '2') selected @endif value="2">{{translate('Paypal')}}</option>
                            </select>

                    </div>
                </div>
                {!! hookView('shipment_addon',$currentView) !!}
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-lg btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </div>


        </form>

    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">

    $('.def_shipping_date').select2({
        placeholder: "Defult Shipping Date",
    });

    $('.latest_shipment_count').select2({
        placeholder: "Latest Shipment Count",
    });

    $('.def_payment_type').select2({
        placeholder: "Defult Payment Type",
    });

    $('.def_payment_method').select2({
        placeholder: "Defult Payment Method",
    });

    $('.def_branch').select2({
        placeholder: 'Defult Branch',
        language: {
          noResults: function() {
            return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.branchs.create')}}?redirect=admin.shipments.settings"
              class="btn btn-primary" >Manage {{translate('Branchs')}}</a>
              </li>`;
          },
        },
        escapeMarkup: function(markup) {
          return markup;
        },
    });

    $('.def_package_type').select2({
        placeholder: 'Defult Backage Type',
        language: {
          noResults: function() {
            return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.packages.create')}}?redirect=admin.shipments.settings"
              class="btn btn-primary" >Manage {{translate('Backages')}}</a>
              </li>`;
          },
        },
        escapeMarkup: function(markup) {
          return markup;
        },
    });

    $(document).ready(function() {
        $('.datepicker').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            startDate: new Date(),
        });
        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {


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
