@extends('backend.layouts.blank')

@section('content')
<section class="align-items-center d-flex h-100" style="background: #E9F4FE">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mx-auto text-center py-4">
				<img src="{{ static_asset('assets/img/maintainance.svg') }}" class="img-fluid w-75 mb-15">
			    <h3 class="fw-600 mt-5">{{translate('Our Website is Under Maintenance.')}}</h3>
			    <div class="lead">{{translate('We will be back soon!')}}</div>
				<br />
			    <div class="lead" style="font-size: 1rem !important;">{{translate('If you are the owner of the website, you can make the website live, by disable Maintenance mode from "Settings > Features activation"')}}</div>
			</div>
		</div>
	</div>
</section>
@endsection
