jQuery(document).ready(function(){

    'use strict';

    var is_RTL = bdaia.is_rtl ? true : false;

    /**
     * Post read down
     */
    jQuery(document).on('click', '.bdaia-post-read-down',function(event){
        event.preventDefault();

        jQuery('html, body').animate({scrollTop:jQuery('.bd_single_template_10 article').offset().top - jQuery('#wpadminbar').height() - jQuery('.fixed-enabled').height()}, 500);

        return false;
    } );


    /**
     * Comments
     */
    if(bdaia.click_to_comments) {
        jQuery( ".bdaia-load-comments-btn" ).fadeIn( 'fast' );
        jQuery( "#comments.comments-container" ).hide();
        jQuery( "#respond.comment-respond" ).hide();

        jQuery( ".bdaia-load-comments-btn a" ).on( "click",function(){
            jQuery( ".bdaia-load-comments-btn" ).hide();
            jQuery( "#comments.comments-container" ).fadeIn( 'fast' );
            jQuery( "#respond.comment-respond" ).fadeIn( 'fast' );
        } );
    }

    /**
     * Post style cover
     */
    jQuery('.post-style10-cover').on('click', function(event) {
        event.preventDefault();

        jQuery( '.post-style10-head .bdaia-post-featured-video' ).append( jQuery( ".post-style10-head textarea.embed-code" ).val() ).fitVids();
        jQuery( '.post-style10-head textarea.embed-code, .post-style10-cover' ).remove();

        jQuery( ".post-style10-head .post-style10-cover-bg .post-style10-cover" ).slideDown( 1000, function() {
            jQuery( this ).css( "height", "100%" );
        });
    });

    /**
     * Post Reading Indicator
     */
    if(jQuery(window).width()>900 && bdaia.is_singular && bdaia.post_reading_position_indicator){
        var reading_content = jQuery( '.bd-content-wrap .post' );

        if(reading_content.length > 0){
            reading_content.imagesLoaded(function(){
                var content_height	= reading_content.height();
                var window_height	= jQuery(window).height();

                jQuery(window).scroll(function(){
                    var percent = 0,
                        content_offset = reading_content.offset().top,
                        window_offest = jQuery(window).scrollTop();

                    if(window_offest > content_offset){
                        percent = 100 * (window_offest - content_offset) / ( content_height - window_height);
                    }

                    jQuery('#reading-position-indicator').css('width', percent + '%');
                });
            });
        }
    }


    /**
     * Check Also
     */
    var $bdCheckAlso        = jQuery( "#bdCheckAlso" );
    var $bdCheckAlsoRight   = jQuery( ".bdCheckAlso-right" );
    var $bdCheckAlsoHentery = jQuery( "article.hentry" );

    if(jQuery(window).width()> 900 && bdaia.is_singular && $bdCheckAlso.length > 0){
        var articleOffset = $bdCheckAlsoHentery.offset().top + ( $bdCheckAlsoHentery.outerHeight()/2 );
        var bdCheckAlsoClosed = false;

        if(jQuery(window).width()<= 1120){
            $bdCheckAlso.hide();
        }
        else{
            $bdCheckAlso.show();
        }

        jQuery(window).resize(function(){
            if(jQuery(window).width()<= 1120){
                $bdCheckAlso.hide();
            }
            else {
                $bdCheckAlso.show();
            }
        });

        jQuery(window).scroll(function(){
            if ( ! bdCheckAlsoClosed ) {
                if ( jQuery(window).scrollTop() > articleOffset) {
                    if ( $bdCheckAlsoRight.length ) {
                        $bdCheckAlso.addClass('bdCheckAlsoShow');
                    }
                    else {
                        $bdCheckAlso.addClass('bdCheckAlsoShow');
                    }
                }
                else if(jQuery(window).scrollTop()<= articleOffset) {
                    if( $bdCheckAlsoRight.length ){
                        $bdCheckAlso.removeClass('bdCheckAlsoShow');
                    }
                    else {
                        $bdCheckAlso.removeClass('bdCheckAlsoShow');
                    }
                }
            }
        });

        jQuery( '#check-also-close' ).on('click', function(){
            $bdCheckAlso.removeClass('bdCheckAlsoShow');
            bdCheckAlsoClosed = true ;
            return false;
        });
    }

    /**
     * Post like
     */
    jQuery(document).on('click', '.post-like a',function(event){
        var heart   = jQuery(this);
        var post_id = heart.data('post_id');

        jQuery.ajax({
            type    : "post",
            url     : ajaxurl,
            data    : "action=kolyoum_post_like&nonce="+bdaia.nonce+"&bdaia_post_like=&post_id="+post_id,

            success: function( e ) {
                if ( e != "already" ) {
                    heart.addClass('voted');
                    heart.siblings('.count').text( e )
                }
            }
        } ); return false
    } );

});