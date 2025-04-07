<?php
require '../config/db.php';

if (isset($_GET['pnr_number'])) {
    $pnr_number = $_GET['pnr_number'];

    $stmt = $pdo->prepare("
        SELECT tm.current_station, tm.next_station, tm.arrival_time, tm.departure_time, tm.status 
        FROM train_movement tm 
        JOIN tickets t ON tm.train_id = t.train_id
        WHERE t.pnr_number = ?
    ");
    $stmt->execute([$pnr_number]);
    $train_status = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($train_status) {
        echo json_encode($train_status);
    } else {
        echo json_encode(["error" => "Train status not available"]);
    }
}
?>