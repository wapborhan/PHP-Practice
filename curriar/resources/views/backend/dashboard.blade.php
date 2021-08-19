@extends('backend.layouts.app')

@section('sub_title'){{translate('Dashboard')}}@endsection

@section('content')
    @if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
        <div class="alert alert-danger" role="alert">
            {{translate('Please Configure Email Setting to work all email sending funtionality')}},
            <a class="alert-link" href="{{ route('email_settings.index') }}">{{ translate('Configure Now') }}</a>
        </div>
    @endif

    @if (\App\Addon::where('activated', 1)->count() > 0)
        @foreach(\File::files(base_path('resources/views/backend/inc/addons/dashboard')) as $path)
            @include('backend.inc.addons.dashboard.'.str_replace('.blade','',pathinfo($path)['filename']))
        @endforeach
    @endif

@endsection
@section('script')

@endsection
