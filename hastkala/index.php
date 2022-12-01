<?php
require './header.php';
if (isset($_SESSION['Usertype'])) {
    if ($_SESSION['Usertype'] == "admin") {
        echo ("<script>
                window.location.href='./admin.php'
            </script>");
    }
}
?>
<title>Hastkala home</title>
<!--Body Content-->
<div id="page-content">
    <!--Home slider-->
    <div class="slideshow slideshow-wrapper pb-section sliderFull">
        <div class="home-slideshow">
            <div class="slide">
                <div class="blur-up lazyload bg-size">
                    <img class="blur-up lazyload bg-img"
                        data-src="assets/images/iamges/earthen/photo-1493106641515-6b5631de4bb9.jpg"
                        src="assets/images/iamges/earthen/photo-1493106641515-6b5631de4bb9.jpg"
                        alt="Shop Our New Collection" title="Shop Our New Collection" />
                    <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                        <div class="slideshow__text-content bottom">
                            <div class="wrap-caption center">
                                <h2 class="h1 mega-title slideshow__title">Shop Our New Collection</h2>
                                <span class="mega-subtitle slideshow__subtitle">From Hight to low, classic or modern. We
                                    have you covered</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide">
                <div class="blur-up lazyload bg-size">
                    <img class="blur-up lazyload bg-img"
                        data-src="assets/images/iamges/slider/wallpaperflare.com_wallpaper.jpg"
                        src="assets/images/iamges/slider/wallpaperflare.com_wallpaper.jpg"
                        alt="Summer Bikini Collection" title="Summer Bikini Collection" />
                    <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                        <div class="slideshow__text-content bottom">
                            <div class="wrap-caption center">
                                <h2 class="h1 mega-title slideshow__title">Executive Collection</h2>
                                <span class="mega-subtitle slideshow__subtitle">Save up to 50% off this weekend
                                    only</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide">
                <div class="blur-up lazyload bg-size">
                    <img class="blur-up lazyload bg-img"
                        data-src="assets/images/iamges/home/wallpaperflare.com_wallpaper.jpg"
                        src="assets/images/iamges/home/wallpaperflare.com_wallpaper.jpg" alt="Summer Bikini Collection"
                        title="Summer Bikini Collection" />
                    <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                        <div class="slideshow__text-content bottom">
                            <div class="wrap-caption center">
                                <h2 class="h1 mega-title slideshow__title">decorate the space</h2>
                                <span class="mega-subtitle slideshow__subtitle">Save up to 50% off this weekend
                                    only</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Home slider-->
    <!--Collection Tab slider-->
    <div class="tab-slider-product section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">New Fashion Arrivals</h2>
                        <p>Browse the huge variety of our products</p>
                    </div>
                    <div class="tabs-listing">
                        <ul class="tabs clearfix">
                            <li class="active" rel="tab1">Women</li>
                            <li rel="tab2">Men</li>
                            <!-- <li rel="tab3">Sale</li> -->
                        </ul>
                        <div class="tab_container">
                            <div id="tab1" class="tab_content grid-products">
                                <div class="productSlider">

                                    <?php
                                    $stmt = $database->prepare("SELECT * FROM products  WHERE ForGender='Female' AND IsDelete IS NULL");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    shuffle($result);
                                    foreach ($result as $row) {
                                        $images = array_values(array_diff(scandir($row['ImagesPath']), array('.', '..')));
                                        $i = $images;
                                    ?>


                                    <div class="col-12 item">
                                        <!-- start product image -->
                                        <div class="product-image">
                                            <!-- start product image -->
                                            <a href="product-accordion.php?id=<?= $row['ID'] ?>">
                                                <!-- image -->
                                                <img class="primary blur-up lazyload"
                                                    data-src="<?= $row['ImagesPath'] . $i[0] ?>"
                                                    src="<?= $row['ImagesPath'] . $i[0] ?>" alt="image" title="product">
                                                <!-- End image -->
                                                <!-- Hover image -->
                                                <img class="hover blur-up lazyload"
                                                    data-src="<?= $row['ImagesPath'] . $i[1] ?>"
                                                    src="<?= $row['ImagesPath'] . $i[1] ?>" alt="image" title="product">
                                                <!-- End hover image -->
                                            </a>
                                            <!-- end product image -->
                                        </div>
                                        <!-- end product image -->

                                        <!--start product details -->
                                        <div class="product-details text-center">
                                            <!-- product name -->
                                            <div class="product-name">
                                                <a href="product-accordion.php"><?= $row['Name'] ?></a>
                                            </div>
                                            <!-- End product name -->
                                            <!-- product price -->
                                            <div class="product-price">
                                                <span class="old-price">₹<?= $row['Price'] * 1.1 ?></span>
                                                <span class="price">₹<?= $row['Price'] ?></span>
                                            </div>
                                            <!-- End product price -->
                                        </div>
                                        <!-- End product details -->
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab_content grid-products">
                            <div class="productSlider">

                                <?php
                                $stmt = $database->prepare("SELECT * FROM products  WHERE ForGender='Male' AND IsDelete IS NULL");
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                shuffle($result);
                                foreach ($result as $row) {
                                    $images = array_values(array_diff(scandir($row['ImagesPath']), array('.', '..')));
                                    $i = $images;
                                ?>


                                <div class="col-12 item">
                                    <!-- start product image -->
                                    <div class="product-image">
                                        <!-- start product image -->
                                        <a href="product-accordion.php?id=<?= $row['ID'] ?>">
                                            <!-- image -->
                                            <img class="primary blur-up lazyload"
                                                data-src="<?= $row['ImagesPath'] . $i[0] ?>"
                                                src="<?= $row['ImagesPath'] . $i[0] ?>" alt="image" title="product">
                                            <!-- End image -->
                                            <!-- Hover image -->
                                            <img class="hover blur-up lazyload"
                                                data-src="<?= $row['ImagesPath'] . $i[1] ?>"
                                                src="<?= $row['ImagesPath'] . $i[1] ?>" alt="image" title="product">
                                            <!-- End hover image -->
                                        </a>
                                        <!-- end product image -->
                                    </div>
                                    <!-- end product image -->

                                    <!--start product details -->
                                    <div class="product-details text-center">
                                        <!-- product name -->
                                        <div class="product-name">
                                            <a href="product-accordion.php"><?= $row['Name'] ?></a>
                                        </div>
                                        <!-- End product name -->
                                        <!-- product price -->
                                        <div class="product-price">
                                            <span class="old-price">₹<?= $row['Price'] * 1.1 ?></span>
                                            <span class="price">₹<?= $row['Price'] ?></span>
                                        </div>
                                        <!-- End product price -->
                                    </div>
                                    <!-- End product details -->
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
    </div>
</div>
<!--Collection Tab slider-->

<!--Collection Box slider-->

<div class="collection-box section">
    <div class="container-fluid">
        <div class="collection-grid">
            <?php
            $stmt = $database->prepare("SELECT * FROM Categories WHERE ParentCategoryID IS NULL");
            $stmt->execute();
            $cat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($cat as $catdetails) {
                $categoryimages = array_values(array_diff(scandir($catdetails['ImagesPath']), array('.', '..')));
                // echo ($categoryimages);
            ?>
            <div class="collection-grid-item">
                <a href="categorys.php" class="collection-grid-item__link">
                    <img data-src="" src="<?= $catdetails['ImagesPath'] . $categoryimages[0] ?>" alt=""
                        class="blur-up lazyload" />
                    <div class="collection-grid-item__title-wrapper">
                        <h3 class="collection-grid-item__title btn btn--secondary no-border"><?= $catdetails['Name'] ?>
                        </h3>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!--End Collection Box slider-->
<!--Featured Product-->
<div class="product-rows section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="section-header text-center">
                    <h2 class="h2">Featured collection</h2>
                    <p>Our most popular products based on sales</p>
                </div>
            </div>
        </div>

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
<!--End Featured Product-->
<!--End Body Content-->
<?php
require './footer.php';
?>