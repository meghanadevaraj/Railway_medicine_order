<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
    background: url(img2.jpg) no-repeat center center fixed;
    background-size: cover;
}

        .role-box {
            max-width: 650px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .role-btn {
            width: 80%;
            padding: 15px;
            font-size: 15px;
            font-weight: bold;
            border-radius: 10px;
            margin: 5px 0;
            transition: 0.3s;
        }
        .role-btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body><br><br><br>
<h2 class="mb-3 text-dark text-center" style="font-size: 30px; font-family: 'Poppins', sans-serif; font-weight: bold;">🚆 Welcome to Train Ticket Booking Application! 🚆</h2>
<p class="text-muted" align="center" style="font-size: 20px;">Please select your role to proceed:</p>
    <div class="role-box">
        <h2 class="mb-4">Select Your Role</h2>
        <a href="admin/admin_login.php" class="btn btn-primary role-btn">Admin</a>
        <!--<a href="shop/login.php" class="btn btn-success role-btn">Shop Owner</a>-->
        <a href="user/user_login.php" class="btn btn-warning role-btn">User</a>
        <!--<a href="madicine_booking/login.php" class="btn btn-success role-btn">Book your emergency medicine's</a>-->
    </div>
</body>
</html>
















    <!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: url('uploads/background.jpg') no-repeat center center fixed;
            background-size: cover;
            text-align: center;
        }
        .role-box {
            max-width: 600px;
            margin: 120px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .role-card {
            border-radius: 10px;
            padding: 20px;
            background: white;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            font-weight: bold;
        }
        .role-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <div class="role-box">
        <h2 class="mb-3 text-primary">🚆 Welcome to Train Booking Application! 🚆</h2>
        <p class="text-muted">Please select your role to proceed:</p>
        <div class="row mt-4">
            <div class="col-md-4">
                <a href="admin_login.php" class="text-decoration-none">
                    <div class="role-card p-3">Admin</div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="shop_owner_login.php" class="text-decoration-none">
                    <div class="role-card p-3">Shop Owner</div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="user_login.php" class="text-decoration-none">
                    <div class="role-card p-3">User</div>
                </a>
            </div>
        </div>
    </div>

</body>
</html>
 -->