<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['shop_id'])) {
    header("Location: login.php");
    exit;
}
$shop_id = $_SESSION['shop_id'];
$upload_dir = __DIR__ . '/uploads/';

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (isset($_POST['add_product'])) {
    $name = htmlspecialchars($_POST['product_name']);
    $price = (float) $_POST['price'];
    $quantity = (int) $_POST['quantity'];
    $expiry_date = $_POST['expiry_date'];
    $details = htmlspecialchars($_POST['details']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png'];

        if (!in_array($file_ext, $allowed_ext)) {
            die("Only JPG, JPEG, and PNG images are allowed!");
        }

        $file_name = uniqid("product_", true) . '.' . $file_ext;
        $upload_path = $upload_dir . $file_name;

        if (!move_uploaded_file($file_tmp, $upload_path)) {
            die("Image upload failed! Check folder permissions.");
        }

        $stmt = $pdo->prepare("INSERT INTO products (shop_id, name, image, price, quantity, expiry_date, details) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$shop_id, $name, $file_name, $price, $quantity, $expiry_date, $details])) {
            echo "<script>alert('Product added successfully!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to add product!');</script>";
        }
    } else {
        echo "<script>alert('Image upload error: " . $_FILES['image']['error'] . "');</script>";
    }
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE shop_id = ?");
$stmt->execute([$shop_id]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['delete_product'])) {
    $product_id = (int) $_GET['delete_product'];

    $stmt = $pdo->prepare("SELECT image FROM products WHERE id = ? AND shop_id = ?");
    $stmt->execute([$product_id, $shop_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $image_path = $upload_dir . $product['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ? AND shop_id = ?");
        if ($stmt->execute([$product_id, $shop_id])) {
            echo "<script>alert('Product deleted!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to delete product!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('uploads/img2.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            max-width: 650px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4"   style="font-size: 1.5rem; font-weight: bold;">Welcome to Your Shop</h2>
        <div class="d-flex justify-content-between mb-3">
            <h4>Add Product</h4>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <form method="POST" enctype="multipart/form-data" class="mb-4">
            <div class="mb-3">
                <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
            </div>
            <div class="mb-3">
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="number" name="price" class="form-control" placeholder="Price" required>
            </div>
            <div class="mb-3">
                <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
            </div>
            <div class="mb-3">
                <input type="date" name="expiry_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <textarea name="details" class="form-control" placeholder="Product Details"></textarea>
            </div>
            <button type="submit" name="add_product" class="btn btn-primary w-100">Add Product</button>
        </form>
        
        <h4>Your Products</h4>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Expiry Date</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><img src="uploads/<?= htmlspecialchars($product['image']) ?>" alt="Product Image"></td>
                        <td><?= $product['price'] ?></td>
                        <td><?= $product['quantity'] ?></td>
                        <td><?= $product['expiry_date'] ?></td>
                        <td><?= htmlspecialchars($product['details']) ?></td>
                        <td>
                            <a href="?delete_product=<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>