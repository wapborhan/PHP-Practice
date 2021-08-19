@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Language Information')}}</h5>
</div>

<div class="col-lg-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('update Language Info')}}</h5>
        </div>
        <div class="card-body p-0">
            <form class="p-4" action="{{ route('languages.update', $language->id) }}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label class="control-label">{{ translate('Name') }}</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="name" placeholder="{{ translate('Name') }}" value="{{ $language->name }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label class="control-label">{{ translate('Code') }}</label>
                    </div>
                    <div class="col-lg-9">
                        <select class="form-control aiz-selectpicker mb-2 mb-md-0" name="code" data-live-search="true">
                            <option  @if($language->code == "af") selected @endif value="af">Afrikaans</option>
                            <option  @if($language->code == "sq") selected @endif value="sq">Albanian - shqip</option>
                            <option  @if($language->code == "am") selected @endif value="am">Amharic - አማርኛ</option>
                            <option  @if($language->code == "ar") selected @endif value="ar">Arabic - العربية</option>
                            <option  @if($language->code == "an") selected @endif value="an">Aragonese - aragonés</option>
                            <option  @if($language->code == "hy") selected @endif value="hy">Armenian - հայերեն</option>
                            <option  @if($language->code == "ast") selected @endif value="ast">Asturian - asturianu</option>
                            <option  @if($language->code == "az") selected @endif value="az">Azerbaijani - azərbaycan dili</option>
                            <option  @if($language->code == "eu") selected @endif value="eu">Basque - euskara</option>
                            <option  @if($language->code == "be") selected @endif value="be">Belarusian - беларуская</option>
                            <option  @if($language->code == "bn") selected @endif value="bn">Bengali - বাংলা</option>
                            <option  @if($language->code == "bs") selected @endif value="bs">Bosnian - bosanski</option>
                            <option  @if($language->code == "br") selected @endif value="br">Breton - brezhoneg</option>
                            <option  @if($language->code == "bg") selected @endif value="bg">Bulgarian - български</option>
                            <option  @if($language->code == "ca") selected @endif value="ca">Catalan - català</option>
                            <option  @if($language->code == "ckb") selected @endif value="ckb">Central Kurdish - کوردی (دەستنوسی عەرەبی)</option>
                            <option  @if($language->code == "zh") selected @endif value="zh">Chinese - 中文</option>
                            <option  @if($language->code == "zh") selected @endif value="zh-HK">Chinese (Hong Kong) - 中文（香港）</option>
                            <option  @if($language->code == "zh") selected @endif value="zh-CN">Chinese (Simplified) - 中文（简体）</option>
                            <option  @if($language->code == "zh") selected @endif value="zh-TW">Chinese (Traditional) - 中文（繁體）</option>
                            <option  @if($language->code == "co") selected @endif value="co">Corsican</option>
                            <option  @if($language->code == "hr") selected @endif value="hr">Croatian - hrvatski</option>
                            <option  @if($language->code == "cs") selected @endif value="cs">Czech - čeština</option>
                            <option  @if($language->code == "da") selected @endif value="da">Danish - dansk</option>
                            <option  @if($language->code == "nl") selected @endif value="nl">Dutch - Nederlands</option>
                            <option  @if($language->code == "en") selected @endif value="en">English</option>
                            <option  @if($language->code == "en") selected @endif value="en-AU">English (Australia)</option>
                            <option  @if($language->code == "en") selected @endif value="en-CA">English (Canada)</option>
                            <option  @if($language->code == "en") selected @endif value="en-IN">English (India)</option>
                            <option  @if($language->code == "en") selected @endif value="en-NZ">English (New Zealand)</option>
                            <option  @if($language->code == "en") selected @endif value="en-ZA">English (South Africa)</option>
                            <option  @if($language->code == "en") selected @endif value="en-GB">English (United Kingdom)</option>
                            <option  @if($language->code == "en") selected @endif value="en-US">English (United States)</option>
                            <option  @if($language->code == "eo") selected @endif value="eo">Esperanto - esperanto</option>
                            <option  @if($language->code == "et") selected @endif value="et">Estonian - eesti</option>
                            <option  @if($language->code == "fo") selected @endif value="fo">Faroese - føroyskt</option>
                            <option  @if($language->code == "fil") selected @endif value="fil">Filipino</option>
                            <option  @if($language->code == "fi") selected @endif value="fi">Finnish - suomi</option>
                            <option  @if($language->code == "fr") selected @endif value="fr">French - français</option>
                            <option  @if($language->code == "fr") selected @endif value="fr-CA">French (Canada) - français (Canada)</option>
                            <option  @if($language->code == "fr") selected @endif value="fr-FR">French (France) - français (France)</option>
                            <option  @if($language->code == "fr") selected @endif value="fr-CH">French (Switzerland) - français (Suisse)</option>
                            <option  @if($language->code == "gl") selected @endif value="gl">Galician - galego</option>
                            <option  @if($language->code == "ka") selected @endif value="ka">Georgian - ქართული</option>
                            <option  @if($language->code == "de") selected @endif value="de">German - Deutsch</option>
                            <option  @if($language->code == "de") selected @endif value="de-AT">German (Austria) - Deutsch (Österreich)</option>
                            <option  @if($language->code == "de") selected @endif value="de-DE">German (Germany) - Deutsch (Deutschland)</option>
                            <option  @if($language->code == "de") selected @endif value="de-LI">German (Liechtenstein) - Deutsch (Liechtenstein)</option>
                            <option  @if($language->code == "de") selected @endif value="de-CH">German (Switzerland) - Deutsch (Schweiz)</option>
                            <option  @if($language->code == "el") selected @endif value="el">Greek - Ελληνικά</option>
                            <option  @if($language->code == "gn") selected @endif value="gn">Guarani</option>
                            <option  @if($language->code == "gu") selected @endif value="gu">Gujarati - ગુજરાતી</option>
                            <option  @if($language->code == "ha") selected @endif value="ha">Hausa</option>
                            <option  @if($language->code == "haw") selected @endif value="haw">Hawaiian - ʻŌlelo Hawaiʻi</option>
                            <option  @if($language->code == "he") selected @endif value="he">Hebrew - עברית</option>
                            <option  @if($language->code == "hi") selected @endif value="hi">Hindi - हिन्दी</option>
                            <option  @if($language->code == "hu") selected @endif value="hu">Hungarian - magyar</option>
                            <option  @if($language->code == "is") selected @endif value="is">Icelandic - íslenska</option>
                            <option  @if($language->code == "id") selected @endif value="id">Indonesian - Indonesia</option>
                            <option  @if($language->code == "ia") selected @endif value="ia">Interlingua</option>
                            <option  @if($language->code == "ga") selected @endif value="ga">Irish - Gaeilge</option>
                            <option  @if($language->code == "it") selected @endif value="it">Italian - italiano</option>
                            <option  @if($language->code == "it") selected @endif value="it-IT">Italian (Italy) - italiano (Italia)</option>
                            <option  @if($language->code == "it") selected @endif value="it-CH">Italian (Switzerland) - italiano (Svizzera)</option>
                            <option  @if($language->code == "ja") selected @endif value="ja">Japanese - 日本語</option>
                            <option  @if($language->code == "kn") selected @endif value="kn">Kannada - ಕನ್ನಡ</option>
                            <option  @if($language->code == "kk") selected @endif value="kk">Kazakh - қазақ тілі</option>
                            <option  @if($language->code == "km") selected @endif value="km">Khmer - ខ្មែរ</option>
                            <option  @if($language->code == "ko") selected @endif value="ko">Korean - 한국어</option>
                            <option  @if($language->code == "ku") selected @endif value="ku">Kurdish - Kurdî</option>
                            <option  @if($language->code == "ky") selected @endif value="ky">Kyrgyz - кыргызча</option>
                            <option  @if($language->code == "lo") selected @endif value="lo">Lao - ລາວ</option>
                            <option  @if($language->code == "la") selected @endif value="la">Latin</option>
                            <option  @if($language->code == "lv") selected @endif value="lv">Latvian - latviešu</option>
                            <option  @if($language->code == "ln") selected @endif value="ln">Lingala - lingála</option>
                            <option  @if($language->code == "lt") selected @endif value="lt">Lithuanian - lietuvių</option>
                            <option  @if($language->code == "mk") selected @endif value="mk">Macedonian - македонски</option>
                            <option  @if($language->code == "ms") selected @endif value="ms">Malay - Bahasa Melayu</option>
                            <option  @if($language->code == "ml") selected @endif value="ml">Malayalam - മലയാളം</option>
                            <option  @if($language->code == "mt") selected @endif value="mt">Maltese - Malti</option>
                            <option  @if($language->code == "mr") selected @endif value="mr">Marathi - मराठी</option>
                            <option  @if($language->code == "mn") selected @endif value="mn">Mongolian - монгол</option>
                            <option  @if($language->code == "ne") selected @endif value="ne">Nepali - नेपाली</option>
                            <option  @if($language->code == "no") selected @endif value="no">Norwegian - norsk</option>
                            <option  @if($language->code == "nb") selected @endif value="nb">Norwegian Bokmål - norsk bokmål</option>
                            <option  @if($language->code == "nn") selected @endif value="nn">Norwegian Nynorsk - nynorsk</option>
                            <option  @if($language->code == "oc") selected @endif value="oc">Occitan</option>
                            <option  @if($language->code == "or") selected @endif value="or">Oriya - ଓଡ଼ିଆ</option>
                            <option  @if($language->code == "om") selected @endif value="om">Oromo - Oromoo</option>
                            <option  @if($language->code == "ps") selected @endif value="ps">Pashto - پښتو</option>
                            <option  @if($language->code == "fa") selected @endif value="fa">Persian - فارسی</option>
                            <option  @if($language->code == "pl") selected @endif value="pl">Polish - polski</option>
                            <option  @if($language->code == "pt") selected @endif value="pt">Portuguese - português</option>
                            <option  @if($language->code == "pt") selected @endif value="pt-BR">Portuguese (Brazil) - português (Brasil)</option>
                            <option  @if($language->code == "pt") selected @endif value="pt-PT">Portuguese (Portugal) - português (Portugal)</option>
                            <option  @if($language->code == "pa") selected @endif value="pa">Punjabi - ਪੰਜਾਬੀ</option>
                            <option  @if($language->code == "qu") selected @endif value="qu">Quechua</option>
                            <option  @if($language->code == "ro") selected @endif value="ro">Romanian - română</option>
                            <option  @if($language->code == "mo") selected @endif value="mo">Romanian (Moldova) - română (Moldova)</option>
                            <option  @if($language->code == "rm") selected @endif value="rm">Romansh - rumantsch</option>
                            <option  @if($language->code == "ru") selected @endif value="ru">Russian - русский</option>
                            <option  @if($language->code == "gd") selected @endif value="gd">Scottish Gaelic</option>
                            <option  @if($language->code == "sr") selected @endif value="sr">Serbian - српски</option>
                            <option  @if($language->code == "sh") selected @endif value="sh">Serbo-Croatian - Srpskohrvatski</option>
                            <option  @if($language->code == "sn") selected @endif value="sn">Shona - chiShona</option>
                            <option  @if($language->code == "sd") selected @endif value="sd">Sindhi</option>
                            <option  @if($language->code == "si") selected @endif value="si">Sinhala - සිංහල</option>
                            <option  @if($language->code == "sk") selected @endif value="sk">Slovak - slovenčina</option>
                            <option  @if($language->code == "sl") selected @endif value="sl">Slovenian - slovenščina</option>
                            <option  @if($language->code == "so") selected @endif value="so">Somali - Soomaali</option>
                            <option  @if($language->code == "st") selected @endif value="st">Southern Sotho</option>
                            <option  @if($language->code == "es") selected @endif value="es">Spanish - español</option>
                            <option  @if($language->code == "es") selected @endif value="es-AR">Spanish (Argentina) - español (Argentina)</option>
                            <option  @if($language->code == "es") selected @endif value="es-419">Spanish (Latin America) - español (Latinoamérica)</option>
                            <option  @if($language->code == "es") selected @endif value="es-MX">Spanish (Mexico) - español (México)</option>
                            <option  @if($language->code == "es") selected @endif value="es-ES">Spanish (Spain) - español (España)</option>
                            <option  @if($language->code == "es") selected @endif value="es-US">Spanish (United States) - español (Estados Unidos)</option>
                            <option  @if($language->code == "su") selected @endif value="su">Sundanese</option>
                            <option  @if($language->code == "sw") selected @endif value="sw">Swahili - Kiswahili</option>
                            <option  @if($language->code == "sv") selected @endif value="sv">Swedish - svenska</option>
                            <option  @if($language->code == "tg") selected @endif value="tg">Tajik - тоҷикӣ</option>
                            <option  @if($language->code == "ta") selected @endif value="ta">Tamil - தமிழ்</option>
                            <option  @if($language->code == "tt") selected @endif value="tt">Tatar</option>
                            <option  @if($language->code == "te") selected @endif value="te">Telugu - తెలుగు</option>
                            <option  @if($language->code == "th") selected @endif value="th">Thai - ไทย</option>
                            <option  @if($language->code == "ti") selected @endif value="ti">Tigrinya - ትግርኛ</option>
                            <option  @if($language->code == "to") selected @endif value="to">Tongan - lea fakatonga</option>
                            <option  @if($language->code == "tr") selected @endif value="tr">Turkish - Türkçe</option>
                            <option  @if($language->code == "tk") selected @endif value="tk">Turkmen</option>
                            <option  @if($language->code == "tw") selected @endif value="tw">Twi</option>
                            <option  @if($language->code == "uk") selected @endif value="uk">Ukrainian - українська</option>
                            <option  @if($language->code == "ur") selected @endif value="ur">Urdu - اردو</option>
                            <option  @if($language->code == "ug") selected @endif value="ug">Uyghur</option>
                            <option  @if($language->code == "uz") selected @endif value="uz">Uzbek - o‘zbek</option>
                            <option  @if($language->code == "vi") selected @endif value="vi">Vietnamese - Tiếng Việt</option>
                            <option  @if($language->code == "wa") selected @endif value="wa">Walloon - wa</option>
                            <option  @if($language->code == "cy") selected @endif value="cy">Welsh - Cymraeg</option>
                            <option  @if($language->code == "fy") selected @endif value="fy">Western Frisian</option>
                            <option  @if($language->code == "xh") selected @endif value="xh">Xhosa</option>
                            <option  @if($language->code == "yi") selected @endif value="yi">Yiddish</option>
                            <option  @if($language->code == "yo") selected @endif value="yo">Yoruba - Èdè Yorùbá</option>
                            <option  @if($language->code == "zu") selected @endif value="zu">Zulu - isiZulu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label class="control-label">{{ translate('Icon') }}</label>
                    </div>
                    <div class="col-lg-9">
                        
                        <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="icon" class="selected-files" value="{{ $language->icon }}">
                        </div>
                        <div class="file-preview">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
