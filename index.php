<?php 
include('header.php');
include("function/commonfunction.php");
?>
<!-- header -->

<section class="banner-section">
    <div class="splide banner-slide">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <div class="banner" style="background-image: url(./image/photo-1529074963764-98f45c47344b.jpeg);">
                        <div class="container">
                            <div class="banner-content">
                                <div class="main-title">
                                    <h1 class="title">AERO ACES</h1>
                                    <p>Every takeoff is optional. Every landing is mandatory.</p>
                                    <div class="btn-wrap">
                                        <a href="#" class="btn-box primary-btn" title>Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="banner" style="background-image: url(./image/How-Fast-Do-Helicopters-Fly.jpg);">
                        <div class="container">
                            <div class="banner-content">
                                <div class="main-title">
                                    <h1 class="title"></h1>
                                    <p>A SOLUTION FOR EVERY SKY</p>
                                    <div class="btn-wrap">
                                        <a href="#" class="btn-box primary-btn" title>Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="two-col-section section-gaps">
    <div class="container">
        <div class="content-wrap">
            <div class="left-content">
                <div class="two-col-content">
                    <h2 class="title">About</h2>
                    <p>Welcome to Aero Aces, your premier destination for all things aviation! We specialize in offering a wide range of aircraft, aviation accessories, and services tailored for enthusiasts, professionals, and businesses. Whether you're looking for cutting-edge commercial planes, private jets, or essential parts and tools, we have you covered. Our mission is to make aviation accessible and seamless by providing high-quality products and exceptional customer support. With a team of experts passionate about flying, Aero Aces ensures reliability, innovation, and trust in every transaction. Explore the skies with us and discover why we’re the go-to choice for aviation commerce.</p>
                    <div class="btn-wrap">
                        <a href="#" title="" class="btn-box primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="right-content">
                <div class="image">
                    <img src="./image/cute-yellow-jet-plane-vector-47790793.jpg" class="img-cover" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-section section-gaps bg-light">
    <div class="container">
        <div class="main-title center">
            <h2 class="title">Our product</h2>
            <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis vel error commodi modi illum vitae iusto, dignissimos asperiores alias quo!</p> -->
        </div>
        <div class="row g-4">
            <?php displayProducts(4)?>
        </div>
    </div>
</section>

<section class="our-brand-section section-gaps">
    <div class="container">
        <div class="main-title center">
            <h2 class="title">Our brand</h2>
            <!-- <p>Lorem ipsum dolor sit amet.</p> -->
        </div>
        <div class="splide our-brand-slide">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <div class="our-brand-item">
                            <img src="./image/bombardier.png" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="our-brand-item">
                            <img src="./image/boeing.png" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="our-brand-item">
                            <img src="./image/aircrafttsmen.png" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="our-brand-item">
                            <img src="./image/dessault.webp" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="our-brand-item">
                            <img src="./image/airbus.png" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="our-brand-item">
                            <img src="./image/company1.jpg" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="our-brand-item">
                            <img src="./image/jetliner.webp"alt="">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<?php include('footer.php')?>