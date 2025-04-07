<?php
require '../config/db.php';

$train_info = "";
if (isset($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['train_search']);

    $sql = "SELECT t.train_name, t.train_number, s.station_name, r.arrival_time, r.departure_time 
            FROM trains t 
            JOIN routes r ON t.id = r.train_id 
            JOIN stations s ON r.station_id = s.id 
            WHERE t.train_name LIKE '%$search%' OR t.train_number LIKE '%$search%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $train_info .= "<table border='1'>
                        <tr>
                            <th>Train Name</th>
                            <th>Train Number</th>
                            <th>Station</th>
                            <th>Arrival Time</th>
                            <th>Departure Time</th>
                        </tr>";
        while ($row = $result->fetch_assoc()) {
            $train_info .= "<tr>
                                <td>{$row['train_name']}</td>
                                <td>{$row['train_number']}</td>
                                <td>{$row['station_name']}</td>
                                <td>{$row['arrival_time']}</td>
                                <td>{$row['departure_time']}</td>
                            </tr>";
        }
        $train_info .= "</table>";
    } else {
        $train_info = "<p>No train found!</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Train Status</title>
</head>

<body>
    <h2>Search Train Status</h2>
    <form method="POST" action="">
        <input type="text" name="train_search" placeholder="Enter Train Name or Number" required>
        <button type="submit" name="search">Search</button>
    </form>
    <br>
    <?php echo $train_info; ?>
</body>

</html>