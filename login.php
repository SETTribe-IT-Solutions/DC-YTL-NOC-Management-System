<!DOCTYPE html>
<html lang="en">
<head>
    <title>NOC Management System</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php include("include/cssLinks.php"); ?>
    <style>
        body {
            background-color: #ffffff;
        }
        .header-bar {
            background-color: #7e41c3;
            padding: 10px 20px;
            color: white;
        }
        .header-bar img {
            height: 60px;
        }
        .header-title {
            font-size: 22px;
            font-weight: bold;
        }
        .login-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 30px 10px;
        }
        .login-image {
            flex: 1;
            min-width: 300px;
            max-width: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .login-image img {
            max-width: 100%;
            height: auto;
        }
        .login-form {
            flex: 1;
            min-width: 300px;
            max-width: 400px;
            padding: 30px;
            background: #ffffff;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            border-radius: 10px;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header-bar d-flex align-items-center justify-content-between flex-wrap">
    <img src="assets/media/icons/india-emblem.png" alt="India Emblem">
    <div class="flex-grow-1 text-center header-title">NOC Management System</div>
    <img src="assets/media/icons/maharashtra-seal.png" alt="Maharashtra Seal">
</div>

<!-- Main Section -->
<div class="login-section">
    <!-- Left: Image -->
    <div class="login-image">
        <img src="img/login.png" alt="Login Illustration">
    </div>

    <!-- Right: Login Form -->
    <div class="login-form">
        <h3 class="text-center mb-4">लॉगिन</h3>
        <form method="post" action="login-check.php">
            <div class="mb-3">
                <label class="form-label">Mobile No</label>
                <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile No" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary" style="background-color:#7e41c3; border:none;">लॉगिन</button>
            </div>
            <div class="text-center">
                <a href="forgot-password.php">पासवर्ड विसरलात?</a><br>
                <a href="register.php">वापरकर्ता खाते नाही? नोंदणी करा</a>
            </div>
        </form>
    </div>
</div>

<?php include('include/jsLinks.php'); ?>
</body>
</html>
