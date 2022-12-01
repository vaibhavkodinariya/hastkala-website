<?php
session_start();
require 'includes/database.php';
require 'includes/auth.php';
?>
<?php
if (isset($_SESSION['id'])) {
    $quantity = $_POST['quantity'];
    $pid = $_SESSION['productid'];
    $userId = $_SESSION['id'];
    if (isset($_POST['sz'])) {
        $s = implode($_POST['sz']);
    } else {
        $s = null;
    }
    if (!isset($_POST['quantity'])) {
        header('Location:product-accordion.php?id=' . $pid);
    }
    $currentDateTimeObj = new DateTime('now', new DateTimeZone('Asia/Calcutta'));
    $currentDateTime = $currentDateTimeObj->format('Y-m-d H:i:s');
    $orderStatus = 1;
    //products data
    $statement = $database->prepare("SELECT * FROM `products` WHERE `ID` = ?");
    $statement->execute(array($pid));
    $products = $statement->fetch(PDO::FETCH_ASSOC);

    $price = $products['Price'];

    //check ava quantity
    if ($quantity > $products['Quantity']) {
        header('Location:product-accordion.php?id=' . $pid);
    }
    // Checking whether the cart already exists or not
    $statement = $database->prepare("SELECT * FROM `orders` WHERE `ProductId`=? AND `UserID` = ? AND `OrderStatusID` = ?");
    $statement->execute(array($pid, $userId, $orderStatus));
    $order = $statement->fetch(PDO::FETCH_ASSOC);
    print_r($order);
    $orderId = null;
    if ($order != null)
        $orderId = $order['OrderID'];
    else {
        $totalprice = $quantity * $price;
        $query = "INSERT INTO `orders` (`DateTime`,`Quantity`,`TotalPrice`,`SizeID`,`ProductId`,`OrderStatusID`,`UserID`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $database->prepare($query);
        $statement->execute(array($currentDateTime, $quantity, $totalprice, $s, $pid, $orderStatus, $userId));
        echo ("<br>" . $quantity);
        $orderId = $database->lastInsertId('orders');
        header('Location:./product-accordion.php?id=' . $pid . "&add=cart");
        exit();
    }
    $statement = $database->prepare("SELECT * FROM `orders` WHERE `OrderID` = ? AND `ProductId` = ?");
    $statement->execute(array($orderId, $pid));
    $orderedProduct = $statement->fetch(PDO::FETCH_ASSOC);

    if ($orderedProduct) {
        $newQuantity = $orderedProduct['Quantity'] + $quantity;
        $newTotalPrice = $products['Price'] * $newQuantity;
        $query = "UPDATE `orders` SET `Quantity` = ?, `TotalPrice` = ? WHERE `OrderID` = ?";
        $statement = $database->prepare($query);
        $statement->execute(array($newQuantity, $newTotalPrice, $orderedProduct['OrderID']));
        header('Location:./product-accordion.php?id=' . $pid . "&add=cart");
    }
} else {
    header('Location:./index.php');
}
?>