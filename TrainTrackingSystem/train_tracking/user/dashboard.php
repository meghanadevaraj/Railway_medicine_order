<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php"); // Redirect to login if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: url('uploads/img9.jpg') no-repeat center center fixed;
            background-size: cover;
            text-align: center;
        }
        /* Reduced Welcome Box */
        .welcome-box {
            max-width: 500px; /* Reduced size */
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            font-size: 25px; /* Increase font size */
        }

        /* Service Section */
        .service-container {
            max-width:900px;
            margin-top: 20px;
            padding: 10px;
            background: rgba(121, 97, 97, 0.8);
            border-radius: 10px;
            display: inline-block;
        }

        /* Service Box */
        .service-box {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            transition: transform 0.3s ease-in-out;
            background: white;
            padding: 10px;
            height: 230px; /* Ensures all boxes are same height */
        }
        .service-box:hover {
            transform: scale(1.05);
        }
        .service-box img {
            width: 100%;
            height: 180px; /* Fixed height */
            object-fit: cover;
            border-radius: 10px;
        }
        .service-text {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
            color:rgb(0, 0, 0);
        }
        .logout-btn {
        position: absolute;
        top: 40px;
        right: 150px;
        width: 120px;
        padding: 15px;
    }
    </style>
</head>
<body><div>
    <!-- Logout Button in Top Right -->
    <a href="user_login.php" class="btn btn-danger btn-sm logout-btn">Logout</a>
</div><br><br><br>
    <!-- Welcome Box -->
    
        <h3 class="mb-2 welcome-box " >Welcome, <?= $_SESSION['user_name']; ?>!</h3>

    
        <br>
    <!-- Services Section -->
    <div class="container service-container">
        <h2 class="text-center text-info">SERVICES</h2>
        <div class="row mt-4">
            <?php 
            $services = [
                ["name" => "Bookin a Train Ticket", "image" => "uploads/img7.jpg", "link" => "book_train_ticket.php?service=Booking the Train Tickets"],
                ["name" => "Check PNR Status", "image" => "uploads/img4.jpg", "link" => "pnr_status.php?service=Check-PNR-Status"],
                ["name" => "Check Train, Coach & Status", "image" => "uploads/img5.jpg", "link" => "train_status.php?service=Check-Train,Coach-&-Status"],
                ["name" => "Track Your Train & Shop at Stations", "image" => "uploads/img6.jpg", "link" => "train_product.php?service=Track-Your-Train&Shop-at-Stations"]
            ];

            foreach ($services as $service): ?>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="<?= $service['link']; ?>" class="text-decoration-none">
                        <div class="service-box shadow">
                            <img src="<?= $service['image']; ?>" alt="<?= $service['name']; ?>">
                            <div class="service-text"><?= $service['name']; ?></div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



    <!--<div class="container mt-5">
    <h2 class="text-center text-primary"> SERVICES</h2>
    <div class="row mt-4">
        <?php 
        // Define only 3 services
        $services = [
            ["name" => "Check PNR Status", "image" => "uploads/img4.jpg", "link" => "pnr_status.php?service=Check-PNR-Status"],
            ["name" => "Check Train, Coach & Status", "image" => "uploads/img5.jpg", "link" => "train_status.php?service=Check-Train,Coach-&-Status"],
            ["name" => "Track Your Train & Shop at Stations", "image" => "uploads/img6.jpg", "link" => "train_product.php?service=Track-Your-Train&Shop-at-Stations"]
        ];

        foreach ($services as $service): ?>
            <div class="col-md-4 mb-4">
                <a href="<?= $service['link']; ?>" class="text-decoration-none">
                    <div class="service-box shadow">
                        <img src="images/<?= $service['image']; ?>" alt="<?= $service['name']; ?>">
                        <div class="service-text"><?= $service['name']; ?></div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>-->

   