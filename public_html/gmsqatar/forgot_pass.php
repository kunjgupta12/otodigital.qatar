<?php require('adminFunction.php'); 
$err = "";
$ses = "";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin|Register</title>
    <script language='javascript' type='text/javascript'>
        function DisableBackButton() {
            window.history.forward()
        }
        DisableBackButton();
        window.onload = DisableBackButton;
        window.onpageshow = function(evt) {
            if (evt.persisted) DisableBackButton()
        }
        window.onunload = function() {
            void(0)
        }
    </script>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Admin|Register</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
        <!--Stylesheet-->
        <!-- <script type="text/javascript">
    function preventBack(){
      window.history.forward()
    };
    setTimeout("preventBack()",0);
    window.onunload=function(){
      null;
    }
  </script> -->
        <style media="screen">
            *,
            *:before,
            *:after {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }

            body {
                background-color: #080710;
            }

            .background {
                width: 430px;
                height: 520px;
                position: absolute;
                transform: translate(-50%, -50%);
                left: 50%;
                top: 50%;
            }

            .background .shape {
                height: 200px;
                width: 200px;
                position: absolute;
                border-radius: 50%;
            }

            .shape:first-child {
                background: linear-gradient(#1845ad,
                        #23a2f6);
                left: -80px;
                top: -80px;
            }

            .shape:last-child {
                background: linear-gradient(to right,
                        #ff512f,
                        #f09819);
                right: -30px;
                bottom: -80px;
            }

            form {
                height: 570px;
                width: 400px;
                background-color: rgba(255, 255, 255, 0.13);
                position: absolute;
                transform: translate(-50%, -50%);
                top: 50%;
                left: 50%;
                border-radius: 10px;
                backdrop-filter: blur(10px);
                border: 2px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
                padding: 50px 35px;
            }

            form * {
                font-family: 'Poppins', sans-serif;
                color: #ffffff;
                letter-spacing: 0.5px;
                outline: none;
                border: none;
            }

            form h3 {
                font-size: 32px;
                font-weight: 500;
                line-height: 42px;
                text-align: center;
                margin-top: 30px;
                
            }

            label {
                display: block;
                margin-top: 30px;
                font-size: 16px;
                font-weight: 500;
            }

            input {
                display: block;
                height: 55px;
                width: 100%;
                background-color: rgba(255, 255, 255, 0.07);
                border-radius: 3px;
                padding: 0 10px;
                margin-top: 20px;
                font-size: 14px;
                font-weight: 300;
            }

            ::placeholder {
                color: #e5e5e5;
            }

            button {
                /* margin-left: 80px; */
                margin-top: 20px;
                width: 100%;
                height:10%;
                background-color: #ffffff;
                color: #080710;
                padding: 10px 0;
                font-size: 18px;
                font-weight: 600;
                border-radius: 5px;
                cursor: pointer;
            }

            .social {
                margin-top: 30px;
                display: flex;
            }

            .social div {
                background: red;
                width: 150px;
                border-radius: 3px;
                padding: 5px 10px 10px 5px;
                background-color: rgba(255, 255, 255, 0.27);
                color: #eaf0fb;
                text-align: center;
            }

            .social div:hover {
                background-color: rgba(255, 255, 255, 0.47);
            }

            .social .fb {
                margin-left: 25px;
            }

            .social i {
                margin-right: 4px;
            }
        </style>
    </head>

    <body>

        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <form action="adminFunction.php" method="POST">

            <h3>Admin|Forgot Password</h3>

            <!-- <input type="text" placeholder="Your Name*" name="username" id="username" value=""> -->
            <!-- <input type="text" placeholder="Old Username*" name="username" id="username"> -->
            <!-- <input type="email" placeholder="Your Email*" name="email" id="email"> -->
            <input type="number" placeholder="Your Contact*" name="g_mob" id="contact">
            <!-- <input type="address" placeholder="Your Address*" name="address" id="address"> -->
            <input type="text" placeholder="New Password*" name="password" id="password">
            <!--<input type="submit" class="btn btn-sm-primary" value="register" name="btn-sub2">-->
            <button type="submit" name="btn-sub3">Update Password</button>

            
            <!-- <label style="margin-left: 5px;">or</label> <br> -->
            <h4 style="margin-top: 40px;">Or,  <a href="login.php">Have an account? Login.</a></h4>
            <div class="social">
                <?php if (isset($_SESSION['msg6'])) {
                    echo $_SESSION['msg6'];
                    unset($_SESSION['msg6']);
                } ?>
            </div>
            <div class="social">
                <?php if (isset($_SESSION['msg7'])) {
                    echo $_SESSION['msg7'];
                    unset($_SESSION['msg7']);
                } ?>
            </div>
            
        </form>
    </body>

    </html>
</body>

</html>
