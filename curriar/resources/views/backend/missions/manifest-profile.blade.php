@extends('backend.layouts.app')
@section('style')
    <link href="{{asset('public/assets/dragula/dragula.css')}}" rel="stylesheet">
    <style>
        tr{
            cursor: move !important;
        }
    </style>
@endsection

@section('content')

<style>
    .print-only{
        display: none;
    }
</style>
<style media="print">
    .print-only{
        display: block;
    }
    .no-print, div#kt_header_mobile, div#kt_header, div#kt_footer{
        display: none;
    }
</style>
<!--begin::Entry-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!-- begin::Card-->
        <div class="card card-custom overflow-hidden">
            <div class="card-body p-0">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="row justify-content-center py-8 px-8 pt-md-27 px-md-0">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <h1 class="display-4 font-weight-boldest mb-10">
                                @if(get_setting('system_logo_white') != null)
                                    <img src="{{ uploaded_asset(get_setting('system_logo_white')) }}" class="d-block mb-5">
                                @else
                                    <img src="{{ static_asset('assets/img/logo.svg') }}" class="d-block mb-5">
                                @endif
                                {{translate('MANIFEST MISSIONS')}}
                            </h1>
                            <div class="d-flex flex-column align-items-md-end px-0">
                                <span class="d-flex flex-column align-items-md-end opacity-70">
                                    <br />
                                    <span><span class="font-weight-bolder">{{translate('MANIFEST DATE')}}: @if(isset($due_date)) {{$due_date}} @else {{now()->format('Y-m-d')}} @endif</span> </span>
                                    <span><span class="font-weight-bolder">{{translate('FOR Driver')}}:</span> {{$captain->name}}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice body-->

                <div class="px-8 py-8 row justify-content-center pb-md-10 px-md-0">

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="3%"></th>
                                        <th>{{translate('Code')}}</th>
                                        <th>{{translate('Type')}}</th>
                                        <th>{{translate('Amount')}}</th>
                                        <th>{{translate('Address')}}</th>
                                        <th></th>


                                    </tr>
                                </thead>
                                <tbody id="profile_manifest">

                                    @foreach($missions as $key=>$mission)

                                    <tr data-missionid="{{$mission->id}}" class="mission" style="background-color:tomatom">
                                        <td></td>
                                        <td width="5%">{{$mission->code}}</td>
                                        <td>{{$mission->type}}</td>
                                        @php
                                            $helper = new \App\Http\Helpers\TransactionHelper();
                                            $mission_cost = $helper->calcMissionShipmentsAmount($mission->getOriginal('type'),$mission->id);
                                        @endphp
                                        <td>{{format_price($mission_cost)}}</td>
                                        <td>{{$mission->address}}</td>
                                        <td>
                                            <div style="width: 30px;height: 30px;border: 1px solid;border-radius: 3px;"></div>
                                        </td>

                                       
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice body-->
                <!-- begin: Invoice action-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 no-print">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">{{translate('Print Manifest')}}</button>
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
@section('modal')
@include('modals.delete_modal')
@endsection

@section('script')
    <script src="{{asset('public/assets/dragula/dragula.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        dragula([document.getElementById('profile_manifest')]).on('drop', function (el, container, source) {
            if(container){
                var missions = container.getElementsByClassName('mission');
                var missions_order = [];
                for (let index = 0; index < missions.length; index++) {
                    missions_order.push(missions[index].dataset.missionid);
                }
                $.ajax({
                    url:'{{ route("admin.missions.manifests.order") }}',
                    type:'POST',
                    data:  { _token: AIZ.data.csrf, missions_ids:missions_order},
                    dataTy:'json',
                    success:function(response){
                    },
                    error: function(returnval) {
                        // console.log(returnval);
                    }
                });
            }
        });
    </script>
@endsection