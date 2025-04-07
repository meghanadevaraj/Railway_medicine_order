<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "train_tracking_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT t.train_name, t.train_number, s.station_name, r.arrival_time, r.departure_time 
        FROM trains t 
        JOIN routes r ON t.id = r.train_id 
        JOIN stations s ON r.station_id = s.id 
        ORDER BY t.train_name ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Train List</title>
</head>
<body align="center" style="background-color:rgb(212, 221, 227);">
    <h2 style="color:rgba(235, 8, 8, 0.84);">List of All Trains</h2>
    <table align="center" border="1">
        <tr>
            <th>Train Name</th>
            <th>Train Number</th>
            <th>Station</th>
            <th>Arrival Time</th>
            <th>Departure Time</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['train_name']; ?></td>
                <td><?php echo $row['train_number']; ?></td>
                <td><?php echo $row['station_name']; ?></td>
                <td><?php echo $row['arrival_time']; ?></td>
                <td><?php echo $row['departure_time']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <a href="index.php">Go to index Page</a>
</body>
</html>
<?php
$conn->close();
?>