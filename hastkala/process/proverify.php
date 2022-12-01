<?php
session_start();
?>
<?php                       
    require '../includes/database.php';
    try
    {
        if(isset($_POST['Email']) && isset($_POST['Password']))
        {
            $mail=$_POST['Email'];
            $psd=$_POST['Password'];
            $stmt=$database->prepare("SELECT ID,User_type,PasswordHash FROM users WHERE Email='$mail'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($result)==0)
            {
                header('Location: ../chanpassword.php?incorrect');
            }
            else
            {
                foreach($result as $r)
                {
                    $database_password = $r['PasswordHash'];
                    if(password_verify($psd,$database_password))
                    {
                        $_SESSION['id']=$result[0]['ID'];
                        header('Location: ../createpassword.php');
                    }                           
                    else
                    {                                                    
                        header('Location: ../chanpassword.php?incorrect');   
                    }
                } 
            }
        }
        
    }
    catch(PDOException $e)
    {
        echo("Something Wrong...").($e->getMessage());   
    }
   
?>