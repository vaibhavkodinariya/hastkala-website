<?php 
session_start();
    require './includes/auth.php';
    require './includes/database.php';
    require './process/logged.php';
?>      

<html>
    <head>
        <link rel="icon" type="image/png" href="logo/log3.png">
        <title>Hastkala-User_profile</title>
        <link rel="stylesheet" href="style/material-icons.css">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="style/materialize.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>    
        <script type = "text/javascript" src = "style/jquery-2.1.1.js"></script>   
        <link type="text/css" rel="stylesheet" href="style/alert.css">          
     <script src = "style/materialize 1.js"></script> 
     <?php
            
            if(isset($_GET['msg']))
            {
                $success=$_GET['msg'];
                if($success==1)
                {
                    $msg="Please Fill the Data..";
                }
                else if($success==2)
                {
                    $msg="Data Inserted..";   
                }
                else if($success==3)
                {
                    $msg="Your Profile Updated...";   
                }
            }     
        ?>
    </head>
    <body style="background-image: linear-gradient(to bottom right , rgba(0,255,0,0.600), rgba(0,0,255,0.600));">
        <div class="body">
            <div class="row ">
                <form class="col s12" action="./process/profilepro.php" method="post" style="padding-top: 1em;">
                        <div class= "z-depth-5 col offset-m2 offset-s2" style="width: 68%; height: auto; background-color: #ffffffe9;">
                <a href="./index.php" class="right  waves-effect waves-light btn-flat col offset-m6"><i class="material-icons left ">logout</i></a>
                                <h1 class="center col m12 s4 offset-s1" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif ;" >Profile</h1>
                                <div class="row ">  
                                <div class="container">
                                    <div id="male" class="section col m3 s6 offset-m2 offset-s3">
                                        <img class="circle responsive-img" src="an/male.gif" alt="male">
                                    </div>
                                    <div class="col s12 m5 offset-m2">
                                        <ul class="tabs">
                                        <li class="tab col m6"><a id="M" href="#male"><input id="ma" name="g1[]" value="male" type="radio">male</a></li>
                                        <li class="tab col m6"><a id="F" href="#female"><input id="fe" name="g1[]" value="female" type="radio">female</a></li>
                                        </ul>
                                    </div>
                                    <div id="female" class="section col m3 s6 offset-m2 offset-s3" >  
                                        <img class=" circle responsive-img " src="an/female.gif" alt="female">
                                    </div>
                                    </div>
                                </div>
                                        <div class="row" >
                                            <div class="input-field col m6 s11 offset-m3 ">
                                                <i class="material-icons prefix">account_box</i>
                                                <input id="user_name" name="Name" value="<?=isset($r['Name'])?$r['Name']:''?>" type="text" required maxlength="50" class="validate">
                                                <label for="user_name">Name</label>   
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="input-field col m6 s11 offset-m3 ">
                                                    <i class=" material-icons prefix">call</i>
                                                    <input  id="mobile_number" name="Mobileno" value="<?=isset($r['MobileNumber'])?$r['MobileNumber']:'+91'?>" type="text" pattern="[+]{1}[0-9]{12}" title="use numeric values only for eg. (+91**********)/In beginning single '+' is mendatory" required maxlength="13" minlength="13" class="validate">
                                                    <label for="mobile_number">Phone Number</label>   
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s11 offset-m3 ">
                                                <i class=" material-icons prefix">domain</i>
                                                <label  for="address">House/Street/Area</label>    
                                                <input  id="address" name="Address"  value="<?=isset($r['Address'])?$r['Address']:''?>" class=" validate" required type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s11 offset-m3 ">
                                                <i class=" material-icons prefix">location_city</i>
                                                <label  for="state">State</label>    
                                                <input  id="state" name="State" value="<?=isset($r['State'])?$r['State']:''?>" required class=" validate" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s11 offset-m3 ">
                                                <i class=" material-icons prefix">markunread_mailbox</i>
                                                <label  for="pincode">pincode</label>    
                                                <input  id="pincode" name="Pincode"  value="<?=isset($r['Pincode'])?$r['Pincode']:''?>" required class=" validate" title="please use 6 digit numeric value only eg. (36***1)" type="text" maxlength="6" minlength="6" pattern="\d*">
                                            </div>
                                        </div>
                                    
                                        <div class="alert <?= !isset($success)?'hide':''?>">
                                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                                <strong><center><?=$msg?></center></strong>
                                        </div>
                                        <br>
                                    <?php
                                        if($flag==true)
                                        {   
                                    ?>
                                            <button type="submit" name="Update" class=" chip waves-effect waves-light btn col m4 s8 offset-s2 offset-m4 ">update</button>
                                    <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <button type="submit" name="Save" class=" chip waves-effect waves-light btn col m4 s8 offset-s2 offset-m4 ">save</button>                                            
                                         <?php
                                        }    
                                        ?>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <script>
            $('#M').on('click',function(){
                    $('#ma').attr('checked',true);
                })
                $('#F').on('click',function(){
                    $('#fe').attr('checked',true);
                })
        </script>   
    </body>
</html>