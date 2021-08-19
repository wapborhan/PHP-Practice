! function($) {
    $.fn.extend({
        ajaxyLiveSearch: function(e, s) {
            return e = e && "object" == typeof e ? $.extend({}, $.ajaxyLiveSearch.defaults, e) : $.ajaxyLiveSearch.defaults, this.is("input") ? void this.each(function() {
                new $.ajaxyLiveSearch.load(this, e, s)
            }) : void 0
        }
    }), $.ajaxyLiveSearch = {
        element: null,
        timeout: null,
        options: null,
        load: function(e, s) {
            this.element = e, this.timeout = null, this.options = s, "" == $(e).val() && $(e).val(s.text), $(e).attr("autocomplete", "off"), 0 == $("#sf_sb").length && $(".bdaia-ns-inner").append('<div id="sf_sb" class="sf_sb" style="position:absolute;display:none;width:' + s.width + 'px;z-index:9999"><div class="sf_sb_cont"><div class="sf_sb_top"></div><div id="sf_results" style="width:100%"><div id="sf_val" ></div><div id="sf_more"></div></div><div class="sf_sb_bottom"></div></div></div>'), $.ajaxyLiveSearch.loadEvents(this)
        },
        loadResults: function(object) {
            if (options = object.options, elem = object.element, window.sf_lastElement = elem, "" != jQuery(elem).val()) {
                jQuery("body").data("sf_results", null);
                var loading = '<li class="sf_lnk sf_more sf_selected"><a id="sf_loading" href="' + options.searchUrl.replace("%s", encodeURI(jQuery(elem).val())) + '"><i class=\"bdaia-io bdaia-io-spinner10 bdaia-io-spin\"></i></a></li>';
                jQuery("#sf_val").html("<ul>" + loading + "</ul>");

                var pos = this.bounds(elem, options);
                var containerPos = this.bounds('.bd-container' , options);
                if(!pos) {
                    jQuery("#sf_sb").hide();
                    return false;
                }
                if(Math.ceil(containerPos.left) + parseInt(options.width, 10) > jQuery(window).width()) {
                    jQuery("#sf_sb").css('width', jQuery(window).width() - containerPos.left - 20);
                }
                if( jQuery( 'body' ).hasClass( "rtl" ) ) {
                    jQuery("#sf_sb").css({top:pos.bottom, right:containerPos.right});
                }else{
                    jQuery("#sf_sb").css({top:pos.bottom, right:containerPos.left});
                }
                jQuery("#sf_sb").show();


                var data = {
                    action: "ajaxy_sf",
                    sf_value: jQuery(elem).val(),
                    search: options.search
                };
                if (options.ajaxData && (data = window[options.ajaxData](data)), options.search) {
                    var mresults = options.search.split(","),
                        results = [],
                        m = "",
                        s = 0,
                        c = [];
                    for (var kindex in mresults) {
                        var dm = mresults[kindex].split(":");
                        2 == dm.length ? 0 == dm[1].indexOf(jQuery(elem).val()) && (results[results.length] = mresults[kindex]) : 1 == dm.length && 0 == mresults[kindex].indexOf(jQuery(elem).val()) && (results[results.length] = mresults[kindex])
                    }
                    c = $.ajaxyLiveSearch.htmlArrayResults(results), m += c[0], s += c[1];
                    var sf_selected = "";
                    0 == s && (sf_selected = " sf_selected"), m += '<li class="sf_lnk sf_more' + sf_selected + '">{total} Results Found</li>', m = m.replace(/{search_value_escaped}/g, jQuery(elem).val()), m = m.replace(/{search_url_escaped}/g, options.searchUrl.replace("%s", encodeURI(jQuery(elem).val()))), m = m.replace(/{search_value}/g, jQuery(elem).val()), m = m.replace(/{total}/g, s), jQuery("body").data("sf_results", results), jQuery("#sf_val").html(s > 0 ? "<ul>" + m + "</ul>" : "<ul>" + m + "</ul>"), $.ajaxyLiveSearch.loadLiveEvents(object), jQuery("#sf_sb").show()
                } else jQuery.post(options.ajaxUrl, data, function(resp) {
                    var results = eval("(" + resp + ")"),
                        m = "",
                        s = 0;
                    for (var mindex in results) {
                        var c = [];
                        for (var kindex in results[mindex]) c = $.ajaxyLiveSearch.htmlResults(results[mindex][kindex], mindex, kindex), m += c[0], s += c[1]
                    }
                    var sf_selected = "";
                    0 == s && (sf_selected = " sf_selected"), options.callback || (m += '<li class="sf_lnk sf_more' + sf_selected + '">' + sf_templates + "</li>"), m = m.replace(/{search_value_escaped}/g, jQuery(elem).val()), m = m.replace(/{search_url_escaped}/g, options.searchUrl.replace("%s", encodeURI(jQuery(elem).val()))), m = m.replace(/{search_value}/g, jQuery(elem).val()), m = m.replace(/{total}/g, s), jQuery("body").data("sf_results", results), jQuery("#sf_val").html(s > 0 ? '<ul class="sf_main">' + m + "</ul>" : '<ul class="sf_main">' + m + "</ul>"), $.ajaxyLiveSearch.loadLiveEvents(object), jQuery("#sf_sb").show()
                })
            } else jQuery("#sf_sb").hide()
        },
        bounds: function(e, s) {
            var t = jQuery(e).offset();
            return t ? {
                top: t.top,
                left: t.left + s.leftOffset,
                bottom: t.top + jQuery(e).innerHeight() + s.topOffset,
                right: t.left - jQuery("#sf_sb").innerWidth() + jQuery(e).innerWidth()
            } : void 0
        },
        htmlResults: function(e, s, t) {
            var l = "",
                a = 0;
            if ("undefined" != typeof e && e.all.length > 0) {
                l += '<li class="sf_header">' + e.title + '</li><li><div class="sf_result_container"><ul>';
                for (var r = 0; r < e.all.length; r++) a++, l += "<li result-type='object' index-type='" + s + "' index-array='" + t + "' index='" + r + "' class=\"sf_lnk " + e.class_name + '">' + $.ajaxyLiveSearch.replaceResults(e.all[r], e.template) + "</li>";
                l += "</ul></div></li>"
            }
            return new Array(l, a)
        },
        htmlArrayResults: function(e) {
            var s = "",
                t = 0;
            if ("undefined" != typeof e && e.length > 0) {
                s += '<li><div class="sf_result_container"><ul>';
                for (var l = 0; l < e.length; l++) {
                    var a = e[l].split(":"),
                        r = "";
                    r = 2 == a.length ? a[1] : e[l], t++, s += "<li result-type='array' index='" + l + "' class=\"sf_lnk sf_category\"><a href='javascript:;'>" + r + "</a></li>"
                }
                s += "</ul></div></li>"
            }
            return new Array(s, t)
        },
        replaceResults: function(e, s) {
            for (var t in e) s = s.replace(new RegExp("{" + t + "}", "g"), e[t]);
            return s
        },
        loadLiveEvents: function(e) {
            var s = {
                object: e
            };
            jQuery("#sf_val li.sf_lnk").mouseover(function() {
                jQuery(".sf_lnk").each(function() {
                    jQuery(this).attr("class", jQuery(this).attr("class").replace(" sf_selected", ""))
                }), jQuery(this).attr("class", jQuery(this).attr("class") + " sf_selected")
            }), s.object.options.callback && jQuery("#sf_val li.sf_lnk").click(function() {
                try {
                    window[s.object.options.callback](s.object, this)
                } catch (e) {
                    alert(e)
                }
                return !1
            })
        },
        loadEvents: function(e) {
            var s = {
                object: e
            };
            jQuery(document).click(function() {
                jQuery("#sf_sb").hide()
            }), jQuery(window).resize(function() {
                var e = $.ajaxyLiveSearch.bounds(window.sf_lastElement, s.object.options);
                e && jQuery("#sf_sb").css({
                    top: e.bottom,
                    left: e.left
                })
            }), jQuery(e.element).keyup(function(e) {
                if ("38" != e.keyCode && "40" != e.keyCode && "13" != e.keyCode && "27" != e.keyCode && "39" != e.keyCode && "37" != e.keyCode) {
                    var t = s.object;
                    null != t.timeout && clearTimeout(t.timeout), jQuery(t.element).attr("class", jQuery(t.element).attr("class").replace(" sf_focused", "") + " sf_focused");
                    var l = {
                        object: s.object
                    };
                    t.timeout = setTimeout(function() {
                        jQuery.ajaxyLiveSearch.loadResults(l.object)
                    }, s.object.options.delay)
                }
            }), jQuery(window).keydown(function(e) {
                if ("none" != jQuery("#sf_sb").css("display") && "undefined" != jQuery("#sf_sb").css("display") && jQuery("#sf_sb").length > 0)
                    if ("38" == e.keyCode || "40" == e.keyCode) {
                        jQuery.browser.webkit && jQuery("#sf_sb").focus();
                        var t = !1,
                            l = jQuery("#sf_val li.sf_lnk"),
                            a = !1;
                        e.stopPropagation(), e.preventDefault();
                        for (var r = 0; r < l.length; r++) jQuery(l[r]).attr("class").indexOf("sf_selected") >= 0 && 0 == a ? (t = !0, r < l.length - 1 && "40" == e.keyCode ? (jQuery(l[r]).attr("class", jQuery(l[r]).attr("class").replace(" sf_selected", "")), jQuery(l[r + 1]).attr("class", jQuery(l[r + 1]).attr("class") + " sf_selected"), r += 1, a = !0) : r > 0 && "38" == e.keyCode && (jQuery(l[r]).attr("class", jQuery(l[r]).attr("class").replace(" sf_selected", "")), jQuery(l[r - 1]).attr("class", jQuery(l[r - 1]).attr("class") + " sf_selected"), r += 1, a = !0)) : jQuery(l[r]).attr("class", jQuery(l[r]).attr("class").replace(" sf_selected", ""));
                        0 == t && l.length > 0 && jQuery(l[0]).attr("class", jQuery(l[0]).attr("class") + " sf_selected")
                    } else if (27 == e.keyCode) jQuery("#sf_sb").hide();
                    else if (13 == e.keyCode) {
                        var o = jQuery("#sf_val li.sf_selected a").attr("href");
                        return "undefined" != typeof o && "" != o ? (s.object.options.callback ? s.object.options.callback(this) : window.location.href = o, !1) : (s.object.options.callback ? s.object.options.callback(this) : null != s.object.element && (window.location.href = sf_url.replace("%s", encodeURI(jQuery(s.object).val()))), !1)
                    }
            }), jQuery(e.element).focus(function() {
                jQuery(this).val() == s.object.options.text && (jQuery(this).val(""), jQuery(this).attr("class", jQuery(this).attr("class") + " sf_focused")), s.object.options.expand > 0 && jQuery(s.object.element).animate({
                    width: s.object.options.iwidth
                })
            }), jQuery(e.element).blur(function() {
                "" == jQuery(this).val() && (jQuery(this).val(s.object.options.text), jQuery(this).attr("class", jQuery(this).attr("class").replace(/ sf_focused/g, ""))), s.object.options.expand > 0 && jQuery(s.object.element).animate({
                    width: s.object.options.expand
                })
            })
        }
    }, $.ajaxyLiveSearch.defaults = {
        delay: 500,
        leftOffset: 0,
        topOffset: 5,
        text: "Search For",
        iwidth: 180,
        width: 315,
        ajaxUrl: "",
        ajaxData: !1,
        searchUrl: "",
        expand: !1,
        callback: !1,
        rtl: !0,
        search: !1
    }
}(jQuery);

function sf_addItem(search, title, name, name_type, value) {
    var items = jQuery(search).find('.sf_ajaxy-selective-item');
    var exists = false;

    var key = "";
    var md = value.split(':');
    if(md.length == 2) {
        key = md[0];
    }else{
        key = value;
    }
    if(items.length > 0) {
        for(var i = 0; i < items.length; i ++) {
            if(jQuery(items[i]).find('input.sf_ajaxy-selective-close-hidden').val() == key){
                exists = true;
                break;
            }
        }
    }
    if(exists) {
        jQuery(search).find(".sf_ajaxy-selective-input").val("");
        jQuery('#sf_sb').hide();
        return;
    }
    var mds = title.split(':');
    if(mds.length == 2) {
        title = md[1];
    }
    var added_item = jQuery('<span class="sf_ajaxy-selective-item">' + title + '<a class="sf_ajaxy-selective-close">X</a><input class="sf_ajaxy-selective-close-hidden" type="hidden" name="' + name + '" value="' + key + '" /></span>');
    if(items.length <= 0){
        jQuery(search).prepend(added_item);
    }else{
        added_item.insertAfter(items[items.length - 1]);
    }
    added_item.click(function() {
        jQuery(this).remove();
    });
    var input = jQuery(search).find(".sf_ajaxy-selective-input");
    if(input) {
        input.val("");
        if(name_type != 'array') {
            input.css('visibility', 'hidden');
        }else{
            input.focus();
        }
    }
    jQuery('#sf_sb').hide();
}