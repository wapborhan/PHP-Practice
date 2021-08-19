@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		
		<div class="col-md-12 text-md-right">
			<a href="{{ route('admin.areas.create') }}" class="btn btn-circle btn-info">
				<span>{{translate('Add New Area')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Areas')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th  width="3%">#</th>
                    <th >{{translate('Area')}}</th>
                    <th >{{translate('State')}}</th>
                    <th >{{translate('Country')}}</th>
                   
                    
                    <th  width="10%" class="text-center">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($areas as $key => $area)
                    
                        <tr>
                            <td  width="3%">{{ ($key+1) + ($areas->currentPage() - 1)*$areas->perPage() }}</td>
                            <td width="20%">{{$area->name}}</td>
                            <td width="20%">{{$area->state->name}}</td>
                            <td width="20%">{{$area->state->country->name}}</td>
                           
                           
                            <td class="text-center">
                                  
		                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.areas.edit', $area->id)}}" title="{{ translate('Edit') }}">
		                                <i class="las la-edit"></i>
		                            </a>
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('admin.areas.delete-area', ['area'=>$area->id])}}" title="{{ translate('Delete') }}">
		                                <i class="las la-trash"></i>
		                            </a>
		                            
		                        </td>
                        </tr>
               
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $areas->appends(request()->input())->links() }}
        </div>
    </div>
</div>
{!! hookView('shipment_addon',$currentView) !!}

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
