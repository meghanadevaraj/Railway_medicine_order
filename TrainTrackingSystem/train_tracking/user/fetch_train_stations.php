<?php
require '../config/db.php';

if (isset($_POST['train_id'])) {
    $train_id = $_POST['train_id'];

    // Fetch station details along with route information
    $stmt = $pdo->prepare("SELECT s.station_name, r.arrival_time, r.departure_time, r.distance, r.travel_duration 
                           FROM routes r 
                           JOIN stations s ON r.station_id = s.id 
                           WHERE r.train_id = ?
                           ORDER BY r.arrival_time");
    $stmt->execute([$train_id]);
    $routes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($routes) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Station Name</th>
                    <th>Arrival Time</th>
                    <th>Departure Time</th>
                    <th>Distance (km)</th>
                    <th>Travel Duration (min)</th>
                </tr>";
        foreach ($routes as $route) {
            echo "<tr>
                    <td>{$route['station_name']}</td>
                    <td>" . ($route['arrival_time'] ?: 'N/A') . "</td>
                    <td>" . ($route['departure_time'] ?: 'N/A') . "</td>
                    <td>" . ($route['distance'] ?: 'N/A') . "</td>
                    <td>" . ($route['travel_duration'] ?: 'N/A') . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No route details available for this train.</p>";
    }
}
?>