<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" direction="rtl" style="direction: rtl;">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		@if(get_setting('site_name'))
			<title> @if(View::hasSection('sub_title')) @yield('sub_title') | @endif {{ get_setting('site_name') }}</title>
		@else
			<title>@if(View::hasSection('sub_title')) @yield('sub_title') | @endif {{ translate('Spotlayer Framework') }} </title>
		@endif
		<meta name="description" content="{{translate('Login page')}}" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="{{ static_asset('assets/dashboard/css/pages/login/classic/login-4.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ static_asset('assets/dashboard/plugins/global/plugins.bundle.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
		<link href="{{ static_asset('assets/dashboard/plugins/custom/prismjs/prismjs.bundle.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
		<link href="{{ static_asset('assets/dashboard/css/style.bundle.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
		<link href="{{ static_asset('assets/css/custom-style.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="{{ static_asset('assets/dashboard/css/themes/layout/header/base/light.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
		<link href="{{ static_asset('assets/dashboard/css/themes/layout/header/menu/light.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
		<link href="{{ static_asset('assets/dashboard/css/themes/layout/brand/dark.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
		<link href="{{ static_asset('assets/dashboard/css/themes/layout/aside/dark.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="{{ static_asset('assets/dashboard/media/logos/favicon.ico') }}" />


        @yield('style')

        <script>
            var AIZ = AIZ || {};
        </script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        @yield('content')
		<script>var HOST_URL = "{{url('/')}}";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ static_asset('assets/dashboard/plugins/global/plugins.bundle.js?v=7.2.3') }}"></script>
		<script src="{{ static_asset('assets/dashboard/plugins/custom/prismjs/prismjs.bundle.js?v=7.2.3') }}"></script>
		<script src="{{ static_asset('assets/dashboard/js/scripts.bundle.js?v=7.2.3') }}"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{ static_asset('assets/dashboard/js/pages/custom/login/login-general.js?v=7.2.3') }}"></script>
		<!--end::Page Scripts-->

        @yield('script')

    
        <script src="{{ static_asset('assets/js/vendors.js') }}" ></script>
	    <script src="{{ static_asset('assets/js/aiz-core.js') }}" ></script>

        <script type="text/javascript">
            @foreach (session('flash_notification', collect())->toArray() as $message)
                AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
            @endforeach
        </script>
	</body>
	<!--end::Body-->
</html>