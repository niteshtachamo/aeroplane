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
                                    <h1 class="title">This is heading</h1>
                                    <p>Lorem ipsum dolor sit amet.</p>
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
                                    <p></p>
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
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quas inventore eos, est fugit rerum facere nulla illo tempora aperiam quis provident asperiores maxime perspiciatis architecto nobis nam placeat nesciunt!</p>
                    <div class="btn-wrap">
                        <a href="#" title="" class="btn-box primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="right-content">
                <div class="image">
                    <img src="./image/images.jpeg" class="img-cover" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-section section-gaps bg-light">
    <div class="container">
        <div class="main-title center">
            <h2 class="title">Our product</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis vel error commodi modi illum vitae iusto, dignissimos asperiores alias quo!</p>
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