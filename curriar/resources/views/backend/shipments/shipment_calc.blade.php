@php
    $checked_google_map = \App\BusinessSetting::where('type', 'google_map')->first();
    $mile_price         = \App\ShipmentSetting::getVal('def_mile_cost');
    $countries = \App\Country::where('covered',1)->get();
    $packages = \App\Package::all();
    $is_def_mile_or_fees = \App\ShipmentSetting::getVal('is_def_mile_or_fees');
    
    // is_def_mile_or_fees if result 1 for mile if result 2 for fees

@endphp
<html>
    <head>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: 'Roboto', sans-serif;
            }

            #grad1 {

                padding:34px !important;
                background: #eeeeee !important;
            }

            #msform {
                position: relative;
                margin-top: 20px
            }

            #msform fieldset .form-card {
                background: white;
                border: 0 none;
                border-radius: 0px;
                padding: 20px 40px 30px 40px;
                box-sizing: border-box;
                width: 94%;
                margin: 0 3% 20px 3%;
                position: relative
            }

            #msform fieldset {
                background: white;
                border: 0 none;
                border-radius: 0.5rem;
                box-sizing: border-box;
                width: 100%;
                margin: 0;
                padding-bottom: 20px;
                position: relative
            }

            #msform fieldset:not(:first-of-type) {
                display: none
            }

            #msform fieldset .form-card {
                text-align: left;
                color: #9E9E9E
            }

            #msform input,
            #msform textarea {
                padding: 0px 8px 4px 0px;
                border: none;
                margin-bottom: 20px;
                margin-top: 2px;
                box-sizing: border-box;
                color: #2C3E50;
                font-size: 18px;
                font-weight:800;
                font-family: "Roboto";
            }

            #msform .action-button {
                float:right;
                background: #FF700A;
                font-size:14px;
                border-width:2px;
                border-style:solid;
                font-weight: 400;
                border-radius: 90px;
                color: white;
                cursor: pointer;
                padding: 14px 24px 16px 32px;
                margin-top: 50px;
                margin-right: 30px
            }

            #msform .action-button:hover,
            #msform .action-button:focus {
               background: #fff;
               border: 1px solid #FF700A;
               color: #8a859d;
            }

            #msform .action-button-previous {
                background: #616161;
                float:right;
                font-size:14px;
                border-width:2px;
                border-style:solid;
                font-weight: 400;
                border-radius: 90px;
                color: white;
                cursor: pointer;
                padding: 14px 24px 16px 32px;
                margin-top: 50px;
                margin-right: 10px
            }

            #msform .action-button-previous:hover,
            #msform .action-button-previous:focus {
                background: #fff;
                border: 1px solid #616161;
                color: #8a859d;
            }

            select.list-dt {
                border: none;
                outline: 0;
                border-bottom: 1px solid #ccc;
                padding: 2px 5px 3px 5px;
                margin: 2px
            }

            select.list-dt:focus {
                border-bottom: 2px solid skyblue
            }

            .card {
                z-index: 0;
                border: none;
                position: relative
            }

            .fs-title {
                font-size: 25px;
                color: #2C3E50;
                margin-bottom: 10px;
                font-weight: bold;
                text-align: left
            }

            #progressbar {
                margin-bottom: 50px;
                overflow: hidden;
                font-size: 16px;
                color: #2c3e50;
            }

            #progressbar .active {
                color: #2c3e50;
            }

            #progressbar li {
                list-style-type: none;
                width: 25%;
                float: left;
                position: relative
            }

            #progressbar #account:before {
                font-family: FontAwesome;
                font-size: 18px;
                line-height:50px;
                font-weight: bold;
                content: "1"
            }

            #progressbar #personal:before {
                font-family: FontAwesome;
                font-size: 18px;
                line-height:50px;
                font-weight: bold;
                content: "2"
            }

            #progressbar #payment:before {
                font-family: FontAwesome;
                font-size: 18px;
                line-height:50px;
                font-weight: bold;
                content: "3"
            }

            #progressbar #confirm:before {
                font-family: FontAwesome;
                font-size: 18px;
                line-height:50px;
                font-weight: bold;
                content: "4"
            }

            #progressbar li:before {
                width: 50px;
                height: 50px;
                line-height: 45px;
                display: block;
                font-size: 18px;
                line-height:50px;
                color: #77889a;
                background: #eaecee;
                border-radius: 50%;
                margin: 0 auto 10px auto;
                padding: 2px
            }

            #progressbar li:after {
                content: '';
                width: 81%;
                height: 1px;
                background: #eaecee;
                position: absolute;
                right: 190;
                top: 25px;
                z-index: -1
            }

            .progressbar-account:after {
                content: '';
                width: 0% !important;
                height: 0px;
                background: lightgray;
                position: absolute;
                right: 190;
                top: 25px;
                z-index: -1
            }

            #progressbar li.active:before,
            #progressbar li.active:after {
                background: #ff700a;
                color: #fff;
                font-weight: 700;
            }

            .radio-group {
                position: relative;
                margin-bottom: 25px
            }

            .radio {
                display: inline-block;
                width: 204;
                height: 104;
                border-radius: 0;
                background: lightblue;
                box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
                box-sizing: border-box;
                cursor: pointer;
                margin: 8px 2px
            }

            .radio:hover {
                box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
            }

            .radio.selected {
                box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
            }

            .fit-image {
                width: 100%;
                object-fit: cover
            }

            .nav-tabs .nav-item {
                text-align: center !important;
                border-left: 1px solid #eaecee !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
                text-transform:uppercase !important;
            }
            .nav-tabs {
                border-bottom: 2px solid #ff700a !important;
                border-top: 1px solid #eaecee !important;
                border-right: 1px solid #eaecee !important;
            }
            .nav-tabs .nav-link {
                border: none !important;
                color: #eaecee !important;
            }
            .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
                color: #fff !important;
                width: 100% !important;
                padding: 18px !important;
                background-color: #ff700a !important;
                border-radius: 0px !important;
            }
            .chbs-form-label-group{
                display:block;
                font-size:14px;
                font-weight:400;
                text-transform:uppercase;
                padding:14px 21px 15px 21px;
                background-color:#eaecee;
                color:#8a859d;
                text-align: left;
            }

            .fade{
                border-left: 1px solid #eaecee ;
                border-right: 1px solid #eaecee ;
            }
            .chbs-form-field{
                position:relative;
                text-align: left;
                padding:18px 0px 0px 20px;
                border-bottom: 1px solid #eaecee ;
            }

            .chbs-form-field label {
                clear:both;
                margin-bottom:7px;
                display:inline-block;
                font-weight:400;
                font-size:12px;
                text-transform:uppercase;
                color:#778591;
                display: block;
            }
            .chbs-form-field input{
                outline: none;
                width: 100%;
            }
            .chbs-form-field select{
                outline: none;
                border:0px;
                width:100%;
                color: #2C3E50;
                font-size: 18px;
                font-weight:800;
                font-family: "Roboto";
                margin-top:7px;
                margin-bottom: 20px;
                appearance: none;
            }

            #change-country:focus{
                border:0px;
                outline:none;
            }
            label {
                margin-bottom: 0px !important;
            }

            option{

            }

            .chbs-meta{
                width: 50%;
                padding:30px 30px 28px 40px;
                border-right: 1px solid #eaecee;
                border-bottom: 1px solid #eaecee;
            }
            .chbs-meta-icon-route{
                color:#FF700A;
                font-size:48px;
                margin-top:4px;
                float:left;
                margin-right: 30px;

            }
            .chbs-meta-title{
                color:#778591;
                display:block;
                text-align: left;
                font-size:12px;
                font-weight:400;
            }
            .chbs-meta-count{
                color:#2C3E50;
                display:block;
                text-align: left;
                font-size:21;
                padding-top:4px;
                font-weight:400;
            }

            .error{
                position: absolute;
                top: -6px;
                font-size: 12.5;
                background-color: #FFD2D2;
                padding: 10px;
                color:#D8000C;
                width:200px !important;
                display: none;
            }
            .error::before{
                content: "";
                width: 0px;
                height: 0px;
                border-bottom: solid rgba(0,0,0,0) 15px;
                border-right: solid rgba(0,0,0,0) 15px;
                border-left: solid #FFD2D2 15px;
                position: absolute;
                top: 30px;
                left: 0%;
            }
        </style>
    </head>
    <body>
        <!-- MultiStep Form -->
        <div id="grad1">
            <div class="row justify-content-center">
                <div class="text-center col-11 col-sm-9 col-md-7 col-lg-12">
                    <div class="card">
                        <div class="row">
                            <div class="mx-0 col-md-12">
                                @if( $is_def_mile_or_fees == '1' || $is_def_mile_or_fees == '2' )
                                    <form id="msform">
                                        <!-- progressbar -->
                                        <ul id="progressbar">
                                            <li class="active progressbar-account" id="account">{{translate('Enter Ride Details')}}</li>
                                            <li id="personal">{{translate('Personal')}}</li>
                                            <li id="payment">{{translate('Payment')}}</li>
                                            <li id="confirm">{{translate('Finish')}}</li>
                                        </ul> <!-- fieldsets -->
                                        <fieldset>
                                            <div style="padding: 0px 30px 0px 30px;">

                                                <div class="row">
                                                    <div @if( $is_def_mile_or_fees =='1') class="col-md-6" @else class="col-md-12" @endif >
                                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                            <li class="nav-item" style="width: 50% !important;">
                                                                <a class="nav-link active" id="location-tab" data-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="true">{{translate('Location')}}</a>
                                                            </li>

                                                            @if( $is_def_mile_or_fees =='2')
                                                                <li class="nav-item" style="width: 50% !important;">
                                                                    <a class="nav-link" id="pickup-tab" data-toggle="tab" href="#pickup" role="tab" aria-controls="pickup" aria-selected="false">{{translate('pickup')}}</a>
                                                                </li>
                                                            @endif

                                                            @if( $is_def_mile_or_fees =='1')
                                                                <li class="nav-item" @if($is_def_mile_or_fees =='1') style="width: 50% !important;" @else style="width: 33.3% !important;" @endif>
                                                                    <a class="nav-link" id="distance-tab" data-toggle="tab" href="#distance" role="tab" aria-controls="distance" aria-selected="false">{{translate('Distance')}}</a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                        <div class="tab-content" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="location" role="tabpanel" aria-labelledby="location-tab">
                                                                <label class="chbs-form-label-group">{{translate('details')}}</label>
                                                                <div @if( $is_def_mile_or_fees =='2') style="display:flex;" @endif>
                                                                    <div class="chbs-form-field" @if( $is_def_mile_or_fees =='2') style="width:50%" @endif>
                                                                        <div class="error" id="error_from_country">{{translate('Enter a valid Country')}}</div>
                                                                        <label style="padding-left: 4px;">{{translate('From Country')}}:</label>
                                                                        <div class="search_categories">
                                                                            <div class="select">
                                                                                <select id="change-country" name="Shipment[from_country_id]" class="form-select select-country">
                                                                                    <option value="null">{{translate('Select Country')}}</option>
                                                                                    @foreach($countries as $country)
                                                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chbs-form-field" @if( $is_def_mile_or_fees =='2') style="width:50%" @endif>
                                                                        <div class="error" id="error_to_country">{{translate('Enter a valid Country')}}</div>
                                                                        <label style="padding-left: 4px;">{{translate('To Country')}}:</label>
                                                                        <select id="change-country-to" name="Shipment[to_country_id]" class="select-country">
                                                                            <option value="null">{{translate('Select Country')}}</option>
                                                                            @foreach($countries as $country)
                                                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div @if( $is_def_mile_or_fees =='2') style="display:flex;" @endif>
                                                                    <div class="chbs-form-field" @if( $is_def_mile_or_fees =='2') style="width:50%" @endif>
                                                                        <label style="padding-left: 4px;">{{translate('From Region')}}:</label>
                                                                        <select id="change-state-from" name="Shipment[from_state_id]" class="select-country">
                                                                            <option>{{translate('Select Country First')}}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="chbs-form-field" @if( $is_def_mile_or_fees =='2') style="width:50%" @endif>
                                                                        <label style="padding-left: 4px;">{{translate('To Region')}}:</label>
                                                                        <select id="change-state-to" name="Shipment[to_state_id]" class="select-country">
                                                                            <option>{{translate('Select Country First')}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="tab-pane fade" id="pickup" role="tabpanel" aria-labelledby="pickup-tab">
                                                                <label class="chbs-form-label-group">{{translate('package details')}}</label>
                                                                <div style="display:flex;">

                                                                    <div class="chbs-form-field" style="width:50%">
                                                                        <label style="padding-left: 4px;">{{translate('Package Name')}}:</label>
                                                                        <select id="package_id" name="package_id" class="select-country kt-select2">
                                                                            @foreach($packages as $package)
                                                                                <option @if(\App\ShipmentSetting::getVal('def_package_type')==$package->id) selected @endif value="{{$package->id}}">{{$package->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="chbs-form-field" style="width:50%">
                                                                        <div class="error" id="error_weight">{{translate('Enter a valid Weight')}}</div>
                                                                        <div class="error" id="error_weight_country">{{translate('Enter a valid Country')}}</div>
                                                                        <label>{{translate('Total Weight')}}:</label>
                                                                        <input autocomplete="off" id="total_weight" placeholder="{{translate('Total Weight')}}" type="number" min="1" class="total-weight" value="1" name="Shipment[total_weight]" />
                                                                    </div>
                                                                    
                                                                </div>

                                                            </div>

                                                            <div class="tab-pane fade" id="distance" role="tabpanel" aria-labelledby="distance-tab">

                                                                <label class="chbs-form-label-group">{{translate('Ride details')}}</label>

                                                                <div class="chbs-form-field">
                                                                    <div class="error" id="error_pickup">{{translate('Enter a valid Pickup location')}}</div>
                                                                    <label>{{translate('Pickup location')}}</label>
                                                                    <input class="pickup-location" id="from_places" autocomplete="off" placeholder="{{translate('Enter a location')}}"/>
                                                                    <input id="origin" name="origin" required="" type="hidden"/>
                                                                </div>

                                                                <div class="chbs-form-field">
                                                                    <div class="error" id="error_drop_off">{{translate('Enter a valid Drop-off location')}}</div>
                                                                    <label>{{translate('Drop-off location')}}</label>
                                                                    <input class="drop-off-location" id="to_places" autocomplete="off" placeholder="{{translate('Enter a location')}}"/>
                                                                    <input id="destination" name="destination" required="" type="hidden"/>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    @if( $is_def_mile_or_fees =='1')
                                                        <div class="col-md-6">
                                                            @if($checked_google_map->value == 1 )
                                                                <div class="col-sm-12" id="map" style="width:100%;height:100%;"></div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                                <div id="result" style="box-shadow:0px 18px 19px -20px rgb(0 0 0 / 10%)">
                                                    <div style="border-left: 1px solid #eaecee;display:flex">
                                                        
                                                        @if( $is_def_mile_or_fees =='1')
                                                            <div class="chbs-meta">
                                                                <span class="chbs-meta-icon-route">
                                                                    <i class="fas fa-route"></i>
                                                                </span>
                                                                <div>
                                                                    <span class="chbs-meta-title">{{translate('TOTAL DISTANCE')}}</span>
                                                                    <span class="chbs-meta-count" id="in_mile">0 MI</span>
                                                                </div>
                                                            </div>
                                                            <div class="chbs-meta">
                                                                <span class="chbs-meta-icon-route">
                                                                    <i class="far fa-clock"></i>
                                                                </span>
                                                                <div>
                                                                    <span class="chbs-meta-title">{{translate('TOTAL TIME')}}</span>
                                                                    <span class="chbs-meta-count" id="duration_text">0 H 0 M</span>
                                                                </div>
                                                            </div>
                                                            <div class="chbs-meta">
                                                                <span class="chbs-meta-icon-route">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                                <div>
                                                                    <span class="chbs-meta-title">{{translate('TOTAL PRICE')}}</span>
                                                                    <span class="chbs-meta-count" id="price">0{{currency_symbol()}}</span>
                                                                </div>
                                                            </div>
                                                        @elseif( $is_def_mile_or_fees == '2')
                                                            <div class="chbs-meta">
                                                                <span class="chbs-meta-icon-route">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                                <div>
                                                                    <span class="chbs-meta-title">{{translate('SHIPPING COST')}}</span>
                                                                    <span class="chbs-meta-count" id="shipping_cost">{{currency_symbol()}}0</span>
                                                                </div>
                                                            </div>
                                                            <div class="chbs-meta">
                                                                <span class="chbs-meta-icon-route">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                                <div>
                                                                    <span class="chbs-meta-title">{{translate('TAX COST')}}</span>
                                                                    <span class="chbs-meta-count" id="tax_duty">{{currency_symbol()}}0</span>
                                                                </div>
                                                            </div>
                                                            <div class="chbs-meta">
                                                                <span class="chbs-meta-icon-route">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                                <div>
                                                                    <span class="chbs-meta-title">{{translate('INSURANCE COST')}}</span>
                                                                    <span class="chbs-meta-count" id="insurance">{{currency_symbol()}}0</span>
                                                                </div>
                                                            </div>
                                                            <div class="chbs-meta">
                                                                <span class="chbs-meta-icon-route">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>
                                                                <div>
                                                                    <span class="chbs-meta-title">{{translate('TOTAL COST')}}</span>
                                                                    <span class="chbs-meta-count" id="total_cost">{{currency_symbol()}}0</span>
                                                                </div>
                                                            </div>
                                                        @endif              
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            {{--  <input type="button" name="next" class="next action-button" value="{{translate('Next Step')}}" />  --}}
                                        </fieldset>

                                        <fieldset>
                                            <div class="form-card">
                                                <h2 class="fs-title">Personal Information</h2> <input type="text" name="fname" placeholder="First Name" /> <input type="text" name="lname" placeholder="Last Name" /> <input type="text" name="phno" placeholder="Contact No." /> <input type="text" name="phno_2" placeholder="Alternate Contact No." />
                                            </div>
                                            <input type="button" name="next" class="next action-button" value="Next Step" />
                                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                        </fieldset>

                                        <fieldset>
                                            <div class="form-card">
                                                <h2 class="fs-title">Payment Information</h2>
                                                <div class="radio-group">
                                                    <div class='radio' data-value="credit"><img src="https://i.imgur.com/XzOzVHZ.jpg" width="200px" height="100px"></div>
                                                    <div class='radio' data-value="paypal"><img src="https://i.imgur.com/jXjwZlj.jpg" width="200px" height="100px"></div> <br>
                                                </div> <label class="pay">Card Holder Name*</label> <input type="text" name="holdername" placeholder="" />
                                                <div class="row">
                                                    <div class="col-9"> <label class="pay">Card Number*</label> <input type="text" name="cardno" placeholder="" /> </div>
                                                    <div class="col-3"> <label class="pay">CVC*</label> <input type="password" name="cvcpwd" placeholder="***" /> </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3"> <label class="pay">Expiry Date*</label> </div>
                                                    <div class="col-9"> <select class="list-dt" id="month" name="expmonth">
                                                            <option selected>Month</option>
                                                            <option>January</option>
                                                            <option>February</option>
                                                            <option>March</option>
                                                            <option>April</option>
                                                            <option>May</option>
                                                            <option>June</option>
                                                            <option>July</option>
                                                            <option>August</option>
                                                            <option>September</option>
                                                            <option>October</option>
                                                            <option>November</option>
                                                            <option>December</option>
                                                        </select> <select class="list-dt" id="year" name="expyear">
                                                            <option selected>Year</option>
                                                        </select> </div>
                                                </div>
                                            </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="make_payment" class="next action-button" value="Confirm" />
                                        </fieldset>

                                        <fieldset>
                                            <div class="form-card">
                                                <h2 class="text-center fs-title">Success !</h2> <br><br>
                                                <div class="row justify-content-center">
                                                    <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                                                </div> <br><br>
                                                <div class="row justify-content-center">
                                                    <div class="text-center col-7">
                                                        <h5>You Have Successfully Signed Up</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ static_asset('assets/dashboard/js/geocomplete/jquery.geocomplete.js') }}"></script>
        <script src="//maps.googleapis.com/maps/api/js?libraries=places&key={{$checked_google_map->key}}"></script>
        <script>
            $(document).ready(function(){
                var current_fs, next_fs, previous_fs; //fieldsets
                var opacity;
                $(".next").click(function(){
                    current_fs = $(this).parent();
                    next_fs = $(this).parent().next();

                    //Add Class Active
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    //show the next fieldset
                    next_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function(now) {
                            // for making fielset appear animation
                            opacity = 1 - now;
                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({'opacity': opacity});
                        },
                        duration: 600
                    });
                });
                $(".previous").click(function(){
                    current_fs = $(this).parent();
                    previous_fs = $(this).parent().prev();
                    //Remove class active
                    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                    //show the previous fieldset
                    previous_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function(now) {
                            // for making fielset appear animation
                            opacity = 1 - now;
                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            previous_fs.css({'opacity': opacity});
                        },
                        duration: 600
                    });
                });
                $('.radio-group .radio').click(function(){
                    $(this).parent().find('.radio').removeClass('selected');
                    $(this).addClass('selected');
                });
                $(".submit").click(function(){
                    return false;
                })
            });
            
            $('#change-country').change(function() {
                var id = $(this).val();
                $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
                    $('select[name ="Shipment[from_state_id]"]').empty();
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];

                        $('select[name ="Shipment[from_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
                    }
                });
            });

            $('#change-country-to').change(function() {
                var id = $(this).val();

                $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
                    $('select[name ="Shipment[to_state_id]"]').empty();
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];
                        $('select[name ="Shipment[to_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
                    }


                });
            });

            $(function () {
                var origin, destination, map;

                // add input listeners
                google.maps.event.addDomListener(window, 'load', function (listener) {
                    setDestination();
                    initMap();
                });

                // init or load map
                function initMap() {

                    var myLatLng = {
                        lat: 52.520008,
                        lng: 13.404954
                    };
                    map = new google.maps.Map(document.getElementById('map'), {zoom: 16, center: myLatLng,});
                }

                function setDestination() {
                    var from_places = new google.maps.places.Autocomplete(document.getElementById('from_places'));
                    var to_places = new google.maps.places.Autocomplete(document.getElementById('to_places'));

                    google.maps.event.addListener(from_places, 'place_changed', function () {
                        var from_place = from_places.getPlace();
                        var from_address = from_place.formatted_address;
                        $('#origin').val(from_address);
                    });

                    google.maps.event.addListener(to_places, 'place_changed', function () {
                        var to_place = to_places.getPlace();
                        var to_address = to_place.formatted_address;
                        $('#destination').val(to_address);
                    });


                }

                function displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay) {
                    directionsService.route({
                        origin: origin,
                        destination: destination,
                        travelMode: travel_mode,
                        avoidTolls: true
                    }, function (response, status) {
                        if (status === 'OK') {
                            directionsDisplay.setMap(map);
                            directionsDisplay.setDirections(response);
                        } else {
                            directionsDisplay.setMap(null);
                            directionsDisplay.setDirections(null);
                            alert('Could not display directions due to: ' + status);
                        }
                    });
                }

                // calculate distance , after finish send result to callback function
                function calculateDistance(travel_mode, origin, destination) {

                    var DistanceMatrixService = new google.maps.DistanceMatrixService();
                    DistanceMatrixService.getDistanceMatrix(
                        {
                            origins: [origin],
                            destinations: [destination],
                            travelMode: google.maps.TravelMode[travel_mode],
                            unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
                            // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
                            avoidHighways: false,
                            avoidTolls: false
                        }, save_results);
                }

                // save distance results
                function save_results(response, status) {

                    if (status != google.maps.DistanceMatrixStatus.OK) {
                        $('#result').html(err);
                    } else {
                        var origin = response.originAddresses[0];
                        var destination = response.destinationAddresses[0];
                        if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                            $('#result').html("Sorry , not available to use this travel mode between " + origin + " and " + destination);
                        } else {
                            var distance = response.rows[0].elements[0].distance;
                            var duration = response.rows[0].elements[0].duration;
                            var distance_in_kilo = distance.value / 1000; // the kilo meter
                            var distance_in_mile = distance.value / 1609.34; // the mile
                            var duration_text = duration.text;
                            appendResults(distance_in_kilo, distance_in_mile, duration_text);
                        }
                    }
                }

                // append html results
                function appendResults(distance_in_kilo, distance_in_mile, duration_text) {
                    var price = {{$mile_price}} ;
                    var tota_price = distance_in_mile.toFixed(2) * price ;
                    $('#in_mile').html(distance_in_mile.toFixed(2) + " MI");
                    $('#price').html(tota_price+"{{currency_symbol()}}");
                    $('#duration_text').html(duration_text);
                }

                // on submit  display route ,append results and send calculateDistance to ajax request
                function finishCalculate () {
                    if( {{$is_def_mile_or_fees}} =='1')
                    {
                        var origin = $('#origin').val();
                        var destination = $('#destination').val();
                        var travel_mode = 'DRIVING';
                        var directionsDisplay = new google.maps.DirectionsRenderer({'draggable': false});
                        var directionsService = new google.maps.DirectionsService();
                        displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay);
                        calculateDistance(travel_mode, origin, destination);
                    }else if( {{$is_def_mile_or_fees}} =='2'){
                        ajaxShipmentCost()
                    }
                };

                function ajaxShipmentCost()
                {
                    var package_ids = [];
                        package_ids[0] = new Object();
                        package_ids[0]["package_id"] = document.getElementById('package_id').value;

                        var total_weight    = document.getElementById('total_weight').value;
                        var from_country_id = document.getElementsByName("Shipment[from_country_id]")[0].value;
                        var to_country_id   = document.getElementsByName("Shipment[to_country_id]")[0].value;
                        var from_state_id   = document.getElementsByName("Shipment[from_state_id]")[0].value;
                        var to_state_id     = document.getElementsByName("Shipment[to_state_id]")[0].value;   

                        var request_data = { _token : '{{ csrf_token() }}', 
                                package_ids     : package_ids, 
                                total_weight    : total_weight, 
                                from_country_id : from_country_id, 
                                to_country_id   : to_country_id, 
                                from_state_id   : from_state_id, 
                                to_state_id     : to_state_id, 
                            }; 

                        $.post('{{ route('admin.shipments.get-estimation-cost') }}', request_data, function(response){
                            if( {{$is_def_mile_or_fees}} =='1'){
                                document.getElementById("price").innerHTML = response.total_cost;
                            }else if( {{$is_def_mile_or_fees}} =='2'){
                                document.getElementById("shipping_cost").innerHTML = response.shipping_cost;
                                document.getElementById("tax_duty").innerHTML = response.tax;
                                document.getElementById("insurance").innerHTML = response.insurance;
                                document.getElementById("total_cost").innerHTML = response.total_cost;
                            }
                            
                        });
                }

                $('#to_places').change(function(){
                    var from_places_value = $('#from_places').val();
                    if( from_places_value == "" || from_places_value == null ){
                        validateInput('error_pickup');                        
                    }else{
                        calc_waiting_meil();
                        setTimeout(function(){ finishCalculate() }, 500);
                    }
                    
                });

                $('#from_places').change(function(){
                    var to_places_value = $('#to_places').val();
                    if( to_places_value == "" || to_places_value == null ){
                        validateInput('error_drop_off');
                    }else{
                        calc_waiting_meil();
                        setTimeout(function(){ finishCalculate() }, 500);
                    }
                    
                });

                $('#change-country').on('change', function() {
                    var country_to_value = $('#change-country-to').val();
                    if( country_to_value == 'null' ){
                        validateInput('error_to_country');
                    }else{

                        if( {{$is_def_mile_or_fees}} =='1'){
                            calc_waiting_meil();
                            setTimeout(function(){ ajaxShipmentCost() }, 500);
                        }else if( {{$is_def_mile_or_fees}} =='2'){
                            calc_waiting_fees();
                            setTimeout(function(){ finishCalculate() }, 500);
                        }
                        
                    }
                });

                $('#change-country-to').change(function(){
                    var country_from_value = $('#change-country').val();
                    if( country_from_value == 'null' ){
                        validateInput('error_from_country');
                    }else{
                        if( {{$is_def_mile_or_fees}} =='1'){
                            calc_waiting_meil();
                            setTimeout(function(){ ajaxShipmentCost() }, 500);
                        }else if( {{$is_def_mile_or_fees}} =='2'){
                            calc_waiting_fees();
                            setTimeout(function(){ finishCalculate() }, 500);
                        }
                    }
                    
                });

                $('#change-state-from').change(function(){
                    if( {{$is_def_mile_or_fees}} =='1'){
                        calc_waiting_meil();
                        setTimeout(function(){ finishCalculate() }, 500);
                    }else if( {{$is_def_mile_or_fees}} =='2'){
                        
                        calc_waiting_fees();
                        setTimeout(function(){ ajaxShipmentCost() }, 500);
                    }
                });

                $('#change-state-to').change(function(){
                    if( {{$is_def_mile_or_fees}} =='1'){
                        calc_waiting_meil();
                        setTimeout(function(){ finishCalculate() }, 500);
                    }else if( {{$is_def_mile_or_fees}} =='2'){
                        calc_waiting_fees();
                        setTimeout(function(){ ajaxShipmentCost() }, 500);
                    }  
                });


                $('#package_id').change(function(){
                    calc_waiting();
                    setTimeout(function(){ finishCalculate() }, 500);
                });
                $('#total_weight').keyup(function(){
                    var country_to_value = $('#change-country-to').val();
                    var country_from_value = $('#change-country').val();
                    if( country_to_value != 'null' && country_from_value != 'null' ){
                        calc_waiting();
                        var total_weight_value = $('#total_weight').val();
                        if(total_weight_value == 0 || total_weight_value < 0 || total_weight_value > 10000000 || total_weight_value == "" ){
                            validateInput('error_weight');
                        }else{
                            setTimeout(function(){ finishCalculate() }, 500);
                        }
                    }else{
                        validateInput('error_weight_country');
                    }
                });
                

                function validateInput(id)
                {
                    $("#"+id).fadeIn(300);
                    setTimeout(function(){ 
                        $("#"+id).fadeOut(300);
                    }, 5000);
                }
                function calc_waiting_fees()
                {
                    document.getElementById("shipping_cost").innerHTML = "{{translate('Calculating...')}}";
                    document.getElementById("tax_duty").innerHTML      = "{{translate('Calculating...')}}";
                    document.getElementById("insurance").innerHTML     = "{{translate('Calculating...')}}";
                    document.getElementById("total_cost").innerHTML    = "{{translate('Calculating...')}}";
                }

                function calc_waiting_meil()
                {
                    $('#in_mile').html("{{translate('Calculating...')}}");
                    $('#price').html("{{translate('Calculating...')}}");
                    $('#duration_text').html("{{translate('Calculating...')}}");
                }


            });
        </script>
    </body>
</html>
