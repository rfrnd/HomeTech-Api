@extends('layouts.app-public')
@section('title', 'Home')
@section('content')
    <div class="site-wrapper-reveal">
        <div class="hero-box-area">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <!-- hero slider area start -->
                        <div class="hero-area" id="product-preview">
                        </div>
                        <!-- hero slider area end -->
                    </div>
                </div>
            </div>
        </div>

        <div class="about-us-area section-space--ptb_120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-us-content_6 text-center">
                            <h2>Hometech.&nbsp;&nbsp;Store</h2>
                            <p>
                                <small>
                                Elevate your living space with cutting-edge home technology from our meticulously curated collection. Whether you're a smart home novice or a seasoned tech enthusiast, our knowledgeable team is dedicated to helping you unlock the full potential of intelligent automation. Step into our immersive showroom, where innovation meets intuitive design, and explore a world of possibilities tailored to your unique lifestyle. Join our vibrant community of forward-thinkers, and let us be your guide on this exhilarating journey into the future of connected living. Discover the perfect blend of convenience, efficiency, and sophistication - all under one roof. Experience the thrill of bringing your home into the 21st century today &#10084;
                                </small>  
                            </p>
                            <p class="mt-5">Find your window to the world! Or, even, 
                                <span class="text-color-primary">unlock hidden worlds, one page at a time!</span> 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- banner bideo area start -->
        <div class="banner-video-area overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-video-box">
                            <img src="https://www.magd.ox.ac.uk/wp-content/uploads/2022/07/3027-052-2000x1000.jpg" alt="">
                            <div class="video-icon">
                                <a href="https://youtu.be/Na5KPnx0uS8?si=PPoJfum8xG-Jt8h9" class="popup-youtube"><i class="linear-ic-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- baneer video area end-->

        <!-- our brand area start -->
        <div class="our-brand-area section-space--pb_90">
        <div class="container">
            <div class="brand-slider-active">
                @php
                    $partner_count = 8;
                @endphp
                @for($i = 1; $i <= $partner_count; $i++)
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb{{ $i }}.jpg" class="img-fluid" alt="Partner Images"></a>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="our-member-area section-space--pb_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="member--box">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-4">
                                <div class="section-title small-mb__40 tablet-mb__40">
                                    <h4 class="section-title">Join the community!</h4>
                                    <p>Become one of the member and get discount 50% off</p>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-8">
                                <div class="member-wrap">
                                    <form action="#" class="member--two">
                                        <input class="input-box" type="text" placeholder="Your email address">
                                        <button class="submit-btn"><i class="icon-arrow-right"></i></button>
                                    </form>
                                </div>
                            </div>
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
<script src="{{asset('pages/js/home.js')}}"></script>
@endsection