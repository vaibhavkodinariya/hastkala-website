<html>
    <head>
        <title>Hastkala-registration </title>
        <link rel="icon" type="image/png" href="log3.png">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="style/materialize.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link type="text/css" rel="stylesheet" href="style/alert.css">
        <link rel="stylesheet" href="style/material-icons.css">
    </head>
    <style>
        #toast-container{
            min-width: 20%;
            top: 50% ;
            right: 50% ;
            transform: translateX(50%) translateY(50%);
        }
    </style>
    <body style="background-image: linear-gradient(to bottom right , rgba(255,255,0,0.500), rgba(255,0,0,0.700));">
        <div class="body">
            <div class="row">
                <form class="col s12" action="./process/createacc.php" method="post" id="form1" style="padding-top: 2em;">
                    <div style="width: 92%; height: 92%; background-image: url(./bg/14bg.jpg); alt: background_register; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1em; " class="col offset-m1 offset-s1 z-depth-5 responsive-img ">
                        <div class= "z-depth-5 col offset-m1 offset-s1" style=" width: 92%; height: 98%; background-color: #ffffffe9;">
                            <div class="section col m4 s12 offset-m3" >
                                <img class="responsive-img col m11" src="./logo/log3.1.png" alt="hastkala">
                            </div>
                            <div class="row">
                                <div class="input-field col m8 s12 offset-m1" style="margin-top: 3em;">
                                    <i class=" material-icons prefix "style="">mail</i>
                                    <input id="email" name="email" title="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="text" class="validate">
                                    <label for="email">&nbsp Email</label>
                                    <span class="helper-text" data-error="enter valid email eg. xyz@abc.com" ></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col m8 s12 offset-m1" style="margin-top: -1.5em;">
                                    <i class=" material-icons prefix  ">vpn_key</i>  
                                     <input id="password" name="password" type="password" minlength="8" maxlength="8" class="validate">
                                     <label for="password" >Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col m8 s12 offset-m1" style="margin-top: -1.5em;">
                                    <i class=" material-icons prefix  ">vpn_key</i>  
                                     <input id="confirm" name="Confirmpassword" type="password" minlength="8" maxlength="8" class="validate">
                                     <label for="confirm" >Confirm Password</label>
                                    <br>
                                    <br>     
                                    <!-- <input type="button" onclick="M.toast({html: 'I am a toast',classes: 'rounded'})" value="Toast"> -->
                                    <button type="submit" name="SubmitButton" class="chip waves-effect waves-light btn col m8 s10 offset-s2 offset-m2">Register</button><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            window.addEventListener("load", (e) => {
                let err = window.location.search;
                let abc =err.replace("?", "");
                if(abc == "error=1")
                {
                        M.toast({
                        html: 'Please Fill the Details', 
                    }) 
                }
                else if(abc=="error=2")
                {
                    M.toast({
                        html: 'Please Match Password and Confirm Password', 
                    })
                }
                else if(abc=="error=3")
                {
                    M.toast({
                        html: 'Account is Already Created..', 
                    })
                }
            })
           
        </script>
        <script type="text/javascript" src="style/materialize.js"></script>
    </body>
</html>