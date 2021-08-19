@php 
$addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
@endphp
@if ($addon != null)
    @if($addon->activated)
        @if(in_array(Auth::user()->user_type , ['admin','customer','branch']) || in_array('1001', json_decode(Auth::user()->staff->role->permissions ?? "[]")) || Auth::user()->user_type == 'branch' || Auth::user()->user_type == 'client')
            <li class="menu-item menu-item-rel ">
                <a href="{{ route('admin.shipments.create') }}" class="btn btn-success btn-sm mr-3">
                    + {{translate('Add Shipment')}}<i class="ml-2 flaticon2-box-1"></i>
                </a>
            </li>
        @endif
        <li class="menu-item menu-item-rel ">
            <a href="{{ route('admin.shipments.track') }}" class="btn btn-primary btn-sm mr-3">
                {{translate('Track Shipment')}}<i class="ml-2 flaticon2-search"></i>
            </a>
        </li>
    @endif
@endif
