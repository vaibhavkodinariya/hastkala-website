<?php
    require './includes/database.php';
    require './includes/auth.php';
    $pid=$_GET['id'];
    $stmt = $database->prepare("UPDATE products SET isdelete=? WHERE id=?");
    $stmt->execute(array(1,$pid));
    header('Location:./admin.php');
?>