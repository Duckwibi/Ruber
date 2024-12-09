@extends("Customer.Layout")

@section("TemplateStyle")
<link rel="stylesheet" href="/Customer/libs/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/feather-font/css/iconfont.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/icomoon-font/css/icomoon.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/font-awesome/css/font-awesome.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/wpbingofont/css/wpbingofont.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/elegant-icons/css/elegant.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/slick/css/slick.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/slick/css/slick-theme.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/mmenu/css/mmenu.min.css" type="text/css">
<link rel="stylesheet" href="/Customer/libs/slider/css/jslider.css">
@endsection

@section("Style")

@endsection

@section("Content")
<div id="site-main" class="site-main">
    <div id="main-content" class="main-content">
        <div id="primary" class="content-area">
            <div id="title" class="page-title">
                <div class="section-container">
                    <div class="content-title-heading">
                        <h1 class="text-title-heading">
                            Home Decor
                        </h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="index-2.html">Home</a><span class="delimiter"></span>Home Decor
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-12 col-12 sidebar left-sidebar md-b-50">
                                <!-- Block Post Search -->
                                <div class="block block-post-search">
                                    <div class="block-title">
                                        <h2>Search</h2>
                                    </div>
                                    <div class="block-content">
                                        <form method="get" class="search-from" action="#">
                                            <input type="text" value="" name="s" class="s" placeholder="Search...">
                                            <button class="btn" type="submit">
                                                <i class="icon-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Block Post Categories -->
                                <div class="block block-post-cats">
                                    <div class="block-title">
                                        <h2>Categories</h2>
                                    </div>
                                    <div class="block-content">
                                        <div class="post-cats-list">
                                            <ul>
                                                <li class="current">
                                                    <a href="blog-grid-left.html">Dining & Kitchen <span
                                                            class="count">9</span></a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Furniture <span
                                                            class="count">4</span></a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Home Décor <span
                                                            class="count">3</span></a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Life Style <span
                                                            class="count">6</span></a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Office <span
                                                            class="count">2</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Block Posts -->
                                <div class="block block-posts">
                                    <div class="block-title">
                                        <h2>Recent Posts</h2>
                                    </div>
                                    <div class="block-content">
                                        <ul class="posts-list">
                                            <li class="post-item">
                                                <a href="blog-details-right.html" class="post-image">
                                                    <img src="/Customer/media/blog/1.jpg">
                                                </a>
                                                <div class="post-content">
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">
                                                            Easy Fixes for Home Decor
                                                        </a>
                                                    </h2>
                                                    <div class="post-time">
                                                        <span class="post-date">May 30, 2022</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="post-item">
                                                <a href="blog-details-right.html" class="post-image">
                                                    <img src="/Customer/media/blog/2.jpg">
                                                </a>
                                                <div class="post-content">
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">
                                                            How to Make your Home a Showplace
                                                        </a>
                                                    </h2>
                                                    <div class="post-time">
                                                        <span class="post-date">Aug 24, 2022</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="post-item">
                                                <a href="blog-details-right.html" class="post-image">
                                                    <img src="/Customer/media/blog/3.jpg">
                                                </a>
                                                <div class="post-content">
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">
                                                            Stunning Furniture with Aesthetic Appeal
                                                        </a>
                                                    </h2>
                                                    <div class="post-time">
                                                        <span class="post-date">Dec 06, 2022</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Block Post Archives -->
                                <div class="block block-post-archives">
                                    <div class="block-title">
                                        <h2>Archives</h2>
                                    </div>
                                    <div class="block-content">
                                        <div class="post-archives-list">
                                            <ul>
                                                <li>
                                                    <a href="blog-grid-left.html">May 2021</a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">April 2021</a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">August 2020</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Block Post Tags -->
                                <div class="block block-post-tags">
                                    <div class="block-title">
                                        <h2>Tags</h2>
                                    </div>
                                    <div class="block-content">
                                        <div class="post-tags-list">
                                            <ul>
                                                <li>
                                                    <a href="blog-grid-left.html">Baber</a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Baby Needs</a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Beauty</a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Cosmetic</a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Electric</a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Fashion</a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Mimimal</a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Simple</a>
                                                </li>
                                                <li>
                                                    <a href="blog-grid-left.html">Sport</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-9 col-lg-9 col-md-12 col-12">
                                <div class="posts-list grid">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="post-entry clearfix post-wapper">
                                                <div class="post-image">
                                                    <a href="blog-details-right.html">
                                                        <img src="/Customer/media/blog/1.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <div class="post-categories">
                                                        <a href="blog-grid-right.html">Furniture</a>
                                                    </div>
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">Easy Fixes for Home Decor</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-time">July 24, 2021</span>
                                                        <span class="post-comment">1 Comment</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="post-entry clearfix post-wapper">
                                                <div class="post-image">
                                                    <a href="blog-details-right.html">
                                                        <img src="/Customer/media/blog/2.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <div class="post-categories">
                                                        <a href="blog-grid-right.html">Home Decor</a>
                                                    </div>
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">How to Make your Home a
                                                            Showplace</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-time">August 16, 2021</span>
                                                        <span class="post-comment">4 Comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="post-entry clearfix post-wapper">
                                                <div class="post-image">
                                                    <a href="blog-details-right.html">
                                                        <img src="/Customer/media/blog/3.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <div class="post-categories">
                                                        <a href="blog-grid-right.html">Life Style</a>
                                                    </div>
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">Stunning Furniture with
                                                            Aesthetic Appeal</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-time">October 04, 2021</span>
                                                        <span class="post-comment">3 Comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="post-entry clearfix post-wapper">
                                                <div class="post-image">
                                                    <a href="blog-details-right.html">
                                                        <img src="/Customer/media/blog/4.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <div class="post-categories">
                                                        <a href="blog-grid-right.html">Dining & Kitchen</a>
                                                    </div>
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">How To Choose The Right
                                                            Sectional Sofa</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-time">October 20, 2021</span>
                                                        <span class="post-comment">1 Comment</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="post-entry clearfix post-wapper">
                                                <div class="post-image">
                                                    <a href="blog-details-right.html">
                                                        <img src="/Customer/media/blog/5.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <div class="post-categories">
                                                        <a href="blog-grid-right.html">Office</a>
                                                    </div>
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">How to Make your Home a
                                                            Showplace</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-time">December 11, 2021</span>
                                                        <span class="post-comment">5 Comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="post-entry clearfix post-wapper">
                                                <div class="post-image">
                                                    <a href="blog-details-right.html">
                                                        <img src="/Customer/media/blog/6.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <div class="post-categories">
                                                        <a href="blog-grid-right.html">Life Style</a>
                                                    </div>
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">Easy Fixes for Home Decor</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-time">February 07, 2022</span>
                                                        <span class="post-comment">2 Comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="post-entry clearfix post-wapper">
                                                <div class="post-image">
                                                    <a href="blog-details-right.html">
                                                        <img src="/Customer/media/blog/7.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <div class="post-categories">
                                                        <a href="blog-grid-right.html">Dining & Kitchen</a>
                                                    </div>
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">Easy Fixes for Home Decor</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-time">July 24, 2021</span>
                                                        <span class="post-comment">3 Comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="post-entry clearfix post-wapper">
                                                <div class="post-image">
                                                    <a href="blog-details-right.html">
                                                        <img src="/Customer/media/blog/3.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <div class="post-categories">
                                                        <a href="blog-grid-right.html">Furniture</a>
                                                    </div>
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">Easy Fixes for Home Decor</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-time">July 24, 2021</span>
                                                        <span class="post-comment">1 Comment</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="post-entry clearfix post-wapper">
                                                <div class="post-image">
                                                    <a href="blog-details-right.html">
                                                        <img src="/Customer/media/blog/4.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <div class="post-categories">
                                                        <a href="blog-grid-right.html">Life Style</a>
                                                    </div>
                                                    <h2 class="post-title">
                                                        <a href="blog-details-right.html">How To Choose The Right
                                                            Sectional Sofa</a>
                                                    </h2>
                                                    <div class="post-meta">
                                                        <span class="post-time">July 24, 2021</span>
                                                        <span class="post-comment">5 Comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <nav class="pagination">
                                    <ul class="page-numbers">
                                        <li><a class="prev page-numbers" href="#">Previous</a></li>
                                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                                        <li><a class="page-numbers" href="#">2</a></li>
                                        <li><a class="page-numbers" href="#">3</a></li>
                                        <li><a class="next page-numbers" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div><!-- #main-content -->
</div>
@endsection

@section("TemplateScript")
<script src="/Customer/libs/popper/js/popper.min.js"></script>
<script src="/Customer/libs/jquery/js/jquery.min.js"></script>
<script src="/Customer/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/Customer/libs/slick/js/slick.min.js"></script>
<script src="/Customer/libs/countdown/js/jquery.countdown.min.js"></script>
<script src="/Customer/libs/mmenu/js/jquery.mmenu.all.min.js"></script>
<script src="/Customer/libs/slider/js/tmpl.js"></script>
<script src="/Customer/libs/slider/js/jquery.dependClass-0.1.js"></script>
<script src="/Customer/libs/slider/js/draggable-0.1.js"></script>
<script src="/Customer/libs/slider/js/jquery.slider.js"></script>
@endsection

@section("Script")

@endsection