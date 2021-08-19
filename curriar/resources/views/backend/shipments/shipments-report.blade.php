@extends('backend.layouts.app')

@php
    $user_type = Auth::user()->user_type;
@endphp

@section('content')

<div class="mt-2 mb-3 text-left aiz-titlebar">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('Shipments Report')}}</h1>
        </div>
       
    </div>
</div>

<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="flex-wrap py-3 card-header">
        <div class="card-title">
            <h3 class="card-label">
                {{$page_name}}
            </h3>
        </div>
       
    </div>

    <div class="card-body">
        <!--begin::Search Form-->
        <form method="POST" action="{{route('admin.shipments.post.report')}}" >
        @csrf
        <div class="mb-7">
            <div class="row align-items-center">
                
                    <div class="col-lg-12 col-xl-12">
                        <div class="row align-items-center">
                            
                            
                                    @if($user_type == 'customer')
                                        @php
                                            $user  = App\Client::where('id',Auth::user()->userClient->client_id)->first();
                                        @endphp
                                        <input type="hidden" name="client_id" value="{{$user->id}}" />
                                    @else
                                    <div class="my-2 col-md-4 my-md-0">
                                        <div class="d-flex align-items-center">
                                            <label class="mb-0 mr-3 d-none d-md-block">{{translate('Customer')}}:</label>
                                            <select name="client_id" class="form-control client" id="kt_datatable_search_status">
                                                <option value="">{{translate('All')}}</option>
                                                @foreach(\App\Client::where('is_archived',0)->get() as $client)
                                                <option @if(isset($_POST['client_id']) && $_POST['client_id'] == $client->id)  selected @endif value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                
                            <div @if($user_type == 'customer') class="my-2 col-md-8 my-md-0" @else class="my-2 col-md-4 my-md-0" @endif>
                                <div class="d-flex align-items-center">
                                    <label class="mb-0 mr-3 d-none d-md-block">{{translate('Type')}}:</label>
                                    <select name="type" class="form-control type" >
                                        <option value="">All</option>
                                        @if($type == null || $type == \App\Shipment::PICKUP)
                                        <option @if(isset($_POST['type']) && $_POST['type'] == \App\Shipment::PICKUP)  selected @endif value="{{\App\Shipment::PICKUP}}">{{translate('Pickup')}}</option>
                                        @endif
                                        @if($type == null || $type == \App\Shipment::DROPOFF)
                                        <option @if(isset($_POST['type']) && $_POST['type'] == \App\Shipment::DROPOFF)  selected @endif value="{{\App\Shipment::DROPOFF}}">{{translate('Dropoff')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row align-items-center">
                            
                            <div class="my-2 col-md-4 my-md-5">
                                <div class="d-flex align-items-center">
                                    <label class="mb-0 mr-3 d-none d-md-block">{{translate('Branch')}}:</label>
                                    <select name="branch_id" class="form-control branch" id="kt_datatable_search_type">
                                    <option value="">{{translate('All')}}</option>
                                        @foreach(\App\Branch::where('is_archived',0)->get() as $Branch)
                                        <option @if(isset($_POST['branch_id']) && $_POST['branch_id'] == $Branch->id)  selected @endif value="{{$Branch->id}}">{{$Branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="my-2 col-md-4 my-md-5">
                                <div class="d-flex align-items-center">
                                    <label class="mb-0 mr-3 d-none d-md-block">{{translate('Status')}}:</label>
                                    <select name="status" class="form-control status">
                                    <option value="">{{translate('All')}}</option>
                                        @foreach(\App\Shipment::status_info() as $status_info)
                                        <option @if(isset($_POST['status']) && $_POST['status'] == $status_info['status'])  selected @endif value="{{$status_info['status']}}">{{$status_info['text']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            
                            <div class="my-2 col-md-4 my-md-5">
                                <div class="d-flex align-items-center">
                                    <label class="mb-0 mr-3 d-none d-md-block">{{translate('From Date')}}:</label>
                                    <input type="text" name="from_date" value="<?php if(isset($_POST['from_date'])){echo $_POST['from_date'];}?>" class="form-control datepicker" placeholder="{{translate('Created From Date')}}" id="kt_datatable_search_query" />
                                </div>
                            </div>
                            <div class="my-2 col-md-4 my-md-5">
                                <div class="d-flex align-items-center">
                                    <label class="mb-0 mr-3 d-none d-md-block">{{translate('From Date')}}:</label>
                                    <input type="text" name="to_date" value="<?php if(isset($_POST['to_date'])){echo $_POST['to_date'];}?>" class="form-control datepicker" placeholder="{{translate('Created To Date')}}" id="kt_datatable_search_query" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 col-lg-3 col-xl-4 mt-lg-0">
                        <button type="submit" class="px-6 btn btn-light-primary font-weight-bold">{{translate('Get Report')}}</button>
                        <input type="submit" class="px-6 btn btn-light-primary font-weight-bold" name="excel" value="{{translate('Export Excel Sheet')}}" />
                    </div>
                
            </div>
            </form>

            <form id="tableForm">
            @csrf()
            <table class="table mb-0 aiz-table">
                <thead>
                    <tr>
                       
                        <th width="3%">#</th>
                        <th>{{translate('Code')}}</th>
                        <th>{{translate('Status')}}</th>
                        <th>{{translate('Type')}}</th>
                        <th>{{translate('Customer')}}</th>
                        <th>{{translate('Branch')}}</th>

                        <th>{{translate('Shipping Cost')}}</th>
                        <th>{{translate('Payment Method')}}</th>
                        <th>{{translate('Shipping Date')}}</th>
                        @if($status == \App\Shipment::CAPTAIN_ASSIGNED_STATUS || $status == \App\Shipment::RECIVED_STATUS)
                        <th>{{translate('Driver')}}</th>
                        @endif
                        @if($status == \App\Shipment::APPROVED_STATUS || $status == \App\Shipment::CAPTAIN_ASSIGNED_STATUS || $status == \App\Shipment::RECIVED_STATUS)
                        <th>{{translate('Mission')}}</th>
                        @endif
                        <th class="text-center">{{translate('Created At')}}</th>
                      
                    </tr>
                </thead>
                <tbody>

                    @foreach($shipments as $key=>$shipment)

                    <tr>
                        <td width="3%">{{ ($key+1) + ($shipments->currentPage() - 1)*$shipments->perPage() }}</td>
                        <td width="5%">D{{$shipment->code}}</td>
                        <td><a href="">{{$shipment->getStatus()}}</a></td>
                        <td>{{$shipment->type}}</td>
                        <td><a href="{{route('admin.clients.show',$shipment->client_id)}}">{{$shipment->client->name}}</a></td>
                        <td><a href="{{route('admin.branchs.show',$shipment->branch_id)}}">{{$shipment->branch->name}}</a></td>

                        <td>{{$shipment->shipping_cost}}</td>
                        <td>{{$shipment->payment_method}}</td>
                        <td>{{$shipment->shipping_date}}</td>
                        @if($status == \App\Shipment::CAPTAIN_ASSIGNED_STATUS || $status == \App\Shipment::RECIVED_STATUS)


                        <td>@isset($shipment->captain_id) {{$shipment->captain->name}} @endisset</td>


                        @endif
                        @if($status == \App\Shipment::APPROVED_STATUS || $status == \App\Shipment::CAPTAIN_ASSIGNED_STATUS || $status == \App\Shipment::RECIVED_STATUS )

                        <td> @isset($shipment->current_mission->id) M {{$shipment->current_mission->code}} @endisset</td>

                        @endif
                        <td class="text-center">
                        {{$shipment->created_at->format('Y-m-d')}}
                        </td>
                       
                    </tr>

                    @endforeach

                </tbody>
            </table>

     

        </form>
        </div>
        <!--end::Search Form-->
      
    </div>
</div>
{!! hookView('shipment_addon',$currentView) !!}

@endsection

@section('modal')
@include('modals.delete_modal')
@endsection

@section('script')
<script type="text/javascript">
$('.datepicker').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
          
        });
    function openCaptainModel(element, e) {
        var selected = [];
        $('.sh-check:checked').each(function() {
            selected.push($(this).data('clientid'));
        });
        if(selected.length == 1)
        {
            $('#tableForm').attr('action', $(element).data('url'));
            $('#tableForm').attr('method', $(element).data('method'));
            $('#assign-to-captain-modal').modal('toggle');
        }else if(selected.length == 0)
        {
            Swal.fire("{{translate('Please Select Shipments')}}", "", "error");
        }else if(selected.length > 1)
        {
            
            Swal.fire("{{translate('Select shipments of the same client to Assign')}}", "", "error");
        }
    }

    function openAssignShipmentCaptainModel(element, e) {
        var selected = [];
        $('.sh-check:checked').each(function() {
            selected.push($(this).data('clientid'));
        });
        if(selected.length == 1)
        {
            $('#tableForm').attr('action', $(element).data('url'));
            $('#tableForm').attr('method', $(element).data('method'));
            $('#assign-to-captain-modal').modal('toggle');
        }else if(selected.length == 0)
        {
            Swal.fire("{{translate('Please Select Shipments')}}", "", "error");
        }else if(selected.length > 1)
        {
            
            Swal.fire("{{translate('Select shipments of the same client to Assign')}}", "", "error");
        }
    }

    $('.type').select2({
        placeholder: "Type",
    });

    $('.status').select2({
        placeholder: "Status",
    });

    $('.branch').select2({
        placeholder: 'Branch',
        language: {
          noResults: function() {
            return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.branchs.create')}}"
              class="btn btn-primary" >Manage {{translate('Branchs')}}</a>
              </li>`;
          },
        },
        escapeMarkup: function(markup) {
          return markup;
        },
    });

    $('.client').select2({
        placeholder: 'Client',
        language: {
          noResults: function() {
            return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.clients.create')}}"
              class="btn btn-primary" >Manage {{translate('Customers')}}</a>
              </li>`;
          },
        },
        escapeMarkup: function(markup) {
          return markup;
        },
    });

    $(document).ready(function() {
        $('.action-caller').on('click', function(e) {
            e.preventDefault();
            $('#tableForm').attr('action', $(this).data('url'));
            $('#tableForm').attr('method', $(this).data('method'));
            $('#tableForm').submit();
        });

    });
</script>

@endsection