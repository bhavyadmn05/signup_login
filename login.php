<?php
// Start session to handle user login status
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Literacy</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sigunup-login.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div id="login-form" class="form-container active">
                    <h2>Login</h2>
                    <!-- Success Message -->
                    <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success mt-3">
                            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                        </div>
                    <?php } ?>
                    <form action="login_handler.php" method="POST">
                        <div class="form-group">
                            <label for="login-email">Email</label>
                            <input type="email" id="login-email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="login-password">Password</label>
                            <input type="password" id="login-password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <p class="text-center mt-3">
                            Don't have an account? <a href="signup.html">Sign Up</a>
                        </p>
                        <!-- Error Message -->
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger mt-3">
                                <?php echo htmlspecialchars($_GET['error']); ?>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
