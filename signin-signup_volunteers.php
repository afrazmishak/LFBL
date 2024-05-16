<?php

include ("./system/config/dbconnection.php");

include ("./login_volunteers.php");
include ("./register_volunteers.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>LFBL | Login & Registration</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(270deg, #06142e, #000000);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            overflow: hidden;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 110vh;
            background: rgba(39, 39, 39, 0.4);
        }

        .nav {
            position: fixed;
            top: 0;
            display: flex;
            justify-content: space-around;
            width: 100%;
            height: 100px;
            line-height: 100px;
            background: linear-gradient(rgba(39, 39, 39, 0.6), transparent);
            z-index: 100;
        }

        .wrapper .nav .nav-logo img {
            height: 50px;
            padding-left: 10px;
            margin-top: 25px;
        }

        .nav-menu ul {
            display: flex;
        }

        .nav-menu ul li {
            list-style-type: none;
        }

        .nav-menu ul li .link {
            text-decoration: none;
            font-weight: 500;
            color: #fff;
            padding-bottom: 15px;
            margin: 0 25px;
        }

        .link:hover {
            border-bottom: 2px solid #fff;
        }

        .nav-button .btn {
            width: 130px;
            height: 40px;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.4);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: .3s ease;
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        #registerBtn {
            margin-left: 15px;
        }

        .btn.white-btn {
            background: rgba(255, 255, 255, 0.7);
        }

        .btn.btn.white-btn:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .nav-menu-btn {
            display: none;
        }

        .form-box {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 512px;
            height: 420px;
            overflow: hidden;
            z-index: 2;
        }

        .login-container {
            position: absolute;
            left: 4px;
            width: 500px;
            display: flex;
            flex-direction: column;
            transition: .5s ease-in-out;
        }

        .register-container {
            position: absolute;
            right: -520px;
            width: 500px;
            display: flex;
            flex-direction: column;
            transition: .5s ease-in-out;
        }

        .top span {
            color: #fff;
            font-size: small;
            padding: 10px 0;
            display: flex;
            justify-content: center;
        }

        .top span a {
            font-weight: 500;
            color: #fff;
            margin-left: 5px;
        }

        header {
            color: #fff;
            font-size: 30px;
            text-align: center;
            padding: 10px 0 30px 0;
        }

        .two-forms {
            display: flex;
            gap: 10px;
        }

        .input-field {
            font-size: 15px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            height: 50px;
            width: 100%;
            padding: 0 10px 0 45px;
            border: none;
            border-radius: 30px;
            outline: none;
            transition: .2s ease;
        }

        .input-field:hover,
        .input-field:focus {
            background: rgba(255, 255, 255, 0.25);
        }

        ::-webkit-input-placeholder {
            color: #fff;
        }

        .input-box i {
            position: relative;
            top: -35px;
            left: 17px;
            color: #fff;
        }

        .submit {
            font-size: 15px;
            font-weight: 500;
            color: black;
            height: 45px;
            width: 100%;
            border: none;
            border-radius: 30px;
            outline: none;
            background: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            transition: .3s ease-in-out;
        }

        .submit:hover {
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
        }

        .two-col {
            display: flex;
            justify-content: space-between;
            color: #fff;
            font-size: small;
            margin-top: 10px;
        }

        .two-col .one {
            display: flex;
            gap: 5px;
        }

        .two label a {
            text-decoration: none;
            color: #fff;
        }

        .two label a:hover {
            text-decoration: underline;
        }

        .blur-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 9998;
            display: none;
        }

        .popup {
            width: 400px;
            background: #fff;
            border-radius: 6px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.1);
            text-align: center;
            padding: 0 30px 30px;
            color: #333;
            visibility: hidden;
            transition: transform 0.4s, top 0.4s;
            z-index: 9999;
        }

        .popup.active {
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }

        .popup i {
            font-size: 100px;
            color: #333;
            width: 100px;
            margin-top: 30px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .popup h2 {
            font-size: 38px;
            font-weight: 500;
            margin: 30px 0 10px;
        }

        .popup button {
            width: 100%;
            margin-top: 50px;
            padding: 10px 0;
            background: #6fd649;
            color: #fff;
            border: 0;
            outline: none;
            font-size: 18px;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
        }

        @media only screen and (max-width: 786px) {
            .nav-button {
                display: none;
            }

            .nav-menu.responsive {
                top: 100px;
            }

            .nav-menu {
                position: absolute;
                top: -800px;
                display: flex;
                justify-content: center;
                background: rgba(255, 255, 255, 0.2);
                width: 100%;
                height: 90vh;
                backdrop-filter: blur(20px);
                transition: .3s;
            }

            .nav-menu ul {
                flex-direction: column;
                text-align: center;
            }

            .nav-menu-btn {
                display: block;
            }

            .nav-menu-btn i {
                font-size: 25px;
                color: #fff;
                padding: 10px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                cursor: pointer;
                transition: .3s;
            }

            .nav-menu-btn i:hover {
                background: rgba(255, 255, 255, 0.15);
            }
        }

        @media only screen and (max-width: 540px) {
            .wrapper {
                min-height: 100vh;
            }

            .form-box {
                width: 100%;
                height: 500px;
            }

            .register-container,
            .login-container {
                width: 100%;
                padding: 0 20px;
            }

            .register-container .two-forms {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <img src="./images/Logo Files/For Web/png/White logo - no background.png">
            </div>

            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="./index.html" class="link">Home</a></li>
                    <li><a href="" class="link">Services</a></li>
                    <li><a href="./index.html#aboutsection" class="link">About</a></li>
                </ul>
            </div>

            <div class="nav-button">
                <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
                <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>

            </div>
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>

        <div class="form-box">
            <form class="login-container" id="login" action="login_volunteers.php" method="POST">
                <div class="top">
                    <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                    <header>Volunteer | Login</header>
                </div>

                <div class="input-box">
                    <input type="text" class="input-field" name="email" placeholder="Email">
                    <i class="bx bx-user"></i>
                </div>

                <div class="input-box">
                    <input type="password" class="input-field" name="password" placeholder="Password">
                    <i class="bx bx-lock-alt"></i>
                </div>

                <div class="input-box">
                    <input type="submit" class="submit" name="submitLogin" value="Sign In">
                </div>

                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Forgot password?</a></label>
                    </div>
                </div>
            </form>

            <form class="register-container" id="register" action="register_volunteers.php" method="POST">
                <div class="top">
                    <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                    <header>Volunteer | Sign Up</header>
                </div>

                <div class="two-forms">
                    <div class="input-box">
                        <input type="text" class="input-field" name="firstname" placeholder="Firstname">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" name="lastname" placeholder="Lastname">
                        <i class="bx bx-user"></i>
                    </div>
                </div>

                <div class="input-box">
                    <input type="text" class="input-field" name="email" placeholder="Email">
                    <i class="bx bx-envelope"></i>
                </div>

                <div class="input-box">
                    <input type="password" class="input-field" name="userpassword" placeholder="Password">
                    <i class="bx bx-lock-alt"></i>
                </div>

                <div class="input-box">
                    <input type="submit" class="submit" name="submitRegister" value="Register">
                </div>

                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="register-check">
                        <label for="register-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Terms & conditions</a></label>
                    </div>
                </div>

                <div class="popup" id="popup">
                    <i class='bx bx-check-circle'></i>
                    <h2>Activation</h2>
                    <p>Account registration is successfully.</p>
                    <button type="button" onclick="closePopup()">OK</button>
                </div>

                <div class="blur-background" id="blur-background"></div>
            </form>
        </div>
    </div>
</body>

<script>

    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }

    // JavaScript function to show the popup when the DOM is fully loaded
    document.addEventListener("DOMContentLoaded", function () {
        var blurBackground = document.getElementById("blur-background");

        // Check if registration success session variable is set
        var registrationSuccess = "<?php echo isset($_SESSION['registration_success']) ? $_SESSION['registration_success'] : '' ?>";

        if (registrationSuccess) {
            var popup = document.getElementById("popup");

            // Show popup
            popup.classList.add("active");

            // Apply background blur
            blurBackground.style.display = "block";

            // Clear the session variable
            <?php unset($_SESSION['registration_success']); ?>;
        }
    });

    function closePopup() {
        var popup = document.getElementById("popup");
        popup.classList.remove("active");
        var blurBackground = document.getElementById("blur-background");
        blurBackground.style.display = "none";
    }
</script>

</html>