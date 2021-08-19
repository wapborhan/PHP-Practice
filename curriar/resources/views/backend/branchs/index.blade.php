@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Branches')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('admin.branchs.create') }}" class="btn btn-circle btn-info">
				<span>{{translate('Add New Branch')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Branches')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th  width="3%">#</th>
                    <th >{{translate('Name')}}</th>
                    <th >{{translate('Email')}}</th>
                    <th >{{translate('Phone')}}</th>
                    
                    <th  width="10%" class="text-center">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($branches as $key => $branch)
                    
                        <tr>
                            <td  width="3%">{{ ($key+1) + ($branches->currentPage() - 1)*$branches->perPage() }}</td>
                            <td width="20%">{{$branch->name}}</td>
                            <td width="20%">{{$branch->email}}</td>
                            <td width="20%">{{$branch->responsible_mobile}}</td>
                           
                            <td class="text-center">
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.branchs.show', $branch->id)}}" title="{{ translate('Show') }}">
		                                <i class="las la-eye"></i>
		                            </a>
		                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.branchs.edit', $branch->id)}}" title="{{ translate('Edit') }}">
		                                <i class="las la-edit"></i>
		                            </a>
		                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('admin.branchs.delete-branch', ['branch'=>$branch->id])}}" title="{{ translate('Delete') }}">
		                                <i class="las la-trash"></i>
		                            </a>
		                        </td>
                        </tr>
               
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $branches->appends(request()->input())->links() }}
        </div>
    </div>
</div>
{!! hookView('spot-cargo-shipment-branch-addon',$currentView) !!}

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
