<?php
session_start();
require("./includes/database.php");
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/log3.2.2.png" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
</head>

<body>
    <div id="pre-loader">
        <img src="assets/images/loader.gif" alt="Loading..." />
    </div>
    <div class="pageWrapper">
        <!--End Search Form Drawer-->
        <!--Header-->
        <div class="header-wrap classicHeader animated d-flex">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!--Desktop Logo-->
                    <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                        <a href="./index.php">
                            <img src="assets/images/logo/log3.3.1.png" alt="Hastkala logo" title="Hastkala" />
                        </a>
                    </div>
                    <!--End Desktop Logo-->
                    <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                        <div class="d-block d-lg-none">
                            <button type="button"
                                class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                                <i class="icon anm anm-times-l"></i>
                                <i class="anm anm-bars-r"></i>
                            </button>
                        </div>
                        <!--Desktop Menu-->
                        <nav class="grid__item" id="AccessibleNav">
                            <!-- for mobile -->
                            <ul id="siteNav" class="site-nav medium center hidearrow">
                                <li class="lvl1 parent megamenu"><a href="./index.php">Home <i
                                            class="anm anm-angle-down-l"></i></a></li>
                                <?php
                                if (!isset($_SESSION['id'])) {
                                ?>
                                <li class="lvl-2"><a href="./login.php" class="site-nav lvl-2">signup</a></li>
                                <?php
                                } else {
                                ?>
                                <li class="lvl-2"><a href="./logout.php" class="site-nav lvl-2">logout</a></li>
                                <?php
                                }
                                ?>
                                <li class="lvl1 parent megamenu"><a href="#">Category <i
                                            class="anm anm-angle-down-l"></i></a>
                                    <div class="megamenu style4">
                                        <ul class="grid grid--uniform mmWrapper">
                                            <li class="grid__item lvl-1 col-md-3 col-lg-3"><a href="#"
                                                    class="site-nav lvl-1">Categorys</a>
                                                <?php
                                                $stmt = $database->prepare("SELECT * FROM categories  WHERE ParentCategoryID IS NULL");
                                                $stmt->execute();
                                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($result as $r) {
                                                ?>
                                                <ul class="subLinks">
                                                    <li class="lvl-2"><a href="./categor.php"
                                                            class="site-nav lvl-2"><?= $r['Name'] ?></a></li>
                                                </ul>
                                                <?php
                                                }
                                                ?>
                                            </li>
                                            <li class="grid__item lvl-1 col-md-6 col-lg-6">
                                                <a href="#"><img src="assets/images/megamenu-bg1.jpg" alt=""
                                                        title="" /></a>
                                            </li>
                                        </ul>
                                    </div>

                                <li class="lvl1 parent megamenu"><a href="#">account<i
                                            class="anm anm-angle-down-l"></i></a>
                                    <div class="float-right offset-lg-6 col-12 col-md-3 col-lg-3 megamenu style4">
                                        <ul class=" grid grid--uniform mmWrapper">
                                            <li class="grid__item lvl-1 col-md-3 col-lg-3"><a href="#"
                                                    class="site-nav lvl-1">account</a>
                                                <ul class="subLinks">
                                                    <li class="lvl-2"><a href="./profile.php"
                                                            class="site-nav lvl-2">Profile</a></li>
                                                    <li class="lvl-2"><a href="./cart-variant1.php"
                                                            class="site-nav lvl-2">Cart</a></li>
                                                    <li class="lvl-2"><a href="./order.php"
                                                            class="site-nav lvl-2">Orders</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!--End Desktop Menu-->
                    </div>
                    <!--Mobile Logo-->
                    <div style="margin-top: -2em;" class="col-6 col-sm-9 col-md-9 col-lg-2  d-lg-none mobile-logo">
                        <div class="logo col-12 col-sm-12 col-md-9 col-lg-3 ">
                            <a href="index.html">
                                <img style="margin-top: -0.5em;" src="assets/images/logo/log3.3.1.png" alt=""
                                    title="" />
                            </a>
                        </div>
                    </div>
                    <!--Mobile Logo-->
                    <?php
                    $numberOfCartItems = 0;

                    if (isset($_SESSION['id'])) {
                        $userId = $_SESSION['id'];
                        $orderStatusID = 1;
                        $query = "SELECT COUNT(*) AS `COUNT` FROM `orders` WHERE `UserID` = ? AND `OrderStatusID` = ?";
                        $statement = $database->prepare($query);
                        $statement->execute(array($userId, $orderStatusID));
                        $order = $statement->fetch(PDO::FETCH_ASSOC);
                        $numberOfCartItems = $order['COUNT'];

                        $orderstatus = 1;
                        $statement = $database->prepare("SELECT * FROM orders WHERE OrderStatusID=? AND UserID=?");
                        $statement->execute(array($orderstatus, $userId));
                        $cart = $statement->fetchAll(PDO::FETCH_ASSOC);
                        $Finalprice = null;

                    ?>
                    <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                        <div class="site-cart">
                            <a href="#;" class="site-header__cart" title="Cart">
                                <i class="icon anm anm-bag-l"></i>
                                <span id="CartCount" class="site-header__cart-count"
                                    data-cart-render="item_count"><?= $numberOfCartItems ?></span>
                            </a>
                            <!--Minicart Popup-->
                            <div id="header-cart" class="block block-cart">
                                <ul class="mini-products-list">
                                    <?php
                                        if (count($cart) == 0) {
                                        ?>
                                    <div class="text-center" style="padding:5%;">
                                        <div style="padding:7%;">
                                            <h7>Your Cart Is Empty.!</h7>
                                        </div>
                                    </div>
                                    <?php
                                        } else {
                                        ?>
                                    <li class="item">

                                        <?php
                                                foreach ($cart as $cart) {
                                                    $productsid = $cart['ProductId'];
                                                    $psize = $cart['SizeID'];
                                                    $Finalprice += $cart['TotalPrice'];
                                                    $size = $database->prepare("SELECT `FixedSize` FROM `sizes` WHERE ID=?");
                                                    $size->execute(array($psize));
                                                    $productsize = $size->fetch(PDO::FETCH_ASSOC);
                                                    $productsdetails = $database->prepare("SELECT `Name`,`Price`,`ImagesPath`,`Details` FROM `products` WHERE `ID` = ? AND IsDelete IS NULL");
                                                    $productsdetails->execute(array($productsid));
                                                    $products = $productsdetails->fetch(PDO::FETCH_ASSOC);
                                                    $images = array_values(array_diff(scandir($products['ImagesPath']), array('.', '..')));
                                                ?>
                                        <a class="product-image" href="#">
                                            <img src="<?= $products['ImagesPath'] . $images[0] ?>" alt="" title="" />
                                        </a>
                                        <div class="product-details">
                                            <a href="./removeprocart.php?oid=<?= $cart["OrderID"] ?>" class="remove"><i
                                                    class="anm anm-times-l" aria-hidden="true"></i></a>
                                            <a href="./cart-variant1.php" class="edit-i remove"><i class="anm anm-edit"
                                                    aria-hidden="true"></i></a>
                                            <a class="pName" href="cart.html"><?= $products['Name'] ?></a>
                                            <?php
                                                        if (isset($productsize['FixedSize'])) {
                                                        ?>
                                            <div class="variant-cart">
                                                <?= $productsize['FixedSize'] ?>
                                            </div>
                                            <?php
                                                        }
                                                        ?>
                                            <div class="wrapQtyBtn">
                                                <div class="qtyField">
                                                    <span class="label">Qty:</span>
                                                    <a class="qtyBtn minus" href="javascript:void(0);"><i
                                                            class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                    <input type="text" id="Quantity" name="quantity"
                                                        value="<?= $cart['Quantity'] ?>"
                                                        class="product-form__input qty">
                                                    <a class="qtyBtn plus" href="javascript:void(0);"><i
                                                            class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="priceRow">
                                                <div class="product-price">
                                                    <span class="money">₹<?= $products['Price'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                }
                                                ?>
                                    </li>
                                </ul>
                                <div class="total">
                                    <div class="total-in">
                                        <span class="label">Cart Subtotal:</span><span class="product-price"><span
                                                class="money">₹<?= $Finalprice ?></span></span>
                                    </div>
                                </div>
                                <?php
                                        } //ifclose
                                ?>
                                <div class="buttonSet text-center">
                                    <a href="cart-variant1.php" class="btn btn-secondary btn--small">View Cart</a>
                                </div>
                            </div>
                            <!--EndMinicart Popup-->
                        </div>
                        <div class="site-header__search">
                            <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
                        </div>
                    </div>
                    <?php
                    } //session if close
                    ?>
                </div>
            </div>
        </div>
        <!--End Header-->
        <!--Mobile Menu-->
        <div class="mobile-nav-wrapper" role="navigation">
            <div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i> Close Menu</div>
            <ul id="MobileNav" class="mobile-nav">
                <li class="lvl1 parent megamenu"><a href="index.php">Home <i class="anm anm-l"></i></a>
                </li>
                <li><a href="#" class="site-nav">Category<i class="anm anm-plus-l"></i></a>
                    <ul>
                        <?php foreach ($result as $ro) {
                        ?>
                        <li><a href="./categorys.php" class="site-nav"><?= $ro['Name'] ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                <li><a href="#" class="site-nav">Account<i class="anm anm-plus-l"></i></a>
                    <ul>
                        <li><a href="./profile.php" class="site-nav">Profile</a></li>
                        <li><a href="./cart-variant1.php" class="site-nav">Cart</a></li>
                        <li><a href="./order.php" class="site-nav">Orders</a></li>
                    </ul>
                </li>
                <?php
                if (isset($_SESSION['id'])) {
                ?>
                <li><a href="./logout.php" class="site-nav">Logout</a>
                    <?php
                } else {
                    ?>
                <li><a href="./login.php" class="site-nav">Signup</a>
                    <?php
                }
                    ?>
            </ul>
            </li>
            </ul>
        </div>
        <!--End Mobile Menu-->