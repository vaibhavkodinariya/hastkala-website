<?php
require './header.php';
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<style>
#toast-container {
    min-width: 20%;
    top: 50%;
    right: 50%;
    transform: translateX(50%) translateY(50%);
}
</style>
<!--Body Content-->
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Shopping Cart</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->
    <?php
    if (isset($_SESSION['id'])) {
        $orderstatus = 1;
        $userId = $_SESSION['id'];
        $statement = $database->prepare("SELECT * FROM orders WHERE OrderStatusID=? AND UserID=?");
        $statement->execute(array($orderstatus, $userId));
        $cart = $statement->fetchAll(PDO::FETCH_ASSOC);
        $Finalprice = null;

    ?>
    <?php
        if (count($cart) == 0) {
        ?>
    <div class="text-center" style="padding:5%;">
        <div style="padding:7%; border: 0.5em groove;">
            <h1>Your Cart Is Empty.!</h1>
        </div>
    </div>
    <td>
        <a href="./index.php" style="margin-left: 45%;" class=" btn btn-secondary  cart-continue">Continue shopping</a>
    </td>
    <?php
        } else {
        ?>
    <div class="container">
        <div class="row">
            <div class="cart col-12 col-sm-5 col-md-12 col-lg-12 main-col">
                <table>
                    <thead class="cart__row cart__header">
                        <tr>
                            <th colspan="2" class="text-center">Product</th>
                            <th class="text-left">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">&nbsp;</th>
                            <th class="text-left">Total</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <?php
                            foreach ($cart as $cart) {
                                $productsid = $cart['ProductId'];
                                $psize = $cart['SizeID'];
                                $Finalprice += $cart['TotalPrice'];

                                $size = $database->prepare("SELECT `FixedSize` FROM `sizes` WHERE ID=?");
                                $size->execute(array($psize));
                                $productsize = $size->fetch(PDO::FETCH_ASSOC);

                                $productsdetails = $database->prepare("SELECT `ID`,`Name`,`Price`,`ImagesPath`,`Details` FROM `products` WHERE `ID` = ?");
                                $productsdetails->execute(array($productsid));
                                $products = $productsdetails->fetch(PDO::FETCH_ASSOC);
                                $images = array_values(array_diff(scandir($products['ImagesPath']), array('.', '..')));
                            ?>
                    <tbody>
                        <form action="./updatecart.php" method="post">
                            <tr class="cart__row border-bottom line1 cart-flex border-top">
                                <td class="cart__image-wrapper cart-flex-item">
                                    <a href="./product-accordion.php?id=<?= $cart['ProductId'] ?>"><img
                                            class="cart__image" src="<?= $products['ImagesPath'] . $images[0] ?>"
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
                                    <span class="money">₹<?= $products['Price'] ?></span>
                                </td>
                                <td class="cart-flex-item text-right">
                                    <div class="cart__qty text-center">
                                        <div class="qtyField">
                                            <a class="qtyBtn minus" href="javascript:void(0);"><i
                                                    class="icon icon-minus"></i></a>
                                            <input class="cart__qty-input qty" type="text" name="updatesqty" id="qty"
                                                value="<?= $cart['Quantity'] ?>">
                                            <a class="qtyBtn plus" href="javascript:void(0);"><i
                                                    class="icon icon-plus"></i></a>
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?= $cart['ProductId'] ?>" name="productid">
                                </td>
                                <td class=" cart-price">
                                <td class="cart__price-wrapper cart-flex-item">
                                    <div><span class="money">₹<?= $cart['TotalPrice'] ?></span></div>
                                </td>
                                <td class="text-center"><a href="./removeprocart.php?oid=<?= $cart['OrderID'] ?>"
                                        class="small--hide btn btn--secondary cart__remove" title="Remove tem"><i
                                            class="icon icon anm anm-times-l"></i></a>&nbsp; <input type="submit"
                                        name="Buy" class="small--hide btn btn-secondary btn--small cart-continue"
                                        value="Buy"> &nbsp;<input type="submit" name="Update" id="cartUpdate"
                                        class="small--hide btn btn--small Update" value="Update"></td>
                            </tr>
                            <td class="text-center"><a href="./removeprocart.php?oid=<?= $cart['OrderID'] ?>"
                                    class="d-lg-none btn  btn--small" title="Remove tem"><i class="">remove</a>&nbsp;
                                <input type="submit" class="d-lg-none btn btn-secondary btn--small cart-continue"
                                    name="Buy" value="Buy"> &nbsp;<input type="submit" name="Update" id="cartUpdate"
                                    class="d-lg-none btn btn--small Update" value="Update">
                            </td>
                        </form>
                    </tbody>
                    <?php
                            }
                            ?>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-left"><a href="./index.php"
                                    class="btn btn-secondary btn--small cart-continue">Continue shopping</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row justify-content-end col-12 col-sm-12 col-md-6 col-lg-12 cart__footer">
                <div class="col-12 col-sm-12 col-md-6 col-lg-12 ">
                    <div class="solid-border">
                        <div class="row border-bottom pb-2">
                            <span class="col-12 col-sm-6 cart__subtotal-title">Subtotal</span>
                            <span class="col-12 col-sm-6 text-right"><span
                                    class="money">₹<?= $Finalprice ?></span></span>
                        </div>
                        <div class="row border-bottom pb-2 pt-2">
                            <span class="col-12 col-sm-6 cart__subtotal-title">Shipping</span>
                            <span class="col-12 col-sm-6 text-right">Free shipping</span>
                        </div>
                        <div class="row border-bottom pb-2 pt-2">
                            <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Grand Total</strong></span>
                            <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span
                                    class="money">₹<?= $Finalprice ?></span></span>
                        </div>
                        <!-- <input type="submit" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout" value="Proceed To Checkout"> -->
                        <a href="./carttocheckout.php" type="submit" name="checkout" id="cartCheckout"
                            class="btn btn--small-wide checkout">Proceed To Checkout</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
</div>
<?php
        }
?>
<br>

</div>
<!--End Body Content-->
<?php
    } else {
        echo ("<div class='text-center' style='padding:5%;'>
            <div style='padding:7%; border: 0.5em groove;'>
                <h1>Login Needed...</h1>
            </div>
            </div>");
    }
?>
<?php
require("./footer.php");
?>