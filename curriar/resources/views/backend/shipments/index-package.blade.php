@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Package Types')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('admin.packages.create') }}" class="btn btn-circle btn-info">
				<span>{{translate('Add New Package Type')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Packages')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th  width="3%">#</th>
                    <th >{{translate('Name')}}</th>
                   
                    <th class="text-center">{{translate('Options')}}</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $key => $package)
                    
                        <tr>
                            <td  width="3%">{{ ($key+1) + ($packages->currentPage() - 1)*$packages->perPage() }}</td>
                            <td>{{$package->name}}</td>
                           
                           
                            <td class="text-center">
                                    
		                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.packages.edit', $package->id)}}" title="{{ translate('Edit') }}">
		                                <i class="las la-edit"></i>
		                            </a>
		                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('admin.packages.delete-package', ['package'=>$package->id])}}" title="{{ translate('Delete') }}">
		                                <i class="las la-trash"></i>
		                            </a>
		                        </td>
                        </tr>
               
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $packages->appends(request()->input())->links() }}
        </div>
    </div>
</div>
{!! hookView('shipment_addon',$currentView) !!}

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
