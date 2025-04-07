<?php
require '../config/db.php';
session_start();

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from database
    $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: dashboard.php"); // Redirect to user dashboard
        exit;
    } else {
        $msg = "❌ Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('uploads/image.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 650px;
            margin-top: 60px;
            padding: 40px;
            
        }
        .card {
            border-radius: 10px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow">
            <h2 class="text-center mb-4"   style="font-size: 1.5rem; font-weight: bold;">User Login</h2>
            <p class="text-danger text-center"> <?= $msg; ?> </p>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href='user_register.php' class="btn btn-link">Don't have an account? Register here</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>