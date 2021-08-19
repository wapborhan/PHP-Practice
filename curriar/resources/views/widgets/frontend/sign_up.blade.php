@if ($sign_up->title || $sign_up->subtitle || $sign_up->description)
    <div id="mc4wp_form_widget-2" style="background-color: inherit;"
        class="content-only widget bdaia-widget widget_mc4wp_form_widget">
        <div class="widget-box-title widget-box-title-s4">
            <h3>{{ translate('Newsletter') }}</h3>
        </div>
        <div class="widget-inner">
            <script>
                (function() {
                    if (!window.mc4wp) {
                        window.mc4wp = {
                            listeners: [],
                            forms: {
                                on: function(event, callback) {
                                    window.mc4wp.listeners.push({
                                        event: event,
                                        callback: callback,
                                    });
                                },
                            },
                        };
                    }
                })();

            </script>
            <!-- Mailchimp for WordPress v4.7.4 - https://wordpress.org/plugins/mailchimp-for-wp/ -->
            <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-66" method="post" data-id="66" data-name="">
                <div class="bdaia-mc4wp-form-icon" style="color: inherit"><span
                        class="bdaia-io bdaia-io-ion-paper-airplane"></span></div>
                <p class="bdaia-mc4wp-bform-p bd1-font" style="color: inherit">{!! $sign_up->title !!}</p>
                <p class="bdaia-mc4wp-bform-p2 bd2-font" style="color: inherit">{!! $sign_up->subtitle !!}</p>
                <p class="bdaia-mc4wp-bform-p3 bd3-font" style="color: inherit">{!! $sign_up->description !!}</p>
                <div class="mc4wp-form-fields" style="color: inherit">
                    <p>
                        <label>{{ translate('Email address') }}: </label>
                        <input type="email" name="EMAIL" placeholder="{{ translate('Your email address') }}" required />
                    </p>

                    <p>
                        <input type="submit" value="Sign up" />
                    </p>
                </div>
                <label style="display: none !important;">
                    {{ translate("Leave this field empty if you're human") }}: <input type="text" name="_mc4wp_honeypot"
                        value="" tabindex="-1" autocomplete="off" />
                </label>
                <input type="hidden" name="_mc4wp_timestamp" value="1604594626" /><input type="hidden"
                    name="_mc4wp_form_id" value="66" />
                <input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1" />
                <div class="mc4wp-response"></div>
                <p class="bdaia-mc4wp-bform-p4 bd4-font" style="color: inherit">{!! $sign_up->hits !!}</p>
            </form>
            <!-- / Mailchimp for WordPress Plugin -->
        </div>
    </div>
@endif