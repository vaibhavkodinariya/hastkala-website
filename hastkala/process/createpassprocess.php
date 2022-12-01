<?php
    session_start();
?>
<?php
require '../includes/database.php';
$password=$_POST['Password'];
$confrimpassword=$_POST['ConfirmPassword'];
$id=$_SESSION['id'];
if(empty($_POST['Password']) && empty($_POST['ConfirmPassword']))
{
    header('Location: ../createpassword.php?err=1');
}
else if($password == $confrimpassword)
{
   try
   {
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $stmt = $database->prepare("UPDATE users SET PasswordHash=? WHERE ID=?");
        $stmt->execute(array($hash,$id));
        header('Location: ../login.php');
   }
   catch(PDOException $e)
   {
        echo("Error".$e);
   }
}   
else
{
    header('Location: ../createpassword.php?err=2');
}
?>