<div class="col-xl-3 col-lg-3 col-md-12 col-12 sidebar left-sidebar md-b-50">
    <!-- Block Post Search -->
    <div class="block block-post-search">
        <div class="block-title">
            <h2>Search</h2>
        </div>
        <div class="block-content">
            <form method="get" class="search-from" action="/Customer/Blog/BlogCategoryPage">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="text" name="titleLike" class="s" placeholder="Search for blog..." value="{{ isset($titleLike) ? $titleLike : "" }}">
                <button class="btn" type="submit"><i class="icon-search"></i></button>
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
                    @foreach($blogCategories as $blogCategory)
                        <li class="{{ $id == $blogCategory->id ? "current" : "" }}">
                            <a href="/Customer/Blog/BlogCategoryPage?id={{ $blogCategory->id }}">
                                {{ $blogCategory->name }}
                                <span class="count">{{ $blogCategory->blogs_count }}</span>
                            </a>
                        </li>
                    @endforeach
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
                @foreach($blogs as $blog)
                    <li class="post-item">
                        <a href="blog-details-right.html" class="post-image">
                            <img src="{{ $blog->image }}" alt="{{ $blog->image }}">
                        </a>
                        <div class="post-content">
                            <h2 class="post-title">
                                <a href="/Customer/Blog/BlogDetailPage?id={{ $blog->id }}">{{ $blog->title }}</a>
                            </h2>
                            <div class="post-time">
                                <span class="post-date">{{ date("M d, Y", strtotime($blog->createdDate)) }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
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
                    @foreach($archives as $archive)
                        <li>
                            @php
                                $url = "/Customer/Blog/BlogCategoryPage?id=" . $id;
                                $url .= isset($titleLike) ? "&titleLike=" . urlencode($titleLike) : "";
                                $url .= "&archiveId=" . $archive->id;
                                $url .= isset($tagId) ? "&tagId=" . $tagId : "";
                            @endphp
                            <a href="{{ $url }}">
                                {{ date("M d, Y", strtotime($archive->archiveDate)) }}
                            </a>
                        </li>
                    @endforeach
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
                    @foreach($tags as $tag)
                        <li>
                            @php
                                $url = "/Customer/Blog/BlogCategoryPage?id=" . $id;
                                $url .= isset($titleLike) ? "&titleLike=" . urlencode($titleLike) : "";
                                $url .= isset($archiveId) ? "&archiveId=" . $archiveId : "";
                                $url .= "&tagId=" . $tag->id;
                            @endphp
                            <a href="{{ $url }}">
                                {{ $tag->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>