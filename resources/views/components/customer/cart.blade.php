<div class="ruper-topcart dropdown light">
    <div class="dropdown mini-cart top-cart">
        <div class="remove-cart-shadow"></div>
        <a class="dropdown-toggle cart-icon removeEvent" href="/Customer/Cart/CartPage">
            <div class="icons-cart">
                <i class="icon-large-paper-bag"></i>
                <span class="cart-count cartCount">{{ $cartCount <= 9 ? $cartCount : "9+" }}</span>
            </div>
        </a>
    </div>
</div>