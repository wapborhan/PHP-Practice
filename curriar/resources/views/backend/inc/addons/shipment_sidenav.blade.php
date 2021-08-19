@php
$addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
$user_type = Auth::user()->user_type;
@endphp
<!--Shipments-->
@if ($addon != null)
    @if($addon->activated)
        @if( in_array($user_type,['admin','customer','branch']) || in_array('1108', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.shipments.index','admin.shipments.update','admin.shipments.import','admin.shipments.add.by.api','admin.shipments.create','admin.shipments.show'])}} @foreach(\App\Shipment::status_info() as $item) {{ areActiveRoutes([$item['route_name']])}} @endforeach " aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon fas fa-box-open"></i>
                    <span class="menu-text">{{translate('Shipments')}}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">{{translate('Shipments')}}</span>
                            </span>
                        </li>

                        @if( in_array($user_type,['admin','customer','captain','branch']) || in_array('1108', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                            <li class="menu-item {{ areActiveRoutes(['admin.shipments.create'])}}" aria-haspopup="true">
                                <a href="{{ route('admin.shipments.create') }}" class="menu-link">
                                        <i class="menu-bullet menu-icon flaticon2-plus" style="font-size: 10px;"></i>
                                    <span class="menu-text">{{translate('Add Shipment')}}</span>
                                </a>
                            </li>

                            @if(in_array($user_type,['admin']))
                                <li class="menu-item {{ areActiveRoutes(['admin.shipments.import'])}}" aria-haspopup="true">
                                    <a href="{{ route('admin.shipments.import') }}" class="menu-link">
                                        <i class="menu-bullet menu-icon flaticon2-plus" style="font-size: 10px;"></i>
                                        <span class="menu-text">{{translate('Import Shipments')}}</span>
                                    </a>
                                </li>
                            @endif
                            
                        @endif

                        @if( in_array($user_type,['admin','customer']) || in_array('1107', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                            <li class="menu-item {{ areActiveRoutes(['admin.shipments.add.by.api'])}}"  aria-haspopup="true">
                                <a href="{{ route('admin.shipments.add.by.api') }}" class="menu-link">
                                    <i class="menu-bullet menu-icon flaticon2-plus" style="font-size: 10px;"></i>
                                    <span class="menu-text">{{translate('Shipments Api')}}</span>

                                </a>
                            </li>
                        @endif

                        @if( in_array($user_type,['admin','captain']) || in_array('1109', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                            <li class="menu-item {{ areActiveRoutes(['admin.shipments.barcode.scanner'])}}" aria-haspopup="true">
                                <a href="{{ route('admin.shipments.barcode.scanner') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{translate('Barcode Scanner')}}</span>
                                </a>
                            </li>
                        @endif
                        
                        @if( in_array($user_type,['admin','customer','captain','branch']) || in_array('1108', json_decode(Auth::user()->staff->role->permissions ?? "[]")))

                            <li class="menu-item {{ areActiveRoutes(['admin.shipments.index','admin.shipments.show',])}}" aria-haspopup="true">
                                <a href="{{ route('admin.shipments.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{translate('All Shipments')}}</span>

                                </a>
                            </li>
                        @endif
                        @foreach(\App\Shipment::status_info() as $item)
                            @if(in_array($user_type,['admin','customer','captain','branch']) || in_array($item['permissions'], json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                                @if($item['status'] == \App\Shipment::SAVED_STATUS)
                                <li class="menu-item @if(isset($type) && $type==\App\Shipment::PICKUP && isset($status) && $status ==  $item['status']) menu-item-active menu-item-open @endif" aria-haspopup="true">
                                    <a href="{{ route($item['route_name'],['status'=>$item['status'],'type'=>\App\Shipment::PICKUP]) }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Saved Pickup')}}</span>

                                    </a>
                                </li>
                                <li class="menu-item @if(isset($type) && $type==\App\Shipment::DROPOFF && isset($status) && $status ==  $item['status']) menu-item-active menu-item-open @endif" aria-haspopup="true">
                                    <a href="{{ route($item['route_name'],['status'=>$item['status'],'type'=>\App\Shipment::DROPOFF]) }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Saved Dropoff')}}</span>

                                    </a>
                                </li>
                                @elseif($item['status'] == \App\Shipment::REQUESTED_STATUS)
                                <li class="menu-item @if(isset($type) && $type==\App\Shipment::PICKUP && isset($status) && $status == $item['status']) menu-item-active menu-item-open @endif" aria-haspopup="true">
                                    <a href="{{ route($item['route_name'],['status'=>$item['status'],'type'=>\App\Shipment::PICKUP]) }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Requested Pickup')}}</span>

                                    </a>
                                </li>

                                @else
                                <li class="menu-item {{ areActiveRoutes([$item['route_name']])}}" aria-haspopup="true">
                                    <a href="{{ route($item['route_name'],['status'=>$item['status']]) }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{$item['text']}}</span>

                                    </a>
                                </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </div>
            </li>
        @endif
    @endif
@endif

<!-- Missions-->
@php
$addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
$user_type = Auth::user()->user_type;
@endphp
@if ($addon != null)
    @if($addon->activated)
        @if(in_array($user_type, ['admin','captain','branch']) || in_array('1008', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.missions.index','admin.missions.update','admin.missions.create','admin.missions.show','admin.missions.get.manifest'])}} @foreach(\App\Mission::status_info() as $item) {{ areActiveRoutes([$item['route_name']])}} @endforeach " aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon fas fa-shipping-fast"></i>
                    <span class="menu-text">{{translate('Missions')}}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">{{translate('Missions')}}</span>
                            </span>
                        </li>



                        @foreach(\App\Mission::status_info() as $item)

                            @if(in_array($user_type, $item['user_role']) || in_array($item['permissions'], json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                                <li class="menu-item {{ areActiveRoutes([$item['route_name']])}}" aria-haspopup="true">
                                    <a href="{{ route($item['route_name'],['status'=>$item['status']]) }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{$item['text']}}</span>

                                    </a>
                                </li>
                            @endif
                        @endforeach

                    </ul>
                </div>
            </li>
        @endif

        @if(in_array($user_type, ['admin','captain','branch']) || in_array('1008', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <li class="menu-item {{ areActiveRoutes(['admin.missions.manifests','admin.missions.get.manifest'])}}" aria-haspopup="true">
                <a href="{{ route('admin.missions.manifests') }}" class="menu-link">
                    <i class="menu-icon fas fa-people-carry"></i>
                    <span class="menu-text">{{ translate('Manifest') }}</span>
                </a>
            </li>
        @endif
    @endif
@endif
@if( in_array($user_type,['captain']) || in_array('1109', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
    <li class="menu-item {{ areActiveRoutes(['admin.shipments.barcode.scanner'])}}" aria-haspopup="true">
        <a href="{{ route('admin.shipments.barcode.scanner') }}" class="menu-link">
            <i class="menu-icon fas fa-barcode"></i>
            <span class="menu-text">{{ translate('Barcode Scanner') }}</span>
        </a>
    </li>
@endif
<!-- Clients-->
@php
$addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
@endphp
@if ($addon != null)
    @if($addon->activated)

        <!--Users-->
        @if(in_array($user_type, ['admin','branch']) || in_array('1005', json_decode(Auth::user()->staff->role->permissions ?? "[]")) || in_array('1006', json_decode(Auth::user()->staff->role->permissions ?? "[]")) || in_array('1007', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.clients.index','admin.clients.update','admin.clients.create','admin.clients.show'])}}" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon flaticon-users"></i>
                    <span class="menu-text">{{translate('Users')}}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">{{translate('Users')}}</span>
                            </span>
                        </li>

                        <!--Customers-->
                        @if(in_array($user_type, ['admin','branch']) || in_array('1005', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                            <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.clients.index','admin.clients.update','admin.clients.create','admin.clients.show'])}}" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-icon fas fa-users"></i>
                                    <span class="menu-text">{{translate('Customers')}}</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                                            <span class="menu-link">
                                                <span class="menu-text">{{translate('Customers')}}</span>
                                            </span>
                                        </li>

                                        @if(in_array($user_type, ['admin','branch']) || in_array('1005', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                                            <li class="menu-item {{ areActiveRoutes(['admin.clients.index','admin.clients.update','admin.clients.show'])}}" aria-haspopup="true">
                                                <a href="{{ route('admin.clients.index') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">{{translate('All Customers')}}</span>

                                                </a>
                                            </li>
                                            <li class="menu-item {{ areActiveRoutes(['admin.clients.create'])}}" aria-haspopup="true">
                                                <a href="{{ route('admin.clients.create') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">{{translate('Add Customer')}}</span>

                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endif

                        <!--Branches-->
                        @if(Auth::user()->user_type == 'admin' || in_array('1006', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                            <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.branchs.index','admin.branchs.update','admin.branchs.create','admin.branchs.show'])}}" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-icon fas fa-map-marked-alt"></i>
                                    <span class="menu-text">{{translate('Branches')}}</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                                            <span class="menu-link">
                                                <span class="menu-text">{{translate('Branches')}}</span>
                                            </span>
                                        </li>

                                        @if(Auth::user()->user_type == 'admin' || in_array('1006', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                                            <li class="menu-item {{ areActiveRoutes(['admin.branchs.index','admin.branchs.update','admin.branchs.show'])}}" aria-haspopup="true">
                                                <a href="{{ route('admin.branchs.index') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">{{translate('All Branches')}}</span>

                                                </a>
                                            </li>
                                            <li class="menu-item {{ areActiveRoutes(['admin.branchs.create'])}}" aria-haspopup="true">
                                                <a href="{{ route('admin.branchs.create') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">{{translate('Add Branch')}}</span>

                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endif

                        <!--Drivers-->
                        @if(in_array($user_type,['admin','branch']) || in_array('1007', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                            <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.captains.index','admin.captains.update','admin.captains.create'])}}" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-icon fas fa-people-carry"></i>
                                    <span class="menu-text">{{translate('Drivers')}}</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                                            <span class="menu-link">
                                                <span class="menu-text">{{translate('Drivers')}}</span>
                                            </span>
                                        </li>

                                        @if(in_array($user_type,['admin','branch']) || in_array('1007', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                                            <li class="menu-item {{ areActiveRoutes(['admin.captains.index','admin.captains.update','admin.captains.create'])}}" aria-haspopup="true">
                                                <a href="{{ route('admin.captains.index') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">{{translate('All Drivers')}}</span>

                                                </a>
                                            </li>
                                            <li class="menu-item {{ areActiveRoutes(['admin.captains.create'])}}" aria-haspopup="true">
                                                <a href="{{ route('admin.captains.create') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">{{translate('Add Driver')}}</span>

                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif

        <!--Reports-->
        @if( in_array($user_type,['admin','customer','branch']) || in_array('10', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.shipments.report'])}}" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon flaticon2-document"></i>
                    <span class="menu-text">{{translate('Reports')}}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">{{translate('Reports')}}</span>
                            </span>
                        </li>
                        <li class="menu-item {{ areActiveRoutes(['admin.shipments.report'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.shipments.report') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot" style="font-size: 10px;"></i>
                                <span class="menu-text">{{translate('Shipments Report')}}</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>
        @endif

        <!--Transactions-->
        @if( in_array($user_type,['admin']) || in_array('1106', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.transactions.index','admin.transactions.create'])}}" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon fas fa-coins"></i>
                    <span class="menu-text">{{translate('Transactions')}}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">{{translate('Transactions')}}</span>
                            </span>
                        </li>
                        <li class="menu-item {{ areActiveRoutes(['admin.transactions.index'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.transactions.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot" style="font-size: 10px;"></i>
                                <span class="menu-text">{{translate('All Transactions')}}</span>
                            </a>
                        </li>
                        <li class="menu-item {{ areActiveRoutes(['admin.transactions.create'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.transactions.create') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot" style="font-size: 10px;"></i>
                                <span class="menu-text">{{translate('Add New Transaction')}}</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>
        @endif
    @endif
@endif

<!--Settings-->
@if ($addon != null)
    @if($addon->activated)
        @if($user_type == 'admin' || in_array('1105', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.shipments.barcode.scanner','admin.deliveryTime.index','admin.packages.index','admin.shipments.settings','admin.shipments.covered_countries','admin.areas.index','admin.areas.create','admin.shipments.settings.fees'])}}" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon fas fa-cogs"></i>
                    <span class="menu-text">{{translate('Shipment Settings')}}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">{{translate('Shipment Settings')}}</span>
                            </span>
                        </li>
                        <li class="menu-item {{ areActiveRoutes(['admin.deliveryTime.index'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.deliveryTime.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('Delivery Times')}}</span>
                            </a>
                        </li>
                        <li class="menu-item {{ areActiveRoutes(['admin.packages.index'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.packages.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('Package Types')}}</span>
                            </a>
                        </li>
                        <li class="menu-item {{ areActiveRoutes(['admin.shipments.covered_countries'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.shipments.covered_countries') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('Covered Places')}}</span>
                            </a>
                        </li>
                        <li class="menu-item {{ areActiveRoutes(['admin.areas.index','admin.areas.create'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.areas.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('Areas Management')}}</span>
                            </a>
                        </li>
                        <li class="menu-item {{ areActiveRoutes(['admin.shipments.settings.fees'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.shipments.settings.fees') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('Shipping rates')}}</span>
                            </a>
                        </li>
                        <li class="menu-item {{ areActiveRoutes(['admin.shipments.settings'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.shipments.settings') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('General Settings')}}</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
        @endif
    @endif
@endif
