@extends('backend.layouts.app')


@section('subheader')
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">{{ translate('All Notifications') }}</h5>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection

@section('content')

    <div class="tab-content">

        <!--begin::Tabpane-->
        <div class="tab-pane active show"
            id="topbar_notifications_notifications" role="tabpanel">

            @if ($notifications->count() > 0)
                <!--begin::Nav-->
                <div class="navi navi-hover scroll" data-scroll="true"
                    data-height="420" data-mobile-height="300">

                    @foreach ($notifications as $key => $item)
                        <!--begin::Item-->
                        <a href="{{ route('notification.view', ['id'=>$item->id] ) }}" class="navi-item">
                            <div class="navi-link">
                                <div class="mr-2 navi-icon">
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

            @else
                <!--begin::Nav-->
                <div class="text-center d-flex flex-center text-muted min-h-200px">{{translate('All caught up!')}}
                <br>{{translate('No new notifications')}}.</div>
                <!--end::Nav-->
            @endif
        </div>

        <!--end::Tabpane-->
    </div>

@endsection
