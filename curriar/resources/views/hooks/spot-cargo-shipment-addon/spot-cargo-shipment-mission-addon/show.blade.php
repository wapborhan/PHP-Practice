@php
    $user_type = Auth::user()->user_type;
    $staff_permission = json_decode(Auth::user()->staff->role->permissions ?? "[]");
@endphp

<div class="px-8 py-8 row justify-content-center py-md-10 px-md-0">
    <div class="col-9 row">
        <div class="col-6">
            <h1 class="mb-10 display-4 font-weight-boldest">{{translate('Mission Shipments')}}</h1>
        </div>
        @if($data['reschedule'])
            <div class="text-right col-6">
                <!-- Button trigger modal -->
                <button type="button" class="px-3 btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="modal_open">
                    {{translate('Reschedule')}}
                </button>
            
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{translate('Reschedule')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.missions.reschedule') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$data['mission']->id}}">
                                <div class="text-left modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{translate('Reason')}}:</label>
                                                
                                                <select name="reason" class="form-control captain_id kt-select2">
                                                    @foreach ($data['reasons'] as $reason)
                                                        <option value="{{$reason->id}}">{{$reason->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{translate('Due Date')}}:</label>
                                                <input type="text" id="kt_datepicker_3" autocomplete="off" class="form-control"  name="due_date"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate('Close')}}</button>
                                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="col-md-9">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="pl-0 font-weight-bold text-muted text-uppercase">{{translate('Code')}}</th>
                        <th class=" font-weight-bold text-muted text-uppercase">{{translate('Status')}}</th>
                        <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Type')}}</th>
                        <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Branch')}}</th>
                        <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Customer')}}</th>
                        <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Payment Type')}}</th>
                        <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Total Cost')}}</th>
                        <th class="text-center font-weight-bold text-muted text-uppercase no-print">{{translate('Actions')}}</th>
                        <th class="text-center font-weight-bold text-muted text-uppercase print-only">{{translate('Check')}}</th>
                    </tr>
                </thead>
                <tbody>
                   
                @foreach(\App\ShipmentMission::where('mission_id',$data['mission']->id)->get() as $shipment_mission)
                    <tr class="font-weight-boldest @if(in_array($shipment_mission->shipment->status_id ,[\App\Shipment::RETURNED_STATUS,\App\Shipment::RETURNED_STOCK,\App\Shipment::RETURNED_CLIENT_GIVEN])) table-danger @endif">
                        @if($user_type == 'admin' || in_array('1100', $staff_permission) || in_array('1005', $staff_permission) )
                            <td class="pl-5 pt-7"><a href="{{route('admin.shipments.show', ['shipment'=>$shipment_mission->shipment->id])}}">{{$shipment_mission->shipment->code}}</a></td>
                        @else
                            <td class="pl-5 pt-7">{{$shipment_mission->shipment->code}}</td>
                        @endif
                        <td class="pl-5 pt-7">{{$shipment_mission->shipment->getStatus()}}</td>
                        <td class="text-right pt-7">{{$shipment_mission->shipment->type}}</td>
                        <td class="text-right pt-7">{{$shipment_mission->shipment->branch->name}}</td>
                        <td class="text-right  pt-7">{{$shipment_mission->shipment->client->name}}</td>
                        <td class="text-right  pt-7">{{translate($shipment_mission->shipment->pay['name'])}} ({{$shipment_mission->shipment->getPaymentType()}})</td>
                        <td class="text-right  pt-7">{{format_price(convert_price($shipment_mission->shipment->tax + $shipment_mission->shipment->shipping_cost + $shipment_mission->shipment->insurance)) }}</td>
                        <td class="pr-5 text-right text-danger pt-7 no-print">
                            @if(in_array($shipment_mission->mission->status_id , [\App\Mission::APPROVED_STATUS,\App\Mission::REQUESTED_STATUS,\App\Mission::RECIVED_STATUS]))
                                <!-- Button trigger modal -->
                                <button type="button" class="px-3 btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter2" id="modal_open_delete_shipment" onclick="set_shipment_id({{$shipment_mission->shipment->id}})">
                                    {{translate('Remove From')}} {{$data['mission']->code}}
                                </button>
                            @else
                                {{translate('No actions')}}
                            @endif
                        </td>
                        <td class="text-center print-only"><input type="checkbox" class="form-control" /></td>
                    </tr>
                @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter2Title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{translate('Remove From')}} {{$data['mission']->code}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.shipments.delete-shipment-from-mission') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="mission_id" value="{{$data['mission']->id}}">
                <input type="hidden" name="shipment_id" id="delete_shipment_id" value="">
                <div class="text-left modal-body">
                    @isset($data['reasons'])
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{translate('Reason')}}:</label>
                                
                                <select name="reason" class="form-control captain_id kt-select2" required>
                                    @foreach ($data['reasons'] as $reason)
                                        <option value="{{$reason->id}}">{{$reason->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endisset
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate('Close')}}</button>
                    <button type="submit" class="btn btn-danger btn-sm">{{translate('Remove')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function set_shipment_id(shipment_id){
        document.getElementById('delete_shipment_id').value = shipment_id;
    }
</script>