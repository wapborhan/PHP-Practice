@extends('backend.layouts.app')
@php
    $user_type = Auth::user()->user_type;
    $staff_permission = json_decode(Auth::user()->staff->role->permissions ?? "[]");
@endphp

@section('sub_title'){{translate('Missions')}}@endsection
@section('subheader')
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">{{translate('Missions')}}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Missions') }}</a>
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
@php
    $auth_user = Auth::user();
@endphp
<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="flex-wrap py-3 card-header">
        <div class="card-title">
            <h3 class="card-label">
                {{$page_name}}
            </h3>
        </div>
        @if(count($actions) > 0)
        <div class="card-toolbar" id="actions-button">
            <!--begin::Dropdown-->
            <div class="mr-2 dropdown dropdown-inline">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>{{translate('Actions')}}</button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="py-2 navi flex-column navi-hover">
                        <li class="pb-2 navi-header font-weight-bolder text-uppercase font-size-sm text-primary">{{translate('Choose an option:')}}</li>

                        <li class="navi-item">
                        @php
                            $action_counter = 0;
                        @endphp
                        @foreach($actions as $action)
                            @if(in_array($auth_user->user_type ,$action['user_role']) || in_array($action['permission'] ?? "", json_decode($auth_user->staff->role->permissions ?? "[]")) )
                                    @if($action['index'] == true)
                                    @php
                                        $action_counter++;
                                    @endphp
                                    <a href="#" class="navi-link @if(!isset($action['js_function_caller'])) action-caller @endif" @if(isset($action['js_function_caller'])) onclick="{{$action['js_function_caller']}}"  @endif data-url="{{$action['url']}}" data-method="{{$action['method']}}">
                                        <span class="navi-icon">
                                            <i class="{{$action['icon']}}"></i>
                                        </span>
                                        <span class="navi-text">{{$action['title']}}</span>
                                    </a>
                                    @endif
                                @endif
                            @endforeach
                        </li>

                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->
        </div>
        @if($action_counter == 0)
            <script>
                document.getElementById("actions-button").style.display = "none";
            </script>
        @endif
        @endif
    </div>

    <div class="card-body">
    <form id="tableForm">
                @csrf()
        <table class="table mb-0 aiz-table">
            <thead>
                <tr>
                    <th width="3%"></th>
                    <th width="3%">#</th>
                    <th>{{translate('Code')}}</th>
                    <th>{{translate('Status')}}</th>
                    <th>{{translate('Driver')}}</th>
                    <th>{{translate('Type')}}</th>

                    <th>{{translate('Amount')}}</th>
                    @if($show_due_date) <th>{{translate('Due Date')}}</th> @endif

                    <th class="text-center">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>

                @foreach($missions as $key=>$mission)

                <tr>
                    <td><label class="checkbox checkbox-success"><input class="ms-check" type="checkbox" name="checked_ids[]" value="{{$mission->id}}" /><span></span></label></td>
                    @if($user_type == 'admin' || in_array('1100', $staff_permission) || in_array('1008', $staff_permission) )
                        <td width="3%"><a href="{{route('admin.missions.show', $mission->id)}}">{{ ($key+1) + ($missions->currentPage() - 1)*$missions->perPage() }}</a></td>
                        <td width="5%"><a href="{{route('admin.missions.show', $mission->id)}}">{{$mission->code}}</a></td>
                    @else
                        <td width="3%">{{ ($key+1) + ($missions->currentPage() - 1)*$missions->perPage() }}</td>
                        <td width="5%">{{$mission->code}}</td>
                    @endif

                    <td><span class="btn btn-sm btn-{{\App\Mission::getStatusColor($mission->status_id)}}">{{$mission->getStatus()}}</span></td>
                    @if ($mission->captain_id)
                        <td><a href="{{route('admin.captains.show', $mission->captain->id)}}">{{$mission->captain->name}}</a></td>
                    @else
                        <td>{{translate('No Driver')}}</td>
                    @endif
                    <td>{{$mission->type}}</td>

                    @php
                        $helper = new \App\Http\Helpers\TransactionHelper();
                        $shipment_cost = $helper->calcMissionShipmentsAmount($mission->getOriginal('type'),$mission->id);
                    @endphp

                    <td>{{format_price($mission->amount)}}</td>
                    @if($show_due_date) <td>{{$mission->due_date ?? "-"}}</td> @endif

                    <td class="text-center">
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.missions.show', $mission->id)}}" title="{{ translate('Show') }}">
                            <i class="las la-eye"></i>
                        </a>
                        @if(isset($status))
                            @if($status == \App\Mission::APPROVED_STATUS)
                                {{-- @if(Auth::user()->user_type == 'admin' || in_array(1030, json_decode(Auth::user()->staff->role->permissions ?? "[]"))) --}}
                                {{-- <a class="btn btn-success btn-sm" data-url="{{route('admin.missions.action.confirm_amount',['mission_id'=>$mission->id])}}" data-action="POST" onclick="openAjexedModel(this,event)" href="{{route('admin.missions.show', $mission->id)}}" title="{{ translate('Show') }}">
                                <i class="fa fa-check"></i> {{translate('Receive Mission')}}
                                </a> --}}
                                {{-- @endif --}}

                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal" title="{{ translate('Receive Mission') }}" onclick="set_mission_id({{$mission->id}} , {{$mission->amount}} , {{$mission->getOriginal('type')}})">
                                    {{ translate('Receive Mission') }}
                                </button>
                            @endif
                            @if($status == \App\Mission::RECIVED_STATUS)
                                @if($user_type != 'captain' || $mission->getOriginal('type') == \App\Mission::DELIVERY_TYPE || $mission->getOriginal('type') == \App\Mission::SUPPLY_TYPE)
                                {{-- @if(Auth::user()->user_type == 'admin' || in_array(1030, json_decode(Auth::user()->staff->role->permissions ?? "[]"))) --}}
                                <a class="btn btn-success btn-sm" data-url="{{route('admin.missions.action.confirm_amount',['mission_id'=>$mission->id])}}" data-action="POST" onclick="openAjexedModel(this,event)" href="{{route('admin.missions.show', $mission->id)}}" title="{{ translate('Show') }}">
                                    <i class="fa fa-check"></i> {{translate('Confirm Mission / Done')}}
                                </a>
                                {{-- @endif --}}
                                @endif

                            @endif
                        @endif

                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
         <!-- Assign-to-captain Modal -->
         <div id="assign-to-captain-modal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        @if(isset($status))
                             @if( $status == \App\Mission::REQUESTED_STATUS)
                            <div class="modal-header">
                                <h4 class="modal-title h6">{{translate('Assign To Driver')}}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{translate('Driver')}}:</label>

                                            <select name="Mission[captain_id]" class="form-control captain_id kt-select2">
                                                @foreach(\App\Captain::all() as $captain)
                                                <option value="{{$captain->id}}">{{$captain->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{translate('Due Date')}}:</label>
                                            <input type="text" id="kt_datepicker_3" autocomplete="off" class="form-control"  name="Mission[due_date]" value="{{ date('Y-m-d') }}"/>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            @endif
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate('Close')}}</button>
                                <button type="submit" class="btn btn-primary">{{translate('Create Mission')}}</button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->
                @endif
        </form>
         <!-- Ajaxed Models -->
         <div id="ajaxed-model" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">



                </div>
            </div>
        </div><!-- /.modal -->
        <div class="aiz-pagination">
            {{ $missions->appends(request()->input())->links() }}
        </div>
    </div>
</div>
{!! hookView('mission_addon',$currentView) !!}

@endsection

@section('modal')
@include('modals.delete_modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{translate('Confirm Receive Mission')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="mission_modal_body" style="display:none">
            <h5 class="mb-2 modal-title" id="exampleModalLabel">{{translate('Mission Amount')}}</h5>
            <input type="number" id="amount_pickup" class="form-control" name="amount"/>
        </div>

        <div class="modal-footer">
            <form action="{{route('admin.missions.action',['to'=>\App\Mission::RECIVED_STATUS])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="checked_ids[]"  id="selected_mission_id" />
                <input type="hidden" name="amount"  id="selected_mission_amount" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{translate('Confirm')}}</button>
            </form>
        </div>
      </div>
    </div>
</div>


@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type='text/javascript' src="//github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
<script type="text/javascript">
    $('#kt_datepicker_3').datepicker({
        orientation: "bottom auto",
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayBtn: true,
        todayHighlight: true,
        startDate: new Date(),
    });

    $("#amount_pickup").on('keyup', function(){
        document.getElementById("selected_mission_amount").value    = document.getElementById('amount_pickup').value;;
    });

    function set_mission_id(mission_id , mission_amount , mission_type){
        document.getElementById("selected_mission_id").value        = mission_id;
        document.getElementById("amount_pickup").value              = mission_amount;
        document.getElementById("selected_mission_amount").value    = mission_amount;
        document.getElementById("mission_modal_body").style.display = "block";


    }

    function show_ajax_loder_in_button(element){
        $(element).bind('ajaxStart', function(){
            $(this).addClass('spinner spinner-darker-success spinner-left mr-3');
            $(this).attr('disabled','disabled');
        }).bind('ajaxStop', function(){
            $(this).removeClass('spinner spinner-darker-success spinner-left mr-3');
            $(this).removeAttr('disabled');
        });
    }

    function openCaptainModel(element,e)
    {
         var selected = 0;
            $('.ms-check:checked').each(function() {
                selected = selected+1;
            });
            if(selected > 0)
            {
                $('#tableForm').attr('action',$(element).data('url'));
                $('#tableForm').attr('method',$(element).data('method'));
                $('#assign-to-captain-modal').modal('toggle');
            }else if(selected == 0)
            {
               Swal.fire("{{translate('Please Select Missions')}}", "", "error");
            }
    }
    function openAjexedModel(element,event)
    {
        event.preventDefault();

        show_ajax_loder_in_button(element);
        $.ajax({
            url: $(element).data('url'),
            type: 'get',
            success: function(response){
            // Add response in Modal body
            $('#ajaxed-model .modal-content').html(response);
            // Display Modal
            $('#ajaxed-model').modal('toggle');
            }
        });
    }
    $(document).ready(function() {
        $('.action-caller').on('click',function(e){

             e.preventDefault();
             var selected = 0;
            $('.ms-check:checked').each(function() {
                selected = selected+1;
            });
            if(selected > 0)
            {
               $('#tableForm').attr('action',$(this).data('url'));
                $('#tableForm').attr('method',$(this).data('method'));
                $('#tableForm').submit();
            }else if(selected == 0)
            {
                Swal.fire("{{translate('Please Select Missions')}}", "", "error");
            }

        });
        $('#ajaxed-model').on('hidden.bs.modal', function () {
            $('#ajaxed-model .modal-content').empty();
        });
        FormValidation.formValidation(
            document.getElementById('tableForm'), {
                fields: {
                    "Mission[captain_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Mission[due_date]": {
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
