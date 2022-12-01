<?php
require './header.php';
?>
<!--Body Content-->
<div id="page-content">
    <!--Image Banners-->
    <div style="padding-top: 10%;" class="section imgBanners">
        <div class="imgBnrOuter">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 pl-0 image-banner-1">
                        <div class="inner topleft">
                            <a href="#">
                                <img src="assets/images/collection/image-banner-home15-1.jpg" alt="200+ NEW ARRIVALS"
                                    title="200+ NEW ARRIVALS" class="blur-up lazyload" />
                                <div class="ttl">
                                    <h3>200+ NEW ARRIVALS</h3> Discover the latest designes and beauty of hand art
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 pr-0 image-banner-2">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 image-banner-3">
                                <div class="inner topleft">
                                    <a href="#">
                                        <img src="assets/images/collection/image-banner-home15-2.jpg" alt="DINNER TABLE"
                                            title="DINNER TABLE" class="blur-up lazyload" />
                                        <div class="ttl">
                                            <h5>CHAIR COVER</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="inner topleft">
                                    <a href="#">
                                        <img src="assets/images/collection/image-banner-home15-3.jpg"
                                            alt="PENDANT LIGHT" title="PENDANT LIGHT" class="blur-up lazyload" />
                                        <div class="ttl">
                                            <h5>PENDANT LIGHT COVER</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4">
                                <div class="inner topleft">
                                    <a href="#">
                                        <img src="assets/images/collection/image-banner-home15-4.jpg"
                                            alt="200+ NEW ARRIVALS" title="200+ NEW ARRIVALS"
                                            class="blur-up lazyload" />
                                        <div class="ttl">
                                            <h5> MID-SUMMER SALE</h5> Up to 50% off
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Image Banners-->

    <!--Custom Image Banner-->
    <div class="section imgBanners">
        <div class="container-fluid">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <a href="#">
                    <img src="assets/images/collection/image-banner-home15-5.jpg" alt="Save Big On Popular Designs"
                        title="Save Big On Popular Designs" class="blur-up lazyload" />
                </a>
            </div>
        </div>
    </div>
    <!--Custom Image Banner-->

    <!--Hand-picked Items-->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Hand-picked Items</h2>
                        <p>Furniture should always be comfortable.<br>And always have a piece of art that you made
                            somewhere in the home.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- PRODUCTS -->
        <div class="grid-products">
            <div class="row">
                <?php
                $stmt = $database->prepare("SELECT * FROM products WHERE IsDelete IS NULL");
                $stmt->execute();
                $cat = $stmt->fetchAll(PDO::FETCH_ASSOC);
                shuffle($cat);
                foreach ($cat as $c) {
                    $images = array_values(array_diff(scandir($c['ImagesPath']), array('.', '..')));
                    $p = $images;
                ?>

                <div class="col-6 col-sm-6 col-md-4 col-lg-4 item grid-view-item style2">
                    <div class="grid-view_image">
                        <!-- start product image -->
                        <a href="product-accordion.php?id=<?= $c['ID'] ?>" class="grid-view-item__link">
                            <!-- image -->
                            <img class="col-8 col-sm-10 col-md-10 col-lg-10 grid-view-item__image primary blur-up lazyload"
                                data-src="<?= $c['ImagesPath'] . $p[0] ?>" src="<?= $c['ImagesPath'] . $p[0] ?>"
                                alt="image" title="product">
                            <!-- End image -->
                            <!-- Hover image -->
                            <img class="col-8 col-sm-10 col-md-10 col-lg-10 grid-view-item__image hover blur-up lazyload"
                                data-src="<?= $c['ImagesPath'] . $p[1] ?>" src="<?= $c['ImagesPath'] . $p[1] ?>"
                                alt="image" title="product">
                            <!-- End hover image -->
                            <!-- product label -->
                            <!-- End product label -->
                        </a>
                        <!-- end product image -->
                        <!--start product details -->

                        <div class="product-details hoverDetails text-center mobile">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="product-accordion.php?id=<?= $c['ID'] ?>"><?= $c['Name'] ?></a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                                <span class="old-price">₹<?= $c['Price'] * 1.1 ?></span>
                                <span class="price">₹<?= $c['Price'] ?></span>
                            </div>
                            <!-- End product price -->
                        </div>
                        <!-- End product details -->
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!--End Product-->


</div>
<!--End Body Content-->

<!-- Including Jquery -->
<script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="assets/js/vendor/jquery.cookie.js"></script>
<script src="assets/js/vendor/wow.min.js"></script>
<!-- Including Javascript -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/lazysizes.js"></script>
<script src="assets/js/main.js"></script>
</div>
<?php
require './footer.php';
?>