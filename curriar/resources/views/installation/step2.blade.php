@extends('installation.layout')
@section('content')
    <div id="wizard">
        <h4>Purchase Code</h4>
        <a class="steps"><span class="current-info audible"></span><span class="number">1.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">2.</span> </a>
        <a class="steps current"><span class="current-info audible">current step: </span><span class="number">3.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">4.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">5.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">6.</span> </a>
        <a class="steps last"><span class="current-info audible"></span><span class="number">7.</span> </a>
        <section>
            <div class="form-row">
                <div class="tooltip"> Provide your codecanyon purchase code.<br><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank">Where to get purchase code?</a>. </div>
            </div>
            
            <form method="POST" action="{{ route('purchase.code') }}">
                @csrf
                <div class="form-row">
                    <label for="purchase_code">Purchase Code</label>
                    <input type="text" class="form-control" id="purchase_code" name="purchase_code" placeholder="**** **** **** ****" required="">
                </div>
                <div class="actions">
                    <ul>
                        <li><a href="{{ route('step1') }}" class="next">Previous</a></li>
                        <li><button type="submit" class="next">Next</button></li>
                    </ul>
                </div>
            </form>
        </section>
    </div>
@endsection
