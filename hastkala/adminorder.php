<?php
    require './includes/database.php';
        $orderid=$_GET['orderid'];
        $status=$_GET['status'];
        $stmt = $database->prepare("UPDATE orders SET OrderStatusID=? WHERE OrderID=?");
        $stmt->execute(array($status,$orderid));
        header('Location:./admin.php');
?>