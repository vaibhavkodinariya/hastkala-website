<?php
session_start();
require './includes/database.php';

if (isset($_POST['Update']) && isset($_SESSION['id'])) {
    $qty = $_POST['updatesqty'];
    $pid = $_POST['productid'];
    $userid = $_SESSION['id'];
    $productsprice = $database->prepare("SELECT `Price` FROM `products` WHERE `ID` = ?");
    $productsprice->execute(array($pid));
    $price = $productsprice->fetch(PDO::FETCH_ASSOC);
    $finalprice = $price['Price'] * $qty;
    echo ("<br>" . $qty);
    echo ("<br>" . $finalprice);
    $query = "UPDATE `orders` SET `Quantity` = ?, `TotalPrice` = ? WHERE `ProductId` = ? AND UserID=?";
    $statement = $database->prepare($query);
    $statement->execute(array($qty, $finalprice, $pid, $userid));

    header("Location:./cart-variant1.php");
} else if (isset($_POST['Buy'])) {
    $qty = $_POST['updatesqty'];
    $pid = $_POST['productid'];
    $userid = $_SESSION['id'];
    $avaiquantity = $database->prepare("SELECT `Quantity`,`Price` FROM `products` WHERE `ID` = ?");
    $avaiquantity->execute(array($pid));
    $quantity = $avaiquantity->fetch(PDO::FETCH_ASSOC);

    $_SESSION['productid'] = $pid;
    $_SESSION['productQuantitypurchase'] = $qty;
    $_SESSION['TotalQuantity'] = $quantity['Quantity'];
    $_SESSION['avaQuantity'] = $_SESSION['TotalQuantity'] - $qty;
    unset($_SESSION['checkout']);
    header('Location:./proceedtopay.php');
}