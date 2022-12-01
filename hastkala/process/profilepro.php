<?php 
session_start();
    require '../includes/database.php';
    require './logged.php';
?>      
<?php
    $name=$_POST['Name'];
    $mobileno=$_POST['Mobileno'];
    $address=$_POST['Address'];
    $state=$_POST['State'];
    $pincode=$_POST['Pincode'];
    if(isset($_POST['g1']))
    {
        if(!empty($_POST['g1']))
        {
            foreach($_POST['g1'] as $value)
            {
                 $gender=$value;
                 echo($gender);
            }
        }
    }
    if(isset($_POST['Save']))
    {
        if(empty($_POST['Name']) || empty($_POST['Mobileno']) || empty($_POST['Address']) || empty($_POST['State']) || empty($_POST['Pincode']))
        {
            header('Location: ../profile.php?msg=1');
            die();
        }
        else if(isset($_POST['Name']) || isset($_POST['Mobileno']) || isset($_POST['Address']) || isset($_POST['State']) || isset($_POST['Pincode']))
        {
            try
            {      
                $insertsql=$database->prepare("INSERT INTO profiles(Name,MobileNumber,Address,State,Gender,Pincode,UserID)VALUES(:Name,:MobileNumber,:Address,:State,:Gender,:Pincode,:UserID)");
                $insertsql->bindParam(':Name',$name);
                $insertsql->bindParam(':MobileNumber',$mobileno);
                $insertsql->bindParam(':Address',$address);
                $insertsql->bindParam(':State',$state);
                $insertsql->bindParam(':Gender',$gender);
                $insertsql->bindParam(':Pincode',$pincode);
                $insertsql->bindParam(':UserID',$_SESSION['id']);
                $insertsql->execute();
                header('Location: ../profile.php?msg=2');
            }
            catch(PDOException $e)
            {
                echo "Not Inserted...".$e->getMessage(); 
            }
        }
    }
    else
    {
        $Updatesql = "UPDATE profiles SET Name='$name',MobileNumber='$mobileno',Address='$address',State='$state',Gender='$gender',Pincode='$pincode' WHERE UserID=$logid";
        $stmt = $database->prepare($Updatesql);
        $stmt->execute();
        header('Location: ../profile.php?msg=3');
    }
?>