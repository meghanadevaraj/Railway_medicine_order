<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $shop_name = trim($_POST['shop_name']);
    $station_id = $_POST['station_id'];

    $stmt = $pdo->prepare("INSERT INTO shops (name, email, password, shop_name, station_id) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $password, $shop_name, $station_id])) {
        echo "✅ Registration successful! <a href='login.php'>Login Here</a>";
    } else {
        echo "❌ Registration failed!";
    }
}

// Fetch stations
$stations = $pdo->query("SELECT id, station_name FROM stations")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         body {
            background: url('uploads/image.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4"  style="font-size: 1.5rem; font-weight: bold;">Shop Registration</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Your Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Shop Name</label>
                <input type="text" name="shop_name" class="form-control" placeholder="Enter your shop name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nearest Station</label>
                <select name="station_id" class="form-select" required>
                    <option value="">Select Nearest Station</option>
                    <?php foreach ($stations as $station): ?>
                        <option value="<?= $station['id'] ?>"><?= $station['station_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
        <div class="text-center mt-3">
            <a href="login.php">Already have an account? Login</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>