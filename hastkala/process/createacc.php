<?php
  require '../includes/database.php';
  if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['Confirmpassword']))
  {
      header('Location: ../registration.php?error=1');
      die();
  }
  $email=$_POST['email'];
  $psd=$_POST['password'];
  $cpsd=$_POST['Confirmpassword'];
  if($psd!=$cpsd)
  {
      header('Location: ../registration.php?error=2');
      die();
  }

   $show=$database->prepare("SELECT Email FROM users");
   $show->execute();
   $results=$show->fetchAll(PDO::FETCH_ASSOC);
   if($results)
   {
       foreach($results as $r)
       {
           $r["Email"];
           if($email==$r["Email"])
           {
               header('Location: ../registration.php?error=3');
               die();
           }
       }
   }
   if(isset($_POST['email']) || isset($_POST['password']) || isset($_POST['Confirmpassword']))
       {
           try
           {
               $hash=password_hash($psd,PASSWORD_DEFAULT);
               $accsql=$database->prepare("INSERT INTO users(Email,PasswordHash)VALUES(:email,:password)");
               $accsql->bindParam(':email', $email);
               $accsql->bindParam(':password', $hash);
               $accsql->execute();
               header("Location: ../login.php");
           }
           catch(PDOException $e)
           {
               echo "Error".$e->getMessage();
           }
       }
?>