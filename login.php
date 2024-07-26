<?php
include('include/header.php');
?>






<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="./img/login.jpg" style="height: 100%; width:100%; ">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <div class="user">
                                        <div id="login">
                                            <div class="form-group" style="margin-bottom: 20px;">
                                                <input type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Enter Email Address..." id="email">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 20px;">
                                                <input type="password" class="form-control form-control-user" placeholder="Password" id="password">
                                            </div>
                                            <div class="btn btn-google btn-user btn-block" style="margin-left: 30px;">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="btn btn-google btn-user btn-block" style="margin-left: 30px;">
                                        <a class="small" href="./signup.php">Create an Account!</a>
                                    </div><br><br>
                                    <hr>
                                            </div>
                                            <input type="submit" value="Login" onclick="Login()" class="btn btn-primary btn-user btn-block" style="margin: 0 auto; display: block;">
                                        </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        function Login() {
            var email = $('#login #email').val();
            var password = $('#login #password').val();

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
                        clearFields();
                    } else {
                        showToast("error", response.message);
                    }
                },
                error: function(xhr, status, error) {
                    showToast("error", "Login failed. Please try again.");
                }
            });
        }

        function clearFields() {
            $('#login #email').val('');
            $('#login #password').val('');
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