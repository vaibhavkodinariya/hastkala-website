<?php
        $logid=$_SESSION['id'];
        $stmt = $database->prepare("SELECT UserID FROM profiles WHERE UserID=$logid");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        $flag=null;
        foreach($result as $r)
        {
            if($logid==$r['UserID'])
            {
                $flag=true;
            }
            else
            {
                $flag=false;
            }   
        }
        if($flag==true)
        {
         
            $stmt = $database->prepare("SELECT Name,MobileNumber,Address,State,Gender,Pincode FROM profiles WHERE UserID=$logid");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $r)
            {
                $r['Name'].$r['MobileNumber'].$r['Address'].$r['Gender'].$r['State'].$r['Pincode'];
            }
        }   
?>