@extends('frontend.layouts.app')

@section('style')
    <style>
        
    </style>
@endsection

@section('content')
    <div class="bd-content-wrap">
        <div class="cfix"></div>

        <div id="bdaia-breaking-news" class="breaking-news-items">
            <div class="bd-container">
                <div class="breaking-news-items-inner">
                            <span class="breaking-title">
                                <span class="bdaia-io bdaia-io-newspaper"></span>
                                <span class="txt"> Breaking News </span>
                            </span>

                    <div class="breaking-cont">
                        <ul class="webticker">
                            <li>
                                <h4>
                                    <a href="single-page.html" rel="bookmark">
                                        <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                        ClassPass will let you live stream fitness classes
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="single-page.html" rel="bookmark">
                                        <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                        Oppo Given Green Clearance to Set Up Manufacturing
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="single-page.html" rel="bookmark">
                                        <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                        Facebook Testing Greetings Feature to Give Poke
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="single-page.html" rel="bookmark">
                                        <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                        Tom Kerridge&#8217;s spiced orange cake with plum sauce
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="http://localhost/kolyoum-html/main/pulled-not-pork-vegan-jackfruit-slaw-avocado-vegan-rashers/" rel="bookmark">
                                        <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                        Pulled Not-Pork Vegan Jackfruit with Slaw, Avocado
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="http://localhost/kolyoum-html/main/individual-mediterranean-savoury-muffin-roasts-olives-nuts-marinated/" rel="bookmark">
                                        <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                        Individual Mediterranean Savoury Muffin Roasts with Olives
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="http://localhost/kolyoum-html/main/almond-pinenut-fritter-braised-fennel-roast-butternut-squash-white/" rel="bookmark">
                                        <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                        Fritter with Braised Fennel, Roast Butternut Squash, White
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="http://localhost/kolyoum-html/main/pearl-cous-cous-crumble-mixed-pepper-dressing-slow-roasted-tomatoes/" rel="bookmark">
                                        <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                        Pearl Cous-Cous Crumble with Mixed Pepper Dressing
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="http://localhost/kolyoum-html/main/polenta-cornmeal-slices-roasted-peppers-basil-scratch/" rel="bookmark">
                                        <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                        Polenta (Cornmeal) Slices with Roasted Peppers &#038; Basil
                                    </a>
                                </h4>
                            </li>
                            <li>
                                <h4>
                                    <a href="single-page.html" rel="bookmark">
                                        <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                        Amazon Echo Devices and Music Unlimited Launched
                                    </a>
                                </h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="bd-container entry-content-only">
            @if(isset($articles) && count($articles) > 4)
                <section id="i602-6592" class="grid-4_articles cover-grid602 slider-area cover-grid" data-grid-id="i602">
                    <div class="cover-wrapper">
                        <div class="loader-overlay"><div class="bd-loading"></div></div>
                        <div class="bd-container">
                            <ul class="bd-grid-nav"></ul>
                            <div class="cover-inner">
                                @php
                                    $style[0] = ["story-id"=>"152","article-item"=> "video"];
                                    $style[1] = ["story-id"=>"150","article-item"=> "gallery"];
                                    $style[2] = ["story-id"=>"212","article-item"=> "video"];
                                    $style[3] = ["story-id"=>"231","article-item"=> "standard"];
                                @endphp
                                @for ($i = 0; $i < 4; $i++)
                                    <article class="cover-item cover-story story-count-{{$i+1}} story-id-{{$style[$i]["story-id"]}} article-item-{{$style[$i]["article-item"]}}" data-story-id="{{$style[$i]["story-id"]}}">
                                        <div class="lazy-bg story-inner">
                                            <img
                                                    data-lazy="{{ static_asset($articles[$i]->featured_image ?? 'themes/news/frontend/assets/images/demo/img-11-616x482.jpg')}}"
                                                    src="{{ static_asset($articles[$i]->featured_image ?? 'themes/news/frontend/assets/images/demo/img-11-616x482.jpg')}}"
                                                    alt=""
                                            />
                                            <div class="story-bg"></div>
                                            <a
                                                    class="cover-trigger"
                                                    href="single-page.html"
                                                    title="Australia just voted overwheinly favour legalising"
                                            ></a>

                                            <div class="rating-percentages">
                                                <div class="rating-percentages-inner" data-rate-val="68">
                                                    <span>68% </span>
                                                </div>
                                            </div>

                                            <div class="cover-overlay">
                                                <div class="cover-overlay-inner">
                                                    <div class="cover-overlay-content">
                                                        <div class="cover-overlay-content-in">
                                                            <a class="bd-cat-link bd-cat-6" href="category-page.html">{{$articles[$i]->category_article_first->category->title}}</a>
                                                            <h3 class="cover-overlay-title">
                                                                <a
                                                                        href="single-page.html"
                                                                        title="Australia just voted overwheinly favour legalising"
                                                                >
                                                                    {{$articles[$i]->title}}
                                                                </a>
                                                            </h3>
                                                            <div class="article-meta-info">
                                                                <div class="bd-alignleft">
                                                                    <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>{{$articles[$i]->created_at->format('F d, Y')}}</span></span>
                                                                </div>
                                                                <div class="bd-alignright"></div>
                                                                <div class="cfix"></div>
                                                            </div>
                                                            <!--/.article-meta-info/-->
                                                            <p class="article-excerpt">
                                                                {!! Str::limit(strip_tags($articles[$i]->content), 50, $end='...') !!}
                                                            </p>
                                                            <!-- .article-excerpt -->
                                                        </div>
                                                        <!-- .cover-overlay-content-in -->
                                                    </div>
                                                    <!-- .cover-overlay-content -->
                                                </div>
                                                <!-- .cover-overlay-inner -->
                                            </div>
                                            <!-- .cover-overlay -->
                                        </div>
                                        <!-- .story-inner -->
                                    </article>    
                                @endfor
                                
                                {{-- <article class="cover-item cover-story story-count-2 story-id-150 article-item-gallery" data-story-id="150">
                                    <div class="lazy-bg story-inner">
                                        <img
                                                data-lazy="{{ static_asset('themes/news/frontend/assets/images/demo/img-02-616x482.jpg')}}"
                                                src="{{ static_asset('themes/news/frontend/assets/images/no-thumbnail.svg')}}"
                                                alt=""
                                        />
                                        <div class="story-bg"></div>
                                        <a
                                                class="cover-trigger"
                                                href="single-page.html"
                                                title="Back these dreamy solar lanterns on Kickstarter"
                                        ></a>
                                        <!-- .cover-trigger -->
                                        <div class="cover-overlay">
                                            <div class="cover-overlay-inner">
                                                <div class="cover-overlay-content">
                                                    <div class="cover-overlay-content-in">
                                                        <a class="bd-cat-link bd-cat-11" href="category-page.html">Business</a>
                                                        <h3 class="cover-overlay-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Back these dreamy solar lanterns on Kickstarter"
                                                            >
                                                                Back these dreamy solar lanterns on Kickstarter
                                                            </a>
                                                        </h3>
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 5, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright"></div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <p class="article-excerpt">
                                                            I recently had the enviable task of reading nearly every story Richard Matheson ever wrote and selecting 33 tales to be&hellip;
                                                        </p>
                                                        <!-- .article-excerpt -->
                                                    </div>
                                                    <!-- .cover-overlay-content-in -->
                                                </div>
                                                <!-- .cover-overlay-content -->
                                            </div>
                                            <!-- .cover-overlay-inner -->
                                        </div>
                                        <!-- .cover-overlay -->
                                    </div>
                                    <!-- .story-inner -->
                                </article>
                                <article class="cover-item cover-story story-count-3 story-id-212 article-item-video" data-story-id="212">
                                    <div class="lazy-bg story-inner">
                                        <img
                                                data-lazy="{{ static_asset('themes/news/frontend/assets/images/demo/img-03-310x241.jpg')}}"
                                                src="{{ static_asset('themes/news/frontend/assets/images/no-thumbnail.svg')}}"
                                                alt=""
                                        />
                                        <div class="story-bg"></div>
                                        <a
                                                class="cover-trigger"
                                                href="single-page.html"
                                                title="California judge dismisses lawsuit that claims judge"
                                        ></a>
                                        <!-- .cover-trigger -->
                                        <div class="vid-play">
                                            <a href="single-page.html">
                                                <span class="bdaia-io bdaia-io-controller-play"></span>
                                            </a>
                                        </div>

                                        <div class="cover-overlay">
                                            <div class="cover-overlay-inner">
                                                <div class="cover-overlay-content">
                                                    <div class="cover-overlay-content-in">
                                                        <a class="bd-cat-link bd-cat-4" href="category-page.html">Gadgets</a>
                                                        <h3 class="cover-overlay-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="California judge dismisses lawsuit that claims judge"
                                                            >
                                                                California judge dismisses lawsuit that claims judge
                                                            </a>
                                                        </h3>
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 6, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright"></div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <p class="article-excerpt">
                                                            I recently had the enviable task of reading nearly every story Richard Matheson ever wrote and selecting 33 tales to be&hellip;
                                                        </p>
                                                        <!-- .article-excerpt -->
                                                    </div>
                                                    <!-- .cover-overlay-content-in -->
                                                </div>
                                                <!-- .cover-overlay-content -->
                                            </div>
                                            <!-- .cover-overlay-inner -->
                                        </div>
                                        <!-- .cover-overlay -->
                                    </div>
                                    <!-- .story-inner -->
                                </article>
                                <article class="cover-item cover-story story-count-4 story-id-231 article-item-standard" data-story-id="231">
                                    <div class="lazy-bg story-inner">
                                        <img
                                                data-lazy="{{ static_asset('themes/news/frontend/assets/images/demo/img-08-310x241.jpg')}}"
                                                src="{{ static_asset('themes/news/frontend/assets/images/no-thumbnail.svg')}}"
                                                alt=""
                                        />
                                        <div class="story-bg"></div>
                                        <a class="cover-trigger" href="single-page.html" title="Google and Amazon are punishing their own"></a>
                                        <!-- .cover-trigger -->
                                        <div class="cover-overlay">
                                            <div class="cover-overlay-inner">
                                                <div class="cover-overlay-content">
                                                    <div class="cover-overlay-content-in">
                                                        <a class="bd-cat-link bd-cat-6" href="category-page.html">Photography</a>
                                                        <h3 class="cover-overlay-title">
                                                            <a href="single-page.html" title="Google and Amazon are punishing their own">
                                                                Google and Amazon are punishing their own
                                                            </a>
                                                        </h3>
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 8, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright"></div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <p class="article-excerpt">
                                                            I recently had the enviable task of reading nearly every story Richard Matheson ever wrote and selecting 33 tales to be&hellip;
                                                        </p>
                                                        <!-- .article-excerpt -->
                                                    </div>
                                                    <!-- .cover-overlay-content-in -->
                                                </div>
                                                <!-- .cover-overlay-content -->
                                            </div>
                                            <!-- .cover-overlay-inner -->
                                        </div>
                                        <!-- .cover-overlay -->
                                    </div>
                                    <!-- .story-inner -->
                                </article> --}}
                            </div>
                            <!-- .cover-inner -->
                        </div>
                        <!-- .bd-container -->
                    </div>
                    <!-- .cover-wrapper -->
                </section>
                <!-- .slider-area -->
            @endif

            <script>
                var js_articles_box_2 = {
                    type: "block614",
                    cat_uids: "bd-business,bd-culture,bd-gadgets,bd-reviews",
                    sort_order: "popular",
                    num_posts: "3",
                    ajax_pagination: "next_prev",
                    title_style: "style3",
                    content_only: "true",
                    filters: "true",
                    post_meta: "true",
                    max_num_pages: 17,
                };
            </script>
            @if(isset($articles) && count($articles) > 7)
                <div class="full-width">
                    <div id="articles_box_2" class="content-only articles-box-next_prev articles-box articles-box-block614" data-page="1" style="--blocks-color: #105efb;">
                        <div class="articles-box-container-wrapper">
                            <div class="articles-box-title articles-box-title-s4">
                                <h3>Editor's pick</h3>
                                <div class="articles-box-title-nav">
                                    <ul class="articles-box-title-arrow-nav">
                                        <li>
                                            <a class="articles-box-title-arrow prev_arrow pagination-disabled" data-type="prev" href="#">
                                                <span class="fa fa-angle-left"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="articles-box-title-arrow next_arrow" data-type="next" href="#">
                                                <span class="fa fa-angle-right"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="articles-box-filter-links-more">
                                        <li>
                                            <span class="button-more"><span class="bdaia-io bdaia-io-dots-three-horizontal"></span></span>
                                            <div class="articles-box-filter-links-more-inner"></div>
                                        </li>
                                    </ul>
                                    <ul class="articles-box-filter-links filter_categories">
                                        <li class="active"><a href="#" class="articles-ajax-term" data-id="all">All</a></li>
                                        @forelse ($categories as $category)
                                            <li><a href="#category{{$category->id}}" data-id="{{$category->id}}" class="articles-ajax-term">{{$category->title}}</a></li>
                                            @if($loop->index == 3)
                                                @break
                                            @endif
                                        @empty
                                            
                                        @endforelse
                                        {{-- <li><a href="#11" data-id="bd-business" class="articles-ajax-term">Business</a></li>
                                        <li><a href="#10" data-id="bd-culture" class="articles-ajax-term">Culture</a></li>
                                        <li><a href="#4" data-id="bd-gadgets" class="articles-ajax-term">Gadgets</a></li>
                                        <li><a href="#5" data-id="bd-reviews" class="articles-ajax-term">Reviews</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <!--/.articles-box-title/-->
                            <div class="articles-box-container">
                                <div class="articles-box-content">
                                    <ul class="articles-box-items articles-box-list-container clearfix articles-items-1">
                                        @forelse ($articles as $article)
                                            @if($loop->index > 3)
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large" style="height: 190px">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-11" href="#">{{$article->category_article_first->category->title}}</a></div>
                                                        <a href="#" title="China’s phone market is now dominated by five">
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset($article->featured_image ?? 'themes/news/frontend/assets/images/demo/annie-spratt-294450-104x74.jpg')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset($article->featured_image ?? 'themes/news/frontend/assets/images/demo/annie-spratt-294450-104x74.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="China’s phone market is now dominated by five"
                                                            >
                                                                {{$article->title}}
                                                            </a>
                                                        </h3>
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                                    <span class="meta-author meta-item">
                                                                                        <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                                    </span>
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>{{$article->created_at->format('F d, Y')}}</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                                    <span class="meta-comment meta-item">
                                                                                        <a href="single-page.html">
                                                                                            <span class="fa fa-comments"></span> 0
                                                                                        </a>
                                                                                    </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                    </div>
                                                </li>
                                            @endif
                                            @if($loop->index == 6)
                                                @break
                                            @endif
                                        @empty
                                            
                                        @endforelse
                                        {{-- <li class="articles-box-item article-item-standard">
                                            <div class="article-thumb kolyoum-blocks-large">
                                                <div class="block-info-cat"><a class="bd-cat-link bd-cat-11" href="category-page.html">Business</a></div>
                                                <a href="single-page.html" title="China’s phone market is now dominated by five">
                                                    <img
                                                            width="406"
                                                            height="233"
                                                            src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                            class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                            alt=""
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/pexels-photo-459470-406x233.jpeg')}}"
                                                    />
                                                </a>
                                            </div>
                                            <div class="article-details">
                                                <h3 class="article-title">
                                                    <a
                                                            href="single-page.html"
                                                            title="China’s phone market is now dominated by five"
                                                    >
                                                        China’s phone market is now dominated by five
                                                    </a>
                                                </h3>
                                                <div class="article-meta-info">
                                                    <div class="bd-alignleft">
                                                                            <span class="meta-author meta-item">
                                                                                <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                            </span>
                                                        <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 6, 2017</span></span>
                                                    </div>
                                                    <div class="bd-alignright">
                                                                            <span class="meta-comment meta-item">
                                                                                <a href="single-page.html">
                                                                                    <span class="fa fa-comments"></span> 0
                                                                                </a>
                                                                            </span>
                                                    </div>
                                                    <div class="cfix"></div>
                                                </div>
                                                <!--/.article-meta-info/-->
                                            </div>
                                        </li>
                                        <li class="articles-box-item article-item-gallery">
                                            <div class="article-thumb kolyoum-blocks-large">
                                                <div class="block-info-cat"><a class="bd-cat-link bd-cat-11" href="category-page.html">Business</a></div>
                                                <a
                                                        href="single-page.html"
                                                        title="Back these dreamy solar lanterns on Kickstarter"
                                                >
                                                    <img
                                                            width="406"
                                                            height="233"
                                                            src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                            class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                            alt=""
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-02-406x233.jpg')}}"
                                                    />
                                                </a>
                                            </div>
                                            <div class="article-details">
                                                <h3 class="article-title">
                                                    <a
                                                            href="single-page.html"
                                                            title="Back these dreamy solar lanterns on Kickstarter"
                                                    >
                                                        Back these dreamy solar lanterns on Kickstarter
                                                    </a>
                                                </h3>
                                                <div class="article-meta-info">
                                                    <div class="bd-alignleft">
                                                                            <span class="meta-author meta-item">
                                                                                <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                            </span>
                                                        <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 5, 2017</span></span>
                                                    </div>
                                                    <div class="bd-alignright">
                                                                            <span class="meta-comment meta-item">
                                                                                <a href="single-page.html">
                                                                                    <span class="fa fa-comments"></span> 2
                                                                                </a>
                                                                            </span>
                                                    </div>
                                                    <div class="cfix"></div>
                                                </div>
                                                <!--/.article-meta-info/-->
                                            </div>
                                        </li>
                                        <li class="articles-box-item article-item-standard">
                                            <div class="article-thumb kolyoum-blocks-large">
                                                <div class="block-info-cat"><a class="bd-cat-link bd-cat-11" href="category-page.html">Business</a></div>
                                                <a
                                                        href="single-page.html"
                                                        title="5 ways to bring your school’s community together your school’s"
                                                >
                                                    <img
                                                            width="406"
                                                            height="233"
                                                            src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                            class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                            alt=""
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-13-406x233.jpg')}}"
                                                    />
                                                </a>
                                            </div>
                                            <div class="article-details">
                                                <h3 class="article-title">
                                                    <a
                                                            href="single-page.html"
                                                            title="5 ways to bring your school’s community together your school’s"
                                                    >
                                                        5 ways to bring your school’s community together your school’s
                                                    </a>
                                                </h3>
                                                <div class="article-meta-info">
                                                    <div class="bd-alignleft">
                                                                            <span class="meta-author meta-item">
                                                                                <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                            </span>
                                                        <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>November 26, 2017</span></span>
                                                    </div>
                                                    <div class="bd-alignright">
                                                                            <span class="meta-comment meta-item">
                                                                                <a href="single-page.html"><span class="fa fa-comments"></span> 0</a>
                                                                            </span>
                                                    </div>
                                                    <div class="cfix"></div>
                                                </div>
                                                <!--/.article-meta-info/-->
                                            </div>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div style="display: none;" class="bd-loading"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            @endif


            <div class="vc_row wpb_row vc_row-fluid">
                <div class="wpb_column vc_column_container vc_col-sm-8">
                    <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                            <div id="articles_box_3" class="content-only half-box articles-box articles-box-block624" style="--blocks-color: #de1400;">
                                <div class="articles-box-container-wrapper">
                                    <div class="articles-box-title articles-box-title-s4">
                                        <h3>Entertainment</h3>
                                    </div>
                                    <!--/.articles-box-title/-->
                                    <div class="articles-box-container">
                                        <div class="articles-box-content">
                                            <ul class="articles-box-items articles-box-list-container clearfix articles-items-1">
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-11" href="category-page.html">Business</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="5 ways to bring your school’s community together your school’s"
                                                        >
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-13-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>November 26, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond"><span class="fa fa-comments"></span> 0</a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="5 ways to bring your school’s community together your school’s"
                                                            >
                                                                5 ways to bring your school’s community together your school’s
                                                            </a>
                                                        </h3>
                                                        <p class="article-excerpt">I recently had the enviable task of reading nearly every story Richard Matheson ever&hellip;</p>
                                                        <a class="article-more-link" href="single-page.html">Read More &raquo;</a>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-small">
                                                        <a href="single-page.html" title="Amazon Echo Devices and Music Unlimited Launched">
                                                            <img
                                                                    width="104"
                                                                    height="74"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                    class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/kaboompics_Resting-with-magazines-and-cup-of-coffee-104x74.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 11, 2017</span></span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Amazon Echo Devices and Music Unlimited Launched"
                                                            >
                                                                Amazon Echo Devices and Music Unlimited Launched
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-small">
                                                        <a
                                                                href="single-page.html"
                                                                title="Apple is accepting donations through iTunes to aid Harvey"
                                                        >
                                                            <img
                                                                    width="104"
                                                                    height="74"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                    class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/juices-min-104x74.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>September 3, 2016</span></span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Apple is accepting donations through iTunes to aid Harvey"
                                                            >
                                                                Apple is accepting donations through iTunes to aid Harvey
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="end_posts"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="articles_box_4" class="content-only half-box second-half-box articles-box articles-box-block624" style="--blocks-color: #de1400;">
                                <div class="articles-box-container-wrapper">
                                    <div class="articles-box-title articles-box-title-s4">
                                        <h3>Technology</h3>
                                    </div>
                                    <!--/.articles-box-title/-->
                                    <div class="articles-box-container">
                                        <div class="articles-box-content">
                                            <ul class="articles-box-items articles-box-list-container clearfix articles-items-1">
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="83"><span>8.3</span></div>
                                                        </div>
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-5" href="category-page.html">Reviews</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="7 influential feminists share the most powerful thing woman"
                                                        >
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/lifesimply-rocks-99706-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>June 6, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html"><span class="fa fa-comments"></span> 0</a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="7 influential feminists share the most powerful thing woman"
                                                            >
                                                                7 influential feminists share the most powerful thing woman
                                                            </a>
                                                        </h3>
                                                        <p class="article-excerpt">[padding right=&#8221;4%&#8221; left=&#8221;4%&#8221;] I recently had the enviable task of reading nearly every story&hellip;</p>
                                                        <a class="article-more-link" href="single-page.html">Read More &raquo;</a>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-video">
                                                    <div class="article-thumb kolyoum-small">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="68"><span>68%</span></div>
                                                        </div>
                                                        <a
                                                                href="single-page.html"
                                                                title="Australia just voted overwheinly favour legalising"
                                                        >
                                                            <img
                                                                    width="104"
                                                                    height="74"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                    class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-11-104x74.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 5, 2017</span></span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Australia just voted overwheinly favour legalising"
                                                            >
                                                                Australia just voted overwheinly favour legalising
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-small">
                                                        <a
                                                                href="single-page.html"
                                                                title="Bragi Dash Pro and The Headphone Truly Wireless"
                                                        >
                                                            <img
                                                                    width="104"
                                                                    height="74"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                    class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/emanuele-pinna-258-104x74.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 11, 2017</span></span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Bragi Dash Pro and The Headphone Truly Wireless"
                                                            >
                                                                Bragi Dash Pro and The Headphone Truly Wireless
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="end_posts"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix half-box-clearfix"></div>
                            <script>
                                var js_articles_box_5 = {
                                    type: "block625",
                                    cat_uids: "bd-business,bd-culture,bd-gadgets,bd-reviews,bd-social-good,bd-sports",
                                    sort_order: "alphabetical_order",
                                    num_posts: "4",
                                    ajax_pagination: "next_prev",
                                    excerpt_length: "14",
                                    title_style: "style3",
                                    filters: "true",
                                    excerpt: "true",
                                    post_meta: "true",
                                    dark: "true",
                                    max_num_pages: 19,
                                };
                            </script>
                            <div id="articles_box_5" class="articles-box-dark articles-box-next_prev articles-box articles-box-block625" data-page="1" style="--blocks-color: #105efb;">
                                <div class="articles-box-container-wrapper">
                                    <div class="articles-box-title articles-box-title-s4">
                                        <h3>What's new</h3>
                                        <div class="articles-box-title-nav">
                                            <ul class="articles-box-title-arrow-nav">
                                                <li>
                                                    <a class="articles-box-title-arrow prev_arrow pagination-disabled" data-type="prev" href="#">
                                                        <span class="fa fa-angle-left"></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="articles-box-title-arrow next_arrow" data-type="next" href="#">
                                                        <span class="fa fa-angle-right"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="articles-box-filter-links-more">
                                                <li>
                                                    <span class="button-more"><span class="bdaia-io bdaia-io-dots-three-horizontal"></span></span>
                                                    <div class="articles-box-filter-links-more-inner"></div>
                                                </li>
                                            </ul>
                                            <ul class="articles-box-filter-links filter_categories">
                                                <li class="active"><a href="#" class="articles-ajax-term" data-id="all">All</a></li>
                                                <li><a href="#11" data-id="bd-business" class="articles-ajax-term">Business</a></li>
                                                <li><a href="#10" data-id="bd-culture" class="articles-ajax-term">Culture</a></li>
                                                <li><a href="#4" data-id="bd-gadgets" class="articles-ajax-term">Gadgets</a></li>
                                                <li><a href="#5" data-id="bd-reviews" class="articles-ajax-term">Reviews</a></li>
                                                <li><a href="#7" data-id="bd-social-good" class="articles-ajax-term">Social Good</a></li>
                                                <li><a href="#8" data-id="bd-sports" class="articles-ajax-term">Sports</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--/.articles-box-title/-->
                                    <div class="articles-box-container">
                                        <div class="articles-box-content">
                                            <ul class="articles-box-items articles-box-list-container clearfix articles-items-1">
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-11" href="category-page.html">Business</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="5 ways to bring your school’s community together your school’s"
                                                        >
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-13-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>November 26, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html"><span class="fa fa-comments"></span> 0</a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="5 ways to bring your school’s community together your school’s"
                                                            >
                                                                5 ways to bring your school’s community together your school’s
                                                            </a>
                                                        </h3>
                                                        <p class="article-excerpt">I recently had the enviable task of reading nearly every story Richard Matheson ever&hellip;</p>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="83"><span>8.3</span></div>
                                                        </div>
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-5" href="category-page.html">Reviews</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="7 influential feminists share the most powerful thing woman"
                                                        >
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/lifesimply-rocks-99706-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>June 6, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html"><span class="fa fa-comments"></span> 0</a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="7 influential feminists share the most powerful thing woman"
                                                            >
                                                                7 influential feminists share the most powerful thing woman
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-8" href="category-page.html">Sports</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="A British store is launching cafes where people can chat"
                                                        >
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/isai-ramos-128261-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 5, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html">
                                                                                <span class="fa fa-comments"></span> 0
                                                                            </a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="A British store is launching cafes where people can chat"
                                                            >
                                                                A British store is launching cafes where people can chat
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-11" href="category-page.html">Business</a></div>
                                                        <a href="single-page.html" title="Amazon Echo Devices and Music Unlimited Launched">
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/kaboompics_Resting-with-magazines-and-cup-of-coffee-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 11, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html">
                                                                                <span class="fa fa-comments"></span> 0
                                                                            </a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Amazon Echo Devices and Music Unlimited Launched"
                                                            >
                                                                Amazon Echo Devices and Music Unlimited Launched
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="display: none;" class="bd-loading"></div>
                                </div>
                            </div>
                            <div id="articles_box_6" class="content-only scrolling-box articles-box articles-box-block645" data-speed="3000" style="--blocks-color: #de1400;">
                                <div class="articles-box-container-wrapper">
                                    <div class="articles-box-title articles-box-title-s4">
                                        <h3>Most Popular</h3>
                                        <div class="articles-box-title-nav"><ul class="articles-box-title-arrow-nav"></ul></div>
                                    </div>
                                    <!--/.articles-box-title/-->
                                    <div class="articles-box-container">
                                        <div class="articles-box-content">
                                            <div class="loader-overlay"><div class="bd-loading"></div></div>
                                            <div class="articles-box-items articles-box-list-container scrolling-slider scrolling-box-slider clearfix">
                                                <div class="slide articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-7" href="http://localhost/kolyoum-html/main/category/bd-social-good/">Social Good</a></div>
                                                        <a href="single-page.html" title="Women are sending Donald Trump bills for their">
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/mario-calvo-1245-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>November 26, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond"><span class="fa fa-comments"></span> 0</a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a href="single-page.html" title="Women are sending Donald Trump bills for their">
                                                                Women are sending Donald Trump bills for their
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="slide articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="83"><span>83%</span></div>
                                                        </div>
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-5" href="category-page.html">Reviews</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="New fund puts $141 million toward digital finance"
                                                        >
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/jenna-day-309593-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>October 13, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond">
                                                                                <span class="fa fa-comments"></span> 0
                                                                            </a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="New fund puts $141 million toward digital finance"
                                                            >
                                                                New fund puts $141 million toward digital finance
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="slide articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-6" href="category-page.html">Photography</a></div>
                                                        <a href="single-page.html" title="Tinder wants you to swipe right on this rhino help">
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/emre-karatas-194355-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>March 21, 2016</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond"><span class="fa fa-comments"></span> 0</a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a href="single-page.html" title="Tinder wants you to swipe right on this rhino help">
                                                                Tinder wants you to swipe right on this rhino help
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="slide articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-4" href="category-page.html">Gadgets</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="Bragi Dash Pro and The Headphone Truly Wireless"
                                                        >
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
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 11, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond">
                                                                                <span class="fa fa-comments"></span> 0
                                                                            </a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Bragi Dash Pro and The Headphone Truly Wireless"
                                                            >
                                                                Bragi Dash Pro and The Headphone Truly Wireless
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="end_posts"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                var js_articles_box_7 = {
                                    type: "block620",
                                    cat_uids: "bd-technology",
                                    sort_order: "review_high",
                                    num_posts: "6",
                                    ajax_pagination: "next_prev",
                                    title_style: "style3",
                                    content_only: "true",
                                    filters: "false",
                                    post_meta: "true",
                                    color: "#de1400",
                                    max_num_pages: 3,
                                };
                            </script>
                            <div id="articles_box_7" class="content-only articles-box-next_prev articles-box articles-box-block620" data-page="1" style="--blocks-color: #de1400;">
                                <div class="articles-box-container-wrapper">
                                    <div class="articles-box-title articles-box-title-s4">
                                        <h3>Technology</h3>
                                        <div class="articles-box-title-nav">
                                            <ul class="articles-box-title-arrow-nav">
                                                <li>
                                                    <a class="articles-box-title-arrow prev_arrow pagination-disabled" data-type="prev" href="#">
                                                        <span class="fa fa-angle-left"></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="articles-box-title-arrow next_arrow" data-type="next" href="#">
                                                        <span class="fa fa-angle-right"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="articles-box-filter-links-more">
                                                <li>
                                                    <span class="button-more"><span class="bdaia-io bdaia-io-dots-three-horizontal"></span></span>
                                                    <div class="articles-box-filter-links-more-inner"></div>
                                                </li>
                                            </ul>
                                            <ul class="articles-box-filter-links filter_categories">
                                                <li class="active"><a href="#" class="articles-ajax-term" data-id="all">All</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--/.articles-box-title/-->
                                    <div class="articles-box-container">
                                        <div class="articles-box-content">
                                            <ul class="articles-box-items articles-box-list-container clearfix articles-items-1">
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb-bg">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="91"><span>91%</span></div>
                                                        </div>
                                                        <a
                                                                class="article-link-thumb-bg"
                                                                href="single-page.html"
                                                                data-src="{{ static_asset('themes/news/frontend/assets/images/demo/aaron-burden-107384-1240x698.jpg')}}"
                                                                title="Sparky Linux 5 : Great All-Purpose Distro"
                                                        ></a>
                                                        <div class="article-overlay">
                                                            <div class="article-overlay-content">
                                                                <div class="block-info-cat"><a class="bd-cat-link bd-cat-5" href="category-page.html">Reviews</a></div>
                                                                <h3 class="article-title">
                                                                    <a
                                                                            href="single-page.html"
                                                                            title="Sparky Linux 5 : Great All-Purpose Distro"
                                                                    >
                                                                        Sparky Linux 5 : Great All-Purpose Distro
                                                                    </a>
                                                                </h3>
                                                                <div class="article-meta-info">
                                                                    <div class="bd-alignleft">
                                                                                <span class="meta-author meta-item">
                                                                                    <a href="author-page.html" class="author-name" title="Amr Sadek">
                                                                                        <span class="fa fa-user-o"></span> Amr Sadek
                                                                                    </a>
                                                                                </span>
                                                                        <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 11, 2017</span></span>
                                                                    </div>
                                                                    <div class="bd-alignright">
                                                                                <span class="meta-comment meta-item">
                                                                                    <a href="single-page.html#respond">
                                                                                        <span class="fa fa-comments"></span> 0
                                                                                    </a>
                                                                                </span>
                                                                    </div>
                                                                    <div class="cfix"></div>
                                                                </div>
                                                                <!--/.article-meta-info/-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-small">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="86"><span>8.6</span></div>
                                                        </div>
                                                        <a
                                                                href="single-page.html"
                                                                title="Going Mainstream: A Real Estate Development In Dubai"
                                                        >
                                                            <img
                                                                    width="104"
                                                                    height="74"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                    class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/annie-spratt-294450-104x74.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 5, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright"></div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Going Mainstream: A Real Estate Development In Dubai"
                                                            >
                                                                Going Mainstream: A Real Estate Development In Dubai
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-small">
                                                        <span class="meta-item article-star-rate" title="THE BREAKDOWN"><span></span></span>
                                                        <a
                                                                href="single-page.html"
                                                                title="This mobile game lets you &#8216;clean up&#8217; plastic pollution"
                                                        >
                                                            <img
                                                                    width="104"
                                                                    height="74"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                    class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/james-bold-304908-104x74.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>November 21, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright"></div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="This mobile game lets you &#8216;clean up&#8217; plastic pollution"
                                                            >
                                                                This mobile game lets you &#8216;clean up&#8217; plastic pollution
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-small">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="83"><span>8.3</span></div>
                                                        </div>
                                                        <a
                                                                href="single-page.html"
                                                                title="7 influential feminists share the most powerful thing woman"
                                                        >
                                                            <img
                                                                    width="104"
                                                                    height="74"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                    class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/lifesimply-rocks-99706-104x74.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>June 6, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright"></div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="7 influential feminists share the most powerful thing woman"
                                                            >
                                                                7 influential feminists share the most powerful thing woman
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-small">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="83"><span>83%</span></div>
                                                        </div>
                                                        <a
                                                                href="single-page.html"
                                                                title="New fund puts $141 million toward digital finance"
                                                        >
                                                            <img
                                                                    width="104"
                                                                    height="74"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                    class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/jenna-day-309593-104x74.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>October 13, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright"></div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="New fund puts $141 million toward digital finance"
                                                            >
                                                                New fund puts $141 million toward digital finance
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-small">
                                                        <span class="meta-item article-star-rate" title="nice!"><span style="width: 83%;"></span></span>
                                                        <a href="single-page.html" title="Leak of Huawei’s Nova 2S shows home button">
                                                            <img
                                                                    width="104"
                                                                    height="74"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty-small.png')}}"
                                                                    class="attachment-kolyoum-small size-kolyoum-small img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/alex-holyoake-285987-104x74.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 8, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright"></div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Leak of Huawei’s Nova 2S shows home button"
                                                            >
                                                                Leak of Huawei’s Nova 2S shows home button
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="display: none;" class="bd-loading"></div>
                                </div>
                            </div>
                            <script>
                                var js_articles_box_8 = {
                                    type: "block602",
                                    cat_uids: "bd-business,bd-culture,bd-recipes,bd-travel",
                                    sort_order: "popular",
                                    num_posts: "5",
                                    ajax_pagination: "next_prev",
                                    excerpt_length: "14",
                                    title_style: "style3",
                                    content_only: "true",
                                    filters: "true",
                                    excerpt: "true",
                                    read_more: "true",
                                    post_meta: "true",
                                    color: "#de1400",
                                    max_num_pages: 11,
                                };
                            </script>
                            <div id="articles_box_8" class="content-only articles-box-next_prev articles-box articles-box-block602" data-page="1" style="--blocks-color: #de1400;">
                                <div class="articles-box-container-wrapper">
                                    <div class="articles-box-title articles-box-title-s4">
                                        <h3>Entertainment</h3>
                                        <div class="articles-box-title-nav">
                                            <ul class="articles-box-title-arrow-nav">
                                                <li>
                                                    <a class="articles-box-title-arrow prev_arrow pagination-disabled" data-type="prev" href="#">
                                                        <span class="fa fa-angle-left"></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="articles-box-title-arrow next_arrow" data-type="next" href="#">
                                                        <span class="fa fa-angle-right"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="articles-box-filter-links-more">
                                                <li>
                                                    <span class="button-more"><span class="bdaia-io bdaia-io-dots-three-horizontal"></span></span>
                                                    <div class="articles-box-filter-links-more-inner"></div>
                                                </li>
                                            </ul>
                                            <ul class="articles-box-filter-links filter_categories">
                                                <li class="active"><a href="#" class="articles-ajax-term" data-id="all">All</a></li>
                                                <li><a href="#11" data-id="bd-business" class="articles-ajax-term">Business</a></li>
                                                <li><a href="#10" data-id="bd-culture" class="articles-ajax-term">Culture</a></li>
                                                <li><a href="#13" data-id="bd-recipes" class="articles-ajax-term">Recipes</a></li>
                                                <li><a href="#12" data-id="bd-travel" class="articles-ajax-term">Travel</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--/.articles-box-title/-->
                                    <div class="articles-box-container">
                                        <div class="articles-box-content">
                                            <ul class="articles-box-items articles-box-list-container clearfix articles-items-1">
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-11" href="category-page.html">Business</a></div>
                                                        <a href="single-page.html" title="China’s phone market is now dominated by five">
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/pexels-photo-459470-406x233.jpeg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 6, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond">
                                                                                <span class="fa fa-comments"></span> 0
                                                                            </a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="China’s phone market is now dominated by five"
                                                            >
                                                                China’s phone market is now dominated by five
                                                            </a>
                                                        </h3>
                                                        <p class="article-excerpt">I recently had the enviable task of reading nearly every story Richard Matheson ever&hellip;</p>
                                                        <a class="article-more-link" href="single-page.html">Read More &raquo;</a>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-gallery">
                                                    <div>
                                                        <div class="article-details">
                                                            <div class="article-meta-info">
                                                                <div class="bd-alignleft">
                                                                    <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 5, 2017</span></span>
                                                                </div>
                                                                <div class="bd-alignright">
                                                                            <span class="meta-comment meta-item">
                                                                                <a href="single-page.html">
                                                                                    <span class="fa fa-comments"></span> 2
                                                                                </a>
                                                                            </span>
                                                                </div>
                                                                <div class="cfix"></div>
                                                            </div>
                                                            <!--/.article-meta-info/-->
                                                            <h3 class="article-title">
                                                                <a
                                                                        href="single-page.html"
                                                                        title="Back these dreamy solar lanterns on Kickstarter"
                                                                >
                                                                    Back these dreamy solar lanterns on Kickstarter
                                                                </a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div>
                                                        <div class="article-details">
                                                            <div class="article-meta-info">
                                                                <div class="bd-alignleft">
                                                                    <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>November 26, 2017</span></span>
                                                                </div>
                                                                <div class="bd-alignright">
                                                                            <span class="meta-comment meta-item">
                                                                                <a href="single-page.html#respond">
                                                                                    <span class="fa fa-comments"></span> 0
                                                                                </a>
                                                                            </span>
                                                                </div>
                                                                <div class="cfix"></div>
                                                            </div>
                                                            <!--/.article-meta-info/-->
                                                            <h3 class="article-title">
                                                                <a
                                                                        href="single-page.html"
                                                                        title="5 ways to bring your school’s community together your school’s"
                                                                >
                                                                    5 ways to bring your school’s community together your school’s
                                                                </a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div>
                                                        <div class="article-details">
                                                            <div class="article-meta-info">
                                                                <div class="bd-alignleft">
                                                                    <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 5, 2017</span></span>
                                                                </div>
                                                                <div class="bd-alignright">
                                                                            <span class="meta-comment meta-item">
                                                                                <a href="single-page.html"><span class="fa fa-comments"></span> 0</a>
                                                                            </span>
                                                                </div>
                                                                <div class="cfix"></div>
                                                            </div>
                                                            <!--/.article-meta-info/-->
                                                            <h3 class="article-title">
                                                                <a href="single-page.html" title="Pepsi autopsy: How the brand got its commercial">
                                                                    Pepsi autopsy: How the brand got its commercial
                                                                </a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div>
                                                        <div class="article-details">
                                                            <div class="article-meta-info">
                                                                <div class="bd-alignleft">
                                                                    <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>November 22, 2017</span></span>
                                                                </div>
                                                                <div class="bd-alignright">
                                                                            <span class="meta-comment meta-item">
                                                                                <a href="single-page.html"><span class="fa fa-comments"></span> 5</a>
                                                                            </span>
                                                                </div>
                                                                <div class="cfix"></div>
                                                            </div>
                                                            <!--/.article-meta-info/-->
                                                            <h3 class="article-title">
                                                                <a href="single-page.html" title="Facebook&#8217;s fundraisers now help you raise money">
                                                                    Facebook&#8217;s fundraisers now help you raise money
                                                                </a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="display: none;" class="bd-loading"></div>
                                </div>
                            </div>
                            <div class="clear">

                            </div>
                        </div>
                    </div>
                </div>
                @include('frontend.partials.first_sidebar',['partials_container'=>$home_page_first_sidebar])
            </div>

            <section id="i618-3654" class="grid-3_articles cover-grid618 cover-title-style4 slider-area cover-grid" data-grid-id="i618">
                <div class="cover-wrapper">
                    <div class="loader-overlay"><div class="bd-loading"></div></div>
                    <div class="bd-container">
                        <ul class="bd-grid-nav"></ul>
                        <div class="cover-inner">
                            <article class="cover-item cover-story story-count-1 story-id-150 article-item-gallery" data-story-id="150">
                                <div class="lazy-bg story-inner">
                                    <img
                                            data-lazy="{{ static_asset('themes/news/frontend/assets/images/demo/img-02-616x482.jpg')}}"
                                            src="{{ static_asset('themes/news/frontend/assets/images/no-thumbnail.svg')}}"
                                            alt=""
                                    />
                                    <div class="story-bg"></div>
                                    <a
                                            class="cover-trigger"
                                            href="single-page.html"
                                            title="Back these dreamy solar lanterns on Kickstarter"
                                    ></a>
                                    <!-- .cover-trigger -->
                                    <div class="cover-overlay">
                                        <div class="cover-overlay-inner">
                                            <div class="cover-overlay-content">
                                                <div class="cover-overlay-content-in">
                                                    <h3 class="cover-overlay-title">
                                                        <a
                                                                href="single-page.html"
                                                                title="Back these dreamy solar lanterns on Kickstarter"
                                                        >
                                                            Back these dreamy solar lanterns on Kickstarter
                                                        </a>
                                                    </h3>
                                                    <div class="article-meta-info">
                                                        <div class="bd-alignleft">
                                                                                    <span class="meta-author meta-item">
                                                                                        <a href="author-page.html" class="author-name" title="Amr Sadek">
                                                                                            <span class="fa fa-user-o"></span> Amr Sadek
                                                                                        </a>
                                                                                    </span>
                                                            <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 5, 2017</span></span>
                                                        </div>
                                                        <div class="cfix"></div>
                                                    </div>
                                                    <!--/.article-meta-info/-->
                                                </div>
                                                <!-- .cover-overlay-content-in -->
                                            </div>
                                            <!-- .cover-overlay-content -->
                                        </div>
                                        <!-- .cover-overlay-inner -->
                                    </div>
                                    <!-- .cover-overlay -->
                                </div>
                                <!-- .story-inner -->
                            </article>
                            <article class="cover-item cover-story story-count-2 story-id-33 article-item-standard" data-story-id="33">
                                <div class="lazy-bg story-inner">
                                    <img
                                            data-lazy="{{ static_asset('themes/news/frontend/assets/images/demo/img-08-616x482.jpg')}}"
                                            src="{{ static_asset('themes/news/frontend/assets/images/no-thumbnail.svg')}}"
                                            alt=""
                                    />
                                    <div class="story-bg"></div>
                                    <a
                                            class="cover-trigger"
                                            href="single-page.html"
                                            title="YouTube debuts inspiring Pride Month video to highlight"
                                    ></a>
                                    <!-- .cover-trigger -->
                                    <div class="cover-overlay">
                                        <div class="cover-overlay-inner">
                                            <div class="cover-overlay-content">
                                                <div class="cover-overlay-content-in">
                                                    <h3 class="cover-overlay-title">
                                                        <a
                                                                href="single-page.html"
                                                                title="YouTube debuts inspiring Pride Month video to highlight"
                                                        >
                                                            YouTube debuts inspiring Pride Month video to highlight
                                                        </a>
                                                    </h3>
                                                    <div class="article-meta-info">
                                                        <div class="bd-alignleft">
                                                                                    <span class="meta-author meta-item">
                                                                                        <a href="author-page.html" class="author-name" title="Amr Sadek">
                                                                                            <span class="fa fa-user-o"></span> Amr Sadek
                                                                                        </a>
                                                                                    </span>
                                                            <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>March 2, 2016</span></span>
                                                        </div>
                                                        <div class="cfix"></div>
                                                    </div>
                                                    <!--/.article-meta-info/-->
                                                </div>
                                                <!-- .cover-overlay-content-in -->
                                            </div>
                                            <!-- .cover-overlay-content -->
                                        </div>
                                        <!-- .cover-overlay-inner -->
                                    </div>
                                    <!-- .cover-overlay -->
                                </div>
                                <!-- .story-inner -->
                            </article>
                            <article class="cover-item cover-story story-count-3 story-id-35 article-item-standard" data-story-id="35">
                                <div class="lazy-bg story-inner">
                                    <img
                                            data-lazy="{{ static_asset('themes/news/frontend/assets/images/demo/img-10-616x482.jpg')}}"
                                            src="{{ static_asset('themes/news/frontend/assets/images/no-thumbnail.svg')}}"
                                            alt=""
                                    />
                                    <div class="story-bg"></div>
                                    <a
                                            class="cover-trigger"
                                            href="single-page.html"
                                            title="These period-friendly boxers help trans men look good"
                                    ></a>
                                    <!-- .cover-trigger -->
                                    <div class="cover-overlay">
                                        <div class="cover-overlay-inner">
                                            <div class="cover-overlay-content">
                                                <div class="cover-overlay-content-in">
                                                    <h3 class="cover-overlay-title">
                                                        <a
                                                                href="single-page.html"
                                                                title="These period-friendly boxers help trans men look good"
                                                        >
                                                            These period-friendly boxers help trans men look good
                                                        </a>
                                                    </h3>
                                                    <div class="article-meta-info">
                                                        <div class="bd-alignleft">
                                                                                    <span class="meta-author meta-item">
                                                                                        <a href="author-page.html" class="author-name" title="Amr Sadek">
                                                                                            <span class="fa fa-user-o"></span> Amr Sadek
                                                                                        </a>
                                                                                    </span>
                                                            <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>November 21, 2017</span></span>
                                                        </div>
                                                        <div class="cfix"></div>
                                                    </div>
                                                    <!--/.article-meta-info/-->
                                                </div>
                                                <!-- .cover-overlay-content-in -->
                                            </div>
                                            <!-- .cover-overlay-content -->
                                        </div>
                                        <!-- .cover-overlay-inner -->
                                    </div>
                                    <!-- .cover-overlay -->
                                </div>
                                <!-- .story-inner -->
                            </article>
                        </div>
                        <!-- .cover-inner -->
                    </div>
                    <!-- .bd-container -->
                </div>
                <!-- .cover-wrapper -->
            </section>
            <!-- .slider-area -->
            <div class="clear"></div>

            <div class="vc_row wpb_row vc_row-fluid">
                <div class="wpb_column vc_column_container vc_col-sm-8">
                    <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                            <script>
                                var js_articles_box_10 = {
                                    type: "block614",
                                    cat_uids: "bd-business,bd-culture,bd-entertainment,bd-gadgets,bd-photography,bd-recipes,bd-reviews,bd-sports,bd-technology,bd-travel",
                                    num_posts: "4",
                                    ajax_pagination: "load_more",
                                    title_style: "style10",
                                    content_only: "true",
                                    post_meta: "true",
                                    color: "#de1400",
                                    max_num_pages: 26,
                                };
                            </script>
                            <div id="articles_box_10" class="content-only articles-box-load_more articles-box articles-box-block614" data-page="1" style="--blocks-color: #de1400;">
                                <div class="articles-box-container-wrapper">
                                    <div class="articles-box-title articles-box-title-s11">
                                        <h3>Latest Articles</h3>
                                        <div class="articles-box-title-nav"></div>
                                    </div>
                                    <!--/.articles-box-title/-->
                                    <div class="articles-box-container">
                                        <div class="articles-box-content">
                                            <ul class="articles-box-items articles-box-list-container clearfix articles-items-1">
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-12" href="category-page.html">Travel</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="ClassPass will let you live stream fitness classes"
                                                        >
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-04-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="ClassPass will let you live stream fitness classes"
                                                            >
                                                                ClassPass will let you live stream fitness classes
                                                            </a>
                                                        </h3>
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 18, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond">
                                                                                <span class="fa fa-comments"></span> 0
                                                                            </a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-4" href="category-page.html">Gadgets</a></div>
                                                        <a href="single-page.html" title="Oppo Given Green Clearance to Set Up Manufacturing">
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
                                                    <div class="article-details">
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Oppo Given Green Clearance to Set Up Manufacturing"
                                                            >
                                                                Oppo Given Green Clearance to Set Up Manufacturing
                                                            </a>
                                                        </h3>
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 12, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond"><span class="fa fa-comments"></span> 0</a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-4" href="category-page.html">Gadgets</a></div>
                                                        <a href="single-page.html" title="Facebook Testing Greetings Feature to Give Poke">
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/david-marcu-5437-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Facebook Testing Greetings Feature to Give Poke"
                                                            >
                                                                Facebook Testing Greetings Feature to Give Poke
                                                            </a>
                                                        </h3>
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 12, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond">
                                                                                <span class="fa fa-comments"></span> 0
                                                                            </a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-13" href="category-page.html">Recipes</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="Tom Kerridge&#8217;s spiced orange cake with plum sauce"
                                                        >
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/luke-chesser-48-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Tom Kerridge&#8217;s spiced orange cake with plum sauce"
                                                            >
                                                                Tom Kerridge&#8217;s spiced orange cake with plum sauce
                                                            </a>
                                                        </h3>
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                                <span class="date meta-item"><span class="bdaia-io bdaia-io-clock"></span> <span>December 12, 2017</span></span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond">
                                                                                <span class="fa fa-comments"></span> 0
                                                                            </a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="articles-box-load-more">
                                        <div class="clearfix"></div>
                                        <div style="display: none;" class="bd-loading bd-loading-small"></div>
                                        <a class="load-more-btn more-btn" data-type="load_more" data-text="Load More">Load More</a>
                                    </div>
                                </div>
                            </div>
                            <script>
                                var js_articles_box_11 = {
                                    type: "block644",
                                    cat_uids: "bd-reviews",
                                    sort_order: "popular",
                                    num_posts: "4",
                                    ajax_pagination: "load_more",
                                    excerpt_length: "21",
                                    title_style: "style10",
                                    content_only: "true",
                                    excerpt: "true",
                                    post_meta: "true",
                                    color: "#de1400",
                                    max_num_pages: 3,
                                };
                            </script>
                            <div id="articles_box_11" class="content-only articles-box-load_more articles-box articles-box-block644" data-page="1" style="--blocks-color: #de1400;">
                                <div class="articles-box-container-wrapper">
                                    <div class="articles-box-title articles-box-title-s11">
                                        <h3>Trending Reviews</h3>
                                        <div class="articles-box-title-nav"></div>
                                    </div>
                                    <!--/.articles-box-title/-->
                                    <div class="articles-box-container">
                                        <div class="articles-box-content">
                                            <ul class="articles-box-items articles-box-list-container clearfix articles-items-1">
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="year-month"><span>Dec</span> <span> 2017</span></div>
                                                    <div class="day-month"><span>11 December</span></div>
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="91"><span>91%</span></div>
                                                        </div>
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-5" href="category-page.html">Reviews</a></div>
                                                        <a href="single-page.html" title="Sparky Linux 5 : Great All-Purpose Distro">
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/aaron-burden-107384-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html">
                                                                                <span class="fa fa-comments"></span> 0
                                                                            </a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Sparky Linux 5 : Great All-Purpose Distro"
                                                            >
                                                                Sparky Linux 5 : Great All-Purpose Distro
                                                            </a>
                                                        </h3>
                                                        <p class="article-excerpt">I recently had the enviable task of reading nearly every story Richard Matheson ever &hellip;</p>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="year-month"><span>Jun</span> <span> 2017</span></div>
                                                    <div class="day-month"><span>6 June</span></div>
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="83"><span>8.3</span></div>
                                                        </div>
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-5" href="category-page.html">Reviews</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="7 influential feminists share the most powerful thing woman"
                                                        >
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/lifesimply-rocks-99706-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond"><span class="fa fa-comments"></span> 0</a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="7 influential feminists share the most powerful thing woman"
                                                            >
                                                                7 influential feminists share the most powerful thing woman
                                                            </a>
                                                        </h3>
                                                        <p class="article-excerpt">[padding right=&#8221;4%&#8221; left=&#8221;4%&#8221;] I recently had the enviable task of reading nearly every story &hellip;</p>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="year-month"><span>Nov</span> <span> 2017</span></div>
                                                    <div class="day-month"><span>26 November</span></div>
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="80"><span>80%</span></div>
                                                        </div>
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-5" href="category-page.html">Reviews</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="Salesforce launches $50 million initiative to fuel"
                                                        >
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/hannah-wei-84051-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html">
                                                                                <span class="fa fa-comments"></span> 0
                                                                            </a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="Salesforce launches $50 million initiative to fuel"
                                                            >
                                                                Salesforce launches $50 million initiative to fuel
                                                            </a>
                                                        </h3>
                                                        <p class="article-excerpt">I recently had the enviable task of reading nearly every story Richard Matheson ever &hellip;</p>
                                                    </div>
                                                </li>
                                                <li class="articles-box-item article-item-standard">
                                                    <div class="year-month"><span>Oct</span> <span> 2017</span></div>
                                                    <div class="day-month"><span>13 October</span></div>
                                                    <div class="article-thumb kolyoum-blocks-large">
                                                        <div class="rating-percentages">
                                                            <div class="rating-percentages-inner" data-rate-val="83"><span>83%</span></div>
                                                        </div>
                                                        <div class="block-info-cat"><a class="bd-cat-link bd-cat-5" href="category-page.html">Reviews</a></div>
                                                        <a
                                                                href="single-page.html"
                                                                title="New fund puts $141 million toward digital finance"
                                                        >
                                                            <img
                                                                    width="406"
                                                                    height="233"
                                                                    src="{{ static_asset('themes/news/frontend/assets/images/img-empty.png')}}"
                                                                    class="attachment-kolyoum-blocks-large size-kolyoum-blocks-large img-lazy wp-post-image"
                                                                    alt=""
                                                                    data-src="{{ static_asset('themes/news/frontend/assets/images/demo/jenna-day-309593-406x233.jpg')}}"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="article-meta-info">
                                                            <div class="bd-alignleft">
                                                                        <span class="meta-author meta-item">
                                                                            <a href="author-page.html" class="author-name" title="Amr Sadek"><span class="fa fa-user-o"></span> Amr Sadek</a>
                                                                        </span>
                                                            </div>
                                                            <div class="bd-alignright">
                                                                        <span class="meta-comment meta-item">
                                                                            <a href="single-page.html#respond">
                                                                                <span class="fa fa-comments"></span> 0
                                                                            </a>
                                                                        </span>
                                                            </div>
                                                            <div class="cfix"></div>
                                                        </div>
                                                        <!--/.article-meta-info/-->
                                                        <h3 class="article-title">
                                                            <a
                                                                    href="single-page.html"
                                                                    title="New fund puts $141 million toward digital finance"
                                                            >
                                                                New fund puts $141 million toward digital finance
                                                            </a>
                                                        </h3>
                                                        <p class="article-excerpt">[padding right=&#8221;4%&#8221; left=&#8221;4%&#8221;] I recently had the enviable task of reading nearly every story &hellip;</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="articles-box-load-more">
                                        <div class="clearfix"></div>
                                        <div style="display: none;" class="bd-loading bd-loading-small"></div>
                                        <a class="load-more-btn more-btn" data-type="load_more" data-text="Load More">Load More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('frontend.partials.second_sidebar')
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection
