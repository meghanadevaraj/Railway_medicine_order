<?php
session_start(); ?>
<html>
  <head>
    <title>Homepage - railway Pantry system</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/order.css">
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
    <li><a href="#order"><i class="fa fa-pills"></i>order</a></li>
    <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>your cart</a></li>
    <li><a href="pantry system.php#about"><i class="fa fa-question-circle"></i>About</a></li>
    <li><a href="pantry system.php#services"><i class="fas fa-pills"></i></i>Our services</a></li>
    <li><a href="pantry system.php#contact"><i class="fa fa-phone"></i>Contact</a></li>
    <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i><?php if(isset($_SESSION["username"])){echo "Sign out";} else{echo "sign in";} ?></a></li>
    <li style="color:white;" ><?php
     if(isset($_SESSION["username"]))
     { echo "Welcome " .$_SESSION["username"];}
      ?></li>
  </ul>
</nav>
  <div class="bg">
    <h1 align="center" >Your health, our priority — fast medicine delivery</h1>
  </div>
  <div class="parent main-catalog">
    <a href="#breakfast" ><div class="flex">
      <div class="image main">
        <img src="images/senior.jpg" width="250px" height="150px" alt="idli">
      </div>
      <div class="caption">
        <h3 align="center" >Senior Citizens</h3>
      </div>
    </div></a>
  <a href="#Lunchdinner">  <div class="flex">
      <div class="image main">
        <img src="images/b&m.jpg" width="250px" height="150px" alt="idli">
      </div>
      <div class="caption">
        <h3 align="center" >Babies and Mothers</h3>
      </div>
    </div></a>
    <a href="#starters"><div class="flex">
      <div class="image main">
        <img src="images/women.jpg" width="250px" height="150px" alt="soup">
      </div>
      <div class="caption">
        <h3 align="center" >Women</h3>
      </div>
    </div></a>
    <a href="#tandoori" ><div class="flex">
      <div class="image main">
        <img src="images/dissable.jpeg" width="250px" height="150px" alt="tandoori">
      </div>
      <div class="caption">
        <h3 align="center" >Persons with Disabilities (PwD)</h3>
      </div>
    </div></a>

    <a href="#snacks"><div class="flex">
      <div class="image main">
        <img src="images/family.jpg" width="250px" height="150px" alt="samosa">
      </div>
      <div class="caption">
        <h3 align="center" >General Family Travel Medical Kit</h3>
      </div></a>
    </div>
  </div>
  <br>
  <!-- Breakfast SECTION -->
  <div class="breakfast" id="breakfast">
  <div class="heading" ><h1 style="margin:0 0 0 50px;">Senior Citizens👴</h1></div>
  <div class="parent sub-catalog">
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Blood pressure tablet</h4>
      </div>
      <div class="image sub">
        <img src="images/blood.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(40, 0)" name="button" style="background-color:rgb(60, 114, 231);"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;40</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(40, 0)" name="button"style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Diabetes medication</h4>
      </div>
      <div class="image sub">
        <img src="images/Diabetes.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(50, 1)" name="button" style="background-color:rgb(60, 114, 231);"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;50</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(50, 1)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Pain relief balm/spray</h4>
      </div>
      <div class="image sub">
        <img src="images/Pain.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(60, 2)"  name="button"style="background-color:rgb(60, 60, 231);"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style="padding:13.8px;" class="foodCost"   align="center"> &#x20B9;60</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(60, 2)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Anti-inflammatory tablets</h4>
      </div>
      <div class="image sub">
        <img src="images/Anti-inflammatory.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button"  onclick="minus(35, 3)" name="button"style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" class="foodCost" align="center"> &#x20B9;35</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button"  onclick="add(35, 3)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Warm pain relief patches</h4>
      </div>
      <div class="image sub">
        <img src="images/Warm pain relief patches.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(40, 4)" name="button"style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" class="foodCost"  align="center"> &#x20B9;40</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(40, 4)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!--Lunch and Dinner section-->
  <div class="Lunchdinner" id="Lunchdinner">
  <div class="heading" ><h3 style="margin:0 0 0 50px;">Babies and Mothers 👶</h3></div>
  <div class="parent sub-catalog">
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Baby wipes</h4>
      </div>
      <div class="image sub">
        <img src="images/wipes.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(100, 5)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;100</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(100, 5)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Baby thermometer</h4>
      </div>
      <div class="image sub">
        <img src="images/Baby thermometer.jpeg" height="150px" width="250px" alt="no">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(80, 6)" name="button"style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;80</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(80, 6)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Baby diapers</h4>
      </div>
      <div class="image sub">
        <img src="images/diapers.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(55, 7)"  name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style="padding:13.8px;" class="foodCost"   align="center"> &#x20B9;55</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(55, 7)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Feeding bottles & formula</h4>
      </div>
      <div class="image sub">
        <img src="images/Feeding bottles & formula.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button"  onclick="minus(55, 8)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" class="foodCost" align="center"> &#x20B9;55</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button"  onclick="add(55, 8)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Multivitamins(for mothers)</h4>
      </div>
      <div class="image sub">
        <img src="images/Multivitamins.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(130, 9)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" class="foodCost"  align="center"> &#x20B9;130</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(130, 9)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>

    
  <div  ><h3 style="margin:0 0 0 50px;"></h3></div>
  <div class="parent sub-catalog">
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Infant fever syrup</h4>
      </div>
      <div class="image sub">
        <img src="images/Infant fever syrup.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(110, 10)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;110</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(110, 10)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Dettol</h4>
      </div>
      <div class="image sub">
        <img src="images/dettol.jpeg" height="150px" width="250px" alt="no">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(140, 11)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;140</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(140, 11)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Woodward's</h4>
      </div>
      <div class="image sub">
        <img src="images/woodwards.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(70, 12)"  name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style="padding:13.8px;" class="foodCost"   align="center"> &#x20B9;70</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(70, 12)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Iron supplements</h4>
      </div>
      <div class="image sub">
        <img src="images/Iron supplements.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button"  onclick="minus(35, 13)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" class="foodCost" align="center"> &#x20B9;35</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button"  onclick="add(35, 13)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Pain relief tablets</h4>
      </div>
      <div class="image sub">
        <img src="images/Pain relief tablets.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(85, 14)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" class="foodCost"  align="center"> &#x20B9;85</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(85, 14)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!--Starters-->
  <div class="starters" id="starters">
  <div class="heading" ><h1 style="margin:0 0 0 50px;">Women👩</h1></div>
  <div class="parent sub-catalog">
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Sanitary pads</h4>
      </div>
      <div class="image sub">
        <img src="images/Sanitary pads.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(90, 15)" name="button"style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;90</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(90, 15)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">CrampNil</h4>
      </div>
      <div class="image sub">
        <img src="images/cramppill.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(60, 16)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;60</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(60, 16)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Hand sanitizer & hygiene wipes</h4>
      </div>
      <div class="image sub">
        <img src="images/Hand sanitizer & hygiene wipes.jpg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(50, 17)"  name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style="padding:13.8px;" class="foodCost"   align="center"> &#x20B9;50</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(50, 17)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Urinary tract infection (UTI) relief tablets</h4>
      </div>
      <div class="image sub">
        <img src="images/Urinary tract infection (UTI) relief tablets.png" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button"  onclick="minus(75, 18)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" class="foodCost" align="center"> &#x20B9;75</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button"  onclick="add(75, 18)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>
  </div>
  
  <!--Tandoori section-->
  <div class="tandoori" id="tandoori">
  <div class="heading" ><h1 style="margin:0 0 0 50px;">Persons with Disabilities (PwD)♿</h1></div>
  <div class="parent sub-catalog">
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Baclofen</h4>
      </div>
      <div class="image sub">
        <img src="images/Baclofen.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(200, 19)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;200</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(200, 19)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Levodopa + Carbidopa (Syndopa)</h4>
      </div>
      <div class="image sub">
        <img src="images/Levodopa + Carbidopa (Syndopa).jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(80, 20)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;80</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(80, 20)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Glibenclamide</h4>
      </div>
      <div class="image sub">
        <img src="images/Glibenclamide.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(50, 21)"  name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style="padding:13.8px;" class="foodCost"   align="center"> &#x20B9;50</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(50, 21)" name="button"style="background-color: #2ecc71;" > <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Diphenhydramine</h4>
      </div>
      <div class="image sub">
        <img src="images/Diphenhydramine.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button"  onclick="minus(100, 22)" name="button"style="background-color: #e74c3c;" > <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" class="foodCost" align="center"> &#x20B9;100</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button"  onclick="add(100, 22)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>

  </div>
  </div>


  <!--Snack Section-->
  <div class="snacks" id="snacks">
  <div class="heading" ><h1 style="margin:0 0 0 50px;"> General Family Travel Medical Kit👨‍👩‍👧</h1></div>
  <div class="parent sub-catalog">
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Fever & cold medicine </h4>
      </div>
      <div class="image sub">
        <img src="images/Fever & cold medicine (paracetamol, antihistamines).jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(25, 23)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;25</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(25, 23)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">First aid kit</h4>
      </div>
      <div class="image sub">
        <img src="images/First aid kit.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(15, 24)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" align="center" class="foodCost" > &#x20B9;15</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(15, 24)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Motion sickness tablets</h4>
      </div>
      <div class="image sub">
        <img src="images/Motion sickness tablets.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button" onclick="minus(30, 25)"  name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style="padding:13.8px;" class="foodCost"   align="center"> &#x20B9;30</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button" onclick="add(30, 25)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Insect repellent cream</h4>
      </div>
      <div class="image sub">
        <img src="images/Insect repellent cream.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button"  onclick="minus(40, 26)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" class="foodCost" align="center"> &#x20B9;40</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button"  onclick="add(40, 26)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <div class="flex order">
      <div class="title" >
        <h4 style="margin : 0" align="center">Nasal drops or inhaler</h4>
      </div>
      <div class="image sub">
        <img src="images/Nasal drops or inhaler.jpeg" height="150px" width="250px" alt="">
      </div>
      <div class="cost">
        <div class="change minus">
        <button class="btn dec" type="button"  onclick="minus(20, 27)" name="button" style="background-color: #e74c3c;"> <i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
        <div class="price">
          <h4 style=" padding:13.8px;" class="foodCost" align="center"> &#x20B9;20</h4>
        </div>
        <div class="change plus">
          <button class="btn inc" type="button"  onclick="add(20, 27)" name="button" style="background-color: #2ecc71;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>
  </div>
  </div>
  </div>
  </div>
  <div class="cart" id="finalcart" style="display:none;">
    <center><h2 style="margin:0px; display: inline;">Order total: &#x20B9;<span id="total" >0</span>  </h2>
    <button class="continuebtn" type="submit" form="myform" name="ctnbtn">Continue <i class="fa fa-arrow-right" aria-hidden="true"></i>
 </button></center>
  </div>
  <div class="footer" style="background:black;">
    <center> <p style="color:white; margin:0;font-size:15px;padding:10px;" >  Railway medical safety system 2025 &copy; All rights reserved. Made with  <i class="fas fa-heart" style="color:#4CAF50;"></i>  by 21CS094 </p><center>
  </div>
<script type="text/javascript">
window.onscroll = function () {
  var myNav = document.getElementById('navbar');
  if (document.body.scrollTop >= 100 ) {
      myNav.classList.add("nav-colored");
      myNav.classList.remove("nav-transparent");
  }
  else {
      myNav.classList.add("nav-transparent");
      myNav.classList.remove("nav-colored");
  }
};

// function to add the quantity when button is clciked

function add(cost, uid){
  //console.log(uid);
  var myform = document.getElementById('myform');
  var nos = document.getElementsByClassName('foodCost')[uid].innerHTML; //text
  var total  = document.getElementById('total');
  if (Number.isInteger(parseInt(nos[0])) == false){
    document.getElementsByClassName('foodCost')[uid].innerHTML = "1 No.";
    total.innerHTML = parseInt(total.innerHTML) + cost;
    var inpt = document.createElement("input");
    inpt.type = "hidden";
    inpt.value = 1;
    inpt.name = "food["+uid+"]";
    inpt.id = uid;
    myform.appendChild(inpt);

  }
  else {
    if(nos[0] < 9){
    nos = parseInt(nos[0]) + 1;
    document.getElementsByClassName('foodCost')[uid].innerHTML = nos + " Nos.";
    total.innerHTML = parseInt(total.innerHTML) + cost;
    var inpt = document.getElementById(uid);
    inpt.value = nos;

  }
  }
  if (parseInt(total.innerHTML) > 0)
    document.getElementById('finalcart').style.display = "block";
}

// function to subract the quantity when button is clciked

function minus(cost, uid){
  var inpt = document.getElementById(uid);
  var nos = document.getElementsByClassName('foodCost')[uid].innerHTML;
  var total  = document.getElementById('total');
  if (Number.isInteger(parseInt(nos[0])) == true && nos[0] > 1){
    nos = parseInt(nos[0]) - 1;
    document.getElementsByClassName('foodCost')[uid].innerHTML = nos + " Nos.";
    if( parseInt(total.innerHTML) > 0){
    total.innerHTML = parseInt(total.innerHTML) - cost;
    inpt.value = nos;
  }
  }
  else {
    document.getElementsByClassName('foodCost')[uid].innerHTML =  "&#x20B9;" + cost;
    if( parseInt(total.innerHTML) > 0 && Number.isInteger(parseInt(nos[0])) == true){
    total.innerHTML = parseInt(total.innerHTML) - cost;
    if(nos[0] == 1)
      inpt.remove();
  }
  }
  if (total.innerHTML == "0")
    document.getElementById('finalcart').style.display = "none";
  if (parseInt(total.innerHTML) > 0)
    document.getElementById('finalcart').style.display = "block";
}

</script>
<form id="myform" action="orderprocess.php"  method="post">
</form>
  </body>


</html>
