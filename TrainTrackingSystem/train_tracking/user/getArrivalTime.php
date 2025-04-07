<?php
header("Content-Type: application/json");
require '../config/db.php'; // Ensure you have a working DB connection

if (isset($_GET["stationId"])) {
    $stationId = $_GET["stationId"];

    // Debugging: Log the stationId being received
    error_log("Received stationId: " . $stationId);

    $stmt = $conn->prepare("SELECT arrival_time FROM routes WHERE station_id = ?");
    $stmt->bind_param("s", $stationId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode(["arrival_time" => $row["arrival_time"]]);
    } else {
        echo json_encode(["arrival_time" => "N/A"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "No stationId provided"]);
}
?>