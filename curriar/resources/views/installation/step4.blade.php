@extends('installation.layout')
@section('content')
    <div id="wizard">
        <h4>Import SQL</h4>
        <a class="steps"><span class="current-info audible"></span><span class="number">1.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">2.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">3.</span> </a>
        <a class="steps current"><span class="current-info audible">current step: </span><span class="number">4.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">5.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">6.</span> </a>
        <a class="steps last"><span class="current-info audible"></span><span class="number">7.</span> </a>
        <section>
            <div class="form-row">
                <div class="tooltip alert-success"> 
                    <strong>Your database is successfully connected</strong>.   
                </div>
                <div class="tooltip"> 
                    All you need to do now is <strong>hit the 'Import SQL' button</strong>. The auto installer will run a sql file, will do all the tiresome works and set up your application automatically.    
                </div>
            </div>
            
            <div id="loader" style="margin-top: 20px; display: none;">
                
                Please waite, we are importing database&nbsp;&nbsp;<img loading="lazy"  src="{{ static_asset('assets/installation/images/loader.gif') }}" alt="" width="20">
            </div>
            
            <div class="actions">
                <ul>
                    <li><a href="{{ route('step3') }}" class="next">Previous</a></li>
                    <li><a href="{{ route('import_sql') }}" class="next" onclick="showLoder()">Import SQL</a></li>
                </ul>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        function showLoder() {
            document.getElementById("loader").style.display = "block";
        }
    </script>
@endsection
