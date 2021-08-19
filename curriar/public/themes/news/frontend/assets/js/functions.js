var i_refresh = {};
var is_RTL = false;

(function($){


    'use strict';

    var $doc, $body, $window, $html, adBlock = false, $fixedEnabled, $navHeghit, intialWidth, has_lazy, has_sticky_nav, ad_blocker_detector, mobile_topmenu, menuHeight, stickyNavTop,
        adminbarOffset, mobile_menu, $bd_popup, outer, widthHasScroll, click_to_comments, sticky_sidebar, window_height, window_offest, is_singular, post_reading_position_indicator, heart, post_id, ajaxurl, nonce, all_lightbox;

    $(document).ready(function(){

        // Debugging
        performance.mark('KolStart');



        /**
         * Load Effects
         */
        bd_lazy_load();


        $doc                = $ (document );
        $body               = jQuery(document.body);
        $window             = jQuery(window);
        $html               = jQuery( 'html' );
        adBlock             = false;
        $fixedEnabled       = jQuery( 'nav#navigation.fixed-enabled' );
        $navHeghit          = jQuery( '.navigation-outer' );
        intialWidth         = jQuery(window).width();
        has_lazy            = true;
        has_sticky_nav      = true;
        ad_blocker_detector = true
        mobile_topmenu      = true;
        click_to_comments   = false;
        sticky_sidebar      = true;
        is_singular         = false;
        all_lightbox        = true;
        ajaxurl             = '';
        nonce               = '';

        mobile_menu = jQuery( '.bd-push-menu #mobile-menu' );
        $bd_popup = jQuery( '.bdaia-popup' );
        adminbarOffset = $body.is('.admin-bar') ? jQuery('#wpadminbar').height() : 0;
        post_reading_position_indicator = true;


        function bd_lazy_load( element, area ) {

            if ( typeof element != 'undefined' ) {
                var $percent_rating = element.find( '.rating-percentages-inner' );
                var $lazy_load_img  = element.find('.bdaia-fp-post-img-container, .mm-img, .img, .img-lazy, .lazy-bg, .article-thumb-bg .article-link-thumb-bg');
            }
            else {
                var $percent_rating = jQuery( '.rating-percentages-inner' );
                var $lazy_load_img  = jQuery('.bdaia-fp-post-img-container, .mm-img, .img, .img-lazy:visible, .lazy-bg:visible, .article-thumb-bg .article-link-thumb-bg');
            }

            $percent_rating.viewportChecker({
                callbackFunction: function(elem, action){

                    setTimeout(function(){
                        var rate_val = elem.data('rate-val') + '%';
                        elem.velocity('stop').velocity({width: rate_val},{stagger: 200, duration: 600});
                    },500);
                }
            });

            $lazy_load_img.viewportChecker({
                callbackFunction: function(elem, action){
                    setTimeout(function(){
                        elem.lazy({
                            effect:    'fadeIn',
                            effectTime: 500,
                        });

                    },500);
                }
            });

        }

        jQuery('.insta-lazy').lazy({
            effect:    'fadeIn',
            effectTime: 500,
        });


        /**
         * A Scroll Animate
         */
        jQuery('a[href^="#"]').on('click', function(event){
            var target = jQuery(this.getAttribute('href'));

            if(target.length){
                event.preventDefault();

                jQuery('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 1000);
            }
        });




        /**
         * Prevent Default
         */
        jQuery('.prev, .nxt, .flex-next, .flex-prev, .bdaia-load-comments-btn a, .bd-login-j a').on('click', function(event) {
            event.preventDefault();
        });





        /**
         * Responsive Videos
         */
        jQuery('#page').fitVids({
            ignore         : '',
            customSelector : "iframe[src*='maps.google.com'], iframe[src*='google.com/maps'], iframe[src*='dailymotion.com'], iframe[src*='twitter.com/i/videos']"
        });


        /**
         * Topbar Search
         */
        jQuery("span.bdaia__top_header_search_icon").on('touchend click', function(e) {

            if (jQuery('div.bdaia__top_header_search').hasClass('bdaia__top_expanded_search') === !1) {
                e.preventDefault();
                jQuery("div.bdaia__top_header_search").addClass("bdaia__top_expanded_search");
                jQuery("div.bdaia__top_header_search input.search-field").focus();

            } else {
                if (!jQuery('div.bdaia__top_header_search input.search-field').val()) {
                    e.preventDefault();
                    jQuery("div.bdaia__top_header_search").removeClass("bdaia__top_expanded_search");
                    jQuery("div.bdaia__top_header_search input.search-field").blur()
                }
            }
        });


        /**
         * Sticky nav
         */
        var activeSubNav = jQuery('.bd-subnav-wrapper').outerHeight();
        var menuHeight = $fixedEnabled.outerHeight();

        $fixedEnabled.parent().css({height:menuHeight});
        $fixedEnabled.tiesticky('destroy');

        if($fixedEnabled.length > 0 && intialWidth > 991){

            var stickyNavTop = $fixedEnabled.offset().top;

            $fixedEnabled.tiesticky({
                offset : stickyNavTop,
                tolerance : 0
            });
        }


        /**
         * Menu Slideout
         */
        function hasParentClass( e, classname ) {

            if ( e === document ) {
                return false;
            }

            if ( jQuery(e).hasClass( classname ) ) {
                return true;
            }
            return e.parentNode && hasParentClass( e.parentNode, classname );
        }

        var resetMenu = function() {
            $body.removeClass('bd-push-menu-open');

            }, bodyClickFn = function(evt){

                if ( !hasParentClass( evt.target, 'bd-push-menu' ) )
                {
                    resetMenu();

                    document.removeEventListener( 'touchstart', bodyClickFn );
                    document.removeEventListener( 'click', bodyClickFn );
                }
            }, el = jQuery('.bdaia-push-menu');

        el.on( 'touchstart click', function( ev ) {
            ev.stopPropagation();
            ev.preventDefault();

            jQuery('body').addClass('bd-push-menu-open');

            if ( has_lazy )
            {
                jQuery( 'aside.bd-push-menu .lazy-img' ).lazy( { bind: 'event' } );
            }
        } );

        $body.on( 'touchstart click', bodyClickFn );
        $doc.on( 'keydown', function(e) {
            if ( e.which == 27 ) {
                resetMenu();
                document.removeEventListener( 'touchstart', bodyClickFn );
                document.removeEventListener( 'click', bodyClickFn );
            }
        });

        jQuery('body').on("click", ".bd-push-menu-close" , function(){
            resetMenu();
        });

        $window.resize(function() {
            intialWidth = $window.width();

            if ( intialWidth == 991 ) {
                resetMenu();
            }
        });

        var mobileItems = jQuery( '.bdaia-header-default #navigation #menu-primary' ).clone();
        mobileItems.find( '.sub_cats_posts .mega-menu-content, .nav-logo, .logo, .bd-push-menu-btn' ).remove();

        mobile_menu.append( mobileItems );
        if(mobile_topmenu){
            var mobileItemsTop = jQuery( '.bdaia-header-default .topbar ul.top-nav' ).clone();
            mobile_menu.append( mobileItemsTop );
        }

        var subNavItem = jQuery( '.bd-subnav-wrapper .sub-nav' ).clone();
        mobile_menu.append( subNavItem );

        jQuery( ".bd-push-menu #mobile-menu .menu-item-has-children" ).append( '<span class="mobile-arrows fa fa-chevron-down isOpen"></span>' );
        $doc.on( "click", "#mobile-menu .menu-item-has-children .mobile-arrows", function() {
            if ( jQuery( this ).hasClass( "isOpen" ) ) {
                jQuery( this ).removeClass( "isOpen" );
            }
            else {
                jQuery( this ).removeClass( "isOpen" ).addClass( "isOpen" );
            }
            jQuery( this ).parent().find( 'ul:first' ).toggle();
        });

        function bd_get_scroll_bar_width () {
            outer               = jQuery( '<div>' ).css( { visibility: 'hidden', width: 100, display: 'none', overflow: 'scroll' } ).appendTo( 'body' );
            widthHasScroll      = jQuery( '<div>' ).css( { width: '100%' } ).appendTo( outer ).outerWidth();

            outer.remove();
            return 100 - widthHasScroll;
        }

        $doc.on('click', '.bd-login-j a', function(event){
            event.preventDefault();
            bd_btn_open('#bd-login-join');
        });

        if(ad_blocker_detector && typeof $adbDE3 == 'undefined'){
            adBlock = true;
            $html.css( { 'marginRight': bd_get_scroll_bar_width(), 'overflow': 'hidden' } );
            setTimeout( function() { $body.addClass( 'bdaia-popup-is-opend' ) }, 10 );
            bd_btn_open( '#bdaia-popup-adblock' );
        }

        function bd_btn_open(windowToOpen){
            jQuery( windowToOpen ).show();
            setTimeout( function() { $body.addClass( 'bdaia-popup-is-opend' ) }, 10) ;
            $html.css( { 'marginRight': bd_get_scroll_bar_width(), 'overflow': 'hidden' } );
        }

        if ($bd_popup.length && ! adBlock) {
            $doc.keyup(function(event){
                if (event.which == '27' && $body.hasClass('bdaia-popup-is-opend')){
                    bd_close_popup();
                }
            });
        }

        $bd_popup.on('click', function(event){
            if(jQuery( event.target ).is('.bdaia-popup:not(.is-fixed-popup)')){
                event.preventDefault();
                bd_close_popup();
            }
        });

        jQuery('.bdaia-btn-close').on('click', function(){
            bd_close_popup();
            return false;
        });

        function bd_close_popup(){
            jQuery.when($bd_popup.fadeOut(500)).done( function(){
                $html.removeAttr('style');
            });
            $body.removeClass('bdaia-popup-is-opend');
        }


        /**
         * Points rating
         */
        jQuery(".points-rating-div").each(function( i, el ){
            var points      = jQuery( this );
            var rate_val    = points.attr('data-rate-val') + '%';
            var attr_id     = points.attr( 'id' );
            var id          = jQuery( '#' + attr_id );

            if(points){
                id.velocity('stop').velocity({width: rate_val},{stagger: 200, duration: 600});
            }
        });


        /**
         * iLightbox
         */
        if(jQuery().iLightBox){
            var $pos_class  = jQuery( '.bdaia-post-template' );
            i_refresh       = jQuery( 'a.lightbox-enabled, a[rel="lightbox-enabled, .bd-video-ilightbox"]' ).iLightBox( { autostart: false } );

            jQuery( 'a.lightbox-enabled, a[rel="lightbox-enabled"], .bd-video-ilightbox' ).iLightBox( { autostart: false } );

            $pos_class.find( "div.bdaia-post-content a, .bdaia-post-heading a" ).not( "div.bdaia-post-gallery a" ).not( "div.bdaia-e3-container a" ).not( "._e3lann a" ).each( function( i, el ) {
                var href_value = el.href;
                if ($(this).find('img').length) {
                    $(this).addClass('post_content_image')
                }

            });

            $pos_class.find( '.ilightbox-gallery' ).iLightBox( { path: 'horizontal' } );

            if (all_lightbox) {
                jQuery( '.bdaia-post-content a.post_content_image, .bdaia-post-heading a.post_content_image' ).iLightBox();
            }
        }



        /**
         * Retina
         */
        if ( window.devicePixelRatio > 1 ) {
            jQuery('.bd-retina').each( function() {
                var lowres  = jQuery( this ).attr( 'src' ),
                    highres = lowres.replace( ".png", "@2x.png" );

                highres = highres.replace( ".jpg", "@2x.jpg" );

                jQuery( this ).attr( 'src', highres );
            });

            jQuery( '.bd-retina-data' ).each( function() {
                jQuery( this ).attr( 'src', jQuery( this ).data( 'retina' ) );
                jQuery( this ).addClass( 'bd-retina-src' );
            });
        }


        /**
         * Sticky sidebar
         */
        if( jQuery.fn.theiaStickySidebar ){

            if ( intialWidth > 900 && sticky_sidebar ) {
                jQuery( '.theia_sticky' ).theiaStickySidebar( {
                    "additionalMarginTop"   : 32,
                    'minWidth'              : 990
                } );

                jQuery( '.is-sticky' ).theiaStickySidebar( {
                    "additionalMarginTop"   : 32,
                    'additionalMarginBottom' : 32,
                    'minWidth'              : 990
                } );
            }
        }


        /**
         * Youtube
         */
        jQuery('iframe[src*="youtube.com"]').each( function(){
            var url = jQuery( this ).attr( 'src' );

            if(jQuery(this).attr( 'src' ).indexOf( '?' ) > 0 ){
                jQuery(this).attr({
                    'src'   : url + '&wmode=transparent',
                    'wmode' : 'Opaque'
                });
            }
            else {
                jQuery( this ).attr({
                    'src'   : url + '?wmode=transparent',
                    'wmode' : 'Opaque'
                });
            }
        });


        /**
         * Go top
         */
        var bdGoTopOffset      = 220;
        var bdGoTopDuration    = 500;
        var bdGoTopClass       = jQuery('.gotop');

        jQuery(window).scroll(function(){
            if ( jQuery( this ).scrollTop() > bdGoTopOffset ){
                bdGoTopClass.css( { opacity: "1", bottom: "5px" } );
            }
            else {
                bdGoTopClass.css( { opacity: "0", bottom: "-60px" } );
            }
        });

        bdGoTopClass.on( 'click', function(event) {
            event.preventDefault();
            jQuery('html, body').animate( { scrollTop: 0 }, bdGoTopDuration );
            return false;
        } );


        /**
         * Mega menu
         */
        jQuery('div.mega-cat-wrapper').each(function(){
            jQuery(this).find('div.mega-cat-content-tab').hide();
            jQuery(this).find('ul.mega-cat-sub-categories li:first').addClass('cat-active').show();
            jQuery(this).find('div.mega-cat-content-tab:first').addClass('already-loaded').show();
            jQuery(this).find('ul.mega-cat-sub-categories li').mouseover(function(event){
                event.preventDefault();

                jQuery( this ).parent().find('li').removeClass('cat-active');
                jQuery( this ).addClass('cat-active');
                jQuery( this ).parent().parent().parent().find('div.mega-cat-content-tab').hide();

                var act_tab = jQuery(this).find('a').attr('id');

                if ( jQuery( act_tab ).hasClass('already-loaded') ) {
                    jQuery( act_tab ).fadeIn( 'fast' );
                }
                else {
                    jQuery( act_tab ).addClass('loading-items').fadeIn( 'fast' , function() {
                        jQuery( this ).removeClass('loading-items').addClass('already-loaded');
                    });
                }
                return false;
            });
        });

        var menu = function( el ) {
            this.target = el;
            this.target.find( '.components-sub-menu' ).css( {
                'dispay'  : 'none',
                'opacity' : 0
            } );

            this.target.on( {
                mouseenter: this.reveal,
                mouseleave: this.conceal
            }, 'li' );
        };

        menu.prototype.reveal = function() {
            var target = jQuery( this ).children( '.components-sub-menu' );

            if ( target.hasClass( 'is_open' ) ) {
                target.velocity( 'stop' ).velocity( 'reverse' );
            }
            else {
                target.velocity( 'stop' ).velocity( 'transition.slideDownIn',{
                        duration: 250,
                        delay   : 0,
                        complete : function() {
                            target.addClass('is_open');
                        }
                    } );
            }
        };

        menu.prototype.conceal = function() {
            var target = jQuery( this ).children( '.components-sub-menu' );

            target.velocity( 'stop' ).velocity( 'transition.fadeOut',{
                    duration: 100,
                    delay   : 0,

                    complete: function() {
                        target.removeClass('is_open');
                    }
                }
            );
        };

        var $menu       = jQuery('ul.bd-components');
        var dropMenu    = new menu($menu);


        /**
         * Breaking Counter
         */
        jQuery( '.breaking-cont ul' ).each( function() {
            if ( ! jQuery( this ).find( 'li.active' ).length ) {
                jQuery( this ).find( 'li:first' ).addClass( 'active fadeIn' );
            }

            var ticker = jQuery( this );

            window.setInterval( function() {
                var active = ticker.find( 'li.active' );

                active.fadeOut( function() {
                    var next = active.next();

                    if ( !next.length ) {
                        next = ticker.find( 'li:first' );
                    }

                    next.addClass( 'active fadeIn' ).fadeIn();
                    active.removeClass( 'active fadeIn' );
                } );
            }, 5000 );
        } );


        /**
         * Custom Scroll
         */
        if ( jQuery.fn.mCustomScrollbar ) {

            jQuery( '.push-menu-has-custom-scroll, .bd-login-join-wrapper' ).each( function () {
                var thisElement     = jQuery( this );
                var scroll_height   = thisElement.data( 'height' ) ? thisElement.data( 'height' ) : 'auto',
                    data_padding    = thisElement.data( 'padding' ) ? thisElement.data( 'padding' ) : 0; thisElement.mCustomScrollbar( 'destroy' );

                if ( thisElement.data( 'height' ) == 'window' ) {
                    var thisHeight      = thisElement.height(),
                        windowHeight    = $window.height() - data_padding - 50;

                    scroll_height = ( thisHeight < windowHeight ) ? thisHeight : windowHeight;
                }

                thisElement.mCustomScrollbar( {
                    scrollButtons       : { enable : false },
                    autoHideScrollbar   : thisElement.hasClass('show-scroll') ? false : true,
                    scrollInertia       : 100,
                    mouseWheel          : { enable: true, scrollAmount: 60 },
                    set_height          : scroll_height,
                    advanced            : { updateOnContentResize: true },
                    callbacks           : {
                        whileScrolling:function() {
                            bd_lazy_load( thisElement, 'custom-scroll-area' );
                        }
                    }
                } );
            } );
        }







        var box_i   = jQuery('.articles-box');

        box_i.each( function (idx, item){

            var box_i3  = jQuery(this);
            var box_i2  = box_i3.attr('id');
            var box_i4  = jQuery('#' + box_i2);
            var box_i5  = jQuery( box_i4 ).find( '.articles-box-filter-links-more-inner' );

            var blocksFilters = jQuery( box_i4 ).find( '.articles-box-filter-links' ).clone();
            box_i5.append( blocksFilters );


            jQuery( box_i4 ).find( '.button-more' ).on('click', function() {

                var isOpen      = box_i5.is(':visible'),
                    slideDir    = isOpen ? 'slideUp' : 'slideDown',
                    dur         = isOpen ? 100 : 200;

                box_i5.velocity('stop').velocity(slideDir, {
                    easing: 'easeOutQuart',
                    duration: dur
                } );
            } );
        } );

        jQuery('body').on('click','.articles-box-title-arrow, .more-btn',function(e) {

            e.preventDefault();

            if($(this).hasClass('pagination-disabled')){
                return false;
            }

            var box                 = jQuery(this).closest('.articles-box');
            var box_id              = box.get(0).id;
            var id                  = jQuery('#' + box_id);
            var the_box             = jQuery.extend( {}, window[ 'js_'+box_id ] );
            var data_page           = jQuery('#'+box_id).attr('data-page');
            var type                = jQuery(this).attr('data-type');


            var box_ele             = jQuery(id).find('.bd_element_widget');
            var box_content         = box.find('.articles-box-content');
            var box_content_items   = box.find('.articles-box-items');
            var box_wrapper         = box.find('.articles-box-container-wrapper');

            if(jQuery(id).find('.articles-box-filter-links').hasClass('filter_categories')){
                var category_id = jQuery(id).find('.articles-box-filter-links li.active a').attr('data-id');
            }else if(jQuery(id).find('.articles-box-filter-links').hasClass('filter_tags')){
                var tag = jQuery(id).find('.articles-box-filter-links li.active a').attr('data-id');
            }

            if ( type == 'prev' ) {
                data_page--;
                var max_page = 1;
            }

            else {
                data_page++;
                var max_page = the_box.max_num_pages;
            }

            if ( jQuery(id).hasClass('bd_element_widget_article') ) {
                var act = 'new_ajax_ele';
            } else {
                var act = 'new_ajax';
            }

            var ajaxData = {
                'action'        : act,
                'the_box'       : the_box,
                'data-page'     : data_page,
                'category_id'   : category_id,
                'tag'           : tag,
                'type'          : type
            };

            //console.log(ajaxData);

            if ( ( data_page <= max_page && ( type =='next' || type=='load_more' || type=='show_more' ) ) || ( data_page >= max_page && type == 'prev' ) )
            {
                jQuery.ajax( {
                    type: 'post',
                    url     : bdaia.ajaxurl,
                    data    : ajaxData,

                    beforeSend: function ()
                    {
                        var blockHeight = box_content.height();
                        box_wrapper.addClass('is-loading')
                    },

                    success: function (data) {

                        //data = jQuery.parseJSON(data);


                        if (type === 'prev') {
                            id.attr('data-page', data_page);
                            id.find('.next_arrow').removeClass('pagination-disabled');
                            id.find('.more-btn').css('display', 'inline-block');

                            if (data_page == 1) {
                                jQuery('#' + box_id).find('.prev_arrow').addClass('pagination-disabled');
                            }
                        }

                        else {
                            id.attr('data-page', data_page);
                            id.find('.prev_arrow').removeClass('pagination-disabled');

                            if (data_page == the_box.max_num_pages) {
                                id.find('.next_arrow').addClass('pagination-disabled');
                                id.find('.more-btn').css('display', 'none');
                            }
                        }

                        if (type == 'load_more') {
                            id.find('.articles-box-content').append(data);
                        }

                        else {
                            id.find('.articles-box-content').html(data);
                        }

                        var box_items_li = box.find('.articles-items-' + data_page);


                        if (type === 'prev') {
                            box_items_li.find( 'li' ).hide().velocity('stop').velocity( 'transition.slideLeftIn', { stagger:100, duration:488, display:"inline-block",
                                complete: function(){
                                    box_items_li.attr( 'style', '' );
                                    bd_lazy_load( box_items_li );
                                }
                            } );
                        }
                        else if (type === 'next')
                        {
                            box_items_li.find( 'li' ).hide().velocity('stop').velocity( 'transition.slideRightIn', { stagger: 100, duration:488, display:"inline-block",
                                complete: function(){
                                    box_items_li.attr( 'style', '' );
                                    bd_lazy_load( box_items_li );
                                }
                            } ) ;
                        }
                        else if (type === 'show_more')
                        {
                            box_items_li.find( 'li' ).hide().velocity('stop').velocity( 'transition.fadeIn', { stagger: 0, duration:488, display:"inline-block",
                                complete: function(){
                                    box_items_li.attr( 'style', '' );
                                    bd_lazy_load( box_items_li );
                                }
                            } ) ;
                        }
                        else {
                            box_items_li.find( 'li' ).hide().velocity('stop').velocity( 'transition.slideUpIn', { stagger:100, duration:488, display:"inline-block",
                                complete: function(){
                                    box_items_li.attr( 'style', '' );
                                    bd_lazy_load( box_items_li );
                                }
                            } );
                        }


                        if(jQuery(id).find('.end_posts').length > 0 || data == ''){
                            id.find('.next_arrow').addClass('pagination-disabled');
                            id.find('.more-btn').css('display', 'none');
                        }
                    },

                    complete: function( data ){
                        box_wrapper.removeClass('is-loading');
                    },
                } );
            }
            return false;
        } );

        jQuery('.filter_categories,.filter_tags').on('click','li a',function(e) { e.preventDefault();

            var box                 = jQuery(this).closest('.articles-box');
            var box_id              = box.attr('id');
            var id                  = jQuery('#' + box_id);
            var the_box             = jQuery.extend( {}, window[ 'js_'+box_id ] );

            if(jQuery(this).closest('.articles-box-filter-links').hasClass('filter_categories')) {
                jQuery('.filter_categories li').removeClass('active');
                jQuery(this).parent('li').addClass('active');
                var category_id = jQuery(this).attr('data-id');
            }else{
                jQuery('.filter_tags li').removeClass('active');
                jQuery(this).parent('li').addClass('active');
                var tag = jQuery(this).attr('data-id');
            }
            var box_content         = jQuery('.articles-box-content');
            var box_content_items   = box.find('.articles-box-items');
            var box_wrapper         = box.find('.articles-box-container-wrapper');
            var box_container       = box.find('.articles-box-container');

            id.find('.end_posts').remove();
            id.find('.next_arrow').removeClass('pagination-disabled');
            id.find('.more-btn').removeAttr('style');
            id.attr('data-page' ,1);


            if ( jQuery(id).hasClass('bd_element_widget_article') ) {
                var act = 'filter_ajax_ele';
            } else {
                var act = 'filter_ajax';
            }

            var ajaxData = {
                'action'        : act,
                'the_box'       : the_box,
                'tag'           : tag,
                'category_id'   : category_id
            };

            jQuery.ajax( {
                type    : "POST",
                url     : bdaia.ajaxurl,
                data    : ajaxData,

                beforeSend: function ()
                {
                    var blockHeight = box_content.height();

                    box_wrapper.addClass('is-loading');

                    box_container.append( '<div class="loader-overlay"><div class="bd-loading"></div></div>' );
                    box_wrapper.find( ".articles-box-load-more" ).css( "max-height", "0px" , "transition", "max-height 1s ease" );
                    box_content_items.css( "opacity", "0.5" );


                    if ( box.hasClass('articles-box-next_prev') ) {
                        box.find( ".loader-overlay" ).remove();
                    }

                },

                success: function (data) {
                    id.find('.articles-box-content').html(data);
                    if(jQuery(id).find('.end_posts').length > 0){
                        id.find('.next_arrow').addClass('pagination-disabled');
                        id.find('.more-btn').css('display', 'none');
                    }
                },

                complete: function( data ){
                    box_wrapper.removeClass('is-loading');
                    box_container.find( ".loader-overlay" ).remove();
                    box_wrapper.find( ".articles-box-load-more" ).css( "max-height", "100%", "transition", "max-height 1s ease" );
                    box_content_items.css( "opacity", "1" );

                    jQuery(id).find( 'ul.articles-box-items li' ).hide().velocity('stop').velocity( 'transition.slideRightIn', { stagger: 100, duration:488, display:"inline-block",
                        complete: function(){
                            jQuery(id).find( 'ul.articles-box-items li' ).attr( 'style', '' );
                            bd_lazy_load( jQuery(id).find( 'ul.articles-box-items li' ) );
                        }
                    } ) ;
                },
            } );

            return false;
        } );


        jQuery('body').on('click','.general-more-btn', function(e) {

            e.preventDefault();

            var pagination_btn = jQuery( '.general-more-btn' );

            if ( ! pagination_btn.length ) {
                return false;
            }


            var the_query       = pagination_btn.attr('data-q'),
                the_url         = pagination_btn.attr('data-url'),
                max_num_pages   = pagination_btn.attr('data-max-num'),
                query_vars   = pagination_btn.attr('data-query-vars'),
                posts_per_page   = pagination_btn.attr('data-posts-per-page'),
                button_text     = pagination_btn.attr('data-text'),
                latest_post     = pagination_btn.attr('data-latest');



            var boxx                 = jQuery(this).closest('.articles-box');
            var boxx_id              = boxx.attr('id');
            var id                  = jQuery('#' + boxx_id);

            var box                 = jQuery('.articles-box');
            var box_id              = box.attr('id');
            var box_block           = js_cat_box.block;
            var box_content         = box.find('.articles-box-content');
            var box_wrapper         = box.find('.articles-box-container-wrapper');
            var box_count           = jQuery(this).attr('data-count');


            var data_page           = jQuery('#'+boxx_id).attr('data-page');

            data_page++;

            var ajaxData = {
                'action'        : 'general_ajax',
                'query'         : the_query,
                'max_num'       : max_num_pages,
                'query_vars'    : query_vars,
                'posts_per_page': posts_per_page,
                'page'          : data_page,
                'latest_post'   : latest_post,
                'offset'        : boxx.find('.articles-box-item').length,
                'count'         : box_count,
                'layout'        : js_cat_box.layout,
                'post_meta'     : js_cat_box.post_meta,
                'read_more'     : js_cat_box.read_more,
                'excerpt'       : js_cat_box.excerpt,
                'excerpt_length': js_cat_box.excerpt_length,
                'type'          : jQuery(this).attr('data-type'),
                'block'         : box_block,
                'data_page'     : data_page,
                'id'            : jQuery(this).attr('data-id')
            };

            jQuery.ajax({
                url:bdaia.ajaxurl,
                type:'post',
                data:ajaxData,

                beforeSend: function () {
                    box_wrapper.addClass('is-loading')
                },

                success: function( data){

                    if ( data['hide_next'] ) {
                        //jQuery('.general-more-btn').css('display', 'none');
                    }
                    else {
                        //jQuery('.general-more-btn').css('display', 'inline-block');
                    }

                    if ( max_num_pages == 1 || ( max_num_pages == data_page ) ) {
                        jQuery('.general-more-btn').css('display', 'none');
                    }


                    pagination_btn.attr( 'data-latest', latest_post );

                    id.attr('data-page', data_page);
                    pagination_btn.attr( 'data-page', data_page );

                    var content = jQuery( data );
                    box_content.append(content);

                    var box_items_li = boxx.find('.articles-items-' + data_page);
                    box_items_li.find( 'li' ).hide().velocity('stop').velocity( 'transition.slideUpIn', { stagger:100, duration:1000, display:"inline-block",
                        complete: function(){
                            box_items_li.attr( 'style', '' );
                            bd_lazy_load( box_items_li );
                        }
                    } );
                },

                complete: function(){
                    box_wrapper.removeClass('is-loading');
                }
            } );
            return false;
        } );


        // onload
        window.onload = function () {
            console.log('Loaded')
        }


        // Debugging
        performance.mark('KolEnd');
        performance.measure( 'Kol Custom JS', 'KolStart', 'KolEnd' );
    } );

} )( jQuery );



var win_height_padded = jQuery(window).height() * .9;

jQuery(window).on('scroll', bd_images_scroll);

function bd_images_scroll(){

    var scrolled = jQuery(window).scrollTop(),
        win_height_padded = jQuery(window).height() * .9;

    jQuery( ".bdaia-lazyload .post-thumb, .bdaia-lazyload .block-article-img-container, .bdaia-lazyload .bdaia-fp-post-img-container, .bdaia-lazyload .big-grids, .bdaia-lazyload .bd-post-carousel, .bdaia-lazyload .post-image, .bdaia-lazyload .bdaia-post-featured-image, .bdaia-lazyload .bdaia-post-content img, .bdaia-lazyload .bd-block-mega-menu-post, .bdaia-lazyload .bdaia-featured-img-cover, .bdaia-lazyload .thumbnail-cover, .bdaia-lazyload .ei-slider, .bdaia-lazyload .bd-post-thumb, .bdaia-lazyload .bwb-article-img-container, .bdaia-lazyload div.bdaia-instagram-footer ul li a" ).each(function (){
        var thiss     = jQuery(this);
        var offsetTop = thiss.offset().top;

        if (scrolled + win_height_padded > offsetTop){
            jQuery(this).addClass('bdaia-img-show');
        }
    });
}
bd_images_scroll();




function kolyoum_wb_ajax_js( $block_id, $prev ) {

    var block               = jQuery( '.bdaia-wb-id'+$block_id );
    var bd_wait             = jQuery( '.bdaia-wb-id'+$block_id+' .bdayh-posts-load-wait'   );
    var bd_more             = jQuery( '.bdaia-wb-id'+$block_id+' .bdaia-wb-more-btn'       );
    var bd_next             = jQuery( '.bdaia-wb-id'+$block_id+' .carousel-nav .mo-next'   );
    var bd_prev             = jQuery( '.bdaia-wb-id'+$block_id+' .carousel-nav .mo-prev'   );
    var bd_content          = jQuery( '.bdaia-wb-id'+$block_id+' .bdaia-wb-inner'          );
    var bd_content_ul       = jQuery( '.bdaia-wb-id'+$block_id+' .bdaia-nip-inner ul'      );

    var bd_paged            = parseInt( block.attr( 'data-paged'            ) );
    var bd_num_posts        = parseInt( block.attr( 'data-num_posts'        ) );
    var bd_cat_uid          = parseInt( block.attr( 'data-cat_uid'          ) );

    var bd_sort_order       = block.attr( 'data-sort_order'       );
    var bd_tag_slug         = block.attr( 'data-tag_slug'         );
    var bd_cat_uids         = block.attr( 'data-cat_uids'         );
    var bd_posts            = block.attr( 'data-posts'            );
    var bd_ajax_pagination  = block.attr( 'data-ajax_pagination'  );
    var bd_block_nu         = block.attr( 'data-box_nu'           );
    var bd_max_nu           = block.attr( 'data-max_nu'           );
    var bd_total_posts_num  = block.attr( 'data-total_posts_num'  );
    var bd_com_meta         = block.attr( 'data-com_meta'       );
    var bd_review           = block.attr( 'data-review'         );
    var bd_author_meta      = block.attr( 'data-author_meta'    );
    var bd_date_meta        = block.attr( 'data-date_meta'      );
    var bd_thumbnail        = block.attr( 'data-thumbnail'      );

    if ( bd_ajax_pagination == "load_more" )
    {
        if ( bd_paged < bd_max_nu )
        {
            bd_paged++;
        }
    }

    else if ( bd_ajax_pagination = "next_prev" )
    {
        if ( $prev == 'next' )
        {
            if ( bd_paged < bd_max_nu )
            {
                bd_paged++;
            }
        }

        else {

            if ( bd_paged !=1 ) {
                bd_paged = bd_paged - 1;
            }

            else {
                return false;
            }
        }
    }

    block.attr( 'data-paged', bd_paged );

    jQuery.ajax( {
        type        : "POST",
        url         : bdaia.ajaxurl,
        dataType    : 'html',
        data        : "action=bdaia_wboxs&nonce="+bdaia.nonce+"&paged="+bd_paged+"&sort_order="+bd_sort_order+"&num_posts="+bd_num_posts+"&tag_slug="+bd_tag_slug+"&cat_uid="+bd_cat_uid+"&cat_uids="+bd_cat_uids+"&ajax_pagination="+bd_ajax_pagination+"&box_nu="+bd_block_nu+"&com_meta="+bd_com_meta+"&author_meta="+bd_author_meta+"&review="+bd_review+"&thumbnail="+bd_thumbnail+"&date_meta="+bd_date_meta+"&posts="+bd_posts,
        cache       : false,

        beforeSend : function ()
        {
            bd_wait.css( "display", "block"     );

            if ( bd_block_nu == 'wb1' || bd_block_nu == 'wb2' || bd_block_nu == 'wb3' || bd_block_nu == 'wb4' || bd_block_nu == 'wb5' || bd_block_nu == 'wb6' || bd_block_nu == 'wb7' || bd_block_nu == 'wb9' )
            {
                if ( bd_ajax_pagination == "load_more" )
                {
                    bd_content.css( "opacity", "1" );
                }

                else if ( bd_ajax_pagination = "next_prev" )
                {
                    bd_content.css( "opacity", "0.4" );
                }
            }

            if ( bd_block_nu == 'wb8' )
            {
                if ( bd_ajax_pagination == "load_more" )
                {
                    bd_content_ul.css( "opacity", "1" );
                }

                else if ( bd_ajax_pagination = "next_prev" )
                {
                    bd_content_ul.css( "opacity", "0.4" );
                }
            }
        },

        success: function( data )
        {
            if ( data == '' ) {}

            if ( data.trim() !== '' )
            {
                var content = jQuery( data );

                if ( bd_block_nu == 'wb1' || bd_block_nu == 'wb2' || bd_block_nu == 'wb3' || bd_block_nu == 'wb4' || bd_block_nu == 'wb5' || bd_block_nu == 'wb6' || bd_block_nu == 'wb7' || bd_block_nu == 'wb9' )
                {
                    if ( bd_ajax_pagination == "load_more" )
                    {
                        bd_content.append( content ).fadeIn( 'fast' );
                    }

                    else if ( bd_ajax_pagination = "next_prev" )
                    {
                        bd_content.html( content ).fadeIn( 'fast' );
                        bd_content.css( "opacity", "1" );
                    }
                }

                if ( bd_block_nu == 'wb8' )
                {
                    if ( bd_ajax_pagination == "load_more" )
                    {
                        bd_content_ul.append( content ).fadeIn( 'fast' );
                    }

                    else if ( bd_ajax_pagination = "next_prev" )
                    {
                        bd_content_ul.html( content ).fadeIn( 'fast' );
                        bd_content_ul.css( "opacity", "1" );
                    }
                }

                bd_more.css( "display", "block" );
                i_refresh.refresh();
                content.fitVids();

                jQuery( '.ttip' ).tipsy( { fade: true, gravity: 's' } );

                content.each( function( index )
                {
                    if ( jQuery().mediaelementplayer )
                    {
                        jQuery( this ).find( '.wp-audio-shortcode, .wp-video-shortcode' ).mediaelementplayer();
                    }
                } );

                var bd_re   = bd_content.find( '.bwb-article-img-container' );
                bd_re.addClass( 'bdaia-img-show' );
            }

            bd_wait.css( "display", "none" );

            if ( bd_max_nu == bd_paged )
            {
                bd_more.remove();
                bd_next.addClass( 'ajax-page-disabled' );
            }

            else {
                bd_next.removeClass( 'ajax-page-disabled' );
            }

            if ( 1== bd_paged )
            {
                bd_prev.addClass( 'ajax-page-disabled' );
            }

            else {
                bd_prev.removeClass( 'ajax-page-disabled' );
            }
        }

    }, 'html');

    return false;
}