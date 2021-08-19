jQuery(document).ready(function(){

    'use strict';

    var is_RTL = false;

    jQuery('.slider-area').each(function(idx, item){
        var grid_this       = jQuery(this),
            grid_attr_id    = grid_this.attr( 'id' ),
            slider_area     = grid_this.find( '.slider-area' ),
            grid_inner      = grid_this.find( '.cover-inner' ),
            grid_lazy       = grid_this.find( '.story-bg' ),
            grid_id         = grid_this.attr( 'data-grid-id' );

        var grid_autoplay   = grid_this.attr( 'data-autoplay' ) ? true : false,
            grid_fade       = grid_this.attr( 'data-fade' ) ? true : false,
            grid_speed      = grid_this.attr( 'data-speed' );

        if ( grid_this.length ){
            var cover_class     = grid_this.attr( 'class' ),
                cover_artilce   = grid_this.find( 'article' );

            if ( cover_class.indexOf( 'grid-4_articles' ) >= 0 ) {
                for ( var i = 0; i < cover_artilce.length; i+=4 ) {
                    cover_artilce.slice(i, i+4).wrapAll('<div class="slide"></div>');
                }
            }
            else  if ( cover_class.indexOf( 'grid-2_articles' ) >= 0 ) {
                for ( var i = 0; i < cover_artilce.length; i+=2 ) {
                    cover_artilce.slice(i, i+2).wrapAll('<div class="slide"></div>');
                }
            }
            else  if ( cover_class.indexOf( 'grid-1_articles' ) >= 0 ) {
                for ( var i = 0; i < cover_artilce.length; i+=1 ) {
                    cover_artilce.slice(i, i+1).wrapAll('<div class="slide"></div>');
                }
            }
            else  if ( cover_class.indexOf( 'grid-3_articles' ) >= 0 ) {
                for ( var i = 0; i < cover_artilce.length; i+=3 ) {
                    cover_artilce.slice(i, i+3).wrapAll('<div class="slide"></div>');
                }
            }

            else  if ( cover_class.indexOf( 'grid-5_articles' ) >= 0 ) {
                for ( var i = 0; i < cover_artilce.length; i+=5 ) {
                    cover_artilce.slice(i, i+5).wrapAll('<div class="slide"></div>');
                }
            }
            else  if ( cover_class.indexOf( 'grid-6_articles' ) >= 0 ) {
                for ( var i = 0; i < cover_artilce.length; i+=6 ) {
                    cover_artilce.slice(i, i+6).wrapAll('<div class="slide"></div>');
                }
            }
            else  if ( cover_class.indexOf( 'grid-7_articles' ) >= 0 ) {
                for ( var i = 0; i < cover_artilce.length; i+=7 ) {
                    cover_artilce.slice(i, i+7).wrapAll('<div class="slide"></div>');
                }
            }
            else  if ( cover_class.indexOf( 'grid-8_articles' ) >= 0 ) {
                for ( var i = 0; i < cover_artilce.length; i+=8 ) {
                    cover_artilce.slice(i, i+8).wrapAll('<div class="slide"></div>');
                }
            }
        }

        if ( grid_fade ) {
            var speed       = 500,
                cssEase     = 'linear';
        }

        jQuery(grid_inner).slick({
            lazyLoad       : 'ondemand',
            rtl            : is_RTL,
            dots           : false,
            arrows         : true,
            slide          : '.slide',
            appendArrows   : '#'+ grid_attr_id +' .bd-grid-nav',
            prevArrow      : '<li class="slick-prev"><a class="bd-arrow-nav-prev"><span class="fa fa-angle-left" ></span></a></li>',
            nextArrow      : '<li class="slick-next"><a class="bd-arrow-nav-next"><span class="fa fa-angle-right" ></span></a></li>',
            autoplay       : grid_autoplay,
            autoplaySpeed  : grid_speed,
            speed          : speed,
            fade           : grid_fade,
            cssEase        : cssEase
        });

        // LazyLoad
        jQuery(grid_this).on('lazyLoaded', function (e, slick, image, imageSource) {
            image.attr('src','');
            image.next('.story-bg').css('background-image','url("'+imageSource+'")');
        });

        grid_this.fadeIn(1000,function(){
            grid_this.parent().find('.loader-overlay').remove();
        });

    });

    // Articles Slider
    var bdaia_articles_slider = jQuery('.articles-slider');
    if (bdaia_articles_slider.length) {
        bdaia_articles_slider.each( function (idx, item){
            var slide                   = '.slide',
                bdaia_this_slider       = jQuery(this),
                bdaia_slider_parent     = bdaia_this_slider.closest('.articles-box-slider'),
                bdaia_is_full_width     = ( bdaia_this_slider.parents('#warp').hasClass('bdaia-sidebar-none') ? true : false ),
                bdaia_slider_col        = bdaia_slider_parent.attr( 'data-col' ),
                animate_auto            = bdaia_slider_parent.attr( 'data-animate-auto' ) ? true : false,
                slider_speed            = bdaia_slider_parent.attr( 'data-speed' ),
                sliderId                = bdaia_slider_parent.attr('id') ? bdaia_slider_parent.attr('id') : 'articles-slider' + idx;

            bdaia_slider_parent.attr( 'id', sliderId );

            if ( bdaia_slider_col == "2col" )
            {
                jQuery(bdaia_this_slider).slick( {
                    autoplay        : animate_auto,
                    infinite        : false,
                    autoplaySpeed   : slider_speed,
                    slide         : slide,
                    dots          : true,
                    rtl           : is_RTL,
                    slidesToShow  : ( bdaia_is_full_width ? 3 : 2 ),
                    slidesToScroll: ( bdaia_is_full_width ? 3 : 2 ),
                    appendArrows  : '#' + sliderId +' .articles-box-slider-arrow-nav',
                    prevArrow     : '<li class="slick-prev"><span class="fa fa-angle-left" ></span></li>',
                    nextArrow     : '<li class="slick-next"><span class="fa fa-angle-right" ></span></li>',

                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow  : ( bdaia_is_full_width ? 3 : 2 ),
                                slidesToScroll: ( bdaia_is_full_width ? 3 : 2 )
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow  : 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 670,
                            settings: {
                                slidesToShow  : 1,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 500,
                            settings: {
                                slidesToShow  : 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                } );
            }

            else {
                jQuery(bdaia_this_slider).slick( {
                    autoplay        : animate_auto,
                    infinite        : false,
                    autoplaySpeed   : slider_speed,
                    slide         : slide,
                    dots          : true,
                    rtl           : is_RTL,
                    appendArrows  : '#' + sliderId +' .articles-box-slider-arrow-nav',
                    prevArrow     : '<li class="slick-prev"><span class="fa fa-angle-left" ></span></li>',
                    nextArrow     : '<li class="slick-next"><span class="fa fa-angle-right" ></span></li>',

                } );
            }

            jQuery(bdaia_this_slider).fadeIn(1000,function(){
                bdaia_this_slider.parent().find('.loader-overlay').remove();
            });

            bdaia_this_slider.find('.article-link-thumb-bg').each(function() {

                //jQuery(this).attr('data-src')
                jQuery(this).css('background-image','url("'+jQuery(this).attr('data-src')+'")').removeAttr('data-src');
            });
            bdaia_this_slider.slick('setPosition');
        });
    }

    // Scrolling box
    var bdaia_scrolling_slider = jQuery('.scrolling-slider');
    if (bdaia_scrolling_slider.length) {
        bdaia_scrolling_slider.each( function (idx, item){
            var slide                   = '.slide',
                bdaia_this_slider       = jQuery(this),
                bdaia_is_full_width     = ( bdaia_this_slider.parents('body').hasClass('full-width') ? true : false ),
                bdaia_slider_parent     = bdaia_this_slider.closest('.scrolling-box'),
                slidesToShow            = ( bdaia_is_full_width ? 4 : 3 ),
                animate_auto            = bdaia_slider_parent.attr( 'data-animate-auto' ) ? true : false,
                slider_speed            = bdaia_slider_parent.attr( 'data-speed' ),
                sliderId                = bdaia_slider_parent.attr('id') ? bdaia_slider_parent.attr('id') : 'scrolling-slider' + idx;

            bdaia_slider_parent.attr( 'id', sliderId );

            bdaia_this_slider.slick({
                autoplay        : animate_auto,
                autoplaySpeed   : slider_speed,
                slide         : slide,
                dots          : true,
                rtl           : is_RTL,
                slidesToShow  : slidesToShow,
                slidesToScroll: slidesToShow,
                appendArrows  : '#' + sliderId +' .articles-box-title-arrow-nav',
                prevArrow     : '<li><a class="articles-box-title-arrow-nav-prev"><span class="fa fa-angle-left" ></span></a></li>',
                nextArrow     : '<li><a class="articles-box-title-arrow-nav-next"><span class="fa fa-angle-right" ></span></a></li>',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow  : ( bdaia_is_full_width ? 4 : 3 ),
                            slidesToScroll: ( bdaia_is_full_width ? 4 : 3 )
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow  : 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 670,
                        settings: {
                            slidesToShow  : 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 500,
                        settings: {
                            slidesToShow  : 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            bdaia_this_slider.fadeIn(1000,function(){
                bdaia_this_slider.parent().find('.loader-overlay').remove();
            });

            bdaia_this_slider.slick('setPosition');
        });

        // LazyLoad
        jQuery('.lazy-img, .img-lazy').lazy();

        jQuery('.main-slider_carousel').find('.lazy-img, .img-lazy').each(function() {
            jQuery(this).attr('src', jQuery(this).attr('data-src')).removeAttr('data-src');
        } );

        bdaia_scrolling_slider.find('.lazy-img, .img-lazy').each(function() {
            jQuery(this).attr('src', jQuery(this).attr('data-src')).removeAttr('data-src');
        } );
    }

    // Related Posts
    jQuery('.kolyoum-related-posts').each(function(idx, item){
        jQuery('.kolyoum-related-posts .articles-box').hide();
        jQuery('.kolyoum-related-posts .articles-box:first').show();
        jQuery('.related-posts-nav li a:first').addClass('active');

        jQuery('.related-posts-nav li a').on('click', function(event){
            event.preventDefault();

            jQuery('.related-posts-nav li a').removeClass('active');
            jQuery(this).addClass('active');
            jQuery('.kolyoum-related-posts .articles-box').hide();


            var currentTab = jQuery(this).attr('href'),
                activeTab  = jQuery(currentTab).show();

            activeTab.find('.articles-box-item').velocity('stop').velocity('transition.slideUpIn',{stagger: 100 ,duration: 500,
                complete: function(){
                    bd_lazy_load();
                }
            });

            if(jQuery.fn.slick){
                jQuery('.kolyoum-related-posts .scrolling-box-slider').slick('setPosition');
            }
        });
    });


    // Gallery Slider
    var gallery__slider = jQuery('.gallery-slider');
    if (gallery__slider.length) {
        gallery__slider.each(function(idx, item){
            var _this = jQuery(this),
                _id = _this.find('.gallery-slider-container').attr('id'),
                _thumbnail = _this.find('.thumbnail'),
                _the_id = _thumbnail.attr('data-the-id'),
                _slider = jQuery('#'+_id+' ul');

            //console.log(_the_id);

            _slider.slick({
                lazyLoad      : 'ondemand',
                rtl           : is_RTL,
                dots          : false,
                infinite      : true,
                vertical      : false,
                draggable     : true,
                slidesToShow  : 1,
                slidesToScroll: 1,
                autoplay      : true,
                autoplaySpeed : 3000,
                fade          : true,
                cssEase       : 'linear'
            });

            _slider.fadeIn(1000,function(){
                _slider.parent().find('.loader-overlay').remove();
            });

            // LazyLoad
            _slider.find('.lazy-img, .img-lazy').each(function(){
                jQuery(this).attr('src', jQuery(this).attr('data-src')).removeAttr('data-src');
            });

            if(jQuery.fn.iLightBox){
                jQuery('a.lightbox-enabled-'+_the_id).iLightBox();
            }

            _slider.slick('setPosition');
        });
    }

});