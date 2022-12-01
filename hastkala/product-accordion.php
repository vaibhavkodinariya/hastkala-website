    <?php
    require "./header.php";
    ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!--Body Content-->
    <?php
    $_SESSION['productid'] = $_GET['id'];
    $productid = $_SESSION['productid'];
    $stmt = $database->prepare("SELECT * FROM products WHERE ID=$productid AND IsDelete IS NULL");
    $stmt->execute();
    $productdetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <style>
#toast-container {
    min-width: 20%;
    top: 50%;
    right: 50%;
    transform: translateX(50%) translateY(50%);
}
    </style>
    <?php
    foreach ($productdetails as $product) {
        $images = array_values(array_diff(scandir($product['ImagesPath']), array('.', '..')));
    ?>
    <div id="page-content">
        <!--MainContent-->
        <div id="MainContent" class="main-content" role="main">

            <div id="ProductSection-product-template" class="product-template__container prstyle2 container">
                <!--#ProductSection-product-template-->
                <div class="product-single product-single-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="product-details-img product-single__photos bottom">
                                <div class="zoompro-wrap product-zoom-right pl-20">
                                    <div class="zoompro-span">
                                        <img class="blur-up lazyload zoompro"
                                            data-zoom-image="<?= $product['ImagesPath'] . $images[0] ?>" alt=""
                                            src="<?= $product['ImagesPath'] . $images[0] ?>" />
                                    </div>
                                    <div class="product-buttons">
                                        <a href="#" class="btn prlightbox" title="Zoom"><i
                                                class="icon anm anm-expand-l-arrows" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="product-thumb product-thumb-1">
                                    <div id="gallery" class="product-dec-slider-1 product-tab-left">
                                        <?php
                                            foreach ($images as $i) {
                                            ?>
                                        <a data-image="<?= $product['ImagesPath'] . $i ?>"
                                            data-zoom-image="<?= $product['ImagesPath'] . $i ?>"
                                            class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true"
                                            tabindex="-1">
                                            <img class="blur-up lazyload" src="<?= $product['ImagesPath'] . $i ?>"
                                                alt="" />
                                        </a>
                                        <?php
                                            }
                                            ?>
                                    </div>
                                </div>
                                <div class="lightboximages">
                                    <?php
                                        foreach ($images as $i) {
                                        ?>
                                    <a href="<?= $product['ImagesPath'] . $i ?>" data-size="1462x2048"></a>
                                    <?php
                                        }
                                        ?>
                                </div>

                            </div>
                            <!--Product Feature-->
                            <div class="prFeatures">
                                <div class="row">

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 feature">
                                        <img src="assets/images/worldwide.png" alt="Worldwide Delivery"
                                            title="Worldwide Delivery" />
                                        <div class="details">
                                            <h3>Cash on Delivery</h3>FREE &amp; fast shipping
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--End Product Feature-->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="product-single__meta">
                                <h1 class="product-single__title"><?= $product['Name'] ?></h1>
                                <div class="product-nav clearfix">
                                    <a href="#" class="next" title="Next"><i class="fa fa-angle-right"
                                            aria-hidden="true"></i></a>
                                </div>

                                <div class="prInfoRow">
                                    <div class="product-stock"> <span class="instock ">In Stock</span> <span
                                            class="outstock hide">Unavailable</span> </div>
                                </div>

                                <p class="product-single__price product-single__price-product-template">
                                    <span class="visually-hidden">Regular price</span>
                                    <s id="ComparePrice-product-template"><span
                                            class="money">₹<?= $product['Price'] * 1.1 ?></span></s>
                                    <span
                                        class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                        <span id="ProductPrice-product-template"><span
                                                class="money">₹<?= $product['Price'] ?></span></span>
                                    </span>
                                    <span class="discount-badge"> <span class="devider">|</span>&nbsp;
                                        <span>You Save</span>
                                        <span id="SaveAmount-product-template" class="product-single__save-amount">
                                            <span
                                                class="money">₹<?= $product['Price'] * 1.1 - $product['Price'] ?></span>
                                        </span>
                                        <span class="off">(<span>9</span>%)</span>
                                    </span>
                                </p>
                                <div class="product-single__description rte">
                                    <p><?= $product['Details'] ?></p>
                                </div>
                                <form method="post" action="./cartadding.php" id="product_form_10508262282"
                                    accept-charset="UTF-8" class="product-form product-form-product-template "
                                    enctype="multipart/form-data">
                                    <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                        <div class="product-form__item">
                                            <label class="header">Size:</label>
                                            <?php
                                                $smt = $database->prepare("SELECT s.FixedSize,p.Sizeid FROM productssize p,sizes s WHERE p.Sizeid=s.id AND p.ProductId=?");
                                                $smt->execute(array($productid));
                                                $productsize = $smt->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($productsize as $ps) {

                                                ?>
                                            <div class="swatch-element available">
                                                <input class="swatchInput" id="<?= $ps['Sizeid'] ?>" type="radio"
                                                    name="sz[]" value="<?= $ps['Sizeid'] ?>">
                                                <label class="swatchLbl small" for="<?= $ps['Sizeid'] ?>"
                                                    title=""><?= $ps['FixedSize'] ?></label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <p class="infolinks"><a href="#sizechart" class="sizelink btn"> Size Guide</a>
                                        <!-- Product Action -->
                                    <div class="product-action clearfix">
                                        <div class="product-form__item--quantity">
                                            <div class="wrapQtyBtn">
                                                <div class="qtyField">
                                                    <a class="qtyBtn minus" href="javascript:void(0);"><i
                                                            class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                    <input type="text" id="quantity" name="quantity" value="1"
                                                        class="product-form__input qty">
                                                    <a class="qtyBtn plus" href="javascript:void(0);"><i
                                                            class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-form__item--submit">
                                            <button type="submit" name="add" class="btn product-form__cart-submit">
                                                <span>Add to cart</span>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- End Product Action -->
                                </form>

                                <!--Product Tabs-->
                                <div class="tabs-listing">
                                    <div class="tab-container">
                                        <h3 class="acor-ttl active" rel="tab1">Product Details</h3>
                                        <div id="tab1" class="tab-content">
                                            <div class="product-description rte">
                                                <p><?= $product['Details'] ?></p>
                                                <ul>
                                                    <li>Weight:-<?= $product['Weight'] ?></li>
                                                    <li>Material:-<?= $product['Material'] ?></li>
                                                    <li>Composition:-<?= $product['Composition'] ?></li>

                                                </ul>
                                            </div>
                                        </div>
                                        <h3 class="acor-ttl" rel="tab3">Size Chart</h3>
                                        <div id="tab3" class="tab-content">
                                            <h3>WOMEN'S BODY SIZING CHART</h3>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <th>Size</th>
                                                        <th>XS</th>
                                                        <th>S</th>
                                                        <th>M</th>
                                                        <th>L</th>
                                                        <th>XL</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Chest</td>
                                                        <td>31" - 33"</td>
                                                        <td>33" - 35"</td>
                                                        <td>35" - 37"</td>
                                                        <td>37" - 39"</td>
                                                        <td>39" - 42"</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Waist</td>
                                                        <td>24" - 26"</td>
                                                        <td>26" - 28"</td>
                                                        <td>28" - 30"</td>
                                                        <td>30" - 32"</td>
                                                        <td>32" - 35"</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hip</td>
                                                        <td>34" - 36"</td>
                                                        <td>36" - 38"</td>
                                                        <td>38" - 40"</td>
                                                        <td>40" - 42"</td>
                                                        <td>42" - 44"</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Regular inseam</td>
                                                        <td>30"</td>
                                                        <td>30½"</td>
                                                        <td>31"</td>
                                                        <td>31½"</td>
                                                        <td>32"</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Long (Tall) Inseam</td>
                                                        <td>31½"</td>
                                                        <td>32"</td>
                                                        <td>32½"</td>
                                                        <td>33"</td>
                                                        <td>33½"</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <h3>MEN'S BODY SIZING CHART</h3>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <th>Size</th>
                                                        <th>XS</th>
                                                        <th>S</th>
                                                        <th>M</th>
                                                        <th>L</th>
                                                        <th>XL</th>
                                                        <th>XXL</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Chest</td>
                                                        <td>33" - 36"</td>
                                                        <td>36" - 39"</td>
                                                        <td>39" - 41"</td>
                                                        <td>41" - 43"</td>
                                                        <td>43" - 46"</td>
                                                        <td>46" - 49"</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Waist</td>
                                                        <td>27" - 30"</td>
                                                        <td>30" - 33"</td>
                                                        <td>33" - 35"</td>
                                                        <td>36" - 38"</td>
                                                        <td>38" - 42"</td>
                                                        <td>42" - 45"</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hip</td>
                                                        <td>33" - 36"</td>
                                                        <td>36" - 39"</td>
                                                        <td>39" - 41"</td>
                                                        <td>41" - 43"</td>
                                                        <td>43" - 46"</td>
                                                        <td>46" - 49"</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="text-center">
                                                <img src="assets/images/size.jpg" alt="" />
                                            </div>
                                        </div>
                                        <h3 class="acor-ttl" rel="tab4">Shipping &amp; Returns</h3>
                                        <div id="tab4" class="tab-content">
                                            <h4>Returns Policy</h4>
                                            <p> No Return Policy </p>
                                        </div>
                                    </div>
                                </div>
                                <!--End Product Tabs-->
                            </div>
                        </div>
                        <!--End-product-single-->
                        <?php
                    }
                        ?>

                        <!--Collection Tab slider-->
                        <div class="tab-slider-product section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4 col-sm-12 col-md-12 col-lg-12">
                                        <div class="section-header text-center">
                                            <h2 class="h2">continue your shopping</h2>
                                            <p>Browse the huge variety of our products</p>
                                        </div>
                                        <div class="tab_container">
                                            <div id="tab1" class="tab_content grid-products">
                                                <div class="productSlider">

                                                    <?php
                                                    $stmt = $database->prepare("SELECT * FROM products WHERE isdelete IS NULL");
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    shuffle($result);
                                                    foreach ($result as $row) {
                                                        $images = array_values(array_diff(scandir($row['ImagesPath']), array('.', '..')));
                                                        $i = $images;
                                                    ?>

                                                    <div
                                                        class="col-12 col-sm-12 col-md-12 col-lg-12 item grid-view-item style2">

                                                        <div class="grid-view_image">
                                                            <!-- start product image -->
                                                            <a href="product-accordion.php?id=<?= $row['ID'] ?>"
                                                                class="grid-view-item__link">
                                                                <!-- image -->
                                                                <img class="col-10 col-sm-10 col-md-10 col-lg-10 grid-view-item__image primary blur-up lazyload"
                                                                    data-src="<?= $row['ImagesPath'] . $i[0] ?>"
                                                                    src="<?= $row['ImagesPath'] . $i[0] ?>" alt="image"
                                                                    title="product">
                                                                <!-- End image -->
                                                                <!-- Hover image -->
                                                                <img class="col-10 col-sm-10 col-md-10 col-lg-10 grid-view-item__image hover blur-up lazyload"
                                                                    data-src="<?= $row['ImagesPath'] . $i[1] ?>"
                                                                    src="<?= $row['ImagesPath'] . $i[1] ?>" alt="image"
                                                                    title="product">
                                                                <!-- End hover image -->
                                                                <!-- product label -->
                                                                <!-- End product label -->
                                                            </a>
                                                            <!-- end product image -->
                                                            <!--start product details -->

                                                            <div
                                                                class="product-details hoverDetails text-center mobile">
                                                                <!-- product name -->
                                                                <div class="product-name">
                                                                    <a
                                                                        href="product-accordion.php"><?= $row['Name'] ?></a>
                                                                </div>
                                                                <!-- End product name -->
                                                                <!-- product price -->
                                                                <div class="product-price">
                                                                    <span
                                                                        class="old-price">₹<?= $row['Price'] * 1.1 ?></span>
                                                                    <span class="price">₹<?= $row['Price'] ?></span>
                                                                </div>
                                                                <!-- End product price -->

                                                                <!-- product button -->
                                                                <div class="button-set">
                                                                    <!-- <a href="" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                                    <i class="icon anm anm-search-plus-r"></i>
                                                                </a> -->
                                                                    <!-- Start product button -->
                                                                    <form class="variants add" action="#"
                                                                        onclick="window.location.href='cart.html'"
                                                                        method="post">
                                                                        <button class="btn cartIcon btn-addto-cart"
                                                                            type="button" tabindex="0"><i
                                                                                class="icon anm anm-bag-l"></i></button>
                                                                    </form>
                                                                    <div class="wishlist-btn">
                                                                        <a class="wishlist add-to-wishlist"
                                                                            href="wishlist.html">
                                                                            <i class="icon anm anm-heart-l"></i>
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
                        </div>
                    </div>
                    <!--Collection Tab slider-->

                </div>
                <!--MainContent-->
                <!--End Body Content-->
                <div class="hide">
                    <div id="sizechart">
                        <h3>WOMEN'S BODY SIZING CHART</h3>
                        <table>
                            <tbody>
                                <tr>
                                    <th>Size</th>
                                    <th>XS</th>
                                    <th>S</th>
                                    <th>M</th>
                                    <th>L</th>
                                    <th>XL</th>
                                </tr>
                                <tr>
                                    <td>Chest</td>
                                    <td>31" - 33"</td>
                                    <td>33" - 35"</td>
                                    <td>35" - 37"</td>
                                    <td>37" - 39"</td>
                                    <td>39" - 42"</td>
                                </tr>
                                <tr>
                                    <td>Waist</td>
                                    <td>24" - 26"</td>
                                    <td>26" - 28"</td>
                                    <td>28" - 30"</td>
                                    <td>30" - 32"</td>
                                    <td>32" - 35"</td>
                                </tr>
                                <tr>
                                    <td>Hip</td>
                                    <td>34" - 36"</td>
                                    <td>36" - 38"</td>
                                    <td>38" - 40"</td>
                                    <td>40" - 42"</td>
                                    <td>42" - 44"</td>
                                </tr>
                                <tr>
                                    <td>Regular inseam</td>
                                    <td>30"</td>
                                    <td>30½"</td>
                                    <td>31"</td>
                                    <td>31½"</td>
                                    <td>32"</td>
                                </tr>
                                <tr>
                                    <td>Long (Tall) Inseam</td>
                                    <td>31½"</td>
                                    <td>32"</td>
                                    <td>32½"</td>
                                    <td>33"</td>
                                    <td>33½"</td>
                                </tr>
                            </tbody>
                        </table>
                        <h3>MEN'S BODY SIZING CHART</h3>
                        <table>
                            <tbody>
                                <tr>
                                    <th>Size</th>
                                    <th>XS</th>
                                    <th>S</th>
                                    <th>M</th>
                                    <th>L</th>
                                    <th>XL</th>
                                    <th>XXL</th>
                                </tr>
                                <tr>
                                    <td>Chest</td>
                                    <td>33" - 36"</td>
                                    <td>36" - 39"</td>
                                    <td>39" - 41"</td>
                                    <td>41" - 43"</td>
                                    <td>43" - 46"</td>
                                    <td>46" - 49"</td>
                                </tr>
                                <tr>
                                    <td>Waist</td>
                                    <td>27" - 30"</td>
                                    <td>30" - 33"</td>
                                    <td>33" - 35"</td>
                                    <td>36" - 38"</td>
                                    <td>38" - 42"</td>
                                    <td>42" - 45"</td>
                                </tr>
                                <tr>
                                    <td>Hip</td>
                                    <td>33" - 36"</td>
                                    <td>36" - 39"</td>
                                    <td>39" - 41"</td>
                                    <td>41" - 43"</td>
                                    <td>43" - 46"</td>
                                    <td>46" - 49"</td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="padding-left: 30px;"><img src="assets/images/size.jpg" alt=""></div>
                    </div>
                </div>
            </div>
            <?php
                require "./footer.php";
                ?>
            <script>
            $(function() {
                var $pswp = $('.pswp')[0],
                    image = [],
                    getItems = function() {
                        var items = [];
                        $('.lightboximages a').each(function() {
                            var $href = $(this).attr('href'),
                                $size = $(this).data('size').split('x'),
                                item = {
                                    src: $href,
                                    w: $size[0],
                                    h: $size[1]
                                }
                            items.push(item);
                        });
                        return items;
                    }
                var items = getItems();

                $.each(items, function(index, value) {
                    image[index] = new Image();
                    image[index].src = value['src'];
                });
                $('.prlightbox').on('click', function(event) {
                    event.preventDefault();

                    var $index = $(".active-thumb").parent().attr('data-slick-index');
                    $index++;
                    $index = $index - 1;

                    var options = {
                        index: $index,
                        bgOpacity: 0.9,
                        showHideOpacity: true
                    }
                    var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                    lightBox.init();
                });
            });
            </script>
            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="pswp__bg"></div>
                <div class="pswp__scroll-wrap">
                    <div class="pswp__container">
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                    </div>
                    <div class="pswp__ui pswp__ui--hidden">
                        <div class="pswp__top-bar">
                            <div class="pswp__counter"></div><button class="pswp__button pswp__button--close"
                                title="Close (Esc)"></button><button class="pswp__button pswp__button--share"
                                title="Share"></button><button class="pswp__button pswp__button--fs"
                                title="Toggle fullscreen"></button><button class="pswp__button pswp__button--zoom"
                                title="Zoom in/out"></button>
                            <div class="pswp__preloader">
                                <div class="pswp__preloader__icn">
                                    <div class="pswp__preloader__cut">
                                        <div class="pswp__preloader__donut"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                            <div class="pswp__share-tooltip"></div>
                        </div><button class="pswp__button pswp__button--arrow--left"
                            title="Previous (arrow left)"></button><button
                            class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                        <div class="pswp__caption">
                            <div class="pswp__caption__center"></div>
                        </div>
                    </div>
                </div>
            </div>