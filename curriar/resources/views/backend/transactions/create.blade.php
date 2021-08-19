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
            <h5 class="mb-0 h6">{{translate('Add Manual Transaction')}}</h5>
        </div>

        <form class="form-horizontal" action="{{ route('admin.transactions.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Beneficiary')}}:</label>
                                    <select class="form-control kt-select2 select-branch" name="type" onchange="enable_select(this)">
                                        @foreach($types as $key=>$type)
                                            <option value="{{$key}}">{{$type['name']}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="captain">
                                <div class="form-group">
                                    <label>{{translate('Driver')}}:</label>
                                    <select class="form-control kt-select2 select-branch" name="captain">
                                        <option></option>
                                        @foreach($captains as $captain)
                                            <option value="{{$captain->id}}">{{$captain->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="client" style="display: none">
                                <div class="form-group">
                                    <label>{{translate('Customer')}}:</label>
                                    <select class="form-control kt-select2 select-branch" name="client">
                                        <option></option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="branch" style="display: none">
                                <div class="form-group">
                                    <label>{{translate('Branch')}}:</label>
                                    <select class="form-control kt-select2 select-branch" name="branch">
                                        <option></option>
                                        @foreach($branchs as $branch)
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Wallet Type')}}:</label>
                                    <select class="form-control kt-select2" name="wallet_type">
                                        <option value="add">{{translate('Add to wallet')}}</option>
                                        <option value="deduct">{{translate('Deduct from wallet')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Amount')}}:</label>
                                    <input id="kt_touchspin_4" placeholder="{{translate('Amount')}}" type="text" class="form-control total-weight" value="0" name="amount" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Description')}}:</label>
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="3" placeholder="{{translate('Description')}}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-0 text-right form-group">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        $('#kt_touchspin_4').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 1,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            initval: 1,
        });
        var types = @json($types);
        function enable_select(select_type) {
            for (const [key, value] of Object.entries(types)) {
                document.getElementById(types[key]['key']).style.display = "none";
            }
            document.getElementById(types[select_type.value]['key']).style.display = "block";
        }
    </script>
@endsection
