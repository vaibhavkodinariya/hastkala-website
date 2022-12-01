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
<br>
<!--Body Content-->
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">orders</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->
    <?php
    if (isset($_SESSION['id'])) {
        $userid = $_SESSION['id'];
        $orderstatus = 1;
        $statement = $database->prepare("SELECT * FROM orders WHERE OrderStatusID!=? AND UserID=?");
        $statement->execute(array($orderstatus, $userid));
        $cart = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php
        if (count($cart) == 0) {
        ?>
    <div class="text-center" style="padding:5%;">
        <div style="padding:7%; border: 0.5em groove;">
            <h1>No Orders!</h1>
        </div>
    </div>
    <?php
        } else {
        ?>
    <div class="container">
        <div class="row">
            <div class="cart  col-12 col-sm-5 col-md-12 col-lg-12 main-col">
                <table>
                    <thead class="cart__row cart__header">
                        <tr>
                            <th colspan="2" class="text-center">Product</th>
                            <th class="text-left">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">order status</th>
                            <th class="text-center">Total</th>
                            <th class="action">&nbsp;</th>
                        </tr>
                    </thead>
                    <?php
                            foreach ($cart as $cart) {
                                $productsid = $cart['ProductId'];
                                $psize = $cart['SizeID'];
                                $cart['TotalPrice'];
                                $OrderState = $cart['OrderStatusID'];

                                $orderstatus = $database->prepare("SELECT OrderStatusID,Name FROM orderstatus WHERE OrderStatusID=?");
                                $orderstatus->execute(array($OrderState));
                                $status = $orderstatus->fetch(PDO::FETCH_ASSOC);

                                $Finalprice = null;

                                $size = $database->prepare("SELECT `FixedSize` FROM `sizes` WHERE ID=?");
                                $size->execute(array($psize));
                                $productsize = $size->fetch(PDO::FETCH_ASSOC);

                                $productsdetails = $database->prepare("SELECT `Name`,`Price`,`ImagesPath`,`Details` FROM `products` WHERE `ID` = ?");
                                $productsdetails->execute(array($productsid));
                                $products = $productsdetails->fetch(PDO::FETCH_ASSOC);
                                $images = array_values(array_diff(scandir($products['ImagesPath']), array('.', '..')));
                            ?>
                    <tbody>
                        <form action="" method="post">
                            <tr>
                                <td class="cart__image-wrapper cart-flex-item">
                                    <a href="./product-accordion.php?id=<?= $cart['ProductId'] ?>"><img
                                            class=" cart__image" src="<?= $products['ImagesPath'] . $images[0] ?>"
                                            alt="<?= $products['Name'] ?>"></a>
                                </td>
                            </tr>
                            <tr class="cart__row border-bottom line1 cart-flex border-top">

                                <td>

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
                                            <?= $cart['Quantity'] ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="text-center">
                                        <b class="d-lg-none">order status</b>
                                        <div class="Name">
                                            <?= $status['Name'] ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="felx-item">
                                    <div class="text-center">
                                        <b class="d-lg-none">TotalPrice</b>
                                        <div class="price">
                                            ₹<?= $cart['TotalPrice'] ?>
                                        </div>
                                    </div>
                                    <?php
                                                if ($status['Name'] == "Shipped" || $status['Name'] == "Out for delivery" || $status['Name'] == "Delivered") {
                                                ?>
                                <td class="row justify-content-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button disabled="disabled"
                                        class="small--hide btn btn-secondary btn--small cart-continue">Cancel</button>
                                </td>
                                <?php
                                                } else {
                                        ?>
                                <td class="row justify-content-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="./cancelorder.php?id=<?= $cart['ProductId'] ?>"
                                        class="small--hide btn btn-secondary btn--small cart-continue">Cancel</a>
                                </td>
                                </td>
                                <?php
                                                }
                                        ?>
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
<?php
        }
?>
<br>
<td>
    <a href="./index.php" style="margin-left: 45%;" class=" btn btn-secondary  cart-continue">Continue shopping</a>
</td>
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