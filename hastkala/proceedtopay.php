<?php
require './header.php';
?>
<?php

$userid = $_SESSION['id'];
if (isset($_SESSION['productid']) && isset($_SESSION['avaQuantity']) && isset($_SESSION['productQuantitypurchase']) && isset($_SESSION['TotalQuantity'])) {
  $productid = $_SESSION['productid'];
  $avalquant = $_SESSION['avaQuantity'];
  $purchasequantity = $_SESSION['productQuantitypurchase'];
  $totalquantity = $_SESSION['TotalQuantity'];
  //order details
  $proceedtopay = $database->prepare("SELECT * FROM orders WHERE UserID=? AND ProductId=?");
  $proceedtopay->execute(array($userid, $productid));
  $proceeddetails = $proceedtopay->fetchAll(PDO::FETCH_ASSOC);
} else {
  $proceeddetails = $_SESSION['checkout'];
}
?>
<br>
<br>
<br>
<br>
<br>
<br>

<!--Body Content-->
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Shipping details</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->

    <?php
  //profile details

  $profilesdetails = $database->prepare("SELECT `Name`,`MobileNumber`,`Address`,`State`,`Pincode` FROM `profiles` WHERE `ID` = ?");
  $profilesdetails->execute(array($userid));
  $profile = $profilesdetails->fetch(PDO::FETCH_ASSOC);

  ?>
    <div class="container">
        <div class="row">
            <div class="cart col-12 col-sm-5 col-md-12 col-lg-12 main-col">
                <table>
                    <div class="row justify-content-center col-12 col-sm-12 col-md-6 col-lg-12 cart__footer">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-9 ">
                            <div class="solid-border">
                                <div class="row border-bottom pb-2">
                                    <span class=" text-center col-12 col-sm-6 cart__subtotal-title">
                                        <b>your Detail.</b>
                                    </span>
                                </div>
                                <div class="row border-bottom pb-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title">name</span>
                                    <span class="col-12 col-sm-6 text-right"><span
                                            class="money"><?= $profile['Name'] ?></span></span>
                                </div>
                                <div class="row border-bottom pb-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title">Mobile Number</span>
                                    <span class="col-12 col-sm-6 text-right"><span
                                            class="money"><?= $profile['MobileNumber'] ?></span></span>
                                </div>
                                <div class="row border-bottom pb-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title">Address`</span>
                                    <span class="col-12 col-sm-6 text-right"><span
                                            class="money"><?= $profile['Address'] ?></span></span>
                                </div>
                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title">State</span>
                                    <span class="col-12 col-sm-6 text-right"><span
                                            class="money"><?= $profile['State'] ?></span></span>
                                </div>
                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title">pincode</span>
                                    <span class="col-12 col-sm-6 text-right"><span
                                            class="money"><?= $profile['Pincode']; ?></span></span>
                                </div>
                                <div class="row border-bottom pb-2 pt-2">
                                    <a href="./profile.php" style="margin-left: 45%;"
                                        class=" btn btn-secondary  cart-continue">Edit Details</a>
                                </div>
                            </div>

                        </div>


                        <div class="container">
                            <div class="row">
                                <div class="cart  col-12 col-sm-5 col-md-12 col-lg-12 main-col">
                                    <table>
                                        <thead class="cart__row cart__header">
                                            <tr>
                                                <th colspan="2" class="text-center">Product</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-right">Total</th>
                                                <th class="action">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <?php
                    $subamount = null;
                    foreach ($proceeddetails as $prodetails) {
                      $productsid = $prodetails['ProductId'];
                      $psize = $prodetails['SizeID'];
                      $subamount += $prodetails['TotalPrice'];

                      $size = $database->prepare("SELECT `FixedSize` FROM `sizes` WHERE ID=?");
                      $size->execute(array($psize));
                      $productsize = $size->fetch(PDO::FETCH_ASSOC);

                      $productsdetails = $database->prepare("SELECT `ID`,`Name`,`Price`,`ImagesPath`,`Details` FROM `products` WHERE `ID` = ?");
                      $productsdetails->execute(array($productsid));
                      $products = $productsdetails->fetch(PDO::FETCH_ASSOC);
                      $images = array_values(array_diff(scandir($products['ImagesPath']), array('.', '..')));
                    ?>
                                        <tbody>
                                            <form action="" method="post">
                                                <tr class="cart__row border-bottom line1 cart-flex border-top">
                                                    <td class="cart__image-wrapper cart-flex-item">
                                                        <a
                                                            href="./product-accordion.php?id=<?= $prodetails['ProductId'] ?>"><img
                                                                class="cart__image"
                                                                src="<?= $products['ImagesPath'] . $images[0] ?>"
                                                                alt="<?= $products['Name'] ?>"></a>
                                                    </td>
                                                    <td class="cart__meta small--text-left cart-flex-item">
                                                        <div class="list-view-item__title">
                                                            <a><?= $products['Name'] ?></a>
                                                        </div>

                                                        <div class="cart__meta-text">
                                                            Details:&nbsp;<?= $products['Details'] ?>
                                                            <?php
                                if (isset($productsize['FixedSize'])) {
                                ?>
                                                            <br>Size:&nbsp;<?= $productsize['FixedSize'] ?><br>
                                                            <?php
                                }
                                ?>
                                                        </div>
                                                    </td>
                                                    <td class="cart__price-wrapper cart-flex-item">
                                                        <b class="d-lg-none">Price</b>
                                                        <span class="money">₹<?= $products['Price'] ?></span>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="text-center">
                                                            <b class="d-lg-none">Quantity</b>
                                                            <div class="qtyField">
                                                                <?= $prodetails['Quantity'] ?>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" value="<?= $prodetails['ProductId'] ?>"
                                                            name="productid">
                                                    </td>
                                                    <td class=" cart-price">
                                                        <div><span
                                                                class="money">₹<?= $prodetails['TotalPrice'] ?></span>
                                                        </div>
                                                </tr>
                                            </form>
                                        </tbody>
                                        <?php
                    }
                    ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <br>
    </div>
    <div class="row justify-content-end col-12 col-sm-12 col-md-6 col-lg-12 cart__footer">
        <div class="col-12 col-sm-12 col-md-6 col-lg-12 ">
            <div class="solid-border">
                <div class="row border-bottom pb-2">
                    <span class="col-12 col-sm-6 cart__subtotal-title">Subtotal</span>
                    <span class="col-12 col-sm-6 text-right"><span class="money">₹<?= $subamount ?></span></span>
                </div>
                <div class="row border-bottom pb-2 pt-2">
                    <span class="col-12 col-sm-6 cart__subtotal-title">Shipping</span>
                    <span class="col-12 col-sm-6 text-right">Free shipping</span>
                </div>
                <div class="row border-bottom pb-2 pt-2">
                    <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Grand Total</strong></span>
                    <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span
                            class="money">₹<?= $subamount ?></span></span>
                </div>
                <!-- <input type="submit" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout" value="Proceed To Checkout"> -->
                <a href="./buyproduct.php" type="submit" name="checkout" id="cartCheckout"
                    class="btn btn--small-wide checkout">Proceed To Checkout</a>
            </div>

        </div>
    </div>
    <!--End Body Content-->
    <?php
  require './footer.php';
  ?>