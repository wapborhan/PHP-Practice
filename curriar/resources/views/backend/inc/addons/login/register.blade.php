@php
    $addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
@endphp
@if ($addon != null)
    @if($addon->activated)
        <div class="mt-10">
            <span class="opacity-70 mr-4">{{translate("Don't have an account yet?")}}</span>
            <a href="{{ route('client.register') }}" id="kt_login_signup" class="text-muted text-hover-primary font-weight-bold">Sign Up!</a>
        </div>
    @endif
@endif