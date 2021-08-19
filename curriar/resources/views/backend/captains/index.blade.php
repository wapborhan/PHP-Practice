@extends('backend.layouts.app')

@section('content')

<div class="mt-2 mb-3 text-left aiz-titlebar">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Drivers')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('admin.captains.create') }}" class="btn btn-circle btn-info">
				<span>{{translate('Add New Drivers')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Drivers')}}</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0 aiz-table">
            <thead>
                <tr>
                    <th  width="3%">#</th>
                    <th >{{translate('Name')}}</th>   
                    <th >{{translate('Email')}}</th>               
                    <th >{{translate('Phone')}}</th>
                    <th >{{translate('Branch')}}</th>
                    
                    <th class="text-center">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($captains as $key => $captain)
                    
                        <tr>
                            <td  width="3%">{{ ($key+1) + ($captains->currentPage() - 1)*$captains->perPage() }}</td>
                            <td width="20%">{{$captain->name}}</td>
                            <td width="20%">{{$captain->email}}</td>
                            
                            <td width="20%">{{$captain->responsible_mobile}}</td>
                            <td><a href="{{route('admin.branchs.show',$captain->branch_id)}}">{{$captain->branch->name}}</a></td>
                           
                            <td class="text-center">
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.captains.show', $captain->id)}}" title="{{ translate('Show') }}">
		                                <i class="las la-eye"></i>
		                            </a>
		                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.captains.edit', $captain->id)}}" title="{{ translate('Edit') }}">
		                                <i class="las la-edit"></i>
		                            </a>
		                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('admin.captains.delete-captain', ['captain'=>$captain->id])}}" title="{{ translate('Delete') }}">
		                                <i class="las la-trash"></i>
		                            </a>
		                        </td>
                        </tr>
               
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $captains->appends(request()->input())->links() }}
        </div>
    </div>
</div>
{!! hookView('spot-cargo-shipment-captain-addon',$currentView) !!}

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
