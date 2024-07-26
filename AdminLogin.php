<?php include("./include/header.php"); ?>

<div class="login-container">
  <div class="contents">
    <div class="form-block">
      <div class="text-center mb-5">
        <h5><strong> LOGIN</strong></h5>
      </div>
      <div class="login">
        <div class="form-group">
          <label for="username">Email:</label>
          <input type="text" class="form-control" placeholder="Enter your email address" id="Email">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" placeholder="Enter your password" id="password">
        </div>
        <span class="ml-auto"><a href="/AdminForgetpass.php" class="forgot-pass">Forgot Password</a></span>
        <input type="submit" value="Log In" class="btn btn-block btn-primary" onclick="Login()">
      </div>
    </div>
  </div>
</div>

<style>
  .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f7f7f7;

  }

  .contents {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    width: 200vh;
  }

  .form-block {
    background-color: #ffffff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    /* Adjust the width as needed */
    text-align: left;
    /* Align form elements to the left */
  }

  .form-group {
    margin-bottom: 20px;
    /* Increased margin for better separation */
  }

  .form-control {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    /* Ensure padding and border are included in width */
  }

  .forgot-pass {
    display: block;
    margin-top: 10px;
    text-align: right;
  }

  .btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }

  @media (max-width: 768px) {
    .form-block {
      padding: 20px;
    }
  }
</style>
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