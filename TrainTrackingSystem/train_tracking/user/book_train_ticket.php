<?php
require '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("❌ Access Denied! Please <a href='user_login.php'>Login</a> first.");
}

$user_id = $_SESSION['user_id'];
$msg = "";

// Fetch available trains
$stmt = $pdo->query("SELECT id, train_name, train_number, total_coaches, seating_capacity, ticket_price FROM trains WHERE seating_capacity > 0");
$trains = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch user's booked tickets
$stmt = $pdo->prepare("SELECT t.id AS train_id, t.train_name, t.train_number, tk.pnr_number, tk.coach_number, tk.seat_number, tk.status 
                       FROM tickets tk 
                       JOIN trains t ON tk.train_id = t.id 
                       WHERE tk.user_id = ?");
$stmt->execute([$user_id]);
$booked_tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['train_id'])) {
    $train_id = $_POST['train_id'];

    // Check if the user has already booked a ticket for the train
    $stmt = $pdo->prepare("SELECT id FROM tickets WHERE user_id = ? AND train_id = ?");
    $stmt->execute([$user_id, $train_id]);
    if ($stmt->fetch()) {
        $msg = "❌ You have already booked a ticket for this train!";
    } else {
        // Generate PNR Number
        $pnr_number = 'PNR' . rand(100000, 999999);

        // Fetch train details
        $stmt = $pdo->prepare("SELECT total_coaches, seating_capacity FROM trains WHERE id = ?");
        $stmt->execute([$train_id]);
        $train = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($train && $train['seating_capacity'] > 0) {
            $total_coaches = $train['total_coaches'];
            $seating_capacity = $train['seating_capacity'];

            // Generate a random coach number and seat number
            $coach_number = rand(1, $total_coaches);
            do {
                $seat_number = rand(1, $seating_capacity);

                // Check if the seat is already booked
                $stmt = $pdo->prepare("SELECT id FROM tickets WHERE train_id = ? AND coach_number = ? AND seat_number = ?");
                $stmt->execute([$train_id, $coach_number, $seat_number]);
                $seat_taken = $stmt->fetch();
            } while ($seat_taken);

            // Book the ticket
            $stmt = $pdo->prepare("INSERT INTO tickets (user_id, train_id, pnr_number, status, coach_number, seat_number) 
                                   VALUES (?, ?, ?, 'booked', ?, ?)");
            $stmt->execute([$user_id, $train_id, $pnr_number, $coach_number, $seat_number]);

            // Reduce seat count
            $stmt = $pdo->prepare("UPDATE trains SET seating_capacity = seating_capacity - 1 WHERE id = ?");
            $stmt->execute([$train_id]);

            $msg = "✅ Ticket booked successfully!<br>PNR: <b>$pnr_number</b><br>Coach: <b>$coach_number</b>, Seat: <b>$seat_number</b>";
        } else {
            $msg = "❌ No seats available!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Train Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('uploads/img9.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 650px;
            margin-top: 30px;
        }
        .card {
            border-radius: 10px;
        }
    </style>
    <script>
        function updateTrainDetails() {
            var selectedTrain = document.getElementById("train_id");
            var trainData = JSON.parse(selectedTrain.options[selectedTrain.selectedIndex].dataset.details);

            document.getElementById("total_coaches").value = trainData.total_coaches;
            document.getElementById("seating_capacity").value = trainData.seating_capacity;
            document.getElementById("ticket_price").value = trainData.ticket_price;
        }
        
        function fetchTrainStations(trainId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "fetch_train_stations.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("train_stations").innerHTML = xhr.responseText;
                }
            };
            xhr.send("train_id=" + trainId);
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="card shadow p-4">
            <h2 class="text-center">Book Train Ticket</h2>
            <p class="text-danger text-center"><?= $msg; ?></p>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Select Train:</label>
                    <select class="form-select" name="train_id" id="train_id" required onchange="updateTrainDetails()">
                        <option value="">-- Select a Train --</option>
                        <?php foreach ($trains as $train): ?>
                            <option value="<?= $train['id']; ?>" data-details='<?= json_encode($train); ?>'>
                                <?= "{$train['train_name']} ({$train['train_number']})"; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Total Coaches:</label>
                        <input type="text" class="form-control" id="total_coaches" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Seats Left:</label>
                        <input type="text" class="form-control" id="seating_capacity" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Price:</label>
                        <input type="text" class="form-control" id="ticket_price" readonly>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary w-100">Book Now</button>
                </div>
            </form>
        </div>

        <div class="card shadow p-4 mt-5">
            <h2 class="text-center">My Booked Tickets</h2>
            <?php if (count($booked_tickets) > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Train Name</th>
                            <th>Train Number</th>
                            <th>PNR Number</th>
                            <th>Coach</th>
                            <th>Seat</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($booked_tickets as $ticket): ?>
                            <tr>
                                <td><?= $ticket['train_name']; ?></td>
                                <td><?= $ticket['train_number']; ?></td>
                                <td><?= $ticket['pnr_number']; ?></td>
                                <td><?= $ticket['coach_number']; ?></td>
                                <td><?= $ticket['seat_number']; ?></td>
                                <td><span class="badge bg-success">Booked</span></td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="fetchTrainStations(<?= $ticket['train_id']; ?>)">Show Details</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">No booked tickets found.</p>
            <?php endif; ?>
        </div>

        <div class="card shadow p-4 mt-5" style="background-color:rgb(244, 251, 119);" >
            <h2 class="text-center">Train Stations</h2>
            <div id="train_stations" class="text-center">Click "Show Details" to see station details.</div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
