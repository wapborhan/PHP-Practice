
<!--begin::Header-->
<div id="kt_header" class="header header-fixed  @if (!trim($__env->yieldContent('subheader'))) has_shadow @endif">

    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default header-menu-root-arrow">
                <!--begin::Header Nav-->
                <ul class="menu-nav">
                    <li class="menu-item menu-item-submenu menu-item-rel ">
                        <a href="{{url('/')}}" target="_blank" class="menu-link">
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero"/>
                                        <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6"/>
                                    </g>
                                </svg><!--end::Svg Icon-->
                            </span>
                        </a>
                    </li>
                    @if (\App\Addon::where('activated', 1)->count() > 0)
                        @foreach(\File::files(base_path('resources/views/backend/inc/addons/topbar')) as $path)
                            @include('backend.inc.addons.topbar.'.str_replace('.blade','',pathinfo($path)['filename']))
                        @endforeach
                    @endif

                </ul>
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>

        <!--begin::Topbar-->
        <div class="topbar">

            <!--begin::Notifications-->
            <div class="dropdown">

                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                        <span class="svg-icon svg-icon-xl svg-icon-primary">

                            <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                                        fill="#000000" />
                                </g>
                            </svg>

                            <!--end::Svg Icon-->
                        </span>
                        @if (\Auth::user()->unreadNotifications->count() > 0)
                            <span class="pulse-ring"></span>
                        @endif
                    </div>
                </div>

                <!--end::Toggle-->

                <!--begin::Dropdown-->
                <div
                    class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    <form>

                        <!--begin::Header-->
                        <div class="d-flex flex-column pt-12 bg-dark-o-5 rounded-top">

                            <!--begin::Title-->
                            <h4 class="d-flex flex-center">
                                <span class="text-dark">{{translate('Your Notifications')}}</span>
                                <span
                                    class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">{{\Auth::user()->unreadNotifications->count()}}
                                    {{translate('new')}}</span>
                            </h4>

                            <!--end::Title-->

                            <!--begin::Tabs-->
                            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary mt-3 px-8"
                                role="tablist">
                            </ul>

                            <!--end::Tabs-->
                        </div>

                        <!--end::Header-->

                        <!--begin::Content-->
                        <div class="tab-content">

                            <!--begin::Tabpane-->
                            <div class="tab-pane active show"
                                id="topbar_notifications_notifications" role="tabpanel">

                                @if (\Auth::user()->unreadNotifications->count() > 0)
                                    <!--begin::Nav-->
                                    <div class="navi navi-hover scroll mb-4" data-scroll="true"
                                        data-height="300" data-mobile-height="200">


                                        @foreach (\Auth::user()->unreadNotifications as $key => $item)
                                            <!--begin::Item-->
                                            <a href="{{ route('notification.view', ['id'=>$item->id] ) }}" class="navi-item">
                                                <div class="navi-link">
                                                    <div class="navi-icon mr-2">
                                                        <i class="@if ($item->icon) {{$item->icon}} @else flaticon2-bell-4 @endif text-success"></i>
                                                    </div>
                                                    <div class="navi-text">
                                                        <div class="font-weight-bold">{{$item->data['message']['subject']}}</div>
                                                        <div class="text-muted">{{$item->created_at->diffForHumans(null, null, true)}}</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <!--end::Item-->
                                        @endforeach

                                    </div>

                                    <!--end::Scroll-->

                                    <!--begin::Action-->
                                    <div class="d-flex flex-center pt-7 mb-4">
                                        <a href="{{ route('notifications') }}"
                                            class="btn btn-light-primary font-weight-bold text-center">{{translate('See
                                            All')}}</a>
                                    </div>
                                    <!--end::Action-->

                                @else
                                    <!--begin::Nav-->
                                    <div class="d-flex flex-center text-center text-muted min-h-200px">{{translate('All caught up!')}} 
                                    <br>{{translate('No new notifications')}}.</div>
                                    <!--end::Nav-->
                                @endif
                            </div>

                            <!--end::Tabpane-->
                        </div>

                        <!--end::Content-->
                    </form>
                </div>

                <!--end::Dropdown-->
            </div>

            <!--end::Notifications-->

            <!--begin::Languages-->
            <div class="dropdown">
                @php
                    if(Session::has('locale')){
                        $locale = Session::get('locale', Config::get('app.locale'));
                    }
                    else{
                        $locale = env('DEFAULT_LANGUAGE');
                    }
                @endphp

                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        <img class="h-20px w-20px rounded-sm"
                            src="{{uploaded_asset(\App\Language::where('code',$locale)->first()->icon)}}"
                            alt="" />
                    </div>
                </div>

                <!--end::Toggle-->

                <!--begin::Dropdown-->
                <div
                    class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right" id="lang-change">

                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">
                        @foreach (\App\Language::all() as $key => $language)
                            <li class="navi-item">
                                <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="navi-link">
                                    <span class="symbol symbol-20 mr-3">
                                        <img src="{{uploaded_asset($language->icon)}}"
                                            alt="{{ $language->name }}" />
                                    </span>
                                    <span class="navi-text">{{ $language->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <!--end::Nav-->
                </div>

                <!--end::Dropdown-->
            </div>

            <!--end::Languages-->

            <!--begin::User-->
            <div class="dropdown">

                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2">
                        <span
                            class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">{{translate('Hi,')}}</span>
                        <span
                            class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{Auth::user()->name}}</span>
                        <div class="symbol symbol-30 mr-3">
                            <img src="{{ uploaded_asset(Auth::user()->avatar_original) }}"onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';" alt="">
                        </div>
                    </div>
                </div>

                <!--end::Toggle-->

                <!--begin::Dropdown-->
                <div
                    class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">

                    <!--begin::Header-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap p-8 bg-dark-o-5 bgi-no-repeat rounded-top">
                        <div class="d-flex align-items-center mr-2">

                            <!--begin::Symbol-->
                            <div class="symbol symbol-30 mr-3">
                                <img src="{{ uploaded_asset(Auth::user()->avatar_original) }}"onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';" alt="">
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Text-->
                            <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">{{Auth::user()->name}}</div>

                            <!--end::Text-->
                        </div>
                    </div>

                    <!--end::Header-->

                    <!--begin::Nav-->
                    <div class="navi navi-spacer-x-0 pt-5">

                        <!--begin::Item-->
                        <a href="{{ route('profile.index') }}"
                            class="navi-item px-8">
                            <div class="navi-link">
                                <div class="navi-icon mr-2">
                                    <i class="flaticon2-calendar-3 text-success"></i>
                                </div>
                                <div class="navi-text">
                                    <div class="font-weight-bold">{{translate('Profile')}}</div>
                                    <div class="text-muted">{{translate('Account settings and more')}}</div>
                                </div>
                            </div>
                        </a>

                        <!--end::Item-->

                        <!--begin::Footer-->
                        <div class="navi-separator mt-3"></div>
                        <div class="navi-footer px-8 py-5">
                            <a href="{{ route('logout')}}"
                                class="btn btn-light-primary font-weight-bold">{{translate('Logout')}}</a>
                        </div>

                        <!--end::Footer-->
                    </div>

                    <!--end::Nav-->
                </div>

                <!--end::Dropdown-->
            </div>

            <!--end::User-->
        </div>

        <!--end::Topbar-->
    </div>

    <!--end::Container-->
</div>