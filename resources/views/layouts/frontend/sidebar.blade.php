<!-- start of hero -->
<section class="static-hero">
    <div class="container-fluid">
        <div class="static-hero-wrap">
            <div class="row">

                {{-- <div class="col-lg-12">
                    <div class="static-hero-left" >
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="hero-content">
                                    <span class="wow fadeInUp" data-wow-duration="1000ms">100% Premium
                                        Quality</span>
                                    <h2 class="wow fadeInUp" data-wow-duration="1200ms">New Antibacterial
                                        Surgical Mask</h2>
                                    <p class="wow fadeInUp" data-wow-duration="1400ms">when unknown printer took
                                        a galley type scramble</p>
                                    <ul class="wow fadeInUp" data-wow-duration="1600ms">
                                        <li>$50.00 -</li>
                                        <li> $62.00</li>
                                    </ul>
                                    <a href="shop.html" class="btn-style-1 wow fadeInUp"
                                        data-wow-duration="1800ms">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="hero-img wow fadeInRightSlow" data-wow-duration="1600ms">
                                    <img src="{{ asset('frontend/assets/images/hero/mask.png') }}" alt="">
                                    <div class="save-wrap">
                                        <div class="save-inner">
                                            <p>SAVE 80% OFF</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blur-shape">
                            <svg xmlns="http://www.w3.org/2000/svg" width="586" height="586"
                                viewBox="0 0 586 586" fill="none">
                                <g filter="url(#filter0_f_98_52)">
                                    <circle cx="293" cy="293" r="75" fill="#5D7B1A" />
                                </g>
                                <defs>
                                    <filter id="filter0_f_98_52" x="0.600006" y="0.600006" width="584.8"
                                        height="584.8" filterUnits="userSpaceOnUse"
                                        color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix"
                                            result="shape" />
                                        <feGaussianBlur stdDeviation="108.7"
                                            result="effect1_foregroundBlur_98_52" />
                                    </filter>
                                </defs>
                            </svg>
                        </div>
                        <div class="p-shape">
                            <img src="{{ asset('frontend/assets/images/hero/shape.png') }}" alt="">
                        </div>

                    </div>
                </div> --}}
                {{-- <div class="col-lg-3 col">
                    <div class="static-hero-right">
                        <div class="static-hero-right-text">
                            <span>Thermometer</span>
                            <h3>Digital Sx-1R</h3>
                        </div>
                        <div class="hero-img wow fadeInRightSlow" data-wow-duration="1600ms">
                            <img src="{{ asset('frontend/assets/images/hero/img-1.png') }}" alt="">
                        </div>
                        <div class="rate-wrap">
                            <ul class="wow fadeInUp" data-wow-duration="1600ms">
                                <li>$50.00 -</li>
                                <li> $62.00</li>
                            </ul>
                            <a href="shop.html" class="btn-style-1 wow fadeInUp" data-wow-duration="1800ms">Shop
                                Now</a>
                        </div>
                    </div>
                </div> --}}

                <div class="col-12">
                    <div class="hero-slider-img">
                        @forelse ($banners as $banner)
                            <div>
                                <div class="static-hero-left">
                                    <a href="{{ $banner->url }}">
                                        <img src="{{ $banner->img ? asset('uploads/banner/' . $banner->img) : asset('frontend/assets/default/hero-slider.png') }}" width="1904px" height="563px" alt="">
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div>
                                <div class="static-hero-left">
                                    <img src="{{ asset('frontend/assets/default/hero-slider.png') }}" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="static-hero-left">
                                    <img src="{{ asset('frontend/assets/default/hero-slider.png') }}" alt="">
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of hero slider -->

@push('js')
    <script>
        $('.hero-slider-img').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            autoplay: true,
            arrows: false,
            autoplaySpeed: 6000,
            fade: true,
            cssEase: 'linear'
        });

        // Function to zoom the current slide's image
        function zoomCurrentSlideImage() {
            $('.hero-slider-img .slick-current img').css({
                'transform': 'scale(1.1)', // Adjust the scale factor as needed
                'transition': 'transform 6s ease' // Adjust the transition duration as needed
            });
        }

        // Function to reset the zoom on the current slide's image
        function resetZoomCurrentSlideImage() {
            $('.hero-slider-img .slick-current img').css({
                'transform': 'scale(1)',
                'transition': 'transform 6s ease'
            });
        }

        // Trigger zoom effect when slide changes
        $('.hero-slider-img').on('beforeChange', function(event, slick, currentSlide, nextSlide){
            resetZoomCurrentSlideImage(); // Reset zoom on the current slide's image
        });

        $('.hero-slider-img').on('afterChange', function(event, slick, currentSlide){
            zoomCurrentSlideImage(); // Zoom the current slide's image
        });

        $(document).ready(function(){
            zoomCurrentSlideImage();
        });

    </script>
@endpush
