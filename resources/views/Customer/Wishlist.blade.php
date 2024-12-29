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
                        <h1 class="text-title-heading">Wishlist</h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="index-2.html">Home</a><span class="delimiter"></span>Wishlist
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="shop-wishlist">
                            <div class="wishlist-empty wishlistEmptyContainer" style="{{ count($wishlists) != 0 ? "display: none;" : "" }}">There are no products on the wishlist!
                            </div>
                            <table class="wishlist-items">
                                <tbody class="wishlistContainer">
                                    @foreach($wishlists as $wishlist)
                                        <tr class="wishlist-item">
                                            <td class="wishlist-item-remove">
                                                <span class="removeEvent deleteProduct deleteProduct_productId_{{ $wishlist->product->id }}"></span>
                                            </td>
                                            <td class="wishlist-item-image">
                                                <a href="/Customer/Product/ProductDetailPage?id={{ $wishlist->product->id }}">
                                                    <img width="600" height="600" src="{{ $wishlist->product->image }}" alt="{{ $wishlist->product->image }}">
                                                </a>
                                            </td>
                                            <td class="wishlist-item-info">
                                                <div class="wishlist-item-name">
                                                    <a href="/Customer/Product/ProductDetailPage?id={{ $wishlist->product->id }}">
                                                        {{ $wishlist->product->name }}
                                                    </a>
                                                </div>
                                                <div class="wishlist-item-price">
                                                    @if($wishlist->product->sale > 0)
                                                        <del aria-hidden="true"><span>{{ App\MyFunction\Utilities::formatCurrency($wishlist->product->price) }}</span></del>
                                                        <ins><span>{{ App\MyFunction\Utilities::formatCurrency($wishlist->product->priceAfterSale) }} VND</span></ins>
                                                    @else
                                                        {{ App\MyFunction\Utilities::formatCurrency($wishlist->product->price) }} VND
                                                    @endif
                                                </div>
                                                <div class="wishlist-item-time">
                                                    {{ date("M d, Y", strtotime($wishlist->createdDate)) }}
                                                </div>
                                            </td>
                                            <td class="wishlist-item-actions">
                                                <div class="wishlist-item-stock">
                                                    {{ $wishlist->product->quantity > 0 ? "In stock" : "Out stock" }}
                                                </div>
                                                <div class="wishlist-item-add">
                                                    <div class="btn-add-to-cart" data-title="Add to cart">
                                                        <a rel="nofollow" class="product-btn button removeEvent addToCart" productId="{{ $wishlist->product->id }}">Add to cart</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
@endsection

@section("Script")
<script>
    window.addEventListener("load", () => {

        setTimeout(() => {
            let deleteProductList = document.querySelectorAll(".deleteProduct");
            deleteProductList.forEach((item) => {
                item.addEventListener("click", () => {
                    $.ajax({
                        url: "/Customer/Wishlist/DeleteProductFromWishlist",
                        type: "post",
                        data: {
                            productId: parseInt(item.classList[2].replaceAll("deleteProduct_productId_", "")),
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        beforeSend: () => {
                            document.querySelector(".page-preloader").style.display = "flex";
                        },
                        success: (data) => {
                            if(typeof data.error != "undefined") {
                                window.location.replace(data.error);
                                return;
                            }

                            alert(data.message);
                            if(data.message == "Deleted successfully!"){

                                item.parentElement.parentElement.remove();
                                if(document.querySelector(".wishlistContainer").children.length == 0){
                                    document.querySelector(".wishlistEmptyContainer").style.display = "block";
                                }

                                document.querySelector(".wishlistCount").innerHTML = data.wishlistCount <= 9 ? String(data.wishlistCount) : "9+";
                            }

                            if(typeof data.success != "undefined") {
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
            });
        }, 1500);

        

    });
</script>
@endsection