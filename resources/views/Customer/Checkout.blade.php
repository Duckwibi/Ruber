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
<link rel="stylesheet" href="/Customer/libs/select2/css/select2.min.css">
@endsection

@section("Style")
<style>
    .customButton{
        margin-bottom: 15px !important;
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
                        <h1 class="text-title-heading">Checkout</h1>
                    </div>
                    <div class="breadcrumbs">
                        <a href="index-2.html">Home</a><span class="delimiter"></span>Checkout
                    </div>
                </div>
            </div>

            <div id="content" class="site-content" role="main">
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="shop-checkout">
                            <form name="checkout" method="post" class="checkout" action="#" autocomplete="off" onsubmit="return false;">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-7 col-md-12 col-12">
                                        <div class="customer-details">
                                            <div class="billing-fields">
                                                <h3>Billing details</h3>
                                                <div class="billing-fields-wrapper">
                                                    <p class="form-row form-row-first validate-required">
                                                        <label>
                                                            First name 
                                                            <span class="required" title="required">*</span>
                                                        </label>
                                                        <span class="input-wrapper">
                                                            <input type="text" class="input-text orderFirstName" 
                                                                name="billing_first_name" 
                                                                value="{{ $order->firstName == "none" ? $customer->firstName : $order->firstName }}">
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-last validate-required">
                                                        <label>
                                                            Last name 
                                                            <span class="required" title="required">*</span>
                                                        </label>
                                                        <span class="input-wrapper">
                                                            <input type="text" class="input-text orderLastName" 
                                                                name="billing_last_name" 
                                                                value="{{ $order->lastName == "none" ? $customer->lastName : $order->lastName }}">
                                                        </span>
                                                    </p>
                                                    <p class="form-row address-field validate-required form-row-wide">
                                                        <label>
                                                            Phone
                                                            <span class="required" title="required">*</span>
                                                        </label>
                                                        <span class="input-wrapper">
                                                            <input type="text" class="input-text orderPhone"
                                                                name="billing_address_1"
                                                                placeholder="Enter phone" value="{{ $order->phone == "none" ? "" : $order->phone }}">
                                                        </span>
                                                    </p>
                                                    <p class="form-row address-field validate-required validate-state form-row-wide">
                                                        <label>
                                                            Province
                                                            <span class="required" title="required">*</span>
                                                        </label>
                                                        <span class="input-wrapper">
                                                            <select name="billing_state" class="state-select custom-select orderProvince">
                                                                <option value="">Select province</option>
                                                                @foreach($provinces as $province)
                                                                    <option value="{{ $province->name }}" @selected($order->province == $province->name)>{{ $province->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </span>
                                                    </p>
                                                    <p class="form-row address-field validate-required form-row-wide">
                                                        <label>
                                                            District
                                                            <span class="required" title="required">*</span>
                                                        </label>
                                                        <span class="input-wrapper">
                                                            <input type="text" class="input-text orderDistrict"
                                                                name="billing_address_1"
                                                                placeholder="Enter district" value="{{ $order->district == "none" ? "" : $order->district }}">
                                                        </span>
                                                    </p>
                                                    <p class="form-row address-field validate-required form-row-wide">
                                                        <label>
                                                            Ward
                                                            <span class="required" title="required">*</span>
                                                        </label>
                                                        <span class="input-wrapper">
                                                            <input type="text" class="input-text orderWard"
                                                                name="billing_address_1"
                                                                placeholder="Enter ward" value="{{ $order->ward == "none" ? "" : $order->ward }}">
                                                        </span>
                                                    </p>
                                                    <p class="form-row address-field validate-required form-row-wide">
                                                        <label>
                                                            Street address
                                                            <span class="required" title="required">*</span>
                                                        </label>
                                                        <span class="input-wrapper">
                                                            <input type="text" class="input-text orderStreet"
                                                                name="billing_address_1"
                                                                placeholder="Enter house number and street name" value="{{ $order->street == "none" ? "" : $order->street }}">
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="additional-fields">
                                            <p class="form-row notes">
                                                <label>
                                                    Notes 
                                                    <span class="optional">(optional)</span>
                                                </label>
                                                <span class="input-wrapper">
                                                    <textarea name="order_comments" class="input-text orderNote"
                                                        placeholder="Notes about your order, e.g. special notes for delivery."
                                                        rows="2" cols="5">{{ $order->note == "none" ? "" : $order->note }}</textarea>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-5 col-md-12 col-12">
                                        <div class="checkout-review-order">
                                            <div class="checkout-review-order-table">
                                                <div class="review-order-title">Product</div>
                                                <div class="cart-items">
                                                    @foreach($orderDetails as $orderDetail)
                                                        <div class="cart-item">
                                                            <div class="info-product">
                                                                <div class="product-thumbnail">
                                                                    <img width="600" height="600" src="{{ $orderDetail->product->image }}" alt="{{ $orderDetail->product->image }}">
                                                                </div>
                                                                <div class="product-name">
                                                                    {{ $orderDetail->product->name }}
                                                                    <strong class="product-quantity">QTY : {{ $orderDetail->quantity }}</strong>
                                                                </div>
                                                            </div>
                                                            <div class="product-total">
                                                                <span>{{ App\MyFunction\Utilities::formatCurrency($orderDetail->subTotal) }} VND</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="cart-subtotal">
                                                    <h2>Subtotal</h2>
                                                    <div class="subtotal-price">
                                                        <span>{{ App\MyFunction\Utilities::formatCurrency($subTotal) }} VND</span>
                                                    </div>
                                                </div>
                                                <div class="shipping-totals shipping">
													<h2>Sale</h2>
													<div data-title="Shipping">
                                                        <strong>
                                                            <span>{{ App\MyFunction\Utilities::formatCurrency($sale) }} VND</span>
                                                        </strong>
													</div>
												</div>  
                                                <div class="order-total">
                                                    <h2>Total</h2>
                                                    <div class="total-price">
                                                        <strong>
                                                            <span>{{ App\MyFunction\Utilities::formatCurrency($total) }} VND</span>
                                                        </strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="payment" class="checkout-payment">
                                                <ul class="payment-methods methods custom-radio">
                                                    <li class="payment-method">
                                                        <input type="radio" class="input-radio orderPaymentMethod" name="payment_method" value="1" checked="checked">
                                                        <label for="payment_method_bacs">Direct bank transfer</label>
                                                        <div class="payment-box">
                                                            <p>
                                                                Make your payment directly into our bank account. Please
                                                                use your Order ID as the payment reference. Your order
                                                                will not be shipped until the funds have cleared in our
                                                                account.
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li class="payment-method">
                                                        <input type="radio" class="input-radio orderPaymentMethod" name="payment_method" value="2">
                                                        <label>Cash on delivery</label>
                                                        <div class="payment-box">
                                                            <p>Pay with cash upon delivery.</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="form-row place-order">
                                                    <div class="terms-and-conditions-wrapper">
                                                        <div class="privacy-policy-text"></div>
                                                    </div>
                                                    <button type="submit" class="button alt customButton deleteOrderSubmit" name="checkout_place_order" value="Place order">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="button alt orderSubmit" name="checkout_place_order" value="Place order">
                                                        Place order
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
<script src="/Customer/libs/select2/js/select2.min.js"></script>
@endsection

@section("Script")
<script>
    window.addEventListener("load", () => {
        document.querySelector(".orderSubmit").addEventListener("click", () => {

            let paymentMethod = 1;
            document.querySelectorAll(".orderPaymentMethod").forEach((item) => {
                if(item.checked){
                    paymentMethod = item.value;
                }
            });

            let data = {
                _token: "{{ csrf_token() }}",
                firstName: document.querySelector(".orderFirstName").value,
                lastName: document.querySelector(".orderLastName").value,
                phone: document.querySelector(".orderPhone").value,
                province: document.querySelector(".orderProvince").value,
                district: document.querySelector(".orderDistrict").value,
                ward: document.querySelector(".orderWard").value,
                street: document.querySelector(".orderStreet").value,
                paymentMethod: paymentMethod
            }
            if(document.querySelector(".orderNote").value != ""){
                data = {
                    _token: "{{ csrf_token() }}",
                    firstName: document.querySelector(".orderFirstName").value,
                    lastName: document.querySelector(".orderLastName").value,
                    phone: document.querySelector(".orderPhone").value,
                    province: document.querySelector(".orderProvince").value,
                    district: document.querySelector(".orderDistrict").value,
                    ward: document.querySelector(".orderWard").value,
                    street: document.querySelector(".orderStreet").value,
                    note: document.querySelector(".orderNote").value,
                    paymentMethod: paymentMethod
                };
            }
            $.ajax({
                url: "/Customer/Checkout/Order",
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

        document.querySelector(".deleteOrderSubmit").addEventListener("click", () => {
            $.ajax({
                url: "/Customer/Checkout/DeleteOrder",
                type: "post",
                data: {
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
    });
</script>
@endsection