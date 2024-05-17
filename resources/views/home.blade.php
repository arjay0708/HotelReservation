<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ URL('/img/icon.png') }}" type="image/x-icon">
    <title>HOSS</title>
    @include('cdn')
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/home/superfish.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/cs-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/cs-skin-border.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/style.css') }}">
    {{-- CSS --}}
</head>

<body>
    {{-- CONTENT --}}
    <div id="fh5co-wrapper">
        <div id="fh5co-page">
            <div id="fh5co-header">
                <header id="fh5co-header-section">
                    <div class="container">
                        <div class="nav-header">
                            <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
                            <h1 id="fh5co-logo"><a href="#">HOSS Application</a></h1>
                            <nav id="fh5co-menu-wrap" role="navigation">
                                <ul class="sf-menu" id="fh5co-primary-menu">
                                    <li><a class="active" href="#">Home</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Testimonials</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </header>
            </div>
            <aside id="fh5co-hero" class="js-fullheight">
                <div class="flexslider js-fullheight">
                    <ul class="slides">
                        <li style="background-image: url(img/bg1.jpeg);">
                            <div class="overlay-gradient"></div>
                            <div class="container">
                                <div class="col-md-12 col-md-offset-0 text-center slider-text">
                                    <div class="slider-text-inner js-fullheight">
                                        <div class="desc">
                                            <p><span>Beach Resort</span></p>
                                            <h2>Reserve Room for Family Vacation</h2>
                                            <p>
                                                <a href="/login" class="btn btn-primary btn-lg">Book Now</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li style="background-image: url(img/bg2.jpeg);">
                            <div class="overlay-gradient"></div>
                            <div class="container">
                                <div class="col-md-12 col-md-offset-0 text-center slider-text">
                                    <div class="slider-text-inner js-fullheight">
                                        <div class="desc">
                                            <p><span>Beach Resort</span></p>
                                            <h2>Make Your Vacation Comfortable</h2>
                                            <p>
                                                <a href="/login" class="btn btn-primary btn-lg">Book Now</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li style="background-image: url(img/bg3.jpeg);">
                            <div class="overlay-gradient"></div>
                            <div class="container">
                                <div class="col-md-12 col-md-offset-0 text-center slider-text">
                                    <div class="slider-text-inner js-fullheight">
                                        <div class="desc">
                                            <p><span>Beach Resort</span></p>
                                            <h2>A Best Place To Enjoy Your Life</h2>
                                            <p>
                                                <a href="/login" class="btn btn-primary btn-lg">Book Now</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </aside>
            <div id="fh5co-counter-section" class="fh5co-counters mt-5 pt-5">
                <div class="container-fluid mt-5 pt-5">
                    <div class="row mt-5 pt-5">
                        <div class="col-md-3 text-center">
                            <span class="fh5co-counter js-counter" data-from="0" data-to="20356" data-speed="5000"
                                data-refresh-interval="50"></span>
                            <span class="fh5co-counter-label">User Access</span>
                        </div>
                        <div class="col-md-3 text-center">
                            <span class="fh5co-counter js-counter" data-from="0" data-to="120" data-speed="5000"
                                data-refresh-interval="50"></span>
                            <span class="fh5co-counter-label">Room</span>
                        </div>
                        <div class="col-md-3 text-center">
                            <span class="fh5co-counter js-counter" data-from="0" data-to="8200" data-speed="5000"
                                data-refresh-interval="50"></span>
                            <span class="fh5co-counter-label">Transactions</span>
                        </div>
                        <div class="col-md-3 text-center">
                            <span class="fh5co-counter js-counter" data-from="0" data-to="8763" data-speed="5000"
                                data-refresh-interval="50"></span>
                            <span class="fh5co-counter-label">Rating &amp; Review</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="featured-hotel" class="fh5co-bg-color">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center">
                                <h2>Featured Hotels</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="feature-full-1col">
                            <div class="image" style="background-image: url(img/hotel1.jpeg);">
                                <div class="descrip text-center">
                                    <p><small>For as low as</small><span>₱600/hour</span></p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3>Room 001</h3>
                                <p>Pellentesque habitant morbi tristique senectus et netus ett mauada fames ac turpis
                                    egestas. Etiam euismod tempor leo, in suscipit urna condimentum sed. Vivamus augue
                                    enim, consectetur ac interdum a, pulvinar ac massa. Nullam malesuada congue </p>
                                <p><a href="#" class="btn btn-primary btn-luxe-primary">Book Now <i
                                            class="ti-angle-right"></i></a></p>
                            </div>
                        </div>

                        <div class="feature-full-2col">
                            <div class="f-hotel">
                                <div class="image" style="background-image: url(img/hotel2.webp);">
                                    <div class="descrip text-center">
                                        <p><small>For as low as</small><span>₱400/hour</span></p>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h3>Room 002</h3>
                                    <p>Pellentesque habitant morbi tristique senectus et netus ett mauada fames ac
                                        turpis egestas. Etiam euismod tempor leo,
                                        in suscipit urna condimentum sed. </p>
                                    <p><a href="#" class="btn btn-primary btn-luxe-primary">Book Now <i
                                                class="ti-angle-right"></i></a></p>
                                </div>
                            </div>
                            <div class="f-hotel">
                                <div class="image" style="background-image: url(img/hotel3.jpeg);">
                                    <div class="descrip text-center">
                                        <p><small>For as low as</small><span>₱700/hour</span></p>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h3>Room 003</h3>
                                    <p>Pellentesque habitant morbi tristique senectus et netus ett mauada fames ac
                                        turpis egestas. Etiam euismod tempor leo, in suscipit urna condimentum sed. </p>
                                    <p><a href="#" class="btn btn-primary btn-luxe-primary">Book Now <i
                                                class="ti-angle-right"></i></a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="hotel-facilities">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center">
                                <h2>Hotel Facilities</h2>
                            </div>
                        </div>
                    </div>

                    <div id="tabs">
                        <nav class="tabs-nav">
                            <a href="#" class="active" data-tab="tab1">
                                <i class="flaticon-restaurant icon"></i>
                                <span>Restaurant</span>
                            </a>
                            <a href="#" data-tab="tab2">
                                <i class="flaticon-cup icon"></i>
                                <span>Bar</span>
                            </a>
                            <a href="#" data-tab="tab3">

                                <i class="flaticon-car icon"></i>
                                <span>Pick-up</span>
                            </a>
                            <a href="#" data-tab="tab4">

                                <i class="flaticon-swimming icon"></i>
                                <span>Swimming Pool</span>
                            </a>
                            <a href="#" data-tab="tab5">

                                <i class="flaticon-massage icon"></i>
                                <span>Spa</span>
                            </a>
                            <a href="#" data-tab="tab6">

                                <i class="flaticon-bicycle icon"></i>
                                <span>Gym</span>
                            </a>
                        </nav>
                        <div class="tab-content-container">
                            <div class="tab-content active show" data-tab-content="tab1">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="img/restaurant.jpeg" class="img-responsive" alt="Image"
                                                style="height: 72%; width:100%;">
                                        </div>
                                        <div class="col-md-6">
                                            <span class="super-heading-sm">World Class</span>
                                            <h3 class="heading">Restaurant</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias
                                                officia perferendis modi impedit, rem quasi veritatis. Consectetur
                                                obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia,
                                                labore, reprehenderit illum dolorem quae facilis reiciendis quas
                                                similique totam sequi ducimus temporibus ex nemo, omnis perferendis
                                                earum fugit impedit molestias animi vitae.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam
                                                neque blanditiis eveniet nesciunt, beatae similique doloribus, ex
                                                impedit rem officiis placeat dignissimos molestias temporibus, in!
                                                Minima quod, consequatur neque aliquam.</p>
                                            <p class="service-hour">
                                                <span>Service Hours</span>
                                                <strong>7:30 AM - 8:00 PM</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" data-tab-content="tab2">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="img/bar.jpeg" class="img-responsive" alt="Image"
                                                style="height: 60%; width:100%;">
                                        </div>
                                        <div class="col-md-6">
                                            <span class="super-heading-sm">World Class</span>
                                            <h3 class="heading">Bars</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias
                                                officia perferendis modi impedit, rem quasi veritatis. Consectetur
                                                obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia,
                                                labore, reprehenderit illum dolorem quae facilis reiciendis quas
                                                similique totam sequi ducimus temporibus ex nemo, omnis perferendis
                                                earum fugit impedit molestias animi vitae.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam
                                                neque blanditiis eveniet nesciunt, beatae similique doloribus, ex
                                                impedit rem officiis placeat dignissimos molestias temporibus, in!
                                                Minima quod, consequatur neque aliquam.</p>
                                            <p class="service-hour">
                                                <span>Service Hours</span>
                                                <strong>7:30 AM - 8:00 PM</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" data-tab-content="tab3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="img/parking.jpeg" class="img-responsive" alt="Image"
                                                style="height: 96%; width:100%;">
                                        </div>
                                        <div class="col-md-6">
                                            <span class="super-heading-sm">World Class</span>
                                            <h3 class="heading">Pick Up</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias
                                                officia perferendis modi impedit, rem quasi veritatis. Consectetur
                                                obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia,
                                                labore, reprehenderit illum dolorem quae facilis reiciendis quas
                                                similique totam sequi ducimus temporibus ex nemo, omnis perferendis
                                                earum fugit impedit molestias animi vitae.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam
                                                neque blanditiis eveniet nesciunt, beatae similique doloribus, ex
                                                impedit rem officiis placeat dignissimos molestias temporibus, in!
                                                Minima quod, consequatur neque aliquam.</p>
                                            <p class="service-hour">
                                                <span>Service Hours</span>
                                                <strong>7:30 AM - 8:00 PM</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" data-tab-content="tab4">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="img/pool.jpeg" class="img-responsive" alt="Image"
                                                style="height: 80%; width:100%;">
                                        </div>
                                        <div class="col-md-6">
                                            <span class="super-heading-sm">World Class</span>
                                            <h3 class="heading">Swimming Pool</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias
                                                officia perferendis modi impedit, rem quasi veritatis. Consectetur
                                                obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia,
                                                labore, reprehenderit illum dolorem quae facilis reiciendis quas
                                                similique totam sequi ducimus temporibus ex nemo, omnis perferendis
                                                earum fugit impedit molestias animi vitae.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam
                                                neque blanditiis eveniet nesciunt, beatae similique doloribus, ex
                                                impedit rem officiis placeat dignissimos molestias temporibus, in!
                                                Minima quod, consequatur neque aliquam.</p>
                                            <p class="service-hour">
                                                <span>Service Hours</span>
                                                <strong>7:30 AM - 8:00 PM</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" data-tab-content="tab5">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="img/spa.jpg" class="img-responsive" alt="Image"
                                                style="height: 70%; width:100%;">
                                        </div>
                                        <div class="col-md-6">
                                            <span class="super-heading-sm">World Class</span>
                                            <h3 class="heading">Spa</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias
                                                officia perferendis modi impedit, rem quasi veritatis. Consectetur
                                                obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia,
                                                labore, reprehenderit illum dolorem quae facilis reiciendis quas
                                                similique totam sequi ducimus temporibus ex nemo, omnis perferendis
                                                earum fugit impedit molestias animi vitae.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam
                                                neque blanditiis eveniet nesciunt, beatae similique doloribus, ex
                                                impedit rem officiis placeat dignissimos molestias temporibus, in!
                                                Minima quod, consequatur neque aliquam.</p>
                                            <p class="service-hour">
                                                <span>Service Hours</span>
                                                <strong>7:30 AM - 8:00 PM</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" data-tab-content="tab6">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="img/Gym.jpeg" class="img-responsive" alt="Image"
                                                style="height: 70%; width:100%;">
                                        </div>
                                        <div class="col-md-6">
                                            <span class="super-heading-sm">World Class</span>
                                            <h3 class="heading">Gym</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias
                                                officia perferendis modi impedit, rem quasi veritatis. Consectetur
                                                obcaecati incidunt, quae rerum, accusamus sapiente fuga vero at. Quia,
                                                labore, reprehenderit illum dolorem quae facilis reiciendis quas
                                                similique totam sequi ducimus temporibus ex nemo, omnis perferendis
                                                earum fugit impedit molestias animi vitae.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam
                                                neque blanditiis eveniet nesciunt, beatae similique doloribus, ex
                                                impedit rem officiis placeat dignissimos molestias temporibus, in!
                                                Minima quod, consequatur neque aliquam.</p>
                                            <p class="service-hour">
                                                <span>Service Hours</span>
                                                <strong>7:30 AM - 8:00 PM</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="testimonial">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center">
                                <h2>Happy Customer Says...</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="testimony">
                                <blockquote>
                                    &ldquo;If you’re looking for a top quality hotel look no further. We were upgraded
                                    free of charge to the Premium Suite, thanks so much&rdquo;
                                </blockquote>
                                <p class="author"><cite>Noel John Ervas</cite></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="testimony">
                                <blockquote>
                                    &ldquo;Me and my wife had a delightful weekend get away here, the staff were so
                                    friendly and attentive. Highly Recommended&rdquo;
                                </blockquote>
                                <p class="author"><cite>Reginald Julius Ogaya</cite></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="testimony">
                                <blockquote>
                                    &ldquo;If you’re looking for a top quality hotel look no further. We were upgraded
                                    free of charge to the Premium Suite, thanks so much&rdquo;
                                </blockquote>
                                <p class="author"><cite>Maxine Ogale</cite></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="fh5co-blog-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center">
                                <h2>Our Blog</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="blog-grid" style="background-image: url(img/blog1.jpeg);">
                                <div class="date text-center">
                                    <span>27</span>
                                    <small>MAY</small>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="#">Most Beautiful Hotel</a></h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="blog-grid" style="background-image: url(img/blog2.jpeg);">
                                <div class="date text-center">
                                    <span>27</span>
                                    <small>MAY</small>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="#">1st Anniversary of HOSS Application</a></h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="blog-grid" style="background-image: url(img/blog3.jpeg);">
                                <div class="date text-center">
                                    <span>27</span>
                                    <small>MAY</small>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="#">Book Now</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer id="footer" class="fh5co-bg-color">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="copyright">
                                <p><small>&copy; 2023 Hoss <br> All Rights Reserved. <br>
                                        Designed by <a href="#" target="_blank">GC CCS DEVS</a> <br> Block:
                                        <a href="http://unsplash.com/" target="_blank">BSIT 3</a></small></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h3>Company</h3>
                                    <ul class="link">
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Hotels</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                        <li><a href="/dataPrivacy">Data Privacy</li>
                                        <li><a href="/privacyPolicy">Terms / Policy</a></li>
                                        <li><a href="/notesRemarks">Remarks</a></li>
                                        <li><a href="/adminLogin">Administrator</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h3>Our Facilities</h3>
                                    <ul class="link">
                                        <li><a href="#">Resturant</a></li>
                                        <li><a href="#">Bars</a></li>
                                        <li><a href="#">Pick-up</a></li>
                                        <li><a href="#">Swimming Pool</a></li>
                                        <li><a href="#">Spa</a></li>
                                        <li><a href="#">Gym</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h3>Subscribe</h3>
                                    <p>Sed cursus ut nibh in semper. Mauris varius et magna in fermentum. </p>
                                    <form action="#" id="form-subscribe">
                                        <div class="form-field">
                                            <input type="email" placeholder="Email Address" id="email">
                                            <input type="submit" id="submit" value="Send">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <ul class="social-icons">
                                <li>
                                    <a href="#"><i class="icon-twitter-with-circle"></i></a>
                                    <a href="#"><i class="icon-facebook-with-circle"></i></a>
                                    <a href="#"><i class="icon-instagram-with-circle"></i></a>
                                    <a href="#"><i class="icon-linkedin-with-circle"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    {{-- CONTENT --}}

    {{-- JS --}}
    <script src="{{ asset('js/home/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/home/hoverIntent.js') }}"></script>
    <script src="{{ asset('js/home/superfish.js') }}"></script>
    <script src="{{ asset('js/home/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/home/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/home/jquery.countTo.js') }}"></script>
    <script src="{{ asset('js/home/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/home/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/home/classie.js') }}"></script>
    <script src="{{ asset('js/home/selectFx.js') }}"></script>
    <script src="{{ asset('js/home/jquery.flexslider-min.js') }}"></script>
    <script src="{{ asset('js/home/custom.js') }}"></script>
    <script src="{{ asset('js/home/modernizr-2.6.2.min.js') }}"></script>
    {{-- JS --}}
</body>

</html>
