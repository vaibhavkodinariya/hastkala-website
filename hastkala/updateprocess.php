<?php
  require './includes/database.php';
  $pname=$_POST['Pname'];
  $pdetails=$_POST['Pdetails'];
  $pcolor=$_POST['UpdateColor'];
  $pmaterial=$_POST['UpdateMaterial'];
  $pweight=$_POST['UpdateWeight'];
  $forgender=$_POST['group1'];
  $Pcomposition=$_POST['UpdateComposition'];
  $Pprice=$_POST['UpdatePrice'];
  $stock=$_POST['UpdateAvStock'];
  $pid=$_POST['pid'];
  $stmt = $database->prepare("UPDATE products SET Name='$pname',Details='$pdetails',Price='$Pprice',Quantity='$stock',Color='$pcolor',Weight='$pweight',Material='$pmaterial',ForGender='$forgender',Composition='$Pcomposition' WHERE ID=?");
  $stmt->execute(array($pid));
  echo("Records Updated..");

  // if(is_uploaded_file())
  // {
      if($_FILES['fileToUpload']['name']);
      {
        // echo("hi");
        for($i=0;$i<count($_FILES['fileToUpload']['name']);$i++)
        {
          $target_dir="images/".$pid."/";
          $n=implode($_FILES['fileToUpload']['name']);
          $target_file= $target_dir.$n;
          // $target_file=$_FILES['fileToUpload']['name'];
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
                    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
                    // echo "***".$target_file."***";
                    header("Location:./admin.php");

                } 
                else
                {
                  echo "Sorry, there was an error uploading your file.";
                }
            }
        }
      }
  // }
?>