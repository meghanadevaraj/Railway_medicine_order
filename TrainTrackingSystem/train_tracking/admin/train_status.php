<?php
require '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $train_id = $_POST['train_id'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE trains SET status = ? WHERE id = ?");
    $stmt->execute([$status, $train_id]);

    echo "Train status updated!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Status</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
             background: url('img.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            padding: 30px;
            margin-top: 50px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #0d6efd;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
        }

        .form-control,
        .form-select {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Update Train Status</h1>
        <form method="POST">
            <div class="form-group">
                <label for="train_id">Train ID:</label>
                <input type="number" name="train_id" id="train_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-select" required>
                    <opyion>...</option>
                    <option value="Running">Running</option>
                    <option value="Delayed">Delayed</option>
                    <option value="Stopped">Stopped</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Status</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
