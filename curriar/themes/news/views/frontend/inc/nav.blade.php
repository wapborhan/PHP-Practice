<div class="header-wrapper header__light">
    @if(setting()->get('news_topbar_show_'.app()->getLocale()))
        <div class="clearfix"></div>
        <div class="topbar topbar-gradient">
            <div class="bd-container">
                <div class="top-left-area">
                    @if(setting()->get('news_topbar_date_'.app()->getLocale()))
                        <span class="bdaia-current-time"> November 05, 2020</span>
                    @endif
                    @if(setting()->get('news_topbar_trending_'.app()->getLocale()))
                        <div class="breaking-news-items">
                            <span class="breaking-title">Trending Now</span>
                            <div class="breaking-cont">
                                <ul class="webticker">
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;Australia just voted overwheinly favour legali...
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;China’s phone market is now dominated by five...
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;Back these dreamy solar lanterns on Kickstarte...
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;5 ways to bring your school’s community togeth...
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;Pepsi autopsy: How the brand got its commercia...
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;Why heterosexuals are so obsessed with height ...
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;Facebook&#8217;s fundraisers now help you rais...
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;California judge dismisses lawsuit that claims...
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;Sparky Linux 5 : Great All-Purpose Distro...
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;7 influential feminists share the most powerfu...
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;Twitter is incorrectly guessing the gender of ...
                                            </a>
                                        </h4>
                                    </li>
                                    <li>
                                        <h4>
                                            <a href="single-page.html" rel="bookmark">
                                                <span style="display: none;" class="bdaia-io bdaia-io-chevron_right"></span>
                                                &nbsp;&nbsp;&nbsp;This browser extension makes you a more ethica...
                                            </a>
                                        </h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                @if(setting()->get('news_topbar_social_links_'.app()->getLocale()))
                    <div class="top-right-area">
                        <div class="bdaia-social-io bdaia-social-io-size-32">
                            <a class="bdaia-io-url-facebook" title="Facebook" href="#" target="_blank"><span class="bdaia-io bdaia-io-facebook"></span></a>
                            <a class="bdaia-io-url-twitter" title="Twitter" href="#" target="_blank"><span class="bdaia-io bdaia-io-twitter"></span></a>
                            <a class="bdaia-io-url-google-plus" title="Google+" href="#" target="_blank"><span class="bdaia-io bdaia-io-googleplus"></span></a>
                            <a class="bdaia-io-url-dribbble" title="Dribbble" href="#" target="_blank"><span class="bdaia-io bdaia-io-dribbble"></span></a>
                            <a class="bdaia-io-url-youtube" title="Youtube" href="#" target="_blank"><span class="bdaia-io bdaia-io-youtube"></span></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="clearfix"></div>
    <header class="header-container">
        <div class="bd-container">
            <div class="logo site--logo">
                <h1 class="site-title">
                    <a href="homepage.html" rel="home" title="Kolyoum">
                        <img src="{{ static_asset('themes/news/frontend/assets/images/logo/default.svg')}}" alt="Kolyoum" />
                    </a>
                </h1>
            </div>
            @if(setting()->get('news_topbar_logo_'.app()->getLocale()))
                <div class="bdaia-header-e3-desktop">
                    <div class="bdaia-e3-container">
                        {{-- 'themes/news/frontend/assets/images/demo/a1456.jpg' --}}
                        <a href="https://themeforest.net/item/i/19703399&utm_source=demos&utm_campaign=kolyoum&utm_content=main&utm_medium=srticle" target="_blank">
                            <img style="max-width: 728px;" src="{{ asset('/storage/app/public/'.setting()->get('news_topbar_logo_'.app()->getLocale()))}}" alt="" width="728" />
                        </a>
                    </div>
                </div>
            @endif
            <div class="bdaia-push-menu bd-mob-menu-btn">
                <span class="bdaia-io bdaia-io-mobile"></span>
            </div>
        </div>
        <div class="bd-bg" style="box-shadow: none !important; -webkit-box-shadow: none !important; -moz-box-shadow: none !important;"></div>
    </header>
    <div class="navigation-outer">
        <nav id="navigation" class="fixed-enabled nav-boxed mainnav-dark dropdown-light">
            <div class="navigation-wrapper">
                <div class="bd-container">
                    <div class="navigation-inner">
                        <div class="primary-menu">
                            <ul id="menu-primary" class="menu" role="menubar">
                                <li class="nav-logo menu-item">
                                    <a title="Kolyoum" href="homepage.html">
                                        <img src="{{ static_asset('themes/news/frontend/assets/images/demo/nav-sticky-logo-white.svg')}}" width="195" height="48" alt="Kolyoum" />
                                    </a>
                                </li>
                                <li
                                        id="menu-item-7"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-has-children menu-parent-item menu-item--parent bd_depth- bd_menu_item fa-icon"
                                >
                                    <a href="homepage.html" class="current-menu-item"> <i class="fa fa fa-home"></i> <span class="menu-label" style="display: none;">Home</span></a>
                                    <ul class="bd_none sub-menu">
                                        <li id="menu-item-1277" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                            <a target="_blank" href="home-page-1.html"> <span class="menu-label" style="">Home Page &#8211; 1</span></a>
                                        </li>
                                        <li id="menu-item-1294" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                            <a target="_blank" href="home-page-2.html"> <span class="menu-label" style="">Home Page &#8211; 2</span></a>
                                        </li>
                                        <li id="menu-item-1302" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                            <a target="_blank" href="home-page-3.html"> <span class="menu-label" style="">Home Page &#8211; 3</span></a>
                                        </li>
                                        <li id="menu-item-1317" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                            <a target="_blank" href="home-page-4.html"> <span class="menu-label" style="">Home Page &#8211; 4</span></a>
                                        </li>
                                        <li id="menu-item-1327" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                            <a target="_blank" href="home-page-5.html"> <span class="menu-label" style="">Home Page &#8211; 5</span></a>
                                        </li>
                                        <li id="menu-item-1252" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                            <a target="_blank" href="home-page-6.html"> <span class="menu-label" style="">Home Page &#8211; 6</span></a>
                                        </li>
                                    </ul>
                                    <div class="mega-menu-content"></div>
                                </li>
                                <li id="menu-item-396" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-parent-item menu-item--parent bd_depth- bd_cats_menu">
                                    <a href="category-page.html"> <span class="menu-label" style="">Entertainment</span></a>
                                    <div class="sub_cats_posts cats-mega-wrap">
                                        <ul class="bd_cats sub-menu">
                                            <li id="menu-item-397" class="menu-item menu-item-type-taxonomy menu-item-object-category bd_depth-">
                                                <a href="category-page.html"> <span class="menu-label" style="">Business</span></a>
                                            </li>
                                            <li id="menu-item-398" class="menu-item menu-item-type-taxonomy menu-item-object-category bd_depth-">
                                                <a href="category-page.html"> <span class="menu-label" style="">Culture</span></a>
                                            </li>
                                            <li id="menu-item-399" class="menu-item menu-item-type-taxonomy menu-item-object-category bd_depth-">
                                                <a href="category-page.html"> <span class="menu-label" style="">Recipes</span></a>
                                            </li>
                                            <li id="menu-item-400" class="menu-item menu-item-type-taxonomy menu-item-object-category bd_depth-">
                                                <a href="category-page.html"> <span class="menu-label" style="">Travel</span></a>
                                            </li>
                                        </ul>
                                        <div class="mega-menu-content">
                                            <div class="mega-cat-wrapper">
                                                <div class="mega-cat-sub-categories">
                                                    <ul class="mega-cat-sub-categories">
                                                        <li><a href="category-page.html" id="#mega-cat-396-11">Business</a></li>
                                                        <li><a href="category-page.html" id="#mega-cat-396-10">Culture</a></li>
                                                        <li><a href="category-page.html" id="#mega-cat-396-13">Recipes</a></li>
                                                        <li><a href="category-page.html" id="#mega-cat-396-12">Travel</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mega-cat-content mega-cat-sub-exists">
                                                    <div id="mega-cat-396-11" class="mega-cat-content-tab">
                                                        <div class="mega-cat-content-tab-inner">
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Amazon Echo Devices and Music Unlimited Launched"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/kaboompics_Resting-with-magazines-and-cup-of-coffee-845x475.jpg')}}"
                                                            title="Amazon Echo Devices and Music Unlimited Launched"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Amazon Echo Devices and Music Unlimited Launched"
                                                                        >
                                                                            Amazon Echo Devices and Music Unlimited Launched
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Google India&#8217;s New &#8216;Posts&#8217; Feature Lets Verified Users"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/pexels-photo-128193-845x475.jpeg')}}"
                                                            title="Google India&#8217;s New &#8216;Posts&#8217; Feature Lets Verified Users"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Google India&#8217;s New &#8216;Posts&#8217; Feature Lets Verified Users"
                                                                        >
                                                                            Google India&#8217;s New &#8216;Posts&#8217; Feature Lets Verified Users
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="China’s phone market is now dominated by five"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/pexels-photo-459470-845x475.jpeg')}}"
                                                            title="China’s phone market is now dominated by five"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="China’s phone market is now dominated by five"
                                                                        >
                                                                            China’s phone market is now dominated by five
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Bitcoin and Other Cryptocurrencies the Next"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/bitcoin-845x475.jpg')}}"
                                                            title="Bitcoin and Other Cryptocurrencies the Next"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Bitcoin and Other Cryptocurrencies the Next"
                                                                        >
                                                                            Bitcoin and Other Cryptocurrencies the Next
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="mega-cat-396-10" class="mega-cat-content-tab">
                                                        <div class="mega-cat-content-tab-inner">
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Leak of Huawei’s Nova 2S shows home button"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/pexels-photo-709815-845x475.jpeg')}}"
                                                            title="Leak of Huawei’s Nova 2S shows home button"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Leak of Huawei’s Nova 2S shows home button"
                                                                        >
                                                                            Leak of Huawei’s Nova 2S shows home button
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="The Return of Industrial Espionage the Building"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/pexels-photo-179767-845x475.jpeg')}}"
                                                            title="The Return of Industrial Espionage the Building"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="The Return of Industrial Espionage the Building"
                                                                        >
                                                                            The Return of Industrial Espionage the Building
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Honor&#8217;s new smartphone has an AI processor"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/pexels-photo-236516-845x475.jpeg')}}"
                                                            title="Honor&#8217;s new smartphone has an AI processor"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Honor&#8217;s new smartphone has an AI processor"
                                                                        >
                                                                            Honor&#8217;s new smartphone has an AI processor
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Before-and-after satellite images show massive"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/pexels-photo-276114-845x475.jpeg')}}"
                                                            title="Before-and-after satellite images show massive"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Before-and-after satellite images show massive"
                                                                        >
                                                                            Before-and-after satellite images show massive
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="mega-cat-396-13" class="mega-cat-content-tab">
                                                        <div class="mega-cat-content-tab-inner">
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Tom Kerridge&#8217;s spiced orange cake with plum sauce"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/luke-chesser-48-845x475.jpg')}}"
                                                            title="Tom Kerridge&#8217;s spiced orange cake with plum sauce"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Tom Kerridge&#8217;s spiced orange cake with plum sauce"
                                                                        >
                                                                            Tom Kerridge&#8217;s spiced orange cake with plum sauce
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Pulled Not-Pork Vegan Jackfruit with Slaw, Avocado"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/ds77-845x475.jpg')}}"
                                                            title="Pulled Not-Pork Vegan Jackfruit with Slaw, Avocado"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Pulled Not-Pork Vegan Jackfruit with Slaw, Avocado"
                                                                        >
                                                                            Pulled Not-Pork Vegan Jackfruit with Slaw, Avocado
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Individual Mediterranean Savoury Muffin Roasts with Olives"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/kaboompics_Fruit-market-with-various-colorful-fresh-fruits-845x475.jpg')}}"
                                                            title="Individual Mediterranean Savoury Muffin Roasts with Olives"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Individual Mediterranean Savoury Muffin Roasts with Olives"
                                                                        >
                                                                            Individual Mediterranean Savoury Muffin Roasts with Olives
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Fritter with Braised Fennel, Roast Butternut Squash, White"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/kaboompics_Picnic-at-the-lakeshore-1-845x475.jpg')}}"
                                                            title="Fritter with Braised Fennel, Roast Butternut Squash, White"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Fritter with Braised Fennel, Roast Butternut Squash, White"
                                                                        >
                                                                            Fritter with Braised Fennel, Roast Butternut Squash, White
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="mega-cat-396-12" class="mega-cat-content-tab">
                                                        <div class="mega-cat-content-tab-inner">
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="ClassPass will let you live stream fitness classes"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/img-04-845x475.jpg')}}"
                                                            title="ClassPass will let you live stream fitness classes"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="ClassPass will let you live stream fitness classes"
                                                                        >
                                                                            ClassPass will let you live stream fitness classes
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="In The World Of Technology, You Are Only As Good"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/boat-houses-hdr-water-615312-845x475.jpeg')}}"
                                                            title="In The World Of Technology, You Are Only As Good"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a href="single-page.html" title="In The World Of Technology, You Are Only As Good">
                                                                            In The World Of Technology, You Are Only As Good
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Quentin Tarantino&#8217;s Star Trek movie is literally"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/pexels-photo-374710-845x475.jpeg')}}"
                                                            title="Quentin Tarantino&#8217;s Star Trek movie is literally"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Quentin Tarantino&#8217;s Star Trek movie is literally"
                                                                        >
                                                                            Quentin Tarantino&#8217;s Star Trek movie is literally
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Stuff your stockings with these affordable wireless"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/pexels-photo-208761-845x475.jpeg')}}"
                                                            title="Stuff your stockings with these affordable wireless"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Stuff your stockings with these affordable wireless"
                                                                        >
                                                                            Stuff your stockings with these affordable wireless
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li id="menu-item-401" class="menu-item menu-item-type-taxonomy menu-item-object-category bd_depth- bd_cats_menu">
                                    <a href="category-page.html"> <span class="menu-label" style="">Category Page</span></a>
                                    <div class="sub_cats_posts cats-mega-wrap">
                                        <div class="mega-menu-content">
                                            <div class="mega-cat-wrapper">
                                                <div class="mega-cat-content">
                                                    <div id="mega-cat-401-7" class="mega-cat-content-tab">
                                                        <div class="mega-cat-content-tab-inner">
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="DeepMind’s AI became a superhuman chess player hours"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/5967680771_8aa66f6894_b-845x475.jpg')}}"
                                                            title="DeepMind’s AI became a superhuman chess player hours"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="DeepMind’s AI became a superhuman chess player hours"
                                                                        >
                                                                            DeepMind’s AI became a superhuman chess player hours
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Nearly Half of Your Hourly Employees Are Ready"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/8385430971_e12d2f3b45_k-845x475.jpg')}}"
                                                            title="Nearly Half of Your Hourly Employees Are Ready"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Nearly Half of Your Hourly Employees Are Ready"
                                                                        >
                                                                            Nearly Half of Your Hourly Employees Are Ready
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Tesla is a hotbed for racist behavior, class-action lawsuit"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/23689910963_8646b74d67_k-845x475.jpg')}}"
                                                            title="Tesla is a hotbed for racist behavior, class-action lawsuit"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Tesla is a hotbed for racist behavior, class-action lawsuit"
                                                                        >
                                                                            Tesla is a hotbed for racist behavior, class-action lawsuit
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="This entertaining Alexa skill inspires kids to give back"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/14816417565_43eceaabae_k-845x475.jpg')}}"
                                                            title="This entertaining Alexa skill inspires kids to give back"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="This entertaining Alexa skill inspires kids to give back"
                                                                        >
                                                                            This entertaining Alexa skill inspires kids to give back
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="bd-block-mega-menu-post">
                                                                <div class="bd-block-mega-menu-thumb">
                                                                    <a
                                                                            href="single-page.html"
                                                                            rel="bookmark"
                                                                            title="Twitter is incorrectly guessing the gender of trans"
                                                                    >
                                                    <span
                                                            class="mm-img"
                                                            data-src="{{ static_asset('themes/news/frontend/assets/images/demo/sun-shining-through-the-iconic-san-francisco-cable-car-picjumbo-com-1240x540-845x475.jpg')}}"
                                                            title="Twitter is incorrectly guessing the gender of trans"
                                                    ></span>
                                                                    </a>
                                                                </div>
                                                                <div class="bd-block-mega-menu-details">
                                                                    <h4 class="entry-title">
                                                                        <a
                                                                                href="single-page.html"
                                                                                title="Twitter is incorrectly guessing the gender of trans"
                                                                        >
                                                                            Twitter is incorrectly guessing the gender of trans
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li id="menu-item-1745" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-parent-item menu-item--parent bd_depth- bd_menu_item">
                                    <a href="#"> <span class="menu-label" style="">Features</span></a>
                                    <ul class="bd_none sub-menu">
                                        <li id="menu-item-632" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-parent-item menu-item--parent bd_depth-">
                                            <a href="#"> <span class="menu-label" style="">Content Blocks</span></a>
                                            <ul class="bd_none sub-menu">
                                                <li id="menu-item-636" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-1.html"> <span class="menu-label" style="">Block 1</span></a>
                                                </li>
                                                <li id="menu-item-639" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-2.html"> <span class="menu-label" style="">Block 2</span></a>
                                                </li>
                                                <li id="menu-item-643" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-3.html"> <span class="menu-label" style="">Block 3</span></a>
                                                </li>
                                                <li id="menu-item-646" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-4.html"> <span class="menu-label" style="">Block 4</span></a>
                                                </li>
                                                <li id="menu-item-649" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-5.html"> <span class="menu-label" style="">Block 5</span></a>
                                                </li>
                                                <li id="menu-item-652" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-6.html"> <span class="menu-label" style="">Block 6</span></a>
                                                </li>
                                                <li id="menu-item-655" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-7.html"> <span class="menu-label" style="">Block 7</span></a>
                                                </li>
                                                <li id="menu-item-658" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-8.html"> <span class="menu-label" style="">Block 8</span></a>
                                                </li>
                                                <li id="menu-item-661" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-9.html"> <span class="menu-label" style="">Block 9</span></a>
                                                </li>
                                                <li id="menu-item-664" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-10.html"> <span class="menu-label" style="">Block 10</span></a>
                                                </li>
                                                <li id="menu-item-667" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-11.html"> <span class="menu-label" style="">Block 11</span></a>
                                                </li>
                                                <li id="menu-item-670" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-12.html"> <span class="menu-label" style="">Block 12</span></a>
                                                </li>
                                                <li id="menu-item-673" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-13.html"> <span class="menu-label" style="">Block 13</span></a>
                                                </li>
                                                <li id="menu-item-676" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-14.html"> <span class="menu-label" style="">Block 14</span></a>
                                                </li>
                                                <li id="menu-item-679" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-15.html"> <span class="menu-label" style="">Block 15</span></a>
                                                </li>
                                                <li id="menu-item-682" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-16.html"> <span class="menu-label" style="">Block 16</span></a>
                                                </li>
                                                <li id="menu-item-685" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-17.html"> <span class="menu-label" style="">Block 17</span></a>
                                                </li>
                                                <li id="menu-item-688" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-18.html"> <span class="menu-label" style="">Block 18</span></a>
                                                </li>
                                                <li id="menu-item-691" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-19.html"> <span class="menu-label" style="">Block 19</span></a>
                                                </li>
                                                <li id="menu-item-694" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-20.html"> <span class="menu-label" style="">Block 20</span></a>
                                                </li>
                                                <li id="menu-item-703" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-21.html"> <span class="menu-label" style="">Block 21</span></a>
                                                </li>
                                                <li id="menu-item-706" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-22.html"> <span class="menu-label" style="">Block 22</span></a>
                                                </li>
                                                <li id="menu-item-713" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-23.html"> <span class="menu-label" style="">Block 23</span></a>
                                                </li>
                                                <li id="menu-item-712" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-24.html"> <span class="menu-label" style="">Block 24</span></a>
                                                </li>
                                                <li id="menu-item-716" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-25.html"> <span class="menu-label" style="">Block 25</span></a>
                                                </li>
                                                <li id="menu-item-719" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-26.html"> <span class="menu-label" style="">Block 26</span></a>
                                                </li>
                                                <li id="menu-item-722" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-27.html"> <span class="menu-label" style="">Block 27</span></a>
                                                </li>
                                                <li id="menu-item-725" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-28.html"> <span class="menu-label" style="">Block 28</span></a>
                                                </li>
                                                <li id="menu-item-728" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-29.html"> <span class="menu-label" style="">Block 29</span></a>
                                                </li>
                                                <li id="menu-item-737" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-30.html"> <span class="menu-label" style="">Block 30</span></a>
                                                </li>
                                                <li id="menu-item-736" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-31.html"> <span class="menu-label" style="">Block 31</span></a>
                                                </li>
                                                <li id="menu-item-735" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-32.html"> <span class="menu-label" style="">Block 32</span></a>
                                                </li>
                                                <li id="menu-item-740" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-33.html"> <span class="menu-label" style="">Block 33</span></a>
                                                </li>
                                                <li id="menu-item-743" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-34.html"> <span class="menu-label" style="">Block 34</span></a>
                                                </li>
                                                <li id="menu-item-746" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-35.html"> <span class="menu-label" style="">Block 35</span></a>
                                                </li>
                                                <li id="menu-item-749" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-36.html"> <span class="menu-label" style="">Block 36</span></a>
                                                </li>
                                                <li id="menu-item-752" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-37.html"> <span class="menu-label" style="">Block 37</span></a>
                                                </li>
                                                <li id="menu-item-755" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-38.html"> <span class="menu-label" style="">Block 38</span></a>
                                                </li>
                                                <li id="menu-item-758" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-39.html"> <span class="menu-label" style="">Block 39</span></a>
                                                </li>
                                                <li id="menu-item-761" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-40.html"> <span class="menu-label" style="">Block 40</span></a>
                                                </li>
                                                <li id="menu-item-764" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-41.html"> <span class="menu-label" style="">Block 41</span></a>
                                                </li>
                                                <li id="menu-item-768" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-42.html"> <span class="menu-label" style="">Block 42</span></a>
                                                </li>
                                                <li id="menu-item-771" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-43.html"> <span class="menu-label" style="">Block 43</span></a>
                                                </li>
                                                <li id="menu-item-774" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-44.html"> <span class="menu-label" style="">Block 44</span></a>
                                                </li>
                                                <li id="menu-item-777" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-45.html"> <span class="menu-label" style="">Block 45</span></a>
                                                </li>
                                                <li id="menu-item-1221" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="block-sliders.html"> <span class="menu-label" style="">Sliders</span></a>
                                                </li>
                                                <li id="menu-item-1235" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="blocks-more.html"> <span class="menu-label" style="">More</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-783" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-parent-item menu-item--parent bd_depth-">
                                            <a href="#"> <span class="menu-label" style="">Grid &#038; Sliders</span></a>
                                            <ul class="bd_none sub-menu">
                                                <li id="menu-item-786" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-1.html"> <span class="menu-label" style="">Grid 1</span></a>
                                                </li>
                                                <li id="menu-item-789" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-2.html"> <span class="menu-label" style="">Grid 2</span></a>
                                                </li>
                                                <li id="menu-item-804" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-3.html"> <span class="menu-label" style="">Grid 3</span></a>
                                                </li>
                                                <li id="menu-item-803" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-4.html"> <span class="menu-label" style="">Grid 4</span></a>
                                                </li>
                                                <li id="menu-item-802" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-5.html"> <span class="menu-label" style="">Grid 5</span></a>
                                                </li>
                                                <li id="menu-item-801" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-6.html"> <span class="menu-label" style="">Grid 6</span></a>
                                                </li>
                                                <li id="menu-item-800" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-7.html"> <span class="menu-label" style="">Grid 7</span></a>
                                                </li>
                                                <li id="menu-item-814" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-8.html"> <span class="menu-label" style="">Grid 8</span></a>
                                                </li>
                                                <li id="menu-item-813" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-9.html"> <span class="menu-label" style="">Grid 9</span></a>
                                                </li>
                                                <li id="menu-item-812" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-10.html"> <span class="menu-label" style="">Grid 10</span></a>
                                                </li>
                                                <li id="menu-item-1427" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-11.html"> <span class="menu-label" style="">Grid 11</span></a>
                                                </li>
                                                <li id="menu-item-826" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-12.html"> <span class="menu-label" style="">Grid 12</span></a>
                                                </li>
                                                <li id="menu-item-825" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-13.html"> <span class="menu-label" style="">Grid 13</span></a>
                                                </li>
                                                <li id="menu-item-824" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-14.html"> <span class="menu-label" style="">Grid 14</span></a>
                                                </li>
                                                <li id="menu-item-830" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-15.html"> <span class="menu-label" style="">Grid 15</span></a>
                                                </li>
                                                <li id="menu-item-833" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-16.html"> <span class="menu-label" style="">Grid 16</span></a>
                                                </li>
                                                <li id="menu-item-839" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-17.html"> <span class="menu-label" style="">Grid 17</span></a>
                                                </li>
                                                <li id="menu-item-838" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-18.html"> <span class="menu-label" style="">Grid 18</span></a>
                                                </li>
                                                <li id="menu-item-842" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-19.html"> <span class="menu-label" style="">Grid 19</span></a>
                                                </li>
                                                <li id="menu-item-845" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="grid-20.html"> <span class="menu-label" style="">Grid 20</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-1000" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-parent-item menu-item--parent bd_depth-">
                                            <a href="#"> <span class="menu-label" style="">Posts Layouts</span></a>
                                            <ul class="bd_none sub-menu">
                                                <li id="menu-item-1015" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">Post Style 0</span></a>
                                                </li>
                                                <li id="menu-item-1011" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">Post Style 1</span></a>
                                                </li>
                                                <li id="menu-item-1025" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">Post Style #1</span></a>
                                                </li>
                                                <li id="menu-item-1014" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html">
                                                        <span class="menu-label" style="">Post Style 2</span>
                                                    </a>
                                                </li>
                                                <li id="menu-item-1022" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html">
                                                        <span class="menu-label" style="">Post Style 3</span>
                                                    </a>
                                                </li>
                                                <li id="menu-item-1018" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">Post Style 4</span></a>
                                                </li>
                                                <li id="menu-item-1016" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html">
                                                        <span class="menu-label" style="">Post Style 5</span>
                                                    </a>
                                                </li>
                                                <li id="menu-item-1021" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">Post Style 6</span></a>
                                                </li>
                                                <li id="menu-item-1023" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">Post Style 7</span></a>
                                                </li>
                                                <li id="menu-item-1019" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html">
                                                        <span class="menu-label" style="">Post Style 8</span>
                                                    </a>
                                                </li>
                                                <li id="menu-item-1020" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">Post Style 9</span></a>
                                                </li>
                                                <li id="menu-item-1013" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">Post Style 10</span></a>
                                                </li>
                                                <li id="menu-item-1024" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html">
                                                        <span class="menu-label" style="">Post Style #10</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-992" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-parent-item menu-item--parent bd_depth-">
                                            <a href="#"> <span class="menu-label" style="">Posts Formats</span></a>
                                            <ul class="bd_none sub-menu">
                                                <li id="menu-item-998" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html">
                                                        <i class="fa fa fa-file-image-o"></i> <span class="menu-label" style="">Image</span>
                                                    </a>
                                                </li>
                                                <li id="menu-item-994" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html">
                                                        <i class="fa fa fa-picture-o"></i> <span class="menu-label" style="">Slider</span>
                                                    </a>
                                                </li>
                                                <li id="menu-item-995" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html">
                                                        <i class="fa fa fa-camera"></i> <span class="menu-label" style="">Gallery Grid</span>
                                                    </a>
                                                </li>
                                                <li id="menu-item-993" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html">
                                                        <i class="fa fa fa-youtube-play"></i> <span class="menu-label" style="">Video</span>
                                                    </a>
                                                </li>
                                                <li id="menu-item-999" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html">
                                                        <i class="fa fa fa-file-code-o"></i> <span class="menu-label" style="">Embed Code</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-1335" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-parent-item menu-item--parent bd_depth-">
                                            <a href="#"> <span class="menu-label" style="">Widgets</span></a>
                                            <ul class="bd_none sub-menu">
                                                <li id="menu-item-1340" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="widget-posts.html"> <span class="menu-label" style="">Widget – Posts</span></a>
                                                </li>
                                                <li id="menu-item-1344" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="widget-more.html"> <span class="menu-label" style="">Widget – More</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-846" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-parent-item menu-item--parent bd_depth-">
                                            <a href="#"> <span class="menu-label" style="">Sidebars</span></a>
                                            <ul class="bd_none sub-menu">
                                                <li id="menu-item-848" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">Sidebar Left</span></a>
                                                </li>
                                                <li id="menu-item-852" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">Sidebar Right</span></a>
                                                </li>
                                                <li id="menu-item-850" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">One Column</span></a>
                                                </li>
                                                <li id="menu-item-855" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html">
                                                        <span class="menu-label" style="">No Sidebar</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-1345" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-parent-item menu-item--parent bd_depth-">
                                            <a href="#"> <span class="menu-label" style="">Pages</span></a>
                                            <ul class="bd_none sub-menu">
                                                <li id="menu-item-1348" class="menu-item menu-item-type-custom menu-item-object-custom bd_depth-">
                                                    <a href="archive-page.html"> <span class="menu-label" style="">Archive</span></a>
                                                </li>
                                                <li id="menu-item-1349" class="menu-item menu-item-type-post_type menu-item-object-post bd_depth-">
                                                    <a href="single-page.html"> <span class="menu-label" style="">Comments</span></a>
                                                </li>
                                                <li id="menu-item-1351" class="menu-item menu-item-type-custom menu-item-object-custom bd_depth-">
                                                    <a href="author-page.html"> <span class="menu-label" style="">Author</span></a>
                                                </li>
                                                <li id="menu-item-1353" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="shop-page.php"> <span class="menu-label" style="">WooCommerce</span></a>
                                                </li>
                                                <li id="menu-item-1352" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                                    <a href="blog.html"> <span class="menu-label" style="">Blog</span></a>
                                                </li>
                                                <li id="menu-item-1350" class="menu-item menu-item-type-custom menu-item-object-custom bd_depth-">
                                                    <a href="tage-page.html"> <span class="menu-label" style="">Tags</span></a>
                                                </li>
                                                <li id="menu-item-1347" class="menu-item menu-item-type-custom menu-item-object-custom bd_depth-">
                                                    <a href="search-page.html"> <span class="menu-label" style="">Search Page</span></a>
                                                </li>
                                                <li id="menu-item-1346" class="menu-item menu-item-type-custom menu-item-object-custom bd_depth-">
                                                    <a href="404-page.html"> <span class="menu-label" style="">Page 404</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-1393" class="menu-item menu-item-type-custom menu-item-object-custom bd_depth-">
                                            <a href="amp-page.html"> <span class="menu-label" style="">AMP with customization</span></a>
                                        </li>
                                        <li id="menu-item-1391" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth-">
                                            <a href="shortcodes.html"> <span class="menu-label" style="">Shortcodes</span></a>
                                        </li>
                                    </ul>
                                    <div class="mega-menu-content"></div>
                                </li>
                                <li id="menu-item-629" class="menu-item menu-item-type-post_type menu-item-object-page bd_depth- bd_menu_item">
                                    <a target="_blank" href="shop-page.html"> <span class="menu-label" style="">Shop</span></a>
                                    <div class="mega-menu-content"></div>
                                </li>
                            </ul>
                            <div class="cfix"></div>
                        </div>
                        <ul class="nav-components bd-components">
                            <li class="bd-alert-posts components-item">
                        <span class="bdaia-alert-new-posts">
                        <span class="n">21</span>
                        <span class="t">
                        <small>New</small>
                        <small>Articles</small>
                        </span>
                        </span>
                                <div class="bdaia-alert-new-posts-content components-sub-menu">
                                    <div class="bdaia-alert-new-posts-inner">
                                        <div class="bdaia-anp-inner">
                                            <ul>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 18, 2017</span>
                                                        <span class="tit">ClassPass will let you live stream fitness classes</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 12, 2017</span>
                                                        <span class="tit">Oppo Given Green Clearance to Set Up Manufacturing</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 12, 2017</span>
                                                        <span class="tit">Facebook Testing Greetings Feature to Give Poke</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 12, 2017</span>
                                                        <span class="tit">Tom Kerridge&#8217;s spiced orange cake with plum sauce</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 11, 2017</span>
                                                        <span class="tit">Pulled Not-Pork Vegan Jackfruit with Slaw, Avocado</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 11, 2017</span>
                                                        <span class="tit">Individual Mediterranean Savoury Muffin Roasts with Olives</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 11, 2017</span>
                                                        <span class="tit">Fritter with Braised Fennel, Roast Butternut Squash, White</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 11, 2017</span>
                                                        <span class="tit">Pearl Cous-Cous Crumble with Mixed Pepper Dressing</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 11, 2017</span>
                                                        <span class="tit">Polenta (Cornmeal) Slices with Roasted Peppers &#038; Basil</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 11, 2017</span>
                                                        <span class="tit">Amazon Echo Devices and Music Unlimited Launched</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 11, 2017</span>
                                                        <span class="tit">Google India&#8217;s New &#8216;Posts&#8217; Feature Lets Verified Users</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 11, 2017</span>
                                                        <span class="tit">Bragi Dash Pro and The Headphone Truly Wireless</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 11, 2017</span>
                                                        <span class="tit">Sparky Linux 5 : Great All-Purpose Distro</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 8, 2017</span>
                                                        <span class="tit">Leak of Huawei’s Nova 2S shows home button</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 8, 2017</span>
                                                        <span class="tit">Critics are suddenly grilling Wendy’s Twitter</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 8, 2017</span>
                                                        <span class="tit">Oculus now lets you access the Windows desktop</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 8, 2017</span>
                                                        <span class="tit">Google and Amazon are punishing their own</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 8, 2017</span>
                                                        <span class="tit">DeepMind’s AI became a superhuman chess</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 8, 2017</span>
                                                        <span class="tit">Leak of Huawei’s Nova 2S shows home button</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 6, 2017</span>
                                                        <span class="tit">Major Players Roll Up Sleeves to Solve Open</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-page.html">
                                                        <span class="ti">December 6, 2017</span>
                                                        <span class="tit">The Return of Industrial Espionage the Building</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </li>
                            <li class="bd-search-bar components-item">
                                <span class="bdaia-ns-btn bdaia-io bdaia-io-ion-ios-search-strong"></span>
                                <div class="bdaia-ns-wrap components-sub-menu">
                                    <div class="bdaia-ns-content">
                                        <div class="bdaia-ns-inner">
                                            <form method="get" id="searchform" action="">
                                                <input
                                                        type="text"
                                                        class="bbd-search-field search-live"
                                                        id="s"
                                                        name="s"
                                                        value="Search"
                                                        onfocus="if (this.value == 'Search') {this.value = '';}"
                                                        onblur="if (this.value == '') {this.value = 'Search';}"
                                                />
                                                <button type="submit" class="bbd-search-btn"><span class="bdaia-io bdaia-io-ion-ios-search-strong"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="bdaia-push-menu components-item">
                                <span class="bdaia-io bdaia-io-mobile"></span>
                            </li>
                            <li class="bd-randpost components-item">
                                <a href="?randpost=1"><span class="bdaia-io bdaia-io-ion-ios-shuffle-strong"></span></a>
                            </li>
                            <li class="bd-ccart components-item">
                                <a href="cart-page.html">
                        <span class="shooping-count-outer">
                        <span class="shooping-count pulse">4</span>
                        <span class="fa fa-shopping-bag"></span>
                        </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="bd-bg" style="background: none !important; box-shadow: none !important; -webkit-box-shadow: none !important; -moz-box-shadow: none !important;"></div>
        </nav>
    </div>
    <div class="cfix"></div>
    <div class="cfix"></div>
</div>