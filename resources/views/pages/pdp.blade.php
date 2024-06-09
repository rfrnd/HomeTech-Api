
@extends('layouts.app-public')
@section('title', 'Product Detail')
@section('content')
<div class="site-wrapper-reveal">

    <div class="single-product-wrap section-space--pt_90 border-bottom pb-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                    <!-- product details left -->
                    <div class="product-details-left">
                        <div class="product-details-images-2 slider-lg-image-2">
                            <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{asset('assets/images/product/single-product-01.webp')}}"class="poppu-img product-img-main-href">
                                        <img src="{{asset('assets/images/product/single-product-01.webp')}}" class="img-fluid product-img-main-src" alt="">
                                    </a>
                                </div>
                            </div>
                            @for($i=0;$i<3;$i++)
                            <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{asset('assets/images/product/single-product-02.webp')}}"class="poppu-img">
                                        <img src="{{asset('assets/images/product/single-product-03.webp')}}" class="img-fluid" alt="">
                                    </a>
                                </div>
                            </div>
                            @endfor

                        </div>
                        <div class="product-details-thumbs-2 slider-thumbs-2">
                            <div class="sm-image"><img src="{{asset('assets/images/product/small/1-100x100.webp')}}" alt="product image thumb" class="product-img-main-src"></div>
                            @for($i=0;$i<3;$i++)
                            <div class="sm-image"><img src="{{asset('assets/images/product/small/2-100x100.webp')}}" alt="product image thumb"></div>
                            @endfor
                        </div>
                    </div>
                    <!-- product details left -->
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                    <div class="product-details-content">

                        <h5 class="font-weight--reguler mb-10" id="product-name"></h5>
                        <div class="quickview-ratting-review mb-10">
                            <div class="quickview-ratting-wrap">
                                <div class="quickview-ratting" id="product-review-stars"></div>
                                <a href="#" id="product-review-body-count"></a>
                            </div>
                        </div>
                        <h3 class="price" id="product-price"></h3>
                        <div class="stock mt-10" id="product-status-stock"></div>
                        <div class="quickview-peragraph mt-10"><p id="product-description"></p></div>

                        <div class="quickview-action-wrap mt-30">
                            <div class="quickview-cart-box">
                                <div class="quickview-quality product-add-to-cart">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="0">
                                    </div>
                                </div>
                                <div class="text-color-primary product-add-to-cart-is-disabled" style="display:none;font-size:10px">
                                    You may cant buy this item now, but keep it on your wishlist so we can remind you when in stock
                                </div>
                                <div class="quickview-button">
                                    <div class="quickview-cart button product-add-to-cart">
                                        <button type="button" class="btn--lg btn--black font-weight--reguler text-white">
                                            Add to cart
                                        </button>
                                    </div>
                                    <div class="quickview-wishlist button">
                                        <a title="Add to wishlist" href="#"><i class="icon-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product_meta mt-30">
                            <div class="posted_in item_meta">
                                <span class="label">Brand: </span>
                                <span id="product-brand" class="text-color-primary"></span>
                            </div>
                            <div class="tagged_as item_meta">
                                <span class="label">Tag: </span>
                                <span id="product-tags"></span>
                            </div>
                        </div>

                        <div class="product_socials section-space--mt_60">
                            <span class="label">Share this items :</span>
                            <ul class="helendo-social-share socials-inline">
                                <li>
                                    <a class="share-facebook helendo-facebook" href="#" target="_blank">
                                        <i class="social_facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="share-twitter helendo-twitter" href="#" target="_blank">
                                        <i class="social_twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="share-instagram helendo-instagram" href="#" target="_blank">
                                        <i class="social_instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('pages/js/pdp.js')}}"></script>
@endsection
