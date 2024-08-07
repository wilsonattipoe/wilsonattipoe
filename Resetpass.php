<?php include('./include/header.php'); ?>

<body style="background-color:#2D1D4C;">
    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="card text-center" id="ResetPasswordModal">
            <div class="card-body">
                <h2 class="card-title">Reset Password</h2>
                <form id="resetPasswordForm" method="post">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password:</label>
                        <input type="password" class="form-control" id="new_password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <input type="hidden" id="token" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                    <div class="btn-toolbar justify-content-center" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group">
                            <input type="submit" value="Reset Password" class="btn btn-outline-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#resetPasswordForm').on('submit', function (e) {
                e.preventDefault();
                
                $.ajax({
                    url: './reset_password.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire("Success", response.message, "success").then(() => {
                                window.location.href = './login.php';
                            });
                        } else if (response.status === 'error') {
                            Swal.fire("Error", response.message, "error").then(() => {
                                if (response.message === 'Your password reset link has expired.') {
                                    window.location.href = './forgot-password.php'; // Redirect to Forget Password form
                                }
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire("Error", "An unexpected error occurred.", "error");
                    }
                });
            });
        });
    </script>
</body>
