@extends('installation.layout')
@section('content')
    <div id="wizard">
        <h4>Checking file permissions</h4>
        <a class="steps"><span class="current-info audible"></span><span class="number">1.</span> </a>
        <a class="steps current"><span class="current-info audible">current step: </span><span class="number">2.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">3.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">4.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">5.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">6.</span> </a>
        <a class="steps last"><span class="current-info audible"></span><span class="number">7.</span> </a>
        <section>
            <div class="form-row">
                <div class="tooltip"> We ran diagnosis on your server. Review the items that have a red mark on it. <br> If everything is green, you are good to go to the next step. </div>

                <ul class="list-group">
                    @php
                        $phpVersion = number_format((float)phpversion(), 2, '.', '');
                    @endphp
                    <li class="list-group-item text-semibold check @if ($phpVersion >= 7.20) check success @else close faild @endif">
                        Php version 7.2 +
                    </li>
                    <li class="list-group-item text-semibold @if ($permission['curl_enabled']) check success @else close faild @endif">
                        Curl Enabled
                    </li>
                    <li class="list-group-item text-semibold check @if ($permission['db_file_write_perm']) check success @else close faild @endif">
                        <b>.env</b> File Permission
                    </li>
                    <li class="list-group-item text-semibold check @if ($permission['routes_file_write_perm']) check success @else close faild @endif">
                        <b>RouteServiceProvider.php</b> File Permission
                    </li>
                </ul>
            </div>
            
            <div class="actions">
                <ul>
                    <li><a href="{{ url('/') }}">Previous</a></li>

                    @if ($permission['curl_enabled'] == 1 && $permission['db_file_write_perm'] == 1 && $permission['routes_file_write_perm'] == 1 && $phpVersion >= 7.20)
                        @if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1')
                            <li><a href="{{ route('step3') }}" class="next">Next</a></li>
                        @else
                            <li><a href="{{ route('step2') }}" class="next">Next</a></li>
                        @endif
                    @endif
                </ul>
            </div>
        </section>
    </div>
@endsection
