@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('Countries')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('admin.packages.create') }}" class="btn btn-circle btn-info">
				<span>{{translate('Add New Package Type')}}</span>
			</a>
		</div>
	</div>
</div>


{!! hookView('shipment_addon',$currentView) !!}

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
