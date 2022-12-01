<?php
session_start();
require './includes/database.php';
$orderid=$_GET['oid'];
$userid=$_SESSION['id'];
$orderdelete = $database->exec("DELETE FROM orders WHERE OrderID=$orderid AND UserID=$userid");
header('Location:cart-variant1.php');
?>