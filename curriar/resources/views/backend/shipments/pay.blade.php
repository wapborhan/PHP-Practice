<?php
use \Milon\Barcode\DNS1D;
$d = new DNS1D();
?>

<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" direction="rtl" dir="rtl" style="direction: rtl;">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif

<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="app-url" content="{{ getBaseURL() }}">
	<meta name="file-base-url" content="{{ getFileBaseURL() }}">
	<base href="">
	<meta charset="utf-8" />
	<link rel="icon" href="@if(get_setting('site_icon')) {{uploaded_asset(get_setting('site_icon'))}} @else {{static_asset('assets/dashboard/media/logos/favicon.ico')}} @endif">
	@if(get_setting('site_name'))
		<title>{{ get_setting('site_name').get_setting('site_motto') ?' | '.get_setting('site_motto'):'' }}</title>
	@else
		<title>{{ translate('Spotlayer Framework') }}</title>
	@endif
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->

	@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
	<!--begin::Page Vendors Styles(used by this page)-->
	<link href="{{ static_asset('assets/dashboard/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}"
		rel="stylesheet" type="text/css" />

	<!--end::Page Vendors Styles-->

	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="{{ static_asset('assets/dashboard/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet"
		type="text/css" />
	<link href="{{ static_asset('assets/dashboard/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet"
		type="text/css" />
	<link href="{{ static_asset('assets/dashboard/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->

	<!--begin::Layout Themes(used by all pages)-->
	<link href="{{ static_asset('assets/dashboard/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet"
		type="text/css" />
	<link href="{{ static_asset('assets/dashboard/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet"
		type="text/css" />
	<link href="{{ static_asset('assets/dashboard/css/themes/layout/brand/light.rtl.css') }}" rel="stylesheet"
		type="text/css" />
	<link href="{{ static_asset('assets/dashboard/css/themes/layout/aside/light.rtl.css') }}" rel="stylesheet"
		type="text/css" />
	<!--end::Layout Themes-->
	@else
	<!--begin::Page Vendors Styles(used by this page)-->
	<link href="{{ static_asset('assets/dashboard/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}"
		rel="stylesheet" type="text/css" />

	<!--end::Page Vendors Styles-->

	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="{{ static_asset('assets/dashboard/plugins/global/plugins.bundle.css') }}" rel="stylesheet"
		type="text/css" />
	<link href="{{ static_asset('assets/dashboard/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet"
		type="text/css" />
	<link href="{{ static_asset('assets/dashboard/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->

	<!--begin::Layout Themes(used by all pages)-->
	<link href="{{ static_asset('assets/dashboard/css/themes/layout/header/base/light.css') }}" rel="stylesheet"
		type="text/css" />
	<link href="{{ static_asset('assets/dashboard/css/themes/layout/header/menu/light.css') }}" rel="stylesheet"
		type="text/css" />
	<link href="{{ static_asset('assets/dashboard/css/themes/layout/brand/light.css') }}" rel="stylesheet"
		type="text/css" />
	<link href="{{ static_asset('assets/dashboard/css/themes/layout/aside/light.css') }}" rel="stylesheet"
		type="text/css" />
	<!--end::Layout Themes-->
	@endif
	<link href="{{ static_asset('assets/css/custom-style.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />

	@yield('style')

	<script>
		var AIZ = AIZ || {};
	</script>
</head>

<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

	<!--begin::Main-->

	<!--begin::Header Mobile-->
	<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">

		<!--begin::Logo-->
        <a href="{{ route('admin.dashboard') }}">
            @if(get_setting('system_logo_white') != null)
                <img src="{{ uploaded_asset(get_setting('system_logo_white')) }}" alt="{{ get_setting('site_name') }}">
            @else
                <img src="{{ static_asset('assets/img/logo.svg') }}" alt="{{ get_setting('site_name') }}">
            @endif
        </a>

		<!--end::Logo-->

		<!--begin::Toolbar-->
		<div class="d-flex align-items-center">

			<!--begin::Aside Mobile Toggle-->
			<button class="p-0 btn burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
				<span></span>
			</button>

			<!--end::Aside Mobile Toggle-->

			<!--begin::Topbar Mobile Toggle-->
			<button class="p-0 ml-2 btn btn-hover-text-primary" id="kt_header_mobile_topbar_toggle">
				<span class="svg-icon svg-icon-xl">

					<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
						height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<polygon points="0 0 24 0 24 24 0 24" />
							<path
								d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
								fill="#000000" fill-rule="nonzero" opacity="0.3" />
							<path
								d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
								fill="#000000" fill-rule="nonzero" />
						</g>
					</svg>

					<!--end::Svg Icon-->
				</span>
			</button>

			<!--end::Topbar Mobile Toggle-->
		</div>

		<!--end::Toolbar-->
	</div>

	<!--end::Header Mobile-->
	<div class="d-flex flex-column flex-root">

		<!--begin::Page-->
		<div class="flex-row d-flex flex-column-fluid page">

			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">

				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">



					<!--begin::Entry-->
					<div class="d-flex flex-column-fluid">

						<!--begin::Container-->
						<div class="container-fluid">
                            <!--begin::Entry-->
                            <div class="d-flex flex-column-fluid">
                                <!--begin::Container-->
                                <div class="container">
                                    <!--begin::Page Layout-->
                                    <div class="flex-row d-flex">
                                        <!--begin::Layout-->
                                        <div class="flex-row-fluid">
                                            <!--begin::Section-->
                                            <div class="row">
                                                <div class="col-md-7 col-lg-12 col-xxl-7">
                                                    <!--begin::Engage Widget 14-->
                                                    <div class="card card-custom card-stretch gutter-b">
                                                        <div class="pb-20 card-body p-15">
                                                            <div class="row mb-17">
                                                                <div class="col-xxl-5 mb-11 mb-xxl-0">
                                                                    <!--begin::Image-->
                                                                    <div class="card card-custom card-stretch">
                                                                        <div class="p-0 px-10 rounded card-body py-15 d-flex align-items-center justify-content-center" style="background-color: #FFCC69;">
                                                                            <h1>D {{$shipment->code}}</h1>

                                                                        </div>
                                                                    </div>
                                                                    <!--end::Image-->
                                                                </div>
                                                                <div class="col-xxl-7 pl-xxl-11">
                                                                    <h2 class="font-weight-bolder text-dark mb-7" style="font-size: 32px;">{{translate('Customer/Sender')}}: {{$shipment->client->name}}</h2>
                                                                    <div class="font-size-h2 mb-7 text-dark-50">{{translate('To Receiver')}}
                                                                        <span class="ml-2 text-info font-weight-boldest">{{$shipment->reciver_name}}</span>
                                                                    </div>
                                                                    @if($shipment->barcode != null)
                                                                    <?=$d->getBarcodeHTML(str_replace(\App\ShipmentSetting::getVal('shipment_code_prefix'),"",$shipment->code), "C128");?>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Engage Widget 14-->

                                                    <!--begin::Engage Widget 14-->
                                                    <div class="card card-custom card-stretch gutter-b">
                                                        <h1>{{translate('Payment Gateway')}}: {{$shipment->pay->name}}</h1>
														<div class="d-flex justify-content-between">
															<form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST" id="checkout-form">
																@csrf
																<input type="hidden" name="shipment_id" value="{{$shipment->id}}">
																<button type="submit" class="mr-3 btn btn-success btn-md">{{translate('Pay Now')}} <i class="ml-2 far fa-credit-card"></i></button>
															</form>
														</div>
                                                    </div>
                                                    <!--end::Engage Widget 14-->
                                                </div>
                                                <div class="col-md-5 col-lg-12 col-xxl-5">
                                                    <!--begin::List Widget 19-->
                                                   <div class="card card-custom card-stretch card-stretch-half gutter-b"  >
                                                        <!--begin::Header-->
                                                        <div class="pt-6 mb-2 border-0 card-header">
                                                            <h3 class="card-title align-items-start flex-column">
                                                                <span class="mb-3 card-label font-weight-bold font-size-h4 text-dark-75">{{translate('Package Info')}}</span>
                                                                <span class="text-muted font-weight-bold font-size-sm">{{\App\PackageShipment::where('shipment_id',$shipment->id)->count()}} {{translate('Packages')}}</span>
                                                            </h3>
                                                        </div>
                                                        <!--end::Header-->
                                                        <!--begin::Body-->
                                                        <div class="pt-2 card-body">
                                                            <!--begin::Table-->
                                                            <div class="table-responsive">
                                                                <div class='text-right font-size-sm font-weight-bold'>{{translate('length x width x height')}}</div>
                                                                <table class="table mb-0 table-borderless">
                                                                    <tbody>

                                                                        @foreach(\App\PackageShipment::where('shipment_id',$shipment->id)->get() as $package)
                                                                        <tr>
                                                                            <td class="pb-6 pl-0 pr-2 align-middle w-40px">
                                                                                <!--begin::Symbol-->
                                                                                <div class="symbol symbol-40 symbol-light-success">
                                                                                    <span class="symbol-label">
                                                                                        <span class="svg-icon svg-icon-lg svg-icon-success">
                                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                                                    <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                                                    <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
                                                                                                </g>
                                                                                            </svg>
                                                                                            <!--end::Svg Icon-->
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                                <!--end::Symbol-->
                                                                            </td>
                                                                            <td class="pb-6 align-middle font-size-lg font-weight-bolder text-dark-75 w-100px">{{$package->description}}</td>

                                                                            <td class="pb-6 text-right align-middle font-weight-bold text-muted">{{translate('Type')}}: @if(isset($package->package->name)){{$package->package->name}} @endif</td>
                                                                            <td class="pb-6 text-right align-middle font-weight-bold text-muted">{{translate('Weight')}}: {{$package->weight}}</td>
                                                                            <td class="pb-6 text-right align-middle font-weight-bolder font-size-lg text-dark-75">{{$package->length."x".$package->width."x".$package->height}} <br> </td>
                                                                        </tr>
                                                                        @endforeach

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <!--end::Table-->
                                                            <div class="mb-8 d-flex flex-column">
                                                                <span class="mb-4 text-dark font-weight-bold">{{translate('Total Cost')}}</span>
                                                                <span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->tax + $shipment->shipping_cost + $shipment->insurance) }}</span>
                                                                <span class="text-muted font-weight-bolder font-size-lg">{{translate('Included tax & insurance')}}</span>
                                                            </div>
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>

                                                </div>
                                            </div>
                                            <!--end::Section-->
                                            <!--begin::Section-->
                                            <!--begin::Advance Table Widget 10-->

                                            <!--end::Advance Table Widget 10-->
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Layout-->
                                    </div>
                                    <!--end::Page Layout-->
                                </div>
                                <!--end::Container-->
                            </div>
                            <!--end::Entry-->

                            @include('modals.delete_modal')
						</div>

						<!--end::Container-->
					</div>

					<!--end::Entry-->
				</div>

				<!--end::Content-->
			</div>

			<!--end::Wrapper-->
		</div>

		<!--end::Page-->
	</div>

	<!--end::Main-->

	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop">
		<span class="svg-icon">

			<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
				viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<polygon points="0 0 24 0 24 24 0 24" />
					<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
					<path
						d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
						fill="#000000" fill-rule="nonzero" />
				</g>
			</svg>

			<!--end::Svg Icon-->
		</span>
	</div>
	<!--end::Scrolltop-->

	@yield('modal')

	<!--begin::Global Config(global config for global JS scripts)-->
	<script>
		var KTAppSettings = {
			"breakpoints": {
				"sm": 576,
				"md": 768,
				"lg": 992,
				"xl": 1200,
				"xxl": 1400
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#3699FF",
						"secondary": "#E5EAEE",
						"success": "#1BC5BD",
						"info": "#8950FC",
						"warning": "#FFA800",
						"danger": "#F64E60",
						"light": "#E4E6EF",
						"dark": "#181C32"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#E1F0FF",
						"secondary": "#EBEDF3",
						"success": "#C9F7F5",
						"info": "#EEE5FF",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#3F4254",
						"success": "#ffffff",
						"info": "#ffffff",
						"warning": "#ffffff",
						"danger": "#ffffff",
						"light": "#464E5F",
						"dark": "#ffffff"
					}
				},
				"gray": {
					"gray-100": "#F3F6F9",
					"gray-200": "#EBEDF3",
					"gray-300": "#E4E6EF",
					"gray-400": "#D1D3E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#7E8299",
					"gray-700": "#5E6278",
					"gray-800": "#3F4254",
					"gray-900": "#181C32"
				}
			},
			"font-family": "Helvetica"
		};
	</script>
	<!--end::Global Config-->

	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="{{ static_asset('assets/dashboard/plugins/global/plugins.bundle.js') }}"></script>
	<script src="{{ static_asset('assets/dashboard/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
	<script src="{{ static_asset('assets/dashboard/js/scripts.bundle.js') }}"></script>
	<!--end::Global Theme Bundle-->

	<!--begin::Page Vendors(used by this page)-->
	<script src="{{ static_asset('assets/dashboard/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
	<!--end::Page Vendors-->



	<script src="{{ static_asset('assets/js/vendors.js') }}" ></script>
	<script src="{{ static_asset('assets/js/aiz-core.js') }}" ></script>

    @yield('script')

    <script type="text/javascript">
	    @foreach (session('flash_notification', collect())->toArray() as $message)
			AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
			@php
			session()->forget('flash_notification')
			@endphp
	    @endforeach

		@if (count($errors) > 0)
			@foreach ($errors->all() as $error)
				AIZ.plugins.notify('warning', '{{ $error }}');
            @endforeach
		@endif

		@if ($msg = Session::get('status'))
			AIZ.plugins.notify('success', '{{ $msg }}');
		@endif

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        if ($('#lang-change').length > 0) {
            $('#lang-change .navi-item a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('{{ route('language.change') }}',{_token:'{{ csrf_token() }}', locale:locale}, function(data){
                        location.reload();
                    });
                });
            });
        }
        function menuSearch(){
			var filter, item;
			filter = $("#menu-search").val().toUpperCase();
			items = $("#main-menu").find("a");
			items = items.filter(function(i,item){
				if($(item).find(".aiz-side-nav-text")[0].innerText.toUpperCase().indexOf(filter) > -1 && $(item).attr('href') !== '#'){
					return item;
				}
			});
			if(filter !== ''){
				$("#main-menu").addClass('d-none');
				$("#search-menu").html('')
				if(items.length > 0){
					for (i = 0; i < items.length; i++) {
						const text = $(items[i]).find(".aiz-side-nav-text")[0].innerText;
						const link = $(items[i]).attr('href');
						 $("#search-menu").append(`<li class="aiz-side-nav-item"><a href="${link}" class="aiz-side-nav-link"><i class="las la-ellipsis-h aiz-side-nav-icon"></i><span>${text}</span></a></li`);
					}
				}else{
					$("#search-menu").html(`<li class="aiz-side-nav-item"><span	class="text-center text-muted d-block">{{ translate('Nothing Found') }}</span></li>`);
				}
			}else{
				$("#main-menu").removeClass('d-none');
				$("#search-menu").html('')
			}
        }
    </script>

	<!--begin::Page Scripts(used by this page)-->
	<script src="{{ static_asset('assets/dashboard/js/pages/widgets.js') }}"></script>
	<!--end::Page Scripts-->
</body>

<!--end::Body-->

</html>
