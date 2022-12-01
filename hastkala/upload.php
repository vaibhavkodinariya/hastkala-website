<?php require "includes\database.php" ?>
<?php
  $stmt = $database->prepare("SELECT ID FROM products");
  $stmt->execute();
   $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach($result as $r)
  {
   $productid=$r['ID'];
  }
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
      if(isset($_POST["submit"])) 
      {
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
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
        {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }
        if ($uploadOk == 0)
        {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } 
        else 
        {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file))
          {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i])). " has been uploaded.";
          } 
          else
          {
            echo "Sorry, there was an error uploading your file.";
          }
        }
      }
    }
 ?>

 <?php
  //  echo"this is id = ";
  //  print_r ($productid);
  //  echo". ";
  //  $Fname=$productid;
  //  // echo"$Fname";
  //  if(mkdir("images/$Fname"))
  //  {
  //      echo"done!";
  //  }     
  //  echo "out if";
  //  if(isset($_POST["submit"])) 
  //  {
  //      echo "in if";
  //      for($i=0;$i<count($_FILES['fileToUpload']['name']);$i++)
  //      {
  //          $target_dir = "images/$Fname/";
  //          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
  //          $uploadOk = 1;
  //          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  //          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
  //          // Check if image file is a actual image or fake image
  //          if($check !== false){
  //              echo "File is an image - " . $check["mime"] . ".";
  //              $uploadOk = 1;
  //          } 
  //          else
  //          {
  //              echo "File is not an image.";
  //              $uploadOk = 0;
  //          }
  //          echo $_FILES["fileToUpload"]["tmp_name"][$i];
  //          echo $target_file;
  //          // Check if file already exists
  //          if (file_exists($target_file))
  //          {
  //              echo "Sorry, file already exists.";
  //              $uploadOk = 0;
  //          }
  //          // Allow certain file formats
  //          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
  //          {
  //              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  //              $uploadOk = 0;
  //          }
  //          if ($uploadOk == 0)
  //          {
  //              echo "Sorry, your file was not uploaded.";
  //              // if everything is ok, try to upload file
  //          } 
  //          else 
  //          {
  //              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file))
  //              {
  //                  echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i])). " has been uploaded.";
  //                  // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
  //                  echo "***".$target_file."***";
  //                  $stmt=$database->prepare("INSERT INTO imagepath(productID,pathimage)VALUES (:productID,:pathimage)");
  //                  $stmt->bindParam(':productID',$productid);              
  //                  $stmt->bindParam(':pathimage',$target_file);
  //                  $stmt->execute();
  //              } 
  //              else
  //              {
  //                  echo "Sorry, there was an error uploading your file.";
  //              }
  //          }
  //      }
  //  }
 ?>