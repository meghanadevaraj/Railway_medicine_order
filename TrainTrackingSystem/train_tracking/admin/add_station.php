<?php
require '../config/db.php';
$message = ''; // Variable to store the message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $station_name = $_POST['station_name'];
    $station_code = $_POST['station_code'];
    $location = $_POST['location'];
    $distance_from_source = $_POST['distance_from_source'];

    // Check if station already exists
    $stmt = $pdo->prepare("SELECT id FROM stations WHERE station_code = ?");
    $stmt->execute([$station_code]);
    $existing_station = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_station) {
        $message= "Station with this code already exists!❌";
    } else {
        // Insert new station
        $stmt = $pdo->prepare("INSERT INTO stations (station_name, station_code, location, distance_from_source) 
                               VALUES (?, ?, ?, ?)");
        $stmt->execute([$station_name, $station_code, $location, $distance_from_source]);
        $message= "Station added successfully!✅";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Station</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('img4.jpg') no-repeat center center fixed;
            background-size: cover;
           
        }

        .container {
            max-width: 600px;
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            color: #0d6efd;
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Message box */
        .message-box {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .message-box .alert {
            margin-bottom: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .navbar {
            background-color:rgb(40, 58, 85);
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark " style="padding: 30px 40px; height: 10px;">
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

    <div class="container">
        <h1  style="font-size: 1.5rem; font-weight: bold;">Add New Station</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="station_name" class="form-label">Station Name:</label>
                <input type="text" class="form-control" id="station_name" name="station_name" required>
            </div>
            <div class="mb-3">
                <label for="station_code" class="form-label">Station Code:</label>
                <input type="text" class="form-control" id="station_code" name="station_code" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location:</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="distance_from_source" class="form-label">Distance from Source (km):</label>
                <input type="number" step="0.1" class="form-control" id="distance_from_source" name="distance_from_source" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">➕ Add Station</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
