<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $age = intval($_POST['age']);
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']); // Keep only numbers
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // File upload handling
    if (isset($_FILES['age_proof']) && $_FILES['age_proof']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '/Applications/XAMPP/xamppfiles/htdocs/TrainTrackingSystem/train_tracking/user/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create if missing
        }

        $file_tmp = $_FILES['age_proof']['tmp_name'];
        $file_ext = strtolower(pathinfo($_FILES['age_proof']['name'], PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png'];

        if (!in_array($file_ext, $allowed_ext)) {
            die("❌ Only JPG, JPEG, and PNG files are allowed!");
        }

        $file_name = uniqid("age_proof_", true) . '.' . $file_ext;
        $upload_path = $upload_dir . $file_name;

        if (!move_uploaded_file($file_tmp, $upload_path)) {
            die("❌ Error moving uploaded file! Check folder permissions.");
        }
    } else {
        die("❌ File upload error: " . $_FILES['age_proof']['error']);
    }

    // Insert user into database
    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, age, phone, password, age_proof) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $age, $phone, $password, $file_name]);
        echo "✅ Registration successful!";
    } catch (PDOException $e) {
        die("❌ Database error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('uploads/image.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 20px;
            padding:2px;
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
            <h2 class="text-center mb-4"   style="font-size: 1.5rem; font-weight: bold;">User Registration</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Age:</label>
                    <input type="number" name="age" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone:</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Age Proof (Image):</label>
                    <input type="file" name="age_proof" class="form-control" accept="image/*" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </div>
                <div class="text-center mt-3">
                <a href='user_login.php' class="btn btn-link">Click here to Login</a>
            </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
