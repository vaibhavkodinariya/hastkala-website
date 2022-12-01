<?php
session_start();
require './includes/database.php';
?>
<?php
$orderstatus = 1;
$userid = $_SESSION['id'];
$checkouttopay = $database->prepare("SELECT Quantity,ProductId,TotalPrice,SizeID FROM orders WHERE UserID=? AND OrderStatusID=?");
$checkouttopay->execute(array($userid, $orderstatus));
$checkoutdetails = $checkouttopay->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['checkout'] = array();
$_SESSION['checkout'] = $checkoutdetails;
unset($_SESSION['productid'], $_SESSION['avaQuantity'], $_SESSION['productQuantitypurchase'], $_SESSION['TotalQuantity']);
header('Location:proceedtopay.php');
?>