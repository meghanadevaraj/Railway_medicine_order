<?php session_start(); ?>
<html>
  <head>
    <title>Homepage - railway Pantry system</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/pantry system.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/e4eecd86d3.js" ></script>
    <!--<link rel="icon"
      type="image/png"
      href="https://img.icons8.com/ios-glyphs/30/000000/cook-male.png">-->
  </head>
  <body>
    <nav class="navbar" id="navbar">
    <ul>
    <li><a class="active" href="pantry system.php"><i class="fa fa-home"></i>Home</a></li>
    <li><a href="order.php"><i class="fa fa-pills"></i>order</a></li>
    <li><a href="order.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>your cart</a></li>
    <li><a href="#about"><i class="fa fa-question-circle"></i>About</a></li>
    <li><a href="#services"><i class="fas fa-pills"></i></i>Our services</a></li>
    <li><a href="#contact"><i class="fa fa-phone"></i>Contact</a></li>
    <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i><?php if(isset($_SESSION["username"])){echo "Sign out";} else{echo "sign in";} ?></a></li>
    <li style="color:white;" ><?php
     if(isset($_SESSION["username"]))
     { echo "Welcome " .$_SESSION["username"];}
      ?></li>
  </ul>
</nav>
    <div class="intro" id="home">
      <h1 style="margin:0; padding-top:300px; font-size:50px; color:#000000;">Medical Safety</h1>
    <a href="order.php" ><button class="btn" type="button" >Order now</button></a>
      <div class="gif">
        <a href="#about"> <img src="images/arrow.gif" height="50" width="50" style="margin:100px;" alt=""></a>
      </div>
    </div>
<div class="container" id="about">
  <div class="heading"><center> <h1 >About us</h1> </center>  </div>
<div class="parent" >
  <div class="child-1">
      <img src="images/md.png" width="400px" height="350px" alt="">
  </div>
  <div class="child-2">
  <p>
  TrainCareMed is a smart medical booking platform designed for passengers traveling by train. It helps ensure that essential medicines are accessible anytime, anywhere—especially for elderly people, mothers with babies, and individuals with chronic conditions or special needs. With a simple online system, users can book necessary medicines during their journey and receive them at upcoming stations, without hassle or delay.


<br><br>


  Our service connects with certified pharmacies at various railway stations, offering a wide range of healthcare products, including emergency medicines, first aid kits, pediatric supplies, and more. Whether you’re on a short trip or a long journey, TrainCareMed ensures your health is always protected. We’re committed to bringing safety and comfort to every passenger, making your train journey healthier and stress-free.
</p>

  </div>
</div>
</div>
<div class="services" id="services">
    <div class="heading"><center> <h1>Our services</h1> </center>  </div>
  <div class="parent service">
    <div class="flex-1">
      <div class="icon">
        <i class="fas fa-stopwatch"></i>
      </div>
      <div class="caption">
        <h3>🚄Ligtning fast delivery</h3>
        <p>Get your essential medicines delivered directly to your train seat at the next station. Our network of partnered pharmacies ensures that your orders are packed and dispatched in no time, keeping you safe and stress-free on the move.</p>
      </div>
    </div>
    <div class="flex-1">
      <div class="icon">
        <i class="fab fa-paypal"></i>
      </div>
      <div class="caption">
        <h3>💳 Secure virtual payment</h3>
        <p>Pay securely using digital wallets, UPI, or cards—no need to handle cash. Our platform supports fast and safe payments to make your medicine booking seamless and hassle-free during your train journey.</p>
      </div>
    </div>
    <div class="flex-1">
      <div class="icon">
        <i class="fas fa-map-marked-alt"></i>
      </div>
      <div class="caption">
        <h3>📍Live order tracking</h3>
        <p>Track your medicine order in real-time. From order confirmation to delivery, stay updated on your package location and arrival time. You’ll know exactly when and where your health essentials are arriving.
</p>
      </div>
    </div>
    <div class="flex-1">
      <div class="icon">
        <i class="fas fa-cart-plus"></i>
      </div>
      <div class="caption">
        <h3>💊 No Minimum Order Required</h3>
        <p>Need just one strip of tablets or a single ointment? No problem! We don’t require a minimum order value. Order only what you need—whether it’s a full prescription or a small emergency refill.</p>
      </div>
    </div>
  </div>
</div>
  <div class="contact" id="contact" style="padding:50px;">
        <div class="heading"><center><h1>Contact Us</h1></center></div>
    <div class="parent">
      <div class="flex main" style="width:800px; text-align:center;">
         <h4>Email to us @ : </h4>
        <div class="parent-2" style="display:flex;text-align:center;margin-left:200px;">
          <div class="email" style="background:#4CAF50;border-radius:10px 0 0 10px;">
            <i class="fas fa-envelope" style="font-size:35px; padding:10px; color:white;"></i>
          </div>
          <div class="address" >
            <a href="mailto:contactindianrailwaymedicalsafety@gmail.com">contactindianrailwaymedicalsafety@gmail.com</a>
          </div>
        </div>
        <div class="">
          <div class="logo">
            <h4 style="margin-top:50px;" >Connect with us on: </h4>
          <ul>
            <li> <a href="#"><i class="fab fa-instagram"></i></a> </li>
            <li> <a href="#"><i class="fab fa-facebook-f"></i></a> </li>
            <li> <a href="#"><i class="fab fa-twitter"></i></a> </li>
            <li> <a href="#"><i class="fab fa-google-plus-g"></i></a> </li>
          </ul>
            </div>
        </div>
      </div>
      <div class="flex">
        <img src="images/contact.svg" height="400px" width="400px" style="padding:15px;" alt="">
      </div>
    </div>
  </div>
  <div class="footer" style="background:black;">
    <center> <p style="color:white; margin:0;font-size:15px;padding:10px;" >  Railway medical safety system 2025 &copy; All rights reserved. Made with  <i class="fas fa-heart" style="color:#4CAF50;"></i>  by 21CS094 </p><center>
  </div>
<script type="text/javascript">
window.onscroll = function () {
  var myNav = document.getElementById('navbar');
  if (document.body.scrollTop >= 200 ) {
      myNav.classList.add("nav-colored");
      myNav.classList.remove("nav-transparent");
  }
  else {
      myNav.classList.add("nav-transparent");
      myNav.classList.remove("nav-colored");
  }
};
</script>
  </body>
</html>
