<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/material-icons.css">
    <link rel="stylesheet" href="style/material-icons.css">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="style/materialize.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>    
        <script type = "text/javascript" src = "style/jquery-2.1.1.js"></script>   
        <link type="text/css" rel="stylesheet" href="style/alert.css">          
     <script src = "style/materialize 1.js"></script> 
    <title>Hastkala-Verify Details</title>
    <link rel="icon" type="image/png" href="logo/log3.png">
    <style>
        #toast-container{
            min-width: 20%;
            top: 40% ;
            right: 50% ;
            transform: translateX(50%) translateY(50%);
        }
    </style>
</head>
<body style="background: linear-gradient(90deg, rgba(16,241,83,0.8018557764902836) 35%, rgba(71,148,240,0.8970938717283788) 90%);">
        <div class="body">
            <div class="row">
                <form class="col s9" action="./process/proverify.php" method="post" style="padding-top: 7%;">
                    <div class= "z-depth-5 col offset-m4 offset-s6" style="width: 68%; height: auto; background-color: rgba(240,240,240);">
                        <h1 class="center col m12 s4 offset-s1" style="font-family:'Times New Roman Georgia Garamond';" >Verify Your Details</h1>
                        <div class="row">
                            <div class="input-field col m7 s11 offset-m2">
                                <i class=" material-icons prefix "style="">mail</i>
                                <input id="Email" type="text" name="Email" title="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="validate">
                                <label for="Email">Email</label>
                                <span class="helper-text" data-error="enter valid email eg. xyz@abc.com" ></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m7 s11 offset-m2">
                                <i class=" material-icons prefix">vpn_key</i>  
                                <input id="Password" type="password" name="Password" minlength="8" maxlength="8" class="validate">
                                <label for="Password">Password</label>
                            </div>
                        </div>
                        <br>
                        <button type="submit" name="Verify" class=" chip waves-effect waves-light btn col m4 s8 offset-s2 offset-m4 ">Verify</button>
                    </div>   
                </form>
            </div>
        <script>
            window.addEventListener("load", (e) => {
                let err = window.location.search;
                let abc =err.replace("?", "");
                if(abc == "incorrect")
                {
                        M.toast({
                        html: 'Incorrect Email or Password', 
                    }) 
                }
            })
        </script>
         <script type="text/javascript" src="style/materialize.js"></script> 
        </div>
    </body>
</html>