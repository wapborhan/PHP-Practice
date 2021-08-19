<?php
use \Milon\Barcode\DNS1D;
$d = new DNS1D();
?>
@extends('backend.layouts.app')


@section('sub_title'){{translate('Shipment')}} {{$shipment->code}}@endsection
@section('subheader')
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">{{translate('Shipment')}} {{$shipment->code}}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{$shipment->code}}</a>
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


<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="p-0 card-body">
        <!-- begin: Invoice-->
        <!-- begin: Invoice header-->
        <div class="px-8 py-8 row justify-content-center pt-md-27 px-md-0">
            <div class="col-md-10">
                <div class="pb-10 d-flex justify-content-between pb-md-20 flex-column flex-md-row">
                    <h1 class="mb-10 display-4 font-weight-boldest">{{translate('Shipment')}}: {{$shipment->code}}</h1>
                    <div class="px-0 d-flex flex-column align-items-md-end">
                        <span class="d-flex flex-column align-items-md-end opacity-70">
                            @if($shipment->barcode != null)
                                <span class="mb-5 font-weight-bolder"><?=$d->getBarcodeHTML($shipment->code, "C128");?></span>
                            @endif
                            <span><span class="font-weight-bolder">{{translate('FROM')}}:</span> {{$shipment->client_address}}</span>
                            <span><span class="font-weight-bolder">{{translate('TO')}}:</span> {{$shipment->reciver_address}}</span>
                        </span>
                    </div>
                </div>

                <div class="pb-6 d-flex justify-content-between">
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-4 text-dark font-weight-bold">{{translate('Customer/Sender')}}</span>
                        <a class="text-danger font-weight-boldest font-size-lg" href="{{route('admin.clients.show',$shipment->client_id)}}">{{$shipment->client->name}}</a>
                        <span class="text-muted font-size-md">{{$shipment->client_phone}}</span>
                        <span class="text-muted font-size-md">{{$shipment->client_address}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-4 text-dark font-weight-bold">{{translate('Receiver')}}</span>
                        <span class="text-danger font-weight-boldest font-size-lg">{{$shipment->reciver_name}}</span>
                        <span class="text-muted font-size-md">{{$shipment->reciver_phone}}</span>
                        <span class="text-muted font-size-md">{{$shipment->reciver_address}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-4 text-dark font-weight-bold">{{translate('Status')}}</span>
                        <span class="opacity-70 d-block">{{$shipment->getStatus()}}</span>
                    </div>
                    @if ($shipment->amount_to_be_collected && $shipment->amount_to_be_collected  > 0)
                        <div class="d-flex flex-column flex-root">
                            <span class="mb-4 text-dark font-weight-bold">{{translate('Amount To Collected')}}</span>
                            <span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->amount_to_be_collected)}}</span>
                        </div>
                    @endif
                </div>
                <div class="border-bottom w-100"></div>
                <div class="pt-6 d-flex justify-content-between">
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-2 font-weight-bolder">{{translate('Shipment type')}}</span>
                        <span class="opacity-70">{{$shipment->type}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-2 font-weight-bolder">{{translate('Current branch')}}</span>
                        <a class="opacity-70" href="{{route('admin.branchs.show',$shipment->branch_id)}}">{{$shipment->branch->name}}</a>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-2 font-weight-bolder">{{translate('Created date')}}</span>
                        <span class="opacity-70">{{$shipment->created_at->format('Y-m-d h:i:s')}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-2 font-weight-bolder">{{translate('Shipping date')}}</span>
                        <span class="opacity-70">{{$shipment->shipping_date}}</span>
                    </div>
                </div>


                <div class="pt-6 d-flex justify-content-between">
                    @if ($shipment->prev_branch)
                        <div class="d-flex flex-column flex-root">
                            <span class="mb-2 font-weight-bolder">{{translate('Previous Branch')}}</span>
                            <span class="opacity-70">{{\App\Branch::find($shipment->prev_branch)->name}}</span>
                        </div>
                    @endif
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-4 text-dark font-weight-bold">{{translate('Total Weight')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->total_weight}} {{translate('KG')}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-4 text-dark font-weight-bold">{{translate('Shipping Cost')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->shipping_cost)}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-4 text-dark font-weight-bold">{{translate('Tax &  Duty')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->tax)}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-4 text-dark font-weight-bold">{{translate('Insurance')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->insurance)}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-4 text-dark font-weight-bold">{{translate('Return Cost')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->return_cost)}}</span>
                    </div>
                </div>

                <div class="pt-6 d-flex justify-content-between">
                    <div class="d-flex flex-column flex-root">
                            <span class="mb-4 text-dark font-weight-bold">{{translate('From Country')}}</span>
                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->from_country->name)){{$shipment->from_country->name}} @endif </span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                            <span class="mb-4 text-dark font-weight-bold">{{translate('To Country')}}</span>
                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->to_country->name)){{$shipment->to_country->name}} @endif </span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                            <span class="mb-4 text-dark font-weight-bold">{{translate('From Ragion')}}</span>
                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->from_state->name)){{$shipment->from_state->name}} @endif </span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                            <span class="mb-4 text-dark font-weight-bold">{{translate('To Ragion')}}</span>
                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->to_state->name)){{$shipment->to_state->name}} @endif </span>
                    </div>
                </div>


                <div class="pt-6 d-flex justify-content-between">
                    <div class="d-flex flex-column flex-root">
                        <span class="mb-4 text-dark font-weight-bold">{{translate('Max Delivery Days')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->delivery_time}}</span>
                    </div>
                    @if($shipment->captain_id != null)
                        <div class="d-flex flex-column flex-root">
                            <span class="mb-4 text-dark font-weight-bold">{{translate('Driver')}}</span>
                            <a class="text-danger font-weight-boldest font-size-lg" href="{{route('admin.clients.show',$shipment->client_id)}}">{{$shipment->captain->name}} </a>
                        </div>
                    @endif
                    @if ($shipment->mission_id != null)
                        <div class="d-flex flex-column flex-root">
                            <span class="mb-4 text-dark font-weight-bold">{{translate('Mission')}}</span>
                            <a class="text-muted font-weight-bolder font-size-lg" href="{{route('admin.missions.show',$shipment->mission_id)}}">{{$shipment->current_mission->code}}</a>
                        </div>
                    @endif
                </div>
                @if($shipment->attachments_before_shipping)
                    <div class="pt-6 d-flex justify-content-between">
                        <div class="d-flex flex-column flex-root">
                            <span class="mb-4 text-dark font-weight-bold">{{translate('Attachments')}} <span class="text-muted font-size-xs">({{translate('ADDED WHEN SHIPMENT CREATED')}})</span></span>
                            <div class="pt-6 d-flex justify-content-between">
                                @foreach(explode(',', $shipment->attachments_before_shipping) as $img)
                                    <div class="d-flex flex-column flex-root">
                                        <span class="text-muted font-weight-bolder font-size-lg">
                                            <a href="{{uploaded_asset($img)}}" target="_blank"><img src="{{uploaded_asset($img)}}" alt="image" style="max-width:100px" /></a>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif


            </div>
        </div>
        <!-- end: Invoice header-->
        <!-- begin: Invoice body-->
        <div class="px-8 py-8 row justify-content-center py-md-10 px-md-0">
            <div class="col-md-10">
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
        <div class="px-8 py-8 mx-0 bg-gray-100 row justify-content-center py-md-10 px-md-0">
            <div class="col-md-10">
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
        <div class="px-8 py-8 row justify-content-center py-md-10 px-md-0">
            <div class="col-md-10">
                <div class="d-flex justify-content-between">
                    @if($shipment->paid == 0 && $shipment->pay['id'] != 11)
                        <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST" id="checkout-form">
                            @csrf
                            <input type="hidden" name="shipment_id" value="{{$shipment->id}}">
                            <button type="submit" class="mr-3 btn btn-success btn-md">{{translate('Pay Now')}} <i class="ml-2 far fa-credit-card"></i></button>
                        </form>
                        <button class="btn btn-success btn-sm " onclick="copyToClipboard('#payment-link')">{{translate('Copy Payment Link')}}<i class="ml-2 fas fa-copy"></i></button>
                        <div id="payment-link" style="display: none">{{route('admin.shipments.pay', $shipment->id)}}</div>
                    @endif

                    <a href="{{route('admin.shipments.print', array($shipment->id, 'label'))}}" class="btn btn-light-primary font-weight-bold" target="_blank">{{translate('Print Label')}}<i class="ml-2 la la-box-open"></i></a>
                    <a href="{{route('admin.shipments.print', array($shipment->id, 'invoice'))}}" class="btn btn-light-primary font-weight-bold" target="_blank">{{translate('Print Invoice')}}<i class="ml-2 la la-file-invoice-dollar"></i></a>

                    @if(Auth::user()->user_type == 'admin' || in_array('1104', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                    <a href="{{route('admin.shipments.edit', $shipment->id)}}" class="px-6 py-3 btn btn-light-info btn-sm font-weight-bolder font-size-sm">{{translate('Edit Shipment')}}</a>
                    @endif
                </div>
            </div>
        </div>
        <!-- end: Invoice action-->
        <!-- end: Invoice-->
    </div>
</div>
<!--end::Card-->


<!--end::List Widget 19-->
@if((Auth::user()->user_type == 'admin' || in_array('1102', json_decode(Auth::user()->staff->role->permissions ?? "[]"))) && !empty($shipment->logs->toArray()))
    <div class="card card-custom card-stretch card-stretch-half gutter-b">
        <!--begin::List Widget 19-->

        <!--begin::Header-->
        <div class="pt-6 mb-2 border-0 card-header">
            <h3 class="card-title align-items-start flex-column">
                <span class="mb-3 card-label font-weight-bold font-size-h4 text-dark-75">{{translate('Shipment Status Log')}}</span>

            </h3>
            <div class="card-toolbar">

            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="pt-2 card-body" style="padding-bottom: 0;overflow:hidden">
            <div class="mt-3 timeline timeline-6 scroll scroll-pull" style="overflow:hidden" data-scroll="true" data-wheel-propagation="true">

            @foreach($shipment->logs()->orderBy('id','desc')->get() as $log)
                <!--begin::Item-->
                <div class="timeline-item align-items-start">
                    <!--begin::Label-->
                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{$log->created_at->diffForHumans()}}</div>
                    <!--end::Label-->

                    <!--begin::Badge-->
                    <div class="timeline-badge">
                        <i class="fa fa-genderless text-warning icon-xl"></i>
                    </div>
                    <!--end::Badge-->

                    <!--begin::Text-->
                    <div class="pl-3 font-weight-mormal font-size-lg timeline-content text-muted">
                        {{translate('Changed from')}}: "{{\App\Shipment::getStatusByStatusId($log->from)}}" {{translate('To')}}: "{{\App\Shipment::getStatusByStatusId($log->to)}}"
                    </div>
                    <!--end::Text-->

                </div>
                <!--end::Item-->

            @endforeach


            </div>
        </div>
    </div>
@endif

@endsection

@section('modal')
@include('modals.delete_modal')
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            AIZ.plugins.notify('success', '{{translate("Payment Link Copied")}}');
        }
    </script>
@endsection