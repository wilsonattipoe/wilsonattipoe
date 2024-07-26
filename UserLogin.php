<?php
include("./include/header.php");
?>

<div class="wrapper">
    <div class="title-text">
        <div class="title login">Login Form</div>
        <div class="title signup">Signup Form</div>
    </div>
    <div class="form-container">
        <div class="slide-controls">
            <input type="radio" name="slide" id="login" checked>
            <input type="radio" name="slide" id="signup">
            <label for="login" class="slide login">Login</label>
            <label for="signup" class="slide signup">Signup</label>
            <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
            <div id="form" class="login login2">
                <div class="field">
                    <input type="text" id="email" placeholder="Email Address" >
                </div>
                <div class="field">
                    <input type="password" id="password" placeholder="Password" >
                </div>
                <div class="pass-link"><a href="#">Forgot password?</a></div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Login">
                </div>
                <div class="signup-link">Not a member? <a href="">Signup now</a></div>
            </div>
            <div id="form" class="signup signup2">
                <div class="field">
                    <input type="text" placeholder="full name" >
                </div>
                <div class="field">
                    <input type="text" placeholder="user name" >
                </div>
                <div class="field">
                    <input type="text" placeholder="Email Address" >
                </div>
                <div class="field">
                    <input type="password" placeholder="Password" >
                </div>
                <div class="field">
                    <input type="password" placeholder="Confirm password" >
                </div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Signup">
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    html,
    body {
        display: grid;
        height: 100%;
        width: 100%;
        place-items: center;
        background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6);
    }

    ::selection {
        background: #1a75ff;
        color: #fff;
    }

    .wrapper {
        overflow: hidden;
        max-width: 390px;
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
    }

    .wrapper .title-text {
        display: flex;
        width: 200%;
    }

    .wrapper .title {
        width: 50%;
        font-size: 35px;
        font-weight: 600;
        text-align: center;
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .wrapper .slide-controls {
        position: relative;
        display: flex;
        height: 50px;
        width: 100%;
        overflow: hidden;
        margin: 30px 0 10px 0;
        justify-content: space-between;
        border: 1px solid lightgrey;
        border-radius: 15px;
    }

    .slide-controls .slide {
        height: 100%;
        width: 100%;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        text-align: center;
        line-height: 48px;
        cursor: pointer;
        z-index: 1;
        transition: all 0.6s ease;
    }

    .slide-controls label.signup {
        color: #000;
    }

    .slide-controls .slider-tab {
        position: absolute;
        height: 100%;
        width: 50%;
        left: 0;
        z-index: 0;
        border-radius: 15px;
        background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6);
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    input[type="radio"] {
        display: none;
    }

    #signup:checked~.slider-tab {
        left: 50%;
    }

    #signup:checked~label.signup {
        color: #fff;
        cursor: default;
        user-select: none;
    }

    #signup:checked~label.login {
        color: #000;
    }

    #login:checked~label.signup {
        color: #000;
    }

    #login:checked~label.login {
        cursor: default;
        user-select: none;
    }

    .wrapper .form-container {
        width: 100%;
        overflow: hidden;
    }

    .form-container .form-inner {
        display: flex;
        width: 200%;
    }

    .form-container .form-inner #form {
        width: 50%;
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .form-inner #form .field {
        height: 50px;
        width: 100%;
        margin-top: 20px;
    }

    .form-inner #form .field input {
        height: 100%;
        width: 100%;
        outline: none;
        padding-left: 15px;
        border-radius: 15px;
        border: 1px solid lightgrey;
        border-bottom-width: 2px;
        font-size: 17px;
        transition: all 0.3s ease;
    }

    .form-inner #form .field input:focus {
        border-color: #1a75ff;
        /* box-shadow: inset 0 0 3px #fb6aae; */
    }

    .form-inner #form .field input::placeholder {
        color: #999;
        transition: all 0.3s ease;
    }

    #form .field input:focus::placeholder {
        color: #1a75ff;
    }

    .form-inner #form .pass-link {
        margin-top: 5px;
    }

    .form-inner #form .signup-link {
        text-align: center;
        margin-top: 30px;
    }

    .form-inner #form .pass-link a,
    .form-inner #form .signup-link a {
        color: #1a75ff;
        text-decoration: none;
    }

    .form-inner #form .pass-link a:hover,
    .form-inner #form .signup-link a:hover {
        text-decoration: underline;
    }

    #form .btn {
        height: 50px;
        width: 100%;
        border-radius: 15px;
        position: relative;
        overflow: hidden;
    }

    #form .btn .btn-layer {
        height: 100%;
        width: 300%;
        position: absolute;
        left: -100%;
        background: -webkit-linear-gradient(right, #003366, #004080, #0059b3, #0073e6);
        border-radius: 15px;
        transition: all 0.4s ease;
        ;
    }

    #form .btn:hover .btn-layer {
        left: 0;
    }

    #form .btn input[type="submit"] {
        height: 100%;
        width: 100%;
        z-index: 1;
        position: relative;
        background: none;
        border: none;
        color: #fff;
        padding-left: 0;
        border-radius: 15px;
        font-size: 20px;
        font-weight: 500;
        cursor: pointer;
    }
</style>

<script>
    const loginText = document.querySelector(".title-text .login");
    const loginForm = document.querySelector("#form.login");
    const loginBtn = document.querySelector("label.login");
    const signupBtn = document.querySelector("label.signup");
    const signupLink = document.querySelector("#form .signup-link a");
    signupBtn.onclick = (() => {
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
    });
    loginBtn.onclick = (() => {
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
    });
    signupLink.onclick = (() => {
        signupBtn.click();
        return false;
    });
</script>
<script>
    function Login() {
        var email = $('.login2 #loginEmail').val();
        var password = $('.login2 #loginPassword').val();

        $.ajax({
            type: 'post',
            data: {
                email: email,
                password: password,
            },
            url: 'user_login_backend.php',
            success: function(data) {
                var response = JSON.parse(data);
                if (response.success) {
                    showToast("success", response.message, response.redirect);
                } else {
                    showToast("error", response.message);
                }
            },
            error: function(xhr, status, error) {
                showToast("error", "Login failed. Please try again.");
            }
        });
    }

    function Signup() {
        var fullName = $('.signup2 #fullName').val();
        var userName = $('.signup2 #userName').val();
        var email = $('.signup2 #signupEmail').val();
        var password = $('.signup2 #signupPassword').val();
        var confirmPassword = $('.signup2 #confirmPassword').val();

        if (password !== confirmPassword) {
            showToast("error", "Passwords do not match");
            return;
        }

        $.ajax({
            type: 'post',
            data: {
                fullName: fullName,
                userName: userName,
                email: email,
                password: password,
            },
            url: 'user_signUp_backend.php',
            success: function(data) {
                var response = JSON.parse(data);
                if (response.success) {
                    showToast("success", response.message, response.redirect);
                } else {
                    showToast("error", response.message);
                }
            },
            error: function(xhr, status, error) {
                showToast("error", "Signup failed. Please try again.");
            }
        });
    }

    function showToast(icon, title, redirectUrl = null) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            }
        });

        Toast.fire({
            icon: icon,
            title: title
        }).then((result) => {
            if (redirectUrl) {
                window.location.href = redirectUrl;
            }
        });
    }
</script>


<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css" integrity="your-integrity-code" crossorigin="anonymous" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>