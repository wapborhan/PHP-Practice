<div class="theia_sticky wpb_column vc_column_container vc_col-sm-4">
    <div class="vc_column-inner">
        <div class="wpb_wrapper">
            <div class="wpb_widgetised_column wpb_content_element">
                <div class="wpb_wrapper">
                    @forelse ($home_page_second_sidebar->container_widget_with_lang ?? [] as $container_widget)
                        @widget('frontendWidget',['container_widget'=>$container_widget])
                    @empty
                        
                    @endforelse
                    {{-- <div id="bdaia-widget-box3-2" class="content-only widget bdaia-widget bdaia-box3">
                        <div class="widget-box-title widget-box-title-s4"><h3>Gadgets</h3></div>
                        <div class="widget-inner">
                            <div
                                    class="bdaia-wb-wrap bdaia-wb3 bdaia-wb-idgT4zO bdaia-ajax-pagination-load_more"
                                    data-box_nu="wb3"
                                    data-box_id="bdaia-wb-idgT4zO"
                                    data-paged="1"
                                    data-sort_order="popular"
                                    data-ajax_pagination="load_more"
                                    data-num_posts="4"
                                    data-tag_slug=""
                                    data-cat_uid=""
                                    data-cat_uids="4"
                                    data-max_nu="4"
                                    data-total_posts_num="15"
                                    data-posts=""
                                    data-com_meta=""
                                    data-thumbnail=""
                                    data-author_meta=""
                                    data-date_meta=""
                                    data-review=""
                            >
                                <div class="bdaia-wb-content">
                                    <div class="bdaia-wb-inner">
                                        <div class="bdaia-box-row">
                                            <div class="bdaia-wb-article bdaia-wba-bigs bdaiaFadeIn">
                                                <article class="with-thumb">
                                                    <div class="bwb-article-img-container">
                                                        <div class="vid-play">
                                                            <a href="single-page.html">
                                                                <span class="bdaia-io bdaia-io-controller-play"></span>
                                                            </a>
                                                        </div>

                                                        <a href="single-page.html">
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-03-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>

                                                    <div class="bwb-article-content-wrapper">
                                                        <header>
                                                            <h3 class="entry-title">
                                                                <a href="single-page.html">
                                                                    <span>California judge dismisses lawsuit that claims judge</span>
                                                                </a>
                                                            </h3>
                                                        </header>

                                                        <footer></footer>
                                                    </div>
                                                </article>
                                            </div>

                                            <div class="bdaia-wb-article bdaia-wba-bigs bdaiaFadeIn">
                                                <article class="with-thumb">
                                                    <div class="bwb-article-img-container">
                                                        <a href="single-page.html">
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/emanuele-pinna-258-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>

                                                    <div class="bwb-article-content-wrapper">
                                                        <header>
                                                            <h3 class="entry-title">
                                                                <a href="single-page.html">
                                                                    <span>Bragi Dash Pro and The Headphone Truly Wireless</span>
                                                                </a>
                                                            </h3>
                                                        </header>

                                                        <footer></footer>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                        <div class="bdaia-box-row">
                                            <div class="bdaia-wb-article bdaia-wba-bigs bdaiaFadeIn">
                                                <article class="with-thumb">
                                                    <div class="bwb-article-img-container">
                                                        <a href="single-page.html">
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-07-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>

                                                    <div class="bwb-article-content-wrapper">
                                                        <header>
                                                            <h3 class="entry-title">
                                                                <a href="single-page.html">
                                                                    <span>Oppo Given Green Clearance to Set Up Manufacturing</span>
                                                                </a>
                                                            </h3>
                                                        </header>

                                                        <footer></footer>
                                                    </div>
                                                </article>
                                            </div>

                                            <div class="bdaia-wb-article bdaia-wba-bigs bdaiaFadeIn">
                                                <article class="with-thumb">
                                                    <div class="bwb-article-img-container">
                                                        <a href="single-page.html">
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/linh-nguyen-174-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>

                                                    <div class="bwb-article-content-wrapper">
                                                        <header>
                                                            <h3 class="entry-title">
                                                                <a href="single-page.html">
                                                                    <span>Watch these trans kids learn the value of self-love</span>
                                                                </a>
                                                            </h3>
                                                        </header>

                                                        <footer></footer>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bdayh-posts-load-wait">
                                        <div class="sk-circle">
                                            <div class="sk-circle1 sk-child"></div>
                                            <div class="sk-circle2 sk-child"></div>
                                            <div class="sk-circle3 sk-child"></div>
                                            <div class="sk-circle4 sk-child"></div>
                                            <div class="sk-circle5 sk-child"></div>
                                            <div class="sk-circle6 sk-child"></div>
                                            <div class="sk-circle7 sk-child"></div>
                                            <div class="sk-circle8 sk-child"></div>
                                            <div class="sk-circle9 sk-child"></div>
                                            <div class="sk-circle10 sk-child"></div>
                                            <div class="sk-circle11 sk-child"></div>
                                            <div class="sk-circle12 sk-child"></div>
                                        </div>
                                    </div>
                                </div>

                                <script type="text/javascript">
                                    jQuery(document).ready(function () {
                                        jQuery("#bdaia-more-gT4zO .bdaia-wb-mb-inner").click(function (event) {
                                            event.preventDefault();
                                            kolyoum_wb_ajax_js("gT4zO", "");
                                        });
                                    });
                                </script>
                                <div class="bdaia-wb-more-btn" id="bdaia-more-gT4zO">
                                    <div class="bdaia-wb-mb-inner">Load more<span class="bdaia-io bdaia-io-angle-down"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="bdaia-widget-e3-2" class="content-only widget bdaia-widget bdaia-widget-e3 e3-trans">
                        <div class="widget-inner">
                            <div class="e3-inner">
                                <script>
                                    if (navigator.userAgent.indexOf("Speed Insights") == -1) {
                                        jQuery(".elementor-widget-container .bdaia-widget-e3 .e3-inner, .wpb_widgetised_column .bdaia-widget-e3 .e3-inner, .bd-sidebar .bdaia-widget-e3 .e3-inner").html(
                                            // '<a href="https://themeforest.net/item/i/19703399?ref=bdaia&utm_source=demos&utm_campaign=kolyoum&utm_content=main&utm_medium=srticle" target="_blank"><img style="max-width:300px" src="//localhost/kolyoum-html/main/wp-content/uploads/sites/2/2017/11/a600.jpg" alt="" width="300"></a>'
                                        );
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div id="recent-comments-2" class="content-only widget bdaia-widget widget_recent_comments">
                        <div class="widget-box-title widget-box-title-s4"><h3>Recent Comments</h3></div>
                        <div class="widget-inner">
                            <ul id="recentcomments">
                                <li class="recentcomments">
                                    <span class="comment-author-link">huzaifa</span> on
                                    <a href="single-page.html">
                                        Back these dreamy solar lanterns on Kickstarter
                                    </a>
                                </li>
                                <li class="recentcomments">
                                    <span class="comment-author-link"><a href="https://bdaia.com" rel="external nofollow ugc" class="url">Amr Sadek</a></span> on
                                    <a href="single-page.html">
                                        Back these dreamy solar lanterns on Kickstarter
                                    </a>
                                </li>
                                <li class="recentcomments">
                                    <span class="comment-author-link"><a href="https://bdaia.com" rel="external nofollow ugc" class="url">Amr Jammal</a></span> on
                                    <a href="single-page.html">Flying Ninja</a>
                                </li>
                                <li class="recentcomments">
                                    <span class="comment-author-link"><a href="https://bdaia.com" rel="external nofollow ugc" class="url">Amr Jammal</a></span> on
                                    <a href="single-page.html">Facebook&#8217;s fundraisers now help you raise money</a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>