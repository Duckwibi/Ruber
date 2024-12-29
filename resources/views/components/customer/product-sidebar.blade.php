<div class="col-xl-3 col-lg-3 col-md-12 col-12 sidebar left-sidebar md-b-50">
    <!-- Block Product Categories -->
    <div class="block block-product-cats">
        <div class="block-title">
            <h2>Categories</h2>
        </div>
        <div class="block-content">
            <div class="product-cats-list">
                <ul>
                    @foreach($productCategories as $productCategory)
                        <li class="{{ $id == $productCategory->id ? "current" : "" }}">
                            <a href="/Customer/Product/ProductCategoryPage?id={{ $productCategory->id }}">
                                {{ $productCategory->name }}
                                <span class="count">{{ $productCategory->products_count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Block Product Filter -->
    <div class="block block-post-archives">
        <div class="block-title">
            <h2>Prices</h2>
        </div>
        <div class="block-content">
            <div class="post-archives-list">
                <ul>
                    @foreach($priceFilters as $priceFilter)
                        @php
                            $url = "/Customer/Product/ProductCategoryPage?id=" . $id;
                            $url .= "&priceFilterId=" . $priceFilter->id;
                            $url .= isset($brandId) ? "&brandId=" . $brandId : "";
                            $url .= isset($sort) ? "&sort=" . $sort : "";
                        @endphp
                        <li>
                            <a href="{{ $url }}">{{ $priceFilter->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Block Product Filter -->
    <div class="block block-product-filter clearfix">
        <div class="block-title">
            <h2>Brands</h2>
        </div>
        <div class="block-content">
            <ul class="filter-items image">
                @foreach($brands as $brand)
                    @php
                        $url = "/Customer/Product/ProductCategoryPage?id=" . $id;
                        $url .= isset($priceFilterId) ? "&priceFilterId=" . $priceFilterId : "";
                        $url .= "&brandId=" . $brand->id;
                        $url .= isset($sort) ? "&sort=" . $sort : "";
                    @endphp
                    <li>
                        <span>
                            <a href="{{ $url }}">
                                <img src="{{ $brand->image }}" alt="{{ $brand->image }}">
                            </a>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Block Products -->
    <div class="block block-products">
        <div class="block-title">
            <h2>Feature Product</h2>
        </div>
        <div class="block-content">
            <ul class="products-list">
                @foreach($products as $product)
                    <li class="product-item">
                        <a href="/Customer/Product/ProductDetailPage?id={{ $product->id }}" class="product-image">
                            <img src="{{ $product->image }}" alt="{{ $product->image }}">
                        </a>
                        <div class="product-content">
                            <h2 class="product-title">
                                <a href="/Customer/Product/ProductDetailPage?id={{ $product->id }}">{{ $product->name }} {{ $product->id }}</a>
                            </h2>
                            <div class="rating small">
                                <div class="star star-{{ isset($product->product_reviews_avg_product_reviewrate) ? (int)$product->product_reviews_avg_product_reviewrate : 0 }}"></div>
                            </div>
                            <span class="price">
                                @if($product->sale > 0)
                                    <del aria-hidden="true"><span>{{ App\MyFunction\Utilities::formatCurrency($product->price) }}</span></del>
                                    <ins><span>{{ App\MyFunction\Utilities::formatCurrency($product->priceAfterSale) }} VND</span></ins>
                                @else
                                    {{ App\MyFunction\Utilities::formatCurrency($product->price) }} VND
                                @endif
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>