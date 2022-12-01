<?php
    require("./includes/database.php");

    $catid = $_GET["catid"];

    $stmt=$database->prepare("SELECT * FROM categories WHERE ParentCategoryID=$catid");
    $stmt->execute(); 
    $data = array("data"=>array());
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row)
    {
        array_push($data["data"], array($row["ID"], $row["Name"]));
    }

    header("Content-Type: application/json");
    echo json_encode($data);
?>