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
                            {{ $blog->title }}
                        </h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="/Customer/Home/IndexPage">Home</a><span class="delimiter"></span>{{ $blog->title }}
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="row">

                            @php
                                $blogCategoryId = $blog->blogCategoryId;
                                $titleLike = null;
                                $archiveId = null;
                                $tagId = null;
                            @endphp
                            <x-customer.blog-sidebar 
                                :id="$blogCategoryId"
                                :titleLike="$titleLike"
                                :archiveId="$archiveId"
                                :tagId="$tagId">
                            </x-customer.blog-sidebar>

                            <div class="col-xl-9 col-lg-9 col-md-12 col-12 md-b-30 blog-details-content">
                                <div class="post-details">
                                    <div class="post-image">
                                        <img src="{{ $blog->image }}" alt="{{ $blog->image }}">
                                    </div>
                                    <h2 class="post-title">{{ $blog->title }}</h2>
                                    <div class="post-meta">
                                        <span class="post-categories">
                                            <i class="icon_folder-alt"></i> 
                                            <a href="blog-grid-right.html">{{ $blog->blogCategory->name }}</a>
                                        </span>
                                        <span class="post-time">
                                            <i class="icon_clock_alt"></i>
                                            {{ date("M d, Y", strtotime($blog->createdDate)) }}
                                        </span>
                                        <span class="post-comment commentCount_blogId_{{ $blog->id }}_type_2">
                                            <i class="icon_comment_alt"></i>
                                            {{ $blog->blog_comments_count }}
                                            {{ $blog->blog_comments_count <= 1 ? "comment" : "comments" }}
                                        </span>
                                    </div>
                                    <div class="post-content clearfix">{{ $blog->content }}</div>
                                    <div class="post-content-entry">
                                        <div class="tags-links">
                                            <label>Tags :</label>
                                            @foreach($blog->tags as $tag)
                                                <a href="/Customer/Blog/BlogCategoryPage?id={{ $blogCategoryId }}&tagId={{ $tag->id }}" rel="tag">{{ $tag->name }}</a>
                                            @endforeach
                                        </div>
                                        <div class="entry-social-share">
                                            <label>Share :</label>
                                            <div class="social-share">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}" title="Facebook" class="share-facebook" target="_blank">
                                                    <i class="fa fa-facebook"></i>Facebook
                                                </a>
                                                <a href="https://twitter.com/intent/tweet?url={{ url()->full() }}&text=" title="Twitter" class="share-twitter">
                                                    <i class="fa fa-twitter"></i>Twitter
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($previousBlog) || isset($nextBlog))
                                        <div class="prev-next-post">
                                            @if(isset($previousBlog))
                                                <div class="previous-post">
                                                    <a href="/Customer/Blog/BlogDetailPage?id={{ $previousBlog->id }}" rel="prev">
                                                        <div class="hover-extend active"><span>Previous</span></div>
                                                        <h2 class="title">{{ $previousBlog->title }}</h2>
                                                    </a>
                                                </div>
                                            @endif
                                        
                                            @if(isset($nextBlog))
                                                <div class="next-post">
                                                    <a href="/Customer/Blog/BlogDetailPage?id={{ $nextBlog->id }}" rel="next">
                                                        <div class="hover-extend active"><span>Next</span></div>
                                                        <h2 class="title">{{ $nextBlog->title }}</h2>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <div id="comments" class="comments-area">
                                        <h3 class="comments-title commentCount_blogId_{{ $blog->id }}_type_3">
                                            {{ $blog->blog_comments_count }}
                                            {{ $blog->blog_comments_count <= 1 ? "comment" : "comments" }}
                                        </h3>
                                        <div class="comments-list blogComments">
                                            @foreach($blog->blogComments as $blogComment)
                                                <div class="comment-item">
                                                    <div class="comment-content-wrap">
                                                        <div class="comment-author">
                                                            {{ $blogComment->customer->name }}
                                                        </div>
                                                        <div class="comment-time">
                                                            {{ date("M d, Y", strtotime($blogComment->createdDate)) }}
                                                        </div>
                                                        <div class="comment-content">
                                                            <p>{{ $blogComment->content }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="comment-form">
                                            <div class="form-header">
                                                <h3>Leave a Reply</h3>
                                            </div>
                                            <form onsubmit="return false;" class="row" novalidate="">
                                                <div class="comment-notes col-md-12 col-sm-12">Your email address will not be published.</div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Comment" class="form-control commentContent"></textarea>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <input id="author" placeholder="Your Name *" 
                                                        name="author" type="text" 
                                                        value="{{ isset($currentUser) ? $currentUser->name : "" }}" size="30"
                                                        class="form-control" readonly>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <input id="email" placeholder="Your Email *" 
                                                    name="email" type="text" 
                                                    value="{{ isset($currentUser) ? $currentUser->email : "" }}" size="30"
                                                    class="form-control" readonly>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input name="submit" type="submit" id="submit" class="btn button-outline commentSubmit" value="Post Comment">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
<!-- <script src="/Customer/libs/jquery/js/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="/Customer/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/Customer/libs/slick/js/slick.min.js"></script>
<script src="/Customer/libs/countdown/js/jquery.countdown.min.js"></script>
<script src="/Customer/libs/mmenu/js/jquery.mmenu.all.min.js"></script>
<script src="/Customer/libs/slider/js/tmpl.js"></script>
<script src="/Customer/libs/slider/js/jquery.dependClass-0.1.js"></script>
<script src="/Customer/libs/slider/js/draggable-0.1.js"></script>
<script src="/Customer/libs/slider/js/jquery.slider.js"></script>
<script src="/build/assets/app-4ed993c7.js"></script>
<script src="/build/assets/app-5f264218.js"></script>
@endsection

@section("Script")
<script>
    window.addEventListener("load", () => {
        document.querySelector(".commentSubmit").addEventListener("click", () => {
            $.ajax({
                url: "/Customer/Blog/Comment",
                type: "post",
                data: {
                    content: document.querySelector(".commentContent").value,
                    blogId: {{ $blog->id }},
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                beforeSend: () => {
                    document.querySelector(".page-preloader").style.display = "flex";
                },
                success: (data) => {
                    if(typeof data.error != "undefined"){
                        window.location.replace(data.error);
                        return;
                    }

                    alert(data.message);

                    if(typeof data.success != "undefined"){
                        window.location.replace(data.success);
                    }
                },
                complete: () => {
                    document.querySelector(".page-preloader").style.display = "none";
                },
                error: (jqXHR, textStatus, errorThrown) => {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        });


        let commentCountNum = {{ $blog->blog_comments_count }};

        Echo.channel("UpdateBlogCommentChannel_{{ $blog->id }}").listen(".App\\Events\\Customer\\UpdateBlogComment", (data) => {
            let blogComment = document.createElement("div");
            blogComment.setAttribute("class", "comment-item");
            blogComment.innerHTML = 
                "<div class=\"comment-content-wrap\">" +
                    "<div class=\"comment-author\">" + escapeXml(data.customer.name) + "</div>" +
                    "<div class=\"comment-time\">" +
                        toCustomDateString(data.blogComment.createdDate, "M d, Y") +
                    "</div>" +
                    "<div class=\"comment-content\">" +
                        "<p>" + escapeXml(data.blogComment.content) + "</p>" +
                    "</div>" +
                "</div>";
            document.querySelector(".blogComments").prepend(blogComment);

            commentCountNum++;

            let commentCount = document.querySelector(".commentCount_blogId_{{ $blog->id }}_type_1");
            commentCount.innerHTML =
                commentCountNum +
                (commentCountNum <= 1 ? " comment" : " comments");

            commentCount = document.querySelector(".commentCount_blogId_{{ $blog->id }}_type_2");
            commentCount.innerHTML =
                "<i class=\"icon_comment_alt\"></i>" +
                commentCountNum +
                (commentCountNum <= 1 ? " comment" : " comments");

            commentCount = document.querySelector(".commentCount_blogId_{{ $blog->id }}_type_3");
            commentCount.innerHTML =
                commentCountNum +
                (commentCountNum <= 1 ? " comment" : " comments");
        });

    });
</script>
@endsection