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
                        <h1 class="text-title-heading">Shopping Cart</h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="index-2.html">Home</a><span class="delimiter"></span>Shopping Cart
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        @if(count($carts) > 0)
                            <div class="shop-cart cartView">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-12 col-md-12 col-12">
                                        <form class="cart-form" action="#" method="post" onsubmit="return false;">
                                            <div class="table-responsive">
                                                <table class="cart-items table" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">Product</th>
                                                            <th class="product-price">Price</th>
                                                            <th class="product-quantity">Quantity</th>
                                                            <th class="product-subtotal">Subtotal</th>
                                                            <th class="product-remove">&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="cartContainer">
                                                        @foreach($carts as $cart)
                                                            <tr class="cart-item">
                                                                <td class="product-thumbnail">
                                                                    <a href="/Customer/Product/ProductDetailPage?id={{ $cart->productId }}">
                                                                        <img width="600" height="600" src="{{ $cart->productImage }}" class="product-image" alt="{{ $cart->productImage }}">
                                                                    </a>
                                                                    <div class="product-name">
                                                                        <a href="/Customer/Product/ProductDetailPage?id={{ $cart->productId }}">{{ $cart->productName }}</a>
                                                                    </div>
                                                                </td>
                                                                <td class="product-price">
                                                                    <span class="price">
                                                                        {{ App\MyFunction\Utilities::formatCurrency($cart->productPriceAfterSale) }} VND
                                                                    </span>
                                                                </td>
                                                                <td class="product-quantity">
                                                                    <div class="quantity">
                                                                        <button type="button" class="minus">-</button>
                                                                        <input type="number" class="qty updateCartQuantity" step="1" min="0" max=""
                                                                            name="quantity" value="{{ $cart->quantity }}"
                                                                            title="Qty" size="4" placeholder=""
                                                                            inputmode="numeric" autocomplete="off" productId="{{ $cart->productId }}">
                                                                        <button type="button" class="plus">+</button>
                                                                    </div>
                                                                </td>
                                                                <td class="product-subtotal">
                                                                    <span>
                                                                        {{ App\MyFunction\Utilities::formatCurrency($cart->subTotal) }} VND
                                                                    </span>
                                                                </td>
                                                                <td class="product-remove">
                                                                    <a class="remove removeEvent deleteCart" productId="{{ $cart->productId }}">×</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="6" class="actions">
                                                                <div class="bottom-cart">
                                                                    <div class="coupon">
                                                                        <input type="text" name="coupon_code"
                                                                            class="input-text updateCartCouponCodeName" id="coupon-code" value="{{ isset($couponCodeName) ? $couponCodeName : "" }}"
                                                                            placeholder="Coupon code">
                                                                        <button type="submit" name="apply_coupon" class="button updateCartWithCouponCodeNameSubmit" value="Apply coupon">Apply coupon</button>
                                                                    </div>
                                                                    <h2><a href="/Customer/Home">Continue Shopping</a></h2>
                                                                    <button type="submit" name="update_cart" class="button updateCartSubmit" value="Update cart">Update cart</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                                        <div class="cart-totals">
                                            <h2>Cart totals</h2>
                                            <div>
                                                <div class="cart-subtotal">
                                                    <div class="title">Subtotal</div>
                                                    <div><span>{{ App\MyFunction\Utilities::formatCurrency($subTotal) }} VND</span></div>
                                                </div>
                                                <div class="shipping-totals">
                                                    <div class="title">Sale</div>
                                                    <div><span>{{ App\MyFunction\Utilities::formatCurrency($sale) }} VND</span></div>
                                                </div>
                                                <div class="order-total">
                                                    <div class="title">Total</div>
                                                    <div><span>{{ App\MyFunction\Utilities::formatCurrency($total) }} VND</span></div>
                                                </div>
                                            </div>
                                            <div class="proceed-to-checkout">
                                                <a class="checkout-button button createOrder">
                                                    Proceed to checkout
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="shop-cart-empty emptyCart">
                            <div class="notices-wrapper">
                                <p class="cart-empty">Your cart is currently empty.</p>
                            </div>
                            <div class="return-to-shop">
                                <a class="button" href="shop-grid-left.html">Return to shop</a>
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
@endsection

@section("Script")
<script>
    window.addEventListener("load", () => {

        @if(count($carts) == 0)
            setTimeout(() => {
                document.querySelector(".emptyCart").style.display = "block";
            }, 1000);
        @endif

        function updateCart(withCouponCodeName){
            
            let productIdWithQuantity = [];
            document.querySelectorAll(".updateCartQuantity").forEach((item) => {
                productIdWithQuantity.push({
                    productId: parseInt(item.getAttribute("productId")),
                    quantity: parseInt(item.value)
                });
            });
            productIdWithQuantity = JSON.stringify(productIdWithQuantity);

            let data = {
                productIdWithQuantity: productIdWithQuantity,
                _token: "{{ csrf_token() }}"
            };

            if(withCouponCodeName){
                data = {
                    productIdWithQuantity: productIdWithQuantity,
                    couponCodeName: document.querySelector(".updateCartCouponCodeName").value,
                    _token: "{{ csrf_token() }}"
                };
            }

            $.ajax({
                url: "/Customer/Cart/UpdateCart",
                type: "post",
                data: data,
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
        }

        document.querySelector(".updateCartSubmit").addEventListener("click", () => {
            updateCart(false);
        });

        document.querySelector(".updateCartWithCouponCodeNameSubmit").addEventListener("click", () => {
            updateCart(true);
        });

        setTimeout(() => {
            let deleteCartList = document.querySelectorAll(".deleteCart");
            deleteCartList.forEach((item) => {
                item.addEventListener("click", () => {
                    $.ajax({
                        url: "/Customer/Cart/DeleteProductFromCart",
                        type: "post",
                        data: {
                            productId: parseInt(item.getAttribute("productId")),
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
                            if(data.message == "Deleted successfully!"){

                                item.parentElement.parentElement.remove();
                                if(document.querySelector(".cartContainer").children.length == 1){
                                    document.querySelector(".cartView").style.display = "none";
                                    document.querySelector(".emptyCart").style.display = "block";
                                }
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
            });
        }, 1500);

        document.querySelector(".createOrder").addEventListener("click", () => {

            let data = {
                _token: "{{ csrf_token() }}"
            };
            if(document.querySelector(".updateCartCouponCodeName").value != ""){
                data = {
                    couponCodeName: document.querySelector(".updateCartCouponCodeName").value,
                    _token: "{{ csrf_token() }}"
                };
            }
            $.ajax({
                url: "/Customer/Checkout/CreateOrder",
                type: "post",
                data: data,
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

    });
</script>
@endsection