@extends('backend.layouts.app')
@section('style')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        .green-border{
            border: 1px solid #B9BABC;
            box-shadow: 0 0 0 0.2rem rgba(139, 195, 74, .25);
        }
        .dropdown-menu{
            /* max-height: 100% !important; */
            z-index: 100 !important;
        }
        .social-links{
            font-family: fontAwesome
        }
        .button-add-icon >button{
            color: #ffffff;
            background-color: #0BB7AF;
            border-color: #0BB7AF;
            transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease, -webkit-box-shadow 0.15s ease;
            box-shadow: none;
            cursor: pointer;
            text-decoration: none;
            outline: none !important;
            vertical-align: middle;
            display: inline-block;
            font-weight: normal;
            border: 1px solid transparent;
            padding: 0.65rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.42rem;
            user-select: none;
        }
        
        
        {{-- Start Header Theme Stayle --}}
        .theme-header
        {
            padding: 6px 10px;
            background: #23282d;
            border-bottom: 3px solid #0073aa;
        }
        .theme-header .display-header
        {
            margin: 15px;
            text-align: left;
        }
        .theme-header .display-header h2
        {
            font-style: normal;
            padding-right: 5px;
            color: #fff;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
        }
        {{-- End Header Theme Stayle --}}
        {{-- Start Sticky Theme Stayle --}}
        .theme-sticky
        {
            min-height: 32px;
            background: #f3f3f3;
        }
        .theme-sticky .info_bar
        {
            height: 25px;
            background: #f3f3f3;
            border-right: 1px solid #dedede;
            border-left: 1px solid #dedede;
            padding: 6px 10px 6px 6px;
            text-align: right;
            box-sizing: unset;
        }
        .theme-sticky .info_bar .theme-action_bar
        {
            float: right;
        }
        .theme-sticky .info_bar .theme-action_bar .theme-save-btn
        {
            cursor: pointer;
            margin: 0 10px;
            padding: 4px 6px;
            font-size: 12px;
            line-height: 1.44;
            background: #ff7324;
            border:none;
            border-radius: 3px;
            color: #fff;
        }
        {{-- End Sticky Theme Stayle --}}
        {{-- Start Theme Stayle --}}
        .theme
        {
            display: flex;
            background-color:#fff;
            border: 1px solid #dedede;
        }
        .theme .menu-nav
        {
            width:19.4%;
            background-color:#f5f5f5;
            border-right: 1px solid #dedede;
        }
        .theme ul
        {
            list-style:none;
            margin:0px;
            padding:0px;
        }
        .theme .menu-nav .menu-item
        {
            list-style-type: none;
            line-height: 20px;
            background-color: #e7e7e7;
        }
        .theme .menu-nav .menu-item:hover .menu-link
        {
            background: #fff;
            color: black;
        }
        .theme .menu-nav .menu-item:hover .menu-link i
        {
            color: black;
        }
        .theme .menu-nav .menu-item .menu-link
        {
            display: inline-block;
            padding: 10px 4px 10px 14px;
            font-weight: 600;
            text-decoration: none;
            transition: none;
            opacity: .7;
            color: #555;
            width: 100%;
            border: none!important;
            font-size: 14px;
            border-radius: 4px 4px 0 0;
            cursor: pointer;
            text-shadow: none;
        }
        .theme .menu-nav .menu-item .menu-link i
        {
            font-size: 14px;
            color:#7d8287;
        }
        {{-- End Theme Stayle --}}
        
        {{-- Start Active Class Stayle --}}
        .active
        {
            background-color: #fff !important;
        }
        {{-- End Active Class Stayle --}}
        {{-- Start Theme Content Stayle --}}
        .theme-content
        {
            width:80.6%;
            background: #fcfcfc;
            padding: 10px 20px 0;
            box-shadow: inset 0 1px 0 #fff;
        }
        {{-- End Theme Content Stayle --}}
    </style>
    <link href="https://fonts.googleapis.com/css?family=Aclonica|Allan|Annie+Use+Your+Telescope|Anonymous+Pro|Allerta+Stencil|Allerta|Amaranth|Anton|Archivo|Architects+Daughter|Arimo|Artifika|Arvo|Asset|Astloch|Bangers|Bentham|Bevan|Bigshot+One|Bowlby+One|Bowlby+One+SC|Brawler|Buda%3A300|Cabin|Calligraffitti|Candal|Cantarell|Cardo|Carter+One|Caudex|Cedarville+Cursive|Cherry+Cream+Soda|Chewy|Coda|Coming+Soon|Copse|Corben%3A700|Cousine|Covered+By+Your+Grace|Crafty+Girls|Crimson+Text|Crushed|Cuprum|Damion|Dancing+Script|Dawning+of+a+New+Day|DM+Sans|Didact+Gothic|Droid+Sans|Droid+Sans+Mono|Droid+Serif|EB+Garamond|Expletus+Sans|Fontdiner+Swanky|Forum|Francois+One|Geo|Give+You+Glory|Goblin+One|Goudy+Bookletter+1911|Gravitas+One|Gruppo|Hammersmith+One|Holtwood+One+SC|Homemade+Apple|Inconsolata|Indie+Flower|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Irish+Grover|Irish+Growler|Istok+Web|Josefin+Sans|Josefin+Slab|Judson|Jura|Jura%3A500|Jura%3A600|Just+Another+Hand|Just+Me+Again+Down+Here|Kameron|Kenia|Kranky|Kreon|Kristi|La+Belle+Aurore|Lato%3A100|Lato%3A100italic|Lato%3A300|Lato|Lato%3Abold|Lato%3A900|League+Script|Lekton|Limelight|Lobster|Lobster+Two|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Luckiest+Guy|Maiden+Orange|Mako|Maven+Pro|Maven+Pro%3A500|Maven+Pro%3A700|Maven+Pro%3A900|Meddon|MedievalSharp|Megrim|Merriweather|Metrophobic|Michroma|Miltonian+Tattoo|Miltonian|Modern+Antiqua|Monofett|Molengo|Montserrat|Mountains+of+Christmas|Muli%3A300|Muli|Neucha|Neuton|News+Cycle|Nixie+One|Nobile|Noto+Sans|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Nunito%3Alight|Nunito|Nunito+Sans|OFL+Sorts+Mill+Goudy+TT|Old+Standard+TT|Open+Sans%3A300|Open+Sans|Open+Sans%3A600|Open+Sans%3A800|Open+Sans+Condensed%3A300|Orbitron|Orbitron%3A500|Orbitron%3A700|Orbitron%3A900|Oswald|Over+the+Rainbow|Reenie+Beanie|Pacifico|Patrick+Hand|Paytone+One|Permanent+Marker|Philosopher|Play|Playfair+Display|Podkova|Poppins|PT+Sans|PT+Sans+Narrow|PT+Sans+Narrow%3Aregular%2Cbold|PT+Serif|PT+Serif+Caption|Puritan|Quattrocento|Quattrocento+Sans|Radley|Raleway|Raleway%3A100|Redressed|Rock+Salt|Rokkitt|Roboto|Roboto+Condensed|Roboto+Slab|Ruslan+Display|Schoolbell|Shadows+Into+Light|Shanti|Sigmar+One|Six+Caps|Slackey|Smythe|Sniglet%3A800|Special+Elite|Stardos+Stencil|Sue+Ellen+Francisco|Sunshiney|Swanky+and+Moo+Moo|Syncopate|Tajawal|Tangerine|Tenor+Sans|Terminal+Dosis+Light|The+Girl+Next+Door|Tinos|Ubuntu|Ultra|Unkempt|UnifrakturCook%3Abold|UnifrakturMaguntia|Varela|Varela+Round|Vibur|Vollkorn|VT323|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Wire+One|Work+Sans|Yanone+Kaffeesatz|Yanone+Kaffeesatz%3A300|Yanone+Kaffeesatz%3A400|Yanone+Kaffeesatz%3A700|Yeseva+One|Zeyada" rel="stylesheet" type="text/css">
    <link href="{{ static_asset('assets/colorpicker/dist/css/bootstrap-colorpicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ static_asset('assets/iconpicker/dist/fontawesome-5.11.2/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ static_asset('assets/iconpicker/dist/iconpicker-1.5.0.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card bg-dark mb-3" style="background-color: #e7f3fe !important;border-left: 6px solid #2196F3;">
        <div class="card-body">
            <div class="card-text" style="font-size: 17px;">{{ translate('Please note that every language has a different theme option, so please change the language from the header and save the options you need to every language') }}.</div>
        </div>
    </div>
    <!--start::Theme Form-->

    @if (env('DEMO_MODE') == 'On')
        <form method="post" action="#" class="mb-3 form-horizontal" enctype="multipart/form-data" role="form"  id="kt_form">    
    @else
        <form method="post" action="{{ url(config('app_settings.url')) }}" class="mb-3 form-horizontal" enctype="multipart/form-data" role="form"  id="kt_form">
    @endif
        {!! csrf_field() !!}
        <div class="mt-2 aiz-titlebar">
            <!--start::Theme Header-->
            <div class="theme-header">
                <div class="display-header">
                    <h2>{{ translate('Themes options') }}</h2>
                </div>
            </div>
            <!--end::Theme Header-->

            <!--start::Theme Sticky-->
            <div class="theme-sticky">
                <div class="info_bar">
                    <div class="theme-action_bar">
                        <button type="submit" class="theme-save-btn">{{ translate(Arr::get($settings, 'submit_btn_text', 'Save Settings')) }}</button>
                    </div>
                </div>
            </div>
            <!--start::Theme Sticky-->
        </div>

        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="theme" id="tabs">
                    <!--start::Nav Menu-->
                    <ul class="menu-nav">
                        <!--start::Nav Item-->
                        @forelse ($settings['sections'] as $key => $section)
                            @if($loop->first)
                                <li class="menu-item active" aria-haspopup="true">
                            @else 
                                <li class="menu-item" aria-haspopup="true">
                            @endif
                            <a href="#{{$key}}" class="menu-link">
                                <i class="{{$section['icon']}}"></i>
                                <span class="menu-text">{{$section['title'] ?? $section['name']}}</span>
                            </a>
                        </li>
                        <!--end::Nav Item-->
                        @empty

                        @endforelse
                    </ul>
                    <!--end::Menu-->

                    <!--start::Theme Content-->
                    <div class="theme-content">

                        <!--start::Tab Content-->
                        <div class="tab-content">
                            @forelse ($settings['sections'] as $key => $section)
                            
                                <!--begin::Tab-->
                                <div class="tab-pane show px-7" id="{{$key}}" role="tabpanel">
                                        
                                    <!--begin::Row-->
                                    <div class="row">
                                        <div class="my-2 col-xl-12">
                                            @forelse ($section['inputs'] as $field)
                                                <!--begin::Group-->
                                                @includeIf('app_settings::fields.' . $field['type'] )
                                                <!--end::Group-->
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                    
                                </div>
                                <!--end::Tab-->
                            @empty

                            @endforelse
                        </div>
                        <!--end::Tab Content-->

                    </div>
                    <!--end::Theme Content-->
                </div>
            </div>
        </div>
        <!--end::Row-->
    </form>
    <!--end::Theme Foem-->
@endsection

@section('modal')

@endsection

@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ static_asset('assets/iconpicker/dist/iconpicker-1.5.0.js') }}" ></script>
    <script src="{{ static_asset('assets/colorpicker/dist/js/bootstrap-colorpicker.js') }}" ></script>
    <script>
        $(function () {

            @if (env('DEMO_MODE') == 'On')
                $("#kt_form").submit(function(e){
                    e.preventDefault();
				    AIZ.plugins.notify('warning', '{{ translate("This action is disabled in demo mode") }}');

                });   
            @endif
            $(".menu-item").click(function(){
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            });
            $( "#tabs" ).tabs();
            var input_colors = document.getElementsByClassName('color-picker-input');
            var text = '';
            for (let index = 0; index < input_colors.length; index++) {
                text += '#'+ input_colors[index].id + "-div, ";
            }
            text = text.substring(0, text.length-2);
            $(text).colorpicker({
                autoInputFallback: false
            });
        });
        IconPicker.Init({
            jsonUrl: '{{ static_asset('assets/iconpicker/dist/iconpicker-1.5.0.json') }}',
        });
        var iconpicker_ids = [];
        function iconpicker(){
            var icon_buttons = document.getElementsByClassName('icon-picker');
            for (let index = 0; index < icon_buttons.length; index++) {
                IconPicker.Run('#'+icon_buttons[index].id);
                iconpicker_ids.push(icon_buttons[index].id);
            }
            console.log('function iconpicker():');
            console.log(iconpicker_ids);
        }
        iconpicker();
        function add_row(){
            var values_name = [];
            var values_count = [];
            var x = document.getElementsByClassName("{{$active_theme . '_social_links_name_'.app()->getLocale() }}");
            // var y = document.getElementsByClassName("{{$active_theme}}_social_links_count");
            for (let index = 0; index < x.length; index++) {
                values_name.push(x[index].value ?? "");
                // values_count.push(y[index].value ?? "");
            }
            
            var content = document.getElementById('content_rows');
            var count = iconpicker_ids.length +1 ;
            content.innerHTML += row_content(count);
            for (let index = 0; index < x.length; index++) {
                x[index].value = values_name[index] ?? "";
                // y[index].value = values_count[index] ?? "";
            }

            iconpicker_ids.push('GetIconPicker-'+count);
            for (let index = 0; index < iconpicker_ids.length; index++) {
                if(document.getElementById(iconpicker_ids[index])){
                    IconPicker.Run('#'+iconpicker_ids[index]);
                }
            }
            console.log(iconpicker_ids);
        }

        function row_content(id) {
            var row= `<div class="row gutters-5">
                    <div class="col-4">
                        <div class="form-group">
                            <input type="text" class="form-control {{$active_theme . '_social_links_name_'.app()->getLocale() }}" placeholder="https://" name="{{$active_theme . '_social_links_name_'.app()->getLocale() }}[]">
                        </div>
                    </div>
                    <div class="col-3 button-add-icon">
                        <button type="button" id="GetIconPicker-`+id+`" data-iconpicker-input="#MyIconInput-`+id+`" data-iconpicker-preview="#MyIconPreview-`+id+`" class="icon-picker">Select Icon</button>
                        <input type="hidden" name="{{$active_theme . '_social_links_icon_'.app()->getLocale() }}[]" id="MyIconInput-`+id+`">
                    </div>
                    <div class="col-3">
                        <i id="MyIconPreview-`+id+`" style="font-size: 35px;color: black;"></i>
                    </div>
                    <div class="col-2">
                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-03-11-144509/theme/html/demo1/dist/../src/media/svg/icons/Code/Error-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </button>
                    </div>
                </div>`;
            return row;

        }

    </script>
@endsection