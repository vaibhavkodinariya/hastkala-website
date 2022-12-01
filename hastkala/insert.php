<?php
    session_start();
    require './includes/database.php';
    
    $description=$_POST['Description'];
    $color=$_POST['Color'];
    $material=$_POST['Material'];
    $weight=$_POST['Weight'];
    $gender=$_POST['group1'];
    $composition=$_POST['Composition'];
    $name=$_POST['Pname'];
    $price=$_POST['Price'];
    $Stock=$_POST['AvStock'];

    if(!empty($_POST['category']))
    {
        $selected = $_POST['category'];
    }
    
    $stmt = $database->prepare("INSERT INTO products(Name,Details,Price,Quantity,Color,Weight,Material,ForGender,Composition,CategoryID)
    VALUES (:Name,:Details,:Price,:Quantity,:Color,:Weight,:Material,:ForGender,:Composition,:CategoryID)");
    $stmt->bindParam(':Name', $name);
    $stmt->bindParam(':Details', $description);
    $stmt->bindParam(':Price', $price);
    $stmt->bindParam(':Quantity', $Stock);
    $stmt->bindParam(':Color', $color);
    $stmt->bindParam(':Weight', $weight);
    $stmt->bindParam(':Material', $material);
    $stmt->bindParam(':ForGender', $gender);
    $stmt->bindParam(':Composition', $composition);
    $stmt->bindParam(':CategoryID', $selected);
    $stmt->execute();

    $productid = $database->lastInsertId();

    if(isset($_POST['checkbox']))
    {
        if(!empty($_POST['checkbox']))
        {
            foreach($_POST['checkbox'] as $s=>$k)
            {
                echo "*cloth*". $k . "*cloth*"."<br>";
                $stmt=$database->prepare("INSERT INTO productssize(ProductId,Sizeid)VALUES (:ProductId,:Sizeid)");
                $stmt->bindParam(':ProductId',$productid);              
                $stmt->bindParam(':Sizeid',$k);
                $stmt->execute();          
           }
       }
    }
    if(isset($_POST['shoes']))
    {
       if(!empty($_POST['shoes']))
       {
           foreach($_POST['shoes'] as $s=>$k)
           {
                $k;
                echo"*shoes*". $k . "*shoes*";
                $stmt=$database->prepare("INSERT INTO productssize(ProductId,Sizeid)VALUES (:ProductId,:Sizeid)");
                $stmt->bindParam(':ProductId',$productid);              
                $stmt->bindParam(':Sizeid',$k);
                $stmt->execute();
           }
       }
    }
    // ****IMAGE UPLOAD HERE ...!!!****
    echo"this is id = ";
    print_r ($productid);
    echo". ";
    $Fname=$productid;
    // echo"$Fname";
    if(mkdir("images/$Fname"))
    {
        echo"done!";
    }     
    echo "out if";
    
        echo "in if";
        for($i=0;$i<count($_FILES['fileToUpload']['name']);$i++)
        {
            $target_dir = "images/$Fname/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
            // Check if image file is a actual image or fake image
            if($check !== false){
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } 
            else
            {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            echo $_FILES["fileToUpload"]["tmp_name"][$i];
            echo $target_file;
            // Check if file already exists
            if (file_exists($target_file))
            {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            // {
            //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            //     $uploadOk = 0;
            // }
            if ($uploadOk == 0)
            {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } 
            else 
            {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file))
                {
                   
                    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i])). " has been uploaded.";
                    // // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
                    // echo "***".$target_file."***";
                    $flag=true;
                } 
                else
                {
                    $flag=false;
                    
                }
            }
            if($flag==true)
            {
                $stmt = $database->prepare("UPDATE products SET imagespath='$target_dir' WHERE id=?");
                $stmt->execute(array($productid));
            }
            else
            {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    
?>