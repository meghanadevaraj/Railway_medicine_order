<?php
require '../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Train Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: url('img3.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .navbar {
            background-color:rgb(40, 58, 85);
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .container {
            max-width: 650px;
            background: rgba(202, 181, 181, 0.9);
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .list-group-item {
            font-weight: bold;
        }
        .list-group-item:hover {
            background-color: #0d6efd;
            color: white;
        }
        .emoji {
            font-size: 1.2em;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="padding: 30px 40px; height: 10px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"  style="font-size: 1.2rem; font-weight: bold;">🚆 Train Admin Panel</a>
        </div>
    </nav>
    
    <div class="container text-center">
        <h1 class="mb-4">Train Management</h1>
        
        <div class="list-group">
            <a href="add_train.php" class="list-group-item list-group-item-action">🚂 Add Train</a>
            <a href="add_station.php" class="list-group-item list-group-item-action"> 🏢 Add Station</a>
            <a href="define_routes.php" class="list-group-item list-group-item-action"> 🛤️ Define Routes</a>
            <a href="train_list.php" class="list-group-item list-group-item-action">🚆  Train List</a>
            <a href="admin_login.php" class="list-group-item list-group-item-action text-danger">Logout</a>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>