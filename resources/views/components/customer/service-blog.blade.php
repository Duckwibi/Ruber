<div class="col-lg-3 col-md-6">
    <div class="block block-menu">
        <h2 class="block-title">Services</h2>
        <div class="block-content">
            <ul>
                @foreach($blogs as $blog)
                    <li>
                        <a href="/Customer/Blog/BlogDetailPage?id={{ $blog->id }}">{{ $blog->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>