function bd_wb_ajax_js( $block_id, prev )
{
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

    if( bd_ajax_pagination == "load_more" )
    {
        if( bd_paged < bd_max_nu ){
            bd_paged++;
        }
    }
    else if( bd_ajax_pagination = "next_prev" )
    {
        if( prev == 'next' ) {
            if( bd_paged < bd_max_nu ){
                bd_paged++;
            }
        }
        else {
            if ( bd_paged != 1 ) {
                bd_paged = bd_paged - 1;
            }
            else {
                return false;
            }
        }
    }

    block.attr( 'data-paged', bd_paged  );

    jQuery.ajax({

        type        : "POST",
        url         : bd_w_blocks.bdaia_w_ajax_url,
        dataType    : 'html',
        data        : "action=bdaia_wboxs&nonce="+bd_w_blocks.bdaia_w_ajax_nonce+"&paged="+bd_paged+"&sort_order="+bd_sort_order+"&num_posts="+bd_num_posts+"&tag_slug="+bd_tag_slug+"&cat_uid="+bd_cat_uid+"&cat_uids="+bd_cat_uids+"&ajax_pagination="+bd_ajax_pagination+"&box_nu="+bd_block_nu+"&com_meta="+bd_com_meta+"&author_meta="+bd_author_meta+"&review="+bd_review+"&thumbnail="+bd_thumbnail+"&date_meta="+bd_date_meta+"&posts="+bd_posts,
        cache       : false,

        beforeSend : function () {

            bd_wait.css( "display", "block"     );

            if ( bd_block_nu == 'wb1' || bd_block_nu == 'wb2' || bd_block_nu == 'wb3' || bd_block_nu == 'wb4' || bd_block_nu == 'wb5' || bd_block_nu == 'wb6' || bd_block_nu == 'wb7' ) {
                if( bd_ajax_pagination == "load_more" ) {
                    bd_content.css( "opacity", "1" );
                }
                else if( bd_ajax_pagination = "next_prev" ) {
                    bd_content.css( "opacity", "0.4" );
                }
            }

            if( bd_block_nu == 'wb8' ) {
                if( bd_ajax_pagination == "load_more" ) {
                    bd_content_ul.css( "opacity", "1" );
                }
                else if( bd_ajax_pagination = "next_prev" ) {
                    bd_content_ul.css( "opacity", "0.4" );
                }
            }
        },

        success: function(data)
        {
            if ( data == '' )
            {
            }

            if ( data.trim() !== '' )
            {
                var content = jQuery(data);

                if ( bd_block_nu == 'wb1' || bd_block_nu == 'wb2' || bd_block_nu == 'wb3' || bd_block_nu == 'wb4' || bd_block_nu == 'wb5' || bd_block_nu == 'wb6' || bd_block_nu == 'wb7' ) {

                    if (bd_ajax_pagination == "load_more") {
                        bd_content.append(content).fadeIn('fast');
                    }
                    else if (bd_ajax_pagination = "next_prev") {
                        bd_content.html(content).fadeIn('fast');
                        bd_content.css("opacity", "1");
                    }
                }

                if( bd_block_nu == 'wb8' ){
                    if( bd_ajax_pagination == "load_more" ) {
                        bd_content_ul.append(content).fadeIn('fast');
                    }
                    else if( bd_ajax_pagination = "next_prev" ) {
                        bd_content_ul.html(content).fadeIn('fast');
                        bd_content_ul.css( "opacity", "1" );
                    }
                }

                bd_more.css( "display", "block" );

                i_refresh.refresh();
                content.fitVids();
                jQuery('.ttip').tipsy({fade: true, gravity: 's'});
                content.each(function(index){
                    if(jQuery().mediaelementplayer){
                        jQuery(this).find('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer();
                    }
                });

                var bd_re   = bd_content.find( '.bwb-article-img-container' );
                bd_re.addClass( 'bdaia-img-show' );
            }

            bd_wait.css( "display", "none" );

            if( bd_max_nu == bd_paged ){
                bd_more.remove();
                bd_next.addClass('ajax-page-disabled');
            }
            else {
                bd_next.removeClass('ajax-page-disabled');
            }

            if( 1 == bd_paged ){
                bd_prev.addClass('ajax-page-disabled');
            }
            else {
                bd_prev.removeClass('ajax-page-disabled');
            }
        }

    }, 'html');
    return false;
}