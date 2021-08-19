@extends('backend.layouts.app')


@section('sub_title'){{translate('Transactions')}}@endsection
@section('subheader')
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">{{translate('Transactions')}}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Transactions') }}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                    <a href="{{ route('admin.transactions.create') }}" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="flaticon2-add-1"></i> {{translate('Add New Transaction')}}</a>
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
    <div class="flex-wrap py-3 card-header">
        <div class="card-title">
            <h3 class="card-label">
                {{$page_name}}
            </h3>
        </div>
    </div>
    <div class="m-5" id="tableForm">
        <table class="table mb-0 aiz-table"  data-show-toggle="true" data-toggle-column="first">
            <thead>
                <tr>
                    <th width="3%">#</th>
                    <th>{{translate('Owner Type')}}</th>
                    <th>{{translate('Owner Name')}}</th>
                    <th>{{translate('Type')}}</th>
                    <th>{{translate('Value')}}</th>
                    <th>{{translate('Date')}}</th>
                    <th data-breakpoints="all" data-title="-">{{translate('Description')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $key=>$transaction)
                    <tr @if($loop->first) data-expanded="true" @endif>
                        <td width="3%">{{ ($key+1) + ($transactions->currentPage() - 1)*$transactions->perPage() }}</td>
                        
                        <td>{{$transaction_owner[$transaction->transaction_owner]['text']  ?? ""}}</td>
                        
                        <td><a href="{{route('admin.'.($transaction_owner[$transaction->transaction_owner]['key']  ?? "").'s.show',($transaction->{$transaction_owner[$transaction->transaction_owner]['id']} ?? ""))}}">{{$transaction->{$transaction_owner[$transaction->transaction_owner]['key']}->name ?? ""}}</a></td>

                        <td>
                            @if($transaction_type[$transaction->type] == 'mission' && $transaction->mission_id)
                                <a href="{{route('admin.missions.show', $transaction->mission_id )}}">{{translate('Mission')}}({{$transaction->mission->code ?? ""}}) </a>
                            @elseif($transaction_type[$transaction->type] == 'shipment' && $transaction->shipment_id)
                                <a href="{{route('admin.shipments.show', $transaction->shipment_id )}}">{{$transaction->shipment->barcode ?? ""}} </a>
                            @elseif($transaction_type[$transaction->type] == 'manual')
                                {{translate('Manual')}}
                            @endif
                        </td>
                        <td>{{format_price($transaction->value) ?? ""}}</td>
                        <td>{{$transaction->created_at->format("Y-m-d h:i") ?? ""}}</td>
                        <td>{{$transaction->description ?? "-"}}</td>
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>

    <div class="aiz-pagination">
        {{ $transactions->appends(request()->input())->links() }}
    </div>
</div>

@endsection

@section('modal')
{{-- @include('modals.delete_modal') --}}
@endsection

@section('script')
    <script type="text/javascript">
    </script>
@endsection
