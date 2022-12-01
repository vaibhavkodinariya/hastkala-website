<?php
session_start();
require './includes/database.php';
    $userid=$_SESSION['id'];
    $productid=$_GET['id'];
    $orderdelete = $database->exec("DELETE FROM orders WHERE ProductId=$productid AND UserID=$userid");
    header('Location:order.php');