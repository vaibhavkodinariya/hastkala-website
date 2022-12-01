<?php
session_start();
require './includes/database.php';
require './includes/auth.php';
if (isset($_SESSION['Usertype'])) {
  if ($_SESSION['Usertype'] != "admin") {
    echo ("<script>
                window.location.href='./login.php'
            </script>");
  }
}
?>
<html>

<head>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/log3.2.2.png" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="logo/log3.png">
    <title>Hastkala Admin_panel</title>
    <link rel="stylesheet" href="style/material-icons.css">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="style/materialize.css" media="screen,projection" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="style/jquery-2.1.1.js"></script>
    <script src="style/materialize.js"></script>
    <!-- <script src="style/materialize.css"></script> -->
</head>

<body style="background-image: linear-gradient(to bottom right , rgba(0,255,0,0.600), rgba(0,0,255,0.600));">
    <nav class="nav-extended blue-grey darken-1">
        <div class="nav-wrapper">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <div class="row">
                <div class="col s9 l4 m3 offset-l4 offset-m3" style="margin-bottom: -9%;margin-top: -2%;">
                    <img class="responsive-img" src="logo/log3.3.3.png" alt="log">
                </div>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <div class="col m9 right">
                        <!-- <li class="right"></li> -->
                        <a href="./logout.php" style="margin-bottom: 10% ;"
                            class="right  waves-effect waves-light btn-flat col offset-m6"><i
                                class="material-icons left ">logout</i></a>

                    </div>
                </ul>
            </div>
        </div>
        <div class="nav-content" style="margin-top: 5%;">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a href="#addproduct">add new product</a></li>
                <li class="tab"><a href="#updateproduct">update product details / delete product </a></li>
                <li class="tab"><a href="#orders">Orders/Stock alert</a></li>
            </ul>
        </div>
    </nav>
    <ul id="slide-out" class="sidenav">

        <li><a href="./logout.php"><i class="material-icons">logout</i>logout</a></li>

    </ul>
    <div id="addproduct">
        <div class="row">
            <div class="z-depth-5 col m8 s10 offset-m2 offset-s1" style="margin-top: 5%; background-color: #ffffffe9;">
                <h4 class="center"
                    style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif ;">
                    Add New Product</h4>
                <!-- <form action="./upload.php" enctype="multipart/form-data" method="POST" class=" col  m6 s8 offset-m3 offset-s2"> -->
                <form method="post" action="./insert.php" enctype="multipart/form-data"
                    class=" col  m6 s8 offset-m3 offset-s2">
                    <div class="row">
                        <select required name="category" id="category">
                            <option value="">choose a category</option>
                            <?php
              $stmt = $database->prepare("SELECT ID,Name FROM categories WHERE ParentCategoryID IS NULL");
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach ($result as $r) {
              ?>
                            <option value="<?= $r['ID']; ?>"><?= $r['Name']; ?></option>
                            <?php
              }
              ?>
                        </select>
                    </div>
                    <div class="row">
                        <select required disabled name="subcategory" id="subcategory">
                            <option>choose a Subcategory</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>file</span>
                                <input required type="file" name="fileToUpload[]" multiple id="">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" required name="fileName" type="text"
                                    placeholder="Upload image">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input type="text" required name="Pname" id="Pname">
                            <label for="Pname">Product Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <textarea id="textarea1" class="materialize-textarea" name="Description" required rows="20"
                                cols="10" data-length="120"></textarea>
                            <label for="textarea1">Description</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input type="text" name="Color" id="color">
                            <label for="color">color</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input type="text" required name="Material" id="material">
                            <label for="material">Material</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input type="text" required name="Weight" id="weight">
                            <label for="weight">weight</label>
                        </div>
                    </div>
                    <div class="row">
                        <label>
                            <h5>Select For Gender</h5>
                        </label>
                        <p>
                            <label>
                                <input required type="radio" id="male" value="Male" name="group1" />
                                <span>Male</span>
                            </label>&nbsp&nbsp&nbsp&nbsp
                            <label>
                                <input required type="radio" id="female" value="Female" name="group1" />
                                <span>Female</span>
                            </label>
                            <label>
                                <input required type="radio" id="other" value="other" name="group1" />
                                <span>Other</span>
                            </label>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input type="text" required name="Composition" id="composition">
                            <label for="composition">Composition</label>
                        </div>
                    </div>
                    <?php
          $stmt = $database->prepare("SELECT ID,FixedSize FROM sizes");
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>
                    <div id="sw" class="hide row">
                        <ul class="col m6 offset-m3 collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">straighten</i><b>size of tradi
                                        wear</b></div>
                                <div class="collapsible-body">

                                    <div>
                                        <p>
                                            <label>
                                                <input id="check-all" type="checkbox" onclick="checkAll(this)"
                                                    class="filled-in">
                                                <span>all</span>
                                            </label>
                                        </p>
                                        <?php
                    foreach ($result as $r) {
                      if ($r['ID'] < 7) {
                    ?>
                                        <p>
                                            <label>
                                                <input type="checkbox" name="checkbox[]" value="<?= $r['ID'] ?>"
                                                    onclick="checkItem()" class="check-item filled-in">
                                                <span><?= $r['FixedSize'] ?></span>
                                            </label>
                                        </p>
                                        <?php

                      }
                    }
                    ?>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div id="sf" class="hide row">
                        <ul class="col m6 offset-m3 collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">straighten</i><b>size of foot
                                        ware</b></div>
                                <div class="collapsible-body">
                                    <div>
                                        <p>
                                            <label>
                                                <input id="checkall" type="checkbox" onclick="check(this)"
                                                    class="filled-in">
                                                <span>all</span>
                                            </label>
                                        </p>
                                        <?php
                    foreach ($result as $r) {
                      if ($r['ID'] >= 7 && $r['ID'] <= 12) {
                    ?>
                                        <p>
                                            <label>
                                                <input type="checkbox" name="shoes[]" value="<?= $r['ID'] ?>"
                                                    onclick="checkthisItem()" class="checkitem filled-in">
                                                <span><?= $r['FixedSize'] ?></span>
                                            </label>
                                        </p>
                                        <?php
                      }
                    }
                    ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input type="number" required name="Price" id="price">
                            <label for="price">price</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input type="number" required name="AvStock" id="AvStock">
                            <label for="AvStock">Stock Available</label>
                        </div>
                    </div>
                    <!-- <button class=" chip waves-effect waves-light btn col m4 offset-m5 " value="Upload Image" type="submit" name="submit">submit</button> -->
                    <button class=" chip waves-effect waves-light btn col m4 s8 offset-s2 offset-m4 " type="submit"
                        name="submit">add</button>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="style/admin.js"></script>
    </div>

    <!-- ************UPDATE PRODUCT FROM HERE**************** -->
    <?php
  $stmt = $database->prepare("SELECT ID,Name,ImagesPath FROM products WHERE IsDelete IS NULL");
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
    <div id="updateproduct">
        <div class="row">
            <?php
      foreach ($result as $row) {
        $images = array_values(array_diff(scandir($row['ImagesPath']), array('.', '..')));
        // $a=implode($images); 
      ?>
            <div class="card container col s4 m2" style="margin: 25px;">
                <div class="container col offset-m2 card-image">
                    <img style="height: 150px;" src="<?= $row['ImagesPath'] . "/" . $images[0] ?>">
                </div>
                <div class="row">
                    <div class="col">
                        <div style="height: 95px;" class="col card-content">
                            <p><?= $row['Name'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="col card-action">
                            <form action="Product_update.php" method="post">
                                <input type="hidden" name="productid" value='<?= $row['ID'] ?>'>
                                <button type="submit" class="btn-flat">Update</button>
                            </form>

                            <form action="delete.php?id=<?= $row['ID'] ?>" method='post'>
                                <button type="submit" class="btn-flat">delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
      }

      ?>
        </div>
    </div>
    </div>
    <!-- ****ORDER**** -->
    <div id="orders">

        <div class="container">
            <div class="card row">
                <div class="col-12 col-sm-5 col-md-12 col-lg-12 main-col">
                    <table>
                        <thead class="cart__row cart__header">
                            <tr>
                                <th colspan="2" class="text-center">Product</th>
                                <th class="text-center">UserID</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Order status</th>
                                <th class="text-right">Total</th>
                                <th class="action">&nbsp;</th>
                            </tr>
                        </thead>
                        <?php
            $orderstatus = 1;
            $statement = $database->prepare("SELECT * FROM orders WHERE OrderStatusID!=?");
            $statement->execute(array($orderstatus));
            $cart = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>
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
                                    <b class="hide-on-med-and-up">Price</b>
                                    <span class="money"><?= $cart['UserID'] ?></span>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item">
                                    <b class="hide-on-med-and-up">Price</b>
                                    <span class="money">₹<?= $products['Price'] ?></span>
                                </td>
                                <td class="text-right">
                                    <div class="text-center">
                                        <b class="hide-on-med-and-up">Quantity</b>
                                        <div class="qtyField">
                                            <?= $cart['Quantity'] ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="text-center">
                                        <b class="hide-on-med-and-up">order status</b>
                                        <div class="qtyField">
                                            <div class="row">
                                                <select required name="status" id="<?= $cart['OrderID'] ?>">
                                                    <option selected value="<?=$status['OrderStatusID']?>"><?=$status['Name']?></option>
                                                    <?php
                            $stmt = $database->prepare("SELECT OrderStatusID,Name FROM orderstatus WHERE OrderStatusID!=?");
                            $stmt->execute(array(1));
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $r) {
                            ?>
                                                    <option value="<?= $r['OrderStatusID']; ?>"><?= $r['Name']; ?>
                                                    </option>
                                                    <?php
                            }
                            ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class=" cart-price">
                                    <div><span class="money">₹<?= $cart['TotalPrice'] ?></span></div>
                                </td>
                                <td class="row justify-content-center">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="button" onclick="updateOrder(<?=$cart['OrderID'] ?>)"
                                        class="hide-on-med-and-down btn btn-secondary" value="Update">
                                </td>
                            </tr>
                        </tbody>
                        <?php
            }
            ?>

                    </table>
                </div>
            </div>
            <!-- ****END ORDER**** -->
            <!-- stock -->
            <div class="container">
                <div class="card row">
                    <div class="col-12 col-sm-5 col-md-12 col-lg-12 main-col">
                        <table>
                            <thead class="cart__row cart__header">
                                <tr>
                                    <th colspan="2" class="text-center">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="action">&nbsp;</th>
                                </tr>
                            </thead>
                            <?php
              $productsdetails = $database->prepare("SELECT `ID`,`Name`,`Price`,`ImagesPath`,`Details`,`Quantity` FROM `products` WHERE `Quantity` <= ?");
              $productsdetails->execute(array(25));
              $products = $productsdetails->fetchAll(PDO::FETCH_ASSOC);
              foreach ($products as $cart) {
                $images = array_values(array_diff(scandir($cart['ImagesPath']), array('.', '..')));
              ?>
                            <tbody>
                                <tr class="cart__row border-bottom line1 cart-flex border-top">
                                    <td class="cart__image-wrapper cart-flex-item">
                                        <a href="./product-accordion.php?id=<?= $cart['ID'] ?>"><img class="cart__image"
                                                src="<?= $cart['ImagesPath'] . $images[0] ?>"
                                                alt="<?= $cart['Name'] ?>"></a>
                                    </td>
                                    <td class="cart__meta small--text-left cart-flex-item">
                                        <div class="list-view-item__title">
                                            <a><?= $cart['Name'] ?></a>
                                        </div>

                                        <div class="cart__meta-text">
                                            Details:&nbsp;<?= $cart['Details'] ?>
                                        </div>
                                    </td>

                                    <td class="cart__price-wrapper cart-flex-item">
                                        <b class="hide-on-med-and-up">Price</b>
                                        <span class="money">₹<?= $cart['Price'] ?></span>
                                    </td>
                                    <td class="text-right">
                                        <div class="text-center">
                                            <b class="hide-on-med-and-up">Quantity</b>
                                            <div class="qtyField">
                                                <?= $cart['Quantity'] ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <?php
              }
              ?>

                        </table>
                    </div>
                </div>
                <!-- stock end -->
                <script>
                $(document).ready(function() {
                    $('select').formSelect();
                });

                function updateOrder(orderId) {
                    let select = document.getElementById(orderId);
                    let orderStatusId = select.value;
                    window.location.href = "./adminorder.php?orderid=" + orderId + "&status=" + orderStatusId;
                }
                </script>
                <script>
                //  <script src="assets/js/vendor/jquery-3.3.1.min.js">
                </script>
                <script src="assets/js/vendor/jquery.cookie.js"></script>
                <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
                <script src="assets/js/vendor/wow.min.js"></script>
                <script src="assets/js/bootstrap.min.js"></script>
                <script src="assets/js/plugins.js"></script>
                <script src="assets/js/lazysizes.js"></script>
                <script src="assets/js/main.js"></script>
                </script>
</body>

</html>