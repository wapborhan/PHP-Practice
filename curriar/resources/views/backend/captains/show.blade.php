@extends('backend.layouts.app')
@php
    $captain_wallet   = App\Transaction::where('captain_id' , $captain->id)->sum('value');
    $captain_wallet   = abs($captain_wallet);
    
    $captain_missions = App\Mission::where('captain_id' , $captain->id)->count();
@endphp

@section('sub_title'){{$captain->name}}@endsection
@section('subheader')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{$captain->name}}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-5">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('View Driver') }}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                    <a href="{{route('admin.captains.edit',['captain'=>$captain->id])}}" class="btn btn-light-primary font-weight-bolder btn-sm"> {{translate('Edit')}}</a>
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <!--begin::Details-->
                <div class="d-flex mb-9">
                    <!--begin: Pic-->
                    <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                        <div class="symbol symbol-50 symbol-lg-60">
                            <img src="@if($captain->img){{uploaded_asset($captain->img)}} @else {{ static_asset('assets/img/avatar-place.png') }} @endif" alt="image" />
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between flex-wrap mt-1">
                            <div class="d-flex mr-3">
                                <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$captain->name}}</a>
                                <a href="#">
                                    <i class="flaticon2-correct text-success font-size-h5"></i>
                                </a>
                            </div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap justify-content-between mt-1">
                            <div class="d-flex flex-column flex-grow-1 pr-8">
                                <div class="d-flex flex-wrap mb-4">
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <i class="la la-user mr-2 font-size-lg"></i>{{$captain->email}}</a>
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <i class="la la-mobile mr-2 font-size-lg"></i>{{$captain->responsible_mobile}}</a>
                                </div>
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
                <div class="separator separator-solid"></div>
                <!--begin::Items-->
                <div class="d-flex align-items-center flex-wrap mt-8">
                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="flaticon-piggy-bank display-4 text-muted font-weight-bold"></i>
                        </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">{{translate('Wallet')}}</span>
                            <span class="font-weight-bolder font-size-h5">{{format_price($captain_wallet)}}</span>
                        </div>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="flaticon-chat-1 display-4 text-muted font-weight-bold"></i>
                        </span>
                        <div class="d-flex flex-column">
                            <span class="text-dark-75 font-weight-bolder font-size-sm">{{$captain_missions }} {{translate('Missions')}}</span>
                            <a href="" class="text-primary font-weight-bolder">{{translate('View all')}}</a>
                        </div>
                    </div>
                    <!--end::Item-->
                </div>
                <!--begin::Items-->
            </div>
        </div>
        <!--end::Card-->
        <!--begin::Row-->
        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card card-custom card-stretch">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">{{translate('Custody')}}</h3>
                        </div>
                    </div>
                    <div class="card-body">


                        <table class="table mb-0 aiz-table">
                            <thead>
                                <tr>
                                    
                                    <th>{{translate('Code')}}</th>
                                    <th>{{translate('Status')}}</th>
                                    <th>{{translate('Type')}}</th>
                                    <th>{{translate('Customer')}}</th>
                                    <th>{{translate('Branch')}}</th>
                                    <th>{{translate('Shipping Cost')}}</th>
                                    <th>{{translate('Payment Method')}}</th>
                                    <th>{{translate('Shipping Date')}}</th>

                                </tr>
                            </thead>
                            <tbody>

                                    @foreach($shipments as $key=>$shipment)

                                        <tr>
                                            
                                            <td width="5%"><a href="{{route('admin.shipments.show',$shipment->id)}}">{{$shipment->barcode}}</a></td>
                                            <td>{{$shipment->getStatus()}}</td>
                                            <td>{{$shipment->type}}</td>
                                            <td><a href="{{route('admin.clients.show',$shipment->client_id)}}">{{$shipment->client->name}}</a></td>
                                            <td><a href="{{route('admin.branchs.show',$shipment->branch_id)}}">{{$shipment->branch->name}}</a></td>
                                            <td>{{format_price($shipment->shipping_cost)}}</td>
                                            <td>{{$shipment->pay->name}}</td>
                                            <td>{{$shipment->shipping_date}}</td>

                                        </tr>

                                    @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
                <!--end::Card-->

            </div>
        </div>

        @yield('profile')
    </div>
</div>

@endsection

@section('modal')
@include('modals.delete_modal')
@endsection