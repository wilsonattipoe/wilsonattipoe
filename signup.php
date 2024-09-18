<?php
include('include/header.php');
?>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="./img/about-1.jpg" style="height: 100%; width:100%;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account</h1>
                                    </div>
                                    <div class="user">
                                        <div id="signup">
                                            <!-- Full Name -->
                                            <div class="form-group" style="margin-bottom: 20px;">
                                                <input type="text" class="form-control form-control-user" id="fullName" placeholder="Enter full name">
                                            </div>
                                            <!-- Username -->
                                            <div class="form-group" style="margin-bottom: 20px;">
                                                <input type="text" class="form-control form-control-user" id="userName" placeholder="Enter username">
                                            </div>
                                            <!-- Email -->
                                            <div class="form-group" style="margin-bottom: 20px;">
                                                <input type="email" class="form-control form-control-user" id="signupEmail" placeholder="Email address">
                                            </div>
                                            <!-- Password -->
                                            <div class="form-group" style="margin-bottom: 20px;">
                                                <input type="password" class="form-control form-control-user" id="signupPassword" placeholder="Password">
                                            </div>
                                            <!-- Confirm Password -->
                                            <div class="form-group" style="margin-bottom: 20px;">
                                                <input type="password" class="form-control form-control-user" id="confirmPassword" placeholder="Confirm Password">
                                            </div>
                                            <!-- Contact -->
                                            <div class="form-group" style="margin-bottom: 20px;">
                                                <input type="text" class="form-control form-control-user" id="contact" placeholder="Contact number">
                                            </div>
                                            <!-- Location -->
                                            <div class="form-group" style="margin-bottom: 20px;">
                                                <input type="text" class="form-control form-control-user" id="location" placeholder="Location">
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block" style="margin: 0 auto; display: block;" onclick="Signup()">
                                                Sign Up
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/login.php">Already have an account? Login!</a>
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
        function Signup() {
            var fullName = $('#signup #fullName').val();
            var userName = $('#signup #userName').val();
            var email = $('#signup #signupEmail').val();
            var password = $('#signup #signupPassword').val();
            var confirmPassword = $('#signup #confirmPassword').val();
            var contact = $('#signup #contact').val();
            var location = $('#signup #location').val();

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
                    contact: contact,
                    location: location
                },
                url: 'user_signUp_backend.php',
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
                    showToast("error", "Signup failed. Please try again.");
                }
            });
        }

        function clearFields() {
            $('#signup #fullName').val('');
            $('#signup #userName').val('');
            $('#signup #signupEmail').val('');
            $('#signup #signupPassword').val('');
            $('#signup #confirmPassword').val('');
            $('#signup #contact').val('');
            $('#signup #location').val('');
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
