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
<style>
    .limitLine{
        display: -webkit-box !important; 
        -webkit-box-orient: vertical !important; 
        -webkit-line-clamp: 4 !important;
        overflow: hidden !important; 
        text-overflow: ellipsis !important;
    }
</style>
@endsection

@section("Content")
<div id="site-main" class="site-main">
    <div id="main-content" class="main-content">
        <div id="primary" class="content-area">
            <div id="title" class="page-title">
                <div class="section-container">
                    <div class="content-title-heading">
                        <h1 class="text-title-heading">{{ $productCategory->name }}</h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="index-2.html">Home</a><span class="delimiter"></span>{{ $productCategory->name }}
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="row">

                            @php
                                $id = $productCategory->id;
                            @endphp
                            <x-customer.product-sidebar 
                                :id="$id"
                                :priceFilterId="$priceFilterId"
                                :brandId="$brandId"
                                :sort="$sort">
                            </x-customer.product-sidebar>

                            <div class="col-xl-9 col-lg-9 col-md-12 col-12">
                                <div class="products-topbar clearfix">
                                    <div class="products-topbar-left">
                                        <div class="products-count">
                                            Showing {{ count($products) }} of {{ $productsCount }} {{ $productsCount > 0 ? "results" : "result" }}
                                        </div>
                                    </div>
                                    <div class="products-topbar-right">
                                        <div class="products-sort dropdown">
                                            @php
                                                $url = "/Customer/Product/ProductCategoryPage?id=" . $productCategory->id;
                                                $url .= isset($priceFilterId) ? "&priceFilterId=" . $priceFilterId : "";
                                                $url .= isset($brandId) ? "&brandId=" . $brandId : "";
                                                $sortNames = [
                                                    "Sort by popularity",
                                                    "Sort by average rating",
                                                    "Sort by latest",
                                                    "Sort by price: low to high",
                                                    "Sort by price: high to low"
                                                ]
                                            @endphp
                                            <span class="sort-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                {{ isset($sort) ? $sortNames[$sort - 1] : "Default sorting" }}
                                            </span>
                                            <ul class="sort-list dropdown-menu" x-placement="bottom-start">
                                                <li><a href="{{ $url }}">Default sorting</a></li>
                                                @foreach($sortNames as $sortName)
                                                    <li><a href="{{ $url . "&sort=" . ($loop->index + 1) }}">{{ $sortName }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <ul class="layout-toggle nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="layout-grid nav-link active" data-toggle="tab"
                                                    href="#layout-grid" role="tab">
                                                    <span class="icon-column">
                                                        <span class="layer first">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                        </span>
                                                        <span class="layer middle">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                        </span>
                                                        <span class="layer last">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="layout-list nav-link" data-toggle="tab" href="#layout-list"
                                                    role="tab">
                                                    <span class="icon-column">
                                                        <span class="layer first">
                                                            <span></span>
                                                            <span></span>
                                                        </span>
                                                        <span class="layer middle">
                                                            <span></span>
                                                            <span></span>
                                                        </span>
                                                        <span class="layer last">
                                                            <span></span>
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="layout-grid" role="tabpanel">
                                        <div class="products-list grid">
                                            <div class="row">
                                                @foreach($products as $product)
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                        <div class="products-entry clearfix product-wapper">
                                                            <div class="products-thumb">
                                                                <div class="product-lable">
                                                                    <div class="hot">Hot</div>
                                                                    @if($product->sale > 0)
                                                                        <div class="onsale">-{{ $product->sale }}%</div>
                                                                    @endif
                                                                </div>
                                                                <div class="product-thumb-hover">
                                                                    <a href="/Customer/Product/ProductDetailPage?id={{ $product->id }}">
                                                                        <img width="600" height="600" src="{{ $product->image }}" class="post-image" alt="{{ $product->image }}">
                                                                        <img width="600" height="600" src="{{ $product->imageHover }}" class="hover-image back" alt="{{ $product->imageHover }}">
                                                                    </a>
                                                                </div>
                                                                <div class="product-button">
                                                                    <div class="btn-add-to-cart" data-title="Add to cart">
                                                                        <a id="abc" rel="nofollow" class="product-btn button removeEvent addToCart" productId="{{ $product->id }}">Add to cart</a>
                                                                    </div>
                                                                    <div class="btn-wishlist" data-title="Wishlist">
                                                                        <button class="product-btn removeEvent addToWishlist" productId="{{ $product->id }}">Add to wishlist</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="products-content">
                                                                <div class="contents text-center">
                                                                    <h3 class="product-title">
                                                                        <a href="/Customer/Product/ProductDetailPage?id={{ $product->id }}">{{ $product->name }}</a>
                                                                    </h3>
                                                                    <span class="price">
                                                                        @if($product->sale > 0)
                                                                            <del aria-hidden="true"><span>{{ App\MyFunction\Utilities::formatCurrency($product->price) }}</span></del> 
                                                                            <ins><span>{{ App\MyFunction\Utilities::formatCurrency($product->priceAfterSale) }} VND</span></ins>
                                                                        @else
                                                                            {{ App\MyFunction\Utilities::formatCurrency($product->price) }} VND
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="layout-list" role="tabpanel">
                                        <div class="products-list list">
                                            @foreach($products as $product)
                                                <div class="products-entry clearfix product-wapper">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="products-thumb">
                                                                <div class="product-lable">
                                                                    <div class="hot">Hot</div>
                                                                    @if($product->sale > 0)
                                                                        <div class="onsale">-{{ $product->sale }}%</div>
                                                                    @endif
                                                                </div>
                                                                <div class="product-thumb-hover">
                                                                    <a href="/Customer/Product/ProductDetailPage?id={{ $product->id }}">
                                                                        <img width="600" height="600" src="{{ $product->image }}" class="post-image" alt="{{ $product->image }}">
                                                                        <img width="600" height="600" src="{{ $product->imageHover }}" class="hover-image back" alt="{{ $product->imageHover }}">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="products-content">
                                                                <h3 class="product-title">
                                                                    <a href="/Customer/Product/ProductDetailPage?id={{ $product->id }}">{{ $product->name }}</a>
                                                                </h3>
                                                                <span class="price">
                                                                    @if($product->sale > 0)
                                                                        <del aria-hidden="true"><span>{{ App\MyFunction\Utilities::formatCurrency($product->price) }}</span></del> 
                                                                        <ins><span>{{ App\MyFunction\Utilities::formatCurrency($product->priceAfterSale) }} VND</span></ins>
                                                                    @else
                                                                        {{ App\MyFunction\Utilities::formatCurrency($product->price) }} VND
                                                                    @endif
                                                                </span>
                                                                <div class="rating">
                                                                    <div class="star star-{{ isset($product->product_reviews_avg_product_reviewrate) ? (int)$product->product_reviews_avg_product_reviewrate : 0 }}"></div>
                                                                    <div class="review-count">({{ $product->product_reviews_count }}<span> {{ $product->product_reviews_count <= 1 ? "review" : "reviews" }}</span>)</div>
                                                                </div>
                                                                <div class="product-button">
                                                                    <div class="btn-add-to-cart" data-title="Add to cart">
                                                                        <a rel="nofollow" class="product-btn button removeEvent addToCart" productId="{{ $product->id }}">Add to cart</a>
                                                                    </div>
                                                                    <div class="btn-wishlist" data-title="Wishlist">
                                                                        <button class="product-btn removeEvent addToWishlist" productId="{{ $product->id }}">Add to wishlist</button>
                                                                    </div>
                                                                </div>
                                                                <div class="product-description limitLine">{{ $product->content }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $url = "/Customer/Product/ProductCategoryPage?id=" . $productCategory->id;
                                    $url .= isset($priceFilterId) ? "&priceFilterId=" . $priceFilterId : "";
                                    $url .= isset($brandId) ? "&brandId=" . $brandId : "";
                                    $url .= isset($sort) ? "&sort=" . $sort : "";
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
@endsection

@section("Script")

@endsection