@extends('backend.layouts.blank')


@section('sub_title'){{translate('Tracking shipment')}}: #{{$shipment->code}}@endsection

@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
		<!--begin::Card-->
		<div class="card card-custom gutter-b">
			<div class="alert alert-custom alert-white  gutter-b mb-0 pb-0" role="alert">
				<div class="alert-text">
					<!--begin::Logo-->
					<p class="d-block py-20 text-center">
						<a href="{{ route('home') }}">
							@if(get_setting('system_logo_white') != null)
								<img src="{{ uploaded_asset(get_setting('system_logo_white')) }}" alt="{{ get_setting('site_name') }}" style="max-width:150px">
							@else
								<img src="{{ static_asset('assets/img/logo.svg') }}" alt="{{ get_setting('site_name') }}" style="max-width:150px">
							@endif
						</a>
					</p>
                    <p class="mt-50 text-center"><a href="{{ route('home') }}">{{translate('BACK TO HOME')}}</a></p>
					<p class="mt-50 text-center"><span class="label label-inline label-pill label-danger label-rounded mr-2">NOTE:</span>{{translate('For inquiries about your shipments, please contact us from')}} <a href="#">{{translate('here')}}</a>.</p>
				</div>
			</div>
			<div class="card-body p-0 pb-10">
				<!-- begin: Invoice-->
				<!-- begin: Invoice header-->
				<div class="row justify-content-center pt-8 px-8 px-md-0">
					<div class="col-md-10">
						<div class="d-flex justify-content-between pb-10 pb-md-10 flex-column flex-md-row">
							@php
								$code = filter_var($shipment->code, FILTER_SANITIZE_NUMBER_INT);
							@endphp
							<h1 class="display-4 font-weight-boldest mb-10">{{translate('Shipment')}}: {{$shipment->code}}</h1>
						</div>

						<div class="d-flex justify-content-between pb-6">
							<div class="d-flex flex-column flex-root">
								<span class="text-dark font-weight-bold mb-4 text-uppercase">{{translate('Current Status')}}</span>
								<span class="opacity-70 d-block">{{$shipment->getStatus()}}</span>
							</div>
							@if ($shipment->amount_to_be_collected && $shipment->amount_to_be_collected  > 0)
								<div class="d-flex flex-column flex-root">
									<span class="text-dark text-right font-weight-bold mb-4 text-uppercase">{{translate('Shipping Date')}}</span>
									<span class="text-muted text-right font-weight-bolder font-size-lg">{{$shipment->shipping_date}}</span>
								</div>
							@endif
						</div>
						<div class="border-bottom w-100"></div>

						<table class="table">
							<thead>
								<tr>
									<th class="text-uppercase">{{translate('date')}}</th>
									<th class="text-uppercase">{{translate('details')}}</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{$shipment->created_at->diffForHumans()}}</td>
									<td>{{translate('Created')}}</td>
									<td></td>
									<td></td>
								</tr>
								@foreach($shipment->logs()->orderBy('id','asc')->get() as $log)
									<tr>
										<td>{{$log->created_at->diffForHumans()}}</td>
										<td>{{\App\Shipment::getClientStatusByStatusId($log->to)}}</td>
										<td></td>
										<td></td>
									</tr>
								@endforeach
							</tbody>
						</table>


					</div>
				</div>
				<!-- end: Invoice header-->
			</div>
		</div>
		<!--end::Card-->
	</div>
</div>
@endsection