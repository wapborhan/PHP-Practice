@extends('installation.layout')
@section('content')
    <div id="wizard">
        <h4>Settings</h4>
        <a class="steps"><span class="current-info audible"></span><span class="number">1.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">2.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">3.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">4.</span> </a>
        <a class="steps current"><span class="current-info audible">current step: </span><span class="number">5.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">6.</span> </a>
        <a class="steps last"><span class="current-info audible"></span><span class="number">7.</span> </a>
        <section>
            <div class="form-row">
                <div class="tooltip"> Fill this form with basic information & admin login credentials. </div>
            </div>

            @if (isset($error))
            <div class="row" style="margin: 20px 0;">
                <div class="col-md-12">
                <div class="tooltip alert alert-danger">
                    <strong>Invalid Data!! </strong>Please check your data carefully
                </div>
                </div>
            </div>
            @endif
            
            <form method="POST" action="{{ route('system_settings') }}">
                @csrf
                <div class="form-row">
                    <label for="admin_name">Admin Name</label>
                    <input type="text" class="form-control" id="admin_name" name="admin_name" required>
                </div>

                <div class="form-row">
                    <label for="admin_email">Admin Email</label>
                    <input type="email" class="form-control" id="admin_email" name="admin_email" required>
                </div>

                <div class="form-row">
                    <label for="admin_password">Admin Password (At least 6 characters)</label>
                    <input type="password" class="form-control" id="admin_password" name="admin_password" required>
                </div>
                <div class="actions">
                    <ul>
                    <li><a href="#" class="disabled">Previous</a></li>
                        <li><button type="submit" class="next">Continue</button></li>
                    </ul>
                </div>
            </form>
        </section>
    </div>
@endsection
