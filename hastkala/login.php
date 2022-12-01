<html>

<head>
    <title>Hastkala-login </title>
    <link rel="icon" type="image/png" href="logo/log3.png">
    <link rel="stylesheet" href="style/material-icons.css">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="style/materialize.css" media="screen,projection" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" rel="stylesheet" href="style/alert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
#toast-container {
    min-width: 20%;
    top: 50%;
    right: 50%;
    transform: translateX(50%) translateY(50%);
}
</style>

<body style="background-image: linear-gradient(to bottom right , rgba(255,255,0,0.500), rgba(255,0,0,0.700));">
    <div class="body">
        <div class="row">
            <form class="col s12" action="./process/loginpro.php" method="POST" style="padding-top: 4%;">
                <div style="width: 85%; height: 85%; background-image: url(./bg/bg8.jpg);alt: background ; background-repeat: no-repeat; background-size: 100% 100%;"
                    class="container z-depth-5 ">
                    <div style="width: 83%; height: 100%; background-color: rgba(255, 255, 255, 0.753); "
                        class="z-depth-5 col offset-m1 offset-s1">
                        <div class="section col m4 s12 offset-m4">
                            <img class="responsive-img" style="margin-left: 0.4em;" src="./logo/log3.1.png"
                                alt="hastkala">
                        </div>
                        <div class="row">
                            <div class=" input-field col m8 s12 offset-m2 " style="margin-top: 3em;">
                                <i class=" material-icons prefix ">mail</i>
                                <input id="email" name="Email" required title=""
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="text" class="validate">
                                <label for="email">&nbsp Email</label>
                                <span class="helper-text" data-error="enter valid email eg. xyz@abc.com"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m8 s12 offset-m2" style="margin-top: -1.5em;">
                                <i class=" material-icons prefix  ">vpn_key</i>
                                <input id="password" name="Password" type="password" required minlength="8"
                                    maxlength="8" class="validate">
                                <label for="password">Password</label>

                                <button type="submit"
                                    class="chip waves-effect waves-light btn col m9 s10 offset-s1 offset-m2">login</button><br>
                                <a href="./chanpassword.php"
                                    class="col m4 offset-m2 chip waves-effect waves-light btn">Change password? click
                                    here.</a>
                                <a href="./registration.php" class="col m5 chip waves-effect waves-light btn"> new
                                    here.. ? / click to register. </a>
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
        let abc = err.replace("?", "");
        if (abc == "incorrect") {
            M.toast({
                html: 'Incorrect Email or Password',
            })
        }
    })
    </script>
    <script type="text/javascript" src="style/materialize.js"></script>
</body>

</html>