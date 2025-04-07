<?php
require '../config/db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch all trains
$stmt = $pdo->query("SELECT * FROM trains");
$trains = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all stations (ordered by ID ASC)
$stmt = $pdo->query("SELECT * FROM stations ORDER BY id ASC");
$stations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $train_id = $_POST['train_id'] ?? '';
    $station_ids = $_POST['station_ids'] ?? [];
    $arrival_times = $_POST['arrival_times'] ?? [];
    $departure_times = $_POST['departure_times'] ?? [];
    $travel_times = $_POST['travel_times'] ?? [];
    $distances = $_POST['distances'] ?? [];

    if (empty($train_id) || empty($station_ids) || empty($arrival_times) || empty($departure_times)) {
        echo "<script>alert('Please fill in all required fields!');</script>";
    } else {
        try {
            $pdo->beginTransaction();

            foreach ($station_ids as $index => $station_id) {
                $arrival_time = $arrival_times[$index] ?? '';
                $departure_time = $departure_times[$index] ?? '';

                $stmt = $pdo->prepare("INSERT INTO routes (train_id, station_id, arrival_time, departure_time, distance, travel_duration) 
                                       VALUES (?, ?, ?, ?, ?, ?)");

                if (!$stmt->execute([$train_id, $station_id, $arrival_time, $departure_time, $distances[$index] ?? 0, $travel_times[$index] ?? 0])) {
                    throw new Exception("Insert failed for station ID: $station_id");
                }
            }

            $pdo->commit();
            echo "<script>alert('Routes added successfully!'); window.location.href='define_routes.php';</script>";
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Define Train Routes</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('img4.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin-top: 30px;
            background-color: #ffffff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
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

        .station-entry {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f1f1f1;
        }

        .station-entry label {
            margin-top: 10px;
        }

        .station-entry select,
        .station-entry input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button[type="button"] {
            background-color: #28a745;
            border: none;
            padding: 2px 7px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        button[type="button"]:hover {
            background-color: #218838;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .station-entry .form-group {
            margin-bottom: 15px;
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

    <div class="container">
        <h1   style="font-size: 1.5rem; font-weight: bold;">Define Train Routes</h1>
        <form method="POST">
            <div class="mb-4">
                <label for="train_id" class="form-label">Select Train:</label>
                <select name="train_id" class="form-control" required>
                    <option value="">Select Train</option>
                    <?php foreach ($trains as $train): ?>
                        <option value="<?= $train['id']; ?>"><?= $train['train_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="stationFields">
                <div class="station-entry">
                    <div class="form-group">
                        <label>Select Station:</label>
                        <select name="station_ids[]" class="form-control station-select" required>
                            <option value="">Select Station</option>
                            <?php foreach ($stations as $station): ?>
                                <option value="<?= $station['id']; ?>"><?= $station['station_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Arrival Time:</label>
                        <input type="time" name="arrival_times[]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Departure Time:</label>
                        <input type="time" name="departure_times[]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Travel Time from Previous Station (minutes):</label>
                        <input type="number" name="travel_times[]" min="0" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Distance from Previous Station (km):</label>
                        <input type="number" step="0.1" name="distances[]" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-success" onclick="addStation()">Add Another Station</button>
                <button type="submit" class="btn btn-primary">Add Routes</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function addStation() {
            let container = document.getElementById("stationFields");
            let newEntry = document.querySelector(".station-entry").cloneNode(true);

            newEntry.querySelectorAll("select").forEach(select => select.value = "");
            newEntry.querySelectorAll("input").forEach(input => input.value = "");

            container.appendChild(newEntry);
        }
    </script>
</body>

</html>
