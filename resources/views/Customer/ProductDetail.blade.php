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
    .rateFocus::after{
        color: #ffc107 !important;
    }
    .rateNormal::after{
        color: #cecece !important;
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
                        <h1 class="text-title-heading">{{ $product->name }}</h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="/Customer/Home/IndexPage">Home</a><span class="delimiter"></span>{{ $product->name }}
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="shop-details zoom" data-product_layout_thumb="scroll" data-zoom_scroll="true"
                    data-zoom_contain_lens="true" data-zoomtype="inner" data-lenssize="200" data-lensshape="square"
                    data-lensborder="" data-bordersize="2" data-bordercolour="#f9b61e" data-popup="false">
                    <div class="product-top-info">
                        <div class="section-padding">
                            <div class="section-container p-l-r">
                                <div class="row">
                                    <div class="product-images col-lg-7 col-md-12 col-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="content-thumbnail-scroll">
                                                    <div class="image-thumbnail slick-carousel slick-vertical"
                                                        data-asnavfor=".image-additional" data-centermode="true"
                                                        data-focusonselect="true" data-columns4="5" data-columns3="4"
                                                        data-columns2="4" data-columns1="4" data-columns="4"
                                                        data-nav="true" data-vertical="&quot;true&quot;"
                                                        data-verticalswiping="&quot;true&quot;">
                                                        @foreach($product->productDetailImages as $productDetailImage)
                                                            <div class="img-item slick-slide">
                                                                <span class="img-thumbnail-scroll">
                                                                    <img width="600" height="600" src="{{ $productDetailImage->image }}" alt="{{ $productDetailImage->image }}">
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="scroll-image main-image">
                                                    <div class="image-additional slick-carousel"
                                                        data-asnavfor=".image-thumbnail" data-fade="true"
                                                        data-columns4="1" data-columns3="1" data-columns2="1"
                                                        data-columns1="1" data-columns="1" data-nav="true">
                                                        @foreach($product->productDetailImages as $productDetailImage)
                                                            <div class="img-item slick-slide">
                                                                <img width="900" height="900" src="{{ $productDetailImage->image }}" alt="{{ $productDetailImage->image }}" title="">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="product-info col-lg-5 col-md-12 col-12 ">
                                        <h1 class="title">{{ $product->name }}</h1>
                                        <span class="price">
                                            @if($product->sale > 0)
                                                <del aria-hidden="true"><span>{{ App\MyFunction\Utilities::formatCurrency($product->price) }}</span></del>
                                                <ins><span>{{ App\MyFunction\Utilities::formatCurrency($product->priceAfterSale) }} VND</span></ins>
                                            @else
                                                {{ App\MyFunction\Utilities::formatCurrency($product->price) }} VND
                                            @endif
                                        </span>
                                        <div class="rating">
                                            <div class="avgRate star star-{{ isset($product->product_reviews_avg_product_reviewrate) ? (int)$product->product_reviews_avg_product_reviewrate : 0 }}"></div>
                                            <div class="review-count reviewCount_type_1">
                                                ({{ $product->product_reviews_count }}<span> {{ $product->product_reviews_count <= 1 ? "review" : "reviews" }}</span>)
                                            </div>
                                        </div>
                                        <div class="description">
                                            <p>{{ $product->content }}</p>
                                        </div>
                                        <div class="buttons">
                                            <div class="add-to-cart-wrap">
                                                <div class="quantity">
                                                    <button type="button" class="plus">+</button>
                                                    <input type="number" class="qty addToCartQuantity" step="1" min="1" max=""
                                                        name="quantity" value="1" title="Qty" size="4" 
                                                        placeholder="" inputmode="numeric" autocomplete="off">
                                                    <button type="button" class="minus">-</button>
                                                </div>
                                                <div class="btn-add-to-cart removeEvent addToCartWithQuantity" productId="{{ $product->id }}">
                                                    <a class="button" tabindex="0">Add to cart</a>
                                                </div>
                                            </div>
                                            <div class="btn-quick-buy" data-title="Wishlist">
                                                <button class="product-btn removeEvent createOrderForOneProduct" productId="{{ $product->id }}">Buy It Now</button>
                                            </div>
                                            <div class="btn-wishlist" data-title="Wishlist">
                                                <button class="product-btn removeEvent addToWishlist" productId="{{ $product->id }}">Add to wishlist</button>
                                            </div>
                                        </div>
                                        <div class="product-meta">
                                            <span class="sku-wrapper">Brand: <span class="sku">{{ $product->brand->name }}</span></span>
                                            <span class="posted-in">Category: 
                                                <a href="shop-grid-left.html" rel="tag">{{ $product->productCategory->name }}</a>
                                            </span>
                                        </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="product-tabs">
                        <div class="section-padding">
                            <div class="section-container p-l-r">
                                <div class="product-tabs-wrap">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (<span class="reviewCount_type_2">{{ $product->product_reviews_count }}</span>)</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                                            {{ $product->description }}
                                        </div>
                                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                                            <div id="reviews" class="product-reviews">
                                                <div id="comments">
                                                    <h2 class="reviews-title">
                                                        <span class="reviewCount_type_3">{{ $product->product_reviews_count }} {{ $product->product_reviews_count <= 1 ? "review" : "reviews" }}</span> for
                                                        <span>{{ $product->name }}</span>
                                                    </h2>
                                                    <ol class="comment-list productReviews">
                                                        @foreach($product->productReviews as $productReview)
                                                            <li class="review">
                                                                <div class="content-comment-container">
                                                                    <div class="comment-container">
                                                                        <div class="comment-text" style="padding-left: 0;">
                                                                            <div class="rating small">
                                                                                <div class="star star-{{ $productReview->rate }}"></div>
                                                                            </div>
                                                                            <div class="review-author">{{ $productReview->customer->name }}</div>
                                                                            <div class="review-time">{{ date("M d, Y", strtotime($productReview->createdDate)) }}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="description">{{ $productReview->content }}</div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                </div>
                                                <div id="review-form">
                                                    <div id="respond" class="comment-respond">
                                                        <span id="reply-title" class="comment-reply-title">Add a review</span>
                                                        <form onsubmit="return false;" id="comment-form" class="comment-form">
                                                            <p class="comment-notes">
                                                                <span id="email-notes">
                                                                    Your email address will not be published.</span> Required fields are marked <span class="required">*
                                                                </span>
                                                            </p>
                                                            <div class="comment-form-rating">
                                                                <label for="rating">Your rating</label>
                                                                <p class="stars">
                                                                    <span class="rateSelect">
                                                                        <a class="rateNormal">1</a>
                                                                        <a class="rateNormal">2</a>
                                                                        <a class="rateNormal">3</a>
                                                                        <a class="rateNormal">4</a>
                                                                        <a class="rateNormal">5</a>
                                                                    </span>
                                                                </p>
                                                            </div>
                                                            <p class="comment-form-comment">
                                                                <textarea class="reviewContent" id="comment" name="comment" placeholder="Your Reviews *" cols="45" rows="8" aria-required="true"></textarea>
                                                            </p>
                                                            <div class="content-info-reviews">
                                                                <p class="comment-form-author">
                                                                    <input id="author" name="author" placeholder="Name *" type="text" 
                                                                    value="{{ isset($currentUser) ? $currentUser->name : "" }}" size="30" aria-required="true" readonly>
                                                                </p>
                                                                <p class="comment-form-email">
                                                                    <input id="email" name="email" placeholder="Email *" type="text" 
                                                                    value="{{ isset($currentUser) ? $currentUser->email : "" }}" size="30" aria-required="true" readonly>
                                                                </p>
                                                                <p class="form-submit reviewSubmit">
                                                                    <input name="submit" type="submit" id="submit" class="submit" value="Submit">
                                                                </p>
                                                            </div>
                                                        </form><!-- #respond -->
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-related">
                        <div class="section-padding">
                            <div class="section-container p-l-r">
                                <div class="block block-products slider">
                                    <div class="block-title">
                                        <h2>Related Products</h2>
                                    </div>
                                    <div class="block-content">
                                        <div class="content-product-list slick-wrap">
                                            <div class="slick-sliders products-list grid" data-slidestoscroll="true"
                                                data-dots="false" data-nav="1" data-columns4="1" data-columns3="2"
                                                data-columns2="3" data-columns1="3" data-columns1440="4"
                                                data-columns="4">
                                                @foreach($relatedProducts as $relatedProduct)
                                                    <div class="item-product slick-slide">
                                                        <div class="items">
                                                            <div class="products-entry clearfix product-wapper">
                                                                <div class="products-thumb">
                                                                    <div class="product-lable">
                                                                        <div class="hot">Hot</div>
                                                                        @if($relatedProduct->sale > 0)
                                                                            <div class="onsale">-{{ $relatedProduct->sale }}%</div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="product-thumb-hover">
                                                                        <a href="/Customer/Product/ProductDetailPage?id={{ $relatedProduct->id }}">
                                                                            <img width="600" height="600" src="{{ $relatedProduct->image }}" class="post-image" alt="{{ $relatedProduct->image }}">
                                                                            <img width="600" height="600" src="{{ $relatedProduct->imageHover }}" class="hover-image back" alt="{{ $relatedProduct->imageHover }}">
                                                                        </a>
                                                                    </div>
                                                                    <div class="product-button">
                                                                        <div class="btn-add-to-cart" data-title="Add to cart">
                                                                            <a rel="nofollow" class="product-btn button removeEvent addToCart" productId="{{ $relatedProduct->id }}">Add to cart</a>
                                                                        </div>
                                                                        <div class="btn-wishlist" data-title="Wishlist">
                                                                            <button class="product-btn removeEvent addToWishlist" productId="{{ $relatedProduct->id }}">Add to wishlist</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="products-content">
                                                                    <div class="contents text-center">
                                                                        <h3 class="product-title">
                                                                            <a href="/Customer/Product/ProductDetailPage?id={{ $relatedProduct->id }}">{{ $relatedProduct->name }}</a>
                                                                        </h3>
                                                                        <div class="rating">
                                                                            <div class="star star-{{ isset($relatedProduct->product_reviews_avg_product_reviewrate) ? (int)$relatedProduct->product_reviews_avg_product_reviewrate : 0 }}"></div>
                                                                        </div>
                                                                        <span class="price">
                                                                            @if($relatedProduct->sale > 0)
                                                                                <del aria-hidden="true"><span>{{ App\MyFunction\Utilities::formatCurrency($relatedProduct->price) }}</span></del>
                                                                                <ins><span>{{ App\MyFunction\Utilities::formatCurrency($relatedProduct->priceAfterSale) }} VND</span></ins>
                                                                            @else
                                                                                {{ App\MyFunction\Utilities::formatCurrency($relatedProduct->price) }} VND
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
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
<script src="/Customer/libs/elevatezoom/js/jquery.elevatezoom.js"></script>
<script src="/build/assets/app-4ed993c7.js"></script>
<script src="/build/assets/app-5f264218.js"></script>
@endsection

@section("Script")
<script>
    window.addEventListener("load", () => {

        let index = 0;
        let rateSelect = document.querySelector(".rateSelect");
        rateSelect.addEventListener("click", () => {
            if(index == 5){
                index = 0;
                for(let i = 0; i < 5; i++){
                    rateSelect.children[i].setAttribute("class", "rateNormal");
                }
                return;
            }
            rateSelect.children[index].setAttribute("class", "rateFocus");
            index++;
        });

        document.querySelector(".reviewSubmit").addEventListener("click", () => {
            $.ajax({
                url: "/Customer/Product/Review",
                type: "post",
                data: {
                    content: document.querySelector(".reviewContent").value,
                    rate: index,
                    productId: {{ $product->id }},
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

        let reviewCount = {{ $product->product_reviews_count }};

        Echo.channel("UpdateProductReviewChannel_" + {{ $product->id }}).listen(".App\\Events\\Customer\\UpdateProductReview", (data) => {
            
            let productReview = document.createElement("li");
            productReview.setAttribute("class", "review");
            productReview.innerHTML =
                "<div class=\"content-comment-container\">" +
                    "<div class=\"comment-container\">" +
                        "<div class=\"comment-text\" style=\"padding-left: 0;\">" +
                            "<div class=\"rating small\">" +
                                "<div class=\"star star-" + data.productReview.rate + "\"></div>" +
                            "</div>" +
                            "<div class=\"review-author\">" + escapeXml(data.customer.name)  + "</div>" +
                                "<div class=\"review-time\">" + toCustomDateString(data.productReview.createdDate, "M d, Y") + "</div>" +
                            "</div>" +
                        "</div>" +
                    "<div class=\"description\">" + escapeXml(data.productReview.content) + "</div>" +
                "</div>";
            document.querySelector(".productReviews").prepend(productReview);

            document.querySelector(".avgRate").setAttribute("class", "avgRate star star-" + data.avgRate);

            reviewCount++
            
            document.querySelector(".reviewCount_type_1").innerHTML = "(" + reviewCount + "<span>" + (reviewCount <= 1 ? " review" : " reviews") + "</span>)";
            document.querySelector(".reviewCount_type_2").innerHTML = String(reviewCount);
            document.querySelector(".reviewCount_type_3").innerHTML = reviewCount + (reviewCount <= 1 ? " review" : " reviews");
        });

        setTimeout(() => {
            let addToCartWithQuantity = document.querySelector(".addToCartWithQuantity");
            addToCartWithQuantity.addEventListener("click", () => {
                $.ajax({
                    url: "/Customer/Cart/AddProductToCart",
                    type: "post",
                    data: {
                        productId: parseInt(addToCartWithQuantity.getAttribute("productId")),
                        quantity: document.querySelector(".addToCartQuantity").value,
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
                        if(data.message == "Added successfully!"){
							document.querySelector(".cartCount").innerHTML = data.cartCount <= 9 ? String(data.cartCount) : "9+";
						}

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

            let createOrderForOneProduct = document.querySelector(".createOrderForOneProduct");
            createOrderForOneProduct.addEventListener("click", () => {
                $.ajax({
                    url: "/Customer/Checkout/CreateOrderForOneProduct",
                    type: "post",
                    data: {
                        productId: parseInt(createOrderForOneProduct.getAttribute("productId")),
                        quantity: document.querySelector(".addToCartQuantity").value,
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
        }, 1500);
    });
</script>
@endsection