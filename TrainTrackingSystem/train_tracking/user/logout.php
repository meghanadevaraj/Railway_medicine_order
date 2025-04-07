<?php
require '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("❌ Access Denied! Please <a href='user_login.php'>Login</a> first.");
}

$user_id = $_SESSION['user_id'];
$pnr_number = $_GET['pnr'] ?? '';

if (empty($pnr_number)) {
    die("❌ Invalid request. PNR number missing.");
}

// Get train ID and current station
$stmt = $pdo->prepare("
    SELECT tk.train_id, r.station_id, s.station_name
    FROM tickets tk 
    JOIN routes r ON tk.train_id = r.train_id
    JOIN stations s ON r.station_id = s.id
    WHERE tk.pnr_number = ? AND tk.user_id = ?
    ORDER BY r.arrival_time ASC
");
$stmt->execute([$pnr_number, $user_id]);
$stations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$stations) {
    die("❌ No station data found.");
}

// Separate past, present, and upcoming stations
$current_index = -1;
foreach ($stations as $index => $station) {
    if (strtotime($station['arrival_time']) <= time() && strtotime($station['departure_time']) >= time()) {
        $current_index = $index;
        break;
    }
}

$past_stations = array_slice($stations, 0, $current_index);
$present_station = $stations[$current_index] ?? null;
$upcoming_stations = array_slice($stations, $current_index + 1);

// Fetch shops at upcoming stations
$shop_details = [];
foreach ($upcoming_stations as $station) {
    $stmt = $pdo->prepare("SELECT * FROM shops WHERE station_id = ?");
    $stmt->execute([$station['station_id']]);
    $shops = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($shops as $shop) {
        $shop_id = $shop['id'];
        $stmt = $pdo->prepare("SELECT * FROM products WHERE shop_id = ?");
        $stmt->execute([$shop_id]);
        $shop['products'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $shop_details[$station['station_name']][] = $shop;
    }
}

// Send JSON response
$response = [
    "past_stations" => $past_stations,
    "present_station" => $present_station,
    "upcoming_stations" => $upcoming_stations,
    "shop_details" => $shop_details
];
echo json_encode($response);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Train Tracking & Shopping</title>
    <script>
        function fetchTrainStatus() {
            let pnr = document.getElementById("pnr_number").value;
            if (!pnr) {
                alert("Enter a valid PNR number!");
                return;
            }

            fetch("fetch_train_status.php?pnr=" + pnr)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("present_station").innerHTML = data.present_station ? data.present_station.station_name : "Unknown";

                    let pastHtml = "<ul>";
                    data.past_stations.forEach(station => {
                        pastHtml += `<li>${station.station_name}</li>`;
                    });
                    pastHtml += "</ul>";
                    document.getElementById("past_stations").innerHTML = pastHtml;

                    let upcomingHtml = "<ul>";
                    data.upcoming_stations.forEach(station => {
                        upcomingHtml += `<li>${station.station_name}</li>`;
                    });
                    upcomingHtml += "</ul>";
                    document.getElementById("upcoming_stations").innerHTML = upcomingHtml;

                    let shopHtml = "";
                    Object.keys(data.shop_details).forEach(station => {
                        shopHtml += `<h3>Shops at ${station}</h3><ul>`;
                        data.shop_details[station].forEach(shop => {
                            shopHtml += `<li>${shop.shop_name} - ${shop.shop_category}<br>`;
                            shop.products.forEach(product => {
                                shopHtml += `<button onclick="buyProduct(${product.id}, ${product.price}, '${product.product_name}')">${product.product_name} - ₹${product.price}</button><br>`;
                            });
                            shopHtml += "</li>";
                        });
                        shopHtml += "</ul>";
                    });
                    document.getElementById("shop_details").innerHTML = shopHtml;
                })
                .catch(error => console.error("Error fetching train status:", error));
        }

        function buyProduct(product_id, price, name) {
            let quantity = prompt(`Enter quantity for ${name}:`);
            if (!quantity || quantity <= 0) return;

            fetch("purchase_product.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `product_id=${product_id}&quantity=${quantity}&price=${price}`
            })
                .then(response => response.text())
                .then(data => alert(data))
                .catch(error => console.error("Error purchasing product:", error));
        }
    </script>
</head>

<body>
    <h1>Track Your Train & Shop at Stations</h1>
    <input type="text" id="pnr_number" placeholder="Enter PNR Number">
    <button onclick="fetchTrainStatus()">Check Train Status</button>

    <h2>Present Station: <span id="present_station">N/A</span></h2>
    <h3>Past Stations</h3>
    <div id="past_stations"></div>
    <h3>Upcoming Stations</h3>
    <div id="upcoming_stations"></div>

    <h2>Shops at Upcoming Stations</h2>
    <div id="shop_details"></div>
</body>

</html>