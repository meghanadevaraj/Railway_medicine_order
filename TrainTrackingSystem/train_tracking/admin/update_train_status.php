<?php
require '../config/db.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $train_id = $_POST['train_id'];
    $current_station = $_POST['current_station'];
    $next_station = $_POST['next_station'];
    $arrival_time = $_POST['arrival_time'];
    $departure_time = $_POST['departure_time'];

    // Check if train status exists
    $stmt = $pdo->prepare("SELECT id FROM train_movement WHERE train_id = ?");
    $stmt->execute([$train_id]);
    $train_status = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($train_status) {
        // Update existing record
        $stmt = $pdo->prepare("UPDATE train_movement SET current_station=?, next_station=?, arrival_time=?, departure_time=?, last_updated=NOW() WHERE train_id=?");
        $stmt->execute([$current_station, $next_station, $arrival_time, $departure_time, $train_id]);
        echo "Train status updated successfully!";
    } else {
        // Insert new record
        $stmt = $pdo->prepare("INSERT INTO train_movement (train_id, current_station, next_station, arrival_time, departure_time) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$train_id, $current_station, $next_station, $arrival_time, $departure_time]);
        echo "Train movement added successfully!";
    }
}

// Fetch Trains
$stmt = $pdo->query("SELECT * FROM trains");
$trains = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Train Status</title>
</head>

<body>
    <h1>Update Train Location</h1>
    <form method="POST">
        <label>Select Train:</label>
        <select name="train_id">
            <?php foreach ($trains as $train): ?>
                <option value="<?= $train['id']; ?>"><?= $train['train_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <label>Current Station:</label>
        <input type="text" name="current_station" required>
        <label>Next Station:</label>
        <input type="text" name="next_station" required>
        <label>Arrival Time:</label>
        <input type="time" name="arrival_time" required>
        <label>Departure Time:</label>
        <input type="time" name="departure_time" required>
        <button type="submit">Update Status</button>
    </form>
</body>

</html>