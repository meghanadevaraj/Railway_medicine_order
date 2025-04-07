<?php
require '../config/db.php';

$train = null;
$train_status = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pnr_number = $_POST['pnr_number'];

    // Fetch Train, Coach & Seat Details
    $stmt = $pdo->prepare("
        SELECT tr.train_name, tr.total_coaches, t.coach_number, t.seat_number
        FROM tickets t 
        JOIN trains tr ON t.train_id = tr.id 
        WHERE t.pnr_number = ?
    ");
    $stmt->execute([$pnr_number]);
    $train = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($train) {
        // Fetch Train Status (Location & Next Station)
        $stmt = $pdo->prepare("
            SELECT current_station, next_station, arrival_time, departure_time, last_updated 
            FROM train_movement 
            WHERE train_id = (SELECT train_id FROM tickets WHERE pnr_number = ?)
        ");
        $stmt->execute([$pnr_number]);
        $train_status = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PNR Status & Train Details</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: url('uploads/img9.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 20px;
            padding: 40px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color:rgb(18, 25, 34);
            color: white;
            text-align: center;
        }
        .table td {
            text-align: center;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card p-4">
        <h2 class="text-center text-dark">Check Train, Coach & Status</h2>
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label class="form-label">Enter PNR Number:</label>
                <input type="text" name="pnr_number" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Check Details</button>
        </form>

        <?php if ($train): ?>
            <div class="mt-4">
                <h3 class="text-center text-success">Train & Coach Details</h3>
                <table class="table table-bordered">
                    <tr><th>Train Name</th><td><?= $train['train_name']; ?></td></tr>
                    <tr><th>Total Coaches</th><td><?= $train['total_coaches']; ?></td></tr>
                    <tr><th>Coach Number</th><td><?= $train['coach_number']; ?></td></tr>
                    <tr><th>Seat Number</th><td><?= $train['seat_number']; ?></td></tr>
                </table>
            </div>

            <?php if ($train_status): ?>
                <div class="mt-4">
                    <h3 class="text-center text-warning">Train Current Status</h3>
                    <table class="table table-bordered">
                        <tr><th>Current Station</th><td><?= $train_status['current_station']; ?></td></tr>
                        <tr><th>Next Station</th><td><?= $train_status['next_station']; ?></td></tr>
                        <tr><th>Arrival Time</th><td><?= $train_status['arrival_time']; ?></td></tr>
                        <tr><th>Departure Time</th><td><?= $train_status['departure_time']; ?></td></tr>
                        <tr><th>Last Updated</th><td><?= $train_status['last_updated']; ?></td></tr>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning mt-3">Train status not available yet.</div>
            <?php endif; ?>

        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <div class="alert alert-danger mt-3">Invalid PNR Number!</div>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>