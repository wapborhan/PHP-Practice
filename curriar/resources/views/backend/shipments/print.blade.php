<?php 
use \Milon\Barcode\DNS1D;
$d = new DNS1D();
?>

@php
                        $code = filter_var($shipment->code, FILTER_SANITIZE_NUMBER_INT);
                    @endphp
@extends('backend.layouts.app')

@section('content')

<style media="print">
    .no-print, div#kt_header_mobile, div#kt_header, div#kt_footer{
        display: none;
    }
</style>
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!-- begin::Card-->
        <div class="overflow-hidden card card-custom">
            <div class="p-0 card-body">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="px-8 py-8 row justify-content-center py-md-27 px-md-0">
                    <div class="col-md-9">
                        <div class="pb-10 d-flex justify-content-between pb-md-20 flex-column flex-md-row">
                            <h1 class="mb-10 display-4 font-weight-boldest">
                                @if(get_setting('system_logo_white') != null)
                                    <img src="{{ uploaded_asset(get_setting('system_logo_white')) }}" class="mb-5 d-block">
                                @else
                                    <img src="{{ static_asset('assets/img/logo.svg') }}" class="mb-5 d-block">
                                @endif
                                {{translate('INVOICE')}}
                            </h1>
                            <div class="px-0 d-flex flex-column align-items-md-end">
                                <!--begin::Logo-->
                                <a href="#">
                                    @if($shipment->barcode != null)
                                        @php
                                            echo '<img src="data:image/png;base64,' . $d->getBarcodePNG($shipment->code, "C128") . '" alt="barcode"   />';
                                        @endphp
                                    @endif
                                </a>
                                <!--end::Logo-->
                                <span class="d-flex flex-column align-items-md-end opacity-70">
                                    <br />
                                    <span><span class="font-weight-bolder">{{translate('FROM')}}:</span> {{$shipment->client_address}}</span>
                                    <span><span class="font-weight-bolder">{{translate('TO')}}:</span> {{$shipment->reciver_address}}</span>
                                </span>
                            </div>
                        </div>
                        <div class="border-bottom w-100"></div>
                        <div class="pt-6 d-flex justify-content-between">
                            <div class="d-flex flex-column flex-root">
                                <span class="mb-2 font-weight-bolder d-block">{{translate('DATE')}}<span>
                                <span class="opacity-70 d-block">{{ $shipment->created_at->format('Y-m-d') }}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="mb-2 font-weight-bolder">{{translate('SHIPMENT CODE')}}</span>
                                <span class="opacity-70">{{$shipment->code}}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="mb-2 font-weight-bolder">{{translate('INVOICE TO')}}</span>
                                <span class="opacity-70">{{$shipment->reciver_address}}.
                                <br />{{$shipment->reciver_name}}.
                                <br />{{$shipment->reciver_phone}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice body-->
                <div class="px-8 py-8 row justify-content-center py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">{{translate('Package Items')}}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Qty')}}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Type')}}</th>
                                        <th class="pr-0 text-right font-weight-bold text-muted text-uppercase">{{translate('Weight x Length x Width x Height')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach(\App\PackageShipment::where('shipment_id',$shipment->id)->get() as $package)

                                        <tr class="font-weight-boldest">
                                            <td class="pl-0 border-0 pt-7 d-flex align-items-center">{{$package->description}}</td>
                                            <td class="text-right align-middle pt-7">{{$package->qty}}</td>
                                            <td class="text-right align-middle pt-7">@if(isset($package->package->name)){{$package->package->name}} @else - @endif</td>
                                            <td class="pr-0 text-right align-middle text-primary pt-7">{{$package->weight." ".translate('KG')." x ".$package->length." ".translate('CM')." x ".$package->width." ".translate('CM')." x ".$package->height." ".translate('CM')}}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice body-->
                <!-- begin: Invoice footer-->
                <div class="px-8 py-8 bg-gray-100 row justify-content-center py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold text-muted text-uppercase">{{translate('PAYMENT TYPE')}}</th>
                                        <th class="font-weight-bold text-muted text-uppercase">{{translate('PAYMENT STATUS')}}</th>
                                        <th class="font-weight-bold text-muted text-uppercase">{{translate('PAYMENT DATE')}}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('TOTAL COST')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="font-weight-bolder">
                                        <td>{{translate($shipment->pay['name'])}} ({{$shipment->getPaymentType()}})</td>
                                        <td>@if($shipment->paid == 1) {{translate('Paid')}} @else {{translate('Pending')}} @endif</td>
                                        <td>@if($shipment->paid == 1) {{$shipment->payment->payment_date ?? ""}} @else - @endif</td>
                                        <td class="text-right text-primary font-size-h3 font-weight-boldest">{{format_price($shipment->tax + $shipment->shipping_cost + $shipment->insurance) }}<br /><span class="text-muted font-weight-bolder font-size-lg">{{translate('Included tax & insurance')}}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice footer-->
                <!-- begin: Invoice action-->
                <div class="px-8 py-8 row justify-content-center py-md-10 px-md-0 no-print">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">{{translate('Print Invoice')}}</button>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice action-->
                <!-- end: Invoice-->
            </div>
        </div>
        <!-- end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
@endsection
@section('script')
<script>
window.onload = function() {
	javascript:window.print();
};
</script>
@endsection