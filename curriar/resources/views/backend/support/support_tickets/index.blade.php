@extends('backend.layouts.app')

@section('subheader')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Support Desk') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Support Desk') }}</a>
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

<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom">

            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-files-and-folders"></i>
                    </span>
                    <h3 class="card-label">{{translate('Tickets')}}</h3>
                </div>
                <div class="card-toolbar">
                    <form class="form" id="sort_support" action="" method="GET">
                        <div class="form-group row mb-0">
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-xs" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type ticket code & Enter') }}">
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-primary">{{ translate('Search') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class="aiz-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>{{ translate('Ticket ID') }}</th>
                            <th>{{ translate('Sending Date') }}</th>
                            <th>{{ translate('Subject') }}</th>
                            <th>{{ translate('User') }}</th>
                            <th>{{ translate('Status') }}</th>
                            <th>{{ translate('Last reply') }}</th>
                            <th class="text-right">{{ translate('Options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($tickets as $key => $ticket)
                            @if ($ticket->user != null)
                                <tr>
                                    <td>#{{ $ticket->code }}</td>
                                    <td>{{ $ticket->created_at }} @if($ticket->viewed == 0) <span class="badge badge-inline badge-info">{{ translate('New') }}</span> @endif</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>
                                        @if ($ticket->status == 'pending')
                                            <span class="badge badge-inline badge-danger">{{ translate('Pending') }}</span>
                                        @elseif ($ticket->status == 'open')
                                            <span class="badge badge-inline badge-secondary">{{ translate('Open') }}</span>
                                        @else
                                            <span class="badge badge-inline badge-success">{{ translate('Solved') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (count($ticket->ticketreplies) > 0)
                                            {{ $ticket->ticketreplies->last()->created_at }}
                                        @else
                                            {{ $ticket->created_at }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{route('support_ticket.admin_show', encrypt($ticket->id))}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="{{ translate('View Details') }}">
                                            <i class="las la-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="pull-right">
                        {{ $tickets->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
