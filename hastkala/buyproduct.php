<?php
session_start();
require './includes/database.php';
if (isset($_SESSION['checkout'])) {
    $userid = $_SESSION['id'];
    $orderstatus = 2;
    foreach ($_SESSION['checkout'] as $sessionvalue) {
        $pid = $sessionvalue['productid'];
        $availqty = $database->prepare("SELECT Quantity FROM products WHERE ID=?");
        $availqty->execute(array($pid));
        $totalqty = $availqty->fetch(PDO::FETCH_ASSOC);
        $purchaseqty = $sessionvalue['Quantity'];
        $remainingqty = $totalqty['Quantity'] - $purchaseqty;

        $updateqty = $database->prepare("UPDATE `products` SET `Quantity` = ? WHERE `ID` = ?");
        $updateqty->execute(array($remainingqty, $pid));

        $updatestatus = $database->prepare("UPDATE `orders` SET `OrderStatusID` = ? WHERE `UserID` = ? AND `ProductId` = ?");
        $updatestatus->execute(array($orderstatus, $userid, $pid));
        header('Location:order.php');
    }
} else {
    $userid = $_SESSION['id'];
    $pid = $_SESSION['productid'];
    $qty = $_SESSION['productQuantitypurchase'];
    $qtyremain = $_SESSION['avaQuantity'];
    $orderstatus = 2;
    $updateqty = $database->prepare("UPDATE `products` SET `Quantity` = ? WHERE `ID` = ?");
    $updateqty->execute(array($qtyremain, $pid));
    $updatestatus = $database->prepare("UPDATE `orders` SET `OrderStatusID` = ? WHERE `UserID` = ? AND `ProductId` = ?");
    $updatestatus->execute(array($orderstatus, $userid, $pid));
    header('Location:order.php');
}