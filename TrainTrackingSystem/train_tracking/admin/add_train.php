<?php
require '../config/db.php';
$message = ''; // Variable to store the message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $train_name = $_POST['train_name'];
    $train_number = $_POST['train_number'];
    $total_coaches = $_POST['total_coaches'];
    $seating_capacity = $_POST['seating_capacity'];
    $ticket_price = $_POST['ticket_price'];

    // Check if train already exists
    $stmt = $pdo->prepare("SELECT id FROM trains WHERE train_number = ?");
    $stmt->execute([$train_number]);
    $existing_train = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_train) {
        $message = "Train with this number already exists!❌";
    } else {
        // Insert new train
        $stmt = $pdo->prepare("INSERT INTO trains (train_name, train_number, total_coaches, seating_capacity, ticket_price) 
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$train_name, $train_number, $total_coaches, $seating_capacity, $ticket_price]);
        $message = "Train added successfully!✅";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Train</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('img4.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            max-width: 600px;
            background: rgba(255, 255, 255, 0.9);
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h2 {
            color: #0d6efd;
        }

        label {
            color: #343a40;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .navbar {
            background-color:rgb(40, 58, 85);
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="padding: 30px 40px; height: 10px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"  style="font-size: 1.2rem; font-weight: bold;">🚆 Train Admin Panel</a>
        </div>
    </nav>

    <!-- Message Box -->
    <?php if ($message): ?>
        <div class="alert alert-info text-center" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4"  style="font-size: 1.5rem; font-weight: bold;">🚆 Add New Train</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Train Name:</label>
                <input type="text" class="form-control" name="train_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Train Number:</label>
                <input type="text" class="form-control" name="train_number" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Total Coaches:</label>
                <input type="number" class="form-control" name="total_coaches" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Seating Capacity:</label>
                <input type="number" class="form-control" name="seating_capacity" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ticket Price:</label>
                <input type="number" step="0.01" class="form-control" name="ticket_price" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">➕ Add Train</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
