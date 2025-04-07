<?php
require '../config/db.php';
$result = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pnr_number = $_POST['pnr_number'];

    // Fetch Ticket Details
    $stmt = $pdo->prepare("SELECT t.pnr_number, tr.train_name, t.status FROM tickets t JOIN trains tr ON t.train_id = tr.id WHERE pnr_number = ?");
    $stmt->execute([$pnr_number]);
    $ticket = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($ticket) {
        $result = "<p class='result'>PNR: " . $ticket['pnr_number'] . "<br>
                   Train: " . $ticket['train_name'] . "<br>
                   Status: " . $ticket['status'] . "</p>";
    } else {
        $result = "<p class='result'>Invalid PNR!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check PNR Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('uploads/img9.jpg') no-repeat center center fixed;
            background-size: cover;
            text-align: center;
            margin-top: 100px;
            color: white;
        }
        section {
            max-width: 500px;
            margin: auto;
            background: rgb(161, 130, 152); /* Light transparent background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px); /* Blur effect for better contrast */
        }
        .result {
            color: white;
            font-weight: bold;
            background: rgba(7, 96, 9, 0.5); /* Semi-transparent dark background */
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 15px;
        }
        input {
            text-align: center;
        }
    </style>
</head>

<body>
    <section>
        <h2 class="mb-4">Check PNR Status</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Enter PNR Number:</label>
                <input type="text" name="pnr_number" class="form-control text-center" required>
            </div>
            <button type="submit" class="btn btn-primary">Check Status</button>
        </form>
        <?= $result; ?>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
