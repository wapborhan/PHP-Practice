@extends('backend.clients.show',['currentView'=>'show'])
@section('profile')
<div class="card card-custom  gutter-b">
    <!--begin::Body-->
    <div class="card-body p-0">
        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
            <span class="symbol symbol-50 symbol-light-success mr-2">
                <span class="symbol-label">
                    <span class="svg-icon svg-icon-xl svg-icon-success">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                </span>
            </span>
            <div class="d-flex flex-column text-right">
                <span class="text-dark-75 font-weight-bolder font-size-h3">{{$transactions->sum('value')}}</span>
                <span class="text-muted font-weight-bold mt-2">{{translate('Total Balance')}}</span>
            </div>
        </div>
    </div>
    <!--end::Body-->
</div>
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{translate('Transactions')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">{{translate('Transactions History')}}</span>
        </h3>
        <div class="card-toolbar">

        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
                <thead>
                    <tr class="text-uppercase">

                        <th class="pl-0" style="min-width: 100px">{{translate('Transaction ID')}}</th>
                        <th style="min-width: 120px">{{translate('Value')}}</th>
                        <th style="min-width: 150px">
                            <span class="text-primary">{{translate('Type')}}</span>
                        </th>
                        <th style="min-width: 150px">{{translate('Product Code')}}</th>
                        <th style="min-width: 150px">{{translate('Transaction Date')}}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>

                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">TR-{{$transaction->id}}</a>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$transaction->value}}</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg"> @if($transaction->type == \App\Transaction::MESSION_TYPE) {{translate('Mission')}} @elseif($transaction->type == \App\Transaction::SHIPMENT_TYPE) {{translate('Shipment')}} @endif</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">@if($transaction->type == \App\Transaction::MESSION_TYPE) M {{$transaction->mission_id}} @elseif($transaction->type == \App\Transaction::SHIPMENT_TYPE) D {{$transaction->shipment_id}} @endif</span>
                        </td>
                        <td>
                            <span class="label label-lg label-light-primary label-inline">{{$transaction->created_at}}</span>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
    var _initStatsWidget11 = function () {
        var element = document.getElementById("kt_stats_widget_11_chart_transactions");

        var height = parseInt(KTUtil.css(element, 'height'));
        var color = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'success';

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Net Profit',
                data: <?=json_encode($chart_values)?>
            }],
            chart: {
                type: 'area',
                height: 150,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                sparkline: {
                    enabled: true
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [KTApp.getSettings()['colors']['theme']['base'][color]]
            },
            xaxis: {
                categories: <?=json_encode($chart_categories)?>,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: false,
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                },
                crosshairs: {
                    show: false,
                    position: 'front',
                    stroke: {
                        color: KTApp.getSettings()['colors']['gray']['gray-300'],
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                min: 0,
                max: 55,
                labels: {
                    show: false,
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function (val) {
                        return "$" + val + " thousands"
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
            markers: {
                colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
                strokeColor: [KTApp.getSettings()['colors']['theme']['base'][color]],
                strokeWidth: 3
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }
  
});
</script>
@endsection