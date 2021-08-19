<div class="theia_sticky wpb_column vc_column_container vc_col-sm-4">
    <div class="vc_column-inner">
        <div class="wpb_wrapper">
            <div class="wpb_widgetised_column wpb_content_element">
                <div class="wpb_wrapper">
                    @forelse ($partials_container->container_widget_with_lang ?? [] as $container_widget)
                        @widget('frontendWidget',['container_widget'=>$container_widget])
                    @empty
                        
                    @endforelse
                    
                    {{-- <div id="bdaia-tabs-2" class="content-only widget bdaia-widget">
                        <div class="bdaia-widget-tabs" id="tabs-bdaia-tabs-2">
                            <div class="bdaia-wt-inner">
                                <ul class="bdaia-tabs-nav with-popular with-recent">
                                    <li class="active">
                                        <a href="#tab1-bdaia-tabs-2"> Popular </a>
                                    </li>

                                    <li>
                                        <a href="#tab2-bdaia-tabs-2"> Recent </a>
                                    </li>
                                </ul>

                                <div class="bdaia-tab-content">
                                    <div class="bdaia-tab-container" id="tab1-bdaia-tabs-2">
                                        <div class="widget-inner">
                                            <div class="bdaia-wb-wrap bdaia-wb1">
                                                <div class="bdaia-wb-content">
                                                    <div class="bdaia-wb-inner">
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ static_asset('themes/news/frontend/assets/images/demo/23-104x74.jpg')}}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>Facebook&#8217;s fundraisers now help you raise money</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">November 22, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-02-104x74.jpg')}}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>Back these dreamy solar lanterns on Kickstarter</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 5, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-04-104x74.jpg')}}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>ClassPass will let you live stream fitness classes</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 18, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ static_asset('themes/news/frontend/assets/images/demo/james-zwadlo-190040-104x74.jpg')}}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>YouTube debuts inspiring Pride Month video to highlight</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">March 2, 2016</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/TAB1-->

                                    <div class="bdaia-tab-container" id="tab2-bdaia-tabs-2">
                                        <div class="widget-inner">
                                            <div class="bdaia-wb-wrap bdaia-wb1">
                                                <div class="bdaia-wb-content">
                                                    <div class="bdaia-wb-inner">
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-04-104x74.jpg')}}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>ClassPass will let you live stream fitness classes</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 18, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-07-104x74.jpg')}}"
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
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 12, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ static_asset('themes/news/frontend/assets/images/demo/david-marcu-5437-104x74.jpg')}}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>Facebook Testing Greetings Feature to Give Poke</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 12, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                        <div class="bdaia-wb-article bdaia-wba-small">
                                                            <article class="with-thumb">
                                                                <div class="bwb-article-img-container">
                                                                    <a href="single-page.html">
                                                                        <img
                                                                                width="104"
                                                                                height="74"
                                                                                src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                                class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                                alt=""
                                                                                data-src="{{ static_asset('themes/news/frontend/assets/images/demo/luke-chesser-48-104x74.jpg')}}"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <div class="bwb-article-content-wrapper">
                                                                    <header>
                                                                        <h3 class="entry-title">
                                                                            <a href="single-page.html">
                                                                                <span>Tom Kerridge&#8217;s spiced orange cake with plum sauce</span>
                                                                            </a>
                                                                        </h3>
                                                                    </header>
                                                                    <footer>
                                                                        <div class="bdaia-post-author-name">
                                                                            <a href="author-page.html" title="Posts by Amr Sadek" rel="author">Amr Sadek</a>
                                                                        </div>

                                                                        <div class="bdaia-post-date">December 12, 2017</div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/TAB2-->
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>