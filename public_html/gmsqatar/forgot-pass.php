<?php require('adminFunction.php');?>
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Admin | Login </title>

        <!-- CSS -->
        <link rel="stylesheet" href="css/style.css">
                
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

        

    <style>
        /* Google Fonts - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
.container{
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    /* background-color: #4070f4; */
    background: rgb(2,0,36);
    background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(65,37,224,1) 0%, rgba(80,34,206,1) 34%, rgba(255,0,0,1) 100%, rgba(0,212,255,1) 100%);
    column-gap: 30px;
}
.form{
    position: absolute;
    max-width: 430px;
    width: 100%;
    padding: 30px;
    border-radius: 6px;
    background: #FFF;
}
.form.signup{
    opacity: 0;
    pointer-events: none;
}
.forms.show-signup .form.signup{
    opacity: 1;
    pointer-events: auto;
}
.forms.show-signup .form.login{
    opacity: 0;
    pointer-events: none;
}

.form.forgot-pass{
    opacity: 0;
    pointer-events: none;
}
.forms.show-forgot-pass .form.forgot-pass{
    opacity: 1;
    pointer-events: auto;
}
.forms.show-forgot-pass .form.login{
    opacity: 0;
    pointer-events: none;
}

header{
    font-size: 28px;
    font-weight: 600;
    color: #232836;
    text-align: center;
}
form{
    margin-top: 30px;
}
.form .field{
    position: relative;
    height: 50px;
    width: 100%;
    margin-top: 20px;
    border-radius: 6px;
}
.field input,
.field button{
    height: 100%;
    width: 100%;
    border: none;
    font-size: 16px;
    font-weight: 400;
    border-radius: 6px;
}
.field input{
    outline: none;
    padding: 0 15px;
    border: 1px solid#CACACA;
}
.field input:focus{
    border-bottom-width: 2px;
}
.eye-icon{
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    font-size: 18px;
    color: #8b8b8b;
    cursor: pointer;
    padding: 5px;
}
.field button{
    color: #fff;
    background-color: #0171d3;
    transition: all 0.3s ease;
    cursor: pointer;
}
.field button:hover{
    background-color: #016dcb;
}
.form-link{
    text-align: center;
    margin-top: 10px;
}
.form-link span,
.form-link a{
    font-size: 14px;
    font-weight: 400;
    color: #232836;
}
.form a{
    color: #0171d3;
    text-decoration: none;
}
.form-content a:hover{
    text-decoration: underline;
}
.line{
    position: relative;
    height: 1px;
    width: 100%;
    margin: 36px 0;
    background-color: #d4d4d4;
}
.line::before{
    content: 'Or';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #FFF;
    color: #8b8b8b;
    padding: 0 15px;
}
.media-options a{
    display: flex;
    align-items: center;
    justify-content: center;
}
a.facebook{
    color: #fff;
    background-color: #4267b2;
}
a.facebook .facebook-icon{
    height: 28px;
    width: 28px;
    color: #0171d3;
    font-size: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff;
}
.facebook-icon,
img.google-img{
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
}
img.google-img{
    height: 20px;
    width: 20px;
    object-fit: cover;
}
a.google{
    border: 1px solid #CACACA;
}
a.google span{
    font-weight: 500;
    opacity: 0.6;
    color: #232836;
}
.form .field1{
    position: relative;
    height: 40px;
    width: 100%;
    margin-top: 10px;
    border-radius: 6px;
}
.field1 input,
.field1 button{
    height: 100%;
    width: 100%;
    border: none;
    font-size: 16px;
    font-weight: 400;
    border-radius: 6px;
}
.field1 input{
    outline: none;
    padding: 0 15px;
    border: 1px solid#CACACA;
}
.field1 input:focus{
    border-bottom-width: 2px;
}
.field1 button{
    color: #fff;
    background-color: #0171d3;
    transition: all 0.3s ease;
    cursor: pointer;
}
.field1 button:hover{
    background-color: #016dcb;
}

.social{
  margin-top: 25px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.social div{
  border-radius: 3px;
  color: #ff0000;
  text-align: center;
}


@media screen and (max-width: 400px) {
    .form{
        padding: 20px 10px;
    }
    
}
    </style>    
                        
    </head>
    <body>
        <section class="container forms">
            

            <!-- Forgot Paas -->

            <div class="form login">
                <div class="form-content">
                    <header><img src="img/logo-11.png" alt="" style="width:60px;"><br> Admin | Forgot Password</header>
                    <form action="adminFunction.php" method="POST">
                        <div class="field input-field">
                            <input type="number" placeholder="Mobile No" name="g_mob" class="input">
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="New Password" name="password" class="password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="form-link">
                            <div class="checkbox">
                                <input type="checkbox" id="remember-me">
                                <label for="agree"><a href="https://merigarage.com/terms.php"> I agree to the terms and conditions</a><br><a href="https://merigarage.com/privacypolicy.php">Privacy Policy</a></label>
                            </div>
                        </div>

                        <div class="field button-field">
                            <button type="submit" name="btn-sub3">Update Password</button>
                        </div>
                        
                        <div class="social">
                        <?php 
                            if(isset($_SESSION['msg5'])){
                                echo '<div>' . $_SESSION['msg5'] . '</div>';
                                unset($_SESSION['msg5']);
                            }
                        ?>
                        </div>

                    </form>

                    <div class="line"></div>
                    <div class="form-link">
                        <span>Already have an account? <a href="login.php" class="">Login</a></span>
                    </div>
                </div>

            </div>

            <!-- Signup Form -->

        </section>

        <!-- JavaScript -->
        <script src="js/script.js"></script>
        <script>
            const forms = document.querySelector(".forms"),
            pwShowHide = document.querySelectorAll(".eye-icon"),
            links = document.querySelectorAll(".link");

            pwShowHide.forEach(eyeIcon => {
            eyeIcon.addEventListener("click", () => {
            let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
        
                pwFields.forEach(password => {
                    if(password.type === "password"){
                        password.type = "text";
                        eyeIcon.classList.replace("bx-hide", "bx-show");
                        return;
                    }
                password.type = "password";
                eyeIcon.classList.replace("bx-show", "bx-hide");
                })
        
            })
        })      

// links.forEach(link => {
//     link.addEventListener("click", e => {
//        e.preventDefault(); //preventing form submit
//        forms.classList.toggle("show-signup");
//     })
// })

links.forEach(link => {
        link.addEventListener("click", e => {
            e.preventDefault(); // Preventing form submit
            if (link.classList.contains("forgot-pass-link")) {
                // If it's the "Forgot password?" link, show the forgot-pass form
                forms.classList.add("show-forgot-pass");
                forms.classList.remove("show-signup");
            } else if (link.classList.contains("login-link")) {
                // If it's the "Login" link in the "Signup" form, redirect to the login page
                window.location.href = "login.php"; // Replace with the actual URL of your login page
            } else {
                // If it's another link (e.g., "Signup" or "Login"), toggle the signup/login forms
                forms.classList.toggle("show-signup");
                forms.classList.remove("show-forgot-pass");
            }
        })
    })
        </script>
    </body>
</html>