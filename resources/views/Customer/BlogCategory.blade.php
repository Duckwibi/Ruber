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
                        <h1 class="text-title-heading">{{ $blogCategory->name }}</h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="index-2.html">Home</a><span class="delimiter"></span>{{ $blogCategory->name }}
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="row">
                            
                            @php
                                $id = $blogCategory->id;
                            @endphp
                            <x-customer.blog-sidebar 
                                :id="$id"
                                :titleLike="$titleLike"
                                :archiveId="$archiveId"
                                :tagId="$tagId">
                            </x-customer.blog-sidebar>

                            <div class="col-xl-9 col-lg-9 col-md-12 col-12">
                                <div class="posts-list grid">
                                    <div class="row">
                                        @foreach($blogs as $blog)
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                <div class="post-entry clearfix post-wapper">
                                                    <div class="post-image">
                                                        <a href="/Customer/Blog/BlogDetailPage?id={{ $blog->id }}">
                                                            <img src="{{ $blog->image }}" alt="{{ $blog->image }}">
                                                        </a>
                                                    </div>
                                                    <div class="post-content">
                                                        <div class="post-categories">
                                                            <a href="/Customer/Blog/BlogCategoryPage?id={{ $blog->blogCategory->id }}">{{ $blog->blogCategory->name }}</a>
                                                        </div>
                                                        <h2 class="post-title">
                                                            <a href="/Customer/Blog/BlogDetailPage?id={{ $blog->id }}">{{ $blog->title }}</a>
                                                        </h2>
                                                        <div class="post-meta">
                                                            <span class="post-time">{{ date("M d, Y", strtotime($blog->createdDate)) }}</span>
                                                            <span class="post-comment">
                                                                {{ $blog->blog_comments_count }}
                                                                {{ $blog->blog_comments_count <= 1 ? "comment" : "comments" }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                @php
                                    $url = "/Customer/Blog/BlogCategoryPage?id=" . $blogCategory->id;
                                    $url .= isset($titleLike) ? "&titleLike=" . urlencode($titleLike) : "";
                                    $url .= isset($archiveId) ? "&archiveId=" . $archiveId : "";
                                    $url .= isset($tagId) ? "&tagId=" . $tagId : "";
                                @endphp
                                <nav class="pagination">
                                    <ul class="page-numbers">
                                        @if($currentPage > 1)
                                            @php
                                                $urlPreviousPage = $url . "&currentPage=" . ($currentPage - 1);
                                            @endphp
                                            <li><a class="prev page-numbers" href="{{ $urlPreviousPage }}">Previous</a></li>
                                        @endif

                                        <li><span aria-current="page" class="page-numbers current">{{ $currentPage }}</span></li>

                                        @php
                                            $pageRenderCount = 0;
                                            $savePageRender = $currentPage;
                                        @endphp
                                        @for($i = $currentPage + 1; $i <= $page; $i++)
                                            @php
                                                $urlToPage = $url . "&currentPage=" . $i;
                                                $pageRenderCount++;
                                                $savePageRender = $i;
                                            @endphp
                                            <li><a class="page-numbers" href="{{ $urlToPage }}">{{ $i }}</a></li>
                                            @if($pageRenderCount == 2)
                                                @break
                                            @endif
                                        @endfor
                                        
                                        @if($savePageRender < $page)
                                            @if($savePageRender < $page - 1)
                                                @php
                                                    $urlNextFromSavePageRender = $url . "&currentPage=" . ($savePageRender + 1);
                                                @endphp
                                                <li><a class="page-numbers" href="{{ $urlNextFromSavePageRender }}">...</a></li>
                                            @endif
                                            
                                            @php
                                                $urlNextToMaxPage = $url . "&currentPage=" . $page;
                                            @endphp
                                            <li><a class="page-numbers" href="{{ $urlNextToMaxPage }}">{{ $page }}</a></li>
                                        @endif

                                        @if($currentPage < $page)
                                            @php
                                                $urlNextPage = $url . "&currentPage=" . ($currentPage + 1);
                                            @endphp
                                            <li><a class="next page-numbers" href="{{ $urlNextPage }}">Next</a></li>
                                        @endif
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