<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>

<body>
    <div id="login-box">
        <div class="left">
       
            <h1>Sign up</h1>
            <form method="post" id="formUp">
                <input type="text" name="name" placeholder="Username*" required />
                <input type="text" name="mobile" placeholder="Mobile*" required />
                <input type="text" name="email" placeholder="E-mail*" required />
                <input type="password" name="pw" placeholder="Password*" required />
            

                <input type="submit" name="submit" value="Sign me up" id="btn" />
        </div>
        
        </form>
        <div class="right">
            <span class="loginwith">Sign in with<br />social network</span>
            <button class="social-signin facebook">Log in with facebook</button>
            <button class="social-signin twitter">Log in with Twitter</button>
            <button class="social-signin google">Log in with Google+</button>
            <div id="ty" style="color:#a43a2b;"></div>
            <a href="login.php"><h4>Go To Login Page</h4></a>
        </div>
        <div class="or">OR</div>
        
       
    </div>
    
</body>
<script src="jquery.js"></script>
<script>
    $('#formUp').on('submit', function(e) {
        $("#btn").val("Please wait..");
        $("#btn").attr('disabled', true);
        $.ajax({
            url: 'adminsignup.php',
            type: 'post',
            data: $('#formUp').serialize(),
            success: function() {
                $('#ty').html('Registration Successfully!!').fadeOut(3000);
                $('#formUp')['0'].reset();
                $("#btn").val("Sign me up");
                $("#btn").attr('disabled', false);
            }
        });
        e.preventDefault();
    });
</script>

</html>