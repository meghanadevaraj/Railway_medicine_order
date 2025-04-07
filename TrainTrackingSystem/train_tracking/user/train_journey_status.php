<?php
require '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die(json_encode(["error" => "Access Denied! Please login."]));
}

date_default_timezone_set('Asia/Kolkata');

$user_id = $_SESSION['user_id'];
$pnr_number = $_GET['pnr'] ?? '';

if (empty($pnr_number)) {
    die(json_encode(["error" => "Invalid request. PNR number missing."]));
}

// Fetch train ID and stations
$stmt = $pdo->prepare("
    SELECT tk.train_id, r.station_id, s.station_name, r.arrival_time, r.departure_time
    FROM tickets tk 
    JOIN routes r ON tk.train_id = r.train_id
    JOIN stations s ON r.station_id = s.id
    WHERE tk.pnr_number = ? AND tk.user_id = ?
    ORDER BY r.arrival_time ASC
");
$stmt->execute([$pnr_number, $user_id]);
$stations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$stations) {
    die(json_encode(["error" => "No station data found."]));
}

$current_time = new DateTime('now');
$past_stations = [];
$present_station = null;
$upcoming_stations = [];

foreach ($stations as $station) {
    $arrival_time = new DateTime($station['arrival_time']);
    $departure_time = new DateTime($station['departure_time']);

    if ($departure_time < $current_time) {
        $past_stations[] = $station;
    } elseif ($arrival_time <= $current_time && $departure_time >= $current_time) {
        $present_station = $station;
    } else {
        $upcoming_stations[] = $station;
    }
}

$shop_details = [];
foreach ($upcoming_stations as $station) {
    $stmt = $pdo->prepare("SELECT * FROM shops WHERE station_id = ?");
    $stmt->execute([$station['station_id']]);
    $shops = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($shops as $shop) {
        $shop_id = $shop['id'];
        $stmt = $pdo->prepare("SELECT id, name, image, price FROM products WHERE shop_id = ?");
        $stmt->execute([$shop_id]);
        $shop['products'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $shop_details[$station['station_id']][] = $shop;
    }
}

// Return JSON response
echo json_encode([
    "past_stations" => $past_stations,
    "present_station" => $present_station,
    "upcoming_stations" => $upcoming_stations,
    "shop_details" => $shop_details
]);
?>