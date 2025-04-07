<?php
require '../config/db.php';
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        echo "<script>alert('Login successful!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Invalid credentials!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('image.png') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }
        
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        
        .login-container {
            max-width: 650px;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
            width: 80%;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="login-container col-md-4">
            <h2 class="text-center mb-4"  style="font-size: 1.5rem; font-weight: bold;">Admin Login</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            </form>
            <!--<div class="text-center mt-3">
            <a href="admin_register.php">New user? Register here</a>
        </div>-->
        
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

