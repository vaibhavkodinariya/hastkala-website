<?php
    require("./header.php");
?>
    <title>Hastkala home</title>
    <!--Body Content-->
    <div id="page-content">
    	<!--Home slider-->
    	<div class="slideshow slideshow-wrapper pb-section sliderFull">
        	<div class="home-slideshow">
            	<div class="slide">
                	<div class="blur-up lazyload bg-size">
                        <img class="blur-up lazyload bg-img" data-src="assets/images/iamges/earthen/photo-1493106641515-6b5631de4bb9.jpg" src="assets/images/iamges/earthen/photo-1493106641515-6b5631de4bb9.jpg" alt="Shop Our New Collection" title="Shop Our New Collection" />
                        <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                            <div class="slideshow__text-content bottom">
                                <div class="wrap-caption center">
                                        <h2 class="h1 mega-title slideshow__title">Shop Our New Collection</h2>
                                        <span class="mega-subtitle slideshow__subtitle">From Hight to low, classic or modern. We have you covered</span>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide">
                	<div class="blur-up lazyload bg-size">
                        <img class="blur-up lazyload bg-img" data-src="assets/images/iamges/slider/wallpaperflare.com_wallpaper.jpg" src="assets/images/iamges/slider/wallpaperflare.com_wallpaper.jpg" alt="Summer Bikini Collection" title="Summer Bikini Collection" />
                        <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                            <div class="slideshow__text-content bottom">
                                <div class="wrap-caption center">
                                    <h2 class="h1 mega-title slideshow__title">Executive Collection</h2>
                                    <span class="mega-subtitle slideshow__subtitle">Save up to 50% off this weekend only</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide">
                	<div class="blur-up lazyload bg-size">
                        <img class="blur-up lazyload bg-img" data-src="assets/images/iamges/home/wallpaperflare.com_wallpaper.jpg" src="assets/images/iamges/home/wallpaperflare.com_wallpaper.jpg" alt="Summer Bikini Collection" title="Summer Bikini Collection" />
                        <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                            <div class="slideshow__text-content bottom">
                                <div class="wrap-caption center">
                                    <h2 class="h1 mega-title slideshow__title">decorate the space</h2>
                                    <span class="mega-subtitle slideshow__subtitle">Save up to 50% off this weekend only</span>
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
                                            $stmt=$database->prepare("SELECT * FROM products  WHERE ForGender='Female'");
                                            $stmt->execute();
                                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            foreach($result as $row)
                                            {
                                                $images=array_values(array_diff(scandir($row['imagespath']),array('.','..')));
                                                $i=$images;
                                                ?>

                                            
                                            <div class="col-12 item">
                                            <!-- start product image -->
                                            <div class="product-image">
                                                <!-- start product image -->
                                                <a href="product-accordion.php">
                                                    <!-- image -->
                                                    <img class="primary blur-up lazyload" data-src="<?= $row['imagespath'].$i[0] ?>" src="<?= $row['imagespath'].$i[0] ?>" alt="image" title="product">
                                                    <!-- End image -->
                                                    <!-- Hover image -->
                                                    <img class="hover blur-up lazyload" data-src="<?= $row['imagespath'].$i[1] ?>" src="<?= $row['imagespath'].$i[1] ?>" alt="image" title="product">
                                                    <!-- End hover image -->
                                                </a>
                                                <!-- end product image -->
        
                                                <!-- Start product button -->
                                                <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                                    <button class="btn btn-addto-cart" type="button" tabindex="0">Select Options</button>
                                                </form>
                                                <div class="button-set">
                                                    <!-- <a href="index.php?id=2" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                        <i class="icon anm anm-search-plus-r"></i>
                                                    </a> -->
                                                    <div class="wishlist-btn">
                                                        <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                            <i class="icon anm anm-heart-l"></i>
                                                        </a>
                                                    </div>
                                                    <div class="compare-btn">
                                                        <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                            <i class="icon anm anm-random-r"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end product button -->
                                            </div>
                                            <!-- end product image -->
        
                                            <!--start product details -->
                                            <div class="product-details text-center">
                                                <!-- product name -->
                                                <div class="product-name">
                                                    <a href="product-accordion.php"><?=$row['Name']?></a>
                                                </div>
                                                <!-- End product name -->
                                                <!-- product price -->
                                                <div class="product-price">
                                                    <span class="old-price">$<?=$row['Price']*1.1?></span>
                                                    <span class="price">$<?=$row['Price']?></span>
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
                                <div id="tab2" class="tab_content grid-products">
                                    <div class="productSlider">
                                        <div class="col-12 item">
                                            <!-- start product image -->
                                            <div class="product-image">
                                                <!-- start product image -->
                                                <a href="product-accordion.php">
                                                    <!-- image -->
                                                    <img class="primary blur-up lazyload" data-src="assets/images/product-images/product-image6.jpg" src="assets/images/product-images/product-image6.jpg" alt="image" title="product">
                                                    <!-- End image -->
                                                    <!-- Hover image -->
                                                    <img class="hover blur-up lazyload" data-src="assets/images/product-images/product-image6-1.jpg" src="assets/images/product-images/product-image6-1.jpg" alt="image" title="product">
                                                    <!-- End hover image -->
                                                    <!-- product label -->
                                                    <div class="product-labels rectangular"><span class="lbl on-sale">-16%</span> <span class="lbl pr-label1">new</span></div>
                                                    <!-- End product label -->
                                                </a>
                                                <!-- end product image -->
        
                                                <!-- Start product button -->
                                                <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                                    <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                                                </form>
                                                <div class="button-set">
                                                    <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                        <i class="icon anm anm-search-plus-r"></i>
                                                    </a>
                                                    <div class="wishlist-btn">
                                                        <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                            <i class="icon anm anm-heart-l"></i>
                                                        </a>
                                                    </div>
                                                    <div class="compare-btn">
                                                        <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                            <i class="icon anm anm-random-r"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end product button -->
                                            </div>
                                            <!-- end product image -->
        
                                            <!--start product details -->
                                            <div class="product-details text-center">
                                                <!-- product name -->
                                                <div class="product-name">
                                                    <a href="product-accordion.php">Zipper Jacket</a>
                                                </div>
                                                <!-- End product name -->
                                                <!-- product price -->
                                                <div class="product-price">
                                                    <span class="price">$788.00</span>
                                                </div>
                                                <!-- End product price -->
                                                
                                                <div class="product-review">
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star-o"></i>
                                                    <i class="font-13 fa fa-star-o"></i>
                                                </div>
                                            </div>
                                            <!-- End product details -->
                                        </div>
                                        <div class="col-12 item">
                                            <!-- start product image -->
                                            <div class="product-image">
                                                <!-- start product image -->
                                                <a href="product-accordion.php">
                                                    <!-- image -->
                                                    <img class="primary blur-up lazyload" data-src="assets/images/product-images/product-image7.jpg" src="assets/images/product-images/product-image7.jpg" alt="image" title="product">
                                                    <!-- End image -->
                                                    <!-- Hover image -->
                                                    <img class="hover blur-up lazyload" data-src="assets/images/product-images/product-image7-1.jpg" src="assets/images/product-images/product-image7-1.jpg" alt="image" title="product">
                                                    <!-- End hover image -->
                                                </a>
                                                <!-- end product image -->
        
                                                <!-- Start product button -->
                                                <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                                    <button class="btn btn-addto-cart" type="button" tabindex="0">Select Options</button>
                                                </form>
                                                <div class="button-set">
                                                    <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                        <i class="icon anm anm-search-plus-r"></i>
                                                    </a>
                                                    <div class="wishlist-btn">
                                                        <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                            <i class="icon anm anm-heart-l"></i>
                                                        </a>
                                                    </div>
                                                    <div class="compare-btn">
                                                        <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                            <i class="icon anm anm-random-r"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end product button -->
                                            </div>
                                            <!-- end product image -->
        
                                            <!--start product details -->
                                            <div class="product-details text-center">
                                                <!-- product name -->
                                                <div class="product-name">
                                                    <a href="product-accordion.php">Zipper Jacket</a>
                                                </div>
                                                <!-- End product name -->
                                                <!-- product price -->
                                                <div class="product-price">
                                                    <span class="price">$748.00</span>
                                                </div>
                                                <!-- End product price -->
                                                <div class="product-review">
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                </div>
                                            </div>
                                            <!-- End product details -->
                                        </div>
                                        <div class="col-12 item">
                                            <!-- start product image -->
                                            <div class="product-image">
                                                <!-- start product image -->
                                                <a href="product-accordion.php">
                                                    <!-- image -->
                                                    <img class="primary blur-up lazyload" data-src="assets/images/product-images/product-image8.jpg" src="assets/images/product-images/product-image8.jpg" alt="image" title="product">
                                                    <!-- End image -->
                                                    <!-- Hover image -->
                                                    <img class="hover blur-up lazyload" data-src="assets/images/product-images/product-image8-1.jpg" src="assets/images/product-images/product-image8-1.jpg" alt="image" title="product">
                                                    <!-- End hover image -->
                                                </a>
                                                <!-- end product image -->
        
                                                <!-- Start product button -->
                                                <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                                    <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                                                </form>
                                                <div class="button-set">
                                                    <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                        <i class="icon anm anm-search-plus-r"></i>
                                                    </a>
                                                    <div class="wishlist-btn">
                                                        <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                            <i class="icon anm anm-heart-l"></i>
                                                        </a>
                                                    </div>
                                                    <div class="compare-btn">
                                                        <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                            <i class="icon anm anm-random-r"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end product button -->
                                            </div>
        
                                            <!-- end product image -->
        
                                            <!--start product details -->
                                            <div class="product-details text-center">
                                                <!-- product name -->
                                                <div class="product-name">
                                                    <a href="product-accordion.php">Workers Shirt Jacket</a>
                                                </div>
                                                <!-- End product name -->
                                                <!-- product price -->
                                                <div class="product-price">
                                                    <span class="price">$238.00</span>
                                                </div>
                                                <!-- End product price -->
                                                
                                                <div class="product-review">
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star-o"></i>
                                                </div>
                                            </div>
                                            <!-- End product details -->
                                        </div>
                                        <div class="col-12 item">
                                            <!-- start product image -->
                                            <div class="product-image">
                                                <!-- start product image -->
                                                <a href="product-accordion.php">
                                                    <!-- image -->
                                                    <img class="primary blur-up lazyload" data-src="assets/images/product-images/product-image9.jpg" src="assets/images/product-images/product-image9.jpg" alt="image" title="product">
                                                    <!-- End image -->
                                                    <!-- Hover image -->
                                                    <img class="hover blur-up lazyload" data-src="assets/images/product-images/product-image9-1.jpg" src="assets/images/product-images/product-image9-1.jpg" alt="image" title="product">
                                                    <!-- End hover image -->
                                                </a>
                                                <!-- end product image -->
        
                                                <!-- Start product button -->
                                                <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                                    <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                                                </form>
                                                <div class="button-set">
                                                    <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                        <i class="icon anm anm-search-plus-r"></i>
                                                    </a>
                                                    <div class="wishlist-btn">
                                                        <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                            <i class="icon anm anm-heart-l"></i>
                                                        </a>
                                                    </div>
                                                    <div class="compare-btn">
                                                        <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                            <i class="icon anm anm-random-r"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end product button -->
                                            </div>
                                            <!-- end product image -->
        
                                            <!--start product details -->
                                            <div class="product-details text-center">
                                                <!-- product name -->
                                                <div class="product-name">
                                                    <a href="product-accordion.php">Watercolor Sport Jacket in Brown/Blue</a>
                                                </div>
                                                <!-- End product name -->
                                                <!-- product price -->
                                                <div class="product-price">
                                                    <span class="price">$348.00</span>
                                                </div>
                                                <!-- End product price -->
                                                
                                                <div class="product-review">
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star-o"></i>
                                                    <i class="font-13 fa fa-star-o"></i>
                                                </div>
                                            </div>
                                            <!-- End product details -->
                                        </div>
                                        <div class="col-12 item">
                                            <!-- start product image -->
                                            <div class="product-image">
                                                <!-- start product image -->
                                                <a href="product-accordion.php">
                                                    <!-- image -->
                                                    <img class="primary blur-up lazyload" data-src="assets/images/product-images/product-image10.jpg" src="assets/images/product-images/product-image10.jpg" alt="image" title="product">
                                                    <!-- End image -->
                                                    <!-- Hover image -->
                                                    <img class="hover blur-up lazyload" data-src="assets/images/product-images/product-image10-1.jpg" src="assets/images/product-images/product-image10-1.jpg" alt="image" title="product">
                                                    <!-- End hover image -->
                                                </a>
                                                <!-- end product image -->
        
                                                <!-- Start product button -->
                                                <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                                    <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                                                </form>
                                                <div class="button-set">
                                                    <!-- <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                        <i class="icon anm anm-search-plus-r"></i>
                                                    </a> -->
                                                    <div class="wishlist-btn">
                                                        <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                            <i class="icon anm anm-heart-l"></i>
                                                        </a>
                                                    </div>
                                                    <div class="compare-btn">
                                                        <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                            <i class="icon anm anm-random-r"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end product button -->
                                            </div>
                                            <!-- end product image -->
        
                                            <!--start product details -->
                                            <div class="product-details text-center">
                                                <!-- product name -->
                                                <div class="product-name">
                                                    <a href="product-accordion.php">Washed Wool Blazer</a>
                                                </div>
                                                <!-- End product name -->
                                                <!-- product price -->
                                                <div class="product-price">
                                                    <span class="price">$1,078.00</span>
                                                </div>
                                                <!-- End product price -->
                                                
                                                <div class="product-review">
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                    <i class="font-13 fa fa-star"></i>
                                                </div>
                                            </div>
                                            <!-- End product details -->
                                        </div>
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
             $stmt=$database->prepare("SELECT * FROM Categories WHERE ParentCategoryID IS NULL");
             $stmt->execute();
             $cat = $stmt->fetchAll(PDO::FETCH_ASSOC);
             foreach($cat as $c)
             {
                ?>
                        <div class="collection-grid-item">
                            <a href="collection-page.html" class="collection-grid-item__link">
                                <img data-src="" src="<?=$c['images']?>" alt="" class="blur-up lazyload"/>
                                <div class="collection-grid-item__title-wrapper">
                                    <h3 class="collection-grid-item__title btn btn--secondary no-border"><?=$c['Name' ]?></h3>
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
                    $stmt=$database->prepare("SELECT * FROM products");
                    $stmt->execute();
                    $cat = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    shuffle($cat);
                    foreach($cat as $c)
                    {
                        $images=array_values(array_diff(scandir($c['imagespath']),array('.','..')));
                        $p=$images;
                        ?>
                
                        <div class="col-6 col-sm-6 col-md-4 col-lg-4 item grid-view-item style2">
                        	<div class="grid-view_image">
                                <!-- start product image -->
                                <a href="product-accordion.php" class="grid-view-item__link">
                                    <!-- image -->
                                    <img class="col-8 col-sm-10 col-md-10 col-lg-10 grid-view-item__image primary blur-up lazyload" data-src="<?=$c['imagespath'].$p[0]?>" src="<?=$c['imagespath'].$p[0]?>" alt="image" title="product">
                                    <!-- End image -->
                                    <!-- Hover image -->
                                    <img class="col-8 col-sm-10 col-md-10 col-lg-10 grid-view-item__image hover blur-up lazyload" data-src="<?=$c['imagespath'].$p[1]?>" src="<?=$c['imagespath'].$p[1]?>" alt="image" title="product">
                                    <!-- End hover image -->
                                    <!-- product label -->
                                    <!-- End product label -->
                                </a>
                                <!-- end product image -->
                                <!--start product details -->

                                <div class="product-details hoverDetails text-center mobile">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="product-accordion.php"><?=$c['Name']?></a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="old-price"><?=$c['Price']*1.1?></span>
                                        <span class="price"><?=$c['Price']?></span>
                                    </div>
                                    <!-- End product price -->
                                    
                                    <!-- product button -->
                                    <div class="button-set">
                                        <!-- <a href="" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a> -->
                                        <!-- Start product button -->
                                        <form class="variants add" action="#" onclick="window.location.href='cart.html'"method="post">
                                            <button class="btn cartIcon btn-addto-cart" type="button" tabindex="0"><i class="icon anm anm-bag-l"></i></button>
                                        </form>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
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
    require("./footer.php");
?>
    <!--Quick View popup-->
    
    <!--End Quick View popup-->    
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
</body>

</html>