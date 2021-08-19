@extends('backend.layouts.app')

@section('content')

<div class="mt-2 mb-3 text-left aiz-titlebar">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('Fees Country To Country Settings')}}</h1>
        </div>

    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Fees Country To Country Settings')}}</h5>
    </div>
    <div class="card-body">

        <form class="form-horizontal" action="{{ route('admin.costs.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('From Country')}}:</label>
                        <select id="change-country" name="Cost[from_country_id]" class="form-control select-country">
                            <option value=""></option>
                            @foreach(\App\Country::all() as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('To Country')}}:</label>
                        <select id="change-country-to" name="Cost[to_country_id]" class="form-control select-country">
                            <option value=""></option>
                            @foreach(\App\Country::all() as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('From Region')}}:</label>
                        <select id="change-state-from" name="Cost[from_state_id]" class="form-control select-state">
                            <option value=""></option>

                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('To Region')}}:</label>
                        <select id="change-state-to"name="Cost[to_state_id]" class="form-control select-state">
                            <option value=""></option>

                        </select>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('From Area')}}:</label>
                        <select name="Cost[from_area_id]" class="form-control select-area">
                            <option value=""></option>

                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{translate('To Area')}}:</label>
                        <select name="Cost[to_area_id]" class="form-control select-area">
                            <option value=""></option>

                        </select>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>{{translate('Shipping Cost')}}:</label>
                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="0" name="Cost[shipping_cost]">
                </div>
                <div class="form-group col-md-4">
                    <label>{{translate('Tax')}}%:</label>
                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="0" name="Cost[tax]">
                </div>

            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>{{translate('Insurance')}}:</label>
                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="0" name="Cost[insurance]">
                </div>
                <div class="form-group col-md-4">
                    <label>{{translate('Returned Shipment Cost')}}:</label>
                    <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="0" name="Cost[return_cost]">
                </div>
                <div class="mb-0 text-left form-group col-md-4">
                    <label>{{translate('Save')}}:</label>
                    <div>
                        <button type="submit" class="btn btn-md btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>
<div class="mt-10 card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('From Country To Country Costs')}}</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0 aiz-table">
            <thead>
                <tr>
                    <th width="3%">#</th>
                    <th>{{translate('From Country')}}</th>
                    <th>{{translate('To Country')}}</th>
                    <th>{{translate('From Region')}}</th>
                    <th>{{translate('To Region')}}</th>
                    <th>{{translate('From Area')}}</th>
                    <th>{{translate('To Area')}}</th>
                    <th>{{translate('Shipment Cost')}}</th>
                    <th>{{translate('Return Cost')}}</th>
                    <th>{{translate('Tax')}}%</th>
                    <th>{{translate('Incurrence')}}</th>


                    <th width="10%" class="text-center">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Cost::all() as $key=>$cost)

                <tr>
                    <td width="3%">{{ ($key+1) + ($costs->currentPage() - 1)*$costs->perPage() }}</td>
                    <td>{{$cost->from_country->name}}</td>
                    <td>{{$cost->to_country->name}}</td>
                    <td>{{$cost->from_state->name}}</td>
                    <td>{{$cost->to_state->name}}</td>
                    <td>@if(isset($cost->from_area->name)) {{$cost->from_area->name}} @endif</td>
                    <td>@if(isset($cost->to_area->name)) {{$cost->to_area->name}} @endif </td>
                    <td>{{$cost->shipping_cost}}</td>
                    <td>{{$cost->return_cost}}</td>
                    <td>{{$cost->tax}}</td>
                    <td>{{$cost->insurance}}</td>


                    <td class="text-center">
                        
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.costs.edit', $cost->id)}}" title="{{ translate('Edit') }}">
                            <i class="las la-edit"></i>
                        </a>
                       
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $costs->appends(request()->input())->links() }}
        </div>
    </div>
</div>
{!! hookView('shipment_addon',$currentView) !!}

@endsection

@section('modal')
@include('modals.delete_modal')
@endsection

@section('script')
<script>
    $('.select-country').select2({
        placeholder: "Select country"
    });
    $('.select-state').select2({
        placeholder: "Select state"
    });
    $('.select-area').select2({
        placeholder: "Select Area"
    });
    
    $('#change-country').change(function() {
        var id = $(this).val();


        
        $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Cost[from_state_id]"]').empty();
           
            for (let index = 0; index < data.length; index++) {
                const element = data[index];

                $('select[name ="Cost[from_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    $('#change-country-to').change(function() {
        var id = $(this).val();

        $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Cost[to_state_id]"]').empty();
           
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Cost[to_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    $('#change-state-from').change(function() {
        var id = $(this).val();

        $.get("{{route('admin.shipments.get-areas-ajax')}}?state_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Cost[from_area_id]"]').empty();
           
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Cost[from_area_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    $('#change-state-to').change(function() {
        var id = $(this).val();

        $.get("{{route('admin.shipments.get-areas-ajax')}}?state_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Cost[to_area_id]"]').empty();
           
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Cost[to_area_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });

    $('.select-country').select2({
        placeholder: "Select country",
        language: {
          noResults: function() {
            return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.shipments.covered_countries')}}?redirect=admin.shipments.create"
              class="btn btn-primary" >{{translate('Manage Countries')}}</a>
              </li>`;
          },
        },
        escapeMarkup: function(markup) {
          return markup;
        },
    });
    
    

    $(document).ready(function() {
        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {
                    "Cost[from_country_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[to_country_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[to_state_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[from_state_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[shipping_cost]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[return_cost]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[tax]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Cost[insurance]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },

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