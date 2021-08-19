@extends('installation.layout')
@section('content')
    <div id="wizard">
        <h4>Congratulations</h4>
        <a class="steps"><span class="current-info audible"></span><span class="number">1.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">2.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">3.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">4.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">5.</span> </a>
        <a class="steps current"><span class="current-info audible">current step: </span><span class="number">6.</span> </a>
        <section>
            <div class="form-row">
                <div class="tooltip alert-success"> You have successfully completed the installation process. Please Login to continue. </div>
                <div class="tooltip"> Configure the following setting to run the system properly. </div>

                <ol class="list-group">
                    <li class="list-group-item text-semibold"><i class="la la-check"></i> SMTP Setting</li>
                    <li class="list-group-item text-semibold"><i class="la la-check"></i> Payment Method Configuration</li>
                    <li class="list-group-item text-semibold"><i class="la la-check"></i> Social Media Login Configuration</li>
                    <li class="list-group-item text-semibold"><i class="la la-check"></i> Facebook Chat Configuration</li>
                </ol>
                <div class="tooltip">
                    During the installation process, we will check if the files that are needed to be written (<strong>.env file</strong>) have <strong>write permission</strong>. We will also check if <strong>curl</strong> are enabled on your server or not.
                </div>
                <div class="tooltip">
                    Gather the information mentioned above before hitting the start installation button. If you are ready....
                </div>
            </div>
            
            <div class="actions">
                <ul>
                    <li><a href="#" class="disabled">Previous</a></li>
                    <li><a href="{{ env('APP_URL') }}/admin" class="next success">Login to Admin panel</a></li>
                </ul>
            </div>
        </section>
    </div>
@endsection
